<?php 
add_filter( 'woocommerce_product_subcategories_hide_empty', '__return_false' );
add_filter( 'woocommerce_show_page_title', '__return_false' );
remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );

remove_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 );
add_action( 'woocommerce_shop_loop_subcategory_title', 'zarabici_template_loop_category_title', 10, 1 );

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'zarabici_template_loop_product_title', 10 );

add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_stock', 12 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );

add_action( 'woocommerce_archive_description', 'descripcion_secundaria', 10 );

add_action('woocommerce_before_shop_loop', 'moore_before_shop_loop', 40);

add_action( 'woocommerce_after_shop_loop', 'mas_vendidos', 15);
add_action( 'woocommerce_after_shop_loop', 'novedades', 18);
add_action( 'woocommerce_after_shop_loop', 'moore_after_shop_loop', 20);
// add_action( 'woocommerce_after_shop_loop', 'contenido_relacionado', 30);
add_action( 'woocommerce_after_main_content', 'bloques_h2', 3);
add_action( 'woocommerce_after_main_content', 'faqs', 4);
add_action( 'woocommerce_after_main_content', 'categorias_hermanas', 5);

// add_action( 'woocommerce_after_single_product_summary', 'contenido_relacionado', 4);
// add_action( 'woocommerce_after_single_product_summary', 'descripcion_larga', 5 );
add_action( 'woocommerce_product_additional_information', 'descripcion_larga', 5 );

add_action( 'woocommerce_after_single_product_summary', 'informacion_adicional', 6 );
add_action( 'woocommerce_after_single_product_summary', 'comments_template', 30 );
add_action( 'woocommerce_single_product_summary', 'mostrar_aviso_producto', 25 );
add_action( 'woocommerce_single_product_summary', 'boton_dejar_email', 26 );


add_filter('acf/settings/remove_wp_meta_box', '__return_false');

add_filter( 'woocommerce_product_tabs', '_remove_reviews_tab', 98 );
function _remove_reviews_tab( $tabs ) {
	// print_r($tabs);
	unset( $tabs[ 'description' ] );
	unset( $tabs[ 'reviews' ] );
	unset( $tabs[ 'additional_information' ] );
	return $tabs;
}



add_filter( 'woocommerce_get_breadcrumb', 'remove_shop_crumb', 20, 2 );
function remove_shop_crumb( $crumbs, $breadcrumb ){

   	$new_crumbs = array();

    foreach( $crumbs as $key => $crumb ){
        if( $crumb[1] !== wc_get_page_permalink( 'shop' ) ) {
            $new_crumbs[] = $crumb;
        }
    }

    return $new_crumbs;
}

// Both woo_breadcrumbs() and Yoast breadcrumbs need to be enabled in the WordPress admin for this to function.
// add_filter( 'woo_breadcrumbs', 'woo_custom_use_yoast_breadcrumbs' );
function woo_custom_use_yoast_breadcrumbs( $breadcrumbs ) {
	if ( function_exists( 'yoast_breadcrumb' ) ) {
		$before = '<div class="breadcrumb breadcrumbs woo - breadcrumbs"><div class="breadcrumb - trail">';
		$after = '</div></div>';
		$breadcrumbs   = yoast_breadcrumb( $before, $after, false );
	}
	return $breadcrumbs;
} // End woo_custom_use_yoast_breadcrumbs()

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
add_action( 'woocommerce_before_main_content', 'zarabici_yoast_breadcrumb', 20 );
function zarabici_yoast_breadcrumb() {

	if(function_exists('bcn_display')) {
		echo '<div class="woocommerce-breadcrumb">';
			echo '<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">';
				bcn_display();
			echo '</ol>';
		echo '</div>';
	}
	
}

function sv_remove_product_page_skus( $enabled ) {
    if ( ! is_admin() && is_product() ) {
        return false;
    }

    return $enabled;
}
add_filter( 'wc_product_sku_enabled', 'sv_remove_product_page_skus' );

add_action( 'woocommerce_product_meta_end', 'mostrar_terms_producto' );
function mostrar_terms_producto() {
	$taxonomies = array(
		'brand',
		'product_year',
	);

	foreach ($taxonomies as $taxonomy) {
		$taxonomy_object = get_taxonomy($taxonomy);
		$taxonomy_labels = get_taxonomy_labels( $taxonomy_object );
		$term_list = get_the_term_list( get_the_ID(), $taxonomy, '<span class="posted_in">'.$taxonomy_labels->singular_name.': ', ', ', '</span>' );
		echo strip_tags($term_list, '<span>');
	}
}

add_filter( 'woocommerce_product_description_heading', 'cambiar_titulo_caracteristicas_tab', 10, 1 );
function cambiar_titulo_caracteristicas_tab($title) {
	return false;
	// return __( 'Características', 'moore' );
}

add_filter( 'woocommerce_product_additional_information_heading', 'cambiar_titulo_additional_information_tab', 10, 1 );
function cambiar_titulo_additional_information_tab($title) {
	return __( 'Características', 'moore' );
}

