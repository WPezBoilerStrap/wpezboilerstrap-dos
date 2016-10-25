<?php

namespace WPezTheme;

if ( ! class_exists('Footer_Bottom')) {
	class Footer_Bottom extends \WPez\WPezBoilerStrap\Toolbox\Parents\Controller
	{
		protected $_wpezconfig;

		public function __construct() {

			$this->_wpezconfig = WPezConfig::ez_new();
		}

		/**
		 * @return bool|string
		 */
		public function get_view(){

			$str_ret = '';

			$gv = new \stdClass();

			$gv->active = true;
			$gv->class = '\\WPez\WPezBoilerStrap\Views\Footers\Footer_V1';
			$gv->args = $this->get_view_args();
			$gv->method = 'render';

			$str_ret = $this->ez_loader($gv);

			return $str_ret;
		}

		/**
		 * @return \stdClass
		 */
		protected function language() {

			$str_method = 'footer_bottom';
			$lang = $this->_wpezconfig->ez_get('language', $str_method);
			return $lang;
		}

		/**
		 * @return \stdClass
		 */
		protected function model() {

			$mod = new \stdClass();

			return $mod;
		}

		/**
		 * @return \stdClass
		 */
		protected function partials() {

			$parts = new \stdClass();

			return $parts;
		}


		/**
		 * @return \stdClass
		 */
		protected function router() {

			$route = new \stdClass();

			return $route;
		}


		/**
		 * @return \stdClass
		 */
		protected function viewargs() {

			$vargs = new \stdClass();

			$str_method = 'footer_bottom';
			$vargs= $this->_wpezconfig->ez_get('viewargs', $str_method);
			return $vargs;
		}



	}
}