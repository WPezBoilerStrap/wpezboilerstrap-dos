<?php

namespace WPezTheme;

if ( ! class_exists('Search_HTML5')) {
	class Search_HTML5 extends \WPezBoilerStrap\Toolbox\Parents\Controller
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

			$obj_gv = new \stdClass();

			$obj_gv->active = true;
			$obj_gv->class = '\\WPezBoilerStrap\Views\Components\Search_HTML5_V1';
			$obj_gv->args = $this->get_view_args();
			$obj_gv->args->use = 'defaults';
			$obj_gv->method = 'render';

			$str_ret = $this->ez_loader($obj_gv);

			return $str_ret;
		}

		/**
		 * return obj
		 */
		protected function language() {

			$lang = new \stdClass();

			return $lang;
		}

		/**
		 * return obj
		 */
		protected function model() {

			$mod = new \stdClass();

			return $mod;
		}

		/**
		 * return obj
		 */
		protected function partials() {

			$parts = new \stdClass();

			return $parts;
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

			$vargs = new \stdClass();

			// $str_method = 'index-body';

			// $obj_vargs = $this->_wpezconfig->get('viewargs');

			// return $obj_vargs->get($str_method);

			return $vargs;
		}



	}
}