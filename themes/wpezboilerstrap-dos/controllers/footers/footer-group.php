<?php

namespace WPezTheme;

if ( ! class_exists('Footer_Group')) {
	class Footer_Group extends \WPezBoilerStrap\Toolbox\Parents\Controller
	{
		protected $_wpezconfig;

		public function __construct() {

			$this->_wpezconfig = WPezConfig::ez_new();
		}

		/**
		 * - The Parent Controller has these standard "helper' methods:
		 *
		 * - get_path($str) - (where $str = __DIR__) will return the gtp friendly path of the current
		 *  file. useful when loading pathials that are in the same folder
		 *
		 * - ez_loader$obj) - for loading controllers and views.
		 *
		 * - ez_clone($obj) - will clone a (WP) object and "reset" so its ez compatible.
		 */

		/**
		 * return string
		 */
		public function get_view(){

			$gv = new \stdClass();
			$str_ret = '';

			// ez on off switch
			$gv->active = true;
			// where is the slug (optional)
			//$gv->slug_path = $this->gtp_path(__DIR__)
			// the gtp slug (optional)
			//$gv->slug = 'footer';
			// the class in that tp
			$gv->class = '\\WPezBoilerStrap\Views\Groups\Group_Two_V1';
			// the args we're "injecting" into the class
			$gv->args = $this->get_view_args();
			//$gv->args->use = 'defaults';
			// once we init the class what method do we "request" (optional)
			// note: if method is empty of false, ex_loader will return the init'ed obj of the class
			$gv->method = 'render';

			$str_ret = $this->ez_loader($gv);


			return $str_ret;
		}

		/**
		 * return obj
		 */
		protected function language() {

			// $lang = new \stdClass();

			$str_method = 'TODO';

			$lang = $this->_wpezconfig->ez_get('language', $str_method);
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

			$gtp_path = $this->gtp_path(__DIR__);

			$part        = new \stdClass();

			$part->active = true;
			$part->slug_path  = $gtp_path;
			$part->slug  = 'footer';
			$part->name  = '';
			$part->class = '\\WPezTheme\Footer';
			$part->args  = '';
			$part->method = 'get_view';

			$str_foot = $this->ez_loader($part);

			// -
			$part        = new \stdClass();

			$part->active = true;
			$part->slug_path  = $gtp_path;
			$part->slug  = 'footer-bottom';
			$part->name  = '';
			$part->class = '\\WPezTheme\Footer_Bottom';
			$part->args  = '';
			$part->method = 'get_view';

			$str_foot_bott = $this->ez_loader($part);

			$parts = new \stdClass();

			$parts->one = $str_foot;
			$parts->two = $str_foot_bott;

			return $parts;
		}


		/**
		 * return obj
		 */
		protected function router() {

			$route = new \stdClass();

			return $route;
		}


		/**
		 * return obj
		 */
		protected function viewargs() {

			$vargs = new \stdClass();

			$str_method = 'footer_wrapper';
			$vargs = $this->_wpezconfig->ez_get('viewargs', $str_method);
			return $vargs;
		}
	}
}