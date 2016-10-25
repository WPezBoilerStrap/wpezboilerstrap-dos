<?php

namespace WPez\WPezBoilerStrap\Views\Posts;

if ( ! class_exists('Post_Page_V1')) {
	class Post_Page_V1 extends \WPez\WPezBoilerStrap\Toolbox\Parents\View {

		protected function view( $lang, $mod, $parts, $vargs ) {

			$mac = $this->_mac;

			$str_ret = '';

			$str_ret .= $mac::element_open($vargs->title_tag, $vargs->title_global_attrs);

			$str_ret .= esc_attr( $mod->post_title );

			$str_ret .= $mac::element_close($vargs->title_tag);

			$str_ret .= $mac::element_open($vargs->content_tag, $vargs->content_global_attrs);

			$str_ret .= wp_kses_post( $mod->post_content );

			$str_ret .= $mac::element_close($vargs->content_tag);



			return $str_ret;
		}


		protected function lang_defaults() {

			return new \stdClass();
		}


		protected function mod_defaults() {

			$mod = new \stdClass();

			$mod->post_title   = '';
			$mod->post_content = '';

			return $mod;
		}


		protected function parts_defaults() {

			return new \stdClass();
		}

		protected function vargs_defaults() {

			$vargs = new \stdClass();

			$vargs->title_tag   = 'h1'; // e.g., H1
			$vargs->title_global_attrs = array();
			$vargs->content_tag = 'div'; // e.g., div
			$vargs->content_global_attrs = array();

			return $vargs;
		}

	}
}