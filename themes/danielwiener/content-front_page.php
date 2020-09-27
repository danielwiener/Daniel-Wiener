<?php
/**
 * The template used for displaying content in front-page.php and the root file index.php outside the wp folder
 *
 * @package Daniel Wiener
 * @since Daniel Wiener 1.5
 */
?>
		<div class="entry-content">
	<!--<center><img src="<?php // echo get_template_directory_uri() ?>/images/out-crowd-2-low.jpg" class="responsive"></center> -->
	<div id="content" role="main">
		
	

		<?php  while ( have_posts() ) : the_post(); ?>
			<div class="entry-content"> 
				<?php  the_content(); ?>
				

		</div> <!-- .entry-content -->

		<?php  endwhile; // end of the loop. ?>

	</div><!-- #content -->
