<?php
/**
 * Theme: Flat Bootstrap
 * 
 * The template used for displaying page content for fullwidth pages. It contains 
 * everything after the_content()
 *
 * @package flat-bootstrap
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div id="xsbf-entry-content" class="entry-content">

		<?php get_sidebar( 'home' ); ?>
		
		<?php the_content(); ?>
		
		<?php get_template_part( 'content', 'page-nav' ); ?>

		<?php edit_post_link( __( '<span class="glyphicon glyphicon-edit"></span> Edit', 'flat-bootstrap' ), '<div class="container"><footer class="entry-meta"><div class="edit-link">', '</div></div></footer>' ); ?>
		
	</div><!-- .entry-content -->
	
</article><!-- #post-## -->
