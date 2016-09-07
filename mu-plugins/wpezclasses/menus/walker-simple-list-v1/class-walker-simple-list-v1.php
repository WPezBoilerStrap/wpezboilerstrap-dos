<?php

namespace WPezClasses\Menus;

if ( !defined('ABSPATH') ) {
	header('HTTP/1.0 403 Forbidden');
	die();
}


class Walker_Simple_List_V1 extends \Walker_Nav_Menu {


    /**
     * @var
     */
    protected $_arr_ez_args_defaults;

    /**
     * @var
     */
    protected $_str_item_tag;



    /**
     * you can also pass these in via the args array for the menu
     *
     * @return array
     *
     */
    protected function ez_args_defaults(){

        $arr_ez_args_defaults = array(

            'item_tag'          => 'li',                            // what tag will rap a given item. see also method: valid_item_tags()
            'item_id_slug'      => 'simple-list-1-item-',
            'item_class'        => 'simple-list-1-item',
            'active_class'      => 'active',

            'parent'            => 'is-parent',                     // a given item can be assigned parent and child classes in case you need a bit more than uber simple
            'not_parent'        => 'not-parent',
            'child'             => 'is-child',
            'child_of'          => 'is-child-of-',
            'not_child'         => 'not-child',

            'separator_active'  => true,                            // on / off switch for using the separator
            'separator_outside' => true,                            // is the separator within the </a> or outside?
            'separator_class'   => 'simple-list-1-delimiter-wrap',  // assign a class to the separator
            'separator'         => ','                              // what is the separator? the default is ',' (comma)

            //   'title_prefix'      => '',
            //  'target_default'    => '_blank',
        );
        return $arr_ez_args_defaults;
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
    public function start_lvl( &$output, $depth = 0, $args = array() ) {

        $output .= '';
    }


    /**
     * @param string $output
     * @param int $depth
     * @param array $args
     */
    public function end_lvl( &$output, $depth = 0, $args = array() ) {

        $output .= '';

    }


    /**
     * @param string $output
     * @param object $item
     * @param int $depth
     * @param array $args
     * @param int $id
     */
	public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0 ){

        $arr_ez_args_defaults = $this->ez_args_defaults();
        if ( isset($args->ez_args) && is_array($args->ez_args) ){
            $arr_ez_args_defaults = array_merge($arr_ez_args_defaults, $args->ez_args );
        }

        // the property keeps the end_el() informed.
        $this->_arr_ez_args_defaults = $arr_ez_args_defaults;

        // how many total elements in this list
        $int_ele_cnt = $this->elements_count($args);

        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $class_names = $value = '';
        $classes_all = empty($item->classes) ? array() : (array)$item->classes;
        $classes[0] = $classes_all[0];

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));

        // has children?
        if ($args->walker->has_children) {
            $class_names .= ' ' .  $arr_ez_args_defaults['parent'];
        } else {
            $class_names .= ' ' .  $arr_ez_args_defaults['not_parent'];
        }

        // is a child?
        if ( $item->menu_item_parent == 0 ){
            $class_names .= ' ' . $arr_ez_args_defaults['not_child'];
        } else{
            $class_names .= ' ' . $arr_ez_args_defaults['child'];
            $class_names .= ' ' . $arr_ez_args_defaults['child_of'] . $item->menu_item_parent;
        }

        if ( in_array( 'current-menu-item', $classes_all ) ){
            $class_names .= ' ' .  $arr_ez_args_defaults['active_class'];
        }

        // NOTE: item_class is a special / custom arg and is not part of the standard wp menu fare
        $str_item_class = 'simple-list-li';
        if ( isset($arr_ez_args_defaults['item_class']) && ! empty($arr_ez_args_defaults['item_class']) && $arr_ez_args_defaults['item_class'] !== false ){
            $str_item_class = esc_attr($arr_ez_args_defaults['item_class']);
        }

		$class_names = $class_names ? ' class="' . $str_item_class. ' ' . esc_attr( $class_names ) . '"' :  ' class="' . $str_item_class . '"';

        // if item_class === false then don't use class="..." at all
        if ( isset($arr_ez_args_defaults['item_class']) && $arr_ez_args_defaults['item_class'] === false ){
            $class_names = '';
        }

        // baseline for id_slug
        $str_id_slug = 'simple-list-1-item';
        if ( isset($args->menu_id) && ! empty($args->menu_id) ){
            $str_id_slug = $args->menu_id . '-item-';
        }
        // NOTE: item_id_slug is a special / custom arg and is not part of the standard wp menu fare
        if ( isset($arr_ez_args_defaults['item_id_slug']) && ! empty($arr_ez_args_defaults['item_id_slug']) && $arr_ez_args_defaults['item_id_slug'] !== false ){
            $str_id_slug = $arr_ez_args_defaults['item_id_slug'];
        }

		$id = apply_filters( 'nav_menu_item_id', $str_id_slug . $item->ID, $item, $args );
		$id = $id ? $indent . esc_attr( $id ) . '"' : '';

        // if item_id_slug === false then we don't use the id at all.
        if ( isset($arr_ez_args_defaults['item_id_slug']) && $arr_ez_args_defaults['item_id_slug'] === false ){
            $id = '';
        }

        $arr_valid_item_tags = $this->valid_item_tags();
        // perhaps the tag passed in via the args isn't legit, then use the ez_args_defaults item_tag
        $this->_str_item_tag = 'li';
        if ( isset($arr_ez_args_defaults['item_tag']) &&  isset($arr_valid_item_tags[$arr_ez_args_defaults['item_tag']]) && $arr_valid_item_tags[$arr_ez_args_defaults['item_tag']] === true ){
            $this->_str_item_tag = $arr_ez_args_defaults['item_tag'];
        }

		$output .=  $indent . '<' . esc_attr($this->_str_item_tag) . ' ' . $id . $value . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )	? $item->target	: '';
		$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';
		$atts['data-description'] = ! empty( $item->description ) ? $item->description : '';

        $atts['href'] = ! empty( $item->url ) ? $item->url : '';

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}


        // what's up with the delimiter / separator?
        $str_delimit_in = '';
        $str_delimit_out = '';
        if ( $arr_ez_args_defaults['separator_active'] === true && $item->menu_order < $int_ele_cnt ){
            $str_delimit_temp = '<span class="' . esc_attr($arr_ez_args_defaults['separator_class']). '">';
            $str_delimit_temp .= sanitize_text_field($arr_ez_args_defaults['separator']);
            $str_delimit_temp .= '</span>';

            if ( $arr_ez_args_defaults['separator_outside'] === true ){
                $str_delimit_out = $str_delimit_temp;
            } else {
                $str_delimit_in = $str_delimit_temp;
            }
        }

		$item_output = $args->before;

		$item_output .= '<a '. $attributes .'>';

		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		//	$item_output .= ( $args->has_children && 0 === $depth ) ? ' <span class="caret"></span></a>' : '</a>';
		$item_output .= $str_delimit_in . '</a>' . $str_delimit_out;

		$item_output .= $args->after;

		$output .=  apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

    /**
     * @param string $output
     * @param object $item
     * @param int $depth
     * @param array $args
     */
	public function end_el(&$output, $item, $depth=0, $args=array()) {

        $output .= '</' . esc_attr($this->_str_item_tag) . '>'. "\n";
    }

    /**
     * @return array
     */
    protected function valid_item_tags(){

        $arr_tags =  array(
            'li'    => true,
            'span'  => true,
            'div'   => true,

        );
        return $arr_tags;
    }


    /**
     * Total number of elements in this menu list
     * 
     * @param $obj_args
     * @return int
     */
    public function elements_count($obj_args){

        $arr_nav_menus = get_theme_mod( 'nav_menu_locations' );

        if (  isset($arr_nav_menus[$obj_args->menu]) ){

            $arr_nav_menu_elements = wp_get_nav_menu_items($arr_nav_menus[$obj_args->menu]);
            return count($arr_nav_menu_elements);
        }
        return 0;
    }

}