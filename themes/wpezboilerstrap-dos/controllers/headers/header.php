<?php

namespace WPezTheme;

if ( ! class_exists('Header')) {
	class Header extends \WPezBoilerStrap\Toolbox\Parents\Controller
	{
		protected $_wpezconfig;

		public function __construct() {

			$this->_wpezconfig = WPezConfig::ez_new();
		}


		/**
		 * @return bool|string
		 */
		public function get_view(){

			$gv = new \stdClass();

			$gv->active = true;
			$gv->class = '\\WPezBoilerStrap\Views\Groups\Group_One_V1';
			$gv->args = $this->get_view_args();
			$gv->method = 'render';

			$str_ret = $this->ez_loader($gv);

			return $str_ret;
		}

		/*
		 * return obj
		 */
		protected function language() {

			$lang= new \stdClass();

			return $lang;
		}

		/*
		 * return obj
		 */
		protected function model() {

			$mod = new \stdClass();

			return $mod;
		}

		/*
		 * return obj
		 */
		protected function partials() {

			$part        = new \stdClass();

			$part->active = true;
			$part->slug_path  = 'controllers\menus';
			$part->slug  = 'header-menu';
			$part->name  = '';
			$part->class = '\\WPezTheme\Header_Menu';
			$part->args  = '';
			$part->method = 'get_view';

			$str_nav = $this->ez_loader($part);

			$parts = new \stdClass();
			$parts->one = $str_nav;

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

			$str_method = 'header';

			$obj_vargs = $this->_wpezconfig->ez_get('viewargs', $str_method);

			return $obj_vargs;
		}



	}
}