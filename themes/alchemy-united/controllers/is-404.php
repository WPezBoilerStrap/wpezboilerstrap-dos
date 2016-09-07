<?php

namespace WPezTheme;

if ( ! class_exists('Is_404')) {
	class Is_404 extends \WPezBoilerStrap\Toolbox\Parents\Controller
	{
		protected $_wpezconfig;

		public function __construct() {

			// $this->_wpezconfig = WPezConfig::ez_new();
		}

		/*
 * return string
 */
		public function get_view(){

			$str_ret = '';

			$str_ret .= 'TODO - 404';

			return $str_ret;
		}

		/*
		 * return obj
		 */
		protected function language() {

			$obj = new \stdClass();

			return $obj;
		}

		/*
		 * return obj
		 */
		protected function model() {

			$obj = new \stdClass();

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

			$obj = new \stdClass();

			return $obj;
		}



	}
}