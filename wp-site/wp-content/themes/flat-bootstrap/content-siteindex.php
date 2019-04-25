<?php
/**
 * Theme: Flat Bootstrap
 * 
 * The template used for displaying a site index within a page
 *
 * @package flat-bootstrap
 */
?>

<?php // If you have search in the sidebar, you can comment this out ?>
<?php get_search_form(); ?>

<?php // List all pages on the site. Be sure to order them in page admin. ?>
<div class="widget widget_pages">
	<h2 class="widgettitle"><?php _e( 'Site Content', 'flat-bootstrap' ); ?></h2>
	<ul>
	<?php
		wp_list_pages( array ( 'title_li' => '' ) );
		
		// Add link to portfolio page, if that custom post type is active
		$portfolio_page = esc_url( get_post_type_archive_link( 'jetpack-portfolio' ) );
		if ( $portfolio_page ) {
			echo '<li class="page-item page-item-portfolio">'
				.'<a href="' . $portfolio_page . '">'
				. __( 'Portfolio', 'flat-bootstrap' )
				.'</a>';
		}

		// Add link to testimonial page, if that custom post type is active
		$testimonial_page = esc_url( get_post_type_archive_link( 'jetpack-testimonial' ) );
		if ( $testimonial_page ) {
			echo '<li class="page-item page-item-portfolio">'
				.'<a href="' . $testimonial_page . '">'
				. __( 'Testimonials', 'flat-bootstrap' )
				.'</a>';
		}

		// Add login/logout/register link. Strip the <br/> tag from it.
		echo '<li class="page-item page-item-loginout">'
			.strip_tags ( wp_loginout( null, false), '<a>' )
			.'</li>';
	?>
	</ul>
</div><!-- .widget -->

<?php // If this blog has more than one category, display them ?>
<?php if ( ! function_exists( 'xsbf_categorized_blog' ) OR xsbf_categorized_blog() ) : ?>
<div class="widget widget_categories">
	<h2 class="widgettitle"><?php _e( 'Categories', 'flat-bootstrap' ); ?></h2>
	<ul>
	<?php
	wp_list_categories( array(
		'show_count' => 1,
		'title_li'   => '',
	) );
	?>
	</ul>
</div><!-- .widget -->
<?php endif; ?>

<?php // Display a tag cloud
$tag_cloud = wp_tag_cloud( array ( 
	'echo'		=> false, 
	'separator'	=> ', ',
	'smallest' 	=> 12,
	'largest'	=> 26
) ); 
if ( $tag_cloud ) {
	echo '<h2>' . __( 'Tags', 'flat-bootstrap' ) . '</h2>';
	echo $tag_cloud;
}
?>

<?php // If this blog has portfolio categories (types), display them ?>
<?php 
$portfolio_types = wp_list_categories( array(
		'show_count' => true,
		'title_li'   => '', //_x ( 'Portfolio Categories', 'flat-bootstrap' ),
		'taxonomy'	=> 'jetpack-portfolio-type',
		'echo'		=> false
) );
if ( $portfolio_types ) : 
?>
<div class="widget widget_portfolio_types">
	<h2 class="widgettitle"><?php _e( 'Portfolio Types', 'flat-bootstrap' ); ?></h2>
	<ul>
	<?php echo $portfolio_types;	?>
	</ul>
</div><!-- .widget -->
<?php endif; ?>

<?php // Display a portfolio tag cloud, if there are any
$portfolio_tag_cloud = wp_tag_cloud( array ( 
	'echo'		=> false, 
	'separator'	=> ', ',
	'taxonomy'	=>'jetpack-portfolio-tag',
	'smallest' 	=> 12,
	'largest'	=> 26,
) ); 
if ( $portfolio_tag_cloud ) {
	echo '<h2>' . __( 'Portfolio Tags', 'flat-bootstrap' ) . '</h2>';
	echo $portfolio_tag_cloud;
}
?>

<?php // If you want to list monthly archives, uncomment the following
/*
$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'flat-bootstrap' ), convert_smilies( ':)' ) ) . '</p>';
the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
*/
?>

<?php // Display some recent posts ?>
<?php the_widget( 'WP_Widget_Recent_Posts', array('number'=>10) ); ?>
