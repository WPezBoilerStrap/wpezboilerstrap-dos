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

namespace WPezClasses\Scaffolding;

// No WP? Die! Now!!
if ( !defined( 'ABSPATH' ) ) {
    header( 'HTTP/1.0 403 Forbidden' );
    die();
}

if ( ! class_exists( 'Add_Image_Size' ) ) {
    class Add_Image_Size{

        protected $_ratios;
	    protected $_arr_audit;

        public function __construct(){

            $this->_ratios = $this->ratios();
	        $this->_arr_audit = array();
        }

        /**
         * @return stdClass
         */
        protected function file_constants(){

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
        protected function ez_defaults(){

            $obj = new \stdClass();

	        // allow filter
            $obj->filters = false;
	        // environment
            $obj->env = '';
	        // currently NA but let's leave it for now
            $obj->validation = false;
	        //
            $obj->debug = false;

            return $obj;
        }


        /**
         * @return stdClass
         */
        public function settings(){

            $obj = new \stdClass();

	        $obj->crop = false;
	        $obj->orientation = 'land';
            $obj->offset = 0;

            return $obj;
        }

        /**
         * @return stdClass
         */
        public function ais_defaults(){

            $obj = new \stdClass();

            $obj->width = false;
            $obj->height = false;
            $obj->crop = false;
            $obj->ratio = 'custom';
            $obj->orientation = 'land';
            $obj->offset = 0;

            return $obj;
        }


        /*
         * set your own array of resize ratios;
         */
        public function set( $key = '', $mix_args = '' ){

            switch ( $key ) {

                case 'ratios':
                    if ( is_array( $mix_args ) && ! empty($mix_args) ) {
                        $this->_ratios = $mix_args;
                    }
                    break;

                default:
                    return false;
            }
            return true;
        }


	    /**
	     * Use your ez image agrs in a more straightforward traditional wp sorta way
	     *
	     * @param $obj_ez
	     */
        public function wp_add_image_size($obj_ez = ''){
        	// REF: https://developer.wordpress.org/reference/functions/add_image_size/

	        if ( is_object($obj_ez) && is_object($obj_ez->add_image_size) && ( ! isset($obj_ez->active) || (isset($obj_ez->active) && $obj_ez->active !== false) ) ) {

		        add_image_size(
			        $obj_ez->add_image_size->name,
			        $obj_ez->add_image_size->width,
			        $obj_ez->add_image_size->height,
			        $obj_ez->add_image_size->crop
		        );
	        }
        }


	    /**
	     * Loader for an arr of ez image args, uses wp_add_image_size().
	     *
	     * @param $arr_objs
	     */
        public function wp_loader($arr_objs){

        	if ( ! is_array($arr_objs)){
        		return false;
	        }

        	foreach ($arr_objs as $key => $obj){
		        $this->wp_add_image_size($obj);
	        }
        }

	    /**
	     * add_image_size(), which also do the set_post_featured_image()
	     *
	     * @param $obj_ez
	     */
        public function ez_add_image_size($obj_ez){
        	// note: width, height and crop are not the ->add_image_size-> versions

	        if ( ! isset($obj_ez->active) || (isset($obj_ez->active) && $obj_ez->active !== false) ) {

		        // now is the moment of truth.. thumbnail or add_image_size()?
		        if ( $obj_ez->featured_image === true ) {
			        // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
			        set_post_thumbnail_size(
				        absint( $obj_ez->width ),
				        absint( $obj_ez->height ),
				        $obj_ez->crop
			        );
			        return true;
		        }
		        // note: unlike the add)image_size() method above this dot not use all the wp properties
		        add_image_size(
		        	$obj_ez->add_image_size->name,
			        absint( $obj_ez->width ),
			        absint( $obj_ez->height ),
			        $obj_ez->crop
		        );
		        return true;
	        }
	        return false;
        }


	    /**
	     * Takes a single ez image object and works some ez magic. e.g., width + ratio + orientation = calculated height.
	     *
	     * @param $obj_ez
	     *
	     * @return object
	     */
        public function ez_prep( $obj_ez){

	        // lite "validation". TODO more validation
	        if ( ! is_object($obj_ez) || ! isset($obj_ez->add_image_size->name) || empty($obj_ez->add_image_size->name) || $obj_ez->active === false ) {
		        return $obj_ez;
	        }

	        $obj = (object) array_merge( (array) $this->ais_defaults(), (array) $obj_ez);

	        // no ratio? ratio blank? custom? just use the dimensions 'as is'
	        if ( ! isset($obj->ratio) || empty($obj->ratio) || ! is_string($obj->ratio) || $obj->ratio == 'custom' ) {
		        // TODO - validation "as is"
		        $obj->width = absint($obj->add_image_size->width);
		        $obj->height = absint($obj->add_image_size->height);

	        } elseif ( isset($this->_ratios[$obj->ratio]) ) {

		        // we know the ratio key is good, now get its 'w' and 'h'
		        $obj_ratio = $this->_ratios[ $obj->ratio ];

		        // orientation - start with our setting default and over change if we're sure we have land or port
		        $str_orientation = $this->settings()->orientation;
		        if ( strtolower( $obj->orientation ) == 'land' || strtolower( $obj->orientation ) == 'port' ) {
			        $str_orientation = strtolower( $obj->orientation );
		        }
		        $obj->orientation = $str_orientation;

		        // offset
		        $float_offset = $this->settings()->offset;
		        if ( isset( $obj->offset ) ) {
			        $float_offset = (float) $obj->offset;
		        }
		        $obj->offset = $float_offset;

		        // width is our default / GOTO / baseline dimension. that is, set width and the ratio will be used to
		        // calculate the height. BUT false can be an override
		        if ( isset( $obj->add_image_size->width ) && $obj->add_image_size->width !== false && $obj->add_image_size->width > 0 ) {

			        $width = (float) $obj->add_image_size->width;
			        // apply the offset - while we're adding here, offset itself is most likely to be a negative
			        $obj->width = $width + ( $width * $float_offset );

			        if ( $str_orientation == 'land' && $obj_ratio->w != 0 ) {
				        // TODO - round off
				        $obj->height = $obj->width * ( $obj_ratio->h / $obj_ratio->w );
			        } elseif ( $obj_ratio->h != 0 ) {
				        // TODO - test for divide by zero and then ?
				        $obj->height = $obj->width * ( $obj_ratio->w / $obj_ratio->h );
			        }

			        // if no width then we'll use the height. yeah, weird use case but at least it's here if you want it
		        } elseif ( isset( $obj->add_image_size->height ) && $obj->add_image_size->height !== false ) {

			        $obj->height = (float) $obj->add_image_size->height;
			        // height does not have offset

			        if ( $str_orientation == 'land' && $obj_ratio->h != 0 ) {
				        // TODO - round off
				        $obj->width = $obj->height * ( $obj_ratio->w / $obj_ratio->h );
			        } elseif ( $obj_ratio->w != 0 ) {
				        // TODO - test for divide by zero and then ?
				        $obj->width = $obj->height * ( $obj_ratio->h / $obj_ratio->w );
			        }

		        } else{
			        $obj->active = false;
			        $obj->error = 'oops? check wp->width, wp->height and/or orgientation';
		        }

	        } else {
	        	$obj->active = false;
		        $obj->error = 'ratio not found';
	        }
	        $obj->crop = $this->settings()->crop;
	        if ( is_bool( $obj->add_image_size->crop)){
	        	$obj->crop = $obj->add_image_size->crop;
	        }
	        $this->_arr_audit[$obj->add_image_size->name] = $obj;
	        return $obj;
        }

	    /**
	     * as we're doing ez_prep() we'll push the results onto an array. this is just a get of that
	     * @return array
	     */
        public function ez_audit(){

        	return $this->_arr_audit;
        }

	    /**
	     * takes an array of ez image objects and foreach over it
	     * @param string $arr_objs
	     *
	     * @return bool
	     */
        public function ez_loader($arr_objs = ''){

	        if ( ! is_array($arr_objs)){
		        return false;
	        }
	        $this->_arr_audit = array();

	        foreach ($arr_objs as $key => $obj_orig){
	        	// we could chk for active !== false here...
	        	$obj = $this->ez_prep($obj_orig);
		        // ...and here. but both methods have that baked in already
		        $this->ez_add_image_size($obj);
	        }
        }


	    /**
	     * Note: All ratios are defined as landscape by default. The exception, obviously, is for square / sqr / 1x1.
	     */
	    public function ratios(){

		    // For a more complete list of rations see Reference \ Aspect Ratios

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

    } // END: class
} // END: if class exists

//new Add_Image_Size();