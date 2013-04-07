<?php
/**
 * Custom Post Type Code.
 *
 * @package Daniel Wiener
 * @since Daniel Wiener 1.0
 */ 
add_action('init', 'dw_custom_init');
function dw_custom_init() 
{  
   /* BEGIN Title Post Type*/ 
  $labels = array(
    'name' => _x('Titles', 'post type general name'),
    'singular_name' => _x('Title', 'post type singular name'),
    'add_new' => _x('Add New', 'titles'),
    'add_new_item' => __('Add New Title'),
    'edit_item' => __('Edit Title'),
    'edit' => _x('Edit', 'titles'),
    'new_item' => __('New Title'),
    'view_item' => __('View Title'),
    'search_items' => __('Search Titles'),
    'not_found' =>  __('No Titles found'),
    'not_found_in_trash' => __('No Titles found in Trash'), 
    'view' =>  __('View Title'),
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true, 
    'capability_type' => 'post',
   'taxonomies' => array( 'venues'),
    'hierarchical' => false,
    'can_export' => true,
    'menu_position' => 5,
    'show_in_nav_menus' => true,
	'has_archive' => true,
    'rewrite' => true,
    'supports' => array('title','editor','thumbnail','excerpt','comments','revisions')
  ); 
  register_post_type('titles',$args);

   /* BEGIN Sculptor Post Type*/ 
  $labels = array(
    'name' => _x('Sculptors', 'post type general name'),
    'singular_name' => _x('Sculptor', 'post type singular name'),
    'add_new' => _x('Add New', 'sculptors'),
    'add_new_item' => __('Add New Sculptor'),
    'edit_item' => __('Edit Sculptor'),
    'edit' => _x('Edit', 'sculptors'),
    'new_item' => __('New Sculptor'),
    'view_item' => __('View Sculptor'),
    'search_items' => __('Search Sculptors'),
    'not_found' =>  __('No Sculptors found'),
    'not_found_in_trash' => __('No Sculptors found in Trash'), 
    'view' =>  __('View Sculptor'),
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true, 
    'capability_type' => 'post',
   /* 'taxonomies' => array( 'post_tag', 'category'), */
    'hierarchical' => false,
    'can_export' => true,
    'menu_position' => 5,
    'show_in_nav_menus' => true,
	'has_archive' => true,
    'rewrite' => true,
    'supports' => array('title','editor','thumbnail','excerpt','comments','revisions')
  ); 
  register_post_type('sculptors',$args);

   /* BEGIN Exhibits Post Type*/ 
  $labels = array(
    'name' => _x('Exhibits', 'post type general name'),
    'singular_name' => _x('Exhibit', 'post type singular name'),
    'add_new' => _x('Add New', 'exhibits'),
    'add_new_item' => __('Add New Exhibit'),
    'edit_item' => __('Edit Exhibit'),
    'edit' => _x('Edit', 'exhibits'),
    'new_item' => __('New Exhibit'),
    'view_item' => __('View Exhibit'),
    'search_items' => __('Search Exhibits'),
    'not_found' =>  __('No Exhibits found'),
    'not_found_in_trash' => __('No Exhibits found in Trash'), 
    'view' =>  __('View Exhibits'),
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true, 
    'capability_type' => 'post',
   /* 'taxonomies' => array( 'post_tag', 'category'), */
    'hierarchical' => false,
    'can_export' => true,
    'menu_position' => 5,
    'show_in_nav_menus' => true,
	'has_archive' => true,
    'rewrite' => true,
    'supports' => array('title','editor','thumbnail','excerpt','comments','revisions')
  ); 
  register_post_type('exhibits',$args);



   /* BEGIN Artworks Post Type*/ 
  $labels = array(
    'name' => _x('Artworks', 'post type general name'),
    'singular_name' => _x('Artwork', 'post type singular name'),
    'add_new' => _x('Add New', 'artworks'),
    'add_new_item' => __('Add New Artwork'),
    'edit_item' => __('Edit Artwork'),
    'edit' => _x('Edit', 'artworks'),
    'new_item' => __('New Artwork'),
    'view_item' => __('View Artwork'),
    'search_items' => __('Search Artworks'),
    'not_found' =>  __('No Artworks found'),
    'not_found_in_trash' => __('No Artworks found in Trash'), 
    'view' =>  __('View Artworks'),
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true, 
    'capability_type' => 'post',
    'taxonomies' => array( 'make', 'types', 'places'),
    'hierarchical' => false,
    'can_export' => true,
    'menu_position' => 5,
    'show_in_nav_menus' => true,
	'has_archive' => true,
    'rewrite' => true,
    'supports' => array('title','editor','thumbnail','excerpt','comments','revisions')
  ); 
  register_post_type('artworks',$args);
}


