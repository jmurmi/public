<?php 
/* Widget areas */

function understrap_widgets_init() {
    register_sidebar(
        array(
            'name'          => __( 'Top bar derecha', 'understrap' ),
            'id'            => 'topbar-right',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div><!-- .footer-widget -->',
            'before_title'  => '<p class="h3 widget-title">',
            'after_title'   => '</p>',
        )
    );

    register_sidebar(
        array(
            'name'          => __( 'Right Sidebar', 'understrap' ),
            'id'            => 'right-sidebar',
            'description'   => __( 'Right sidebar widget area', 'understrap' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<p class="h3 widget-title">',
            'after_title'   => '</p>',
        )
    );

    register_sidebar(
        array(
            'name'          => __( 'Left Sidebar', 'understrap' ),
            'id'            => 'left-sidebar',
            'description'   => __( 'Left sidebar widget area', 'understrap' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<p class="h3 widget-title">',
            'after_title'   => '</p>',
        )
    );



    register_sidebar(
        array(
            'name'          => __( 'Pre footer', 'understrap' ),
            'id'            => 'prefooter',
            'description'   => __( 'Aparece antes del Pie de Página Completo', 'understrap' ),
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s dynamic-classes">',
            'after_widget'  => '</div><!-- .footer-widget -->',
            'before_title'  => '<p class="h3 widget-title">',
            'after_title'   => '</p>',
        )
    );

    register_sidebar(
        array(
            'name'          => __( 'Footer Full', 'understrap' ),
            'id'            => 'footerfull',
            'description'   => __( 'Full sized footer widget with dynamic grid', 'understrap' ),
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s dynamic-classes">',
            'after_widget'  => '</div><!-- .footer-widget -->',
            'before_title'  => '<p class="h3 widget-title">',
            'after_title'   => '</p>',
        )
    );

    register_sidebar(
        array(
            'name'          => __( 'Copyright', 'understrap' ),
            'id'            => 'copyright',
            'description'   => __( 'Full sized footer widget with dynamic grid', 'understrap' ),
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s dynamic-classes">',
            'after_widget'  => '</div><!-- .footer-widget -->',
            'before_title'  => '<p class="h3 widget-title">',
            'after_title'   => '</p>',
        )
    );

}

/***/

/* Site info */
add_action( 'understrap_site_info', 'understrap_add_site_info' );

/**
 * Add site info content.
 */
function understrap_add_site_info() {
    if (is_active_sidebar( 'copyright' )) {
        echo '<div class="row">';
            dynamic_sidebar( 'copyright' );
        echo '</div>';
    }
}

/***/