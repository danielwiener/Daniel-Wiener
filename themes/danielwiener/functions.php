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
	 * Custom taxonomies for this theme.
	 */
	require( get_template_directory() . '/inc/dw_custom_taxonomies.php' );
	
	/**
	 * Custom post types for this theme.
	 */
	require( get_template_directory() . '/inc/dw_custom_post_types.php' );

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
	add_image_size('tn_100', 100, 100, true); // for pinky previews
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
	register_sidebar( array(
		'name' => __( 'Footer Column 1', '_s' ),
		'id' => 'footer-column-1',
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

	//wp_enqueue_script( 'jquery' );
	
	   //wp_register_script('jquery_tools',
	       // get_bloginfo('stylesheet_directory') . '/js/jquery.tools.min.js', 
			//'http://cdn.jquerytools.org/1.2.6/full/jquery.tools.min.js',
	       //array('jquery'),
	       //'1.0' );
	   // enqueue the script
	   // wp_enqueue_script('jquery_tools');

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
		'posts_per_page' 	=> 5  	   
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
		
		$dw_meta_boxes[] = array(
			'id'         => 'titles_metabox',
			'title'      => 'Artwork Info',
			'pages'      => array( 'titles', 'artworks'), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => 'Former Name',
					'desc' => 'Enter the working title or former name of the piece',
					'id'   => $prefix . 'former_name',
					'type' => 'text',
				),
				array(
					'name' => 'URL of Sculpture',
					'desc' => 'Enter the <u>relative url</u> of the sculpture. http://danielwiener.dev or .com is included.',
					'id'   => $prefix . 'sculpture_url',
					'type' => 'text',
				),
				array(
					'name' => 'Date of Piece',
					'desc' => 'Enter the year of the sculpture or other piece. 4 digits, e.g. 1998 or 2012. Using this to order images. (Maybe)',
					'id'   => $prefix . 'artwork_year',
					'type' => 'text',
				),
				array(
					'name' => 'Dimension (inches)',
					'desc' => 'Add the dimensions in inches',
					'id'   => $prefix . 'artwork_dimensions',
					'type' => 'text',
				),
				array(
					'name' => 'Materials',
					'desc' => 'Add the materials',
					'id'   => $prefix . 'artwork_materials',
					'type' => 'text',
				),
			),
	);


		$dw_meta_boxes[] = array(
			'id'         => 'exhibits_metabox',
			'title'      => 'Exhibition Information',
			'pages'      => array( 'exhibits'), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(

				array(
					'name' => 'Duration',
					'desc' => 'Enter the duration of the exhibit, e.g May 15 through June 15. Leave off the year. Click the Years taxonomy to include a year.',
					'id'   => $prefix . 'duration',
					'type' => 'text',
				),
				array(
					'name' => 'Opening',
					'desc' => 'Please enter the date and time of the opening.',
					'id'   => $prefix . 'opening',
					'type' => 'text',
				),
				array(
					'name' => 'Subtitle',
					'desc' => 'Enter the subtitle of the exhibit, e.g Notebooks by Artists from New York and San Diego',
					'id'   => $prefix . 'subtitle',
					'type' => 'text',
				),
				array(
					'name' => 'Curated By',
					'desc' => 'Enter the curator. Include "Curated by" or equivalent.',
					'id'   => $prefix . 'curated_by',
					'type' => 'text',
				),
				array(
					'name' => 'Begin Date',
					'desc' => 'Enter the date when the show begins. This will not be display but used to determine when and where to display the exhibition',
					'id'   => $prefix . 'begin_date',
					'type' => 'text_date_timestamp',
				),
				array(
					'name' => 'End Date',
					'desc' => 'Enter the date when the show end. This will not be display but used to determine when and where to display the exhibition.',
					'id'   => $prefix . 'end_date',
					'type' => 'text_date_timestamp',
				),
				array(
					'name' => 'Related Text',
					'desc' => 'Enter the date when the show end. This will not be display but used to determine when and where to display the exhibition.',
					'id'   => $prefix . 'related_text',
					'type' => 'wysiwyg',
				),
			),
	);
	
		$dw_meta_boxes[] = array(
			'id'         => 'featured_layout_metabox',
			'title'      => 'Slideshow and Layout',
			'pages'      => array( 'titles', 'exhibits', 'post', 'page', 'sculptors', 'artworks'), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => 'Front Page Slide Show',
					'desc' => 'Check if you want this entry on the front page slide show. Must include an image 940 x 445 as featured image',
					'id'   => $prefix . 'is_front_page_slides',
					'type' => 'checkbox',
				),
				array(
					'name' => 'Slide Order',
					'desc' => 'Enter number for slide order ',
					'id'   => $prefix . 'slide_order',
					'type' => 'text_small',
				),
			),
	);
	
		$dw_meta_boxes[] = array(
			'id'         => 'featured_in_subfooter',
			'title'      => 'Subfooter Layout',
			'pages'      => array( 'titles', 'exhibits'), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => 'Include in Subfooter',
					'desc' => 'Check if you want this entry in the subfooter',
					'id'   => $prefix . 'is_in_subfooter',
					'type' => 'checkbox',
				),
				array(
					'name' => 'Subfooter Order',
					'desc' => 'Enter number for subfooter order [DANIEL!!! may not need this delete, if so] ',
					'id'   => $prefix . 'slide_order',
					'type' => 'text_small',
				),
				array(
					'name' => 'Subfooter End Date',
					'desc' => 'Enter date when the exhibit is taken off the subfooter [DANIEL!!! may not need this delete, if so]',
					'id'   => $prefix . 'slide_order',
					'type' => 'text_date',
				),
			),
	);
	
	
		$dw_meta_boxes[] = array(
			'id'         => 'notes',
			'title'      => 'Notes',
			'pages'      => array( 'titles', 'exhibits', 'posts', 'pages', 'artworks', 'sculptors'), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => 'Notes',
					'desc' => 'Add notes that will not be published, for your eyes only',
					'id'   => $prefix . 'notes',
					'type' => 'wysiwyg',
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
// ====================================================================================================================================
// = Short Title function - http://wordpress.org/support/topic/how-to-control-the-post-title-lengh - short_title('&hellip', 30) (etc) =
// ====================================================================================================================================
function short_title($after = '', $length) {
	$mytitle = get_the_title();
	if ( strlen($mytitle) > $length ) {
	$mytitle = substr($mytitle,0,$length);
	echo $mytitle . $after;
	} else {
	echo $mytitle;
	}
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


// Add custom taxonomies and custom post types counts to dashboard
add_action( 'right_now_content_table_end', 'my_add_counts_to_dashboard' );
function my_add_counts_to_dashboard() {
    // Custom taxonomies counts
    // $taxonomies = get_taxonomies( array( '_builtin' => false ), 'objects' );
    // foreach ( $taxonomies as $taxonomy ) {
    //     $num_terms  = wp_count_terms( $taxonomy->name );
    //     $num = number_format_i18n( $num_terms );
    //     $text = _n( $taxonomy->labels->singular_name, $taxonomy->labels->name, $num_terms );
    //     $associated_post_type = $taxonomy->object_type;
    //     if ( current_user_can( 'manage_categories' ) ) {
    //         $num = '<a href="edit-tags.php?taxonomy=' . $taxonomy->name . '&post_type=' . $associated_post_type[0] . '">' . $num . '</a>';
    //         $text = '<a href="edit-tags.php?taxonomy=' . $taxonomy->name . '&post_type=' . $associated_post_type[0] . '">' . $text . '</a>';
    //     }
    //     echo '<td class="first b b-' . $taxonomy->name . 's">' . $num . '</td>';
    //     echo '<td class="t ' . $taxonomy->name . 's">' . $text . '</td>';
    //     echo '</tr><tr>';
    // }

    // Custom post types counts
    $post_types = get_post_types( array( '_builtin' => false ), 'objects' );
	$post_type_array = array('titles', 'sculptors', 'exhibits', 'artworks');
    foreach ( $post_types as $post_type ) {
		if ( in_array($post_type->name, $post_type_array)) {
	
        $num_posts = wp_count_posts( $post_type->name );
        $num = number_format_i18n( $num_posts->publish );
        $text = _n( $post_type->labels->singular_name, $post_type->labels->name, $num_posts->publish );
        if ( current_user_can( 'edit_posts' ) ) {
            $num = '<a href="edit.php?post_type=' . $post_type->name . '">' . $num . '</a>';
            $text = '<a href="edit.php?post_type=' . $post_type->name . '">' . $text . '</a>';
        }
        echo '<td class="first b b-' . $post_type->name . 's">' . $num . '</td>';
        echo '<td class="t ' . $post_type->name . 's">' . $text . '</td>';
        echo '</tr>';

        if ( $num_posts->pending > 0 ) {
            $num = number_format_i18n( $num_posts->pending );
            $text = _n( $post_type->labels->singular_name . ' pending', $post_type->labels->name . ' pending', $num_posts->pending );
            if ( current_user_can( 'edit_posts' ) ) {
                $num = '<a href="edit.php?post_status=pending&post_type=' . $post_type->name . '">' . $num . '</a>';
                $text = '<a href="edit.php?post_status=pending&post_type=' . $post_type->name . '">' . $text . '</a>';
            }
            echo '<td class="first b b-' . $post_type->name . 's">' . $num . '</td>';
            echo '<td class="t ' . $post_type->name . 's">' . $text . '</td>';
            echo '</tr>';
        }
    }
}	
}
// =====================================
// = used with codepress admin columns =
// =====================================
add_filter('cpac_use_hidden_custom_fields', '__return_true'); // enables the use hidden custom fields
add_filter( 'cpac-remove-filtering-columns', '__return_false' ); // add dropdown taxonomy filtering to the overview pages