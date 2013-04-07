<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Daniel Wiener
 * @since Daniel Wiener 1.0
 */
?>
		<div id="secondary" class="widget-area" role="complementary">
			<?php do_action( 'before_sidebar' ); ?>
			<aside id="search" class="widget widget_search">
				<?php get_search_form(); ?>
			</aside> 
			
			<aside id="addthis" class="widget">
		
				<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style ">
				<a class="addthis_button_preferred_1"></a>
				<a class="addthis_button_preferred_2"></a>
				<a class="addthis_button_preferred_3"></a>
				<a class="addthis_button_preferred_4"></a>
				<a class="addthis_button_compact"></a>
				<a class="addthis_counter addthis_bubble_style"></a>
				</div>
				<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
				<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51074a053b83e3d4"></script>
				<!-- AddThis Button END -->
			</aside>
			<?php dw_posts_by_category('news'); 
			// dw_posts_by_category('exhibitions');?>
			<aside id="exhibits_sidebar" class="widget"><h1 class="widget-title"><a href="<?php echo site_url('/exhibits') ?>">Exhibits</a></h1><ul>
				<?php
					/* Sculptors Sidebar*/ 
					$args = array(
						'post_type' 		=> 'exhibits',
						'post_status' 		=> 'publish',
						'posts_per_page'	=> -1,
						'orderby'         => 'meta_value',
						'meta_key'		  => '_dw_begin_date',
						'order'           => 'DESC',
					);
					$archive_query = New WP_Query($args);
				    while ( $archive_query->have_posts() ) : $archive_query->the_post(); ?>
				           <li><a href="<?php the_permalink(); ?>"><?php short_title('&hellip;', 30); ?></a></li>
					<?php endwhile; ?>
				</ul></aside>
		<?php	dw_posts_by_category('open_source_sculpture');
			
			 ?>
			
			<aside id="sculptors" class="widget"><h1 class="widget-title"><a href="<?php echo site_url('/sculptors') ?>">Sculptors</a></h1><ul>
				<?php
					/* Sculptors Sidebar*/ 
					$args = array(
						'post_type' 		=> 'sculptors',
						'post_status' 		=> 'publish',
						'posts_per_page'	=> -1, 
					);
					$archive_query = New WP_Query($args);
				    while ( $archive_query->have_posts() ) : $archive_query->the_post(); ?>
				           <li><a href="<?php the_permalink(); ?>" title="Read <?php the_title(); ?>"><?php the_title(); ?></a></li>
					<?php endwhile; ?>
				</ul></aside>
			
			<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

				<aside id="search" class="widget widget_search">
					<?php get_search_form(); ?>
				</aside>

				<aside id="archives" class="widget">
					<h1 class="widget-title"><?php _e( 'Archives', '_s' ); ?></h1>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>

				<aside id="meta" class="widget">
					<h1 class="widget-title"><?php _e( 'Meta', '_s' ); ?></h1>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</aside>

			<?php endif; // end sidebar widget area ?>
		</div><!-- #secondary .widget-area -->
