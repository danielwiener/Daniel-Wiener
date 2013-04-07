<?php
/**
 * The template for displaying Archive page for Exhibits.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Daniel Wiener
 * @since Daniel Wiener 1.0
 */

get_header(); ?>

		<section id="full-width" class="site-content">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<?php
					$term_id = $wp_query->queried_object->term_id;
					
					$this_make = get_term( $term_id, 'make' );
					?>
					<h1 class="page-title"><?php echo $this_make->name; ?></h1>
				</header>

				
				<?php 
				/* Start the Loop */ ?>
				<div id="image_grid">
				<?php while ( have_posts() ) : the_post(); ?>

				



						
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
								<?php if(has_post_thumbnail()): ?>
							<?php the_post_thumbnail('thumbnail', array('class' => 'alignleft', 'title' => get_the_title() )); ?>
							<?php endif; ?>
								</a>
							
					
					
				<?php endwhile; ?>
</div>
			

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', '_s' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', '_s' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</section><!-- #primary .site-content -->

<?php // get_sidebar(); ?>
<?php get_footer(); ?>