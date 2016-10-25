<?php

namespace WPez\WPezClasses\Menus;

if ( !defined('ABSPATH') ) {
	header('HTTP/1.0 403 Forbidden');
	die();
}


class Walker_Social_Share_V1 extends \Walker_Nav_Menu {

	/**
	 * @var
	 */
	protected $_arr_ez_args_defaults;

	/**
	 * @var
	 */
	protected $_str_item_tag;



	/**
	 * @return array
	 *
	 * Note: all these can be passed (and therefore overridden) via a given items URL query string.
	 */
	protected function query_string_defaults(){

		$arr_qs_defaults = array(
			'icon'      => 'a',             // which key of the host's icons (see below)? default is: 'a'. note: false will prevent an icon(s) from being used.
			'fw'        => true,            // bool (true or flase). fw = full width
			'stack'     => false,           // stack two icons (font awesome), false, else the key of the icon (see method: stack_icons())
			'inverse'   => false,           // in a stack, inverse will only apply to the front icon
			'msg'       => ''               // for example, a #hashtag and/or the brand's @handle
		);

		return $arr_qs_defaults;
	}

	/**
	 * @return array
	 */
	protected function ez_args_defaults(){

		$arr_ez_args_defaults = array(

			'item_tag'          => 'li',                    // what tag will rap a given item. see also method: valid_item_tags()
			'item_id_slug'      => 'ez-social-share-v1-item-',
			'item_class'        => 'ez-social-share-v1-item',

			'parent'            => 'is-parent',
			'not_parent'        => 'not-parent',
			'child'             => 'is-child',
			'child_of'          => 'is-child-of',
			'not_child'         => 'not-child',

			'fw_class'          => 'fa-fw',
			'stack_tag'         => 'span',
			'stack_wrap_class'  => 'fa-stack',
			'stack_back_class'  => 'fa-stack-2x',
			'stack_front_class' => 'fa-stack-1x',
			'inverse_class'     => 'fa-inverse',

			'title_prefix'      => '',
			'target_default'    => '_blank',
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

	public function start_lvl( &$output, $depth = 0, $args = array() )
	{
		$output .= '';
	}

	/**
	 * @param string $output
	 * @param int $depth
	 * @param array $args
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() )
	{
		$output .= '';
	}

	/**
	 * @param string $output
	 * @param object $item
	 * @param int $depth
	 * @param array $args
	 * @param int $id
	 */

	public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0 )
	{

		// gotta have a url else we're outta here
		if (empty($item->url)) {
			return;
		}

		$str_url = $item->url;
		$arr_parse_url = parse_url($str_url);
		// parse_url...no host? we're outta here
		if ( !isset($arr_parse_url['host']) ) {
			return;
		}
		$str_host = $arr_parse_url['host'];

		// is this host (i.e., the SN we're gonna share to) supported and active?
		if ( $this->get_active($str_host) !== true ) {
			return;
		}

		// get the url_base and url_query_string
		$mix_url_base = $this->get_url_base($str_host);
		$mix_url_query_string = $this->get_url_query_string($str_host);
		if ( $mix_url_base === false || $mix_url_query_string === false ) {
			return;
		}
		// switch from mix_ to str_ just to make it easier to follow
		$str_url_base = $mix_url_base;
		$str_url_query_string = $mix_url_query_string;

		// parse the query string
		$arr_query_string = array();
		if ( ! empty($arr_parse_url['query'])) {
			parse_str($arr_parse_url['query'], $arr_query_string);
		}

		// start with the query string defaults
		$arr_args_qs_defaults = $this->query_string_defaults();
		// if there are ez_arg, then merge them over the defaults
		if ( isset($args->ez_args) && is_array($args->ez_args) ){
			$arr_args_qs_defaults = array_merge($this->query_string_defaults(), $args->ez_args );
		}
		// and now the item's query string to go over the defaults.
		$arr_qs = array_merge($arr_args_qs_defaults, $arr_query_string);

		$str_icon_markup = '';
		// if 'icon' is false then we're just going to use the share stuff (with a sprite?), but not the icons.
		if ( isset($arr_qs['icon']) && $arr_qs['icon'] !== 'false' ){

			// $arr_qs['icon'] lets us pass in a different key to use an icon other than the default
			$mix_icon = $this->get_icon($str_host, $arr_qs['icon']);
			// if we don't find the icon we're outta here.
			if ( $mix_icon === false ) {
				return;
			}
			// switch from mix_ to str_ just to make it easier to follow
			$str_icon = $mix_icon;

			// rather than hardcode this stuff we use ez_args_defaults() for flexibility and total control going forward.

			$arr_ez_args_defaults = $this->ez_args_defaults();
			if ( isset($args->ez_args) && is_array($args->ez_args) ){
				$arr_ez_args_defaults = array_merge($arr_ez_args_defaults, $args->ez_args );
			}
			$this->_arr_ez_args_defaults = $arr_ez_args_defaults;

			// what classes are we gonna add to this item?
			$arr_add_class = array();
			// fw = fixed width -
			// Note: the query string can't pass a bool. true / false will end up 'true' / 'false' (string)
			if ( $arr_qs['fw'] === true || $arr_qs['fw'] == 'true' ) {
				$arr_add_class[] = esc_attr($this->_arr_ez_args_defaults['fw_class']);
			}

			// stacked (font awesome) fonts?
			$str_icon_stack_back = false;
			if ( $arr_qs['stack'] === true ||  $arr_qs['stack'] == 'true' ) {

				$mix_stack_icon = $this->get_stack_icon($arr_qs['stack']);
				if ($mix_stack_icon !== false) {
					$str_icon_stack_back = $mix_stack_icon;
					$str_icon_stack_back = sprintf($str_icon_stack_back, esc_attr($this->_arr_ez_args_defaults['stack_back_class']));
					$arr_add_class[] = esc_attr($this->_arr_ez_args_defaults['stack_front_class']);
				} else {
					// if we fail to find the stack icon we're outta here (again)
					return;
				}
			}

			// inverse?
			if ( $arr_qs['inverse'] === true || $arr_qs['inverse'] == 'true' ) {
				$arr_add_class[] = esc_attr($this->_arr_ez_args_defaults['inverse_class']);
			}

			// time to makes the add classes :)
			$str_add_class = implode(' ', $arr_add_class);
			// add the class list to the icon sting
			$str_icon = sprintf($str_icon, $str_add_class);

			// yes! time to make the icon magic
			$str_icon_markup = $this->icon_markup($str_icon, $str_icon_stack_back);
		}

		// msg is a catch all for adding @handle, #hashtag, etc.
		// it can be defined in the host but then the qs can override that
		$str_msg = $this->get_msg($str_host, $arr_qs['msg']);

		// get the url to be shared
		$str_this_url = $this->get_shared_url($str_host);

		// get the title to be shared
		$str_shared_title =  $this->get_shared_title($str_msg);

		// to url encode, or not url encode, that is the question
		$bool_url_encode = $this->get_url_encode($str_host);
		if ( $bool_url_encode !== false ){
			$str_shared_title = rawurlencode($str_shared_title);
			$str_this_url = rawurlencode($str_this_url);
		}

		// finally! let's build the url that's gonna be the href for this item.
		$atts = array();
		$atts['href'] = esc_url($str_url_base) . '?' . sprintf($str_url_query_string, $str_shared_title, $str_this_url);

		// yup! now it's time to build the actual menu item
		$indent = ($depth) ? str_repeat("\t", $depth) : '';

		$class_names = $value = '';

		$classes_all = empty($item->classes) ? array() : (array)$item->classes;
		$classes[0] = $classes_all[0];

		$class_names = join(' ', apply_filters('ez_social_share_1_css_class', array_filter($classes), $item, $args));

		// This is from the class that was forked. Let's just leave it for now.
		// has children?
		if ($args->walker->has_children) {
			$class_names .= ' ' . $this->_arr_ez_args_defaults['parent'];
		} else {
			$class_names.=  ' ' . $this->_arr_ez_args_defaults['not_parent'];
		}

		// is a child?
		if ( $item->menu_item_parent == 0 ){
			$class_names .= ' ' . $this->_arr_ez_args_defaults['not_child'];
		} else{
			$class_names .= ' ' . $this->_arr_ez_args_defaults['child'];
			$class_names .= ' ' . $this->_arr_ez_args_defaults['child_of'] . $item->menu_item_parent;
		}

		// NOTE: item_class is a special / custom arg and is not part of the standard wp menu fare
		$str_item_class = 'social-share-1-li';
		if (isset($this->_arr_ez_args_defaults['item_class']) && ! empty($this->_arr_ez_args_defaults['item_class']) && $this->_arr_ez_args_defaults['item_class'] !== false ){
			$str_item_class = esc_attr($this->_arr_ez_args_defaults['item_class']);
		}

		$class_names = $class_names ? ' class="' . $str_item_class. ' ' . esc_attr( $class_names ) . '"' :  ' class="' . $str_item_class . '"';

		// if item_class === false then don't use class
		if ( isset($this->_arr_ez_args_defaults['item_class']) && $this->_arr_ez_args_defaults['item_class'] === false ){
			$class_names = '';
		}

		// fallback for id_slug
		$str_id_slug = 'social-share-1-li-';
		if (isset($args->menu_id) && ! empty($args->menu_id) ){
			$str_id_slug = $args->menu_id . '-';
		}
		// NOTE: item_id_slug is a special / custom arg and is not part of the standard wp menu fare
		if (isset($this->_arr_ez_args_defaults['item_id_slug']) && ! empty($this->_arr_ez_args_defaults['item_id_slug']) && $this->_arr_ez_args_defaults['item_id_slug'] !== false ){
			$str_id_slug = $this->_arr_ez_args_defaults['item_id_slug'];
		}

		$id = apply_filters( 'ez_social_share_1_item_id', $str_id_slug . $item->ID, $item, $args );
		$id = $id ? $indent . esc_attr( $id ) . '"' : '';

		// if item_id_slug === false then we don't use the id at all.
		if (isset($this->_arr_ez_args_defaults['item_id_slug']) && $this->_arr_ez_args_defaults['item_id_slug'] === false ){
			$id = '';
		}

		$arr_valid_item_tags = $this->valid_item_tags();
		// NOTE: item_tag is a special / custom arg and is not part of the standard wp menu fare
		$this->_str_item_tag = 'li';
		if ( isset($this->_arr_ez_args_defaults['item_tag']) && isset($arr_valid_item_tags[$this->_arr_ez_args_defaults['item_id_slug']]) && $arr_valid_item_tags[$this->_arr_ez_args_defaults['item_id_slug']] === true  ){
			$this->_str_item_tag = $this->_arr_ez_args_defaults['item_tag'];
		}

		$output .=  $indent . '<' . esc_attr($this->_str_item_tag) . ' ' . $id . $value . $class_names .'>';

		$atts['title']  = ! empty( $item->attr_title ) ? $this->_arr_ez_args_defaults['title_prefix'] . $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )	? $item->target	: $this->_arr_ez_args_defaults['target_default'];
		$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';
		$atts['data-description'] = ! empty( $item->description ) ? $item->description : '';

		$atts = apply_filters( 'ez_social_share_1_link_attributes', $atts, $item, $args );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( $attr == 'href') ? $value : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output = $args->before;
		$item_output .= '<a '. $attributes .'>';
		$item_output .= $args->link_before . $str_icon_markup . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .=  apply_filters( 'ez_social_share_1_done_start_el', $item_output, $item, $depth, $args );

	}

