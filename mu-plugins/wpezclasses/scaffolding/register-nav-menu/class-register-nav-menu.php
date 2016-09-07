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

namespace WPezClasses\Scaffolding;

// No WP? Die! Now!!
if ( !defined( 'ABSPATH' ) ) {
    header( 'HTTP/1.0 403 Forbidden' );
    die();
}

if ( !class_exists( 'Register_Nav_Menu' ) ) {
    class Register_Nav_Menu
    {

        public function __construct()
        {

        }

        /**
         * @return stdClass
         */
        protected function basics()
        {
            $obj = new \stdClass();

            $obj->url = plugin_dir_url( __FILE__ );
            $obj->path = plugin_dir_path( __FILE__ );
            $obj->path_parent = dirname( $this->_path );
            $obj->basename = plugin_basename( __FILE__ );
            $obj->file = __FILE__;

            return $obj;
        }


        public function loader( $arr_args = '' )
        {
           // $str_return_source = get_class() . ' > ' . __METHOD__;

            if ( is_array( $arr_args ) && !empty($arr_args) ) {

                foreach ( $arr_args as $str_key => $obj ) {

                    if ( $obj->active === true ) {

                        if ( isset($obj->theme_location) && is_string( $obj->theme_location ) && isset($obj->description) && is_string( $obj->description ) ) {

                            register_nav_menu( $obj->theme_location, $obj->description );
                        }
                    }
                }

                //return array('status' => true, 'msg' => 'success', 'source' => $str_return_source, 'arr_args' => $arr_args);
                return true;
            }
            else {
                //return array('status' => false, 'msg' => 'ERROR: arr_args was not valid', 'source' => $str_return_source, 'arr_args' => 'error');
                return false;
            }
        }


    } // END: class
} // END: if class exists