<?php

namespace WPezTheme;

if ( ! class_exists('Is_Archive')) {
	class Is_Archive extends \WPezBoilerStrap\Toolbox\Parents\Controller
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
			//$ogv->slug_path = "";
			// the gtp slug (optional)
			//$gv->slug = '';
			// the class in that tp
			$gv->class = '\\WPezBoilerStrap\Views\Components\Name_Description_V1';
			// the args we're "injecting" into the class
			$gv->args = $this->get_view_args();
			// IF we want to use the view's default args (optional)
			//  $gv->args->use = 'defaults';
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

			$lang = new \stdClass();

			$lang->category_1 = 'Category: ' ;
			$lang->post_tag_1 = 'Tag: ';
			$lang->author_1 = 'Author: ';
			$lang->search = 'Search term: ';
			$lang->search_found = 'Total found: ';

			// $str_method = 'TODO';
			//$lang = $this->_wpezconfig->ez_get('language', $str_method);
			return $lang;
		}

		/**
		 * return obj
		 */
		protected function model() {

			global $wp_query;

			$mod = new \stdClass();

			if ( is_category() || is_tag() || is_author() ){

				$cat = 'category_' . (string) is_category();
				$tag = 'post_tag_' . (string) is_tag();
				$auth = 'author_' . (string) is_author();

				$obj_lang = $this->language();
				$str_prefix = $obj_lang->$cat . $obj_lang->$tag . $obj_lang->$auth;

				$mod->name = $str_prefix . $wp_query->queried_object->name;
				$mod->description = $wp_query->queried_object->description;

			} elseif ( is_search() ){

				$mod->name = $this->language()->search . get_search_query();
				$mod->description = $this->language()->search_found . $wp_query->found_posts;
			}

			return $mod;
		}

		/**
		 * return obj
		 */
		protected function partials() {

			// $gtp_path = $this->gtp_path(__DIR__);

			$parts = new \stdClass();
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

			// $vargs = new \stdClass();

			$str_method = 'is_archive';
			$vargs = $this->_wpezconfig->ez_get('viewargs', $str_method);
			return $vargs;
		}
	}
}