	public function end_el(&$output, $item, $depth=0, $args=array()) {

		$output .= '</' . $this->_str_item_tag . '>'. "\n";
	}


	/**
	 * @return array
	 */
	protected function valid_item_tags(){

		$arr_item_tags =  array(
			'li'    => true,
			'span'  => true,
			'div'   => true,
		);
		return $arr_item_tags;
	}

	/**
	 * @param $str_icon_front
	 * @param bool $str_icon_back
	 * @return string
	 */
	protected function icon_markup($str_icon_front, $str_icon_back = false ){

		if ($str_icon_back === false){
			return '<i class="' . esc_attr($str_icon_front) . '"></i>';
		}

		$str_return = '';
		$str_return .= '<' . esc_attr($this->_arr_ez_args_defaults['stack_tag']) . ' class="' .  esc_attr($this->_arr_ez_args_defaults['stack_wrap_class']) . '">';
		$str_return .= '<i class="' . esc_attr($str_icon_back) . '"></i>';
		$str_return .= '<i class="' . esc_attr($str_icon_front) . '"></i>';
		$str_return .= '</' . esc_attr($this->_arr_ez_args_defaults['stack_tag']) . '>';

		return $str_return;
	}


	/**
	 * @param string $str_sn
	 * @return bool
	 */
	protected function get_active($str_sn = ''){

		$arr_st = $this->social_share_to();
		$str_sn = preg_replace('#^www.#', '', $str_sn);

		if ( isset($arr_st[$str_sn]) && $arr_st[$str_sn]['active'] === true ){
			return true;
		} else{
			return false;
		}
	}


