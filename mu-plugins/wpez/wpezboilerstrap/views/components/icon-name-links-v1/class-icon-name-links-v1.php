<?php

namespace WPez\WPezBoilerStrap\Views\Components;

if ( ! class_exists('Icon_Name_Links_V1')) {
	class Icon_Name_Links_V1 extends \WPez\WPezBoilerStrap\Toolbox\Parents\View {

		protected function view( $lang, $mod, $parts, $vargs ) {

			$mac = $this->_mac;

			$str_ret = '';

			https://premium.wpmudev.org/blog/convert-html5-template-wordpress-theme/?npp=b&utm_expid=3606929-84.YoGL0StOSa-tkbGo-lVlvw.1&utm_referrer=https%3A%2F%2Fwww.facebook.com%2F

			$str_ret .= $mac::element_open($vargs->wrapper_tag, $vargs->wrapper_global_attrs);

			$str_ret .= $mac::element_open($vargs->icon_label_wrapper_tag, $vargs->icon_label_wrapper_global_attrs);

			// TODO - check if class + method exist?
			$str_ret .= $mac::icon_name(
				$vargs->icon_tag,
				$vargs->icon_global_attrs,
				$vargs->name_tag,
				$vargs->name_global_attrs,
				$mod->name
			);

			$str_ret .= $mac::element_close($vargs->icon_label_wrapper_tag);

			$arr_to_implode = array();
			if ( is_array($mod->array_objects) ) {
				foreach ( $mod->array_objects as $key => $obj ) {

					//   <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
					$str_link = '<a href="' . esc_url( $obj->url ) . '"';
					$str_link .= $mac::global_attrs( $obj->global_attrs ) . '>';
					$str_link .= esc_attr( $obj->anchor_text );
					$str_link .= '</a>'; // list close

					$arr_to_implode[] = $str_link;
				}
			}

			$str_ig = esc_attr($vargs->implode_glue);
			$str_implode = implode($str_ig, $arr_to_implode);

			$str_ret .= $str_implode;
			$str_ret .= $mac::element_close($vargs->wrapper_tag);

			return $str_ret;
		}

		/*
	<p class="text-right"><span class="fa fa-tags"></span>
	Tags: <a href="https://wp-themes.com/?tag=boat" rel="tag">boat</a>,
	<a href="https://wp-themes.com/?tag=lake" rel="tag">lake</a>  </p>
*/

		protected function lang_defaults() {

			$lang = new \stdClass();

			$lang->label = ' LANG-LABEL '; // e.g. Tags, Catgories, etc.

			return $lang;
		}


		protected function mac_defaults() {

			$mac = new \stdClass();

			return $mac;
		}

		protected function mod_defaults() {

			$obj = new \stdClass();

			$arr = array();

			$obj_val = new \stdClass();
			$obj_val->url = 'http://MOD_DEFAULT_URL_1.com';
			$obj_val->title = 'MOD-TITLE 1';
			$obj_val->link_class = 'MOD-LINK_CLASS-1';
			$obj_val->anchor = 'MOD-ANCHOR 1';

			$arr[] = $obj_val;

			$obj_val = new \stdClass();
			$obj_val->url = 'http://MOD_DEFAULT_URL_2.com';
			$obj_val->title = 'MOD-TITLE 2';
			$obj_val->link_class = 'MOD-LINK_CLASS-2';
			$obj_val->anchor = 'MOD-ANCHOR 2';

			$arr[] = $obj_val;

			$obj->array_links = $arr;

			return $obj;
		}


		protected function parts_defaults() {

			$parts = new \stdClass();

			return $parts;
		}

		protected function vargs_defaults() {

			$vargs = new \stdClass();

			$vargs->wrapper_tag = 'VARGS-WRAPPER_TAG'; // e.g. 'p';
			$vargs->wrapper_global_attrs = array(
				'id' => 'VARGS-WRAPPER_GLOBAL_ATTRS-ID',
				'class' => 'VARGS-WRAPPER_GLOBAL_ATTRS-CLASS'
			);

			$vargs->icon_label_wrapper_tag = 'div';
			$vargs->icon_label_wrapper_global_attrs = array(
				'class' => 'VARGS-ICON_SPAN_CLASS fa fa-tags' // e.g., some FA class
			);

			$vargs->icon_tag = 'i';
			$vargs->icon_global_attrs = array(
				'class' => 'VARGS-ICON_SPAN_CLASS fa fa-tags' // e.g., some FA class
			);
			$vargs->label_tag = 'span';
			$vargs->label_global_attrs = array(
				'class' => 'VARGS-LABEL_SPAN_CLASS' // e.g., some FA class
			);

			$vargs->link_class = 'VARGS-LINK_CLASS'; // apply to every link, there is also a mod->link_class
			$vargs->link_rel = 'VARGS-LINK_REL';

			$vargs->implode_glue = ', '; // aka delimiter
			return $vargs;
		}
	}
}