<?php

namespace WPezTheme;

if ( ! class_exists('Page')) {
	class Page extends \WPezBoilerStrap\Toolbox\Parents\Controller
	{
		protected $_wpezconfig;

		public function __construct() {

			$this->_wpezconfig = WPezConfig::ez_new();
		}

		/**
		 * return string
		 */
		public function get_view(){

			$obj = new \stdClass();

			$obj->active = true;
			$obj->class = '\\WPezBoilerStrap\Views\Posts\Post_Page_V1';
			$obj->args = $this->get_view_args();
			$obj->method = 'render';

			$str_ret = $this->ez_loader($obj);

			return $str_ret;
		}

		/*
		 * return obj
		 */
		protected function language() {

			$obj = new \stdClass();

			return $obj;
		}

		/*
		 * return obj
		 */
		protected function model() {

			global $post;

			$obj = new \stdClass();

			$obj->post_title = $post->post_title;

			$content = $post->post_content;
			$content = apply_filters( 'the_content', $content );
			$content = str_replace( ']]>', ']]&gt;', $content );

			$obj->post_content = $content;

			return $obj;
		}

		/*
		 * return obj
		 */
		protected function partials() {

			$obj = new \stdClass();

			return $obj;
		}


		/*
		 * return obj
		 */
		protected function router() {

			$obj = new \stdClass();

			return $obj;
		}


		/*
		 * return obj
		 */
		protected function viewargs() {

			$str_method = 'page';

			$obj_vargs= $this->_wpezconfig->get('viewargs');

			return $obj_vargs->get($str_method);
		}



	}
}