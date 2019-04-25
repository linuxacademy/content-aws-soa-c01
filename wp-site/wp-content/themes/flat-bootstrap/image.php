<?php
/**
 * Theme: Flat Bootstrap
 * 
 * The template for displaying image attachments.
 *
 * @package flat-bootstrap
 */

get_header(); ?>

	<div id="primary" class="content-area-wide image-attachment">
		<main id="main" class="site-main" role="main">
		<div class="container">

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

					<div class="entry-meta">
						<?php
							$metadata = wp_get_attachment_metadata();
							printf( __( 'Published <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span> at <a href="%3$s">%4$s &times; %5$s</a> in <a href="%6$s" rel="gallery">%7$s</a>', 'flat-bootstrap' ),
								esc_attr( get_the_date( 'c' ) ),
								esc_html( get_the_date() ),
								esc_url( wp_get_attachment_url() ),
								$metadata['width'],
								$metadata['height'],
								esc_url( get_permalink( $post->post_parent ) ),
								get_the_title( $post->post_parent )
							);
						?>
						<?php //get_template_part( 'content', 'edit-link' ); ?>
					</div><!-- .entry-meta -->

					<nav role="navigation" id="image-navigation" class="image-navigation">
						<ul class="pager nocenter">
						<li class="nav-previous"><?php previous_image_link( false, __( '<span class="meta-nav">&larr;</span> Previous', 'flat-bootstrap' ) ); ?></li>
						<li class="nav-next"><?php next_image_link( false, __( 'Next <span class="meta-nav">&rarr;</span>', 'flat-bootstrap' ) ); ?></li>
						</ul>
					</nav><!-- #image-navigation -->
				</header><!-- .entry-header -->

				<div id="xsbf-entry-content" class="entry-content">
				
					<div class="entry-attachment">
						<div class="attachment">
							<?php xsbf_the_attached_image(); ?>
						</div><!-- .attachment -->

						<?php if ( has_excerpt() ) : ?>
						<div class="entry-caption">
							<?php the_excerpt(); ?>
						</div><!-- .entry-caption -->
						<?php endif; ?>
					</div><!-- .entry-attachment -->

					<?php
						the_content();
					?>

					<?php get_template_part( 'content', 'page-nav' ); ?>

					<?php edit_post_link( __( '<span class="glyphicon glyphicon-edit"></span> Edit', 'flat-bootstrap' ), '<br /><footer class="entry-meta"><div class="edit-link">', '</div></footer>' ); ?>
				</div><!-- .entry-content -->

			</article><!-- #post-## -->

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				/*if ( comments_open() || '0' != get_comments_number() )
					comments_template(); */
			?>

		<?php endwhile; // end of the loop. ?>

		</div><!-- .container -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
