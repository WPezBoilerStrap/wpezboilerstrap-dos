<?php
/**
 * WordPress add_theme_support() done The ezWay.
 *
 * Instead of manually coding line after line of add_theme_support()s , now you simply configure an array and pass that
 * to this class / methods.
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
 * == Change Log ==
 *
 * -- 13 November 2014
 *     -- Ready!
 */

/**
 * - TODO -
 *
 * -- deeper validation
 */

namespace WPezClasses\Scaffolding;

// No WP? Die! Now!!
if ( !defined( 'ABSPATH' ) ) {
    header( 'HTTP/1.0 403 Forbidden' );
    die();
}

if ( !class_exists( 'Class_WPezClasses_Scaffolding_Add_Theme_Support' ) ) {
    class Class_WPezClasses_Scaffolding_Add_Theme_Support
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

        /**
         *
         */
        public function loader( $arr_args = '' )
        {

            if ( is_array($arr_args) && ! empty($arr_args) ) {

                foreach ( $arr_args as $str_key => $obj ) {

                    if ( $obj->active === true && isset($obj->feature) ) {

                        if ( isset($obj->args_type) && $obj->args_type != 'none' ) {

                            if ( isset($obj->args_type) && $obj->args_type == 'active_bool' ) {
                                $arr_args_true = array();
                                foreach ( $obj->args as $str_arg_key => $bool_value ) {
                                    if ( $bool_value === true ) {
                                        $arr_args_true[] = $str_arg_key;
                                    }
                                }

                                /*
                                 * if we specify which post_types to support then it will only support those post_types. this
                                 * also means that custom CPTs might get mucked up
                                 */
                                if ( $obj->feature == 'post-thumbnails' && empty($arr_args_true) ) {
                                    add_theme_support( $obj->feature );
                                }
                                else {
                                    add_theme_support( $obj->feature, $arr_args_true );
                                }

                            }
                            elseif ( isset($obj->args) && is_array($obj->arg ) ) {

                                add_theme_support( $obj->feature, $obj->args );

                            }
                        }
                        else {

                            add_theme_support( $obj->feature );
                        }
                    }
                }
            }
        }

    }
}