add_filter( 'woocommerce_upsell_display_args', 'jk_related_products_args', 20 );
add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args', 20 );
  function jk_related_products_args( $args ) {
	$args['posts_per_page'] = 3; // 4 related products
	$args['columns'] = 3; // arranged in 2 columns
	return $args;
}

add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );
function new_loop_shop_per_page( $cols ) {
  $cols = 18;
  return $cols;
}

function descripcion_larga() {
    echo '<div class="descripcion-larga">';
        woocommerce_product_description_tab();
    echo '</div>';
}

function informacion_adicional() {
	global $product;
	if ( $product && ( $product->has_attributes() || apply_filters( 'wc_product_enable_dimensions_display', $product->has_weight() || $product->has_dimensions() ) ) ) {
		echo '<div class="informacion-adicional">';
	    	wc_get_template( 'single-product/tabs/additional-information.php');
	    echo '</div>';
	}
}

function moore_before_shop_loop() {
	echo '<div class="zarabici-shop-loop">';
}

function moore_after_shop_loop() {
	echo '</div>';
}

function mas_vendidos() {
	global $wp_query;
	if ($wp_query->found_posts <= 5 ) return false;

	if(is_tax()) {
		$term = get_queried_object();
		$mas_vendidos = get_term_meta( $term->term_id, 'productos_mas_vendidos', true );
		if ( $mas_vendidos ) {

			$shortcode = do_shortcode( '[products ids="'.implode(',', $mas_vendidos).'" columns="3" category="'.$term->slug.'"]' );

		} else {
	
			$shortcode = do_shortcode( '[products best_selling="true" limit="3" columns="3" category="'.$term->slug.'"]' );

		}

		if ($shortcode) {
			echo '<div class="mas-vendidos">';
				echo '<h2>' . __( 'Más vendidos', 'moore' ) . '</h2>';
				$texto = get_term_meta( $term->term_id, 'texto_mas_vendidos', true );
				if ($texto) {
					echo '<div class="archive-description secundaria">';
						echo apply_filters( 'the_content', $texto );
					echo '</div>';
				}
				echo $shortcode;
			echo '</div>';
		}
	}
}

function novedades() {
	global $wp_query;
	if ($wp_query->found_posts <= 5 ) return false;
	
	if(is_tax()) {
		$term = get_queried_object();
		$shortcode = do_shortcode( '[products limit="3" columns="3" orderby="id" order="DESC" category="'.$term->slug.'"]' );
		if ($shortcode) {
			echo '<div class="novedades">';
				echo '<h2>' . __( 'Novedades', 'moore' ) . '</h2>';
				$texto = get_term_meta( $term->term_id, 'texto_novedades', true );
				if ($texto) {
					echo '<div class="archive-description secundaria">';
						echo apply_filters( 'the_content', $texto );
					echo '</div>';
				}
				echo $shortcode;
			echo '</div>';
		}
	}
}

function bloques_h2() {
	if (is_tax()) {
		$term = get_queried_object();

		if( have_rows('bloques_h2', $term) ):

	        echo '<div class="bloques-h2 contenido-relacionado alterno">';

		    while( have_rows('bloques_h2', $term) ) : the_row();

		        $h2 = get_sub_field('h2');
		        $h2_texto = get_sub_field('h2_texto');
		        $h2_imagen = get_sub_field('h2_imagen');

		        if ($h2_imagen) {

			        echo '<div class="row">';
				        echo '<div class="col-md-6">';
				        	echo '<h2>'.$h2.'</h2>';
				        	echo $h2_texto;
				        echo '</div>';
				        echo '<div class="col-md-6">';
				        	echo wp_get_attachment_image( $h2_imagen, 'medium_large' );
				        echo '</div>';
			        echo '</div>';

			    } else {
			    	echo '<div class="archive-description secundaria">';
			        	echo '<h2>'.$h2.'</h2>';
			        	echo $h2_texto;
			        echo '</div>';
			    }

		    endwhile;

	        echo '</div>';
	    else:
	    	// echo 'no-hay';
		endif;
	}

}

function boton_dejar_email() {

	global $product;
	if ( $product->is_in_stock() ) return false;

	echo '<a href="#formulario-stock" data-toggle="collapse" class="btn btn-primary mb-3">'.__( 'Avísame cuando haya stock', 'zarabici' ).'</a>';

	echo '<div class="collapse" id="formulario-stock">';
		echo '<div class="card card-body mb-4">';
			echo do_shortcode( __( '[contact-form-7 id="11842" title="Formulario stock"]', 'zarabici' ) );
		echo '</div>';
	echo '</div>';
	
}

// Avisos
// add_action( 'wp_body_open', 'zarabici_aviso_tienda');
function zarabici_aviso_tienda() {
	$activar_aviso = get_theme_mod( 'woocommerce_demo_store' );
	if($activar_aviso) {
		$mensaje = get_theme_mod( 'woocommerce_demo_store_notice' );
		echo '<div class="aviso-global bg-primary">';
			echo '<div class="container">';
				echo $mensaje;
			echo '</div>';
		echo '</div>';

	}
}

