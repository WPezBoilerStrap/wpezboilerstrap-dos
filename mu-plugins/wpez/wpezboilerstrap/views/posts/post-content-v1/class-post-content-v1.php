<?php

namespace WPez\WPezBoilerStrap\Views\Posts;

if ( ! class_exists('Post_Content_V1')) {
	class Post_Content_V1 extends \WPez\WPezBoilerStrap\Toolbox\Parents\View {

		protected function view( $lang, $mod, $parts, $vargs ) {

			$str_ret = '';

			$str_ret .= wp_kses_post( $mod->post_content );

			return $str_ret;
		}


		protected function lang_defaults() {

			$lang = new \stdClass();

			return $lang;
		}


		protected function mod_defaults() {

			$mod = new \stdClass();

			$mod->post_content = 'MOD->POST_CONTENT';

			return $mod;
		}


		protected function parts_defaults() {

			$parts = new \stdClass();

			return $parts;
		}

		protected function vargs_defaults() {

			$vargs = new \stdClass();

			return $vargs;
		}
	}
}