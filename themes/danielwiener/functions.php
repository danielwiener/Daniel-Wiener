<?php
/**
 * _s functions and definitions
 *
 * @package Daniel Wiener
 * @since Daniel Wiener 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since _s 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( '_s_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since _s 1.0
 */
function _s_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
   	require( get_template_directory() . '/inc/tweaks.php' );

	/**
	 * Custom Theme Options
	 */
	require( get_template_directory() . '/inc/theme-options/theme-options.php' );

	/**
	 * WordPress.com-specific functions and definitions
	 */
	//require( get_template_directory() . '/inc/wpcom.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on _s, use a find and replace
	 * to change '_s' to the name of your theme in all the template files
	 */
	load_theme_textdomain( '_s', get_template_directory() . '/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', '_s' ),
	) );

	/**
	 * Add support for the Aside and Gallery Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'gallery', 'video', 'status', 'quote', 'link') ); 
	
	add_theme_support('post-thumbnails');
	add_image_size('slideshow-large', 9999, 500, false); //this is to make image 500 pixels high for the slideshow pro
	add_image_size('pinky', 40, 40, true); // for pinky previews
	add_image_size('tn-200', 200, 200, true); // just in case  
   	add_image_size('tn-300', 300, 300, true); // just in case
   	}

endif; // _s_setup
add_action( 'after_setup_theme', '_s_setup' );

/**
 * Adds theme/plugin custom images sizes added with add_image_size() to the image uploader/editor.  This 
 * allows users to insert these images within their post content editor.
 *
 * @since Hybrid 1.3.0 - taken from Hybrid
 * @access private
 * @param array $sizes Selectable image sizes.
 * @return array $sizes
 */
function dw_image_size_names_choose( $sizes ) {

	/* Get all intermediate image sizes. */
	$intermediate_sizes = get_intermediate_image_sizes();
	$add_sizes = array();

	/* Loop through each of the intermediate sizes, adding them to the $add_sizes array. */
	foreach ( $intermediate_sizes as $size )
		$add_sizes[$size] = $size;

	/* Merge the original array, keeping it intact, with the new array of image sizes. */
	$sizes = array_merge( $add_sizes, $sizes );

	/* Return the new sizes plus the old sizes back. */
	return $sizes;
}
/* Add all image sizes to the image editor to insert into post. */
add_filter( 'image_size_names_choose', 'dw_image_size_names_choose' );


/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since _s 1.0
 */
function _s_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', '_s' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', '_s_widgets_init' );

/**
 * Enqueue scripts and styles
 */  
// smart jquery inclusion 
//http://digwp.com/2010/03/wordpress-functions-php-template-custom-functions/   


