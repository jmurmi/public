<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class('card'); ?> id="post-<?php the_ID(); ?>">

<?php echo get_the_post_thumbnail( $post->ID, 'large', array('class' => 'card-img-top') ); ?>

	<header class="entry-header card-body">

		<?php
		the_title(
			sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
			'</a></h2>'
		);
		?>

		<?php if ( 'post' === get_post_type() ) : ?>

			<div class="entry-meta">
				<?php understrap_posted_on(); ?>
			</div><!-- .entry-meta -->

		<?php endif; ?>

	</header><!-- .entry-header -->

	

	<div class="entry-content card-body">

		<?php
		the_excerpt();
		understrap_link_pages();
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer card-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
