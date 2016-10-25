<?php
/**
 * Methods related to defining and registering menus
 *
 * (@link http://)
 *
 * PHP version 5.3
 *
 * LICENSE: TODO
 *
 * @package WP ezBoilerStrap
 * @author  Mark Simchock <mark.simchock@alchemyunited.com>
 * @since   0.5.0
 * @license TODO
 */

/*
* == Change Log == 
*
* --- 28 August 2014 - Ready
*
*/

namespace WPez\WPezClasses\Scaffolding;

// No WP? Die! Now!!
if ( ! defined( 'ABSPATH' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die();
}

if ( ! class_exists( 'Register_Nav_Menu' ) ) {
	class Register_Nav_Menu {

		public function __construct() {
		}

		/**
		 * @return stdClass
		 */
		protected function file_constants() {
			$obj = new \stdClass();

			$obj->url         = plugin_dir_url( __FILE__ );
			$obj->path        = plugin_dir_path( __FILE__ );
			$obj->path_parent = dirname( $this->_path );
			$obj->basename    = plugin_basename( __FILE__ );
			$obj->file        = __FILE__;

			return $obj;
		}

		/**
		 * In case you want to build your own loader.
		 *
		 * @param $obj_ez
		 */
		public function wp_register_nav_menu( $obj_ez ) {

			register_nav_menu( $obj_ez->register_nav_menu->location, $obj_ez->register_nav_menu->description );

		}


		public function ez_loader( $arr_args = '' ) {

			if ( is_array( $arr_args ) && ! empty( $arr_args ) ) {
				foreach ( $arr_args as $str_key => $obj ) {
					if ( $obj->active === true ) {
						if ( isset( $obj->register_nav_menu->location ) && is_string( $obj->register_nav_menu->location ) && isset( $obj->register_nav_menu->description ) && is_string( $obj->register_nav_menu->description ) ) {
							register_nav_menu( $obj->register_nav_menu->location, $obj->register_nav_menu->description );
						}
					}
				}
				return true;
			} else {
				return false;
			}
		}


	} // END: class
} // END: if class exists