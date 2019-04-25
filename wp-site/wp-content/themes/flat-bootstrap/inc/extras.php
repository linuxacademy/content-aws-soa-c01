<?php
/**
 * Theme: Flat Bootstrap
 * 
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package flat-bootstrap
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link. Not used.
 */
/*
add_filter( 'wp_page_menu_args', 'xsbf_page_menu_args' );
function xsbf_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
*/

/**
 * Adds custom classes to the array of body classes.
 */
if ( ! function_exists( 'xsbf_body_classes' ) ) :
add_filter( 'body_class', 'xsbf_body_classes' );
function xsbf_body_classes( $classes ) {

	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds classes for various sizes of featured images. Our theme overrides the 
	// custom header with a large featured image.
	if ( has_post_thumbnail() ) {
		$classes[] = 'featured-image';

		global $post, $content_width;
		$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
		$image_width = $featured_image[1];
		if ( $content_width AND $image_width >= $content_width ) {
			if ( is_home() ) {
				$classes[] = 'has-cover-image';
			} else {
				$classes[] = 'has-section-image';
			} //endif is_home
		} //endif $content_width

	// If custom header and not overridden, then add class for that
	} elseif ( get_header_image() ) {
		$classes[] = 'has-header-image';
	} //endif has_post_thumbnail

	return $classes;
}
endif; // end ! function_exists

/**
 * Filter in a link to a content ID attribute for the next/previous image links on 
 * image attachment pages
 */
if ( ! function_exists( 'xsbf_enhanced_image_navigation' ) ) :
add_filter( 'attachment_link', 'xsbf_enhanced_image_navigation', 10, 2 );
function xsbf_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
endif; // end ! function_exists

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 */
/*
if ( ! function_exists( 'xsbf_wp_title' ) ) :
add_filter( 'wp_title', 'xsbf_wp_title', 10, 2 );
function xsbf_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'flat-bootstrap' ), max( $paged, $page ) );

	return $title;
}
endif; // end ! function_exists
*/