<?php
/**
 * The template used for displaying content in front-page.php and the root file index.php outside the wp folder
 *
 * @package Daniel Wiener
 * @since Daniel Wiener 1.5
 */
?>
	<div class="images">
		<?php
		$args = array(
			'post_type' 		=> array('titles', 'exhibits', 'post', 'page', 'sculptors'),
			'post_status' 		=> 'publish',			
			'meta_query' => array(
											array(
												'key' => '_dw_is_front_page_slides',
												'value' => 'on',
											)
										),
						// 'orderby'         => 'meta_value',
						// 								'meta_key'		  => '_dw_slide_order',
						// 								'order'           => 'ASC',
		);
		$front_query = New WP_Query($args);
		$slidetabs = ''; ?>
		<?php while ( 	$front_query->have_posts() ) : 	$front_query->the_post(); ?>
			<?php $current_category = get_the_category($post->ID); ?>

		<div>
					<?php if(has_post_thumbnail()): ?>
						<a href="<?php the_permalink(); ?>"  class="slide_container"><?php the_post_thumbnail('full'); ?></a>
						<?php endif; ?>
						<h4><?php echo $current_category[0]->cat_name; ?> >> <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"> <?php the_title(); ?><?php if(get_post_meta($post->ID, "Date", $single = true) != "") {
						$visiting_artist_date = get_post_meta($post->ID, "Date", $single = true);
						echo ', ' . $visiting_artist_date;
						$formatted_date = strtotime($visiting_artist_date);
						}
						?></a></h4>
					</div><!-- div no class -->
			<?php $slidetabs .= '<a href="#"></a>'; ?>
				<?php endwhile; // End the loop.
				wp_reset_query();?></div><!-- images -->

<!-- <a class="backward">prev</a><a class="forward">next</a> -->
<div class="slidetabs">
		<?php echo $slidetabs ?>
		</div> <!-- slidetabs -->

	<!-- <div class="buttons">
		<button onClick='jQuery(".slidetabs").data("slideshow").play();'>Play</button>
		<button onClick='jQuery(".slidetabs").data("slideshow").stop();'>Stop</button>
	</div> -->


	<script language="JavaScript">
	// What is $(document).ready ? See: http://flowplayer.org/tools/documentation/basics.html#document_ready
	//jQuery.noConflict();
	jQuery(function()  {

	jQuery(".slidetabs").tabs(".images > div", {

		// enable "cross-fading" effect
		effect: 'fade',
		fadeOutSpeed: "slow",

		// start from the beginning after the last tab
		rotate: true

	// use the slideshow plugin. It accepts its own configuration
	}).slideshow({ interval: 5000} );
	setTimeout('$(".slidetabs").data("slideshow").play();', 2000);
	});
	</script>