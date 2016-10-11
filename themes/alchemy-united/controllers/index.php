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

			$gv = new \stdClass();

			$gv->active = true;
			$gv->class = '\\WPezBoilerStrap\Views\Indexes\Index_BS3_V1';
			$gv->args = $this->get_view_args();
			$gv->method = 'render';

			$str_ret = $this->ez_loader($gv);

			return $str_ret;
		}

		/*
		 * return obj
		 */
		protected function language() {

			$lang = new \stdClass();

			return $lang;
		}


		/*
		* return obj
		*/
		protected function macros() {

			$mac = new \stdClass();

			return $mac;
		}

		/*
		 * return obj
		 */
		protected function model() {

			$mod = new \stdClass();

			return $mod;
		}

		/*
		 * return obj
		 */
		protected function partials() {

			$parts       = new \stdClass();

			$part = new \stdClass();

			$parts->pre_head_close = ''; // e.g. add google analytics snippet

			$part->active = true;
			$part->slug  = 'controllers\index-body';
			$part->name  = '';
			$part->class = '\\WPezTheme\Index_Body';
			$part->args  = '';
			$part->method = 'get_view';

			$str_body = $this->ez_loader($part);
			$parts->body = $str_body;



			return $parts;
		}

		/*
		 * return obj
		 */
		protected function router() {

			$route = new \stdClass();

			return $route;
		}

		/*
		 * return obj
		 */
		protected function viewargs() {

			$str_method = 'index';

			$obj_vargs= $this->_wpezconfig->ez_get('viewargs', $str_method);

			return $obj_vargs;
		}

	}
}