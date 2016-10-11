<?php

namespace WPezTheme;

if ( ! class_exists('Single')) {
	class Single extends \WPezBoilerStrap\Toolbox\Parents\Controller
	{
		protected $_wpezconfig;

		public function __construct() {

			// $this->_wpezconfig = WPezConfig::ez_new();
		}

		/**
		 * return string
		 */
		public function get_view(){

			$gv = new \stdClass();

			$gv->active = true;
			$gv->class = '\\WPezBoilerStrap\Views\Groups\Group_Three_V1';
			$gv->args = $this->get_view_args();
			$gv->method = 'render';

			$str_ret = $this->ez_loader($gv);

			return $str_ret;
		}

		/**
		 * @return \stdClass
		 */
		protected function language() {

			$lang = new \stdClass();

			return $lang;
		}

		/**
		 * @return \stdClass
		 */
		protected function macros() {

			$mac = new \stdClass();

			return $mac;
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


			$part        = new \stdClass();

			$part->active = true;
			$part->slug_path = 'controllers\components';
			$part->slug  = 'tabs-collapse';
			$part->name  = '';
			$part->class = '\\WPezTheme\Tabs_Collapse';
			$part->args  = '';
			$part->method = 'get_view';

			$str_accord = $this->ez_loader($part);


			$gtp_path = $this->gtp_path(__DIR__);

			$part        = new \stdClass();

			$part->active = true;
			$part->slug_path = $gtp_path;
			$part->slug  =  'single-main';
			$part->name  = '';
			$part->class = '\\WPezTheme\Single_Main';
			$part->args  = '';
			$part->method = 'get_view';

			$str_sing_wrap = $this->ez_loader($part);

			// -
			$part        = new \stdClass();

			$part->active = true;
			$part->slug_path = 'controllers\components';
			$part->slug  = 'single-prev-next';
			$part->name  = '';
			$part->class = '\\WPezTheme\Single_Prev_Next';
			$part->args  = '';
			$part->method = 'get_view';

			$str_sing_np = $this->ez_loader($part);

			// -
			$parts = new \stdClass();

			$parts->one = $str_accord;
			$parts->two = $str_sing_wrap;
			$parts->three = $str_sing_np;

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

			$vargs = new \stdClass();

			return $vargs;
		}

	}
}