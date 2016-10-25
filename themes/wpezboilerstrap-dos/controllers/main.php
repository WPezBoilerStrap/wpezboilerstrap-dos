<?php

namespace WPezTheme;

if ( ! class_exists('Main')) {
	class Main extends \WPez\WPezBoilerStrap\Toolbox\Parents\Controller
	{
		protected $_wpezconfig;

		public function __construct() {

			$this->_wpezconfig = WPezConfig::ez_new();
		}


		/**
		 * @return bool|string
		 */
		public function get_view(){

			$obj = new \stdClass();

			$obj->active = true;
			$obj->class = '\\WPez\WPezBoilerStrap\Views\Groups\Group_One_V1';
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

			$mod = new \stdClass();

			return $mod;
		}



		/*
		 * return obj
		 */
		protected function partials() {

			$parts = new \stdClass();

			if ( is_page() ){

				$part        = new \stdClass();

				$part->active = true;
				$part->slug_path = 'controllers/pages';
				$part->slug  = 'page';
				$part->name  = '';
				$part->class = '\\WPezTheme\Page';
				$part->args  = '';
				$part->method = 'get_view';

				$parts->one = $this->ez_loader($part);

			} elseif ( is_single() ) {

				$part        = new \stdClass();

				$part->active = true;
				$part->slug_path  = 'controllers/single';
				$part->slug  = 'single';
				$part->name  = '';
				$part->class = '\\WPezTheme\Single';
				$part->args  = '';
				$part->method = 'get_view';

				$parts->one = $this->ez_loader($part);

			} elseif ( is_404() ){

				$part        = new \stdClass();

				$part->active = true;
				$part->slug_path  = 'controllers/is-404';
				$part->slug  = 'is-404';
				$part->name  = '';
				$part->class = '\\WPezTheme\Is_404';
				$part->args  = '';
				$part->method = 'get_view';

				$parts->one = $this->ez_loader($part);

			} else {

				$part        = new \stdClass();

				$part->active = true;
				$part->slug_path  = 'controllers/blog';
				$part->slug  = 'blog-group';
				$part->name  = '';
				$part->class = '\\WPezTheme\Blog_Group';
				$part->args  = '';
				$part->method = 'get_view';

				$parts->one = $this->ez_loader($part);

			}
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

			$vargs = new \stdClass();

			$str_method = 'main';
			$vargs = $this->_wpezconfig->ez_get('viewargs', $str_method);

			return $vargs;
		}



	}
}