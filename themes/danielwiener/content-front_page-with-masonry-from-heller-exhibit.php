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
		
		<div class="entry-content">
		<h2 style="text-align: center;"><strong><em>Wide-Eyed &amp; Open-Mouthed</em></strong> at Lesley Heller Gallery
		September 4th - October 20th, 2019</h2>
		
		<p style="text-align: center;"><a href="https://bombmagazine.org/articles/the-space-of-intimacy-daniel-wiener-interviewed/">Bomb Magazine: The Space of Intimacy</a>: Daniel Wiener Interviewed by <a href="http://www.fawnkrieger.com/">Fawn Krieger</a></p>
		
		</div>

		<?php // while ( have_posts() ) : the_post(); ?>
			<!-- ><div class="entry-content"> -->
				<?php // the_content(); ?>
				

		<!--	</div> --><!-- .entry-content -->

		<?php // endwhile; // end of the loop. ?>

	</div><!-- #content -->

		<div  class="row" id="ms-container">
				<?php 	
				$images = get_children( array('post_parent' => 884, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 		'order' => 'ASC', 'orderby' => 'menu_order ID') );

				foreach ($images as $image) : ?>
				
				
					<div class="ms-item">
						
						
					
					<img src="<?php echo wp_get_attachment_url($image->ID); // url of the full size image. ?>">
					</div>
				<?php 	endforeach;  ?>
				</div>
				<script type="text/javascript">
				//http://www.wpdevsolutions.com/implement-masonry-in-wordpress/
				jQuery(window).load(function() {

				// MASSONRY Without jquery
				var container = document.querySelector('#ms-container');
				var msnry = new Masonry( container, {
				  itemSelector: '.ms-item',
				  columnWidth: '.ms-item',                
				});  

				  });
				</script>	