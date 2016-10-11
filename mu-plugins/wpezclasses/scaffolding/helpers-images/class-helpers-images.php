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
 * @author  Mark Simchock <mark.simchock@alchemyunited.com>
 * @since   0.5.1
 * @license TODO
 */


namespace WPezClasses\Scaffolding;


// No WP? Die! Now!!
if ( ! defined( 'ABSPATH' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die();
}

if ( ! class_exists( 'Helpers_Images' ) ) {
	class Helpers_Images {

		protected $_jpeg_quality;
		protected $_arr_isnc_remove;
		protected $_str_isnc_type;
		protected $_arr_isnc;


		public function __construct( $obj_orig = '' ) {

			$this->_jpeg_quality    = 100;
			$this->_arr_isnc_remove = array();
			$this->_str_isnc_type   = 'append';
			$this->_arr_isnc        = array();
		}


		/**
		 * @return stdClass
		 */
		protected function file_constants() {

			$obj = new \stdClass();

			$obj->url         = plugin_dir_url( __FILE__ );
			$obj->path        = plugin_dir_path( __FILE__ );
			$obj->path_parent = dirname( $this->_path );
			$obj->basename    = plugin_basename( __FILE__ );
			$obj->file        = __FILE__;

			return $obj;
		}

		/**
		 * @return stdClass
		 */
		protected function ez_defaults() {

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
		 * Remove the width and height attributes of an image when it's inserted by admin WYSIWYG
		 *
		 * @param int $int_priority
		 */
		public function remove_width_height_attributes( $int_priority = 10 ) {

			add_filter( 'post_thumbnail_html', array(
				$this,
				'filter_remove_width_height_attributes'
			), absint( $int_priority ) );
			add_filter( 'image_send_to_editor', array(
				$this,
				'filter_remove_width_height_attributes'
			), absint( $int_priority ) );
		}


		// the filter for the remove_width_height_attribute() method
		public function filter_remove_width_height_attributes( $str_html = '' ) {

			$str_html = preg_replace( '/(width|height)="\d*"\s/', "", $str_html );

			return $str_html;
		}

		/**
		 * Change the default jpeg quality
		 *
		 * @param int $int_jpeg_quality
		 */
		public function jpeg_quality( $int_jpeg_quality = 100 ) {
			//TODO - validation?

			$this->_jpeg_quality = (integer) $int_jpeg_quality;
			add_filter( 'jpeg_quality', array( $this, 'filter_jpeg_quality' ) );
		}

		// filter for  the jpeg_quality() method
		public function filter_jpeg_quality( $int_jq = '' ) {

			return absint( $this->_jpeg_quality );
		}


		/**
		 * Remove image sizes from the select while inserting an image
		 *
		 * @param string $arr_args
		 * @param int $int_priority - this should come before the add's priority
		 */
		public function image_size_names_choose_remove( $arr_args = '', $int_priority = 10 ) {

			$this->_arr_isnc_remove = $this->isnc_defaults();
			if ( is_array( $arr_args ) ) {
				$this->_arr_isnc_remove = $arr_args;
			}
			add_filter( 'image_size_names_choose', array(
				$this,
				'filter_image_size_names_choose_remove'
			), absint( $int_priority ), 1 );
		}


		// filter for the image_size_names_choose_remove() method
		public function filter_image_size_names_choose_remove( $arr_sizes = array() ) {

			foreach ( $this->_arr_isnc_remove as $str_name => $bool_active ) {
				if ( $bool_active === true ) {
					unset( $arr_sizes[ $str_name ] );
				}
			}

			return $arr_sizes;
		}

		// these are the default wp sizes. we'll remove these if nothing else is specified
		protected function isnc_defaults() {

			return array(
				'full'      => true,
				'thumbnail' => true,
				'medium'    => true,
				'large'     => true
			);
		}


		/**
		 * Append new image sizes (using the ez image obj) to the select while inserting an image.
		 *
		 * @param string $arr_obj_ez
		 * @param int $int_priority - this should come before the add's priority
		 */
		public function image_size_names_choose_append( $arr_obj_ez = '', $int_priority = 20 ) {

			if ( is_array( $arr_obj_ez ) && ! empty( $arr_obj_ez ) ) {

				$this->_str_isnc_type = 'append';
				$this->_arr_isnc      = $arr_obj_ez;
				add_filter( 'image_size_names_choose', array(
					$this,
					'filter_image_size_names_choose_append'
				), absint( $int_priority ), 1 );
			}
		}

		/**
		 * Empty all current and then append new image sizes (using the ez image obj) to the select while inserting an image.
		 *
		 * @param string $arr_obj_ez
		 * @param int $int_priority - this should come before the add's priority
		 */
		public function image_size_names_choose_replace( $arr_obj_ez = '', $int_priority = 20 ) {

			if ( is_array( $arr_obj_ez ) && ! empty( $arr_obj_ez ) ) {

				$this->_str_isnc_type = 'replace';
				$this->_arr_isnc      = $arr_obj_ez;
				add_filter( 'image_size_names_choose', array(
					$this,
					'filter_image_size_names_choose_append'
				), absint( $int_priority ), 1 );
			}
		}


		// filter for the image_size_names_choose_append() method.
		public function filter_image_size_names_choose_append( $arr_wp_sizes = array() ) {

			if ( empty( $this->_arr_isnc ) ) {
				return $arr_wp_sizes;
			}

			$arr_sizes = array();
			foreach ( $this->_arr_isnc as $key_name => $obj_ez ) {
				if ( $obj_ez->names_choose->active === true ) {
					$arr_sizes[ $obj_ez->wp->name ] = $obj_ez->names_choose->select;
				}
			}
			// if it's append then merge with current wp sizes
			if ( $this->_str_isnc_type == 'append' ){
				$arr_sizes = array_merge( $arr_wp_sizes, $arr_sizes );
			}
			return $arr_sizes;
		}


	} // END: class
} // END: if class exists