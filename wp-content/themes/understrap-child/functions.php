<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'ID_CATEGORIA_BICIS', 426);

if ( ! function_exists( 'is_woocommerce_activated' ) ) {
    function is_woocommerce_activated() {
        if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
    }
}

$content_width = 1140;
add_theme_support('editor-styles');
add_filter( 'widget_text', 'do_shortcode');
add_filter( 'wpcf7_form_elements', 'do_shortcode' );
function understrap_wpdocs_theme_add_editor_styles() {
    add_editor_style( 'css/custom-editor-style.css' );
}

// add_action( 'after_setup_theme', 'editor_color_palette' );
function editor_color_palette() {
    add_theme_support( 'editor-color-palette', array(
            array(
                'name'  => __( 'Primary #A1163B', 'moore-admin' ),
                'slug'  => 'primary',
                'color' => '#A1163B',
            ),
            array(
                'name'  => __( 'Secondary #F9BB0B', 'moore-admin' ),
                'slug'  => 'secondary',
                'color' => '#F9BB0B',
            ),
            array(
                'name'  => __( 'Black #010101', 'moore-admin' ),
                'slug'  => 'black',
                'color' => '#010101',
            ),
            array(
                'name'  => __( 'Light #dadada', 'moore-admin' ),
                'slug'  => 'light',
                'color' => '#dadada',
            ),
            array(
                'name'  => __( 'White #ffffff', 'moore-admin' ),
                'slug'  => 'white',
                'color' => '#ffffff',
            ),
            array(
                'name'  => __( 'Light 2 #F1DADE', 'moore-admin' ),
                'slug'  => 'light-2',
                'color' => '#F1DADE',
            ),
            array(
                'name'  => __( 'Rojo #EB5759', 'moore-admin' ),
                'slug'  => 'red',
                'color' => '#EB5759',
            ),
            array(
                'name'  => __( 'Rojo 2 #d9304d', 'moore-admin' ),
                'slug'  => 'red-2',
                'color' => '#d9304d',
            ),
            array(
                'name'  => __( 'Amarillo #ffe000', 'moore-admin' ),
                'slug'  => 'yellow',
                'color' => '#ffe000',
            ),
            array(
                'name'  => __( 'Naranja #d5a100', 'moore-admin' ),
                'slug'  => 'orange',
                'color' => '#d5a100',
            ),
            array(
                'name'  => __( 'Marrón #9d771f', 'moore-admin' ),
                'slug'  => 'brown',
                'color' => '#9d771f',
            ),
            array(
                'name'  => __( 'Cyan #97c4d7', 'moore-admin' ),
                'slug'  => 'cyan',
                'color' => '#97c4d7',
            ),
            array(
                'name'  => __( 'Rosa #e6ae9c', 'moore-admin' ),
                'slug'  => 'pink',
                'color' => '#e6ae9c',
            ),
            array(
                'name'  => __( 'Azul #102f47', 'moore-admin' ),
                'slug'  => 'blue',
                'color' => '#102f47',
            ),
            array(
                'name'  => __( 'Púrpura #5175b9', 'moore-admin' ),
                'slug'  => 'purple',
                'color' => '#5175b9',
            ),
            array(
                'name'  => __( 'Verde #75be81', 'moore-admin' ),
                'slug'  => 'green',
                'color' => '#75be81',
            ),
            array(
                'name'  => __( 'Gris #6da8a5', 'moore-admin' ),
                'slug'  => 'gray',
                'color' => '#6da8a5',
            ),
            array(
                'name'  => __( 'Verde 2 #efd459', 'moore-admin' ),
                'slug'  => 'green-2',
                'color' => '#efd459',
            ),
        )
    );
}

$moore_includes = array(
    '/post-types.php',
    '/shortcodes.php',
    '/customizer-moore.php',
    // '/gdpr-cookies.php',
    '/widgets-moore.php',
    // '/blocks-moore.php',
    // '/dummy-content.php',
    '/woocommerce-moore.php',
);

