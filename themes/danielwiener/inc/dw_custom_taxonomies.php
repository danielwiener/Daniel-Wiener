<?php
// Custom Taxonomy Code  
add_action( 'init', 'build_taxonomies', 0 );  
if ( ! function_exists( 'build_taxonomies' ) ):

	function build_taxonomies() {  
/**
 * FOR Exhibits
 * Venue
 */	
	 $labels = array(
    'name' => _x( 'Venues', 'taxonomy general name' ),
    'singular_name' => _x( 'Venue', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Venues' ),
    'popular_items' => __( 'Popular Venues' ),
    'all_items' => __( 'All Venues' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Venue' ), 
    'update_item' => __( 'Update Venue' ),
    'add_new_item' => __( 'Add Venue' ),
    'new_item_name' => __( 'New Venue Name' ),
  ); 

	register_taxonomy(
	'venues',
	'exhibits',
		array( 'hierarchical' => true,
		'labels' => $labels,
		'query_var' => true,
		'show_ui' => true,
		'public' => true,
		'show_in_nav_menus' => true,
		'rewrite' => array( 'slug' => 'venues',
							'with_front' => false,
							'hierarchical' => 'true',
							) ) ); 
							
 

	 $labels = array(
	   'name' => _x( 'Cities', 'taxonomy general name' ),
	   'singular_name' => _x( 'City', 'taxonomy singular name' ),
	   'search_items' =>  __( 'Search Cities' ),
	   'popular_items' => __( 'Popular Cities' ),
	   'all_items' => __( 'All Cities' ),
	   'parent_item' => null,
	   'parent_item_colon' => null,
	   'edit_item' => __( 'Edit City' ), 
	   'update_item' => __( 'Update City' ),
	   'add_new_item' => __( 'Add City' ),
	   'new_item_name' => __( 'New City Name' ),
	 ); 

	register_taxonomy(
	'dw_cities',
	'exhibits',
		array( 'hierarchical' => true,
		'labels' => $labels,
		'query_var' => true,
		'show_ui' => true,
		'public' => true,
		'show_in_nav_menus' => true,
		'rewrite' => array( 'slug' => 'city',
							'with_front' => false,
							'hierarchical' => 'true',
							) ) ); 
							


	 $labels = array(
	   'name' => _x( 'States', 'taxonomy general name' ),
	   'singular_name' => _x( 'States', 'taxonomy singular name' ),
	   'search_items' =>  __( 'Search States' ),
	   'popular_items' => __( 'Popular States' ),
	   'all_items' => __( 'All States' ),
	   'parent_item' => null,
	   'parent_item_colon' => null,
	   'edit_item' => __( 'Edit State' ), 
	   'update_item' => __( 'Update State' ),
	   'add_new_item' => __( 'Add State' ),
	   'new_item_name' => __( 'New State Name' ),
	 ); 

	register_taxonomy(
	'dw_states',
	'exhibits',
		array( 'hierarchical' => true,
		'labels' => $labels,
		'query_var' => true,
		'show_ui' => true,
		'public' => true,
		'show_in_nav_menus' => true,
		'rewrite' => array( 'slug' => 'state',
							'with_front' => false,
							'hierarchical' => 'true',
							) ) );

						
	 $labels = array(
	   'name' => _x( 'Years', 'taxonomy general name' ),
	   'singular_name' => _x( 'Year', 'taxonomy singular name' ),
	   'search_items' =>  __( 'Search Years' ),
	   'popular_items' => __( 'Popular Years' ),
	   'all_items' => __( 'All Years' ),
	   'parent_item' => null,
	   'parent_item_colon' => null,
	   'edit_item' => __( 'Edit Year' ), 
	   'update_item' => __( 'Update Year' ),
	   'add_new_item' => __( 'Add Year' ),
	   'new_item_name' => __( 'New Year Name' ),
	 ); 

	register_taxonomy(
	'dw_years',
	'exhibits',
		array( 'hierarchical' => true,
		'labels' => $labels,
		'query_var' => true,
		'show_ui' => true,
		'public' => true,
		'show_in_nav_menus' => true,
		'rewrite' => array( 'slug' => 'years',
							'with_front' => false,
							'hierarchical' => 'true',
						) ) );

							}
							endif;

// ==========================
// = meta data for Taxonomy =
// ==========================

// Add term page
function dw_taxonomy_add_new_meta_field() {
	// this will add the custom meta field to the add new term page
	?>
	<div class="form-field">
		<label for="term_meta[dw_venue_address]"><?php _e( 'Address', '_s' ); ?></label>
		<input type="text" name="term_meta[dw_venue_address]" id="term_meta[dw_venue_address]" value="">
		<p class="description"><?php _e( 'Enter the address','_s' ); ?></p>
	</div>
	<div class="form-field">
		<label for="term_meta[dw_venue_phone]"><?php _e( 'Phone Number', '_s' ); ?></label>
		<input type="text" name="term_meta[dw_venue_phone]" id="term_meta[dw_venue_phone]" value="">
		<p class="description"><?php _e( 'Enter the phone number','_s' ); ?></p>
	</div>
	<div class="form-field">
		<label for="term_meta[dw_venue_url]"><?php _e( 'Venue Url', '_s' ); ?></label>
		<input type="text" name="term_meta[dw_venue_url]" id="term_meta[dw_venue_url]" value="">
		<p class="description"><?php _e( 'Enter the web address for the Venue, include http://','_s' ); ?></p>
	</div>
	<div class="form-field">
		<label for="term_meta[dw_venue_zip]"><?php _e( 'Zip Code', '_s' ); ?></label>
		<input type="text" name="term_meta[dw_venue_zip]" id="term_meta[dw_venue_zip]" value="">
		<p class="description"><?php _e( 'Enter the Zip Code for the Venue','_s' ); ?></p>
	</div>
<?php
}
add_action( 'venues_add_form_fields', 'dw_taxonomy_add_new_meta_field', 10, 2 );

// Edit term page
function dw_taxonomy_edit_meta_field($term) {
 
	// put the term ID into a variable
	$t_id = $term->term_id;
 
	// retrieve the existing value(s) for this meta field. This returns an array
	$term_meta = get_option( "taxonomy_$t_id" ); ?>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="term_meta[dw_venue_address]"><?php _e( 'Address', '_s' ); ?></label></th>
		<td>
			<input type="text" name="term_meta[dw_venue_address]" id="term_meta[dw_venue_address]" value="<?php echo esc_attr( $term_meta['dw_venue_address'] ) ? esc_attr( $term_meta['dw_venue_address'] ) : ''; ?>">
			<p class="description"><?php _e( 'Enter the address','_s' ); ?></p>
		</td>
	</tr>
	
	<tr class="form-field">
	<th scope="row" valign="top"><label for="term_meta[dw_venue_phone]"><?php _e( 'Phone Number', '_s' ); ?></label></th>
		<td>
			<input type="text" name="term_meta[dw_venue_phone]" id="term_meta[dw_venue_phone]" value="<?php echo esc_attr( $term_meta['dw_venue_phone'] ) ? esc_attr( $term_meta['dw_venue_phone'] ) : ''; ?>">
			<p class="description"><?php _e( 'Enter the phone number','_s' ); ?></p>
		</td>
	</tr>
	
	<tr class="form-field">
	<th scope="row" valign="top"><label for="term_meta[dw_venue_url]"><?php _e( 'Venue Url', '_s' ); ?></label></th>
		<td>
			<input type="text" name="term_meta[dw_venue_url]" id="term_meta[dw_venue_url]" value="<?php echo esc_attr( $term_meta['dw_venue_url'] ) ? esc_attr( $term_meta['dw_venue_url'] ) : ''; ?>">
			<p class="description"><?php _e( 'Enter the web address for the Venue, include http://','_s' ); ?></p>
		</td>
	</tr>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="term_meta[dw_venue_zip]"><?php _e( 'Venue Zip Code', '_s' ); ?></label></th>
		<td>
			<input type="text" name="term_meta[dw_venue_zip]" id="term_meta[dw_venue_zip]" value="<?php echo esc_attr( $term_meta['dw_venue_zip'] ) ? esc_attr( $term_meta['dw_venue_zip'] ) : ''; ?>">
			<p class="description"><?php _e( 'Enter the Zip Code for the Venue','_s' ); ?></p>
		</td>
	</tr>
<?php
}
add_action( 'venues_edit_form_fields', 'dw_taxonomy_edit_meta_field', 10, 2 );

// Save extra taxonomy fields callback function.
function save_taxonomy_custom_meta( $term_id ) {
	if ( isset( $_POST['term_meta'] ) ) {
		$t_id = $term_id;
		$term_meta = get_option( "taxonomy_$t_id" );
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['term_meta'][$key] ) ) {
				$term_meta[$key] = $_POST['term_meta'][$key];
			}
		}
		// Save the option array.
		update_option( "taxonomy_$t_id", $term_meta );
	}
}  
add_action( 'edited_venues', 'save_taxonomy_custom_meta', 10, 2 );  
add_action( 'create_venues', 'save_taxonomy_custom_meta', 10, 2 );
?>