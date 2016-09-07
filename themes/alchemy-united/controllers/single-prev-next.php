<?php

namespace WPezTheme;

if ( ! class_exists('Single_Prev_Next')) {
	class Single_Prev_Next extends \WPezBoilerStrap\Toolbox\Parents\Controller
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
			$obj->class = '\\WPezBoilerStrap\Views\Components\Prev_Next_Min_V1';
			$obj->args = $this->get_view_args();
			//$obj->args->use = 'defaults';
			$obj->method = 'render';

			$str_ret = $this->ez_loader($obj);

			return $str_ret;
		}

		/**
		 * return obj
		 */
		protected function language() {

			$lang = new \stdClass();

			$lang->aria_label = 'Single blog article previous next paging';

			return $lang;
		}

		/**
		 * return obj
		 */
		protected function model() {

			$obj_single_v1 = new \WPezBoilerStrap\Models\Posts\Single_V1();
			//	$ga = $single->get_adjacent();
			$obj = $obj_single_v1->get_adjacent_links_min();

		//	var_dump($obj);

			return $obj;
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

			$str_method = 'single_prev_next';

			$vargs = $this->_wpezconfig->get('viewargs');

			return $vargs->get($str_method);

		}



	}
}