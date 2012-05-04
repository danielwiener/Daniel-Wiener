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
 

		<div id="front-page" class="site-content">
			

<?php get_template_part('content', 'front_page');  ?>  
		   
		</div><!-- #primary .site-content -->

<?php // get_sidebar(); ?>
<?php get_footer(); ?>