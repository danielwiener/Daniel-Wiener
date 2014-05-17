<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Daniel Wiener
 * @since Daniel Wiener 1.0
 */

get_header(); ?>

		<div id="primary" class="site-content">
			<div id="content" role="main">

			
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header">
							<h1 class="entry-title"><?php the_title(); ?></h1>
						</header><!-- .entry-header -->

						<div class="entry-content">
							<div id="resume">
							<ul>
							<li><strong>born in 1954</strong></li>
							<li>raised in West Covina and Claremont, California</li>
							<li><strong>1974-1975</strong></li>
							<li>Brown University, Rhode Island</li>
							<li><strong>1975-1977</strong></li>
							<li>University of California, Berkeley, B.A.</li>
							<li><strong>1982-1983</strong></li>
							<li>Whitney Museum Independent Study Program</li>
							</ul>
							<hr />
							<h2>Awards/Fellowships</h2>
							<ul>
							<li><strong>2013</strong></li>
							<li><a href="http://alpertawards.org/about/residency-prizes" title="Residency Prizes | The Alpert Award in the Arts">Alpert Award Ucross Residency</a></li>
							<li><strong>2012</strong></li>
							<li><a href="http://www.gf.org/fellows/17327-daniel-wiener" title="Daniel Wiener - 
							    John Simon Guggenheim Memorial Foundation">Guggenheim Fellowship</a></li>
							<li><strong>2005</strong></li>
							<li><a href="http://pilchuck.com/residencies/residencies_overview.aspx" title="Pilchuck Glass School : Residencies Overview">Artist in Residence – Pilchuck</a></li>
							<li><strong>1995</strong></li>
							<li><a href="http://www.nyfa.org/" title="New York Foundation for the Arts (NYFA)">New York Foundation for the Arts Grant</a></li>
							<li><strong>1981</strong></li>
							<li><a href="http://yaddo.org/" title="Yaddo: A Retreat for Artists in Saratoga Springs, New York">Residence at Yaddo</a></li>
							</ul>
							<hr />
							<?php 
								$args = array(
										'post_type'		  => 'exhibits',
										'orderby'         => 'meta_value',
										'meta_key'		  => '_dw_begin_date',
										'order'           => 'DESC', 

								);
								$exhibit_query = New WP_Query($args); 

							/* Start the Loop */ ?>
							<?php while ( $exhibit_query->have_posts() ) : $exhibit_query->the_post(); ?>
							




							<?php include('inc/exhibits_functions.php'); ?>

							<ul>
								<h3><a href="/is/years/<?php echo $dw_year_slug; ?>"><?php echo $dw_year_name ?></a></li></h3>
								<li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
									<li><?php if ($venue_url): ?>
									<a href="<?php echo $venue_url ?>">	
									<?php endif ?>
								<?php echo $venue_name; ?>
									<?php if ($venue_url): ?>
										</a>
									<?php endif ?>, 
										<?php $dw_state_display = ($dw_state_count > 1) ? '<a href="/is/state/' . $dw_state_slug . '">' . $dw_state_name . '</a>'  : $dw_state_name ; ?>
										<?php $dw_city_display = ($dw_city_count > 1) ? '<a href="/is/city/' . $dw_city_slug . '">' . $dw_city_name . '</a>'  : $dw_city_name ; ?>
										<?php echo $dw_city_display; ?>, <?php echo $dw_state_display; ?>
											<?php echo $exhibits_curator; ?>
									</li>							
								</ul>
															<?php if (get_post_meta($post->ID, "_dw_related_text", $single = true)): ?>
															<?php
															$exhibits_related_text =  get_post_meta($post->ID, "_dw_related_text", $single = true);
															$exhibits_related_text = wpautop($exhibits_related_text, true);
															echo $exhibits_related_text; ?>	
															<?php endif ?>
						
							<?php endwhile; ?>
							</div>
								<?php while ( have_posts() ) : the_post(); ?>
							
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', '_s' ), 'after' => '</div>' ) ); ?>
							<?php edit_post_link( __( 'Edit', '_s' ), '<span class="edit-link">', '</span>' ); ?>
						</div><!-- .entry-content -->
					</article><!-- #post-<?php the_ID(); ?> -->

					<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary .site-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>