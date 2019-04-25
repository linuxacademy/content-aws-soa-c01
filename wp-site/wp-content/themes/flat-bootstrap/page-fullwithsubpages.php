<?php
/**
 * Theme: Flat Bootstrap
 * 
 * Template Name: Page - Full Width with Sub Pages
 *
 * Full width page template (no sidebar, no container) with sub-pages
 *
 * This template is full-width with no sidebar or container. It also lists all of the
 * sub-pages (child pages) of the current page. This page truly stretches the full width
 * of the browser window, so you should set a <div class="container"> before your
 * content to keep it in line with the rest of the site content.
 *
 * @package flat-bootstrap
 */

/* YOU CAN EDIT THESE VARIABLES HERE TO CHANGE THE WAY THE PAGE DISPLAYS
 *
 * $posts_per_page: Number of posts to display in a single page.
 * $posts_per_row: Number of posts per row. Must divide into 12. ie. 1-4 or 6
*/ 
$posts_per_page = 999; //Make this really high for now
$posts_per_row = 2;

/* DON'T CHANGE ANYTHING BELOW HERE */
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
					
		<?php /* DISPLAY THE SUB-PAGES OF THIS PAGE */
		// There is no pagination yet, so $posts_per_page needs to be the max number of
		// child pages you'd ever have. TO-DO: ADD PAGINATION
		$paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
		$args = array(
			'post_type' 		=> 'page',
			'nopaging'			=> true,
			'posts_per_page' 	=> $posts_per_page,
			'orderby' 			=> 'menu_order',
			'order'				=> 'asc',
			'paged' 			=> $paged,
			'post_parent' 		=> get_the_ID()
		);
		$list_of_posts = new WP_Query( $args );
		?>
		<?php if ( $list_of_posts->have_posts() ) : ?>
			<div id="page-subpages" class="page-subpages">
			<div class="container"><div class="row">

			<?php /* Determine # of columns based on parameters above */
			$num_cols = 12 / $posts_per_row;
			?>

			<?php /* The loop */ ?>
			<?php $count = 0; ?>
			<?php while ( $list_of_posts->have_posts() AND $count < $posts_per_page ) : $list_of_posts->the_post(); ?>
				<?php if ( $count > 0 AND $count % $posts_per_row == 0 ) echo '</div><div class="row">'; ?>
				<div class="col-lg-<?php echo $num_cols ?>">
				<?php // Display content of posts ?>
				<?php get_template_part( 'content', 'page-posts' ); ?>
				</div>
				<?php $count++; ?>
			<?php endwhile; ?>

			<?php get_template_part( 'content', 'page-nav' ); ?>

			<?php //get_template_part( 'content', 'index-nav' ); ?>	

			</div><!-- row --></div><!-- container -->
			</div><!-- page-subpages -->

		<?php endif; ?>
					
		<?php 
		/* Restore original Post Data */
		wp_reset_postdata();		
		?>
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
