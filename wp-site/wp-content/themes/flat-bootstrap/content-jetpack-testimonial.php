<?php
/**
 * Theme: Flat Bootstrap
 * 
 * This template overrides content.php for Jetpack testimonials. 
 *
 * To keep the theme clean, this template handles the entry header, content, and footer
 * so we don't have to add more template parts or add more logic to existing template 
 * parts to get what we want here. 
 * 
 * The main purpose of this is to output the title without a link to the single entry and 
 * get rid of the "read more" link. In the future, we may want to use a different profile
 * picture size, etc. 
 *
 * @package flat-bootstrap
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php /* Display the post thumbnail (profile pic) first. Float it to the left. */ ?>
	<?php if ( has_post_thumbnail() AND !is_search() ) : ?>
		<div class="post-thumbnail">
		<?php the_post_thumbnail( 'post-thumbnail' , $attr = array( 'class'=>'thumbnail img-responsive post-thumbnail' ) ); ?>
		</div><!-- .post-thumnail -->
	<?php endif; ?>

	<?php /* Display the post content (quote) as a blockquote and float it left too. */  ?>
	<div class="entry-summary">
	<blockquote><p>
	<?php 
	$the_content = get_the_content();
	echo $the_content;
	?>
	</p>
	<footer><?php the_title(); ?></footer>
	</blockquote>
	</div><!-- .entry-summary -->

</article><!-- #post-## -->

<hr>
