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

if ( ! class_exists('View_Macros') ) {
	class View_Macros { // extends \WPezBoilerStrap\Toolbox\Parents\Singleton {


		static public function icon_name($icon_tag = false, $icon_gattrs = array(), $name_tag = false, $name_gattrs = array(), $str_name){

			$str_ret = '';

			$str_ret .= self::element_open($icon_tag, $icon_gattrs);
			$str_ret .= self::element_close($icon_tag);

			$str_ret .= self::element_open($name_tag, $name_gattrs);
			$str_ret .= esc_attr($str_name);
			$str_ret .= self::element_close($name_tag);

			return $str_ret;
		}


		/**
		 * @param string $obj_vargs
		 *
		 * @return bool
		 */
		static function enclose( $obj_vargs = '', $bool_enclose = true ) {

			/*
			 * every view can have an enclose (i.e., semantic wrapper* and a wrapper nested within that).
			 * (1) this standarizes it. it's (almost) always there. we can count on being
			 *     able to customize an enclose for any given a view
			 * (2) it's one less thing for the view dev to worry about.
			 * (3) that is, it "forces" the view to be as minimal as possible. beyond that,
			 *     the enclose_setup() takes care of what is (almost) always there.
			 */

			$arr_enclose = array( 'semantic', 'view_wrapper' );

			$obj_ret = new \stdClass();

			$obj_ret->semantic_open  = '';
			$obj_ret->semantic_close = '';
			$obj_ret->view_wrapper_open   = '';
			$obj_ret->view_wrapper_close  = '';

			// does the view not allow an encloses?
			if ( $bool_enclose === false || ! is_object($obj_vargs) ) {
				return $obj_ret;
			}

			if ( isset( $obj_vargs->enclose ) && is_object( $obj_vargs->enclose ) && ( ! isset( $obj_vargs->enclose->active ) || ( isset( $obj_vargs->enclose->active ) && $obj_vargs->enclose->active !== false ) ) ) {

				$obj_enc = $obj_vargs->enclose;
				foreach ( $arr_enclose as $key => $str_val ) {

					$str_val    = trim( $str_val );
					$str_active = trim( $str_val ) . '_active';

					if ( ! isset( $obj_enc->$str_active ) || $obj_enc->$str_active !== false ) {

						$str_tag  = $str_val . '_tag';
						$str_gats = $str_val . '_global_attrs';

						// set the properties for this enclose value
						$str_open         = $str_val . '_open';
						$str_close        = $str_val . '_close';
						$obj_ret->$str_open  = self::element_open( $obj_enc->$str_tag, $obj_enc->$str_gats );
						$obj_ret->$str_close = self::element_close( $obj_enc->$str_tag );
					}
				}
			}
			return $obj_ret;
		}


		/**
		 * ref: https://developer.mozilla.org/en-US/docs/Web/HTML/Global_attributes
		 *
		 * @param string $arr
		 *
		 * @return string
		 */
		static public function global_attrs( $arr = '' ) {

			$str_ret = '';
			if ( is_array( $arr ) ) {
				$arr_temp = array();
				foreach ( $arr as $key => $val ) {
					$esc_key = esc_attr( $key );
					$esc_val = esc_attr( $val );
					//TODO - add test for supported attrs
					if ( ! empty( $esc_key ) && ! empty( $esc_val ) ) {
						$arr_temp[] = $esc_key . '="' . $esc_val . '"';
					} elseif ( $esc_key = 'itemscope' ){
						$arr_temp[] = 'itemscope';
					}
				}
				$str_ret = implode( " ", $arr_temp );
				if ( ! empty( $str_ret ) ) {
					// we'll "force" a leading ' ' since that's probably the usual need. it can be trimmed later
					$str_ret = ' ' . $str_ret;
				}
			}

			return $str_ret;
		}

		// TODO:
		static public function global_attrs_supported() {
		}


		/**
		 * @param string $str_ele
		 * @param string $arr_gats
		 * @param bool $mix_validation << TODO
		 *
		 * @return string
		 */
		static public function element_open( $str_ele = '', $arr_gats = '', $mix_validation = false ) {

			$str_ele_esc = esc_attr( $str_ele );

			$str_ret = '';
			// TODO - element tag validation?
			if ( ! empty( $str_ele_esc ) ) {
				$str_gats = self::global_attrs( $arr_gats );
				$str_ret .= '<' . $str_ele_esc . $str_gats . '>';
			}

			return $str_ret;
		}

		// TODO - HTML tags supported
		static public function element_open_supported() {
		}

		/**
		 * @param string $str_ele
		 * @param string $arr_gats
		 * @param bool $mix_validation
		 *
		 * @return string
		 */
		static public function element_close( $str_ele = '', $arr_gats = '', $mix_validation = false ) {

			$str_ele_esc = esc_attr( $str_ele );

			$str_ret = '';
			// TODO - element tag validation?

			if ( ! empty( $str_ele_esc ) ) {
				$str_ret .= '</' . $str_ele_esc . '>';
			}

			return $str_ret;
		}

	}
}