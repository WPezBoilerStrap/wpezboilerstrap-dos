<?php

namespace WPezTheme;

if ( ! class_exists('Single_Term_Group')) {
	class Single_Term_Group extends \WPezBoilerStrap\Toolbox\Parents\Controller
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

			// ez on off switch
			$gv->active = true;
			// where is the slug (optional)
			//$ogv->slug_path = "";
			// the gtp slug (optional)
			//$gv->slug = '';
			// the class in that tp
			$gv->class = '\\WPezBoilerStrap\Views\Groups\Group_Two_V1';
			// the args we're "injecting" into the class
			$gv->args = $this->get_view_args();
			// $gv->args->use = 'defaults';
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
			$part->slug_path = $gtp_path;
			$part->slug  = 'single-term-category';
			$part->name  = '';
			$part->class = '\\WPezTheme\Single_Term_Category';
			$part->args  = '';
			$part->method = 'get_view';

			$str_term_cats = $this->ez_loader($part);

			$part        = new \stdClass();

			$part->active = true;
			$part->slug_path = $gtp_path;
			$part->slug  = 'single-term-post-tag';
			$part->name  = '';
			$part->class = '\\WPezTheme\Single_Term_Post_Tag';
			$part->method = 'get_view';

			$str_term_tags = $this->ez_loader($part);

			$parts = new \stdClass();

			$parts->one = $str_term_cats;
			$parts->two = $str_term_tags;

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