foreach ( $moore_includes as $file ) {
    $filepath = locate_template( 'inc' . $file );
    if ( ! $filepath ) {
        trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
    }
    require_once $filepath;
}

// Desactivar marcado schema de yoast
add_filter( 'wpseo_json_ld_output', '__return_false' );

function moore_after_setup_theme(){
    add_theme_support( 'align-full' );
    add_theme_support( 'align-wide' );

    register_nav_menus( array(
        // 'legal' => __( 'Páginas legales', 'moore-admin' ),
        // 'account'  => __( 'Páginas de usuario', 'moore-admin' ),
        'movil'  => __( 'Menú móvil', 'moore-admin' ),
    ) );
}
add_action( 'after_setup_theme', 'moore_after_setup_theme' );

add_filter( 'wp_nav_menu_items', 'new_nav_menu_items', 10, 2 );
function new_nav_menu_items($items, $args) {
    if ( is_woocommerce_activated() && $args->theme_location == 'primary' ) {
        $login = '<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-login" class="menu-item menu-item-custom menu-item-object-custom nav-item"><a class="nav-link" href="' . get_permalink( get_option('woocommerce_myaccount_page_id') ) . '"><span class="mbri-user mbr-iconfont"></span></a></li>';

        global $woocommerce;
        $count_html = '';
        $count = $woocommerce->cart->cart_contents_count;
        if($count > 0) {
            $count_html = ' (<span class="menu-cart-count">'.$count.'</span>)';
        }

        $cart = '<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-login" class="menu-item menu-item-custom menu-item-object-custom nav-item"><a class="nav-link" href="' . wc_get_cart_url() . '"><span class="mbri-shopping-cart mbr-iconfont"></span>'.$count_html.'</a></li>';

        $items = $items . $login . $cart;
    }

    return $items;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'moore_add_to_cart_fragment' );
function moore_add_to_cart_fragment( $fragments ) {
    global $woocommerce;
    $fragments['.menu-cart-count'] = $woocommerce->cart->cart_contents_count;
    return $fragments;
 }



function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
    
    wp_enqueue_script( 'scroll-magic', get_stylesheet_directory_uri() . '/js/ScrollMagic.min.js', array(), $the_theme->get( 'Version' ), false );
    
    
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

function add_child_theme_textdomain() {
    load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );


function author_page_redirect() {
    if ( is_author() ) {
        wp_redirect( home_url() );
    }
}
add_action( 'template_redirect', 'author_page_redirect' );

function es_blog() {

    if( is_singular('post') || is_category() || is_tag() || ( is_home() && !is_front_page() ) ) {
        return true;
    }

    return false;
}

add_filter( 'theme_mod_understrap_sidebar_position', 'cargar_sidebar');
function cargar_sidebar( $valor ) {
    global $wp_query;
    if ( es_blog() ) {
        $valor = 'right';
    }
    return $valor;
}

function understrap_all_excerpts_get_more_link( $post_excerpt ) {
    if ( ! is_admin() ) {
        global $post;
        if ('' != $post_excerpt) $post_excerpt .= '...';
        $post_excerpt .= '<p class="mt-5"><a class="btn btn-black" href="' . esc_url( get_permalink( get_the_ID() ) ) . '">' . __( 'Lee más',
        'moore' ) . '</a></p>';
    }
    return $post_excerpt;
}

function custom_excerpt_length( $length ) {
     return 25;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function understrap_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
    }
    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() )
    );
    echo $time_string; // WPCS: XSS OK.
}

function prefix_category_title( $title ) {
    if ( is_tax() || is_category() || is_tag() ) {
        $title = single_term_title( '', false );
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    }
    return $title;
}
add_filter( 'get_the_archive_title', 'prefix_category_title' );

add_filter( 'body_class', 'clases_body' );
function clases_body( $classes ) {
    if (!is_singular()) return $classes;
    $contenedor_estrecho = get_post_meta( get_the_ID(), 'contenedor_estrecho', true );
    if (1 == $contenedor_estrecho) {
        $classes[] = 'contenedor-estrecho';
    }
    return $classes;
}

