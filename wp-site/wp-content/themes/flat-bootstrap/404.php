<?php
/**
 * Theme: Flat Bootstrap
 * 
 * The template for displaying 404 pages (Not Found).
 *
 * @package flat-bootstrap
 */

get_header(); ?>

<?php /* Display the header full-width to match our theme */ ?>
<header class="content-header">
	<div class="container">
		<section class="error-404 not-found">
			<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'flat-bootstrap' ); ?></h1>
			<h3 class="page-description"><?php _e( 'Or as techies would say, its a "404 Error"', 'flat-bootstrap' ); ?></h3>
		</section><!-- .error-404 -->
	</div><!-- .container -->
</header>

<?php /* Now display the main page and sidebar */ ?>
<div class="container">
<div id="main-grid" class="row">

	<div id="primary" class="content-area col-md-8">
		<main id="main" class="site-main" role="main">

			<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search or one of the links below?', 'flat-bootstrap' ); ?></p>

			<?php get_template_part( 'content', 'siteindex' ); ?>
				
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_sidebar(); ?>
		
</div><!-- .row -->
</div><!-- .container -->

<?php get_footer(); ?>