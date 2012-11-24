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

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php if ( get_post_meta($post->ID, '_dw_former_name', true) ): ?>
							<h4>Former Title: <?php echo get_post_meta($post->ID, '_dw_former_name', true); ?></h4>
						<?php endif ?>
						<?php if ( get_post_meta($post->ID, '_dw_sculpture_url', true) ): ?>
						 <h4><a href="/art/artworks/sculpture">Return to Main Sculpture Page</a>: <a href="<?php echo get_post_meta($post->ID, '_dw_sculpture_url', true); ?>"><?php the_title(); ?></a></h4>
						<hr />
						<?php endif ?>
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', '_s' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->

				</article><!-- #post-<?php the_ID(); ?> -->
					<hr />
				<?php _s_content_nav( 'nav-below' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					// if ( comments_open() || '0' != get_comments_number() )
					// 					comments_template( '', true );
				?>

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary .site-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>