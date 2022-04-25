<?php
/**
 * Plugin Name: WooCommerce Category Product Thumbnails
 * Plugin URI: http://www.gazchap.com/posts/woocommerce-category-product-thumbnails/
 * Description: Automatically use a product thumbnail as a category thumbnail if no category thumbnail is set
 * Author: Gareth 'GazChap' Griffiths
 * Version: 1.1
 * Author URI: http://www.gazchap.com/
 */

namespace GazChap;

class WC_Category_Product_Thumbnails {

	private $shuffle = true;
	private $recurse_category_ids = true;
	private $limit = 20; // number of most recent products to fetch when shuffle is true, lower means faster

	/**
	 * WC_Category_Product_Thumbnails constructor.
	 * Sets a default limit (to -1, i.e. all posts) if none already set and then replaces WC actions with ours
	 */
	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'replace_wc_actions' ) );

		if ( !$this->limit ) $this->limit = -1;
	}

	/**
	 * Removes the action that puts the thumbnail before the subcategory title, and replaces it with our version
	 */
	public function replace_wc_actions() {
		remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10 );
		add_action( 'woocommerce_before_subcategory_title', array( $this, 'auto_subcategory_thumbnail' ) );
		add_filter( 'woocommerce_get_sections_products', array( $this, 'add_setting_section' ) );
		add_filter( 'woocommerce_get_settings_products', array( $this, 'add_settings_to_section' ), 10, 2 );
	}

	/**
	 * The function that does all the donkey work.
	 * @param \WP_Term $category - the category that we're dealing with
	 */
	public function auto_subcategory_thumbnail( $category ) {

		// does this category already have a thumbnail defined? if so, use that instead
		if ( get_term_meta( $category->term_id, 'thumbnail_id', true ) ) {
			woocommerce_subcategory_thumbnail( $category );
			return;
		}

		// get a list of category IDs inside this category (so we're fetching products from all subcategories, not just the top level one)
		if ( $this->recurse_category_ids ) {
			$category_ids = $this->get_sub_category_ids( $category );
		} else {
			$category_ids = array( $category->term_id );
		}

		$query_args = array(
			'posts_per_page' => $this->shuffle ? $this->limit : 1,
			'post_status' => 'publish',
			'post_type' => 'product',
			'meta_query' => array(
				array(
					'key' => '_thumbnail_id',
					'value' => '',
					'compare' => '!=',
				),
			),
			'tax_query' => array(
				array(
					'taxonomy' => 'product_cat',
					'field' => 'term_id',
					'terms' => $category_ids,
					'operator' => 'IN',
				),
			),
		);

		$products = get_posts( $query_args );
		if ( $products ) {
			$image_size = 'shop_thumbnail';
			if ( get_option('gazchap-wc-category-product-thumbnails_category-size') ) {
				$image_size = get_option('gazchap-wc-category-product-thumbnails_category-size');
			}
			// echo get_the_post_thumbnail( $products[ array_rand( $products ) ]->ID, $image_size );
			echo get_the_post_thumbnail( $products[0]->ID, $image_size );
		} else {
			// show the default placeholder category image if there's no products inside this one
			woocommerce_subcategory_thumbnail( $category );
		}
	}

	/**
	 * Recursive function to fetch a list of child category IDs for the one passed
	 *
	 * @param \WP_Term $start - the category to start from
	 * @param array $results - this just stores the results as they're being built up
	 *
	 * @return array - an array of term IDs for each product_cat inside the original one
	 */
	private function get_sub_category_ids( $start, $results = array() ) {
		if ( !is_array( $results ) ) $results = array();

		$results[] = $start->term_id;
		$cats = get_terms( array( 'taxonomy' => 'product_cat', 'hide_empty' => false, 'parent' => $start->term_id ) );
		if ( is_array( $cats ) ) {
			foreach( $cats as $cat ) {
				$results = $this->get_sub_category_ids( $cat, $results );
			}
		}

		return $results;
	}

	function add_setting_section( $sections ) {

		$sections['gazchap-wc-category-thumbnails'] = __( 'Auto Category Thumbnails', 'gazchap-wc-category-product-thumbnails' );
		return $sections;

	}

	function add_settings_to_section( $settings, $current_section ) {
		/**
		 * Check the current section is what we want
		 **/
		if ( $current_section == 'gazchap-wc-category-thumbnails' ) {
			$new_settings = array();
			// Add Title to the Settings
			$new_settings[] = array( 'name' => __( 'Auto Category Thumbnails Settings', 'gazchap-wc-category-product-thumbnails' ), 'type' => 'title', 'desc' => __( 'The following options are used to configure GazChap\'s Auto Category Thumbnails', 'text-domain' ), 'id' => 'gazchap-wc-category-thumbnails' );

			$temp = $this->_get_all_image_sizes();
			$image_sizes = array();
			foreach( $temp as $image_size => $image_spec_array ) {
				$image_spec = "";
				$image_spec .= ($image_spec_array['width'] > 0) ? $image_spec_array['width'] : 'auto';
				$image_spec .= ' x ';
				$image_spec .= ($image_spec_array['height'] > 0) ? $image_spec_array['height'] : 'auto';
				if ( $image_spec_array['crop'] ) {
					$image_spec .= ", cropped";
				}
				$image_sizes[ $image_size ] = $image_size . " (" . $image_spec . ")";
			}

			// Add first checkbox option
			$new_settings[] = array(
				'name'     => __( 'Thumbnail Size', 'text-domain' ),
				'desc_tip' => __( 'Choose the image size to use for the thumbnails', 'gazchap-wc-category-thumbnails' ),
				'id'       => 'gazchap-wc-category-product-thumbnails_category-size',
				'type'     => 'select',
				'options' => $image_sizes,
				'desc'     => __( 'Choose the image size to use for the thumbnails', 'gazchap-wc-category-thumbnails' ),
			);

			$new_settings[] = array( 'type' => 'sectionend', 'id' => 'gazchap-wc-category-thumbnails' );
			return $new_settings;

		/**
		 * If not, return the standard settings
		 **/
		} else {
			return $settings;
		}
	}

	private function _get_all_image_sizes() {
	    global $_wp_additional_image_sizes;

	    $default_image_sizes = get_intermediate_image_sizes();

	    foreach ( $default_image_sizes as $size ) {
	        $image_sizes[ $size ][ 'width' ] = intval( get_option( "{$size}_size_w" ) );
	        $image_sizes[ $size ][ 'height' ] = intval( get_option( "{$size}_size_h" ) );
	        $image_sizes[ $size ][ 'crop' ] = get_option( "{$size}_crop" ) ? get_option( "{$size}_crop" ) : false;
	    }

	    if ( isset( $_wp_additional_image_sizes ) && count( $_wp_additional_image_sizes ) ) {
	        $image_sizes = array_merge( $image_sizes, $_wp_additional_image_sizes );
	    }

	    return $image_sizes;
	}

}

new WC_Category_Product_Thumbnails();