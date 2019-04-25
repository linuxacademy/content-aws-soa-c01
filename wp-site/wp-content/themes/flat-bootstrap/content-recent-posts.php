<?php
/**
 * Theme: Flat Bootstrap
 * 
 * Retrieve up to 3 recent posts and display them
 *
 * @package flat-bootstrap
 */
?>

<?php /* DISPLAY THE MOST RECENT POSTS (NOTE STICKY POSTS FIRST) */
$num_posts = 3; // Should be a factor of 12 column grid
//$paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
$args = array(
	'post_type' => 'post',
	'posts_per_page' => $num_posts,
	//'paged' => $paged
);
$list_of_posts = new WP_Query( $args );
?>
<?php if ( $list_of_posts->have_posts() ) : ?>
	<div id="page-posts" class="page-posts">
	<div class="container"><div class="row">

	<?php /* Determine # of columns and # of posts per row */
	//$count_posts = count ( $list_of_posts->posts );
	$count_posts = count ( $list_of_posts->posts ) <= $num_posts ? count ( $list_of_posts->posts ) : $num_posts;
	if ( $count_posts % 4 == 0 ) $per_row = 4;
	elseif ( $count_posts % 3 == 0) $per_row = 3;
	else $per_row = 2;			
	$num_cols = 12 / $per_row;
	?>

	<?php /* The loop */ ?>
	<?php $count = 0; ?>
	<?php while ( $list_of_posts->have_posts() AND $count < $num_posts ) : $list_of_posts->the_post(); ?>
		<?php if ( $count > 0 AND $count % $per_row == 0 ) echo '</div><div class="row">'; ?>
		<div class="col-lg-<?php echo $num_cols ?>">
		<?php // Display content of posts ?>
		<?php get_template_part( 'content', 'page-posts' ); ?>
		</div>
		<?php $count++; ?>
	<?php endwhile; ?>

	</div><!-- row --></div><!-- container -->
	</div><!-- page-posts -->

<?php endif; ?>	
<?php 
/* Restore original Post Data */
wp_reset_postdata();		
?>
