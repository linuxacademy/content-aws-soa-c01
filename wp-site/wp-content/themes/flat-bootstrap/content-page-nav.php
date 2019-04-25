<?php
/**
 * Theme: Flat Bootstrap
 * 
 * The template used for displaying next / previous page links
 *
 * @package flat-bootstrap
 */
?>

<?php

/*
 * If page content split into multiple pages, display links
 */
$link_pages = wp_link_pages( array(
	'next_or_number'   	=> 'next',
	'before' 			=> '<li>',
	'after'  			=> '</li>',
	'nextpagelink'     	=> __( 'Next page &rarr;', 'flat-bootstrap' ),
	'previouspagelink' 	=> __( '&larr; Previous page', 'flat-bootstrap' ),
	'echo'				=> false
) );
if ( $link_pages ) echo '<ul class="pager">' . $link_pages . '</ul>';

/*
 * For sub-pages, display links to previous and next sibling
 */
if ( $post->ID != $post->post_parent AND $post->post_parent != 0 AND get_page_template_slug( $post->post_parent ) == 'page-fullwithsubpages.php' AND ! is_page_template( 'page-fullwithsubpages.php' ) ) {

	$args = array(
		'parent'   		=> $post->post_parent,
		'hierarchical'  => null,
		'sort_column' 	=> 'menu_order',
	);
	$pagelist = get_pages( $args );
	$pages = array();
	foreach ($pagelist as $page) {
	   $pages[] += $page->ID;
	}

	$current = array_search(get_the_ID(), $pages);
	$prevID = $current > 0 ? $pages[$current-1] : null;
	$nextID = $current < ( count( $pages ) - 1 ) ? $pages[$current+1] : null;

	if ( ! empty( $prevID ) OR ! empty ( $nextID ) ) {
	?>		
		<div class="container">
		<nav role="navigation" id="subpage-navigation" class="page-navigation">
		<h1 class="screen-reader-text sr-only"><?php _e( 'Page navigation', 'flat-bootstrap' ); ?></h1>
		<ul class="pager">
		<?php if ( ! empty( $prevID ) ) { ?>
		<li class="nav-next">
		<a href="<?php echo get_permalink($prevID); ?>">
		&larr; <?php echo get_the_title($prevID); ?></a>
		</li>
		<?php }

		if (!empty($nextID)) { ?>
		<li class="nav-previous">
		<a href="<?php echo get_permalink($nextID); ?>"><?php echo get_the_title($nextID); ?> &rarr; 
</a>
		</li>
		<?php } ?>
		</ul>
		</nav>
		</div><!-- .container -->
<?php 
	} //endif ! empty
} //endif is_page_template