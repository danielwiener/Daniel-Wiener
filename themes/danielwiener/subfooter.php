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
	<?php if ( ! dynamic_sidebar( 'footer-column-3' ) ) : ?>
		<?php endif; ?>
</div><br clear="both"/>

</div><!-- subfooter page end-->
</div><!-- subfooter end-->