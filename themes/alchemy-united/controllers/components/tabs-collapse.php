<?php

namespace WPezTheme;

if ( ! class_exists('Tabs_Collapse')) {
	class Tabs_Collapse extends \WPezBoilerStrap\Toolbox\Parents\Controller
	{
		protected $_wpezconfig;

		public function __construct() {

			// $this->_wpezconfig = WPezConfig::ez_new();
		}

		/**
		 * return string
		 */
		public function get_view(){

			$str_ret = '';

			$obj_gv = new \stdClass();

			$obj_gv->active = true;
			$obj_gv->class = '\\WPezBoilerStrap\Views\Components\Tabs_Collapse_BS3_V1';
			$obj_gv->args = $this->get_view_args();
			$obj_gv->method = 'render';

			$str_ret = $this->ez_loader($obj_gv);

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
		 * return obj
		 */
		protected function model() {

			$menus = new \WPezTheme\Scaffolding\Menus();

			// cats
			$menus_args = $menus->get('menu_categories');
			$str_menu_cats = wp_nav_menu($menus_args->wp_nav_menu);

			// tags
			$menus_args = $menus->get('menu_tags');
			$str_menu_tags = wp_nav_menu($menus_args->wp_nav_menu);

			// social share
			$menus_args = $menus->get('menu_social_share');
			$wp_nav_menu_social_share = wp_nav_menu($menus_args->wp_nav_menu);


			$mod = new \stdClass();
			$mod->cat = 'MOD CAT';

			return $mod;


		}

		/**
		 * return obj
		 */
		protected function partials() {

			$parts = new \stdClass();

			$part        = new \stdClass();

			$part->active = true;
			$part->slug  = 'controllers\components\search-html5';
			$part->name  = '';
			$part->class = '\\WPezTheme\Search_HTML5';
			$part->args  = '';
			$part->method = 'get_view';

			$str_search = $this->ez_loader($part);

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

			//$obj = new \stdClass();

			// $str_method = 'index-body';

			// $obj_vargs = $this->_wpezconfig->get('viewargs');

			// return $obj_vargs->get($str_method);

			//return $obj;
			$vargs = new \stdClass();

			$arr = array();

			$tab = new \stdClass();
			$tab->name = 'Share';
			$tab->button_href = 'au-share';
			$tab->button_icon_class = 'fa fa-share-alt fa-fw';
			$tab->source = 'parts'; // or ports
			$tab->property = 'share';  // rename this property
			$arr[] = $tab;

			$tab = new \stdClass();
			$tab->name = 'Categories';
			$tab->button_href = 'au-categories';
			$tab->button_icon_class = 'fa fa-flag fa-fw';
			$tab->source = 'mod';
			$tab->property = 'cat';
			$arr[] = $tab;

			$tab = new \stdClass();
			$tab->name = "Tags";
			$tab->button_href = 'au-tags';
			$tab->vws = 'tags';
			$tab->button_icon_class = 'fa fa-tags fa-fw';
			$arr[] = $tab;

			$tab = new \stdClass();
			$tab->name = "Search";
			$tab->button_href = 'au-search';
			$tab->button_icon_class = 'fa fa-search fa-fw';
			$tab->source = 'parts';
			$tab->property = 'search';
			$arr[] = $tab;

			$vargs->tabs = $arr;

			return $vargs;
		}



	}
}