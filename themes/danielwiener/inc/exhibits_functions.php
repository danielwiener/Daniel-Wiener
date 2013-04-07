<?php
/**
 * Getting all the variables for exhibit related pages
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Daniel Wiener
 * @since Daniel Wiener 1.0
 */

 $exhibits_duration =  get_post_meta($post->ID, "_dw_duration", $single = true);?>
	<?php $exhibits_opening =  get_post_meta($post->ID, "_dw_opening", $single = true) ? '<li>Opening: ' . get_post_meta($post->ID, "_dw_opening", $single = true) . '</li>' : ''; ?>
	<?php $exhibits_curator =  get_post_meta($post->ID, "_dw_curated_by", $single = true) ? '<li>' . get_post_meta($post->ID, "_dw_curated_by", $single = true) . '</li>' : ''; ?>
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