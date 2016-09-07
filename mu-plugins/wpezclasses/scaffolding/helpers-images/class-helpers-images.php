<?php
/**
 * A handful of WP image related bits get The ezWay treatment.
 *
 * TODO - Long Desc
 *
 * PHP version 5.3
 *
 * LICENSE: TODO
 *
 * @package WPezClasses
 * @author Mark Simchock <mark.simchock@alchemyunited.com>
 * @since 0.5.1
 * @license TODO
 */

/**
 * == Change Log ==
 *
 * --- 0.5.0 - TODO
 *
/**
 * == TODO ==
 *
 *
 */

namespace WPezClasses\Scaffolding;


// No WP? Die! Now!!
if (!defined('ABSPATH')) {
    header( 'HTTP/1.0 403 Forbidden' );
    die();
}

if ( ! class_exists('Helpers_Images') ) {
    class Helpers_Images{

        protected $_obj_args;
        protected $_bool_isnc_new;
        protected $_arr_isnc;

        public function __construct( $obj_orig = ''){

            $this->_bool_isnc_new = false;
            $this->_arr_isnc = array();

            $obj_args = \WPezCore::ez_object_merge(array($this->settings(), $obj_orig));

            if ( $obj_args->remove_width_height === true ){

                add_filter( 'post_thumbnail_html', array($this, 'filter_remove_width_height_attributes'), absint($obj_args->remove_width_height_priority) );
                add_filter( 'image_send_to_editor', array($this, 'filter_remove_width_height_attributes'), absint($obj_args->remove_width_height_priority) );
            }

            $this->_obj_args = $obj_args;

            add_filter( 'jpeg_quality', array($this, 'filter_jpeg_quality')  );

            add_filter('image_size_names_choose', array($this, 'filter_image_size_names_choose_remove'), absint($obj_args->isnc_remove_priority), 1 );

            add_filter('image_size_names_choose', array($this, 'filter_image_size_names_choose_add'), absint($obj_args->isnc_add_priority), 1 );

        }

        /**
         * @return stdClass
         */
        protected function basics(){

            $obj = new \stdClass();

            $obj->url = plugin_dir_url( __FILE__ );
            $obj->path = plugin_dir_path( __FILE__ );
            $obj->path_parent = dirname( $this->_path );
            $obj->basename = plugin_basename( __FILE__ );
            $obj->file = __FILE__;

            return $obj;
        }

        /**
         * @return stdClass
         */
        protected function ez_defaults()
        {

            $obj = new \stdClass();

            $obj->env = '';            // environment
            $obj->validation = false;        // currently NA but let's leave it for now
            $obj->debug = false;

            return $obj;
        }


        protected function settings(){

            $obj = new \stdClass();

            $obj->version = '0.5.0';

            $obj->remove_width_height = false;
            $obj->remove_width_height_priority = 10;

            $obj->jpeg_quality = 90;

            $obj->isnc_remove_priority = 10;
            $obj->isnc_add_priority = 20;
            $obj->isnc_remove = $this->isnc_defaults();

            return $obj;

        }

        /**
         * current standard default image sizes
         */
        public function isnc_defaults(){

            return array(
                'full'		=> true,
                'thumbnail' => true,
                'medium'	=> true,
                'large'		=> true
            );
        }


        /**
         *
         */
        public function filter_remove_width_height_attributes( $str_html = '' ) {

            if ( $this->_bool_remove_width_height === true ){
                $str_html = preg_replace( '/(width|height)="\d*"\s/', "", $str_html );
            }
            return $str_html;
        }

        /*
         * callback for the filter: jpeg_quality
         */
        public function filter_jpeg_quality($int_jq = ''){

            return absint($this->_obj_args->jpeg_quality);
        }


        public function set_isnc_new($arr_args = array()){

            if ( is_array($arr_args) && ! empty($arr_args) ){
                $this->_arr_isnc = $arr_args;
                $this->_bool_isnc_new = true;
            }
        }

        public function set_isnc_append($arr_args = array()){

            if ( is_array($arr_args) && ! empty($arr_args) ){
                $this->_arr_isnc = $arr_args;
                $this->_bool_isnc_new = false;
            }
         //   var_dump($this->_arr_isnc);
        }


        public function filter_image_size_names_choose_remove($arr_sizes = array()){

            if ( $this->_bool_isnc_new === false ){
                return $arr_sizes;
            }

            if ( is_array($this->_obj_args->isnc_remove) && ! empty($this->_obj_args->isnc_remove) ){

                foreach ($this->_obj_args->isnc_remove as $str_name => $bool_active){
                    if ( $bool_active === true ) {
                        unset($arr_sizes[$str_name]);
                    }
                }
            }
            return $arr_sizes;
        }


        /**
         * filter the select list for image_size_names_choose
         */
        public function filter_image_size_names_choose_add($arr_sizes = array()){

            if ( empty($this->_arr_isnc) ){
                return $arr_sizes;
            }

            $arr_add_sizes = array();
            foreach ( $this->_arr_isnc as $key_name => $obj ){
                if ( $obj->names_choose->active === true ){
                    $arr_add_sizes[$obj->name] =  $obj->names_choose->select;
                }
            }
            $arr_newsizes = array_merge($arr_sizes, $arr_add_sizes);

            return $arr_newsizes;
        }


    } // END: class
} // END: if class exists