<?php

namespace WPezTheme;

if ( ! class_exists( 'Index')) {
	class Index extends \WPezBoilerStrap\Toolbox\Parents\Controller
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
			$obj->class = '\\WPezBoilerStrap\Views\Indexes\Index_BS3_V1';
			$obj->args = $this->get_view_args();
			$obj->method = 'render';

			$str_ret = $this->ez_loader($obj);

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

			$obj        = new \stdClass();

			$obj->active = true;
			$obj->slug  = 'controllers\index-body';
			$obj->name  = '';
			$obj->class = '\\WPezTheme\Index_Body';
			$obj->args  = '';
			$obj->method = 'get_view';

			$str_body = $this->ez_loader($obj);

			$obj = new \stdClass();
			$obj->body = $str_body;

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

			$str_method = 'index';

			$obj_vargs= $this->_wpezconfig->get('viewargs');

			return $obj_vargs->get($str_method);
		}

	}
}