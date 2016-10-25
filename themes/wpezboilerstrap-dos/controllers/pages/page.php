<?php

namespace WPezTheme;

if ( ! class_exists('Page')) {
	class Page extends \WPez\WPezBoilerStrap\Toolbox\Parents\Controller
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
			$obj->class = '\\WPez\WPezBoilerStrap\Views\Posts\Post_Page_V1';
			$obj->args = $this->get_view_args();
			$obj->method = 'render';

			$str_ret = $this->ez_loader($obj);

			return $str_ret;
		}

		/**
		 * @return \stdClass
		 */
		protected function language() {

			$lang = new \stdClass();

			return $lang;
		}


		/**
		 * @return \stdClass
		 */
		protected function model() {

			global $post;

			$mod = new \stdClass();

			$mod->post_title = $post->post_title;

			$content = $post->post_content;
			$content = apply_filters( 'the_content', $content );
			$content = str_replace( ']]>', ']]&gt;', $content );

			$mod->post_content = $content;

			return $mod;
		}

		/*
		 * return obj
		 */
		protected function partials() {

			$parts = new \stdClass();

			return $parts;
		}


		/*
		 * return obj
		 */
		protected function router() {

			$route = new \stdClass();

			return $route;
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