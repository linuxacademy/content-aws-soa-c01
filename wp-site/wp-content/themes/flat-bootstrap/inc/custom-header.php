<?php
/**
 * Theme: Flat Bootstrap
 * 
 * Implements the WordPress Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * @package flat-bootstrap
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * @uses xsbf_header_style()
 * @uses xsbf_admin_header_style() => NOTE: No longer used by WordPress
 * @uses xsbf_admin_header_image() => NOTE: No longer used by WordPress
 *
 * @package flat-bootstrap
 */
if ( ! function_exists( 'xsbf_custom_header_setup' ) ) :
add_action( 'after_setup_theme', 'xsbf_custom_header_setup' );
function xsbf_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'xsbf_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '555555',
		'width'                  => 1600,
		'height'                 => 200,
		'flex-width'             => true,
		'flex-height'            => true,
		'header-text'            => true,
		'wp-head-callback'       => 'xsbf_header_style'
		/*'wp-head-callback'       => 'xsbf_header_style',
		'admin-head-callback'    => 'xsbf_admin_header_style',
		'admin-preview-callback' => 'xsbf_admin_header_image',*/
	) ) );
}
endif; //end ! function_exists

if ( ! function_exists( 'xsbf_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * This function handles BOTH previewing in the customizer as well as the actual display
 * of the header in the front-end. This function ONLY needs to handle hiding or displaying
 * the site title and custom header text color. All other styles are from the front-end 
 * CSS.
 *
 * @see xsbf_custom_header_setup().
 */
function xsbf_header_style() {

	// get_header_textcolor() returns 'blank' if hiding site title and tagline or returns
	// any hex color value. HEADER_TEXTCOLOR is always the default color.
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	if ( HEADER_TEXTCOLOR == $header_text_color AND ! display_header_text() ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		/*.site-title,
		.site-description {*/
		.site-branding {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
		.navbar-brand {
			position: relative;
			clip: auto;
		}
	<?php
		// If the user has set a custom color for the text use that
		elseif ( HEADER_TEXTCOLOR != $header_text_color ) :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo $header_text_color; ?>;
		}
		.site-title a:hover,
		.site-title a:active,
		.site-title a:focus {
			opacity: 0.75;
		}
	<?php endif; ?>

	<?php if ( display_header_text() ) : ?>
		.navbar-brand {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // xsbf_header_style
