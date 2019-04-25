<?php
/**
 * Theme: Flat Bootstrap
 * 
 * Template Name: Page - Site Index
 *
 * Page with sidebar that displays a site index
 *
 * This is the template that displays a site index with search, pages, categories,
 * tags, etc. It has a sidebar.
 *
 * @package flat-bootstrap
 */

get_header(); ?>

<?php get_template_part( 'content', 'header' ); ?>

<?php get_sidebar( 'home' ); ?>

<div class="container">
<div id="main-grid" class="row">

	<div id="primary" class="content-area col-md-8">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php //get_template_part( 'content', 'page' ); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div id="xsbf-entry-content" class="entry-content">

						<?php the_content(); ?>

						<?php get_template_part( 'content', 'siteindex' ); ?>

						<?php get_template_part( 'content', 'page-nav' ); ?>

						<?php edit_post_link( __( '<span class="glyphicon glyphicon-edit"></span> Edit', 'flat-bootstrap' ), '<footer class="entry-meta"><div class="edit-link">', '</div></footer>' ); ?>

					</div><!-- .entry-content -->
	
				</article><!-- #post-## -->
				
				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_sidebar(); ?>
		
</div><!-- .row -->
</div><!-- .container -->

<?php get_footer(); ?>
