<?php
/**
 * Hero setup.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<?php
$args = array(
	'post_type'			=> 'slide',
	'posts_per_page'	=> -1,
	'orderby'			=> 'menu_order',
	'order'				=> 'ASC',

);

$q = new WP_Query($args);

if ($q->have_posts()) {

	$indicators = '';

	echo '<div id="slider-home" class="carousel slide" data-ride="carousel" data-interval="7000">';
		echo '<div class="carousel-inner">';

			while( $q->have_posts() ) {
				$q->the_post();
				$slide_actual = $q->current_post;
				$class_active = '';
				if ($slide_actual == 0) {
					$class_active = 'active';
				}

				$bg_url = get_the_post_thumbnail_url( null, 'large' );

				echo '<div class="carousel-item bg-dark bg-cover '.$class_active.'" style="background-image:url('.$bg_url.');">';
					echo '<div class="slide-wrapper">';
						echo '<div class="container">';
							echo '<div class="slide-content-wrapper">';
								the_title( '<div class="slide-title">', '</div>');
								echo '<div class="slide-content">';
									the_content();
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';

				echo '</div>';

				$indicators .= '<li data-target="#slider-home" data-slide-to="'.$slide_actual.'" class="'.$class_active.'"></li>';
			}

		echo '</div>';
		
		if ( '' != $indicators ) echo '<ol class="carousel-indicators">'.$indicators.'</ol>';
		/* echo '  <a class="carousel-control-prev" href="#slider-home" role="button" data-slide="prev">
			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="carousel-control-next" href="#slider-home" role="button" data-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>'; */

		// echo do_shortcode( '[el_tiempo]' );

	echo '</div>';

	wp_reset_postdata();
}
