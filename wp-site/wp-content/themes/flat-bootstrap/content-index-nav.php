<?php 
/**
 * Theme: Flat Bootstrap
 * 
 * The template used for paging through the post index, archive, search results
 *
 * @package flat-bootstrap
 */
?>

<nav role="navigation" id="nav-below" class="paging-navigation">

	<?php if ( $wp_query->max_num_pages > 1 ) : ?>

	<h1 class="screen-reader-text sr-only"><?php _e( 'paging-navigation', 'flat-bootstrap' ); ?></h1>

		<?php
		$pagination = array(
			'base'      => str_replace( 99999, '%#%', get_pagenum_link( 99999 ) ),
			'format'    => '?paged=%#%',
			'current'   => max( 1, get_query_var( 'paged' ) ),
			'total'     => $wp_query->max_num_pages,
			'next_text' => '<span class="glyphicon glyphicon-chevron-right"></span>',
			'prev_text' => '<span class="glyphicon glyphicon-chevron-left"></span>',
 			'type'		=> 'array',
			'type_class'		=> 'pagination'
		);
		$page_links = paginate_links ($pagination);
		if ( $page_links ) {
			echo '<div class="primary-links">'
				.'<ul class="page-numbers pagination">'
				.'<li>' . join('</li><li>', $page_links)
				. '</li></ul>'
				. '</div>';
		}
		?>
		
	<?php endif; ?>
