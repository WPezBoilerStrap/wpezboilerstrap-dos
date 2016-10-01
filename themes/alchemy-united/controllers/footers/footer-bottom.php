<?php

namespace WPezTheme;

if ( ! class_exists('Footer_Bottom')) {
	class Footer_Bottom extends \WPezBoilerStrap\Toolbox\Parents\Controller
	{
		protected $_wpezconfig;

		public function __construct() {

			$this->_wpezconfig = WPezConfig::ez_new();
		}

		/*
 * return string
 */
		public function get_view(){


			$str_ret = '';

			$gv = new \stdClass();

			$gv->active = true;
			$gv->class = '\\WPezBoilerStrap\Views\Footers\Footer_V1';
			$gv->args = $this->get_view_args();
			// $gv->args->use = 'defaults';
			$gv->method = 'render';

			$str_ret = $this->ez_loader($gv);

			return $str_ret;
		}

		/*
		 * return obj
		 */
		protected function language() {

			$lang = new \stdClass();

			$str_method = 'footer_bottom';
			$lang = $this->_wpezconfig->ez_get('language', $str_method);
			return $lang;
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

			$p = new \stdClass();

			return $p;
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

			$vargs = new \stdClass();

			$str_method = 'footer_bottom';
			$vargs= $this->_wpezconfig->ez_get('viewargs', $str_method);
			return $vargs;
		}



	}
}