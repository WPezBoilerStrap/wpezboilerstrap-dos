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

		/**
		 * If a template part is calling other template parts this return the gtp friend path. When called $str_magic_dir is __DIR__
		 *
		 * @param $str_magic_dir
		 *
		 * @return mixed
		 */
		protected function gtp_path($str_magic_dir){

			$str_themes = WP_CONTENT_DIR . "/" . "themes" . "/";
			$str_themes = str_replace("\\", "/", $str_themes);

			$str_current = $str_magic_dir;
			$str_current = str_replace("\\", "/", $str_current);

			$gtp_path = str_replace($str_themes, '', $str_current);

			$gtp_path = preg_replace('/^(.*?)\//', '', $gtp_path);

			// return the WP get_template_part() path to the current (child) class
			return $gtp_path;

		}


		/**
		 * @param string $obj_args
		 *
		 * @return bool|string
		 */
		protected function ez_loader($obj_args = ''){

			// active
			// slug_path
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
						$str_slug = $obj_args->slug;
						if ( isset($obj_args->slug_path) && ! empty($obj_args->slug_path) ) {
							$str_slug = $obj_args->slug_path . '/' . $obj_args->slug;
						}
						get_template_part( $str_slug, $obj_args->name );
					}

					// TODO: Finish - On "fail" target what's returned based on what's requested \ expected.
					$mix_else_return = false;
					if ( isset($obj_args->method) && ($obj_args->method == 'render' || $obj_args->method == 'get_view') ){
						$mix_else_return = '';
					}

					// condition varies depending on type
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



		protected function ez_clone($obj, $bool_add_basics = true){

			if ( ! is_object($obj) ){
				return; // TODO false?
			}

			$str_class = get_class($obj);
			$str_class_lower = strtolower($str_class);

			$obj_new = new \stdClass();
			$obj_new->$str_class_lower = clone $obj;
			// ezx - short for ez extras
			$obj_new->ezx = new \stdClass();

			// is there anything additional we want to do with this value of instanceof
			$str_method = 'ez_clone_' . $str_class_lower;
			if ( method_exists($this, $str_method)){
				$obj_new = $this->$str_method($obj_new);
			}
			return $obj_new;
		}


		/**
		 * once cloned there's some additional (quick) magic for instances of wp_post
		 * @param $obj_new
		 *
		 * @return mixed
		 */
		protected function ez_clone_wp_post($obj_new){

			// for convenience post the ID and post_author (user_id) in the "root"
			$obj_new->ID = $obj_new->wp_post->ID;
			$obj_new->post_author = $obj_new->wp_post->post_author;
			// add the parmalink
			$obj_new->ezx->permalink = get_permalink($obj_new->wp_post->ID);

			return $obj_new;
		}



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

		/**
		 * @return object
		 */
		abstract protected function partials();

		/**
		 * @return object
		 */
		abstract protected function router();

		/**
		 * @return object
		 */
		abstract protected function viewargs();

	}
}