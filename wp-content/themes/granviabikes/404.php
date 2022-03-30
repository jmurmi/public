<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="error-404-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row py-5 flex-md-row-reverse align-items-center">

			<div class="col-md-6 content-area" id="primary">

				<main class="site-main" id="main">

					<section class="error-404 not-found">

						<header class="page-header">

							<h1 class="page-title"><?php esc_html_e( 'Ups,', 'granviabikes' ); ?></h1>
							<p class="h3"><?php esc_html_e( 'No se puede encontrar la página.', 'granviabikes' ); ?></p>

						</header><!-- .page-header -->

						<div class="page-content">

							<p><?php esc_html_e( 'Si no tienes GPS para encontrarla, puedes usar este formulario, a ver si encuentras lo que buscas.', 'granviabikes' ); ?></p>

							<p><?php get_search_form(); ?></p>

							<p><?php esc_html_e( 'Aunque sabemos que a veces lo que buscamos es perdernos, parar la bici y mirar lo que nos rodea.', 'granviabikes' ); ?></p>

						</div><!-- .page-content -->

					</section><!-- .error-404 -->

				</main><!-- #main -->

			</div><!-- #primary -->

			<div class="col-md-6">
				
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/cabecera-404.jpg" loading="lazy" alt="Dos bicis mirando al horizonte" />

			</div>

		</div><!-- .row -->

		<?php
		$terms = get_terms( array(
			'taxonomy'		=> 'product_cat',
			'parent'		=> 0,
			'hide_empty'	=> 0,
		));

		if($terms) {
			echo '<p class="text-center">';
			foreach ($terms as $term) {
				echo '<a class="btn btn-outline-primary m-1" href="'.get_term_link( $term ).'">'.$term->name.'</a>';
			}
			echo '</p>';
		}

		?>

	</div><!-- #content -->

</div><!-- #error-404-wrapper -->

<?php get_footer(); ?>
