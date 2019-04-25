<?php
/**
 * Theme: Spot
 * 
 * Functions file to make changes to the parent theme's functions. 
 *
 * @package spot
 */
 
/**
 * SET THEME OPTIONS HERE
 *
 * Theme options can be overriden here. These are all set the same defaults as in the 
 * parent theme except for the navbar_classes. You can change whatever you want.
 * 
 * Parameters:
 * background_color - Hex code for default background color without the #. eg) ffffff
 *
 * content_width - Only for determining "full width" image. Actual width in Bootstrap.css.
 * 		1170 for screens over 1200px resolution, otherwise 970.
 *
 * embed_video_width - Sets the width of videos that use the <embed> tag. This defaults
 * 		to the smallest width of content with a sidebar before the sidebar collapses.
 *		The height is automatically set at a 16:9 ratio unless overridden.
 *
 * embed_video_height - Leave empty to automatically set at a 16:9 ratio to the width
 *
 * post_formats - WordPress extra post formats. i.e. 'aside', 'image', 'video', 'quote',
 * 		'link'
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
 *		header section. If 'both' (or anything else), it will display the header text but
 *		also display the custom header below the navbar.
 *
 * image_keyboard_nav - Whether to load javascript for using the keyboard to navigate
 		image attachment pages
 *
 * sample_widgets - Whether to display sample widgets in the footer and page-bottom widet
 		areas.
 *
 * sample_footer_menu - Whether to display sample footer menu with Top and Home links
 * 
 * testimonials - Whether to activate testimonials custom post type if Jetpack plugin is 
 * 		active
 *
 * NOTE: THIS VARIABLE HAS BEEN RENAMED FROM $THEME_OPTIONS. PLEASE UPDATE YOUR CHILD THEMES.
 */
$xsbf_theme_options = array(
	//'background_color' 		=> 'f2f2f2',
	//'content_width' 			=> 1170,
	//'embed_video_width' 		=> 1170,
	//'embed_video_height' 		=> null, // i.e. calculate it automatically
	//'post_formats' 			=> '',
	//'touch_support' 			=> true,
	//'fontawesome' 			=> true,
	//'bootstrap_gradients' 	=> false,
	'navbar_classes'			=> 'navbar-inverse navbar-fixed-top', // Different than parent
	'custom_header_location' 	=> 'content-header',
	//'image_keyboard_nav' 		=> true,
	//'sample_widgets' 			=> true,
	//'sample_footer_menu'		=> true,
	//'testimonials'			=> true // requires Jetpack
);

/* 
 * Load the parent theme's stylesheet here for performance reasons instead of using 
 * @include in this theme's stylesheet. Load this after the parent theme's styles.
 */
//add_action( 'wp_enqueue_scripts', 'xsbf_pratt_enqueue_styles', 20 );
add_action( 'wp_enqueue_scripts', 'xsbf_pratt_enqueue_styles' );
function xsbf_pratt_enqueue_styles() {
	wp_enqueue_style( 'flat-bootstrap', 
		get_template_directory_uri() . '/style.css',
		array ( 'bootstrap', 'theme-base', 'theme-flat')
	);

	wp_enqueue_style( 'spot', 
		get_stylesheet_directory_uri() . '/style.css', 
		array('flat-bootstrap') 
	);
}

/**
 * Override custom logo and header from the parent theme. Note priority 12 to run after
 * the parent theme's setup.
 */
/*add_action( 'after_setup_theme', 'xsbf_spot_after_setup_theme' ); 
function xsbf_spot_after_setup_theme() {*/
add_action( 'after_setup_theme', 'xsbf_custom_header_setup', 12 ); 
function xsbf_custom_header_setup() {

	/* Remove custom logo support (for now) */
	remove_theme_support( 'custom-logo'); 
	// Add theme support for custom site logo. As of WordPress v4.5.
	/*add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 100,
		'flex-height' => false,
		'flex-width'  => true,
		//'header-text' => array( 'site-title', 'site-description' ),
	) );*/

	/* Override custom headers */
	add_theme_support( 'custom-header', apply_filters( 'xsbf_custom_header_args', array(
		'header-text' 			=> true, // allow user to set the header text color
		'default-text-color'	=> 'fff',
		'default-image' 		=> get_stylesheet_directory_uri() . '/images/headers/notepad-blue.jpg',
		'width' 				=> 1600,
		'height' 				=> 700, //large: home 700, other 400; mobile home 480, other 340 mobile; images are 900
		'flex-width'             => true,
		'flex-height'            => true,
		'wp-head-callback'       => 'xsbf_header_style'
	) ) );

	//The %2$s references the child theme directory (ie the stylesheet directory), use 
	// %s to reference the parent directory.
	register_default_headers( array(
		'abstract' => array(
			'url'           => '%2$s/images/headers/abstract-blue.jpg',
			'thumbnail_url' => '%2$s/images/headers/abstract-blue-thumbnail.jpg',
			'description'   => __( 'Abstract', 'flat-bootstrap' )
		),
		'book' => array(
			'url'           => '%2$s/images/headers/book-blue.jpg',
			'thumbnail_url' => '%2$s/images/headers/book-blue-thumbnail.jpg',
			'description'   => __( 'Book', 'flat-bootstrap' )
		),
		'briefcase' => array(
			'url'           => '%2$s/images/headers/briefcase-blue.jpg',
			'thumbnail_url' => '%2$s/images/headers/briefcase-blue-thumbnail.jpg',
			'description'   => __( 'Briefcase', 'flat-bootstrap' )
		),
		'camera' => array(
			'url'           => '%2$s/images/headers/camera-blue.jpg',
			'thumbnail_url' => '%2$s/images/headers/camera-blue-thumbnail.jpg',
			'description'   => __( 'Camera', 'flat-bootstrap' )
		),
		'city' => array(
			'url'           => '%2$s/images/headers/city-blue.jpg',
			'thumbnail_url' => '%2$s/images/headers/city-blue-thumbnail.jpg',
			'description'   => __( 'City', 'flat-bootstrap' )
		),
		'desk' => array(
			'url'           => '%2$s/images/headers/desk-blue.jpg',
			'thumbnail_url' => '%2$s/images/headers/desk-blue-thumbnail.jpg',
			'description'   => __( 'Desk', 'flat-bootstrap' )
		),
		'guitar' => array(
			'url'           => '%2$s/images/headers/guitar-blue.jpg',
			'thumbnail_url' => '%2$s/images/headers/guitar-blue-thumbnail.jpg',
			'description'   => __( 'Guitar', 'flat-bootstrap' )
		),
		'notepad' => array(
			'url'           => '%2$s/images/headers/notepad-blue.jpg',
			'thumbnail_url' => '%2$s/images/headers/notepad-blue-thumbnail.jpg',
			'description'   => __( 'Guitar', 'flat-bootstrap' )
		),
		'skyline' => array(
			'url'           => '%2$s/images/headers/skyline-blue.jpg',
			'thumbnail_url' => '%2$s/images/headers/skyline-blue-thumbnail.jpg',
			'description'   => __( 'Skyline', 'flat-bootstrap' )			
		),
	) );
}

