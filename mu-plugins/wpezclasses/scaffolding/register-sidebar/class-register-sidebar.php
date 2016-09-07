<?php
/**
 * Methods related to defining and registering sidebars
 *
 * (@link http://codex.wordpress.org/Conditional_Tags)
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

/*
* == Change Log == 
*
* -- 24 April 2016 - Ready
*
*/

namespace WPezClasses\Scaffolding;

// No WP? Die! Now!!
if ( !defined( 'ABSPATH' ) ) {
    header( 'HTTP/1.0 403 Forbidden' );
    die();
}

if ( !class_exists( 'Register_Sidebar' ) ) {
    class Register_Sidebar
    {

        function __construct()
        {
        }


        /**
         * @return stdClass
         */
        protected function ez_defaults()
        {
            $obj = new \stdClass();

            $obj->filters = false;        // allow filter
            $obj->env = '';                // environment
            $obj->validation = false;     // currently NA but let's leave it for now
            $obj->debug = false;
            $obj->log = false;

            return $obj;
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
        public function defaults()
        {
            $obj = new \stdClass();

            $obj->active = true;
            $obj->description = '';
            $obj->before_widget = '<li id="%1$s" class="widget %2$s">';
            $obj->after_widget = '</li>';
            $obj->before_title = '<h2 class="widgettitle">';
            $obj->after_title = '</h2>';

            /*
             * Allow filters?

            if ( $this->_arr_init['filters'] ) {
                $arr_defaults_via_filter = apply_filters( 'filter_ezc_theme_register_sidebar_1_base_defaults', $arr_defaults );
                $arr_defaults = WPezHelpers::_ez_array_merge( array($arr_defaults, $arr_defaults_via_filter) );
            }
            */

            return $obj;
        }


        /**
         * Combines the base and the values and makes the register_sidebar() magic happen
         */
        public function loader( $arr_args = '' )
        {
            // $str_return_source = get_class() . ' ' . __METHOD__;

            if ( isset($arr_args) && is_array( $arr_args ) && !empty($arr_args) ) {

                foreach ( $arr_args as $str_key => $obj ) {

                    if ( is_object( $obj ) ) {

                        // how should be arr_merge the obj and the defaults
                        if ( is_object( $obj->defaults ) ) {
                            $obj = (object)array_merge( (array)$this->defaults(), (array)$obj->defaults, (array)$obj );
                        }
                        else {
                            $obj = (object)array_merge( (array)$this->defaults(), (array)$obj );
                        }

                        if ( $obj->active === true ) {

                            $str_before_widget = $obj->before_widget;
                            $str_after_widget = $obj->after_widget;
                            $arr_before = array();
                            // if there's a before_widget_tag then we'll override the standard before_widget / after_widget
                            if ( is_string( $obj->before_widget_tag ) ) {
                                // TODO escape
                                $arr_before[] = $obj->before_widget_tag;
                                if ( is_string( $obj->before_widget_id ) ) {
                                    // TODO escape
                                    $arr_before[] = 'id="' . $obj->before_widget_id . '"';
                                }

                                if ( is_string( $obj->before_widget_class ) ) {
                                    // TODO escape
                                    $arr_before[] = 'class="' . $obj->before_widget_class . '"';
                                }

                                $str_before_widget = '<' . implode( ' ', $arr_before ) . '>';
                                // TODO escape
                                $str_after_widget = '</' . $obj->before_widget_tag . '>';
                            }

                            // TODO - validation
                            register_sidebar( array(
                                                  'name' => $obj->name,
                                                  'description' => $obj->description,
                                                  'id' => $obj->id_unique_sidebar,
                                                  'before_widget' => $str_before_widget,
                                                  'after_widget' => $str_after_widget,
                                                  'before_title' => $obj->before_title,
                                                  'after_title' => $obj->after_title
                                              ) );
                        }
                    }
                }
            }
        }


    } // END: class
} // END: if class exists