function mostrar_aviso_producto() {
	global $product;
	$mensaje = false;
	$activar_aviso_en_stock = get_theme_mod( 'activar_aviso_productos_en_stock' );
	$activar_aviso_sin_stock = get_theme_mod( 'activar_aviso_productos_sin_stock' );

	if($activar_aviso_en_stock && $product->is_in_stock()) {
		$mensaje = get_theme_mod( 'aviso_productos_en_stock' );
	} elseif($activar_aviso_sin_stock && !$product->is_in_stock()) {
		$mensaje = get_theme_mod( 'aviso_productos_sin_stock' );
	}

	if ($mensaje) {
		echo '<div class="small alert alert-primary alert-dismissible fade show" role="alert">';
			echo $mensaje;
			echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>';
		echo '</div>';
	}
}

function woocommerce_template_loop_stock() {
    global $product;
    if ( /*$product->managing_stock() &&*/ ! $product->is_in_stock() ) {
        echo '<p class="stock out-of-stock">'.__('Out of stock', 'woocommerce').'</p>';
    } else {
    	$product_cats = wc_get_product_cat_ids( $product->ID );
		if( in_array( ID_CATEGORIA_BICIS, $product_cats ) ) {
	        echo '<p class="stock in-stock">'.__('Unidades disponibles', 'zarabici').'</p>';
	    }
    }
}


/**
 * Disable out of stock variations
 * https://github.com/woocommerce/woocommerce/blob/826af31e1e3b6e8e5fc3c1004cc517c5c5ec25b1/includes/class-wc-product-variation.php
 * @return Boolean
 */
function wcbv_variation_is_active( $active, $variation ) {
 if( ! $variation->is_in_stock() ) {
 	return false;
 }
 return $active;
}
add_filter( 'woocommerce_variation_is_active', 'wcbv_variation_is_active', 10, 2 );

function zarabici_template_loop_product_title() {
	echo '<p class="woocommerce-loop-product__title">' . get_the_title() . '</p>';
}

function zarabici_template_loop_category_title( $category ) { 
    ?> 
    <p class="woocommerce-loop-category__title"> 
        <?php 
            echo $category->name; 
 
            if ( $category->count > 0 ) 
                echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category ); 
        ?> 
    </p> 
    <?php 
} 

/**
 * Change price format from range to "From"
 *
 * @param float $price
 * @param obj $product
 * @return str
 */
// function zarabici_variable_price_format( $price, $product ) {
//     $prefix = sprintf('%s ', __('Desde', 'zarabici'));
//     $min_price_regular = $product->get_variation_regular_price( 'min', true );
//     $min_price_sale    = $product->get_variation_sale_price( 'min', true );
//     $max_price = $product->get_variation_price( 'max', true );
//     $min_price = $product->get_variation_price( 'min', true );
//     $price = ( $min_price_sale == $min_price_regular ) ?
//         wc_price( $min_price_regular ) :
//         '<del>' . wc_price( $min_price_regular ) . '</del>' . '<ins>' . wc_price( $min_price_sale ) . '</ins>';

//     return ( $min_price == $max_price ) ?
//         $price :
//         sprintf('%s%s', $prefix, $price);
// }
// add_filter( 'woocommerce_variable_sale_price_html', 'zarabici_variable_price_format', 10, 2 );
// add_filter( 'woocommerce_variable_price_html', 'zarabici_variable_price_format', 10, 2 );

function zarabici_format_price_range( $price, $from, $to ) {
    return sprintf( '%s: %s', __( 'Desde', 'zarabici' ), wc_price( $from ) );
}
add_filter( 'woocommerce_format_price_range', 'zarabici_format_price_range', 10, 3 );


add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
    return array(
        'width' => 180,
        'height' => 180,
        'crop' => 0,
    );
} );

/**
 * Hide shipping rates when free shipping is available, but keep "Local pickup" 
 * Updated to support WooCommerce 2.6 Shipping Zones
 */

function hide_shipping_when_free_is_available( $rates, $package ) {
	$new_rates = array();
	foreach ( $rates as $rate_id => $rate ) {
		// Only modify rates if free_shipping is present.
		if ( 'free_shipping' === $rate->method_id ) {
			$new_rates[ $rate_id ] = $rate;
			break;
		}
	}

	if ( ! empty( $new_rates ) ) {
		//Save local pickup if it's present.
		foreach ( $rates as $rate_id => $rate ) {
			if ('local_pickup' === $rate->method_id ) {
				$new_rates[ $rate_id ] = $rate;
				break;
			}
		}
		return $new_rates;
	}

	return $rates;
}

add_filter( 'woocommerce_package_rates', 'hide_shipping_when_free_is_available', 10, 2 );

/**
 * @snippet       Sort Products By Stock Status - WooCommerce Shop
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 5
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
 
add_filter( 'woocommerce_get_catalog_ordering_args', 'zarabici_first_sort_by_stock_amount', 9999 );
 
function zarabici_first_sort_by_stock_amount( $args ) {
   $args['orderby'] = 'meta_value';
   $args['meta_key'] = '_stock_status';
   return $args;
}