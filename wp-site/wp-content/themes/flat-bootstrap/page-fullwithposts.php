<?php
/**
 * Theme: Flat Bootstrap
 * 
 * Template Name: Page - Full Width with Recent Posts
 *
 * Full width page template (no sidebar, no container) with 3 columns of recent posts
 *
 * This is the template for full width pages with no sidebar and no container. It also
 * lists your 3 most recent posts. This page truly stretches the full width of the 
 * browser window. You should set a <div class="container"> before your content to keep 
 * it in line with the rest of the site content.
 *
 * @package flat-bootstrap
 */

get_header(); ?>

<?php get_template_part( 'content', 'header' ); ?>

<div id="primary" class="content-area-wide">
	<main id="main" class="site-main" role="main">
	
		<?php /* DISPLAY THE PAGE CONTENT FIRST */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php //get_template_part( 'content', 'page-fullwidth' ); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<div id="xsbf-entry-content" class="entry-content">

					<?php get_sidebar( 'home' ); ?>

					<?php the_content(); ?>

					<?php get_template_part( 'content', 'recent-posts' ); ?>

					<?php get_template_part( 'content', 'page-nav' ); ?>

					<?php edit_post_link( __( '<span class="glyphicon glyphicon-edit"></span> Edit', 'flat-bootstrap' ), '<div class="container"><footer class="entry-meta"><div class="edit-link">', '</div></div></footer>' ); ?>

				</div><!-- .entry-content -->
	
			</article><!-- #post-## -->

			<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() ) :
			?>
				<div class="comments-wrap">
				<div class="container">
				<?php comments_template(); ?>
				</div><!-- .container -->
				</div><!-- .comments-wrap" -->
			<?php endif; ?>

		<?php endwhile; // end of the loop. ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php //get_sidebar(); ?>

<?php get_footer(); ?>
