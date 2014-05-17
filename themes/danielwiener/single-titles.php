<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Daniel Wiener
 * @since Daniel Wiener 1.0
 */

get_header(); ?>

		<div id="primary" class="site-content">
			<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php // _s_content_nav( 'nav-above' ); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>

						<div class="entry-meta">
							<?php _s_posted_on(); ?>
						</div><!-- .entry-meta -->
					</header><!-- .entry-header -->

					<div class="entry-content">
						<h4>Former Title: <?php echo get_post_meta($post->ID, '_dw_former_name', true); ?></h4>
						 <h4>View Sculpture: <a href="<?php echo get_post_meta($post->ID, '_dw_sculpture_url', true); ?>"><?php the_title(); ?></a></h4>
						<hr />
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', '_s' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->

					<footer class="entry-meta">
						<!-- Maybe Something Later -->
					</footer><!-- .entry-meta -->
				</article><!-- #post-<?php the_ID(); ?> -->

				<?php _s_content_nav( 'nav-below' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template( '', true );
				?>

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary .site-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>