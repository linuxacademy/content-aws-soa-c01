<?php
/**
 * Theme: Flat Bootstrap
 * 
 * The template used for displaying page content for pages with posts at the end
 *
 * @package flat-bootstrap
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h3>' ); ?>
	</header><!-- .entry-header -->

	<?php if ( has_post_thumbnail() AND !is_search() ) : ?>
		<a class="post-thumbnail" href="<?php the_permalink(); ?>">
		<div class="post-thumbnail">
			<?php the_post_thumbnail( 'post-thumbnail' , $attr = array( 'class'=>'thumbnail img-responsive' ) ); ?>
		</div>
		</a>
	<?php endif; ?>

 	<div class="entry-summary">
		<?php the_excerpt(); ?>
 	</div><!-- .entry-summary -->

</article><!-- #post-## -->
