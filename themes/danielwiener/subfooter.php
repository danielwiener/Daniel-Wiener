<div id="subfooter"><div id="subfooter_page">

<div class="column1">
	<?php if ( ! dynamic_sidebar( 'footer-column-1' ) ) : ?>
		<?php endif; ?>
 </div>

<div class="column1">
<h1><a href="<?php echo bloginfo('siteurl') . '/exhibits'; ?>">Exhibitions</a></h1>
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
<?php if ( get_post_meta($post->ID, "_dw_is_in_subfooter", $single = true)): ?>
<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>

	


<?php include('inc/exhibits_functions.php'); ?>

<ul>
								<li><?php echo $exhibits_duration; ?>, <a href="/is/years/<?php echo $dw_year_slug; ?>"><?php echo $dw_year_name ?></a></li>
								<?php echo $exhibits_opening; ?>
								<?php echo $exhibits_curator; ?>
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
<?php endif ?>
<?php endwhile; ?>
</div>

<div class="column1">
<h1>Website Design and Development</h1>
<p>Full service web site creation, specializing in portfolios for artists and ecommerce sites for small businesses. Reasonable prices. Personal Service.<br /><a href="/is/contact/">Contact me for a quote.</a><br /></p>
<h2>Examples:</h2>
<ul>
<li><a href="http://thesilo.raphaelrubinstein.com/" target="_blank">The Silo</a></li>
<li><a href="http://risd-sculpture.com/" target="_blank">RISD Sculpture Department (and sculpture student sites)</a></li>
<li><a href="http://www.haring.com" target="_blank">Keith Haring</a></li>
<li><a href="http://www.haringkids.com"  target="_blank">Keith Haring Kids</a></li>
<li><a href="http://www.haringkids.com/lesson_plans"  target="_blank">Haring Kids Lesson Plans</a></li>
<li><a href="http://www.billtjones.org" target="_blank">Bill T. Jones Dance Company</a></li>
<li><a href="http://www.embroideryarts.com" target="_blank">Embroidery Arts</a></li>
<li><a href="http://www.wholesalemonograms.com" target="_blank">Wholesale Monograms</a></li>
<li><a href="http://www.peterhedgeswriter.com" target="_blank">Peter Hedges</a></li>
<li><a href="http://www.lizaphillipsdesign.com" target="_blank">Liza Phillips Design</a></li>
<li><a href="http://www.davidhumphreynyc.com" target="_blank">David Humphrey (using WPFolio)</a></li>
<li><a href="http://www.leeboroson.com" target="_blank">Lee Boroson (using WPFolio)</a></li>
<li><a href="http://www.bengibberd.com" target="_blank">Ben Gibberd</a></li>
<li><a href="http://www.margeauxwalter.com/art/" target="_blank">Margeaux Walter</a></li>
<li><a href="http://www.fineartadoption.net" target="_blank">Maintain and update Fine Art Adoption Network</a></li>
</ul>
<h2>Designed:</h2>
<ul>
<li><a href="http://www.meredithmonk.org" target="_blank">Meredith Monk</a></li>
<li><a href="http://www.annepatterson.com"  target="_blank">Anne Patterson</a></li>
</ul>
<h1>Tutorials</h1>
<ul>
<li><a href="/is/projects/artist_website">Creating Artist Website, Step by Step</a></li>
<li><a href="/is/online_resources_artists/email-announcement-tutorial">Etiquette of Artist Email Announcements</a></li>
<li><a href="/is/online_resources_artists/dropio-upload-hi-res-images">Using Drop.io to Upload Hi-Res Images</a></li>
<li><a href="/is/tutorials/create_virtual_host_mac">Virtual Hosting on OS 10.5</a></li>
<li><a href="/is/open_source_sculpture/sculpture-center-trash-cans">Sculpture Center - Trash Cans</a></li>
<li><a href="/is/open_source_sculpture/algorithm-for-a-crazy-vase">Algorithm for a Crazy Vase</a></li>
<li><a href="/is/open_source_sculpture/blooming">Making a Green Vase</a></li>
</ul>
<h1>More Info</h1>
<ul>
<li><a href="/is/resume">Resume</a></li>
<li><a href="/is/statement">Statement</a></li>
<li><a href="/is/projects/open_source_sculpture">Projects</a></li>
<li><a href="/art/pages/links">Links</a></li>
</ul>



</div><br clear="both"/>

</div><!-- subfooter page end-->
</div><!-- subfooter end-->