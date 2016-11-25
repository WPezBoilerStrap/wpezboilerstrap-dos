<?php

namespace WPezTheme;

if ( ! class_exists('Single_Term_Group')) {
	class Single_Term_Group extends \WPez\WPezBoilerStrap\Toolbox\Parents\Controller
	{

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
			$gv->class = '\\WPez\WPezBoilerStrap\Views\Groups\Group_Two_V1';
			// the args we're "injecting" into the class
			$gv->args = $this->get_view_args();
			// $gv->args->use = 'defaults';
			$gv->method = 'render';

			$str_ret = $this->ez_gtp_loader($gv);

			return $str_ret;
		}

		/**
		 * return obj
		 */
		protected function language() {

			// $lang = new \stdClass();

			$str_method = 'TODO';

			$lang = $this->_lang->get($str_method);
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
			$part->slug_path = $gtp_path;
			$part->slug  = 'single-term-category';
			$part->name  = '';
			$part->class = '\\WPezTheme\Single_Term_Category';
			$part->args  = $this->_gargs;
			$part->method = 'get_view';

			$str_term_cats = $this->ez_gtp_loader($part);

			$part        = new \stdClass();

			$part->active = true;
			$part->slug_path = $gtp_path;
			$part->slug  = 'single-term-post-tag';
			$part->name  = '';
			$part->class = '\\WPezTheme\Single_Term_Post_Tag';
			$part->args  = $this->_gargs;
			$part->method = 'get_view';

			$str_term_tags = $this->ez_gtp_loader($part);

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