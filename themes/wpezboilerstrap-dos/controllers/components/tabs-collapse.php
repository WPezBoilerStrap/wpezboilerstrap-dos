<?php

namespace WPezTheme;

if ( ! class_exists('Tabs_Collapse')) {
	class Tabs_Collapse extends \WPez\WPezBoilerStrap\Toolbox\Parents\Controller
	{

		/**
		 * return string
		 */
		public function get_view(){

			$str_ret = '';

			$gv = new \stdClass();

			$gv->active = true;
			$gv->class = '\\WPez\WPezBoilerStrap\Views\Components\Tabs_Collapse_BS3_V1';
			$gv->args = $this->get_view_args();
			//$gv->args->use = "defaults";
			$gv->method = 'render';

			$str_ret = $this->ez_gtp_loader($gv);

			return $str_ret;
		}

		/**
		 * return obj
		 */
		protected function language() {

			$lang= new \stdClass();

			return $lang;
		}

		/**
		 * return obj
		 */
		protected function macros() {

			$mac = new \stdClass();

			return $mac;
		}

		/**
		 * return obj
		 */
		protected function model() {

			$menus = new \WPezTheme\Scaffolding\Menus_Args();
			// social share
			$menus_args = $menus->get('menu_social_share');
			$str_menu_social_share = wp_nav_menu($menus_args->wp_nav_menu);


			$mod = new \stdClass();

			$mod->share = $str_menu_social_share;;
			return $mod;

		}

		/**
		 * return obj
		 */
		protected function partials() {


			$part        = new \stdClass();

			$part->active = true;
			$part->slug_path = 'controllers\components';
			$part->slug  = 'tabs-menu-categories';
			$part->name  = '';
			$part->class = '\\WPezTheme\Tabs_Menu_Categories';
			$part->args  = $this->_gargs;
			$part->method = 'get_view';

			$str_cats = $this->ez_gtp_loader($part);

			$part        = new \stdClass();

			$part->active = true;
			$part->slug_path = 'controllers\components';
			$part->slug  = 'tabs-menu-tags';
			$part->name  = '';
			$part->class = '\\WPezTheme\Tabs_Menu_Tags';
			$part->args  = $this->_gargs;
			$part->method = 'get_view';

			$str_tags = $this->ez_gtp_loader($part);


			$part        = new \stdClass();

			$part->active = true;
			$part->slug_path = 'controllers\components';
			$part->slug  = 'search-html5';
			$part->name  = '';
			$part->class = '\\WPezTheme\Search_HTML5';
			$part->args  = $this->_gargs;
			$part->method = 'get_view';

			$str_search = $this->ez_gtp_loader($part);

			$parts = new \stdClass();

			$parts->cats = $str_cats;
			$parts->tags = $str_tags;
			$parts->search = $str_search;

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

			$str_method = 'tabs_collapse';

			$obj_vargs = $this->_vargs->get($str_method);

			return $obj_vargs;
		}



	}
}