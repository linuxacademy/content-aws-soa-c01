/**
 * Theme: Flat Bootstrap
 * 
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// site-title for Flat Bootstrap and navbar-brand for child themes
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to ); // header site title
			$( 'a.navbar-brand' ).text( to ); // navbar site title
			$( '.header-image-title' ).text( to ); // home page site title
		} );
	} ); // blogname
	
	// Header description for Flat Bootstrap only and home page description for child
	// themes
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to ); /* header site description */
			$( '.header-image-caption' ).text( to ); /* home page site description */
		} );
	} ); // blogdescription
	
	// Note that if header text color is blank, then user chose to not display header text
	wp.customize( 'header_textcolor', function( value ) {

		value.bind( function( to ) {
		
			// If blank, hide site title and description for Flat Bootstrap but display
			// it in the navbar. For child themes, hide site title in the navbar.
			if ( 'blank' === to ) {
				//$( '.site-title, .site-title a, .site-description' ).css( {
				$( '.site-branding' ).css( {
				//$( '.site-title, .site-title a, .site-description, .site-branding' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
				$( '.navbar-brand' ).css( {
					'clip': 'auto',
					'position': 'relative',
					'display': 'block'
				} );

			// Otherwise, display site title and description for Flat Bootstrap, but hide
			// it from the navbar. For child themes, show site title it in the navbar.
			} else {
				//$( '.site-title, .site-title a, .site-description' ).css( {
				$( '.site-branding' ).css( {
				//$( '.site-title, .site-title a, .site-description, .site-branding' ).css( {
					'clip': 'auto',
					'position': 'relative',
					'color': to
				} );
				$( '.navbar-brand' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute',
					'display': 'none'
				} );
			} // 'blank'

		} );

	} ); /* header_textcolor */

} )( jQuery );
