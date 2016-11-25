<?php

namespace WPezTheme;

if ( ! class_exists('Tabs_Menu_Categories')) {
	class Tabs_Menu_Categories extends \WPez\WPezBoilerStrap\Toolbox\Parents\Controller
	{

		/**
		 * return string
		 */
		public function get_view() {

			$str_ret = '';

			$obj = new \stdClass();

			$obj->active = true;
			$obj->class = '\\WPez\WPezBoilerStrap\Views\Components\Icon_Name_Links_V1';
			$obj->args = $this->get_view_args();
			// $obj->args->use = 'defaults';
			$obj->method = 'render';

			$str_ret = $this->ez_gtp_loader($obj);
			return $str_ret;
		}

		/**
		 * return obj
		 */
		protected function language() {

			$lang = new \stdClass();

			$lang->name = 'Categories'; // e.g. Tags, Catgories, etc.

			return $lang;
		}

		/**
		 * return obj
		 */
		protected function model() {

			$mod = new \stdClass();

			$tools_menu = new \WPez\WPezBoilerStrap\Models\Menus\Menu_V1();
			// get the menu by name
			$arr_main = $tools_menu->nav_menu_location_items('menu_categories');

			//clone it
			$tools_clone = new \WPez\WPezBoilerStrap\Toolbox\Tools\Cloning();
			$arr_objs = $tools_clone->ez_clone_menu_items($arr_main);

			$mod->name = $this->language()->name;
			$mod->array_objects = $arr_objs ;

			return $mod;
		}

		/**
		 * return obj
		 */
		protected function partials() {

			$obj = new \stdClass();

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

			$str_method = 'tabs_menu_categories';

			$vargs = $this->_vargs->get($str_method);

			return $vargs;
		}


	}
}