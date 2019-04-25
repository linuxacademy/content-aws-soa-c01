<?php
/**
 * Theme: Flat Bootstrap
 * 
 * The template used for displaying a single article (blog post) as full-width
 *
 * @package flat-bootstrap
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="container padding-top-bottom text-center">
	<?php get_template_part( 'content', 'post-header' ); ?>
	</div>
	
	<div id="xsbf-entry-content" class="entry-content">

		<?php the_content(); ?>
		
		<div class="container">
		<?php get_template_part( 'content', 'post-footer' ); ?>
		<?php get_template_part( 'content', 'page-nav' ); ?>
		</div>
		
	</div><!-- .entry-content -->

</article><!-- #post-## -->
