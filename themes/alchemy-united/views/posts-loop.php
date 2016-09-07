<?php

namespace WPezTheme\Views;

class Posts_Loop extends \WPezBoilerStrap\Library\Parents\View {

	function view( $lang, $mod, $vargs, $vws ) {

		$str_ret = '';

		$str_ret .= '<div>';

		$str_ret .= ' - TODO posts loop - ';

		$str_temp = '';
		foreach ($mod->posts as $key => $obj){
			if ( ! isset($mod->details[$obj->ID]) ){
				continue;
			}
			$obj_det = $mod->details[$obj->ID];
			$str_temp .= '<br><a href="' .  $obj_det->url .'">' . $obj->post_title . '</a><br>';
		}

		$str_ret .= $str_temp;
		
		$str_ret .= $vws->posts_pagination;

		$str_ret .= '</div>';

		return $str_ret;

	}
}