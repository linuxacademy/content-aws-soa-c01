<?php
/**
 * Theme: Flat Bootstrap
 * 
 * The "sidebar" for the top of the page (after the nav bar). If no widgets added AND
 * preivewing the theme, then display some widgets as samples. Once the theme is actually
 * in use, it will be empty until the user adds some actual widgets.
 *
 * @package flat-bootstrap
 */
?>

<?php 
global $xsbf_theme_options;
	
/* If page top "sidebar" has widgets, then display them */
$sidebar_pagetop = get_dynamic_sidebar( 'sidebar-3' );
$sidebar_pagetop = apply_filters( 'xsbf_pagetop', $sidebar_pagetop );

if ( $sidebar_pagetop ) :
?>
	<div id="sidebar-pagetop" class="sidebar-pagetop">
		<?php //echo apply_filters( 'xsbf_pagetop', $sidebar_pagetop ); ?>
		<?php echo $sidebar_pagetop; ?>
	</div><!-- .sidebar-pagetop -->

<?php
/* Otherwise, show an example if we are on the front page and its set to display the blog */
/*elseif ( $xsbf_theme_options['sample_widgets'] != false AND is_front_page() AND is_home() ) :

?>
	<div id="sidebar-pagetop" class="sidebar-pagetop">

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

<?php */ endif; ?>