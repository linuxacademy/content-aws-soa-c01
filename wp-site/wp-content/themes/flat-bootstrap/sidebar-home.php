<?php
/**
 * Theme: Flat Bootstrap
 * 
 * The "sidebar" for the home page only. If the blog is set as home, it displays before
 * the posts. If a static page is set as home, then it displays at the top of the page.
 * This section is always full-width.
 *
 * @package flat-bootstrap
 */
?>

<?php 
global $xsbf_theme_options;
	
/* If home page "sidebar" has widgets, then display them */
if ( is_front_page() and !is_paged() ) {
$sidebar_home = get_dynamic_sidebar( 'sidebar-5' );
$sidebar_home = apply_filters( 'xsbf_home', $sidebar_home );
if ( $sidebar_home ) :
?>
	<div id="sidebar-home" class="sidebar-home">
		<?php //echo apply_filters( 'xsbf_home', $sidebar_home ); ?>
		<?php echo $sidebar_home; ?>
	</div><!-- .sidebar-home -->

<?php
/* Otherwise, show an example if we are on the front page and its set to display the blog */
/*elseif ( $xsbf_theme_options['sample_widgets'] != false AND is_front_page() AND is_home() ) :

?>
	<div id="sidebar-home" class="sidebar-home">

		<aside id="sample-text" class="widget widget_text section bg-darkgray text-center clearfix">
		<div class="container">
		<!-- <h2 class="widget-title"><?php //_e( 'WELCOME TO OUR SITE', 'flat-bootstrap' ); ?></h2> -->
		<div class="textwidget">
		<div class="row">
		<div class="col-lg-8 col-lg-offset-2">
		<p><?php _e( "This is an example widget at the top of the page", 'flat-bootstrap' ); ?>
		&nbsp; <button type="button" class="btn btn-primary"><?php _e( 'Try Now', 'flat-bootstrap' ); ?></button></p>
		</div><!-- col-lg-8 -->
		</div><!-- row -->
		</div><!-- textwidget -->
		</div><!-- container -->
		</aside>

	</div><!-- .sidebar-pagetop -->

<?php */ endif; // $sidebar_home
} // is_front_page()