function understrap_entry_footer() {
    // Hide category and tag text for pages.
    if ( 'post' === get_post_type() ) {
        /* translators: used between list items, there is a space after the comma */
        $categories_list = get_the_category_list( esc_html__( ', ', 'understrap' ) );
        if ( $categories_list && understrap_categorized_blog() ) {
            /* translators: %s: Categories of current post */
            printf( '<span class="cat-links">' . esc_html__( '%s', 'understrap' ) . '</span>', $categories_list ); // WPCS: XSS OK.
        }
        /* translators: used between list items, there is a space after the comma */
        if (is_singular( 'post' ) || is_singular( 'portfolio_page' )) {
            $tags_list = get_the_tag_list( '', esc_html__( ', ', 'understrap' ) );
            if ( $tags_list ) {
                /* translators: %s: Tags of current post */
                printf( '<span class="tags-links">' . esc_html__( 'Tagged %s', 'understrap' ) . '</span>', $tags_list ); // WPCS: XSS OK.
            }
        }
    }

    edit_post_link(
        sprintf(
            /* translators: %s: Name of current post */
            esc_html__( 'Edit %s', 'understrap' ),
            the_title( '<span class="screen-reader-text">"', '"</span>', false )
        ),
        '<span class="edit-link">',
        '</span>'
    );
}

// add_action( 'pre_get_posts', 'moore_pre_get_posts' );
function moore_pre_get_posts($query) {
    if (!$query->is_main_query() || is_admin() ) return;

    if (is_search()) {
        $query->set('posts_per_page', 30);
    }
}

add_action('wp_footer', 'boton_ir_arriba');
function boton_ir_arriba() {
    echo '<span id="ir-arriba"><a href="#" class="mbr-arrow-up"><i></i></a></span>';
}

function get_descripcion_secundaria() {
    $term_id = false;
    if ( is_tax() ) $term_id = get_queried_object_id();

    if ($term_id) {
        $descripcion_secundaria = get_term_meta( $term_id, 'descripcion_secundaria', true );
        if ($descripcion_secundaria) {
            $r = '<div class="archive-description secundaria">';
                $r .= $descripcion_secundaria;
            $r .= '</div>';
            
            return $r;
        }
    }

    return false;
}

function descripcion_secundaria() {
    echo get_descripcion_secundaria();
}

function get_contenido_relacionado() {

    $r = '';

    $args = array(
        'post_type'         => 'post',
        'posts_per_page'    => 2,
        'orderby'           => 'rand',
    );

    $q = new WP_Query($args);
    if ($q->have_posts()) {

        $r .= '<div class="contenido-relacionado">';

        while ($q->have_posts()) { $q->the_post();
            
            $r .= '<div class="row mb-5">';

                $r .= '<div class="col-md-6 mb-4">';
                    $r .= get_the_post_thumbnail( get_the_ID(), 'medium_large' );
                $r .= '</div>';

                $r .= '<div class="col-md-6 mb-4">';
                    $r .= '<h2>'.get_the_title().'</h2>';
                    ob_start();
                    the_excerpt();
                    $r .= ob_get_clean();
                $r .= '</div>';

            $r .= '</div>';

        }

        $r .= '</div>';
    }

    wp_reset_postdata();

    return $r;

}

function contenido_relacionado() {
    echo get_contenido_relacionado();
}

