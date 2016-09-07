<?php
/*
Plugin Name: WPezClasses Autoload
Plugin URI: https://github.com/WPezPlugins/wpezclasses-autoload
Description: "Wrapper" plugin to autoload the WPezClasses framework. WPezClasses (https://github.com/wpezclasses/) is growing collection of classes architected and engineered to fulfill the needs of WordPress theme and plugin developers.
Version: 0.5.2.0
Author: Mark Simchock for Alchemy United (http://AlchemyUnited.com)
Author URI: http://AlchemyUnited.com?source="plugin_WPezClasses_Autoload"
License: MIT
*/

/**
 * TODO
 *
 * TODO (@link http://)
 *
 * PHP version 5.3
 *
 * LICENSE: TODO
 *
 * @package WPezClasses
 * @author  Mark Simchock <mark.simchock@alchemyunited.com>
 * @since   0.5.0
 * @license TODO
 */

/**
 * = CHANGE LOG =
 *
 * == 2 Aug 2016 ==
 *  - changed: allow autoloader to be used for multiple parent folders (e.g., wpezclasses, wpezboilerstrap, etc.)
 *
 * == 2 Aug 2016 ==
 *  - forked: wpezclasses autoload
 */

namespace WPezPlugins;

if ( !defined( 'ABSPATH' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die();
}

if ( ! class_exists( 'WPezAutoload' ) ) {
	class WPezAutoload
	{

		private $_arr_dirs;
		private $_version;
		private $_url;
		private $_path;
		private $_path_parent;
		private $_basename;
		private $_file;


		public function __construct( $arr_args = array())
		{

			$this->_arr_dirs = $this->wpez();
			if ( is_array($arr_args) ){
				$this->_arr_dirs = array_merge($this->wpez(), $arr_args );
			}

			$this->setup();

			//	add_action('activated_plugin', array(&$this, 'load_this_wp_plugin_first'));

			spl_autoload_register( NULL, false );

			spl_autoload_extensions( '.php' );

			spl_autoload_register( array($this, 'wpezautoload') );

			if ( class_exists( 'WPezClasses\WPezCore\Static_Helpers' ) && ! class_exists( 'WPezCore' ) ) {
				class_alias( 'WPezClasses\WPezCore\Static_Helpers', 'WPezCore' );
			}
		}

		protected function wpez(){

			$arr = array('WPezClasses' , 'WPezBoilerStrap');
			return $arr;
		}

		/**
		 *
		 */
		protected function setup()
		{

			$this->_version = '0.5.0';
			$this->_url = plugin_dir_url( __FILE__ );
			$this->_path = plugin_dir_path( __FILE__ );
			$this->_path_parent = dirname( $this->_path );
			$this->_basename = plugin_basename( __FILE__ );
			$this->_file = __FILE__;
		}


		/**
		 * (@link http://www.phpro.org/tutorials/SPL-Autoload.html)
		 *
		 * The classes naming convention allows us to parse the folder struture out of the class / file name. And then use that to define the $file for the require_once()
		 */
		private function wpezautoload( $str_class )
		{

			//$o = $str_class;
		//	echo '<br><br>------------------------------------<br>' . $str_class;

			$bool_flag = false;
			foreach ( $this->_arr_dirs as $str_dir ){
				if ( strrpos( $str_class, $str_dir, -strlen( $str_class ) ) !== false ){
					$bool_flag = true;
					break;
				}
			}

			if ( $bool_flag ){
				$str_class = trim( str_replace( '_', '-', strtolower( $str_class ) ) );
				$arr_class = explode( '\\', $str_class );

				if ( isset($arr_class[0]) && isset($arr_class[1]) && isset($arr_class[2]) ) {

					$str_filename = 'class-' . $arr_class[sizeof($arr_class) - 1 ] . '.php';
					$str_file = rtrim( $this->_path_parent, DIRECTORY_SEPARATOR ) . DIRECTORY_SEPARATOR . trim(implode( DIRECTORY_SEPARATOR ,$arr_class)). DIRECTORY_SEPARATOR . $str_filename;

					if ( ! file_exists( $str_file ) ) {

						// TODO: log?
						return false;
					}
					require($str_file);

/*
				 	echo '<br> -- ' .  $str_file . ' -- require = success --<br>';
					if ( class_exists($o)) {
						echo ' TRUE >> ' . $o;
					} else{
						echo ' FALSE >> ' . $o;
					}
*/


				}
			}
		}

		public function get_version()
		{
			return $this->_version;
		}
	}
}

