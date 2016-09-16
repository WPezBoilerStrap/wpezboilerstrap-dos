<?php

namespace WPezTheme;

if ( ! class_exists('Header_Nav')) {
	class Header_Nav extends \WPezBoilerStrap\Toolbox\Parents\Controller
	{
		protected $_wpezconfig;

		public function __construct() {

			$this->_wpezconfig = WPezConfig::ez_new();
		}

		/*
 * return string
 */
		public function get_view(){


			$obj = new \stdClass();

			$obj->active = true;
			$obj->class = '\\WPezBoilerStrap\Views\Navs\Nav_BS3_V1';
			$obj->args = $this->get_view_args();
			$obj->method= 'render';

			$str_ret = $this->ez_loader($obj);

			return $str_ret;
		}

		/*
		 * return obj
		 */
		protected function language() {

			$str_method = 'header_nav';

			$obj_lang = $this->_wpezconfig->get('language');

			return $obj_lang->get($str_method);
		}

		/*
		 * return obj
		 */
		protected function model() {

			$menu = new \WPezTheme\Scaffolding\Menus();
			$menu_args = $menu->get('menu_main');

			$obj = new \stdClass();

			$obj->brand_url = home_url( '/' );
			$obj->wp_nav_menu = wp_nav_menu($menu_args->wp_nav_menu);

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

			$str_method = 'header_nav_bs3';

			$obj_vargs = $this->_wpezconfig->get('viewargs');

			return $obj_vargs->get($str_method);

		}

	}
}