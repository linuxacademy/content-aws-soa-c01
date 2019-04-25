<?php
/**
 * Theme: Flat Bootstrap
 * 
 * Override the WordPress nav-menu function to add bootstrap classes
 *
 * @package flat-bootstrap
 */

/**
 * Class Name: wp_bootstrap_navwalker
 * GitHub URI: https://github.com/twittem/wp-bootstrap-navwalker
 * Description: A custom WordPress nav walker class to implement the Bootstrap 3 navigation style in a custom theme using the WordPress built in menu manager.
 * Version: 2.0.4
 * Author: Edward McIntyre - @twittem
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * Modified by Tim Nicholson for the xtremelysocial-bootstrap theme to include default
 * WordPress classes, handle font-awesome and smoothscrolling, as well as have the menu
 * default to wp_list_pages instead of "Add a menu"
 */

class wp_bootstrap_navwalker extends Walker_Nav_Menu {

	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu\">\n";
	}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		/**
		 * Dividers, Headers or Disabled
		 * =============================
		 * Determine whether the item is a Divider, Header, Disabled or regular
		 * menu item. To prevent errors we use the strcasecmp() function to so a
		 * comparison that is not case sensitive. The strcasecmp() function returns
		 * a 0 if the strings are equal.
		 */
		if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
		} else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {
			$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
		} else {

			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

			/* Bootstrap dropdown menu */
			if ( $args->has_children )
				$class_names .= ' dropdown';

			/* Bootstrap active item class */
			if ( in_array( 'current-menu-item', $classes ) )
				$class_names .= ' active';

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names .'>';

			$atts = array();
			
			/* If keyword "smoothscroll" then add the class to trigger the javascript */
			if ( ! empty( $item->attr_title ) AND stripos ( $item->attr_title, 'smoothscroll' ) !== false ) {
				$item->attr_title = str_ireplace( 'smoothscroll', '', $item->attr_title );
				/*$atts['class'] = 'smoothScroll';*/
				$atts['class'] = 'smoothscroll';
			}			
			
			//$atts['title']  = ! empty( $item->title )	? $item->title	: '';
			$atts['title']  = ! empty( $item->attr_title )	? $item->attr_title	: $item->title;
			$atts['target'] = ! empty( $item->target )	? $item->target	: '';
			$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';

			// If item has_children add atts to a href. Don't do this if depth is 1.
			//if ( $args->has_children && $depth === 0 ) {
			if ( $args->has_children && $depth === 0 && $args->depth != 1) {
				$atts['href']   		= '#';
				//$atts['href'] 			= ! empty( $item->url ) ? $item->url : '';
				$atts['data-target']	= '#';
				//$atts['data-target']	= ! empty( $item->url ) ? $item->url : '';
				$atts['data-toggle']	= 'dropdown';
				$atts['class']			= 'dropdown-toggle';
			} else {
				$atts['href'] = ! empty( $item->url ) ? $item->url : '';
			}
			
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$item_output = $args->before;

			/*
			 * Bootstrap Glyphicons AND Font-Awesome Icons
			 * ===========
			 * Since the the menu item is NOT a Divider or Header we check the see
			 * if there is a value in the attr_title property. If the attr_title
			 * property is NOT null we apply it as the class name for the glyphicon
			 * or font-awesome icon.
			 */
			if ( ! empty( $item->attr_title ) AND stripos ( $item->attr_title, 'glyphicon-' ) !== false) {
				$item_output .= '<a'. $attributes .'><span class="glyphicon ' . esc_attr( $item->attr_title ) . '"></span>&nbsp;';
			} elseif ( ! empty( $item->attr_title ) AND stripos ( $item->attr_title, 'fa-' ) !== false ) {
				$item_output .= '<a'. $attributes .'><span class="fa ' . esc_attr( $item->attr_title ) . '"></span>&nbsp;';
			} else {
				$item_output .= '<a'. $attributes .'>';
			}
			
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			//$item_output .= ( $args->has_children && 0 === $depth ) ? ' <span class="caret"></span></a>' : '</a>';
			$item_output .= ( $args->has_children && 0 === $depth && $args->depth != 1 ) ? ' <span class="caret"></span></a>' : '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}

	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @see Walker::start_el()
	 * @since 2.5.0
	 *
	 * @param object $element Data object
	 * @param array $children_elements List of elements to continue traversing.
	 * @param int $max_depth Max depth to traverse.
	 * @param int $depth Depth of current element.
	 * @param array $args
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return null Null on failure with no changes to parameters.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element )
            return;

        $id_field = $this->db_fields['id'];

        // Display this element.
        if ( is_object( $args[0] ) )
           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

	/**
	 * Menu Fallback
	 * =============
	 * If this function is assigned to the wp_nav_menu's fallback_cb variable
	 * and a manu has not been assigned to the theme location, the function 
	 * will build a small menu with home and the first 4 pages.
	 *
	 * @param array $args passed from the wp_nav_menu function.
	 *
	 */
	public static function fallback( $args ) {

		// Get function arguments
		extract( $args );
		$fb_output = null;

		// Build the container div
		if ( $container ) {
			$fb_output = '<' . $container;
			if ( $container_id )
				$fb_output .= ' id="' . $container_id . '"';
			if ( $container_class )
				$fb_output .= ' class="' . $container_class . '"';
			$fb_output .= '>';
		}

		// Build the unordered list
		$fb_output .= '<ul';
		if ( $menu_id )
			$fb_output .= ' id="' . $menu_id . '"';
		if ( $menu_class )
			$fb_output .= ' class="' . $menu_class . '"';
		$fb_output .= '>';

		// Add a home link		
		//$fb_output .= '<li><a href="' . home_url() . '">Home</a></li>';
		
		// If static front page, add a link to the blog
		/*
		$posts_page_id = get_option ( 'page_for_posts' );
		if ( $posts_page_id ) {
			$posts_page = get_page( $posts_page_id );
			$fb_output .= '<li><a href="' . get_page_uri( $posts_page_id ) . '">' 
				. $posts_page->post_title . '</a></li>';
		}
		*/
		
		// Add the first 4 pages, based on menu order
		$pages = get_pages( array ( 'sort_column' => 'menu_order', 'parent' => 0, 'number' => 4 ) ); 
		foreach ( $pages as $page ) {
			//$fb_output .= '<li><a href="' . get_page_uri( $page->ID ) . '">' 
			$fb_output .= '<li><a href="' . get_page_link( $page->ID ) . '">' 
				. $page->post_title . '</a></li>';
		}

		// If admin, show link to add a menu
		/*
		if ( current_user_can( 'manage_options' ) ) {
			$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
		}
		*/

		// End the unordered list
		$fb_output .= '</ul>';

		// End the container
		if ( $container )
			$fb_output .= '</' . $container . '>';

		// Return the menu
		return $fb_output;
	} //endif function

} //end class
