<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Daniel Wiener
 * @since Daniel Wiener 1.0
 */

get_header(); ?>

		<section id="primary" class="site-content">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title">Exhibits</h1>
				</header>

				<?php rewind_posts(); ?>

				<?php _s_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header">
							<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', '_s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
						</header><!-- .entry-header -->


						<div class="entry-summary">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
							<?php the_post_thumbnail('thumbnail', array('class' => 'alignleft', 'title' => get_the_title() )); ?>
							</a>
							<?php $exhibits_duration =  get_post_meta($post->ID, "_dw_duration", $single = true) ? '_' . get_post_meta($post->ID, "_dw_duration", $single = true) : ''; ?>
							<?php $exhibits_opening =  get_post_meta($post->ID, "_dw_opening", $single = true) ? '_' . get_post_meta($post->ID, "_dw_opening", $single = true) : ''; ?>
							<?php $exhibits_opening =  get_post_meta($post->ID, "_dw_opening", $single = true) ? '_' . get_post_meta($post->ID, "_dw_opening", $single = true) : ''; ?>
							<?php // $exhibit_venue = get_term_by('name', get_query_var( 'term' ), 'venues'); ?>
							<?php $term_list = wp_get_post_terms($post->ID, 'venues', array("fields" => "all"));
														 								foreach ($term_list as $zit) {
														 									echo 'zit: ' . $zit->name . ' end<br>';
																						$venue_id = $zit->term_id;
																						echo $venue_id;
																						 $crap =  get_option("taxonomy_$venue_id"); 
																						echo $crap['dw_venue_address']. '<br>';
																						echo $crap['dw_venue_phone']. '<br>';
																						echo $crap['dw_venue_url']. '<br>';
														 								}
													
								?>
							<?php echo $exhibits_duration; ?><br>
							Opening: <?php echo $exhibits_opening; ?><br>
							<?php echo $exhibit_venue; ?>
							<?php the_excerpt(); ?> 
						</div><!-- .entry-summary -->


						<footer class="entry-meta">
							<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
								<?php
									/* translators: used between list items, there is a space after the comma */
									$categories_list = get_the_category_list( __( ', ', '_s' ) );
									if ( $categories_list && _s_categorized_blog() ) :
								?>
								<span class="cat-links">
									<?php printf( __( '%1$s', '_s' ), $categories_list ); ?>
								</span>
								<span class="sep"> | </span>
								<?php endif; // End if categories ?>

								<?php
									/* translators: used between list items, there is a space after the comma */
									$tags_list = get_the_tag_list( '', __( ', ', '_s' ) );
									if ( $tags_list ) :
								?>
								<span class="tag-links">
									<?php printf( __( ' %1$s', '_s' ), $tags_list ); ?>
								</span>
								<span class="sep"> | </span>
								<?php endif; // End if $tags_list ?>
							<?php endif; // End if 'post' == get_post_type() ?>

							<?php if ( comments_open() || ( '0' != get_comments_number() && ! comments_open() ) ) : ?>
							<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', '_s' ), __( '1 Comment', '_s' ), __( '% Comments', '_s' ) ); ?></span>
							<span class="sep"> | </span>
							<?php endif; ?>

							<?php edit_post_link( __( 'Edit', '_s' ), '<span class="edit-link">', '</span>' ); ?>
						</footer><!-- #entry-meta -->
					</article><!-- #post-<?php the_ID(); ?> --> 
					 <hr />
				<?php endwhile; ?>

				<?php _s_content_nav( 'nav-below' ); ?>

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

<?php get_sidebar(); ?>
<?php get_footer(); ?>