	/**
	 * @param string $str_sn
	 * @param string $str_icon_key
	 * @return bool
	 */
	protected function get_icon($str_sn = '', $str_icon_key = ''){

		$arr_st = $this->social_share_to();
		$str_sn = preg_replace('#^www.#', '', $str_sn);

		if ( isset($arr_st[$str_sn]['icon']) ) {
			if ( isset($arr_st[$str_sn]['icon'][$str_icon_key]) ){

				return $arr_st[$str_sn]['icon'][$str_icon_key];

			} elseif ( isset($arr_st[$str_sn]['icon_default']) && isset( $arr_st[$str_sn]['icon'][$arr_st[$str_sn]['icon_default']] ) ){
				return $arr_st[$str_sn]['icon'][$arr_st[$str_sn]['icon_default']];
			} else {
				return false;
			}
		}
		return false;
	}

	/**
	 * @param string $str_icon_key
	 * @return bool
	 */
	protected function get_stack_icon( $str_icon_key = ''){

		$arr_stack_icons = $this->stack_icons();
		if ( isset($arr_stack_icons[$str_icon_key]) ){
			return $arr_stack_icons[$str_icon_key];
		}
		return false;
	}

	/**
	 * @param string $str_sn
	 * @return bool
	 */
	protected function get_url_base($str_sn = ''){

		$arr_st = $this->social_share_to();

		$str_sn = preg_replace('#^www.#', '', $str_sn);

		if ( isset($arr_st[$str_sn]['url_base']) ){
			return $arr_st[$str_sn]['url_base'];
		} else{
			return false;
		}
	}

