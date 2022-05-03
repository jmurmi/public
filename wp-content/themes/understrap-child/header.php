<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<div class="site" id="page">

	<!-- ******************* The Navbar Area ******************* -->
	<div id="wrapper-navbar" class="fixed-top" itemscope itemtype="http://schema.org/WebSite">

		<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'understrap' ); ?></a>

		<div id="topbar" class="navbar navbar-expand navbar-dark bg-dark">
			<?php
			$topbar_logo_id = get_theme_mod( 'topbar_logo', false );
			if ($topbar_logo_id) {
				echo wp_get_attachment_image( $topbar_logo_id, 'full', false, array('class' => 'topbar-logo') );
			} else {
				//echo '<img src="'.get_stylesheet_directory_uri().'/img/logo-granviabikes.png" width="107" height="22">';
			} ?>
			<!--ocultamos buscador version pc-->
			<div class="d-none d-sm-block">
				<?php //get_search_form(); ?>
			</div>
			<!--ocultamos buscador version movil-->
			<!--<a class="d-sm-none text-white" href="#searchbar" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="searchbar">
				<i class="fa fa-search"></i>
			</a>-->

			<?php
			if(is_active_sidebar( 'topbar-right' )) {
				dynamic_sidebar( 'topbar-right' );
			}
			?>

		</div>

		<div id="searchbar" class="collapse bg-light py-3">
			<div class="container">
				<?php get_search_form(); ?>
			</div>
		</div>

		<nav class="navbar navbar-expand-lg navbar-light bg-light d-lg-none">

			<!-- Your site title as branding in the menu -->
			<?php if ( ! has_custom_logo() ) { ?>

				<a href="<?php echo get_home_url(); ?>" class="navbar-brand custom-logo-link default-logo" rel="home">
					<img src="<?php echo get_stylesheet_directory_uri() ?>/img/logo-granviabikes-negro.png" width="198" height="22" class="img-fluid" alt="<?php bloginfo('name'); ?>">
				</a> 

			<?php } else {
				the_custom_logo();
			} ?><!-- end custom logo -->

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdownMobile" aria-controls="navbarNavDropdownMobile" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap' ); ?>">
				<span class="navbar-toggler-icon"></span>
			</button>

				<!-- The WordPress Menu goes here -->
				<?php wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'container_class' => 'collapse navbar-collapse d-lg-none',
						'container_id'    => 'navbarNavDropdownMobile',
						'menu_class'      => 'navbar-nav ml-auto',
						'fallback_cb'     => '',
						'menu_id'         => 'main-menu',
						'depth'           => 2,
						'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
					)
				); ?>


		</nav><!-- .site-navigation -->

		<nav class="navbar navbar-expand-lg navbar-light bg-light d-none d-lg-flex">

			<!-- Your site title as branding in the menu -->
			<?php if ( ! has_custom_logo() ) { ?>

				<a href="<?php echo get_home_url(); ?>" class="navbar-brand custom-logo-link default-logo" rel="home">
					<img src="<?php echo get_stylesheet_directory_uri() ?>/img/logo-granviabikes-negro.png" width="198" height="22" class="img-fluid" alt="tienda de bicicletas en zaragoza">
				</a> 

			<?php } else {
				the_custom_logo();
			} ?><!-- end custom logo -->

				<!-- The WordPress Menu goes here -->
				<?php wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'container_class' => 'collapse navbar-collapse d-none d-lg-block',
						'container_id'    => 'navbarNavDropdown',
						'menu_class'      => 'navbar-nav ml-auto',
						'fallback_cb'     => '',
						'menu_id'         => 'main-menu',
						'depth'           => 2,
						'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
					)
				); ?>

		</nav><!-- .site-navigation -->

	</div><!-- #wrapper-navbar end -->

	<?php
	if (!is_singular( 'product' ) && !is_front_page() && !is_404()) {
		$titulo = false;
		$descripcion = false;
		$img_id = false;
		$style = '';

		if (is_singular()) {
			$titulo = get_the_title();
			$descripcion = wpautop( $post->post_excerpt, true );
			$img_id = get_post_thumbnail_id();
		} elseif ( is_archive() || is_tax()) {
			$titulo = get_the_archive_title();
			$descripcion = get_the_archive_description();
			// if( is_tax( 'product_cat' )) {
			// 	$img_id = get_term_meta( get_queried_object_id(), 'thumbnail_id', true ); 
			// } else {
				$img_id = get_term_meta( get_queried_object_id(), 'imagen_cabecera', true );
			// }
		}

		$class_cabecera = ($descripcion) ? 'con-descripcion' : 'sin-descripcion';

		if ($img_id) {
			$style = 'style="background-image:url('.wp_get_attachment_image_url( $img_id, 'full' ).');"';
		}

		echo '<div class="cabecera bg-cover '.$class_cabecera.'" '.$style.'>';
			echo '<div class="container">';
				echo '<div class="contenido-cabecera">';
					if( $titulo ) echo '<h1>'.$titulo.'</h1>';
					if ( $descripcion ) {
						echo '<div class="archive-description">' . $descripcion . '</div>';
					}
				echo '</div>';
			echo '</div>';
		echo '</div>';
	} else {
		echo '<div class="cabecera-vacia"></div>';
	}
	?>
