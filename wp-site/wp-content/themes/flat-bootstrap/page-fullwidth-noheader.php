<?php
/**
 * Theme: Flat Bootstrap
 * 
 * Template Name: Page - Full Width No Content Header
 *
 * Full width page template without sidebar or page header.
 *
 * This is the template for full width pages with no sidebar, no container, and
 * no page header. This page truly stretches the full width of the browser window. 
 * You should set a <div class="container"> before your content to keep it in line 
 * with the rest of the site content.
 *
 * @package flat-bootstrap
 */

get_header(); ?>

<div id="primary" class="content-area-wide">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page-fullwidth' ); ?>
		
			<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() ) :
			?>
			<div class="comments-wrap">
			<div class="container">
			<?php comments_template(); ?>
			</div><!-- .container -->
			</div><!-- .comments-wrap"
			<?php endif; ?>

		<?php endwhile; // end of the loop. ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
