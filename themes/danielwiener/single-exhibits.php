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

		<section id="primary" class="site-content">
			<div id="content" role="main">
			<?php include('inc/exhibits_functions.php'); ?>
			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title">Exhibits</h1>
				</header>

				<?php rewind_posts(); ?>


				<?php while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header">
							
							<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', '_s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
						</header><!-- .entry-header -->


						<div class="entry-summary">
						<ul class="flush_left">
							<li><small><a href="/is/exhibit_type/<?php echo $exhibit_type_slug ?>">[<?php echo $exhibit_type->name; ?>]</a></small></li>
							
							<li><?php echo $exhibits_duration; ?>, <a href="/is/years/<?php echo $dw_year_slug; ?>"><?php echo $dw_year_name ?></a></li>
							<?php echo $exhibits_opening; ?>
							<?php echo $exhibits_curator; ?>
							<li>&nbsp;</li>
								<li><?php if ($venue_url): ?>
								<a href="<?php echo $venue_url ?>">	
								<?php endif ?>
							<?php echo $venue_name; ?>
								<?php if ($venue_url): ?>
									</a>
								<?php endif ?></li>
							<li><?php echo $venue_address; ?></li>
							<?php $dw_state_display = ($dw_state_count > 1) ? '<a href="/is/state/' . $dw_state_slug . '">' . $dw_state_name . '</a>'  : $dw_state_name ; ?>
							<?php $dw_city_display = ($dw_city_count > 1) ? '<a href="/is/city/' . $dw_city_slug . '">' . $dw_city_name . '</a>'  : $dw_city_name ; ?>
							<li><?php echo $dw_city_display; ?>, <?php echo $dw_state_display; ?> <?php echo $venue_zip; ?></li>
							<li><?php echo $venue_phone; ?></li>
</ul>
							<?php if (get_post_meta($post->ID, "_dw_related_text", $single = true)): ?>
							<?php
							$exhibits_related_text =  get_post_meta($post->ID, "_dw_related_text", $single = true);
							$exhibits_related_text = wpautop($exhibits_related_text, true);
							echo $exhibits_related_text; ?>	
							<?php endif ?>
						</div><!-- .entry-summary -->

						<div class="entry-content">
							<hr />
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', '_s' ), 'after' => '</div>' ) ); ?>
						</div><!-- .entry-content -->

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

				<?php _s_content_nav( 'nav-below' );
				 ?>

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