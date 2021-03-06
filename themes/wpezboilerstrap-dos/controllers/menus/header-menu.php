<?php

namespace WPezTheme;

if ( ! class_exists('Header_Menu')) {
	class Header_Menu extends \WPez\WPezBoilerStrap\Toolbox\Parents\Controller
	{

		/**
		 * @return bool|string
		 */
		public function get_view(){


			$obj = new \stdClass();

			$obj->active = true;
			$obj->class = '\\WPez\WPezBoilerStrap\Views\Menus\Menu_BS3_V1';
			$obj->args = $this->get_view_args();
			$obj->method= 'render';

			$str_ret = $this->ez_gtp_loader($obj);

			return $str_ret;
		}

		/*
		 * return obj
		 */
		protected function language() {

			$str_method = 'header_nav';
			$obj_lang = $this->_lang->get($str_method);

			return $obj_lang;
		}


		/*
		 * return obj
		 */
		protected function model() {

			$menu = new \WPezTheme\Scaffolding\Menus_Args();
			$menu_args = $menu->get('menu_main');

			$mod = new \stdClass();

			$mod->brand_url = home_url( '/' );
			$mod->menu = wp_nav_menu($menu_args->wp_nav_menu);

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

			$str_method = 'header_nav_bs3';

			$obj_vargs = $this->_vargs->get($str_method);

			return $obj_vargs;

		}

	}
}