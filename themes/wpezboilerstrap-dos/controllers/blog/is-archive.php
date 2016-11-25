<?php

namespace WPezTheme;

if ( ! class_exists('Is_Archive')) {
	class Is_Archive extends \WPez\WPezBoilerStrap\Toolbox\Parents\Controller
	{

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
			$gv->class = '\\WPez\WPezBoilerStrap\Views\Components\Icon_Name_Description_V1';
			// the args we're "injecting" into the class
			$gv->args = $this->get_view_args();
			// IF we want to use the view's default args (optional)
			//  $gv->args->use = 'defaults';
			// once we init the class what method do we "request" (optional)
			// note: if method is empty of false, ex_loader will return the init'ed obj of the class
			$gv->method = 'render';

			$str_ret = $this->ez_gtp_loader($gv);


			return $str_ret;
		}

		/**
		 * return obj
		 */
		protected function language() {

			$lang = new \stdClass();

			$lang->category = 'Category: ' ;
			$lang->post_tag = 'Tag: ';
			$lang->author = 'Author: ';
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

				$str_prefix = '';
				if ( is_category() ){
					$str_prefix = $this->language()->category;
				} elseif ( is_tag() ){
					$str_prefix = $this->language()->post_tag;
				} elseif ( is_author() ) {
					$str_prefix = $this->language()->author;
				}

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
			$vargs = $this->_vargs->get($str_method);

			$vargs->icon_tag = 'i';
			$vargs->icon_global_attrs = array();

			if ( is_category() || is_tag() || is_author() ){

				$str_prefix = '';
				if ( is_category() ){
					$vargs->icon_global_attrs = array(
						'class' => 'fa fa-flag fa-fw'
					);
				} elseif ( is_tag() ){
					$vargs->icon_global_attrs = array(
						'class' => 'fa fa-tags fa-fw'
					);
				} elseif ( is_author() ) {
					$vargs->icon_global_attrs = array(
						'class' => 'fa fa-user fa-fw'
					);
				}

			} elseif ( is_search() ){
				$vargs->icon_global_attrs = array(
					'class' => 'fa fa-search fa-fw'
				);

			} else {
				$vargs->icon_tag = false;

			}

			return $vargs;
		}
	}
}