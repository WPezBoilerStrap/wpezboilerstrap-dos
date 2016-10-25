<?php

namespace WPez\WPezBoilerStrap\Views\Posts;

if ( ! class_exists('Post_List_Layout_V1')) {
	class Post_List_Layout_V1 extends \WPez\WPezBoilerStrap\Toolbox\Parents\View {

		protected function view( $lang, $mod, $parts, $vargs ) {


			$str_ret = '';

			$str_ret = '<img src="http://placehold.it/738x300">';

			$str_ret .= '<br>-- ' . $mod->title . ' - ' . $mod->url . '<br>';

			$str_ret .= esc_attr(date($vargs->date_format, strtotime($mod->orig_obj->post_date)));

			$str_ret .= '</row>';


			return $str_ret;
		}


		protected function lang_defaults() {

			$lang = new \stdClass();

			return $lang;
		}


		protected function mod_defaults() {

			$mod = new \stdClass();

			return $mod;
		}


		protected function parts_defaults() {

			$parts = new \stdClass();

			return $parts;
		}

		protected function vargs_defaults() {

			$vargs = new \stdClass();

			$vargs->date_format = 'Y';

			return $vargs;
		}
	}
}