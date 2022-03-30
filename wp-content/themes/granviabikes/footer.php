<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php if ( is_active_sidebar( 'prefooter' ) ) : ?>

	<!-- ******************* The Footer Full-width Widget Area ******************* -->

	<div class="wrapper bg-light" id="wrapper-prefooter">

		<div class="<?php echo esc_attr( $container ); ?>" id="prefooter-content" tabindex="-1">

			<div class="row">

				<?php dynamic_sidebar( 'prefooter' ); ?>

			</div>

		</div>

	</div><!-- #wrapper-footer-full -->

<?php endif; ?>


<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_attr( $container ); ?>">

		<div class="row">

			<div class="col-md-12">

				<footer class="site-footer" id="colophon">

					<div class="site-info">

						<?php understrap_site_info(); ?>

					</div><!-- .site-info -->

				</footer><!-- #colophon -->

			</div><!--col end -->

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

