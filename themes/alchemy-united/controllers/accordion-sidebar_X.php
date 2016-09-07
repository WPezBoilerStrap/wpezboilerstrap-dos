<?php

namespace WPezTheme\Controllers;

class Accordion_Sidebar extends \WPezBoilerStrap\Library\Parents\Controller{


	function mod(){

		global $post;

		$m = new \stdClass();

		$arr = array();

		$b = new \stdClass();
		$b->name = 'Share';
		$b->button_href = 'au-share';
		$b->button_icon_class = 'fa fa-share-alt fa-fw';
		$b->source = 'mod'; // or ports
		$b->vws = 'share';  // rename this property
		$arr[] = $b;

		$b = new \stdClass();
		$b->name = 'Categories';
		$b->button_href = 'au-categories';
		$b->button_icon_class = 'fa fa-flag fa-fw';
		$b->vws = 'cats';
		$arr[] = $b;

		$b = new \stdClass();
		$b->name = "Tags";
		$b->button_href = 'au-tags';
		$b->vws = 'tags';
		$b->button_icon_class = 'fa fa-tags fa-fw';
		$arr[] = $b;

		$b = new \stdClass();
		$b->name = "Search";
		$b->button_href = 'au-search';
		$b->vws = 'search';
		$b->button_icon_class = 'fa fa-search fa-fw';
		$arr[] = $b;

		$m->tabs = $arr;

		return $m;

	}


	function vws(){

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

		// search
		$vc         = new \stdClass();
		$vc->c_slug = 'controllers\search-html5';
		//$x->c_name = '';
		$vc->c_class = '\\WPezTheme\Controllers\Search_HTML5';

		//$vc->v_slug = 'views\wrapper-single';
		//$x->v_name = '';
		$vc->v_class  = '\\WPezBoilerStrap\Views\Components\Search_HTML5_V1';
		$vc->v_meth_lang = 'search_html5';
		$vc->v_meth_vargs = 'search_html5';

		$obj_search = \WPezCore::ez_lvc( $vc, $this->_all );

		// prepare the vies
		$v = new \stdClass();

		$v->share = $wp_nav_menu_social_share;
		$v->cats = $str_menu_cats;
		$v->tags = $str_menu_tags;
		$v->search = $obj_search->get();

		return $v;
	}

}