<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Daniel Wiener
 * @since Daniel Wiener 1.0
 */

get_header(); ?>

		<div id="full-width" class="site-content">
			<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
					

						<nav role="navigation" id="nav-below" class="site-navigation post-navigation">	
						<?php 

							$make_terms = get_the_terms( $post->ID, 'make' );
								foreach ($make_terms as $make_term) {
									$make_name = $make_term->name;
									$make_slug = $make_term->slug;
								}
						// _s_content_nav( 'nav-below' ); ?>

								<h1 class="assistive-text">Post navigation</h1>
								
								<?php 
								// http://bucketpress.com/next-and-previous-post-link-in-same-custom-taxonomy
								$postlist_args = array(
								   'posts_per_page'  => -1,
								   'orderby'         => 'date', //change this once you add years
								   'order'           => 'ASC',
								   'post_type'       => 'artworks',
								   'make' => $make_slug
								); 
								$postlist = get_posts( $postlist_args );

								// get ids of posts retrieved from get_posts
								$ids = array();
								foreach ($postlist as $thepost) {
								   $ids[] = $thepost->ID;
								}

								// get and echo previous and next post in the same taxonomy        
								$thisindex = array_search($post->ID, $ids);
								$previd = $ids[$thisindex-1];
								$nextid = $ids[$thisindex+1];
								if ( !empty($previd) ) {
								   echo '<div class="nav-previous"><a rel="prev" href="' . get_permalink($previd). '" title="&larr; ' . get_the_title($previd) . '">' . get_the_post_thumbnail($previd, 'thumbnail') . '<br>&larr;Previous</a></div>';
								}
								// echo '<div class="nav-middle">Return to <a href="/is/make/' . $make_slug . '">' . $make_name . '</a></div>';
								if ( !empty($nextid) ) {
								   echo '<div class="nav-next"><a rel="next" href="' . get_permalink($nextid). '" title="' . get_the_title($nextid) . ' &rarr; ">' . get_the_post_thumbnail($nextid, 'thumbnail') . '<br>Next&rarr;</a></div>';
								}
								 ?>
							</nav><!-- #nav-below -->
								<h1 class="entry-title"><?php the_title(); ?></h1>
												</header><!-- .entry-header -->
					<div class="entry-content">

						<?php the_content(); ?>
						<?php if ( get_post_meta($post->ID, '_dw_former_name', true) ): ?>
							<h4>Former Title: <?php echo get_post_meta($post->ID, '_dw_former_name', true); ?></h4>
						<?php endif ?>
						<?php // if ( get_post_meta($post->ID, '_dw_sculpture_url', true) ): ?>
						 <!-- <h4><a href="/art/artworks/sculpture">Return to Main Sculpture Page</a>: <a href="<?php // echo get_post_meta($post->ID, '_dw_sculpture_url', true); ?>"><?php // the_title(); ?></a></h4> -->
						<!-- <hr /> -->
						<?php // endif ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', '_s' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->

				</article><!-- #post-<?php the_ID(); ?> -->
					<hr />
					<p>Genre: <a href="/is/make/<?php echo $make_slug ?>"><?php echo $make_name ; ?></a> | <?php echo get_the_term_list( $post->ID, 'types', 'Like: ', ', ', '' ); ?> | <?php echo get_the_term_list( $post->ID, 'places', 'Placed: ', ', ', '' ); ?> | <?php echo get_the_term_list( $post->ID, 'year_created', 'Year Created: ', ', ', '' ); ?></p>
					
			
				<?php
					// If comments are open or we have at least one comment, load up the comment template
					// if ( comments_open() || '0' != get_comments_number() )
					// 					comments_template( '', true );
				?>

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary .site-content -->

<?php // get_sidebar(); ?>
<?php get_footer(); ?>