<?php
/*
Plugin Name: WPezMU-Plugins
Plugin URI: https://github.com/WPezPlugins/WPezMUPlugins
Description: The standard mu-plugins folder is "unstructured". WP ezMU-Plugins approximates something closer to the traditional WP plugins folder structure and UI. It also enables you to control load order.
Version: 0.5.0
Author: Mark Simchock for Alchemy United (http://AlchemyUnited.com)
Author URI: http://AlchemyUnited.com
License: The MIT License (MIT) - http://opensource.org/licenses/MIT
*/

/*
 * Dependencies:
 */

namespace WPezPlugins;


// No WP? Die! Now!!
if (!defined('ABSPATH')) {
    header( 'HTTP/1.0 403 Forbidden' );
    die();
}

if( ! class_exists('Abstract_WPezMU_Plugins')){
    require_once( 'wpezmu-plugins/class-abstract-wpezmu-plugins.php' );
}

/**
 * Info: http://codex.wordpress.org/Must_Use_Plugins
 *
 * Note: Plugins will load in the order listed.
 */
if ( ! class_exists('WPezMU_Plugins')) {
    class WPezMU_Plugins extends Abstract_WPezMU_Plugins{


	    public function __construct(){

		    $this->_arr_defaults = $this->defaults();
		    $this->loader();
		    $this->actions();

	    }

        /*
         * * IMPORTANT * *
         * The path for the require_once is relative to the Class_WPez_MU_Plugins. Therefore, you'll probably have to prefix your pathes with '/../'
         * * * * * * * * *
         */
        protected function mu_plugins_list(){

            $arr_return = array(

	            'wpezautoload'				=> array(
		            'active'		=> true,
		            'require_order'	=> '1',
		            'exclude_from'	=> array(), // by blog_id
		            'name'			=> 'WPezAutoload',
		            'version'		=> '0.5.0',
		            'link'			=> NULL,
		            'require_once'	=> '/../wpezautoload/wpezautoload.php',
		            'description'	=> 'Universal mu-plugins autoloader',
		            'notes'			=> '** IMPORTANT ** This plugin must load first.',
	            ),



                'wpez-classes-autoload'				=> array(
                    'active'		=> false,
                    'require_order'	=> '2',
                    'exclude_from'	=> array(), // by blog_id
                    'name'			=> 'WPezClasses (Autoload)',
                    'version'		=> '0.5.0',
                    'link'			=> NULL,
                    'require_once'	=> '/../wpezclasses-autoload/wpezclasses-autoload.php',
                    'description'	=> 'WP ezClasses - An OOP based framework for WP developers.',
                    'notes'			=> '** IMPORTANT ** This plugin must load first.',
                )

            );

            return $arr_return;
        }

    } // close class
} // close if class_exists

new WPezMU_Plugins();

new WPezAutoload();
