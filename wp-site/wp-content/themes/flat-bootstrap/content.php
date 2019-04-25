<?php
/**
 * Theme: Flat Bootstrap
 * 
 * The default template used for displaying page and article content. Note that certain
 * pages, index, articles may use a different template.
 *
 * @package flat-bootstrap
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php get_template_part( 'content', 'post-header' ); ?>

	<?php 
	/* 
	 * For index pages, display the thumbnail and excerpt 
	 */ 
	?>
	<?php if ( !is_singular() ) : ?>
		<?php if ( has_post_thumbnail() AND !is_search() ) : ?>
			<div class="post-thumbnail">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">

				<?php the_post_thumbnail( 'post-thumbnail' , $attr = array( 'class'=>'thumbnail img-responsive post-thumbnail' ) ); ?>
				</a>
			</div><!-- .post-thumnail -->
		<?php endif; ?>

		<div class="entry-summary">
		<?php the_excerpt(); ?>
		<hr>
		</div><!-- .entry-summary -->

	<?php 
	/* 
	 * For non-index pages (single posts and pages), display the full content
	 */ 
	?>
	<?php else : ?>
		<div id="xsbf-entry-content" class="entry-content">
		
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'flat-bootstrap' ) ); ?>

			<?php get_template_part( 'content', 'post-footer' ); ?>

			<?php // If multiple pages, display next/previous page links ?>
			<?php get_template_part( 'content', 'page-nav' ); ?>

		</div><!-- .entry-content -->
	
	<?php endif; ?>
	
</article><!-- #post-## -->
