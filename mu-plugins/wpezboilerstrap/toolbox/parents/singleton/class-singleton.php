<?php

namespace WPezBoilerStrap\Toolbox\Parents;

/*
 * More info: http://scotty-t.com/2012/07/09/wp-you-oop/
 */

// No WP? Die! Now!!
if ( ! defined('ABSPATH') ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die();
}

if ( ! class_exists('Singleton') ){
	abstract class Singleton {

		// this is where we store the instances
		private static $arr_instances = array();

		protected function __construct() {}

		public static function ez_new($mix_args = NULL) {

			$str_gcc = get_called_class();
			$str_gcbi = get_current_blog_id();
			$str_key = $str_gcc . '-' . $str_gcbi;

			if ( ! isset( self::$arr_instances[$str_key] ) ) {

				self::$arr_instances[$str_key] = new $str_gcc();
				// note: the mix_args passed in are passed again
				self::$arr_instances[$str_key]->ez__construct($mix_args);
			}
			return self::$arr_instances[$str_key];
		}

		/*
		 * Note: Only called the first time the class/object is instantiated. (Duh?)
		 */
		abstract public function ez__construct();
		
	}
}