<?php
/**
 * Theme: Flat Bootstrap
 * 
 * The template for displaying search forms in xtremelysocial
 *
 * @package flat-bootstrap
 */
?>
<form role="search" method="get" class="search-form form-inline" action="<?php echo esc_url( home_url( '/' ) ); ?>">
<div class="form-group">
	<label>
		<span class="screen-reader-text sr-only"><?php _ex( 'Search for:', 'label', 'flat-bootstrap' ); ?></span>
		<input type="search" class="search-field form-control" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'flat-bootstrap' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
	</label>
	<input type="submit" class="search-submit btn btn-primary" value="<?php echo esc_attr_x( 'Search', 'submit button', 'flat-bootstrap' ); ?>">
</div><!-- .form-group -->
</form>
