<?php

namespace WPezBoilerStrap\Views\Components;

if ( ! class_exists('List_Links_V1')) {
	class List_Links_V1 extends \WPezBoilerStrap\Toolbox\Parents\View {

		protected function view( $lang, $mod, $parts, $vargs ) {

			$str_ret = '<p>TODO - List Links V1 <br>';

			$str_list = '<ul class="TODO">'; // open tag

			// TODO: check for array
			foreach ($mod->array_links as $key => $obj){

				$str_list .= '<li>'; // list open

				//   <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
				$str_list .= '<a href="' . esc_url($obj->url) . '" class="list-group-item"';
				if ( ! empty($obj->title) ) {
					$str_list .= ' title="' . esc_attr( $obj->title ) . '"';
				}
				$str_list .= '>';
				$str_list .= esc_attr($obj->title);

				$str_list .= '</a></li>'; // list close

			}

			$str_ret .= $str_list;

			$str_ret .= '</ul>';

			$str_ret .= '</p>';

			return $str_ret;
		}


		protected function lang_defaults() {

			$obj = new \stdClass();

			return $obj;
		}

		protected function mod_defaults() {

			$obj = new \stdClass();

			$arr = array();

			$obj_val = new \stdClass();
			$obj_val->url = 'http://MOD_DEFAULT_URL_1.com';
			$obj_val->title = 'MOD->TITLE 1';
			$obj_val->anchor = 'MOD->ANCHOR 1';

			$arr[] = $obj_val;

			$obj_val = new \stdClass();
			$obj_val->url = 'http://MOD_DEFAULT_URL_2.com';
			$obj_val->title = 'MOD->TITLE 2';
			$obj_val->anchor = 'MOD->ANCHOR 2';

			$arr[] = $obj_val;

			$obj->list_links = $arr;

			return $obj;
		}


		protected function parts_defaults() {

			$obj = new \stdClass();

			return $obj;
		}

		protected function vargs_defaults() {

			$obj = new \stdClass();

			return $obj;
		}
	}
}