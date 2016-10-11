<?php

namespace WPezBoilerStrap\Toolbox\Parents;

// No WP? Die! Now!!
if ( ! defined( 'ABSPATH' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die();
}

if ( ! class_exists( 'View' ) ) {
	abstract class View {

		protected $_use = 'merge_defaults';
		protected $_bool_enclose = true;
		protected $_mac = '\WPezBoilerStrap\Toolbox\Tools\View_Macros';


		protected $_lang;
		protected $_mod;
		protected $_parts;
		protected $_vags;

		public function __construct( $obj_args = false ) {

			$this->args_prep($obj_args);

		}


		private function args_prep($obj_args = false ){

			$this->_land  = new \stdClass();
			$this->_mod   = new \stdClass();
			$this->_parts = new \stdClass();
			$this->_vargs = new \stdClass();

			$this->_arr_enclose = array( 'semantic', 'view_wrapper' );

			if ( is_object( $obj_args ) && ! isset( $obj_args->use ) ) {

				$this->set_args_merge( $obj_args );

			} elseif ( is_object( $obj_args ) && isset ( $obj_args->use ) && $obj_args->use == 'defaults' ) {

				$this->_lang  = $this->lang_defaults();
				$this->_mod   = $this->mod_defaults();
				$this->_parts = $this->parts_defaults();
				$this->_vargs = $this->vargs_defaults();

			} elseif ( is_object( $obj_args ) && isset ( $obj_args->use ) && $obj_args->use == 'custom' ) {

				$this->set_args( $obj_args );

			} elseif ( is_object( $obj_args ) ) {

				$this->set_args_merge( $obj_args );
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
				$this->_lang = (object) array_merge( (array) $this->_lang, (array) $obj_args->lang );
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
		 * @return string
		 */
		public function render() {

			$mac = $this->_mac;
			$obj_enc = $mac::enclose($this->_vargs, $this->_bool_enclose);

			$str_ret = $this->view( $this->_lang, $this->_mod, $this->_parts, $this->_vargs );

			return $obj_enc->semantic_open . $obj_enc->view_wrapper_open . $str_ret . $obj_enc->view_wrapper_close . $obj_enc->semantic_close;
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
		 * @param $mac
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