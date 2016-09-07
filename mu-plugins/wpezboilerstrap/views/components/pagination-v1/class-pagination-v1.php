<?php

namespace WPezBoilerStrap\Views\Components;

if ( ! class_exists('Pagination_V1')) {
	class Pagination_V1 extends \WPezBoilerStrap\Toolbox\Parents\View {

		protected function view( $lang, $mod, $parts, $vargs ) {

			$str_ret = '';

			$str_ret .= '<div>';

			$str_ret .= ' - WPezBoilerStrap \ Views \ Components - TODO posts pagination - ';

			$temp = '<br>';
			foreach ( $mod->pages as $key => $obj ) {
				$temp .= $obj->url . ' - ' . $obj->type . ' - ' . $obj->anchor . '<br>';
			}

			$str_ret .= $temp;

			$str_ret .= '</div>';

			return $str_ret;
		}


		protected function lang_defaults() {

			$obj = new \stdClass();

			return $obj;
		}

		protected function mod_defaults() {

			$mod = new \stdClass();

			$arr_pages = array();

			$obj_page = new \stdClass();
			$obj_page->url = 'http://MOD-URL-1.com';
			$obj_page->type = 'MOD->TYPE-1';
			$obj_page->anchor = 'MOD->ANCHOR-1';

			$arr_pages[] = $obj_page;

			$obj_page = new \stdClass();
			$obj_page->url = 'http://MOD-URL-2.com';
			$obj_page->type = 'MOD->TYPE-2';
			$obj_page->anchor = 'MOD->ANCHOR-2';

			$arr_pages[] = $obj_page;

			return $mod;
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