function get_faqs() {
    $term_id = false;
    $preguntas_frecuentes = array();
    $preguntas_frecuentes_especificas = false;


    if(is_tax()) {
        $term_id = get_queried_object_id();
        $preguntas_frecuentes_especificas = get_term_meta( $term_id, 'preguntas_frecuentes', true );
        $preguntas_frecuentes_especificas = apply_filters( 'the_content', $preguntas_frecuentes_especificas );
    }

    if ($preguntas_frecuentes_especificas) {

        $faqs_array = explode('<h3>', $preguntas_frecuentes_especificas);
        
        foreach ($faqs_array as $faq) {

            $faq_array = explode('</h3>', $faq);
            if(isset($faq_array[0]) && isset($faq_array[1]) ) {
                $preguntas_frecuentes[] = $faq_array;
            }
        }

    }

    $args = array(
        'post_type'         => 'preguntas-frecuentes',
        'posts_per_page'    => -1,
        'orderby'           => 'menu_order',
        'order'             => 'ASC',
    );

    $global_faq_query = new WP_Query($args);
    if ($global_faq_query->have_posts()) {
        while ( $global_faq_query->have_posts() ) { $global_faq_query->the_post();
            $preguntas_frecuentes[] = array(
                get_the_title(),
                get_the_content(),
            );
        }
    }
    wp_reset_postdata();

    $r = '';

    if ($preguntas_frecuentes) {
        $index = 0;
        $r .= '<h2 class="text-center pt-5">'.__( 'Preguntas más frecuentes', 'moore' ).'</h2>';
        $r .= '<div id="faq-accordion" class="py-5 not-in-viewport">';

            foreach ($preguntas_frecuentes as $faq_array) {

                

                $index++;
                $pregunta = rtrim($faq_array[0]);
                $respuesta = rtrim($faq_array[1]);

                $respuesta_compare = strip_tags($respuesta);

                if( ( strlen($respuesta_compare) > 10 && !strpos($respuesta, 'Lorem ipsum') ) || current_user_can( 'edit_posts' ) ) {

                    $r .= '<div class="card">';
                        $r .= '<div class="card-header" id="encabezado'.$index.'">';
                            $r .= '<h3 class="mb-0">';
                                $r .= '<a data-toggle="collapse" href="#collapse'.$index.'" aria-expanded="true" aria-controls="collapse'.$index.'">'.$pregunta.'</a>';
                            $r .= '</h3>';
                        $r .= '</div>';

                        $r .= '<div id="collapse'.$index.'" class="collapse show" aria-labelledby="heading'.$index.'">';
                            $r .= '<div class="card-body">';
                                $r .= $respuesta;
                            $r .= '</div>';
                        $r .= '</div>';
                    $r .= '</div>';

                }

            }
        
        $r .= '</div>';
    }


    return $r;
    return false;
}

function faqs() {
    echo get_faqs();
}

function get_categorias_hermanas() {
    if (!is_tax()) return false;
    $current_term = get_queried_object();
    $parent = $current_term->parent;
    if (0 == $parent) return false;

    $r = '';
    
    $cat_ids = get_term_meta( $current_term->term_id, 'categorias_interlink', true );
    if($cat_ids) {
        $cat_ids_implode = implode(',', $cat_ids);
        // $shortcode = do_shortcode('[product_categories parent="'.$parent.'" orderby="menu_order" hide_empty="0"]');
        $shortcode = do_shortcode('[product_categories ids="'.$cat_ids_implode.'" orderby="include" hide_empty="0"]');
        if ($shortcode) {
            $shortcode = '<div class="py-5">'.$shortcode.'</div>';
            $r .= $shortcode;
        }
    }
    return $r;
}

function categorias_hermanas() {
    echo get_categorias_hermanas();
}

// Eliminar funcionalidad click en menú principal
add_filter( 'nav_menu_link_attributes', 'quitar_click_menu_principal', 10, 4 );
function quitar_click_menu_principal( $atts, $item, $args, $depth ) {

    if ( ( $args->container_id == 'navbarNavDropdown' ) && isset( $args->has_children ) && $args->has_children && 0 === $depth && $args->depth !== 1 ) {
        unset($atts['data-toggle']);
        unset($atts['aria-haspopup']);
        unset($atts['aria-expanded']);
        $atts['class']         = 'dropdown-toggle nav-link';
        // print_r($item);

        $atts['href']          = $item->url;
    }

    return $atts;
}

add_action('init', 'remove_extra_image_sizes');
function remove_extra_image_sizes() {
    remove_image_size( '1536x1536' );
}