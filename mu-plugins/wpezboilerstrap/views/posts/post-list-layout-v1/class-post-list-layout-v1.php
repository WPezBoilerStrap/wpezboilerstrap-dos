<?php

namespace WPezBoilerStrap\Views\Posts;

if ( ! class_exists('Post_List_Layout_V1')) {
	class Post_List_Layout_V1 extends \WPezBoilerStrap\Toolbox\Parents\View {

		protected function view( $lang, $mod, $parts, $vargs ) {

			$obj_wp_post = $mod->wp_post;
			$obj_ezx = $mod->ezx;


			$str_ret = '<row>TODO - Post List Layout V1<br>';

			$str_ret .= '<br>-- ' . $obj_wp_post->post_title . ' - ' . $obj_ezx->permalink . '<br>';

			$str_ret .= esc_attr(date($vargs->date_format, strtotime($obj_wp_post->post_date)));

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