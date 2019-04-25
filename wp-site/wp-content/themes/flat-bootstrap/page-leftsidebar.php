<?php
/**
 * Theme: Flat Bootstrap
 * 
 * Template Name: Page - Left Sidebar
 *
 * Page with the sidebar on the left instead of the right
 *
 * This is the template that displays pages with the sidebar on the left.
 *
 * @package flat-bootstrap
 */
get_header(); ?>

<?php get_template_part( 'content', 'header' ); ?>

<?php get_sidebar( 'home' ); ?>

<div class="container">
<div id="main-grid" class="row">

	<div id="primary" class="content-area col-md-8 col-md-push-4">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_sidebar( 'left' ); ?>
		
</div><!-- .row -->
</div><!-- .container -->

<?php get_footer(); ?>
