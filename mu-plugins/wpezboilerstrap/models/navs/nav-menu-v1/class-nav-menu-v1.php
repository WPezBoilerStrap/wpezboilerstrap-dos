<?php

namespace WPezBoilerStrap\Models\Navs;

if ( ! class_exists('Nav_Menu_V1') ) {
	class Nav_Menu_V1 {

		public function __construct() {

		}

		public function nav_menu_location_items($str_menu_name = '') {

			$arr_nml = get_nav_menu_locations();

			if ( isset($arr_nml[$str_menu_name]) ){

				$int_menu_id = $arr_nml[$str_menu_name];

				$arr_menu_items = wp_get_nav_menu_items($int_menu_id);

				return $arr_menu_items;
			}

			return array(); // RETURN false?
		}

		public function nav_menu_location_links_raw($arr_objs = ''){

			if ( ! is_array($arr_objs) ){

				$arr_new = array();
				foreach ( $arr_objs as $key => $obj ) {
					$obj->url    = get_term_link( $obj, $str_tax );
					$obj->anchor = $obj->name;
					$obj->title  = $obj->name;
					if ( ! empty( $obj->description ) ) {
						$obj->title = $obj->name . ' - ' . $obj->description;
					}
				}


			}
		}



	}
}