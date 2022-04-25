<?php
/**
 * Search results partial template.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class('mb-4 row align-items-center'); ?> id="post-<?php the_ID(); ?>">

	<div class="col-4 col-md-3 mb-3">

		<a href="<?php the_permalink(); ?>" rel="bookmark">

			<?php the_post_thumbnail(); ?>

		</a>

	</div>

	<header class="entry-header col-8 col-md-9 mb-3">

		<?php
		the_title(
			sprintf( '<p class="h3 mb-0 entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
			'</a></p>'
		);
		$pto = get_post_type_object( get_post_type() );
		echo '<span class="post-type-label">' . $pto->labels->singular_name . '</span>';
		
		?>

		<?php if ( 'post' == get_post_type() ) : ?>

			<div class="entry-meta">

				<?php understrap_posted_on(); ?>

			</div><!-- .entry-meta -->

		<?php endif; ?>

		<footer class="entry-footer">

			<?php //understrap_entry_footer(); ?>

		</footer><!-- .entry-footer -->

	</header><!-- .entry-header -->

</article><!-- #post-## -->
