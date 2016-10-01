<?php

namespace WPezBoilerStrap\Toolbox\Tools;

	/*
	 * More info: http://scotty-t.com/2012/07/09/wp-you-oop/
	 */

// No WP? Die! Now!!
if ( ! defined('ABSPATH') ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die();
}

if ( ! class_exists('Cloning') ) {
	class Cloning { // extends \WPezBoilerStrap\Toolbox\Parents\Singleton {

		//public function ez__construct() {}

		public function __construct() {}


		/**
		 * For cloning and ez-tizing (WP) objects to make them easier to work with
		 *
		 * @param $obj
		 * @param bool $bool_ezx
		 *
		 * @return \stdClass|string|void
		 */
		public function ez_clone( $obj, $bool_ezx = true ) {

			if ( ! is_object( $obj ) ) {
				return new \stdClass(); // TODO false?
			}

			$str_class       = get_class( $obj );
			$str_class_lower = strtolower( $str_class );

			$obj_new = new \stdClass();
			// add a clone of the org obj to the new obj. the orig obj's class is the property holding the clone.
			// we don't want to "disturb" the orginal (WP) object.
			$obj_new->get_class = $str_class;
			$obj_new->get_class_lower = $str_class_lower;

			$obj_new->orig_obj = clone $obj;

			// is there anything additional we want to do with this type of obj?
			$str_method = 'ez_clone_' . $str_class_lower;
			if ( $bool_ezx !== false && method_exists( $this, $str_method ) ) {
				$obj_new = $this->$str_method( $obj_new );
			}
			return $obj_new;
		}

		/**
		 * Checks to see if an obj has a ezx property, and if not, adds it.
		 *
		 * @param string $obj_new
		 *
		 * @return string
		 */
		protected function TODOX_ezx_exists( $obj_new = '' ) {

			if ( is_object( $obj_new ) && ! property_exists( $obj_new, 'ezx' ) ) {
				$obj_new->ezx = new \stdClass();
			}

			return $obj_new;
		}

		/**
		 * once cloned there's some additional (quick) magic for instances of wp_post
		 *
		 * @param $obj_new
		 *
		 * @return mixed
		 */
		protected function ez_clone_wp_post( $obj_new = '' ) {

			if ( ! is_object( $obj_new ) ) {
				return false; // TODO
			}

			$obj_new->ID        = $obj_new->orig_obj->ID;
			$obj_new->wp_class = $obj_new->get_class;
			$obj_new->wp_type = $obj_new->orig_obj->post_type;


			// standard added properties are based on post_type
			$str_post_type_lower = strtolower( $obj_new->orig_obj->post_type );
			$str_method          = 'ez_clone_wp_post_' . $str_post_type_lower;
			if ( method_exists( $this, $str_method ) ) {
				$obj_new = $this->$str_method( $obj_new );
			}

			return $obj_new;
		}

		protected function ez_clone_wp_term( $obj_new = ''){

			if ( ! is_object( $obj_new ) ) {
				return false; // TODO
			}

			$obj_new->ID        = $obj_new->orig_obj->term_id;
			$obj_new->wp_class = $obj_new->get_class;
			$obj_new->wp_type = 'wp_term';

			$obj_new->url    = get_term_link( $obj_new->orig_obj->term_id, $obj_new->orig_obj->taxonomy);
			$obj_new->anchor_text = $obj_new->orig_obj->name;
			$obj_new->title = $obj_new->orig_obj->name;
			$attr_title  = $obj_new->orig_obj->name;
			if ( ! empty( $obj_new->orig_obj->description ) ) {
				$attr_title = $obj_new->orig_obj->name . ' - ' . $obj_new->orig_obj->description;
			}
			$obj_new->global_attrs = array(
				'title' => $attr_title
			);

			return $obj_new;
		}


		protected function ez_clone_wp_post_post( $obj_new ) {

			if ( ! is_object( $obj_new ) ) {
				return false; // TODO return?
			}

			$obj_new->post_author    = $obj_new->orig_obj->post_author;
			$obj_new->url = get_permalink( $obj_new->orig_obj->ID );
			$obj_new->anchor_text   = $obj_new->orig_obj->post_title;
			$obj_new->title   = $obj_new->orig_obj->post_title;

			// img
			$temp = new \stdClass();
			$obj_new->img = $temp;
			// meta
			$temp = new \stdClass();
			$obj_new->meta = $temp;
			// terms
			$temp = new \stdClass();
			$obj_new->terms = $temp;
			// user (aka author)
			$temp = new \stdClass();
			$obj_new->user = $temp;

			return $obj_new;

		}

		protected function ez_clone_wp_post_nav_menu_item( $obj_new = '' ) {

			if ( ! is_object( $obj_new ) ) {
				return false; // TODO return?
			}

			$obj_new->url        = $obj_new->orig_obj->url;
			$obj_new->anchor_text     = $obj_new->orig_obj->title;
			$obj_new->title     = $obj_new->orig_obj->title;


			$obj_new->global_attrs = array(
				'title' => $obj_new->orig_obj->attr_title,
				'class' => esc_attr( implode( ' ', $obj_new->orig_obj->classes ) )
			);
			if ( ! empty($obj_new->orig_obj->target) ){
				$obj_new->global_attrs['target'] = $obj_new->orig_obj->target;
			}

			return $obj_new;
		}


		/**
		 * Takes an array of menu nav item objs and ez_clones each obj
		 *
		 * @param string $arr_objs
		 * @param bool $bool_ezx
		 *
		 * @return array|string
		 */
		public function ez_clone_menu_items( $arr_objs = '', $bool_ezx = true ) {

			if ( is_array( $arr_objs ) && count( $arr_objs ) > 0 ) {

				// let's check the first obj in the array;
				$obj_0 = array_values( $arr_objs )[0];

				if ( $obj_0 instanceof \WP_Post && $obj_0->post_type == 'nav_menu_item' ) {

					$new_arr = array();
					foreach ( $arr_objs as $key => $obj ) {
						$new_arr[] = $this->ez_clone( $obj );
					}
					return $new_arr;
				}
			}
			return $arr_objs;
		}

		public function ez_clone_get_the_terms( $arr_objs = '', $bool_ezx = true ) {

			if ( is_array( $arr_objs ) && count( $arr_objs ) > 0 ) {

				// let's check the first obj in the array;
				$obj_0 = array_values( $arr_objs )[0];

				if ( $obj_0 instanceof \WP_Term ) {  // && $obj_0->post_type == 'nav_menu_item'

					$new_arr = array();
					foreach ( $arr_objs as $key => $obj ) {
						$new_arr[] = $this->ez_clone( $obj );
					}
					return $new_arr;
				}
			}
			return $arr_objs;
		}
	}
}