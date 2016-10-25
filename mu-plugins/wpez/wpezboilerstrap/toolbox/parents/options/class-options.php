<?php

namespace WPez\WPezBoilerStrap\Toolbox\Parents;

	/*
	 * More info: http://scotty-t.com/2012/07/09/wp-you-oop/
	 */

// No WP? Die! Now!!
if ( ! defined('ABSPATH') ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die();
}

if ( ! class_exists('Options') ) {
	abstract class Options extends Singleton {

		protected $_args;

		public function ez__construct($mix_args = ''){
			$this->_args = $mix_args;
		}


		public function get( $str_meth = '', $str_arg = '' ) {

			if ( method_exists( $this, $str_meth ) ) {
				return $this->$str_meth($str_arg, $str_arg);
			}

			return new \stdClass();
		}

		abstract protected function globals();
	}
}