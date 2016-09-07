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

if ( ! class_exists('WPezConfig') ) {
	abstract class WPezConfig extends Singleton {

		/*
		 * FYI - this abstract method is in Singleton
		 * abstract
		 * public function ez__construct();
		 */


		public function get($str_meth = ''){

			if ( method_exists($this, $str_meth)){
				return $this->$str_meth();
			}
			return new \stdClass();
		}

		protected function all(){

			$obj = new \stdClass();

			$obj->build = $this->build();
			$obj->lang = $this->language();
			$obj->options = $this->options();
			$obj->router = $this->router();
			$obj->vargs = $this->viewargs();

			return $obj;
		}


		protected function gtp_loader($obj_args = ''){

			if ( ! isset($obj_args->active) || $obj_args->active !== false ) {

				// TODO - additional validation?
				If ( is_object( $obj_args ) && isset( $obj_args->class ) && ! class_exists( $obj_args->class, false ) ) {

					get_template_part( $obj_args->slug, $obj_args->name );

				}
				if ( class_exists( $obj_args->class, false ) ) {
					return new $obj_args->class( $obj_args->args );
				}
			}
			return new \stdClass();
		}


		/*
		 * $obj = new \stdClass();
		 * $obj->active = true;
		 * $obj->slug = 'app\build-loader';
		 * $obj->name = '';
		 * $obj->class = '\\WPezTheme\Build_Loader';
		 * $obj->args = ''
		 * return $obj;
		 */
		abstract protected function build();

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