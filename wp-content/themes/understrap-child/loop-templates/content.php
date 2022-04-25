<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
global $wp_query;

$row_direction_class = ($wp_query->current_post % 2 == 0) ? 'flex-lg-row-reverse' : '';

$col_class = 'col-lg-6';
if (es_blog()) $col_class = 'col-xl-6';
?>

<article <?php post_class('row align-items-center mb-5 ' . $row_direction_class ); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header <?php echo $col_class; ?>">

		<?php echo get_the_post_thumbnail( $post->ID, 'large', array('class' => 'mb-4') ); ?>

	</header><!-- .entry-header -->


	<div class="entry-content <?php echo $col_class; ?>">

		<?php
		the_title(
			sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
			'</a></h2>'
		);
		?>

		<?php if ( 'post' == get_post_type() ) : ?>

			<div class="entry-meta">
				<?php understrap_posted_on(); ?>
			</div><!-- .entry-meta -->

		<?php endif; ?>

		<?php the_excerpt(); ?>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			)
		);
		?>

		<footer class="entry-footer">

			<?php //understrap_entry_footer(); ?>

		</footer><!-- .entry-footer -->

	</div><!-- .entry-content -->

</article><!-- #post-## -->
