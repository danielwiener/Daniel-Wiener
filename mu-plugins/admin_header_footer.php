<?php
/*
Plugin Name: Custom Header and Footer
Plugin URI: http://danielwiener.com/
Description: Description
Version: 0.1
Author: Daniel Wiener
Author URI: http://danielwiener.com/ 
*/

/**
 * Copyright (c) 2011 Daniel Wiener. All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * **********************************************************************
 */



 // Custom Admin Top Logo
add_action('admin_head', 'dw_custom_header');

function dw_custom_header() {
    echo '<style type="text/css">';
    echo '#header-logo { background-image: url('. plugins_url('images/haring_admin_logo.gif', __FILE__) . ') !important; padding: 0 0 0 10px;}'; //image needs to be 32 x 32    
	echo ' #wphead {background:#FF0000}; '; 
	echo ' .wp-admin #wpwrap #wpcontent #wphead h1 #site-heading a span #site-title{ color: #ffffff !important;} ';    //this does not work, don't know why
	echo '#wphead-info #user_info p {color: #ffffff !important; }';	
	echo '#wphead-info #user_info p a  {color: #ffffff !important; }';	
	echo '</style>';
		 
}


 // Custom Admin Footer 
function dw_custom_footer() {
echo ('<span id="footer-thankyou">' . __('Dashboard modifications by <a href="http://www.danielwiener.com">Daniel Wiener</a> for <a href="http://www.danielwiener.com">Daniel Wiener dot com</a>').'</span>');
}

add_action('admin_footer_text', 'dw_custom_footer');

?>