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
 * == 25 Spril 2016
 *  - CHANGED: Updated to reflected WPezClasses use of namespace'ing
 *
 * == 29 November 2014 ==
 *  - changed: updates due to changes in Class_wpezclasses_Master_Singleton
 *
 * == 18 March 2014 ==
 *  - removed: Commented out: add_action('activated_plugin', array(&$this, 'load_this_wp_plugin_first'));
 *
 * == 10 Jan 2014 ==
 *  - added: extends wpezclasses_Master_Singleton
 *  - added: class_alias('wpezclasses_Methods_Static', 'WP_ezMethods')
 */

namespace WPezPlugins;

if ( !defined( 'ABSPATH' ) ) {
    header( 'HTTP/1.0 403 Forbidden' );
    die();
}

if ( !class_exists( 'WPezClasses_Autoload' ) ) {
    class WPezClasses_Autoload
    {

        private $_version;
        private $_url;
        private $_path;
        private $_path_parent;
        private $_basename;
        private $_file;


        public function __construct()
        {

            $this->setup();

            //	add_action('activated_plugin', array(&$this, 'load_this_wp_plugin_first'));

            spl_autoload_register( NULL, false );

            spl_autoload_extensions( '.php' );

            spl_autoload_register( array($this, 'wpezclasses_autoload') );

            if ( class_exists( 'WPezClasses\WPezCore\Static_Helpers' ) && !class_exists( 'WPezCore' ) ) {
                class_alias( 'WPezClasses\WPezCore\Static_Helpers', 'WPezCore' );
            }
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
        private function wpezclasses_autoload( $str_class )
        {

            $str_needle_1 = 'WPezClasses';
            $str_needle_2 = 'WPezClasses';
            if ( strrpos( $str_class, $str_needle_1, -strlen( $str_class ) ) !== false || strrpos( $str_class, $str_needle_2, -strlen( $str_class ) ) !== false ) {

                $str_class = trim( str_replace( '_', '-', strtolower( $str_class ) ) );
                $arr_class = explode( '\\', $str_class );

                if ( isset($arr_class[0]) && isset($arr_class[1]) && isset($arr_class[2]) ) {

                	// how many directory levels are there?
	                $str_filename = 'class-' . trim( $arr_class[2] ) . '.php';
                	if ( isset($arr_class[3] ) ){
		                $str_filename = 'class-' . trim( $arr_class[3] ) . '.php';
		                $str_file = rtrim( $this->_path_parent, '/' ) . DIRECTORY_SEPARATOR . trim( $arr_class[0] ) . DIRECTORY_SEPARATOR . trim( $arr_class[1] ) . DIRECTORY_SEPARATOR . trim( $arr_class[2] ) . DIRECTORY_SEPARATOR . trim( $arr_class[3] ) . DIRECTORY_SEPARATOR . $str_filename;

	                } else {
		                $str_file = rtrim( $this->_path_parent, '/' ) . DIRECTORY_SEPARATOR . trim( $arr_class[0] ) . DIRECTORY_SEPARATOR . trim( $arr_class[1] ) . DIRECTORY_SEPARATOR . trim( $arr_class[2] ) . DIRECTORY_SEPARATOR . $str_filename;
	                }

                    if ( !file_exists( $str_file ) ) {
                        return false;
                    }
                    require($str_file);
                }
            }
        }

    }
}
new WPezClasses_Autoload();