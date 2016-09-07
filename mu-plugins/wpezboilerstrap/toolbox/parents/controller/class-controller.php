<?php

namespace WPezBoilerStrap\Toolbox\Parents;

// No WP? Die! Now!!
if ( ! defined('ABSPATH') ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die();
}

if ( ! class_exists('Controller') ) {
	abstract class Controller {

		/*
		protected $_lang;
		protected $_mod;
		protected $_parts;
		protected $_route;
		protected $_vargs;
		*/

		public function __construct() {

		}

		protected function get_view_args(){

			$gva = new \stdClass();

			$gva->lang = $this->language();
			$gva->mod = $this->model();
			$gva->parts = $this->partials();
			$gva->vargs = $this->viewargs();

			return $gva;
		}

		protected function TODOX_gtp_loader($obj_args = ''){

			if ( ! isset($obj_args->active) || $obj_args->active !== false ) {

				// TODO - additional validation?
				If ( is_object( $obj_args ) && isset( $obj_args->class ) && ! class_exists( $obj_args->class, false ) ) {

					get_template_part( $obj_args->slug, $obj_args->name );

				}
				if ( class_exists( $obj_args->class, false ) ) {

					$obj_class = new $obj_args->class( $obj_args->args );
					if ( ! isset( $obj_args->method ) || empty($obj_args->method) || $obj_args->method === false ){
						return $obj_class;
					}
					if ( method_exists($obj_class, $obj_args->method) ){
						return $obj_class->$obj_args->method();
					}
					return new \stdClass();
				}
			}
			return new \stdClass();
		}

		/**
		 * @param string $obj_args
		 * @param string $str_meth
		 *
		 * @return mixed
		 */
		protected function TODOX_view_render($obj_args = '', $str_meth = 'render'){

			// TODO: additional validation?

			if ( is_object($obj_args) ){

				if ( ! isset($obj_args->active) || $obj_args->active !== false ){

					if ( class_exists($obj_args->class)){

						$obj = new $obj_args->class($obj_args->args);
						if ( method_exists($obj, $str_meth)){

							return $obj->$str_meth();
						}
					}
					// if for any reason we don't render a view, we return false
					return false;
				}
			}
		}

		protected function ez_loader($obj_args = ''){

			// active
			// slug
			// name
			// class
			// args
			// method

			if ( is_object($obj_args) ){

				if ( ! isset($obj_args->active) || $obj_args->active !== false ){

					$bool_autoload = true;

					if ( isset( $obj_args->slug ) && ! empty($obj_args->slug) && is_string($obj_args->slug) && isset( $obj_args->class ) && ! class_exists( $obj_args->class, false ) ) {

						$bool_autoload = false;
						get_template_part( $obj_args->slug, $obj_args->name );
					}

					// TODO: Finish - On "fail" target what's returned based on what's requested \ expected.
					$mix_else_return = false;
					if ( isset($obj_args->method) && ($obj_args->method == 'render' || $obj_args->method == 'get_view') ){
						$mix_else_return = '';
					}

					// condition varys depending on type
					if ( class_exists( $obj_args->class, $bool_autoload) ) {

						$obj_class = new $obj_args->class( $obj_args->args );

						if ( ! isset( $obj_args->method ) || empty($obj_args->method) || $obj_args->method === false ){
							return $obj_class;
						}
						if ( method_exists($obj_class, $obj_args->method) ){
							$str_method = $obj_args->method;
							return $obj_class->$str_method();
						}
						return $mix_else_return;
					}
					return $mix_else_return;
				}
			}
			return false;
		}


		/**
		 * We don't wanna mess with the $post. We also don't want to risk - however low - adding
		 * properties to a post - original or clone - that might be added by WP later.
		 *
		 * @param $obj_post
		 *
		 * @return \stdClass
		 */
		protected function post_clone($obj_post, $bool_add_basics = true){

			if ( $obj_post instanceof \WP_Post){

				$obj = new \stdClass();

				// for simple convenience we'll put the ID and author off the "root" of the new obj
				$obj->ID = $obj_post->ID;
				$obj->post_author = $obj_post->post_author;

				$obj->post = clone $obj_post;
				// regardless of bool_add_basics we add an ezx (ez extra) property + obj
				$obj->ezx = new \stdClass();
				if ($bool_add_basics !== false){
					$obj->ezx->permalink = get_permalink($obj->ID);
				}

				return $obj;
			}
			return false; // $obj_post;
		}
		// p.z. post_clone() can probably go elsewhere but for now I'll leave it here. As it's
		// primarily a controller tool

		// ------------ Your class should address everything below this line ------------ //

		/**
		 * @return string
		 */
		abstract public function get_view();

		/**
		 * @return object
		 */
		abstract protected function language();

		/**
		 * @return object
		 */
		abstract protected function model();

		abstract protected function partials();

		abstract protected function router();

		abstract protected function viewargs();

	}
}