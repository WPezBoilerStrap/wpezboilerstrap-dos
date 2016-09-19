<?php

namespace WPezTheme;

if ( ! class_exists('TODO_CONTROLLER')) {
	class TODO_CONTROLLER extends \WPezBoilerStrap\Toolbox\Parents\Controller
	{
		protected $_wpezconfig;

		public function __construct() {

			// $this->_wpezconfig = WPezConfig::ez_new();
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


			/*
			// ez on off switch
			$gv->active = true;
			// where is the slug (optional)
			//$ogv->slug_path = "";
			// the gtp slug (optional)
			//$gv->slug = '';
			// the class in that tp
			$gv->class = '\\WPezBoilerStrap\Views\Wrappers\Wrapper_Two_V1';
			// the args we're "injecting" into the class
			$gv->args = $this->get_view_args();
			// IF we want to use the view's default args (optional)
			// $gv->args->use = 'defaults';
			// once we init the class what method do we "request" (optional)
			// note: if method is empty of false, ex_loader will return the init'ed obj of the class
			$gv->method = 'render';

			$str_ret = $this->ez_loader($obj_gv);
			*/

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

			// $gtp_path = $this->gtp_path(__DIR__);

			$parts = new \stdClass();

			/*
			$part        = new \stdClass();

			$part->active = true;
			$part->slug_path  = 'controllers';
			$part->slug  = 'sidebar-accordion';
			$part->name  = '';
			$part->class = '\\WPezTheme\Sidebar_Accordion';
			$part->args  = '';
			$part->method = 'get_view';

			$str_accord = $this->ez_loader($part);

			$parts->one = $str_accord;

			// -
			$part        = new \stdClass();

			$part->active = true;
			$part->slug_path  = 'controllers';
			$part->slug  = 'single-wrapper';
			$part->name  = '';
			$part->class = '\\WPezTheme\Single_Wrapper';
			$part->args  = '';
			$part->method = 'get_view';

			$str_sing_wrap = $this->ez_loader($part);

			$parts->two = $str_sing_wrap;


			// -
			$part        = new \stdClass();

			$part->active = true;
			$part->slug_path  = 'controllers';
			$part->slug  = 'single-next-prev';
			$part->name  = '';
			$part->class = '\\WPezTheme\Single_Next_Prev';
			$part->args  = '';
			$part->method = 'get_view';

			$str_sing_np = $this->ez_loader($part);

			$parts->three = $str_sing_np;
			*/

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

			//$str_method = 'TODO';
			//$vargs = $this->_wpezconfig->ez_get('viewargs', $str_method);
			return $vargs;
		}
	}
}