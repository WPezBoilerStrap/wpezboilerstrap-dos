<?php

namespace WPez\WPezBoilerStrap\Toolbox\Parents;

	/*
	 * More info: http://scotty-t.com/2012/07/09/wp-you-oop/
	 */

// No WP? Die! Now!!
if ( ! defined( 'ABSPATH' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die();
}

if ( ! class_exists( 'Config' ) ) {
	abstract class Config {


		public function __construct() {
		}


		public function get( $str_meth = '', $str_arg = '' ) {

			if ( method_exists( $this, $str_meth ) ) {
				return $this->$str_meth( $str_arg );
			}

			return new \stdClass();
		}

		/**
		 * @param string $str_meth      - the method within config
		 * @param string $str_meth_meth - the method within the method
		 *
		 * @return \stdClass
		 */
		public function ez_get( $str_meth = '', $str_meth_meth = '', $str_arg = '' ) {

			if ( method_exists( $this, $str_meth ) && method_exists( $this->$str_meth(), 'get' ) && method_exists( $this->$str_meth(), $str_meth_meth ) ) {
				$obj = $this->$str_meth();

				return $obj->get( $str_meth_meth, $str_arg );
			}

			return new \stdClass();
		}

		public function get_all() {

			$arr_all = array();

			$arr_all['lang']  = $this->language();
			$arr_all['opts']  = $this->options();
			$arr_all['route'] = $this->router();
			$arr_all['vargs'] = $this->viewargs();

			return $arr_all;
		}


		protected function ez_gtp( $obj = '' ) {

			if ( $obj->active === true ) {

				$str_slug = trim( $obj->slug );
				if ( isset( $obj->slug_path ) && ! empty( $obj->slug_path ) ) {
					$str_slug = trim( $obj->slug_path ) . '/' . trim( $obj->slug );
				}
				/**
				 * This is IMPORTANT. By using gtp() the child theme can naturally override any of these files
				 */
				get_template_part( $str_slug, trim( $obj->name ) );

			}
		}

		// return an instance of the language class
		abstract public function language();

		// return an instance of the options class
		abstract protected function options();

		// return an instance of the router class
		abstract protected function router();

		// return an instance of the viewargs class
		abstract protected function viewargs();


	}
}