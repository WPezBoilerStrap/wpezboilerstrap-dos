<?php

namespace WPezTheme;

if ( ! class_exists('Header')) {
	class Header extends \WPezBoilerStrap\Toolbox\Parents\Controller
	{
		protected $_wpezconfig;

		public function __construct() {

			// $this->_wpezconfig = WPezConfig::ez_new();
		}


		/**
		 * @return bool|string
		 */
		public function get_view(){

			$obj = new \stdClass();

			$obj->active = true;
			$obj->class = '\\WPezBoilerStrap\Views\Headers\Header_V1';
			$obj->args = $this->get_view_args();
			$obj->method = 'render';

			$str_ret = $this->ez_loader($obj);

			return $str_ret;
		}

		/*
		 * return obj
		 */
		protected function language() {

			$l = new \stdClass();

			return $l;
		}

		/*
		 * return obj
		 */
		protected function model() {

			$m = new \stdClass();

			return $m;
		}

		/*
		 * return obj
		 */
		protected function partials() {

			$obj        = new \stdClass();

			$obj->active = true;
			$obj->slug  = 'controllers\header-nav';
			$obj->name  = '';
			$obj->class = '\\WPezTheme\Header_Nav';
			$obj->args  = '';
			$obj->method = 'get_view';

			$str_nav = $this->ez_loader($obj);

			$obj = new \stdClass();
			$obj->nav = $str_nav;

			return $obj;
		}


		/*
		 * return obj
		 */
		protected function router() {

			$r = new \stdClass();

			return $r;
		}


		/*
		 * return obj
		 */
		protected function viewargs() {

			$va = new \stdClass();

			return $va;
		}



	}
}