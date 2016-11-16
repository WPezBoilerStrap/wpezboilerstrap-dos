<?php

namespace WPez\WPezBoilerStrap\Views\Posts;

if ( ! class_exists('Post_EZ_Demo_V1')) {
	class Post_EZ_Demo_V1 extends \WPez\WPezBoilerStrap\Toolbox\Parents\View {


		protected function view( $mod, $parts, $vargs ) {

			$mac = $this->_mac;

		// print_r($mod);

			$str_ret = '';

			$str_ret = '<header>';

			$str_ret .= $mac::ez_post_img_v1($mod, $vargs);

			$str_ret .= $mac::element_open($vargs->meta_above_wrapper_tag, $vargs->meta_above_wrapper_global_attrs);
			$str_ret .= $mac::ez_post_date_v1($mod, $vargs);
			$str_ret .= $mac::element_close($vargs->meta_above_wrapper_tag);

			$str_ret .= $mac::ez_post_title_v1($mod, $vargs);

			$str_ret .= '</header>';
			$str_ret .= '<footer>';

			$str_ret .= $mac::element_open($vargs->meta_below_wrapper_tag, $vargs->meta_below_wrapper_global_attrs);

			$str_ret .= '<br>' . $mac::ez_post_author_v1($mod, $vargs);

			$str_ret .= '<br>' . $mac::ez_post_category_v1($mod, $vargs);

			$str_ret .= '<br>' . $mac::ez_post_post_tag_v1($mod, $vargs);

			$str_ret .= $mac::element_close($vargs->meta_below_wrapper_tag);

			$str_ret .= '</footer>';

			$str_ret .= '<section>';

			$str_ret .= '<br>' . $mac::ez_post_post_excerpt_v1($mod, $vargs);

			$str_ret .= '<br>' . $mac::ez_post_read_more_v1($mod, $vargs);

			$str_ret .= '<br>' . $mac::ez_post_edit_v1($mod, $vargs);

			$str_ret .= '<br>' . $mac::ez_post_post_content_v1($mod, $vargs);

			$str_ret .= '</section>';





			return $str_ret;
		}

		protected function lang_defaults() {

			$lang = new \stdClass();

			return $lang;
		}

		protected function mod_defaults() {

			$mod = new \stdClass();

			$mod->title = 'TODO';
			$mod->url = 'TODO';

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

			// meta wrap
			$vargs->meta_above_wrapper_tag = 'span';
			$vargs->meta_above_wrapper_global_attrs = array(
				'class' => 'ez-post-meta-above-wrapper ez-post-meta-wrapper'
			);

			$vargs->meta_below_wrapper_tag = 'span';
			$vargs->meta_below_wrapper_global_attrs = array(
				'class' => 'ez-post-meta-below-wrapper  ez-post-meta-wrapper'
			);

			/**
			 * == ez_post_img_v1_vargs
			 */

			$vargs->img_active               = true;
			// $vargs->img_wrapper_tag          = 'span';
			// $vargs->img_wrapper_global_attrs = array(
			// 	'class' => 'ez-post-img-wrapper'
			// );

			// $vargs->img_global_attrs = array(
			// 	'class' => 'img-responsive  ez-post-img-wrapper__img',
			//	// 'alt' => false   // use this to override the default alt =
			// );


			/**
			 * == ez_post_title_v1_vargs
			 */

			$vargs->title_wrapper_tag = 'div';
			//$vargs->title_wrapper_global_attrs = array();
			//$vargs->title_tag = 'h1';
			//$vargs->title_global_attrs = array(
			//	'itemprop' => "headline"
			//);
			//$vargs->url_active = true;
			//$vargs->url_global_attrs = array();



			/**
			 * == ez_post_date_v1
			 */

			$vargs->date_active               = true;
			//$vargs->date_wrapper_tag          = 'span';
			// $vargs->date_wrapper_global_attrs = array(
			// 	'class' => 'ez-post-date-wrapper'
			// );
			//$vargs->url_active                     = true;
			//$vargs->url_global_attrs = array();

			//$vargs->date_icon_tag             = ''; // 'i'
			$vargs->date_icon_global_attrs = array(); // 'class' => 'fa fa-calendar fa-fw'
			//$vargs->date_text_tag             = 'span';
			//$vargs->date_text_global_attrs = array();
			$vargs->date_text = 'Published';

			// $vargs->post_date_tag             = 'span';
			// $vargs->post_date_global_attrs = array();
			$vargs->date_format           = 'F d, Y';

			//$vargs->time_post_date_global_attrs = array(
			//	'class' => 'published',
			//	'itemprop' => 'datePublished',
			//);
			// $vargs->time_post_date_format = 'c';
			//$vargs->time_post_modified_global_attrs = array(
			//	'class' => 'modified',
			//	'itemprop' => 'dateModified',
			//);
			//$vargs->time_post_modified_format   = 'c';

			/**
			 * == ez_post_author_v1
			 */

			$vargs->author_active               = true;
			//$vargs->author_wrapper_tag          = 'span';
			//$vargs->author_wrapper_global_attrs = array(
			// 'class'     => 'ez-post-author-wrapper',
			//	'itemprop' => 'author',
			//	'itemscope' => '',
			//	'itemtype' => 'http://schema.org/Person'
			//);

			//$vargs->user_posts_url_active = true;
			//$vargs->user_posts_url_global_attrs = array();

			//$vargs->author_icon_tag             = 'i';
			// $vargs->author_icon_global_attrs = array(); // 'class' => 'fa fa-calendar fa-fw'

			//$vargs->author_text_tag             = 'span';
			//$vargs->author_text_global_attrs = array();
			// $vargs->author_text = 'Written by: ';

			//$vargs->display_name_tag             = 'span';
			//$vargs->display_name_global_attrs = array(
			//	'itemprop' => 'name'
			// );


			/**
			 * == ez_post_category_v1
			 */

			$vargs->category_active = true;
			//$vargs->category_wrapper_tag = 'span';
			//$vargs->category_wrapper_global_attrs = array(
			// 'class'    => 'ez-post-category-wrapper',
			//	'itemprop' => 'articleSection'
			//);

			//$vargs->category_icon_tag = 'i';
			$vargs->category_icon_global_attrs = array(
				'class' => 'fa fa-flag'
			);
			//$vargs->category_text_tag = 'span';
			//$vargs->category_text_global_attrs = array();
			// $vargs->category_text = 'Category: ';

			//$vargs->category_implode_glue = ', ';

			/**
			 * == ez_post_post_tag_v1
			 */

			$vargs->post_tag_active = true;
			// $vargs->post_tag_wrapper_tag = 'span';
			// $vargs->post_tag_wrapper_global_attrs = array(
			// 'class'    => 'ez-post-post-tag-wrapper',
			//	'itemprop' => 'keywords'
			//);

			// $vargs->post_tag_icon_tag = 'i';
			$vargs->post_tag_icon_global_attrs = array(
				'class' => 'fa fa-tag'
			);
			// $vargs->post_tag_text_tag = 'span';
			// $vargs->post_tag_text_global_attrs = array();
			// $vargs->post_tag_text = 'Tags: ';

			//$vargs->post_tag_implode_glue = ', ';

			/**
			 * == ez_post_post_excerpt_v1
			 */
			$vargs->excerpt_active               = true;
			// $vargs->excerpt_wrapper_tag          = 'span';
			// $vargs->excerpt_wrapper_global_attrs = array(
			//	'class' => 'ez-post-post-excerpt-wrapper'
			// );
			// $vargs->excerpt_tag                  = 'h2';
			// $vargs->excerpt_global_attrs         = array(
			//	'itemprop' => 'description'
			// );

			/**
			 * == ez_post_read_more_v1
			 */
			$vargs->read_more_active               = true;
			// $vargs->read_more_wrapper_tag          = 'span';
			// $vargs->read_more_wrapper_global_attrs = array(
			//	'class' => 'ez-post-read-more-wrapper'
			// );
			// $vargs->read_more_title_text           = 'Read article: ';
			// $vargs->read_more_global_attrs         = array();
			// $vargs->read_more_text                 = 'Read More';
			// $vargs->read_more_icon_location        = false; // 'before' 'after'
			// $vargs->read_more_icon_tag             = 'i';
			 // $vargs->read_more_icon_global_attrs    = array();

			/**
			 * == ez_post_post_excerpt_v1
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