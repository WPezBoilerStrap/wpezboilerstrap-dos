<?php

namespace WPezClasses\Menus;

if ( !defined('ABSPATH') ) {
	header('HTTP/1.0 403 Forbidden');
	die();
}


class Walker_Bootstrap_3x_2 extends \Walker_Nav_Menu {

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
	
	public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

			$class_names = $value = '';

			$classes_all = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[0] = $classes_all[0];
			// $classes[] = 'menu-item-' . $item->ID;

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

		//	if ( $args->has_children )
		//		$class_names .= ' dropdown';
		//	if ( in_array( 'current-menu-item', $classes ) )
		//		$class_names .= ' active';

			$class_names = $class_names ? ' class="carousel-caption ' . esc_attr( $class_names ) . '"' :  ' class="carousel-caption"';

			$id = apply_filters( 'nav_menu_item_id', 'slider-caption-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			// $output .= $indent . '<li' . $id . $value . $class_names .'>';
		
			$output .= $indent . '<div' . $id . $value . $class_names .'>';

			$atts = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target )	? $item->target	: '';
			$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';
			$atts['data-description'] = ! empty( $item->description ) ? $item->description : '';

			// If item has_children add atts to a.
		//	if ( $args->has_children && $depth === 0 ) {
		//		$atts['href']   		= '#';
		//		$atts['data-toggle']	= 'dropdown';
		//		$atts['class']			= 'dropdown-toggle';
		//		$atts['aria-haspopup']	= 'true';
		//	} else {
				$atts['href'] = ! empty( $item->url ) ? $item->url : '';
		//	}

			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$item_output = $args->before;

			$item_output .= '<a '. $attributes .'>';

			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		//	$item_output .= ( $args->has_children && 0 === $depth ) ? ' <span class="caret"></span></a>' : '</a>';
			$item_output .= '</a>';

			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	
	public function end_el(&$output, $item, $depth=0, $args=array()) {
        $output .= "</div>\n";
    }

}