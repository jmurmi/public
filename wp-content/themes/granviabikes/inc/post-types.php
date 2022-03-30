<?php 
add_post_type_support( 'page', 'excerpt' );
// add_action( 'init', 'sumun_settings', 1000 );
function sumun_settings() {  
    // register_taxonomy_for_object_type('category', 'page');  
}


if ( ! function_exists('custom_post_type_slide') ) {

// Register Custom Post Type
function custom_post_type_slide() {

	$labels = array(
		'name'                  => _x( 'Slides', 'Post Type General Name', 'sumun' ),
		'singular_name'         => _x( 'Slide', 'Post Type Singular Name', 'sumun' ),
		'menu_name'             => __( 'Slides', 'sumun-admin' ),
		'name_admin_bar'        => __( 'Slides', 'sumun-admin' ),
		'add_new'               => __( 'Añadir nueva Slide', 'sumun-admin' ),
		'new_item'              => __( 'Nueva Slide', 'sumun-admin' ),
		'edit_item'             => __( 'Editar Slide', 'sumun-admin' ),
		'update_item'           => __( 'Actualizar Slide', 'sumun-admin' ),
		'view_item'             => __( 'Ver Slide', 'sumun-admin' ),
		'view_items'            => __( 'Ver Slide', 'sumun-admin' ),
	);
	$args = array(
		'label'                 => __( 'Slides', 'sumun' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 3,
		'menu_icon'             => 'dashicons-slides',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest' 			=> true,
		'taxonomies'			=> array(),
	);
	register_post_type( 'slide', $args );

}
// add_action( 'init', 'custom_post_type_slide', 0 );

}

if ( ! function_exists('custom_post_type_faq') ) {

// Register Custom Post Type
function custom_post_type_faq() {

	$labels = array(
		'name'                  => _x( 'Preguntas frecuentes', 'Post Type General Name', 'sumun' ),
		'singular_name'         => _x( 'Pregunta frecuente', 'Post Type Singular Name', 'sumun' ),
		'menu_name'             => __( 'FAQs', 'sumun-admin' ),
		'name_admin_bar'        => __( 'FAQs', 'sumun-admin' ),
		'add_new'               => __( 'Añadir nueva FAQ', 'sumun-admin' ),
		'new_item'              => __( 'Nueva FAQ', 'sumun-admin' ),
		'edit_item'             => __( 'Editar FAQ', 'sumun-admin' ),
		'update_item'           => __( 'Actualizar FAQ', 'sumun-admin' ),
		'view_item'             => __( 'Ver FAQ', 'sumun-admin' ),
		'view_items'            => __( 'Ver FAQ', 'sumun-admin' ),
	);
	$args = array(
		'label'                 => __( 'Preguntas frecuentes', 'sumun' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 4,
		'menu_icon'             => 'dashicons-warning',
		'show_in_admin_bar'     => false,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest' 			=> false,
		'taxonomies'			=> array(),
	);
	register_post_type( 'preguntas-frecuentes', $args );

}
add_action( 'init', 'custom_post_type_faq', 0 );

}


if ( ! function_exists('custom_post_type_team') ) {

// Register Custom Post Type
function custom_post_type_team() {

	$labels = array(
		'name'                  => _x( 'Team members', 'Post Type General Name', 'sumun' ),
		'singular_name'         => _x( 'Team member', 'Post Type Singular Name', 'sumun' ),
		'menu_name'             => __( 'Miembro del equipo', 'sumun-admin' ),
		'name_admin_bar'        => __( 'Miembros del equipo', 'sumun-admin' ),
		'add_new'               => __( 'Añadir nuevo Miembro del equipo', 'sumun-admin' ),
		'new_item'              => __( 'Nuevo Miembro del equipo', 'sumun-admin' ),
		'edit_item'             => __( 'Editar Miembro del equipo', 'sumun-admin' ),
		'update_item'           => __( 'Actualizar Miembro del equipo', 'sumun-admin' ),
		'view_item'             => __( 'Ver Miembro del equipo', 'sumun-admin' ),
		'view_items'            => __( 'Ver Miembro del equipo', 'sumun-admin' ),
		'featured_image'		=> __( 'Foto', 'sumun-admin' ),
		'set_featured_image'	=> __( 'Establecer Foto', 'sumun-admin' ),
		'remove_featured_image'	=> __( 'Quitar Foto', 'sumun-admin' ),
		'use_featured_image'	=> __( 'Usar como Foto', 'sumun-admin' ),
	);
	$args = array(
		'label'                 => __( 'Team members', 'sumun' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-id',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'taxonomies'			=> array(),
	);
	register_post_type( 'team', $args );

}
// add_action( 'init', 'custom_post_type_team', 0 );

}

if ( ! function_exists('custom_post_type_testimonio') ) {

// Register Custom Post Type
function custom_post_type_testimonio() {

	$labels = array(
		'name'                  => _x( 'Testimonios', 'Post Type General Name', 'sumun' ),
		'singular_name'         => _x( 'Testimonio', 'Post Type Singular Name', 'sumun' ),
		'menu_name'             => __( 'Testimonios', 'sumun-admin' ),
		'name_admin_bar'        => __( 'Testimonios', 'sumun-admin' ),
		'add_new'               => __( 'Añadir nuevo Testimonio', 'sumun-admin' ),
		'new_item'              => __( 'Nuevo Testimonio', 'sumun-admin' ),
		'edit_item'             => __( 'Editar Testimonio', 'sumun-admin' ),
		'update_item'           => __( 'Actualizar Testimonio', 'sumun-admin' ),
		'view_item'             => __( 'Ver Testimonio', 'sumun-admin' ),
		'view_items'            => __( 'Ver Testimonio', 'sumun-admin' ),
		'featured_image'		=> __( 'Foto de perfil', 'sumun-admin' ),
		'set_featured_image'	=> __( 'Establecer Foto de perfil', 'sumun-admin' ),
		'remove_featured_image'	=> __( 'Quitar Foto de perfil', 'sumun-admin' ),
		'use_featured_image'	=> __( 'Usar como Foto de perfil', 'sumun-admin' ),
	);
	$args = array(
		'label'                 => __( 'Testimonios', 'sumun' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 23,
		'menu_icon'             => 'dashicons-format-quote',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'taxonomies'			=> array(''),
	);
	register_post_type( 'testimonio', $args );

}
// add_action( 'init', 'custom_post_type_testimonio', 0 );

}

if ( ! function_exists('custom_taxonomy_marca') ) {

// Register Custom Taxonomy
function custom_taxonomy_marca() {

	$labels = array(
		'name'                       => _x( 'Marcas', 'Taxonomy General Name', 'huck' ),
		'singular_name'              => _x( 'Marca', 'Taxonomy Singular Name', 'huck' ),
		'menu_name'                  => __( 'Marcas', 'huck-admin' ),
		'all_items'                  => __( 'Todas las Marcas', 'huck-admin' ),
		'parent_item'                => __( 'Marca superior', 'huck-admin' ),
		'parent_item_colon'          => __( 'Marca superior:', 'huck-admin' ),
		'new_item_name'              => __( 'Nueva Marca', 'huck-admin' ),
		'add_new_item'               => __( 'Añadir nueva Marca', 'huck-admin' ),
		'edit_item'                  => __( 'Editar Marca', 'huck-admin' ),
		'update_item'                => __( 'Actualizar Marca', 'huck-admin' ),
		'view_item'                  => __( 'Ver Marca', 'huck-admin' ),
		'separate_items_with_commas' => __( 'Separar Marcas con comas', 'huck-admin' ),
		'add_or_remove_items'        => __( 'Añadir o quitar Marcas', 'huck-admin' ),
		'choose_from_most_used'      => __( 'Elegir de entre las más usadas', 'huck-admin' ),
		'popular_items'              => __( 'Marcas populares', 'huck-admin' ),
		'search_items'               => __( 'Buscar Marcas', 'huck-admin' ),
		'not_found'                  => __( 'No encontrado', 'huck-admin' ),
		'no_terms'                   => __( 'No hay Marcas', 'huck-admin' ),
		'items_list'                 => __( 'Lista de Marcas', 'huck-admin' ),
		'items_list_navigation'      => __( 'Navegación de la lista de Marcas', 'huck-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => false,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'brand', array( 'product' ), $args );

}
add_action( 'init', 'custom_taxonomy_marca', 10 );

}

if ( ! function_exists('custom_taxonomy_model_year') ) {

// Register Custom Taxonomy
function custom_taxonomy_model_year() {

	$labels = array(
		'name'                       => _x( 'Años del modelo', 'Taxonomy General Name', 'huck' ),
		'singular_name'              => _x( 'Año del modelo', 'Taxonomy Singular Name', 'huck' ),
		'menu_name'                  => __( 'Años del modelo', 'huck-admin' ),
		'all_items'                  => __( 'Todos los Años del modelo', 'huck-admin' ),
		'parent_item'                => __( 'Año del modelo superior', 'huck-admin' ),
		'parent_item_colon'          => __( 'Año del modelo superior:', 'huck-admin' ),
		'new_item_name'              => __( 'Nuevo Año del modelo', 'huck-admin' ),
		'add_new_item'               => __( 'Añadir nuevo Año del modelo', 'huck-admin' ),
		'edit_item'                  => __( 'Editar Año del modelo', 'huck-admin' ),
		'update_item'                => __( 'Actualizar Año del modelo', 'huck-admin' ),
		'view_item'                  => __( 'Ver Año del modelo', 'huck-admin' ),
		'separate_items_with_commas' => __( 'Separar Años del modelo con comas', 'huck-admin' ),
		'add_or_remove_items'        => __( 'Añadir o quitar Años del modelo', 'huck-admin' ),
		'choose_from_most_used'      => __( 'Elegir de entre los más usados', 'huck-admin' ),
		'popular_items'              => __( 'Años del modelo populares', 'huck-admin' ),
		'search_items'               => __( 'Buscar Años del modelo', 'huck-admin' ),
		'not_found'                  => __( 'No encontrado', 'huck-admin' ),
		'no_terms'                   => __( 'No hay Años del modelo', 'huck-admin' ),
		'items_list'                 => __( 'Lista de Años del modelo', 'huck-admin' ),
		'items_list_navigation'      => __( 'Navegación de la lista de Años del modelo', 'huck-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => false,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'product_year', array( 'product' ), $args );

}
add_action( 'init', 'custom_taxonomy_model_year', 10 );

}

if ( ! function_exists('custom_taxonomy_product_type') ) {

// Register Custom Taxonomy
function custom_taxonomy_product_type() {

	$labels = array(
		'name'                       => _x( 'Tipos de producto', 'Taxonomy General Name', 'huck' ),
		'singular_name'              => _x( 'Tipo de producto', 'Taxonomy Singular Name', 'huck' ),
		'menu_name'                  => __( 'Tipos de producto', 'huck-admin' ),
		'all_items'                  => __( 'Todos los Tipos de producto', 'huck-admin' ),
		'parent_item'                => __( 'Tipo de producto superior', 'huck-admin' ),
		'parent_item_colon'          => __( 'Tipo de producto superior:', 'huck-admin' ),
		'new_item_name'              => __( 'Nuevo Tipo de producto', 'huck-admin' ),
		'add_new_item'               => __( 'Añadir nuevo Tipo de producto', 'huck-admin' ),
		'edit_item'                  => __( 'Editar Tipo de producto', 'huck-admin' ),
		'update_item'                => __( 'Actualizar Tipo de producto', 'huck-admin' ),
		'view_item'                  => __( 'Ver Tipo de producto', 'huck-admin' ),
		'separate_items_with_commas' => __( 'Separar Tipos de producto con comas', 'huck-admin' ),
		'add_or_remove_items'        => __( 'Añadir o quitar Tipos de producto', 'huck-admin' ),
		'choose_from_most_used'      => __( 'Elegir de entre los más usados', 'huck-admin' ),
		'popular_items'              => __( 'Tipos de producto populares', 'huck-admin' ),
		'search_items'               => __( 'Buscar Tipos de producto', 'huck-admin' ),
		'not_found'                  => __( 'No encontrado', 'huck-admin' ),
		'no_terms'                   => __( 'No hay Tipos de producto', 'huck-admin' ),
		'items_list'                 => __( 'Lista de Tipos de producto', 'huck-admin' ),
		'items_list_navigation'      => __( 'Navegación de la lista de Tipos de producto', 'huck-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => false,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'product_type_code', array( 'product' ), $args );

}
add_action( 'init', 'custom_taxonomy_product_type', 10 );

}

if ( ! function_exists('custom_taxonomy_product_group') ) {

// Register Custom Taxonomy
function custom_taxonomy_product_group() {

	$labels = array(
		'name'                       => _x( 'Grupos de producto', 'Taxonomy General Name', 'huck' ),
		'singular_name'              => _x( 'Grupo de producto', 'Taxonomy Singular Name', 'huck' ),
		'menu_name'                  => __( 'Grupos de producto', 'huck-admin' ),
		'all_items'                  => __( 'Todos los Grupos de producto', 'huck-admin' ),
		'parent_item'                => __( 'Grupo de producto superior', 'huck-admin' ),
		'parent_item_colon'          => __( 'Grupo de producto superior:', 'huck-admin' ),
		'new_item_name'              => __( 'Nuevo Grupo de producto', 'huck-admin' ),
		'add_new_item'               => __( 'Añadir nuevo Grupo de producto', 'huck-admin' ),
		'edit_item'                  => __( 'Editar Grupo de producto', 'huck-admin' ),
		'update_item'                => __( 'Actualizar Grupo de producto', 'huck-admin' ),
		'view_item'                  => __( 'Ver Grupo de producto', 'huck-admin' ),
		'separate_items_with_commas' => __( 'Separar Grupos de producto con comas', 'huck-admin' ),
		'add_or_remove_items'        => __( 'Añadir o quitar Grupos de producto', 'huck-admin' ),
		'choose_from_most_used'      => __( 'Elegir de entre los más usados', 'huck-admin' ),
		'popular_items'              => __( 'Grupos de producto populares', 'huck-admin' ),
		'search_items'               => __( 'Buscar Grupos de producto', 'huck-admin' ),
		'not_found'                  => __( 'No encontrado', 'huck-admin' ),
		'no_terms'                   => __( 'No hay Grupos de producto', 'huck-admin' ),
		'items_list'                 => __( 'Lista de Grupos de producto', 'huck-admin' ),
		'items_list_navigation'      => __( 'Navegación de la lista de Grupos de producto', 'huck-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => false,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'product_group', array( 'product' ), $args );

}
add_action( 'init', 'custom_taxonomy_product_group', 10 );

}


function wpb_change_title_text( $title ){
     $screen = get_current_screen();
  
     if  ( 'portfolio_page' == $screen->post_type ) {
          $title = 'Título del proyecto';
     } elseif  ( 'slide' == $screen->post_type ) {
          $title = 'Título de la slide';
     } elseif  ( 'team' == $screen->post_type ) {
          $title = 'Nombre y apellidos';
     }
  
     return $title;
}
add_filter( 'enter_title_here', 'wpb_change_title_text' );

// ADD NEW COLUMN
add_filter('manage_posts_columns', 'sumun_columns_head', 10, 2);
// add_filter('manage_pages_columns', 'sumun_columns_head', 10, 2);
add_action('manage_posts_custom_column', 'sumun_columns_content', 10, 2);
add_action('manage_pages_custom_column', 'sumun_columns_content', 10, 2);
function sumun_columns_head($defaults, $post_type) {
	// $defaults = array('featured_image' => 'Imagen') + $defaults;
	if('product' != $post_type) $defaults['featured_image'] = 'Imagen';
    $defaults['extracto'] = 'Resumen';

    return $defaults;
}
 
// SHOW THE FEATURED IMAGE
function sumun_columns_content($column_name, $post_ID) {
    if ($column_name == 'featured_image') {
    	echo '<div style="height:100px;">' . get_the_post_thumbnail( $post_ID, array(80,80) ) . '</div>';

    }
    if ($column_name == 'extracto') {
    	$post = get_post($post_ID);
    	echo $post->post_excerpt;
    }
}





// add_filter('request', function( $vars ) {
//     global $wpdb;
//     if( ! empty( $vars['pagename'] ) || ! empty( $vars['category_name'] ) || ! empty( $vars['name'] ) || ! empty( $vars['attachment'] ) ) {
//         $slug = ! empty( $vars['pagename'] ) ? $vars['pagename'] : ( ! empty( $vars['name'] ) ? $vars['name'] : ( !empty( $vars['category_name'] ) ? $vars['category_name'] : $vars['attachment'] ) );
//         $slug_array = explode( '/', $slug );
//         $slug = array_values(array_slice($slug_array, -1))[0];
//         $exists = $wpdb->get_var( $wpdb->prepare( "SELECT t.term_id FROM $wpdb->terms t LEFT JOIN $wpdb->term_taxonomy tt ON tt.term_id = t.term_id WHERE tt.taxonomy = 'product_cat' AND t.slug = %s" ,array( $slug )));
//         if( $exists ){
//             $old_vars = $vars;
//             $vars = array('product_cat' => $slug );
//             if ( !empty( $old_vars['paged'] ) || !empty( $old_vars['page'] ) )
//                 $vars['paged'] = ! empty( $old_vars['paged'] ) ? $old_vars['paged'] : $old_vars['page'];
//             if ( !empty( $old_vars['orderby'] ) )
//                     $vars['orderby'] = $old_vars['orderby'];
//                 if ( !empty( $old_vars['order'] ) )
//                     $vars['order'] = $old_vars['order'];    
//         }
//     }
//     return $vars;
// });

// function wdm_remove_parent_category_from_url( $args ) {
//     $args['rewrite']['hierarchical'] = false;
//     return $args;
// }
// add_filter( 'woocommerce_taxonomy_args_product_cat', 'wdm_remove_parent_category_from_url' );

// Quita product de la url de ficha de producto
// add_filter( 'woocommerce_register_post_type_product', function($var) {
//     $var['rewrite'] = str_replace('/product/', '/', $var['rewrite']);
//     return $var;
// });

// Añade html a las fichas de producto
// add_action( 'registered_post_type', 'wpse_178112_permastruct_html', 10000, 2 );
function wpse_178112_permastruct_html( $post_type, $args ) {
    if ( $post_type === 'product' ) {
		// echo '<pre>'; print_r($args); echo '</pre>';
        add_permastruct( $post_type, "{$args->rewrite['slug']}/%$post_type%.html", $args->rewrite );
		// echo '<pre>'; print_r($args); echo '</pre>';
    }
}

// add_action( 'rewrite_rules_array', 'rewrite_rules' );
function rewrite_rules( $rules ) {
 
    $new_rules = array(
        '([^/]+)\.html$' => 'index.php?post_type=product&name=$matches[1]'
    );
    return $new_rules + $rules;
}
   
// add_filter( 'post_type_link', 'custom_post_permalink' ); // for cpt post_type_link (rather than post_link)
function custom_post_permalink ( $post_link ) {
    global $post;
    $type = get_post_type( $post->ID );
    if ( $type == 'product' ) {
        return home_url( $post->post_name . '.html' );       
    } else {
        return $post_link;
    }
 
}

?>