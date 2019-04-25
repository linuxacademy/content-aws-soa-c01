<?php
/**
 * Theme: Flat Bootstrap
 * 
 * The template used for displaying single post header meta (posted on, by, etc.)
 *
 * @package flat-bootstrap
 */
?>

<header class="entry-header">
	<div class="entry-meta">
	
		<?php if ( !is_single() AND !is_page() ) : ?>
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<?php endif; // !is_single... ?>

		<?php if ( is_single() OR is_home() ) : ?>

			<?php $the_date = get_the_date(); ?>
			<p><span class="posted-on"><span class="glyphicon glyphicon-calendar"></span>&nbsp;
			<?php echo $the_date; ?> 
			</span>
	
			<?php if ( is_multi_author() ) : ?>
	 			&nbsp;|&nbsp;<span class="by-line">
	 			<span class="glyphicon glyphicon-user"></span>&nbsp;
	 			<span class="author vcard">
					<?php the_author_posts_link(); ?> 
				</span>
				</span>
			<?php endif; // is_multi_author ?>

		<?php //endif; // is_single ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			 &nbsp;|&nbsp;<span class="comments-link">
			 <span class="glyphicon glyphicon-comment"></span>&nbsp;
			 <?php comments_popup_link( __( 'Leave a comment', 'flat-bootstrap' ), __( '1 Comment</span>', 'flat-bootstrap' ), __( '% Comments', 'flat-bootstrap' ), 'smoothscroll' ); ?>
			 </span>
		<?php endif; // ! post_password... ?>

		<?php endif; // is_single ?>
		
	</div><!-- .entry-meta -->
</header><!-- .entry-header -->
