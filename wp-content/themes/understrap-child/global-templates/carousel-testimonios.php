<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

	$args = array(
				'post_type'			=> 'testimonio',
				'posts_per_page'	=> -1,
				'orderby'			=> 'rand',
	);



	$query = new WP_Query($args);
	if ($query->have_posts()) {


		echo '<div id="carousel-testimonios" class="carousel slide" data-ride="carousel">';
			echo '<div class="carousel-inner">';
				$indicators = '';
				while ($query->have_posts()) { $query->the_post();
					global $post;
					$active_class = '';
					if( $query->current_post == 0 ) {
						$active_class = 'active';
					}

					$indicators .= '<li data-target="#carousel-testimonios" data-slide-to="'.$query->current_post.'" class="'.$active_class.'">';

					echo '<div class="carousel-item testimonio '.$active_class.'">';

						get_template_part( 'loop-templates/content-testimonio' );
						



					echo '</div>'; // .carousel-item
				}
			echo '</div>'; // .carousel-inner

			// echo '<ol class="carousel-indicators">';
			// 	echo $indicators;
			// echo '</ol>';
			?>
			<a class="carousel-control-prev" href="#carousel-testimonios" role="button" data-slide="prev">
			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="carousel-control-next" href="#carousel-testimonios" role="button" data-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>

		<?php

		echo '</div>'; // .carousel

		}
	wp_reset_postdata();