/**
 * Styles the header image and text displayed on the blog
 *
 * This function handles BOTH previewing in the customizer as well as the actual display
 * of the header in the front-end. This function ONLY needs to handle hiding or displaying
 * the site title and custom header text color. All other styles are from the front-end 
 * CSS.
 *
 * Since Spot doesn't have a header above the top navbar, we need to reverse the behavoir
 * of displaying the site title or not. i.e. Put it back to the "normal" way it was
 * intended to work.
 *
 * @see xsbf_custom_header_setup().
 */
function xsbf_header_style() {

	// get_header_textcolor() returns 'blank' if hiding site title and tagline or returns
	// any hex color value. HEADER_TEXTCOLOR is always the default color.
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	if ( HEADER_TEXTCOLOR == $header_text_color AND ! display_header_text() ) {
	//if ( HEADER_TEXTCOLOR == $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css" id="custom-header-css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.navbar-brand {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		elseif ( HEADER_TEXTCOLOR != $header_text_color ) :
	?>
		.navbar-default .navbar-brand,
		.navbar-inverse .navbar-brand {
			color: #<?php echo $header_text_color; ?>;
		}
		.navbar-default .navbar-brand:hover,
		.navbar-default .navbar-brand:active,
		.navbar-default .navbar-brand:focus,
		.navbar-inverse .navbar-brand:hover,
		.navbar-inverse .navbar-brand:active,
		.navbar-inverse .navbar-brand:focus {
			color: #<?php echo $header_text_color; ?>;
			opacity: 0.75;
		}
		/* This isn't ready to go into "production" yet. Still testing. */
		/*
		a,
		i {
			color: #<?php echo $header_text_color; ?>;
		}
		a:hover,
		a:active,
		a:focus {
			color: #<?php echo $header_text_color; ?>;
			opacity: 0.75;
		}
		*/
		/* End testing. */
	<?php endif; ?>

	<?php if ( display_header_text() ) : ?>
		.navbar-brand {
			position: relative;
			clip: auto;
		}
	<?php endif; ?>
	</style>
	<?php
} //endfunction xsbf_header_style

/*
 * Hook into navbar HTML to shift the menu items to the right and just for fun replace any
 * "O"s found in the site name with a red dot.
 */
add_filter( 'xsbf_navbar', 'xsbf_spot_navbar' );
function xsbf_spot_navbar ( $navbar ) {
	$navbar = str_ireplace( 'navbar-collapse collapse', 'navbar-collapse collapse navbar-right', $navbar ); 
	//$navbar = str_ireplace ( 'rel="home">' . get_bloginfo('name') . '</a>', 'rel="home">' . xsbf_spot_replace_oh_with_dot ( get_bloginfo('name') ) . '</a>', $navbar ); 
	//$navbar = str_ireplace ( 'rel="home">' . get_bloginfo('name') . '</a>', 'rel="home">' . get_bloginfo('name') . '</a>', $navbar ); 
	return $navbar;
}

/*
 * Just for fun, helper function to replace "O" with a red dot. Used by header.php.
 */
//add_filter('option_blogname','xsbf_spot_replace_oh_with_dot');
function xsbf_spot_replace_oh_with_dot ( $text ) {
	$text = str_ireplace( 'O', '<i class="fa fa-circle color-red"></i>', $text ); 
	return $text;
}

/*
add_filter( 'wp_nav_menu_args', 'xsbf_modify_nav_menu_args' );
function xsbf_modify_nav_menu_args( $args )
{
	if( 'primary' == $args['theme_location'] )
	{
		//$args['depth'] = -1;
		//$args['container_id'] = 'my_primary_menu';
		$args['container_class'] .= 'navbar-right';
	}
	return $args;
}
*/
