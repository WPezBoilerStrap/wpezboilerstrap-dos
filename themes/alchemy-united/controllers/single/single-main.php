<?php

namespace WPezTheme;

if ( ! class_exists('Single_Main')) {
	class Single_Main extends \WPezBoilerStrap\Toolbox\Parents\Controller
	{
		protected $_wpezconfig;

		public function __construct() {

			$this->_wpezconfig = WPezConfig::ez_new();
		}

		/**
		 * return string
		 */
		public function get_view(){

			$gv = new \stdClass();

			$gv->active = true;
			$gv->class = '\\WPezBoilerStrap\Views\Groups\Group_Two_V1';
			$gv->args = $this->get_view_args();
			$gv->method = 'render';

			$str_ret = $this->ez_loader($gv);

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
		 * @return \stdClass
		 */
		protected function macros() {

			$mac = new \stdClass();

			return $mac;
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

			$gtp_path = $this->gtp_path(__DIR__) . '/';

			$part        = new \stdClass();

			$part->active = true;
			$part->slug_path = $gtp_path;
			$part->slug  = 'single-post-header';
			$part->name  = '';
			$part->class = '\\WPezTheme\Single_Post_Header';
			$part->args  = $this->model();
			$part->method = 'get_view';

			$str_sing_ph = $this->ez_loader($part);

			// -
			$part        = new \stdClass();

			$part->active = true;
			$part->slug_path = $gtp_path;
			$part->slug  = 'single-content';
			$part->name  = '';
			$part->class = '\\WPezTheme\Single_Content';
			$part->args  = '';
			$part->method = 'get_view';

			$str_sing_con = $this->ez_loader($part);

			$parts = new \stdClass();

			$parts->one = $str_sing_ph;
			$parts->two = $str_sing_con;

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

			$str_method = 'single_main';
			$vargs = $this->_wpezconfig->ez_get('viewargs', $str_method);

			return $vargs;
		}



	}
}