<?php

namespace WPezTheme;

if ( ! class_exists( 'Index_Body')) {
	class Index_Body extends \WPezBoilerStrap\Toolbox\Parents\Controller
	{
		protected $_wpezconfig;

		public function __construct() {
			$this->_wpezconfig = WPezConfig::ez_new();

		}


		/**
		 * @return mixed
		 */
		public function get_view(){

			$obj = new \stdClass();

			$obj->active = true;
			$obj->class = '\\WPezBoilerStrap\Views\Groups\Group_Three_V1';
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

			$obj = new \stdClass();

			return $obj;
		}

		/*
		 * return obj
		 */
		protected function partials() {

			$obj        = new \stdClass();

			$obj->active = true;
			$obj->slug  = 'controllers\header';
			$obj->name  = '';
			$obj->class = '\\WPezTheme\Header';
			$obj->args  = '';
			$obj->method = 'get_view';

			$str_header = $this->ez_loader($obj);

			//
			$obj        = new \stdClass();

			$obj->active = true;
			$obj->slug  = 'controllers\main';
			$obj->name  = '';
			$obj->class = '\\WPezTheme\main';
			$obj->args  = '';
			$obj->method = 'get_view';

			$str_main = $this->ez_loader($obj);

			//
			$obj        = new \stdClass();

			$obj->active = true;
			$obj->slug  = 'controllers\footer';
			$obj->name  = '';
			$obj->class = '\\WPezTheme\Footer';
			$obj->args  = '';
			$obj->method = 'get_view';

			$str_footer  = $this->ez_loader($obj);

			//
			$obj = new \stdClass();

			$obj->one = $str_header;
			$obj->two = $str_main;
			$obj->three = $str_footer;

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
			$obj->semantic = 'section';

			return $obj;
		}

	}
}