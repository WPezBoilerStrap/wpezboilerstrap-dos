<?php

namespace WPezTheme;

if ( ! class_exists('TODO_CONTROLLER')) {
	class TODO_CONTROLLER extends \WPezBoilerStrap\Toolbox\Parents\Controller
	{
		protected $_wpezconfig;

		public function __construct() {

			// $this->_wpezconfig = WPezConfig::ez_new();
		}

		/**
		 * return string
		 */
		public function get_view(){

			$str_ret = '';

			/*
			$obj_gv = new \stdClass();

			$obj_gv->active = true;
			$obj_gv->class = '\\WPezBoilerStrap\Views\Wrappers\Wrapper_Two_V1';
			$obj_gv->args = $this->get_view_args();
			$obj_gv->method = 'render';

			$str_ret = $this->ez_loader($obj_gv);
			*/

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

			$mod = new \stdClass();

			/*
			$loop = new \WPezBoilerStrap\Models\Posts\Loop_V1();

			$arr_args = $this->globals('get_pagination');
			$arr_pages = $loop->get_pagination($arr_args);

			$mod->pages = $arr_pages;
*/
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

			$obj = new \stdClass();

			return $obj;
		}



	}
}