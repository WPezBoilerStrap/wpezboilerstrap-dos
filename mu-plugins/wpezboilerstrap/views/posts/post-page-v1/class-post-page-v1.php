<?php

namespace WPezBoilerStrap\Views\Posts;

if ( ! class_exists('Post_Page_V1')) {
	class Post_Page_V1 extends \WPezBoilerStrap\Toolbox\Parents\View {

		protected function view( $lang, $mod, $parts, $vargs ) {

			$str_open  = '';
			$str_close = '';
			if ( ! empty ( $vargs->semantic ) ) {
				$str_open  = '<' . esc_attr( $vargs->semantic ) . '>';
				$str_close = '</' . esc_attr( $vargs->semantic ) . '>';
			}

			$str_ret = '';

			$str_ret .= $str_open;

			$str_ret .= '<' . esc_attr( $vargs->title_wrap ) . '>';

			$str_ret .= esc_attr( $mod->post_title );

			$str_ret .= '</' . esc_attr( $vargs->title_wrap ) . '>';

			$str_ret .= wp_kses_post( $mod->post_content );

			$str_ret .= $str_close;

			return $str_ret;
		}


		protected function lang_defaults() {

			$obj = new \stdClass();

			return $obj;
		}

		protected function mod_defaults() {

			$obj = new \stdClass();

			$obj->post_title   = 'THIS IS THE POST_TITLE';
			$obj->post_content = 'THIS IS THE POST_CONTENT';

			return $obj;
		}


		protected function parts_defaults() {

			$obj = new \stdClass();

			return $obj;
		}

		protected function vargs_defaults() {

			$obj = new \stdClass();

			$obj->semantic     = 'SEMANTIC';
			$obj->title_wrap   = 'TITLE_WRAP'; // e.g., H1
			$obj->content_wrap = 'CONTENT_WRAP'; // e.g., div

			return $obj;
		}

	}
}