<?php

namespace WPezTheme;

if ( ! class_exists('Single_Post_Header')) {
	class Single_Post_Header extends \WPezBoilerStrap\Toolbox\Parents\Controller
	{
		protected $_wpezconfig;

		public function __construct( $x = '') {

			// $this->_wpezconfig = WPezConfig::ez_new();
		}

		/**
		 * return string
		 */
		public function get_view(){

			$obj = new \stdClass();

			$obj->active = true;
			$obj->class = '\\WPezBoilerStrap\Views\Posts\Post_Header_V1';
			$obj->args = $this->get_view_args();
			$obj->method = 'render';

			$str_ret = $this->ez_loader($obj);

			return $str_ret;
		}

		/**
		 * return obj
		 */
		protected function language() {

			$obj = new \stdClass();

			return $obj;
		}

		/**
		 * return obj
		 */
		protected function model() {

			global $post;

			$obj_post = $this->ez_clone($post);

			$obj_user = new \WPezBoilerStrap\Models\Users\User_V1();
			$obj_post->ezx->user = $obj_user->user_min($obj_post->post_author);

			return $obj_post;

		}

		/**
		 * return obj
		 */
		protected function partials() {

			$gtp_path = $this->gtp_path(__DIR__) . '/';

			$obj = new \stdClass();

			$part        = new \stdClass();

			$part->active = true;
			$part->slug_path = $gtp_path;
			$part->slug  = 'single-term-category';
			$part->name  = '';
			$part->class = '\\WPezTheme\Single_Term_Category';
			$part->args  = '';
			$part->method = 'get_view';

			$str_term_cats = $this->ez_loader($part);

			$obj->one = $str_term_cats;

			$part        = new \stdClass();

			$part->active = true;
			$part->slug_path = $gtp_path;
			$part->slug  = 'single-term-post-tag';
			$part->name  = '';
			$part->class = '\\WPezTheme\Single_Term_Post_tag';
			$part->method = 'get_view';

			$str_term_tags = $this->ez_loader($part);

			$obj->two = $str_term_tags;

			return $obj;
		}


		/**
		 * return obj
		 */
		protected function router() {

			$obj = new \stdClass();

			return $obj;
		}

		/**
		 * return obj
		 */
		protected function viewargs() {

			$obj_enc = new \stdClass();

			$obj_enc->active = true;            // an enclosure master switch - default is true

			$obj_enc->semantic_active = true;   // default is true
			$obj_enc->semantic_tag = 'header';
			$obj_enc->semantic_global_attrs = array(
				//'class' => 'my semantic class test'
			);

			$obj_enc->wrapper_active = false;   // default is true
			$obj_enc->wrapper_tag = 'tag_TODO';
			$obj_enc->wrapper_global_attrs = array(
				'class' => 'my wrapper class test'
			);

			$vargs = new \stdClass();
			$vargs->enclose = $obj_enc;

			return $vargs;
		}



	}
}