<?php
/**
 * WP's add_image_size(), set_post_thumbnail_size() and a couple other image related bits get ezTized.
 *
 * TODO - Long Desc
 *
 * PHP version 5.3
 *
 * LICENSE: TODO
 *
 * @package WP ezClasses
 * @author  Mark Simchock <mark.simchock@alchemyunited.com>
 * @since   0.5.1
 * @license TODO
 */

/**
 * == Change Log ==
 *
 * = 0.5.0 - Thur 14 Apr 16
 * -- Refactor! - of Theme Add Image Size
 * -- Removed - Anything not directly related to Add Image Size
 */

/**
 * == TODO ==
 *
 * - Namespace
 */

namespace WPezClasses\Scaffolding;

// No WP? Die! Now!!
if ( !defined( 'ABSPATH' ) ) {
    header( 'HTTP/1.0 403 Forbidden' );
    die();
}

if ( !class_exists( 'Add_Image_Size' ) ) {
    class Add_Image_Size{

        protected $_resize_ratios;

        public function __construct(){

            $this->_resize_ratios = $this->resize_ratios();
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
         * @return stdClass
         */
        protected function ez_defaults()
        {

            $obj = new \stdClass();

            $obj->filters = false;       // allow filter
            $obj->env = '';            // environment
            $obj->validation = false;        // currently NA but let's leave it for now
            $obj->debug = false;

            return $obj;
        }


        /**
         * @return stdClass
         */
        public function settings()
        {

            $obj = new \stdClass();

            $obj->version = '0.5.0';
            $obj->orientation = 'land';
            $obj->offset = 0;

            return $obj;
        }

        /**
         * @return stdClass
         */
        public function ais_obj_defaults(){

            $obj = new \stdClass();

            $obj->width = false;
            $obj->height = false;
            $obj->crop = false;
            $obj->ratio = 'custom';
            $obj->orientation = 'land';
            $obj->offset = 0;

            return $obj;
        }

        /**
         * Note: All ratios are defined as landscape by default. The exception, obviously, is for square / sqr / 1x1.
         */
        public function resize_ratios(){

            // For a more complete list of rations see Standards \ Aspect Ratios

            $arr = array();

            // traditional tv
            $obj = new \stdClass();
            $obj->w = 4;
            $obj->h = 3;
            $arr['tv'] = $obj;
            $arr['4x3'] = $obj;

            // traditional photo
            $obj = new \stdClass();
            $obj->w = 3;
            $obj->h = 2;
            $arr['photo'] = $obj;
            $arr['3x2'] = $obj;

            // golden ratio
            $obj = new \stdClass();
            $obj->w = 16.18;
            $obj->h = 10;
            $arr['golden'] = $obj;
            $arr['16.18x10'] = $obj;

            // square
            $obj = new \stdClass();
            $obj->w = 1;
            $obj->h = 1;
            $arr['square'] = $obj;
            $arr['sqr'] = $obj;
            $arr['1x1'] = $obj;

            return $arr;
        }

        /*
         * set your own array of resize ratios;
         */
        public function set( $key = '', $mix_args = '' ){

            switch ( $key ) {

                case 'resize_ratios':

                    if ( is_array( $mix_args ) && ! empty($mix_args) ) {
                        $this->_resize_ratios = $mix_args;
                    }
                    break;

                default:
                    return false;
            }
            return true;
        }


        /**
         *
         */
        public function loader( $arr_args = '' ){

           //TODOx $str_return_source = get_class() . ' > ' . __METHOD__;

            // do we have an array with some "stuff" in it
            if ( \WPezCore::ez_array_pass( $arr_args ) ) {

                $arr_resize_ratios = $this->_resize_ratios;
                foreach ( $arr_args as $key_name => $obj_orig ) {

                    // lite "validation". TODO more validation
                    if ( ! isset($obj_orig->name) || empty($obj_orig->name) || $obj_orig->active === false ) {
                        continue;
                    }

                    $obj = \WPezCore::ez_object_merge( array($this->ais_obj_defaults(), $obj_orig) );

                    // no ratio? ratio blank? custom? just use the dimensions 'as is'
                    if ( ! isset($obj->ratio) || empty($obj->ratio) || $obj->ratio == 'custom' ) {

                        // TODO - validation "as is"
                        $width = $obj->width;
                        $height = $obj->height;
                    }
                    elseif ( isset($arr_resize_ratios[$obj->ratio]) ) {

                        // we know the ratio key is good, now get its 'w' and 'h'
                        $obj_ratio = $arr_resize_ratios[$obj->ratio];

                        // orientation
                        $str_orientation = $this->settings()->orientation;
                        if ( strtolower( $obj->orientation ) == 'land' || strtolower( $obj->orientation ) == 'port' ) {
                            $str_orientation = strtolower( $obj->orientation );
                        }

                        // offset
                        $float_offset = $this->settings()->offset;
                        if ( isset($obj->offset) ) {
                            $float_offset = (float)$obj->offset;
                        }

                        // width is our default / GOTO / baseline dimension. we always start with width.
                        if ( isset($obj->width) && $obj->width !== false ) {

                            $width = (float)$obj->width;
                            // apply the offset
                            $width = $width + ( $width * $float_offset );
                            // TODO - test for divide by zero and then ?
                            $height = $width * ( $obj_ratio->h / $obj_ratio->w) ;

                            if ( $str_orientation == 'port' ) {
                                // TODO - test for divide by zero and then ?
                                $height = $width * ( $obj_ratio->w / $obj_ratio->h );
                            }

                            // if no width then we'll use the height. yeah, weird use case but at least it's here if you want it
                        } elseif (  isset($arr_resize_ratios[ $obj_orig->ratio ]) && isset($obj->height) && $obj->height !== false ) {

                            $obj_ratio = $this->_resize_ratios[$obj_orig->ratio];

                            $height = (float) $obj->height;
                            $width = $height * ( $obj_ratio->w / $obj_ratio->h );

                            if ( $str_orientation == 'port' ) {
                                $width = $height * ( $obj_ratio->h / $obj_ratio->w );
                            }
                        } else {
                            // something ain't right...next!
                            continue;
                        }
                    } else {
                        continue;
                    }

                    $crop = (bool)$obj->crop;

                    // now is the moment of truth.. thumbnail or add_image_size()?
                    if ( isset($obj->featured_image) && $obj->featured_image === true ) {

                        // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
                        set_post_thumbnail_size( absint( $width ), absint( $height ), $crop );
                    }
                    else {
                        add_image_size( $obj->name, absint( $width ), absint( $height ), $crop );
                    }
                }

                return true;
                //TODO - return array('status' => true, 'msg' => 'success', 'source' => $str_return_source, 'arr_args' => $arr_args);
            }
            //
            return false;
            // TODO -return array('status' => false, 'msg' => 'ERROR: add_image_size_do() > $arr_args is not valid', 'source' => $str_return_source, 'arr_args' => 'error');
        }

    } // END: class
} // END: if class exists

//new Add_Image_Size();