function _s_scripts() {
	global $post;

	wp_enqueue_style( 'style', get_stylesheet_uri() );

	wp_enqueue_script( 'jquery' );
	
	   wp_register_script('jquery_tools',
	       // get_bloginfo('stylesheet_directory') . '/js/jquery.tools.min.js', 
			'http://cdn.jquerytools.org/1.2.6/full/jquery.tools.min.js',
	       array('jquery'),
	       '1.0' );
	   // enqueue the script
	   wp_enqueue_script('jquery_tools');

	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', 'jquery', '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image( $post->ID ) ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', '_s_scripts' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Daniel Wiener 1.0
 * @return int
 */
function dw_excerpt_length( $length ) {
	return 50;
}
add_filter( 'excerpt_length', 'dw_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Daniel Wiener 1.0
 * @return string "Continue Reading" link
 */
function dw_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( '<br />Read More', 'dw' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and dw_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Daniel Wiener 1.0
 * @return string An ellipsis
 */
function dw_auto_excerpt_more( $more ) {
	return ' &hellip;' . dw_continue_reading_link();
}
add_filter( 'excerpt_more', 'dw_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Daniel Wiener 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function dw_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= dw_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'dw_custom_excerpt_more' );   

function dw_posts_by_category($dw_slug) {
	global $post; // required
	  $dw_category = get_category_by_slug( $dw_slug );
	  $dw_category_link = get_category_link($dw_category->term_id);
	 ?> 
	<aside id="?" class="widget"><h1 class="widget-title"><a href="<?php echo esc_url( $dw_category_link); ?>"><?php echo $dw_category->name; ?></a></h1><ul>
	<?php 
    // stdClass Object ( [term_id] => 23 [name] => Exhibitions [slug] => exhibitions [term_group] => 0 [term_taxonomy_id] => 23 [taxonomy] => category [description] => [parent] => 0 [count] => 6 [cat_ID] => 23 [category_count] => 6 [category_description] => [cat_name] => Exhibitions [category_nicename] => exhibitions [category_parent] => 0 )
	
	$args = array(
		'category_name' 	=> "$dw_slug", //by category slug
		'posts_per_page' 	=> -1  	   
	); 
	$custom_posts = get_posts($args);
		foreach($custom_posts as $post) : setup_postdata($post);
		$dw_title = get_post_meta($post->ID, '_dw_short_title', true) ? get_post_meta($post->ID, '_dw_short_title', true) : get_the_title(); ?>
		 <li><a href="<?php the_permalink(); ?>" class="post-title" title="Read about <?php echo $dw_title ?>"><?php echo $dw_title; ?></a></li>
		<?php endforeach;?>
			</ul></aside>
		<?php 
}

/**
 * Include and setup custom metaboxes and fields.
 *
 * @category Daniel Wiener 1.0
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'dw_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function dw_metaboxes( array $dw_meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_dw_';

	$dw_meta_boxes[] = array(
		'id'         => 'more_info',
		'title'      => 'More Info',
		'pages'      => array( 'post', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
	   	// 'show_on' => array( 'key' => 'page-template', 'value' => array( 'page-feed.php', 'page-upcoming-exhibitions.php' ) ), //only shows on artwork pages, maybe figure out how to do parent page - Sculpture
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'Short Title',
				'desc' => 'Please, enter the short title.',
				'id'   => $prefix . 'short_title',
				'type' => 'text',
			),
			array(
				'name' => 'Something',
				'desc' => 'Enter the number for the offset of feed items. E.G if you have 5 items in the slide show, enter 5 here, so the list does not repeat what is in the slideshow. Use numbers only',
				'id'   => $prefix . 'number_feed_items',
				'type' => 'text',
			),  		
		),
	);


	// Add other metaboxes as needed

	return $dw_meta_boxes;
}    


add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'lib/metabox/init.php';

}

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 *
 * @since Daniel Wiener 1.0
 */
add_filter( 'use_default_gallery_style', '__return_false' ); 

function add_more_buttons($buttons) {
 $buttons[] = 'hr';
 $buttons[] = 'del';
 $buttons[] = 'sub';
 $buttons[] = 'sup';
 $buttons[] = 'fontselect';
 $buttons[] = 'fontsizeselect';
 $buttons[] = 'cleanup';
 $buttons[] = 'styleselect';
 return $buttons;
}
add_filter("mce_buttons_3", "add_more_buttons");

/**
 * Implement the Custom Header feature
 */
//require( get_template_directory() . '/inc/custom-header.php' );
// add google analytics to footer
function add_google_analytics() {
echo '<script type="text/javascript">';
echo "\n";
echo '  var _gaq = _gaq || [];';
echo '  _gaq.push(["_setAccount", "UA-11392590-1"]);';
echo '  _gaq.push(["_trackPageview"]);';
echo "\n";
echo '  (function() {';
echo '    var ga = document.createElement("script"); ga.type = "text/javascript"; ga.async = true;';
echo '    ga.src = ("https:" == document.location.protocol ? "https://ssl" : "http://www") + ".google-analytics.com/ga.js";';
echo '    var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ga, s);';
echo '  })();';
echo "\n";
echo '</script>';
}
add_action('wp_footer', 'add_google_analytics');
