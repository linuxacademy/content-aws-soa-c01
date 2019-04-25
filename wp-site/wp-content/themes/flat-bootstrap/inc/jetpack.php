<?php
/**
 * Theme: Flat Bootstrap
 * 
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package flat-bootstrap
 */

/**
 * Add theme support for various Jetpack features
 */
function xsbf_jetpack_setup() {
	
	global $xsbf_theme_options;

	// Enable responsive video if Jetpack plugin is active
	add_theme_support( 'jetpack-responsive-videos' );

	// NOTE: removed ONLY because Jetpack now lets site admins turn this on themselves.
	// Its no longer required to be in the theme itself.
	//
	// Enable support for the Testimonials custom post type Note we haven't 
	// included any special styling, just handle displaying the pages.
	/*if( ! empty ( $xsbf_theme_options['testimonials']) ) {
		add_theme_support( 'jetpack-testimonial' );
	 }*/

	// Enable infinite scroll (if user turns it on)	
 	// See: http://jetpack.me/support/infinite-scroll/
	add_theme_support( 'infinite-scroll', array(
		//'type'			 => 'click',
		'container' 	 => 'main',
		'footer_widgets' => array(
			'sidebar-2', // Footer
			'sidebar-4', // Page Bottom
		),		
		'footer'    	 => 'page',
	) );
	
	// Enable user to upload a custom site logo. The function can take a size argument. 
	// The default is thumbnail, with other valid values being medium, large, full, and 
	// any additional sizes declared by add_image_size. It can also take a header-text
	// argument. This is an array of classes that should be hidden with the "Display 
	// Header Text" setting. Defaults to the same classes as Underscores: site-title
	// and site-description.
	if( ! empty ( $xsbf_theme_options['site_logo']) ) {
		add_theme_support( 'site-logo', array( 'size' => 'site-logo' ) );
		add_image_size( 'site-logo', 1170, 200 );
	}
}
add_action( 'after_setup_theme', 'xsbf_jetpack_setup' );

/*
 * Handle page title for Jetpack portfolio and testimonial archives
 */
if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'custom-content-types' ) ) :
add_filter( 'get_the_archive_title', 'xsbf_archive_title' );
function xsbf_archive_title( $title ) {

	//if ( is_post_type_archive( 'jetpack-portfolio' ) ) {
	if ( is_post_type_archive( 'jetpack-portfolio' ) OR is_tax ( 'jetpack-portfolio-type' ) OR is_tax ( 'jetpack-portfolio-tag' ) ) {
		$title = __( 'Portfolio', 'flat-bootstrap' );

	} elseif ( is_post_type_archive( 'jetpack-testimonial' ) ) {
	//} elseif ( is_post_type_archive( 'jetpack-testimonial' ) OR $post->post_type == 'jetpack-testimonial' ) {
		$testimonial_options = get_theme_mod( 'jetpack_testimonials' );
		if ( $testimonial_options ) { 
			$title = $testimonial_options['page-title'];
		} else {
			$title = __( 'Testimonials', 'flat-bootstrap' );
		}

	} // if is_post_type_archive
	return $title;
} //endfunction
endif; // class_exists

/*
 * Handle page subtitle (description) for Jetpack portfolio and testimonial archives
 */
if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'custom-content-types' ) ) :
add_filter( 'get_the_archive_description', 'xsbf_archive_description' );
function xsbf_archive_description( $description ) {

	//print_r ( Jetpack::get_active_modules() ); //TEST

	if ( is_post_type_archive( 'jetpack-portfolio' ) ) {
		if ( is_tax( 'jetpack-portfolio-type' ) ) {
			$description = __( 'Category', 'flat-bootstrap' ) . ': ' . single_term_title( null, false );
		} elseif ( is_tax( 'jetpack-portfolio-tag' ) ) {
			$description = __( 'Tag', 'flat-bootstrap' ) . ': ' . single_term_title( null, false );
		}

	} elseif ( is_post_type_archive( 'jetpack-testimonial' ) ) { 
		$testimonial_options = get_theme_mod( 'jetpack_testimonials' );
		if ( $testimonial_options ) { 
			$description = $testimonial_options['page-content'];
		} // $testimonial_options

	} // if is_post_type_archive
	return $description;
} //endfunction
endif; // class_exists

/**
 * Allow excerpts on Jetpack portfolio entries
 */
add_action('init', 'xsbf_jetpack_portfolio_add_excerpt', 100);
function xsbf_jetpack_portfolio_add_excerpt()
{
	add_post_type_support('jetpack-portfolio', 'excerpt');
}

/**
 * Remove Jetpack sharing (sharedaddy) from excerpt.
 */
function xsbf_remove_sharedaddy() {
    remove_filter( 'the_excerpt', 'sharing_display', 19 );
}
add_action( 'loop_start', 'xsbf_remove_sharedaddy' );