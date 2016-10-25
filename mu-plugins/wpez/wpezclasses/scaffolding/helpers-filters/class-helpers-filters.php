<?php


namespace WPezClasses\Scaffolding;


// No WP? Die! Now!!
if ( !defined( 'ABSPATH' ) ) {
header( 'HTTP/1.0 403 Forbidden' );
die();
}

if ( !class_exists( 'Helpers_Filters' ) ) {
    class Helpers_Filters
    {

        protected $_show_admin_bar;

        public function __construct()
        {
            $this->_show_admin_bar;
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
            foreach ($arr_args as $str_key => $obj ){
                if ( $obj->active == true){
                    // prefix the filter name with a _ to make it a var name
                    $temp = '_' . $obj->filter;
                    $this->$temp = $obj->value;
                    $str_method = 'filter_' . strtolower(trim($obj->filter));
                    add_filter($obj->filter, array($this, $str_method));
                }
            }
        }

        /**
         * @return bool
         */
        public function filter_show_admin_bar(){

            if ( $this->_show_admin_bar === false ){
                return false;
            } else {
                return true;
            }
        }
    }
}