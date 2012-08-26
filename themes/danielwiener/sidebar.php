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
			<?php dw_posts_by_category('news');
			dw_posts_by_category('exhibitions');
			dw_posts_by_category('open_source_sculpture');
			
			 ?>
			
			<aside id="sculptors" class="widget"><h1 class="widget-title"><a href="<?php echo site_url('/sculptors') ?>">Sculptors</a></h1><ul>
				<?php
					/* Sculptors Sidebar*/ 
					$args = array(
						'post_type' 		=> 'sculptors',
						'post_status' 		=> 'publish',
						'posts_per_page'	=> -1,
						'orderby'			=> 'title',
						"order"				=> 'ASC', 
					);
					$archive_query = New WP_Query($args);
				    while ( $archive_query->have_posts() ) : $archive_query->the_post(); ?>
				           <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
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
