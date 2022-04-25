<?php 
/**
* Crear panel de opciones en el customizador
*/
function moore_new_customizer_settings($wp_customize) {

    $wp_customize->add_setting('topbar_logo');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'topbar_logo', array(
            'label' => 'Logo topbar',
            'section' => 'title_tagline',
            'settings' => 'topbar_logo',
            'priority' => 8 // show it just below the custom-logo
    )));

    $web_title = get_bloginfo( 'name' );
    // create settings section
    $wp_customize->add_panel('moore_opciones', array(
        'title'         => $web_title . ': ' . __( 'Opciones de configuración', 'moore-admin' ),
        'description'   => __( 'Opciones para este sitio web', 'moore-admin' ),
        'priority'      => 1,
    ));
    $wp_customize->add_section('moore_redes_sociales', array(
        'title'         => __( 'Redes sociales', 'moore-admin' ),
        'priority'      => 20,
        'panel'         => 'moore_opciones',
    ));
    $wp_customize->add_section('moore_ajustes', array(
        'title'         => __( 'Otros ajustes', 'moore-admin' ),
        'priority'      => 20,
        'panel'         => 'moore_opciones',
    ));



    $redes_sociales = array(
        'email',
        'whatsapp',
        'linkedin',
        'twitter',
        'facebook',
        'instagram',
        'youtube',
        'skype',
        'pinterest',
        'flickr',
        'blog',
    );
    foreach ($redes_sociales as $red) {
        // add a setting
        $wp_customize->add_setting($red);
        
        // Add a control
        $wp_customize->add_control( $red,   array(
            'type'      => 'text',
            'label'     => 'URL ' . $red,
            'section'   => 'moore_redes_sociales',
        ) );
    }


    $wp_customize->add_setting('info_privacidad_formularios');
    $wp_customize->add_control( 'info_privacidad_formularios',   array(
        'type'      => 'textarea',
        'label'     => 'Información básica de privacidad para formularios',
        'description' => 'Esta información se puede reproducir en cualquier lugar con el shortcode [info_basica_privacidad].',
        'section'   => 'moore_ajustes',
    ) );

    $wp_customize->add_setting('aviso_productos_en_stock');
    $wp_customize->add_control( 'aviso_productos_en_stock',   array(
        'type'      => 'textarea',
        'label'     => 'Aviso en los productos en stock',
        'description' => 'Aparece en la ficha de producto cuando está en stock. Para avisar, por ejemplo, de posibles retrasos en los plazos de entrega.',
        'section'   => 'woocommerce_store_notice',
    ) );

    $wp_customize->add_setting('activar_aviso_productos_en_stock');
    $wp_customize->add_control( 'activar_aviso_productos_en_stock',   array(
        'type'      => 'checkbox',
        'label'     => 'Activar aviso en los productos en stock',
        'section'   => 'woocommerce_store_notice',
    ) );

    $wp_customize->add_setting('aviso_productos_sin_stock');
    $wp_customize->add_control( 'aviso_productos_sin_stock',   array(
        'type'      => 'textarea',
        'label'     => 'Aviso en los productos fuera de stock',
        'description' => 'Aparece en la ficha de producto cuando está fuera de stock. Para avisar, por ejemplo, de posibilidades para reservar o no.',
        'section'   => 'woocommerce_store_notice',
    ) );

    $wp_customize->add_setting('activar_aviso_productos_sin_stock');
    $wp_customize->add_control( 'activar_aviso_productos_sin_stock',   array(
        'type'      => 'checkbox',
        'label'     => 'Activar aviso en los productos fuera de stock',
        'section'   => 'woocommerce_store_notice',
    ) );


}
add_action('customize_register', 'moore_new_customizer_settings');
/***/
