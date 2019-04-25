<?php
/**
 * Theme: Flat Bootstrap
 * 
 * Theme Customizer
 *
 * @package flat-bootstrap
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function xsbf_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'refresh';
}
add_action( 'customize_register', 'xsbf_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function xsbf_customize_preview_js() {
	wp_enqueue_script( 'xsbf_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20160303', true );
}
add_action( 'customize_preview_init', 'xsbf_customize_preview_js' );