/*--- Custom Messages - title_updated_messages ---*/
 add_filter('post_updated_messages', 'title_updated_messages');
 
 function title_updated_messages( $messages ) {
   global $post, $post_ID;

   $messages['titles'] = array(
   0 => '', // Unused. Messages start at index 1.
   1 => sprintf( __('Title updated. <a href="%s">View Title</a>'), esc_url( get_permalink($post_ID) ) ),
   2 => __('Custom field updated.'),
   3 => __('Custom field deleted.'),
   4 => __('Title updated.'),
   /* translators: %s: date and time of the revision */
   5 => isset($_GET['revision']) ? sprintf( __('Title restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
   6 => sprintf( __('Title published. <a href="%s">View Title</a>'), esc_url( get_permalink($post_ID) ) ),
   7 => __('Title saved.'),
   8 => sprintf( __('Title submitted. <a target="_blank" href="%s">Preview Title</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
   9 => sprintf( __('Title scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Title</a>'),
     // translators: Publish box date format, see http://php.net/date
     date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
   10 => sprintf( __('Title draft updated. <a target="_blank" href="%s">Preview Title</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
   );

$messages['sculptors'] = array(
0 => '', // Unused. Messages start at index 1.
1 => sprintf( __('Sculptor updated. <a href="%s">View Sculptor</a>'), esc_url( get_permalink($post_ID) ) ),
2 => __('Custom field updated.'),
3 => __('Custom field deleted.'),
4 => __('Sculptor updated.'),
/* translators: %s: date and time of the revision */
5 => isset($_GET['revision']) ? sprintf( __('Sculptor restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
6 => sprintf( __('Sculptor published. <a href="%s">View Sculptor</a>'), esc_url( get_permalink($post_ID) ) ),
7 => __('Sculptor saved.'),
8 => sprintf( __('Sculptor submitted. <a target="_blank" href="%s">Preview Sculptor</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
9 => sprintf( __('Sculptor scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Sculptor</a>'),
  // translators: Publish box date format, see http://php.net/date
  date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
10 => sprintf( __('Sculptor draft updated. <a target="_blank" href="%s">Preview Sculptor</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
);

$messages['exhibits'] = array(
0 => '', // Unused. Messages start at index 1.
1 => sprintf( __('Exhibit updated. <a href="%s">View Exhibit</a>'), esc_url( get_permalink($post_ID) ) ),
2 => __('Custom field updated.'),
3 => __('Custom field deleted.'),
4 => __('Exhibit updated.'),
/* translators: %s: date and time of the revision */
5 => isset($_GET['revision']) ? sprintf( __('Exhibit restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
6 => sprintf( __('Exhibit published. <a href="%s">View Exhibit</a>'), esc_url( get_permalink($post_ID) ) ),
7 => __('Exhibit saved.'),
8 => sprintf( __('Exhibit submitted. <a target="_blank" href="%s">Preview Exhibit</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
9 => sprintf( __('Exhibit scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Exhibit</a>'),
  // translators: Publish box date format, see http://php.net/date
  date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
10 => sprintf( __('Exhibit draft updated. <a target="_blank" href="%s">Preview Exhibit</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
);

$messages['portfolio_slideshow'] = array(
0 => '', // Unused. Messages start at index 1.
1 => sprintf( __('Slide Show updated. <a href="%s">View Slide Show</a>'), esc_url( get_permalink($post_ID) ) ),
2 => __('Custom field updated.'),
3 => __('Custom field deleted.'),
4 => __('Slide Show updated.'),
/* translators: %s: date and time of the revision */
5 => isset($_GET['revision']) ? sprintf( __('Slide Show restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
6 => sprintf( __('Slide Show published. <a href="%s">View Slide Show</a>'), esc_url( get_permalink($post_ID) ) ),
7 => __('Slide Show saved.'),
8 => sprintf( __('Slide Show submitted. <a target="_blank" href="%s">Preview Slide Show</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
9 => sprintf( __('Slide Show scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Slide Show</a>'),
  // translators: Publish box date format, see http://php.net/date
  date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
10 => sprintf( __('Slide Show draft updated. <a target="_blank" href="%s">Preview Slide Show</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
);

$messages['artworks'] = array(
0 => '', // Unused. Messages start at index 1.
1 => sprintf( __('Artwork updated. <a href="%s">View Artwork</a>'), esc_url( get_permalink($post_ID) ) ),
2 => __('Custom field updated.'),
3 => __('Custom field deleted.'),
4 => __('Artwork updated.'),
/* translators: %s: date and time of the revision */
5 => isset($_GET['revision']) ? sprintf( __('Artwork restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
6 => sprintf( __('Artwork published. <a href="%s">View Artwork</a>'), esc_url( get_permalink($post_ID) ) ),
7 => __('Artwork saved.'),
8 => sprintf( __('Artwork submitted. <a target="_blank" href="%s">Preview Artwork</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
9 => sprintf( __('Artwork scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Artwork</a>'),
  // translators: Publish box date format, see http://php.net/date
  date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
10 => sprintf( __('Artwork draft updated. <a target="_blank" href="%s">Preview Artwork</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
);

   return $messages;
 }
?>