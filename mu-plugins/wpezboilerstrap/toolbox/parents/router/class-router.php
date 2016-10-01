<?php

namespace WPezBoilerStrap\Toolbox\Parents;

	/*
	 * More info: http://scotty-t.com/2012/07/09/wp-you-oop/
	 */

// No WP? Die! Now!!
if ( ! defined('ABSPATH') ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die();
}

if ( ! class_exists('Router') ) {
	abstract class Router extends Singleton {

		protected $_args;

		public function ez__construct($mix_args = '' ){
			$this->_args = $mix_args;
		}


		public function get( $str_meth = 'route', $str_arg = '' ) {

			if ( method_exists( $this, $str_meth ) ) {
				return $this->$str_meth($str_arg);
			}

			return '';
		}

		abstract protected function environment();

		abstract protected function user();

		abstract protected function branch();

		abstract protected function route();
	}
}