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

			$obj = new \stdClass();

			return $obj;
		}

		/**
		 * return obj
		 */
		protected function partials() {

			$obj = new \stdClass();

			/*
			$part        = new \stdClass();

			$part->active = true;
			$part->slug  = 'controllers\sidebar-accordion';
			$part->name  = '';
			$part->class = '\\WPezTheme\Sidebar_Accordion';
			$part->args  = '';
			$part->method = 'get_view';

			$str_accord = $this->ez_loader($part);

			$obj->one = $str_accord;

			// -
			$part        = new \stdClass();

			$part->active = true;
			$part->slug  = 'controllers\single-wrapper';
			$part->name  = '';
			$part->class = '\\WPezTheme\Single_Wrapper';
			$part->args  = '';
			$part->method = 'get_view';

			$str_sing_wrap = $this->ez_loader($part);

			$obj->two = $str_sing_wrap;


			// -
			$part        = new \stdClass();

			$part->active = true;
			$part->slug  = 'controllers\single-next-prev';
			$part->name  = '';
			$part->class = '\\WPezTheme\Single_Next_Prev';
			$part->args  = '';
			$part->method = 'get_view';

			$str_sing_np = $this->ez_loader($part);

			$obj->three = $str_sing_np;
			*/

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

			// $str_method = 'index-body';

			// $obj_vargs = $this->_wpezconfig->get('viewargs');

			// return $obj_vargs->get($str_method);

			return $obj;
		}



	}
}