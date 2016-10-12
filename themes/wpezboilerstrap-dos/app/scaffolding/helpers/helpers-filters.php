<?php

/**
 * if you want to break this down further, you might consider using the other/ folder for those pieces
 */


namespace WPezTheme\Scaffolding;

if ( ! class_exists('Helpers_Filters') ) {
	class Helpers_Filters{

		public function __construct(){

		}

		public function args()
		{

			$arr = array();

			/**
			 *
			 */
			$obj = new \stdClass();

			$obj->active = true;
			$obj->filter = 'show_admin_bar';
			$obj->value = true;

			$arr['show_admin_bar'] = $obj;

			return $arr;
		}
  }
}
