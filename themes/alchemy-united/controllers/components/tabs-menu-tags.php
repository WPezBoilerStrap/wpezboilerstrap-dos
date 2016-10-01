<?php

namespace WPezTheme;

if ( ! class_exists('Tabs_Menu_Tags')) {
	class Tabs_Menu_Tags extends \WPezBoilerStrap\Toolbox\Parents\Controller
	{

		protected $_wpezconfig;

		public function __construct() {

			$this->_wpezconfig = WPezConfig::ez_new();
		}

		/**
		 * return string
		 */
		public function get_view() {

			$str_ret = '';

			$obj = new \stdClass();

			$obj->active = true;
			$obj->class = '\\WPezBoilerStrap\Views\Components\Icon_Label_Links_V1';
			$obj->args = $this->get_view_args();
			// $obj->args->use = 'defaults';
			$obj->method = 'render';

			$str_ret = $this->ez_loader($obj);

			return $str_ret;
		}

		/**
		 * return obj
		 */
		protected function language() {

			$lang = new \stdClass();

			$lang->label = 'Tags'; // e.g. Tags, Catgories, etc.

			return $lang;
		}

		/**
		 * return obj
		 */
		protected function model() {

			$mod = new \stdClass();

			$tools_menu = new \WPezBoilerStrap\Models\Navs\Nav_Menu_V1();
			// get the menu by name
			$arr_main = $tools_menu->nav_menu_location_items('menu_tags');
			//clone it
			$tools_clone = new \WPezBoilerStrap\Toolbox\Tools\Cloning();
			$arr_objs = $tools_clone->ez_clone_menu_items($arr_main);

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

			$str_method = 'tabs_menu_tags';

			$obj_vargs = $this->_wpezconfig->get('viewargs');

			return $obj_vargs->get($str_method);
		}


	}
}