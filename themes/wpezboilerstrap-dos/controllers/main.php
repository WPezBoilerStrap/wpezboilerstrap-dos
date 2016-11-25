<?php

namespace WPezTheme;

if ( ! class_exists('Main')) {
	class Main extends \WPez\WPezBoilerStrap\Toolbox\Parents\Controller
	{
		protected $_wpezconfig;

		/**
		 * @return bool|string
		 */
		public function get_view(){

			$obj = new \stdClass();

			$obj->active = true;
			$obj->class = '\\WPez\WPezBoilerStrap\Views\Groups\Group_One_V1';
			$obj->args = $this->get_view_args();
			$obj->method = 'render';

			$str_ret = $this->ez_gtp_loader($obj);

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
				$part->args  = $this->_gargs;
				$part->method = 'get_view';

			} elseif ( is_single() ) {

				$part        = new \stdClass();

				$part->active = true;
				$part->slug_path  = 'controllers/single';
				$part->slug  = 'single';
				$part->name  = '';
				$part->class = '\\WPezTheme\Single';
				$part->args  = $this->_gargs;
				$part->method = 'get_view';

			} elseif ( is_404() ){

				$part        = new \stdClass();

				$part->active = true;
				$part->slug_path  = 'controllers/is-404';
				$part->slug  = 'is-404';
				$part->name  = '';
				$part->class = '\\WPezTheme\Is_404';
				$part->args  = $this->_gargs;
				$part->method = 'get_view';

			} else {

				$part        = new \stdClass();

				$part->active = true;
				$part->slug_path  = 'controllers/blog';
				$part->slug  = 'blog-group';
				$part->name  = '';
				$part->class = '\\WPezTheme\Blog_Group';
				$part->args  = $this->_gargs;
				$part->method = 'get_view';

			}

			$parts->one = $this->ez_gtp_loader($part);
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
			$vargs = $this->_vargs->get($str_method);

			return $vargs;
		}



	}
}