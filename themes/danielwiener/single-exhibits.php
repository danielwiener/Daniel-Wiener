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

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title">Exhibits</h1>
				</header>

				<?php rewind_posts(); ?>

				<?php //_s_content_nav( 'nav-above' ); ?>

				<?php 
				// global $wp_query;
				// 		$args = array_merge( $wp_query->query,
				// 			array(
				// 				'orderby'         => 'meta_value',
				// 				'meta_key'		  => '_dw_begin_date',
				// 				'order'           => 'DESC', 
				// 			)	
				// 		); 
				//  	query_posts( $args );
				/* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header">
							
							<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', '_s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
						</header><!-- .entry-header -->


						<div class="entry-summary">
							<?php $exhibits_duration =  get_post_meta($post->ID, "_dw_duration", $single = true);?>
							<?php $exhibits_opening =  get_post_meta($post->ID, "_dw_opening", $single = true) ? '<li>Opening: ' . get_post_meta($post->ID, "_dw_opening", $single = true) . '</li>' : ''; ?>
							<?php $exhibits_curator =  get_post_meta($post->ID, "_dw_curated_by", $single = true) ? '<li>&nbsp;</li><li>' . get_post_meta($post->ID, "_dw_curated_by", $single = true) . '</li>' : ''; ?>
							<?php $venue_list = wp_get_post_terms($post->ID, 'venues', array("fields" => "all"));
														 								foreach ($venue_list as $venue) {
														 								$venue_name = $venue->name;
																						$venue_slug = $venue->slug;
																						$venue_id = $venue->term_id;
																						$venue_meta =  get_option("taxonomy_$venue_id"); 
																						$venue_address = $venue_meta['dw_venue_address'];
																						$venue_phone = $venue_meta['dw_venue_phone'];
																						$venue_url = $venue_meta['dw_venue_url'];
																						$venue_zip = $venue_meta['dw_venue_zip'];
														 								}
							$city_list = wp_get_post_terms($post->ID, 'dw_cities', array("fields" => "all"));
								foreach ($city_list as $dw_city) {
									$dw_city_name = $dw_city->name;
									$dw_city_slug = $dw_city->slug;
									$dw_city_id = $dw_city->term_id;
									$dw_city_count = $dw_city->count;
								}
							$state_list = wp_get_post_terms($post->ID, 'dw_states', array("fields" => "all"));
								foreach ($state_list as $dw_state) {
									$dw_state_name = $dw_state->name;
									$dw_state_slug = $dw_state->slug;
									$dw_state_id = $dw_state->term_id;
									$dw_state_count = $dw_state->count;
								}
							$years_list = wp_get_post_terms($post->ID, 'dw_years', array("fields" => "all"));
								foreach ($years_list as $dw_year) {
									$dw_year_name = $dw_year->name;
									$dw_year_slug = $dw_year->slug;
									$dw_year_id = $dw_year->term_id;
									$dw_year_count = $dw_year->count;
								}
							$exhibit_types = wp_get_post_terms($post->ID, 'dw_exhibit_types', array("fields" => "all"));
								foreach ($exhibit_types as $exhibit_type) {
									$exhibit_type_name = $exhibit_type->name;
									$exhibit_type_slug = $exhibit_type->slug;
									$exhibit_type_id = $exhibit_type->term_id;
									$exhibit_type_count = $exhibit_type->count;

								}
							?>
							<small><a href="/is/exhibit_type/<?php echo $exhibit_type_slug ?>">[<?php echo $exhibit_type->name; ?>]</a></small>
							<ul>
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