<?php

namespace WPezBoilerStrap\Toolbox\Parents;

// No WP? Die! Now!!
if ( ! defined( 'ABSPATH' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die();
}

if ( ! class_exists( 'View' ) ) {
	abstract class View {

		protected $_lang;
		protected $_mod;
		protected $_parts;
		protected $_vags;

		/**
		 * Allow a view to not allow an enclose.
		 *
		 * @var
		 */
		protected $_bool_enclose;
		protected $_arr_enclose;

		protected $_semantic_open;
		protected $_semantic_close;
		protected $_wrapper_open;
		protected $_wrapper_close;

		public function __construct( $obj_args = false ) {

			$this->_land  = new \stdClass();
			$this->_mod   = new \stdClass();
			$this->_parts = new \stdClass();
			$this->_vargs = new \stdClass();

			$this->_arr_enclose = array( 'semantic', 'wrapper' );

			if ( ! isset($obj_args->use) ){

				$this->set_args( $obj_args );

			} elseif ( $obj_args->use == 'defaults' ) {

				$this->_lang  = $this->lang_defaults();
				$this->_mod   = $this->mod_defaults();
				$this->_parts = $this->parts_defaults();
				$this->_vargs = $this->vargs_defaults();

			} elseif ( is_object( $obj_args ) && $obj_args->use == 'merge' ) {

				$this->set_args_merge( $obj_args );

			} elseif ( is_object( $obj_args ) ) {

				$this->set_args( $obj_args );
			}
		}

		/**
		 * @param string $obj_args
		 *
		 * @return bool
		 */
		// TODO - this needs to be tested.
		public function set_args_merge( $obj_args = '' ) {

			$this->_lang  = $this->lang_defaults();
			$this->_mod   = $this->mod_defaults();
			$this->_parts = $this->parts_defaults();
			$this->_vargs = $this->vargs_defaults();

			if ( ! is_object( $obj_args ) ) {
				return false;
			}

			if ( isset( $obj_args->lang ) && is_object( $obj_args->lang ) ) {
				$this->_lang = (object) array_merge( (array) $this->_land, (array) $obj_args->lang );
			}
			if ( isset( $obj_args->mod ) && is_object( $obj_args->mod ) ) {
				$this->_mod = (object) array_merge( (array) $this->_mod, (array) $obj_args->mod );
			}
			if ( isset( $obj_args->parts ) && is_object( $obj_args->parts ) ) {
				$this->_parts = (object) array_merge( (array) $this->_parts, (array) $obj_args->parts );

			}
			if ( isset( $obj_args->vargs ) && is_object( $obj_args->vargs ) ) {
				$this->_vargs = (object) array_merge( (array) $this->_vargs, (array) $obj_args->vargs );
			}
		}


		public function set_args( $obj_args = '' ) {

			if ( ! is_object( $obj_args ) ) {
				return false;
			}

			if ( isset( $obj_args->lang ) && is_object( $obj_args->lang ) ) {
				$this->_lang = $obj_args->lang;
			}
			if ( isset( $obj_args->mod ) && is_object( $obj_args->mod ) ) {
				$this->_mod = $obj_args->mod;
			}
			if ( isset( $obj_args->parts ) && is_object( $obj_args->parts ) ) {
				$this->_parts = $obj_args->parts;
			}
			if ( isset( $obj_args->vargs ) && is_object( $obj_args->vargs ) ) {
				$this->_vargs = $obj_args->vargs;
			}
		}

		public function set_lang( $obj_lang = '' ) {
			return $this->set( $obj_lang, '_lang' );
		}

		public function set_mod( $obj_mod = '' ) {
			return $this->set( $obj_mod, '_mod' );
		}

		public function set_parts( $obj_parts = '' ) {
			return $this->set( $obj_parts, '_parts' );
		}

		public function set_vargs( $obj_vargs = '' ) {
			return $this->set( $obj_vargs, '_vargs' );
		}

		protected function set( $obj_args, $str_prop = '_null' ) {

			if ( is_object( $obj_args ) ) {
				$this->$str_prop = $obj_args;

				return true;
			}

			return false;
		}


		/**
		 * ref: https://developer.mozilla.org/en-US/docs/Web/HTML/Global_attributes
		 *
		 * @param string $arr
		 *
		 * @return string
		 */
		protected function global_attrs( $arr = '' ) {

			$str_ret = '';
			if ( is_array( $arr ) ) {
				$arr_temp = array();
				foreach ( $arr as $key => $val ) {
					$esc_key = esc_attr( $key );
					$esc_val = esc_attr( $val );
					//TODO - add test for supported attrs
					if ( ! empty( $esc_key ) && ! empty( $esc_val ) ) {
						$arr_temp[] = $esc_key . '="' . $esc_val . '"';
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
		protected function global_attrs_supported() {
		}


		/**
		 * @param string $str_ele
		 * @param string $arr_gats
		 * @param bool $mix_validation << TODO
		 *
		 * @return string
		 */
		protected function element_open( $str_ele = '', $arr_gats = '', $mix_validation = false ) {

			$str_ele_esc = esc_attr( $str_ele );

			$str_ret = '';
			// TODO - element tag validation?
			if ( ! empty( $str_ele_esc ) ) {
				$str_gats    = $this->global_attrs( $arr_gats );
				$str_ret .= '<' . $str_ele_esc . $str_gats . '>';
			}

			return $str_ret;
		}

		// TODO - HTML tags supported
		protected function element_open_supported() {
		}

		/**
		 * @param string $str_ele
		 * @param string $arr_gats
		 * @param bool $mix_validation
		 *
		 * @return string
		 */
		protected function element_close( $str_ele = '', $arr_gats = '', $mix_validation = false ) {

			$str_ele_esc = esc_attr( $str_ele );

			$str_ret = '';
			// TODO - element tag validation?

			if ( ! empty( $str_ele_esc ) ) {
				$str_ret .= '</' . $str_ele_esc . '>';
			}
			return $str_ret;
		}


		/**
		 * @param string $obj_vargs
		 *
		 * @return bool
		 */
		protected function enclose_setup( $obj_vargs = '' ) {

			/*
			 * every view can have an enclose (i.e., semantic wrapper* and a wrapper nested within that).
			 * (1) this standarizes it. it's (almost) always there. we can count on being
			 *     able to customize an enclose for any given a view
			 * (2) it's one less thing for the view dev to worry about.
			 * (3) that is, it "forces" the view to be as minimal as possible. beyond that,
			 *     the enclose_setup() takes care of what is (almost) always there.
			 */

			$this->_semantic_open  = '';
			$this->_semantic_close = '';
			$this->_wrapper_open   = '';
			$this->_wrapper_close  = '';

			// does the view not allow an encloses?
			if ( $this->_bool_enclose === false ) {
				return false;
			}

			if ( is_object( $obj_vargs->enclose ) && is_array( $this->_arr_enclose ) && ( ! isset( $obj_vargs->enclose->active ) || ( isset( $obj_vargs->enclose->active ) && $obj_vargs->enclose->active !== false ))) {

				$obj_enc = $obj_vargs->enclose;
				foreach ( $this->_arr_enclose as $key => $str_val ) {

					$str_val = trim( $str_val );
					$str_active = trim( $str_val ) . '_active';

					if ( ! isset( $obj_enc->$str_active ) || $obj_enc->$str_active !== false ) {

						$str_tag  = $str_val . '_tag';
						$str_gats = $str_val . '_global_attrs';

						// set the properties for this enclose value
						$str_open  = '_' . $str_val . '_open';
						$str_close = '_' . $str_val . '_close';
						$this->$str_open  = $this->element_open( $obj_enc->$str_tag, $obj_enc->$str_gats );
						$this->$str_close = $this->element_close( $obj_enc->$str_tag );
					}
				}
				return true;
			}
			return false;
		}


		/**
		 * @return string
		 */
		public function render() {

			$this->enclose_setup( $this->_vargs );

			$str_ret = $this->view( $this->_lang, $this->_mod, $this->_parts, $this->_vargs );

			return $this->enclose($str_ret);

		}

		/**
		 * @param string $str_ret
		 *
		 * @return string
		 */
		public function enclose($str_ret = ''){

			return $this->_semantic_open . $this->_wrapper_open . $str_ret . $this->_wrapper_close . $this->_semantic_close;

		}

		/**
		 * @return string
		 */
		public function render_no_enclose() {

			$str_ret = $this->view( $this->_lang, $this->_mod, $this->_parts, $this->_vargs );

			return $str_ret;

		}


		// ------------ Your class should address everything below this line ------------ //

		/**
		 * @param $lang
		 * @param $mod
		 * @param $parts
		 * @param $vargs
		 *
		 * @return string
		 */
		abstract protected function view( $lang, $mod, $parts, $vargs );

		abstract protected function lang_defaults();

		abstract protected function mod_defaults();

		abstract protected function parts_defaults();

		abstract protected function vargs_defaults();
	}
	}