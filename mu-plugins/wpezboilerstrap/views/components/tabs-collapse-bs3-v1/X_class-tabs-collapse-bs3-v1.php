<?php

namespace WPezBoilerStrap\Views\Components;

class Accordion_BS3_V2 extends \WPezBoilerStrap\Library\Parents\View {

	function view( $lang, $mod, $vargs, $vws ) {

		$str_ret = '';

		$str_ret .= 'Tabs BS3 1 - TODO<br>';

		/*
		 * wrapper_class
		 * ??
		 * row_class
		 */

		$str_ret .= '<div class="blog-controls clearfix TODO ">';
		$str_ret .= '<div class="col-sm-5 col-sm-offset-7 TODO">';
		$str_ret .= '<div class="row TODO">';

		/*
		 * button_wrap_class
		 * button_class
		 * button_href *  = content_id (below)
		 * button_icon_class * ?? ELSE button_anchor
		 *
		 */

		$str_temp_a = '';
		$str_temp_b = '';
		foreach ( $mod->tabs as $key => $obj ){

			$str_temp_a .= '<div class="col-xs-3 TODO">';
			$str_temp_a .= '<a class="btn btn-link" data-toggle="collapse" href="#' . sanitize_html_class($obj->button_href) . '" aria-expanded="false" aria-controls="collapseExample">';
			$str_temp_a .= '<i class="' . esc_attr($obj->button_icon_class) . '"></i>';
			$str_temp_a .= '</a>';
			$str_temp_a .= '</div>';

			$str_temp_b .=  '<div class="collapse col-lg-12 TODO" id="' . sanitize_html_class($obj->button_href) . '">';
			$str_temp_b .= '<div class="well">';
			$str_temp_b .= '<i class="' . esc_attr($obj->button_icon_class) . '"></i>';
			$str_temp_b .=  '<b>' . $obj->name . '</b>';
			$str_temp_b .= '<span>';
			$prop = $obj->vws;
			$str_temp_b .=  $vws->$prop;
			$str_temp_b .= '</span>';
			$str_temp_b .= '</div>';
			$str_temp_b .= '</div>';

		}
/*
		$str_ret .= '<div class="collapse col-lg-12" id="au-share">';
		$str_ret .= '<div class="well">';
		$str_ret .= '<i class="fa fa-share-alt fa-fw"></i> <b>SHARE</b> <span style="font-size:20px"><i class="fa fa-twitter-square"></i>';
		$str_ret .= '</div>';
		$str_ret .= '</div>';
*/

		$str_ret .= $str_temp_a;
/*
		$str_ret .= '<div class="col-xs-3">';
		$str_ret .= '<a class="btn btn-link" data-toggle="collapse" href="#au-share" aria-expanded="false" aria-controls="collapseExample">';
		$str_ret .= '<i class="fa fa-share-alt fa-fw"></i>';
		$str_ret .= '</a>';
		$str_ret .= '</div>';

		$str_ret .= '<div class="col-xs-3">';
		$str_ret .= '<a class="btn btn-link" data-toggle="collapse" href="#au-categories" aria-expanded="false" aria-controls="collapseExample">';
		$str_ret .= '<i class="fa fa-flag fa-fw"></i>';
		$str_ret .= '</a>';
		$str_ret .= '</div>';

		//	$m->wp_nav_menu_cats

		$str_ret .= '<div class="col-xs-3">';
		$str_ret .= '<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#au-tags" aria-expanded="false" aria-controls="collapseExample">';
		$str_ret .= '<i class="fa fa-tags fa-fw"></i>';
		$str_ret .= '</button>';
		$str_ret .= '</div>';

		$str_ret .= '<div class="col-xs-3">';
		$str_ret .= '<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#au-search" aria-expanded="false" aria-controls="collapseExample">';
		$str_ret .= '<i class="fa fa-search fa-fw"></i>';
		$str_ret .= '</button>';
		$str_ret .= '</div>';
*/
		$str_ret .= '</div>';
		$str_ret .= '</div>';
		$str_ret .= '</div>';


/*
 * wrapper
 */
		$str_ret .= '<div id="my-collapse-TODO" class="row blog-controls-open">';

		$str_ret .= $str_temp_b;

		/*
		 * content_wrap_id
		 * content_wrap_class
		 *
		 * content_id
		 * tab_content_class
		 * tab_well_class
		 * tab_content
		 * tab_view
		 */
		/*
		$str_ret .= '<div class="collapse col-lg-12" id="au-share">';
		$str_ret .= '<div class="well">';
		$str_ret .= '<i class="fa fa-share-alt fa-fw"></i> <b>SHARE</b> <span style="font-size:20px"><i class="fa fa-twitter-square"></i>';
		$str_ret .= '</div>';
		$str_ret .= '</div>';

		$str_ret .= '<div class="collapse col-lg-12" id="au-categories">';
		$str_ret .= '<div class="well">';
		$str_ret .= '<i class="fa fa-flag fa-fw"></i> <b>Categories &bull;</b>';
		$str_ret .= '<span>';
		$str_ret .= $mod->wp_nav_menu_cats;
		$str_ret .= '</span>';
		$str_ret .= '</div>';
		$str_ret .= '</div>';

		$str_ret .= '<div class="collapse col-lg-12" id="au-tags">';
		$str_ret .= '<div class="well">';
		$str_ret .= '<i class="fa fa-tags fa-fw"></i> <b>TOP TAGS</b><br> ';
		$str_ret .= '<span>';
		$str_ret .= $mod->wp_nav_menu_tags;
		$str_ret .= '</span>';

		$str_ret .= '</div>';
		$str_ret .= '</div>';

		$str_ret .= '<div class="collapse col-lg-12" id="au-search">';
		$str_ret .= '<div class="well">';
		$str_ret .= '<i class="fa fa-search fa-fw"></i> <input type="text" placeholder="Search">';
		$str_ret .= '</div>';
		$str_ret .= '</div>';
		$str_ret .= '<div class="col-lg-12" id="close-all" style="display:none; text-align:center; margin-bottom:10px">';
		$str_ret .= '<a class="collapse-close-all" href="#"><i class="fa fa-times-circle fa-fw"></i></a>';

		$str_ret .= '</div>';
		$str_ret .= '</div>';
*/
		return $str_ret;

	}

}