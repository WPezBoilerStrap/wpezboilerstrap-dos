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



		protected function TODOX_ez_clone($obj, $bool_ezx = true){

			if ( ! is_object($obj) ){
				return; // TODO false?
			}

			$str_class = get_class($obj);
			$str_class_lower = strtolower($str_class);

			$obj_new = new \stdClass();
			// add a clone of the org obj to the new obj. the orig obj's class is the property holding the clone.
			// we don't want to "disturb" the orginal (WP) object.
			$obj_new->$str_class_lower = clone $obj;
			// ezx - short for ez extras
			// add the ezx property and store any of the ez-centric properties there. again, leave the orig obj alone.
			// this also establishes a "known" within the ez architecture.
			$obj_new = $this->ezx_exists($obj_new);
			// is there anything additional we want to do with this type of obj?
			$str_method = 'ez_clone_' . $str_class_lower;
			if ( $bool_ezx !== false && method_exists($this, $str_method)){
				$obj_new = $this->$str_method($obj_new);
			}
			return $obj_new;
		}

		protected function TODOX_ezx_exists($obj_new = '') {

			if ( is_object( $obj_new ) && ! property_exists( $obj_new, 'ezx' ) ) {
				$obj_new->ezx = new \stdClass();
			}
			return $obj_new;
		}

		/**
		 * once cloned there's some additional (quick) magic for instances of wp_post
		 * @param $obj_new
		 *
		 * @return mixed
		 */
		protected function TODOX_ez_clone_wp_post($obj_new = ''){

			if ( ! is_object($obj_new) ){
				return false; // TODO
			}

			$obj_new->ID = $obj_new->wp_post->ID;
			$obj_new->post_type = $obj_new->wp_post->post_type;


			$str_post_type_lower = strtolower($obj_new->wp_post->post_type);
			$str_method = 'ez_clone_wp_post_' . $str_post_type_lower;
			if ( method_exists($this, $str_method)){
				$obj_new = $this->$str_method($obj_new);
			}

			return $obj_new;
		}



		protected function TODOX_ez_clone_wp_post_post($obj_new){

			if ( ! is_object($obj_new)){
				return false; // TODO return?
			}

			$obj_new = $this->ezx_exists($obj_new);

			$obj_new->post_author = $obj_new->wp_post->post_author;
			$obj_new->ezx->permalink = get_permalink($obj_new->wp_post->ID);

			return $obj_new;

		}

		protected function TODOX_ez_clone_wp_post_nav_menu_item ($obj_new = ''){

			if ( ! is_object($obj_new)){
				return false; // TODO return?
			}

			$obj_new = $this->ezx_exists($obj_new);

			$obj_new->ezx->url = $obj_new->wp_post->url;
			$obj_new->ezx->anchor = $obj_new->wp_post->title;
			$obj_new->ezx->target = $obj_new->wp_post->target;
			$obj_new->ezx->attr_title  = $obj_new->wp_post->attr_title;
			$obj_new->ezx->class = esc_attr(implode(' ',$obj_new->wp_post->classes ));

			return $obj_new;
		}


		protected function TODOX_ez_clone_menu($arr_objs = '', $bool_ezx = true){

			if ( is_array($arr_objs) && count($arr_objs) > 0 ){

				// let's check the first obj in the array;
				$obj_0 = array_values($arr_objs)[0];

				if ( $obj_0 instanceof \WP_Post && $obj_0->post_type == 'nav_menu_item'  ){

					$new_arr = array();
					foreach ( $arr_objs as $key => $obj ){

						$new_arr[] = $this->ez_clone($obj);
					}
					return $new_arr;
				}

			}
			return $arr_objs;
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