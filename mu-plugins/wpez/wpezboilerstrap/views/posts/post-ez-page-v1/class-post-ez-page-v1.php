<?php

namespace WPez\WPezBoilerStrap\Views\Posts;

if ( ! class_exists('Post_EZ_Page_V1')) {
	class Post_EZ_Page_V1 extends \WPez\WPezBoilerStrap\Toolbox\Parents\View {


		protected function view( $mod, $parts, $vargs ) {

			$mac = $this->_mac;

		// print_r($mod);

			$str_ret = '';

			$str_ret = '<header>';

			$str_ret .= $mac::ez_post_title_v1($mod, $vargs);

			$str_ret .= '</header>';

			$str_ret .= '<section>';

			// edit link
			$str_edit =  $mac::ez_post_edit_v1($mod, $vargs);

			$str_ret .= $str_edit;

			// prevents 2 edit links when we're not displaying the content
			$str_content = $mac::ez_post_post_content_v1($mod, $vargs);

			if ( ! empty($str_content)) {

				$str_ret .= $str_content;

				$str_ret .= $str_edit;
			}

			$str_ret .= '</section>';

			return $str_ret;
		}

		protected function lang_defaults() {

			$vargs = new \stdClass();

			// these are the language defaults from the various macros used above.

			$vargs->edit_title_text = 'Edit article: ';
			$vargs->edit_text = 'Edit This';

			return $vargs;
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


			/**
			 * == ez_post_title_v1_vargs
			 */

			// $vargs->title_wrapper_tag = 'div';
			// $vargs->title_wrapper_global_attrs = array();
			// $vargs->title_tag = 'h1';
			// $vargs->title_global_attrs = array(
			//	'itemprop' => "headline"
			// );
			$vargs->url_active = false;
			// $vargs->url_global_attrs = array();

			/**
			 * == ez_post_post_content_v1
			 */
			$vargs->content_active               = true;
			// $vargs->content_wrapper_tag          = 'span';
			// $vargs->content_wrapper_global_attrs = array(
			//	'class' => 'ez-post-post-content-wrapper'
			//);
			// $vargs->content_tag                  = 'span';
			// $vargs->content_global_attrs         = array(
			//	'itemprop' => 'articleBody'
			// );
			return $vargs;
		}
	}
}