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

			$gv = new \stdClass();

			$gv->active = true;
			$gv->class = '\\WPezBoilerStrap\Views\Components\Tabs_Collapse_BS3_V1';
			$gv->args = $this->get_view_args();
			//$gv->args->use = "defaults";
			$gv->method = 'render';

			$str_ret = $this->ez_loader($gv);

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
			$str_menu_social_share = wp_nav_menu($menus_args->wp_nav_menu);


			$mod = new \stdClass();

			$mod->share = $str_menu_social_share;
			$mod->cats = $str_menu_cats;
			$mod->tags = $str_menu_tags;
			return $mod;

		}

		/**
		 * return obj
		 */
		protected function partials() {

			$parts = new \stdClass();

			$part        = new \stdClass();

			$part->active = true;
			$part->slug_path = 'controllers\components';
			$part->slug  = 'search-html5';
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

			/*
			$obj_enc = new \stdClass();

			$obj_enc->active = false;            // an enclosure master switch - default is true

			$obj_enc->semantic_active = true;   // default is true
			$obj_enc->semantic_tag = 'tag_TODO';
			$obj_enc->semantic_global_attrs = array(
				'class' => 'my semantic class test'
			);

			$obj_enc->wrapper_active = true;   // default is true
			$obj_enc->wrapper_tag = 'tag_TODO';
			$obj_enc->wrapper_global_attrs = array(
				'class' => 'my wrapper class test'
			);

			*/
			$vargs = new \stdClass();

			// $vargs->enclose = $obj_enc;

			// the wrappers for the tabs and the content / panes
			$vargs->tabs_wrap_outer_tag = 'div';
			$vargs->tabs_wrap_outer_global_attrs = array(
				"class" => "row blog-controls"
			);
			$vargs->tabs_wrap_inner_tag = 'div';
			$vargs->tabs_wrap_inner_global_attrs = array(
				"class" => "col-sm-5 col-sm-offset-7"
			);

			$vargs->tabs_content_wrap_tag = 'div';
			$vargs->tabs_content_wrap_global_attrs = array(
				"id" => "my-collapse-TODO",
				"class" => "row blog-controls-open"
			);

			// the "globals" for the tabs and panes
			$vargs->tab_tag = 'div';
			// tab_global_attrs - can be set global but override at each individual row
			$vargs->tab_global_attrs = array(
				'class' => " TODO-VARGS"
			);
			$vargs->tab_link_global_attrs = array(
				"class" => "btn btn-link col-xs-3",
				"data-toggle" => "collapse",
				"aria-expanded" => "false",
				"aria-controls" => "collapseExample"
			);
			$vargs->tab_icon_tag = 'i';
			$vargs->tab_name_global_attrs = array(

			);
			
			// $vargs->pane_wrap_tag = 'div';
			$vargs->pane_wrap_global_attrs = array(
				"class" => "col-lg-12 TODO collapse"
			);
			$vargs->pane_inner_tag = 'div';
			$vargs->pane_inner_global_attrs = array(
				'class' => "well"
			);
			$vargs->pane_icon_tag = 'i';

			$vargs->pane_name_tag = 'span';
			$vargs->pane_name_global_attrs = array();

			$vargs->pane_desc_tag = 'span';
			$vargs->pane_desc_global_attrs = array();


			// the individual tabs / panes

			$arr = array();

			// SHARE
			$tab = new \stdClass();

			// tab_global_attrs - can be set global but override at each individual row
			$tab->tab_global_attrs = array(
				'class' => " TODO-OBJ"
			);
			$tab->tab_name = '&nbsp;Share';   // TODO language?
			$tab->tab_link_href = 'au-share';
			$tab->tab_icon_global_attrs = array(
				"class" => 'fa fa-share-alt fa-fw'
			);
			// these are different so you have control
			$tab->pane_icon_global_attrs = array(
				"class" => 'fa fa-share-alt fa-fw'
			);
			// on off swtich for the name
			$tab->pane_name_active = true;
			// duplicated / different so you have control
			$tab->pane_name = 'Share';
			// on off switch for the descrption
			$tab->pane_desc_active = false;
			$tab->pane_desc = " - Ex his ferri tation dolore, nam no invidunt reprimique.";
			// this pane's content come from mod() or parts()
			$tab->pane_source = 'mod'; // or parts
			// what property of mod() or parts()?
			$tab->source_property = 'share';
			$arr[] = $tab;

			// CATEGORIES
			$tab = new \stdClass();
			$tab->tab_name = 'Categories';
			$tab->tab_link_href = 'au-categories';
			$tab->tab_icon_global_attrs = array(
				"class" => 'fa fa-flag fa-fw'
			);
			$tab->pane_icon_global_attrs = array(
				"class" => 'fa fa-flag fa-fw'
			);
			$tab->pane_name_active = true;
			$tab->pane_name = 'Categories';
			$tab->pane_desc_active = false;
			$tab->pane_desc = " - Lorem ipsum dolor sit amet, dictas principes intellegebat ne ius.";
			$tab->pane_source = 'mod';
			$tab->source_property = 'cats';
			$arr[] = $tab;

			// TAGS
			$tab = new \stdClass();
			$tab->tab_name = "Tags";
			$tab->tab_link_href = 'au-tags';
			$tab->tab_icon_global_attrs = array(
				"class" => 'fa fa-tags fa-fw'
			);
			$tab->pane_icon_global_attrs = array(
				"class" => 'fa fa-tags fa-fw'
			);
			$tab->pane_name_active = true;
			$tab->pane_name = 'Tags';
			$tab->pane_desc_active = false;
			$tab->pane_desc = " - In sea meis soleat periculis. Ad mei accommodare comprehensam.";
			$tab->pane_source = 'mod';
			$tab->source_property = 'tags';
			$arr[] = $tab;

			// SEARCH
			$tab = new \stdClass();
			$tab->tab_name = "Search";
			$tab->tab_link_href = 'au-search';
			$tab->tab_icon_global_attrs = array(
				"class" => 'fa fa-search fa-fw'
			);
			$tab->pane_icon_global_attrs = array(
				"class" => 'fa fa-search fa-fw'
			);
			$tab->pane_name_active = true;
			$tab->pane_name = 'Search';
			$tab->pane_desc_active = false;
			$tab->pane_desc = " - Ut sale etiam urbanitas mel. No repudiare patrioque scripserit mea.";
			$tab->pane_source = 'parts';
			$tab->source_property = 'search';
			$arr[] = $tab;

			$vargs->tabs = $arr;

			return $vargs;
		}



	}
}