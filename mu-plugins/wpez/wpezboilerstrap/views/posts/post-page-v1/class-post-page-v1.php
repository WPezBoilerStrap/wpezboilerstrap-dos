<?php

namespace WPez\WPezBoilerStrap\Views\Posts;

if ( ! class_exists('Post_Page_V1')) {
	class Post_Page_V1 extends \WPez\WPezBoilerStrap\Toolbox\Parents\View {

		protected function view( $mod, $parts, $vargs ) {

			$mac = $this->_mac;

			$str_ret = '';

			$str_ret .= $mac::element_open($vargs->title_wrapper_tag, $vargs->title_wrapper_global_attrs);
			$str_ret .= $mac::element_open($vargs->title_tag, $vargs->title_global_attrs);

			$str_ret .= esc_attr( $mod->post_title );

			$str_ret .= $mac::element_close($vargs->title_tag);
			$str_ret .= $mac::element_close($vargs->title_wrapper_tag);

			//
			$str_ret .= $mac::element_open($vargs->content_wrapper_tag, $vargs->content_wrapper_global_attrs);
			$str_ret .= $mac::element_open($vargs->content_tag, $vargs->content_global_attrs);

			$str_ret .= wp_kses_post( $mod->post_content );

			$str_ret .= $mac::element_close($vargs->content_tag);
			$str_ret .= $mac::element_close($vargs->content_wrapper_tag);

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

			$obj_enc = new \stdClass();

			// an enclosure master switch - default is true
			$obj_enc->active = true;

			$obj_enc->semantic_active = true;
			$obj_enc->semantic_tag = 'article';
			$obj_enc->semantic_global_attrs = array(
				'itemscope' =>'',
				'itemtype' => "http://schema.org/BlogPosting"
			);

			$obj_enc->view_wrapper_active = true;
			$obj_enc->view_wrapper_tag = 'div';
			$obj_enc->view_wrapper_global_attrs = array();

			$vargs = new \stdClass();
			$vargs->enclose = $obj_enc;

			$vargs->title_wrapper_tag = 'header';
			$vargs->title_wrapper_global_attrs = array();

			$vargs->title_tag   = 'h1'; // e.g., H1
			$vargs->title_global_attrs = array(
				'itemprop' => "headline"
			);

			$vargs->content_wrapper_tag = 'section'; // e.g., div
			$vargs->content_wrapper_global_attrs = array();

			$vargs->content_tag = 'div'; // e.g., div
			$vargs->content_global_attrs = array(
				'itemprop' => 'articleBody'
			);

			return $vargs;
		}

	}
}