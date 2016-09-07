<?php

namespace WPezBoilerStrap\Views\Components;

if ( ! class_exists('Icon_Label_Links_V1')) {
	class Icon_Label_Links_V1 extends \WPezBoilerStrap\Toolbox\Parents\View {

		protected function view( $lang, $mod, $parts, $vargs ) {

			$str_ret = '';

			$str_ret .= '<' . esc_attr($vargs->wrapper_tag) . ' ';
			$str_ret .= $this->global_attrs($vargs->wrapper_global_attrs );
			$str_ret .= '>';

			$str_ret .= '<span ';
			$str_ret .= $this->global_attrs($vargs->icon_span_global_attrs );
			$str_ret .= '></span>';

			$str_ret .= '<span ';
			$str_ret .= $this->global_attrs($vargs->label_span_global_attrs );
			$str_ret .= '>';
			$str_ret .= esc_attr($lang->label);
			$str_ret .= '</span>';

			$arr_one = array();
			foreach ($mod->array_links as $key => $obj) {

				//   <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
				$str_link = '<a href="' . esc_url( $obj->url ) . '"';
				if ( ! empty( $vargs->link_class ) || ! empty( $vargs->obj_class  ) ) {
					$str_link .= ' class="' . trim( esc_attr( $vargs->link_class . ' ' . $obj->link_class ) ) . '"';
				}

				if ( ! empty($vargs->link_rel) ) {
					$str_link .= ' rel="' . esc_attr( $vargs->link_rel ) . '"';
				}

				if ( ! empty($obj->title) ) {
					$str_link .= ' title="' . esc_attr( $obj->title ) . '"';
				}
				$str_link .= '>';
				$str_link .= esc_attr($obj->anchor);

				$str_link.= '</a>'; // list close

				$arr_one[] = $str_link;
			}

			$str_ig = esc_attr($vargs->implode_glue);
			$str_implode = implode($str_ig, $arr_one);

			$str_ret .= $str_implode;

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
			$vargs->icon_span_global_attrs = array(
				'class' => 'VARGS-ICON_SPAN_CLASS fa fa-tags' // e.g., some FA class
			);
			$vargs->label_span_global_attrs = array(
				'class' => 'VARGS-LABEL_SPAN_CLASS' // e.g., some FA class
			);
			$vargs->link_class = 'VARGS-LINK_CLASS'; // apply to every link, there is also a mod->link_class
			$vargs->link_rel = 'VARGS-LINK_REL';
			$vargs->implode_glue = ', ';

			return $vargs;
		}
	}
}