	/**
	 * @return string
	 */
	protected function get_shared_url($str_host = '', $arr_args = array()){

		$str_shared_url = home_url() . parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH) . $this->get_shared_url_tracking($str_host,  $arr_args = array()) ;
		return $this->get_shared_url_shortened($str_shared_url, $str_host = '', $arr_args = array() );

	}

	/**
	 * @return string
	 *
	 * For example, adding a Google Analytics URL Builder string to the URL to be share.
	 */
	protected function get_shared_url_tracking($str_host = '',  $arr_args = array()){

		return '';
	}

	/**
	 * @return string
	 */
	protected function get_shared_url_shortened($str_url = '', $str_host,  $arr_args = array() ){

		return $str_url;
	}

	/**
	 * @param string $str_msg
	 * @return string
	 */
	protected function get_shared_title($str_msg = ''){

		// TODO make delimiter a option
		if ( ! empty($str_msg) ){
			return wp_title('&raquo;', false, '') . ' - '. $str_msg . ' - ';
		}
		return wp_title('&raquo;', false, '') . ' - ';
	}


	/**
	 * @param string $str_sn
	 * @return bool
	 */
	protected function get_url_query_string($str_sn = ''){

		$arr_st = $this->social_share_to();
		$str_sn = preg_replace('#^www.#', '', $str_sn);

		if ( isset($arr_st[$str_sn]['url_query_string']) ){
			return $arr_st[$str_sn]['url_query_string'];
		} else{
			return false;
		}
	}

	protected function get_url_encode($str_sn = ''){

		$arr_st = $this->social_share_to();
		$str_sn = preg_replace('#^www.#', '', $str_sn);

		if ( isset($arr_st[$str_sn]['url_encode']) && $arr_st[$str_sn]['url_encode'] === true ){
			return true;
		} else{
			return false;
		}
	}

	/**
	 * @param string $str_sn
	 * @param string $str_qs_msg
	 * @return string
	 */
	protected function get_msg($str_sn = '', $str_qs_msg = ''){

		$arr_st = $this->social_share_to();

		$str_sn = preg_replace('#^www.#', '', $str_sn);

		$str_host_msg = '';
		if ( isset($arr_st[$str_sn]['msg']) ){
			// TODO esc / sanitize?
			$str_host_msg = $arr_st[$str_sn]['msg'];
		}
		$str_msg = $str_host_msg;
		// if there's a qs msg then it overrides what's defined at the host level
		if ( ! empty($str_qs_msg) ){
			$str_msg = $str_qs_msg;
		}
		// if we have a non-empty msg add a space to the front
		if ( ! empty($str_msg) ){
			$str_msg = ' ' . $str_msg;
		}
		return $str_msg;
	}


	/**
	 * @return array
	 *
	 * http://sharelinkgenerator.com/
	 */

	protected function social_share_to()
	{
		// TODO - add pinterest
		// TODO - add tumblr
		// TODO - add bookmark?

		$arr_st = array(

			'facebook.com'  => array(
				'active'        => true,
				'icon_default'  => 'a',
				'icon'         => array(
					'a' => 'fa fa-facebook-square %s',
					'b' => 'fa fa-facebook %s',
					'c' => 'fa fa-facebook-official %s',
				),
				'msg'                   => '',
				'url_base'              => 'https://www.facebook.com/sharer/sharer.php',
				'url_query_string'      => 't=%s&u=%s ',
				'url_encode'            => true,
			),

			'twitter.com'   => array(
				'active'        => true,
				'icon_default'  => 'a',
				'icon'         => array(
					'a' => 'fa fa-twitter-square %s',
					'b' => 'fa fa-twitter %s',
				),
				'msg'                   => '',
				'url_base'              => 'https://twitter.com/share',
				'url_query_string'      => 'text=%s&url=%s',
				'url_encode'            => true,
			),

			'linkedin.com'   => array(
				'active'        => true,
				'icon_default'  => 'a',
				'icon'         => array(
					'a' => 'fa fa-linkedin-square %s',
					'b' => 'fa fa-linkedin %s',
				),
				'msg'                 => '',
				'url_base'            => 'https://www.linkedin.com/shareArticle',
				'url_query_string'    => 'mini=true&title=%s&url=%s&summary=&source=',
				'url_encode'          => true,
			),

			'plus.google.com'   => array(
				'active'        => true,
				'icon_default'  => 'a',
				'icon'         => array(
					'a' => 'fa fa-google-plus-square %s',
					'b' => 'fa fa-google-plus %s',
				),
				'msg'                 => '',
				'url_base'            => 'https://plus.google.com/share',
				'url_query_string'    => 'v=compose&content=%s&url=%s',
				'url_encode'          => true,
			),

			'mailto'   => array(
				'active'        => true,
				'icon_default'  => 'a',
				'icon'         => array(
					'a' => 'fa fa-envelope-square %s',
					'b' => 'fa fa-envelope-o %s',
					'c' => 'fa fa-envelope %s',
				),
				'msg'                   => '',
				'url_base'              => 'mailto:',
				'url_query_string'      => 'body=%s %s',
				'url_encode'            => false,
			),
		);

		return $arr_st;
	}


	protected function stack_icons(){

		$arr_stack = array(

			'a' => 'fa fa-square-o %s',
			'b' => 'fa fa-circle %s',

		);
		return $arr_stack;
	}


}