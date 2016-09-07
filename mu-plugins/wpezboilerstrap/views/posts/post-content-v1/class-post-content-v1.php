<?php

namespace WPezBoilerStrap\Views\Posts;

if ( ! class_exists('Post_Content_V1')) {
	class Post_Content_V1 extends \WPezBoilerStrap\Toolbox\Parents\View {

		protected function view( $lang, $mod, $parts, $vargs ) {

			$str_ret = '';

			$str_ret .= wp_kses_post( $mod->post_content );

			return $str_ret;
		}


		protected function lang_defaults() {

			$obj = new \stdClass();

			return $obj;
		}

		protected function mod_defaults() {

			$obj = new \stdClass();

			$obj->post_content = 'MOD->POST_CONTENT';

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