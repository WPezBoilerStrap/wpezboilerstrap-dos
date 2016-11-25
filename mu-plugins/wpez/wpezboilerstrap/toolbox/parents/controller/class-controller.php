<?php

namespace WPez\WPezBoilerStrap\Toolbox\Parents;

// No WP? Die! Now!!
if ( ! defined('ABSPATH') ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die();
}

if ( ! class_exists('Controller') ) {
	abstract class Controller {

		protected $_gargs;
		protected $_lang = false;
		protected $_opts = false;
		protected $_route = false;
		protected $_vargs = false;


		public function __construct( $arr_gargs = array() ) {

			$this->_gargs = $arr_gargs;

			$this->unpack_config($this->_gargs);
		}

		protected function unpack_config($arr_gargs){

			if ( isset($arr_gargs['config']) && is_array($arr_gargs['config']) ) {
				
				$arr_config = $arr_gargs['config'];

				if ( isset( $arr_config['lang'] ) ) {
					$this->_lang = $arr_config['lang'];
				}

				if ( isset( $arr_config['opts'] ) ) {
					$this->_opts = $arr_config['opts'];
				}

				if ( isset( $arr_config['route'] ) ) {
					$this->_route = $arr_config['route'];
				}

				if ( isset( $arr_config['vargs'] ) ) {
					$this->_vargs = $arr_config['vargs'];
				}
				return true;
			}

			return false;

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
		 * If a template part is calling other template parts in the same dir/folder this method
		 * returns the gtp friendly path. When called $str_magic_dir is __DIR__
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

		protected function ez_gtp_loader_defaults(){

			$obj = new \stdClass();

			$obj->active = true;
			$obj->slug_path = '';
			$obj->slug = '';
			$obj->name = '';
			$obj->class = '';
			$obj->args = '';
			$obj->method = '';

			return $obj;
		}

		/**
		 * @param string $obj_args
		 *
		 * @return bool|string
		 */
		protected function ez_gtp_loader($obj_args_orig = ''){

			// active
			// slug_path
			// slug
			// name
			// class
			// args
			// method

			if ( is_object($obj_args_orig) ){

				$obj_args = (object) array_merge( (array)$this->ez_gtp_loader_defaults(), (array) $obj_args_orig);

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