<?php
/**
 * Theme: Flat Bootstrap Child
 * 
 * Functions file for child theme. If you want to make a lot more changes than what is
 * included here, consider downloading the Flat Bootstrap Developer child theme. It 
 * shows how to do more complex function overrides, like choosing more theme features to
 * include or exclude, loading up custom CSS or javascript, etc.
 *
 * @package flat-bootstrap-child
 */
 
/**
 * SET THEME OPTIONS HERE
 *
 * Theme options can be overriden here. These are all set the same defaults as in the 
 * parent theme, but listed here so you can easily change them. Just uncomment (remove
 * the //) from any lines that you change.
 * 
 * Parameters:
/**
 * Theme options. Can override in child theme. For theme developers, this is array so 
 * you can add these items to the customizer and store them all as a single options entry.
 * 
 * Parameters:
 * background_color - Hex code for default background color without the #. eg) ffffff
 * 
 * content_width - Only for determining "full width" image. Actual width in Bootstrap.css
 * 		is 1170 for screens over 1200px resolution, otherwise 970.
 * 
 * embed_video_width - Sets the maximum width of videos that use the <embed> tag. The
 * 		default is 1170 to handle full-width page templates. If you will ALWAYS display
 * 		the sidebar, can set to 600 for better performance.
 * 
 * embed_video_height - Leave empty to automatically set at a 16:9 ratio to the width
 * 
 * post_formats - Array of WordPress extra post formats. i.e. aside, image, video, quote,
 * 		and/or link
 * 
 * touch_support - Whether to load touch support for carousels (sliders)
 * 
 * fontawesome - Whether to load font-awesome font set or not
 * 
 * bootstrap_gradients - Whether to load Bootstrap "theme" CSS for gradients
 * 
 * navbar_classes - One or more of navbar-default, navbar-inverse, navbar-fixed-top, etc.
 * 
 * custom_header_location - If 'header', displays the custom header above the navbar. If
 * 		'content-header', displays it below the navbar in place of the colored content-
 *		header section.
 * 
 * image_keyboard_nav - Whether to load javascript for using the keyboard to navigate
 		image attachment pages
 * 
 * sample_widgets - Whether to display sample widgets in the footer and page-bottom widet
 		areas.
 * 
 * sample_footer_menu - Whether to display sample footer menu with Top and Home links
 * 
 * testimonials - Whether to activate testimonials custom post type if Jetpack plugin is active
 *
 * NOTE: $theme_options has been deprecated and replaced with $xsbf_theme_options. You'll
 * need to update your child themes.
 */
$xsbf_theme_options = array(
	//'background_color' 		=> 'f2f2f2',
	//'content_width' 			=> 1170,
	//'embed_video_width' 		=> 1170,
	//'embed_video_height' 		=> null, // i.e. calculate it automatically
	//'post_formats' 			=> null,
	//'touch_support' 			=> true,
	//'fontawesome' 			=> true,
	//'bootstrap_gradients' 	=> false,
	//'navbar_classes'			=> 'navbar-default navbar-static-top',
	//'custom_header_location' 	=> 'header',
	//'image_keyboard_nav' 		=> true,
	//'sample_widgets' 			=> true, // for possible future use
	//'sample_footer_menu'		=> true,
	//'testimonials'			=> true
);

/* 
 * Load the parent theme's stylesheet here for performance reasons instead of using 
 * @include in this theme's stylesheet. Load this after the parent theme's styles.
 */
add_action( 'wp_enqueue_scripts', 'xsbf_child_enqueue_styles' );
function xsbf_child_enqueue_styles() {
	wp_enqueue_style( 'flat-bootstrap', 
		get_template_directory_uri() . '/style.css',
		array ( 'bootstrap', 'theme-base', 'theme-flat')
	);

	wp_enqueue_style( 'child', 
		get_stylesheet_directory_uri() . '/style.css', 
		array('flat-bootstrap') 
	);
}

/*
 * OVERRIDE THE SITE CREDITS TO GET RID OF THE "THEME BY XTREMELYSOCIAL" AND JUST LEAVE
 * COPYRIGHT YOUR SITE NAME
 * 
 * You can hard-code whatever you want in here, but its better to have this function pull
 * the current year and site name and URL as shown below.
 */
add_filter('xsbf_credits', 'xsbf_child_credits'); 
function xsbf_child_credits ( $site_credits ) {
		
	$theme = wp_get_theme();
	$site_credits = sprintf( __( '&copy; %1$s %2$s', 'flat-bootstrap' ), 
		date ( 'Y' ),
		'<a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . get_bloginfo( 'name' ) . '</a>'
	);
	return $site_credits;
}
