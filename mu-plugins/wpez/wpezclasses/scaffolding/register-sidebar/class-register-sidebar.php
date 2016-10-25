<?php
/**
 * Methods related to defining and registering sidebars
 *
 * (@link http://codex.wordpress.org/Conditional_Tags)
 *
 * PHP version 5.3
 *
 * LICENSE: TODO
 *
 * @package WPezClasses
 * @author  Mark Simchock <mark.simchock@alchemyunited.com>
 * @since   0.5.0
 * @license TODO
 */


namespace WPez\WPezClasses\Scaffolding;

// No WP? Die! Now!!
if ( ! defined( 'ABSPATH' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die();
}

if ( ! class_exists( 'Register_Sidebar' ) ) {
	class Register_Sidebar {

		function __construct() {
		}


		/**
		 * @return stdClass
		 */
		protected function file_constants() {
			$obj = new \stdClass();

			$obj->url         = plugin_dir_url( __FILE__ );
			$obj->path        = plugin_dir_path( __FILE__ );
			$obj->path_parent = dirname( $this->_path );
			$obj->basename    = plugin_basename( __FILE__ );
			$obj->file        = __FILE__;

			return $obj;
		}


		/**
		 * REF: https://codex.wordpress.org/Function_Reference/register_sidebar
		 */
		public function rs_defaults() {
			$obj = new \stdClass();

			$obj->active        = true;
			$obj->description   = '';
			$obj->before_widget = '<li id="%1$s" class="widget %2$s">';
			$obj->after_widget  = '</li>\n';
			$obj->before_title  = '<h2 class="widgettitle">';
			$obj->after_title   = '</h2>\n';


			return $obj;
		}


		/**
		 * Combines the base and the values and makes the register_sidebar() magic happen
		 */
		public function ez_loader( $arr_args = '' ) {

			if ( isset( $arr_args ) && is_array( $arr_args ) && ! empty( $arr_args ) ) {

				foreach ( $arr_args as $str_key => $obj ) {

					if ( is_object($obj) ) {

						// how should be arr_merge the obj and the defaults
						if ( isset($obj->register_sidebar) && is_object( $obj->register_sidebar ) && isset($obj->defaults) && is_object( $obj->defaults ) ) {
							$obj_wp = (object) array_merge( (array) $this->rs_defaults(), (array) $obj->defaults, (array) $obj->register_sidebar );
						} elseif ( isset($obj->register_sidebar) && is_object( $obj->register_sidebar )){
							$obj_wp = (object) array_merge( (array) $this->rs_defaults(), (array) $obj->register_sidebar );
						} else {
							$obj->active = false;
						}

						if ( $obj->active === true ) {

							$str_before_widget = $obj_wp->before_widget;
							$str_after_widget  = $obj_wp->after_widget;
							// if there's a before_widget_tag then we'll override the standard before_widget / after_widget
							if ( isset($obj->before_widget_tag) && ! empty( $obj->before_widget_tag ) && isset($obj->before_widget_global_args) ){

								$str_before_widget = \WPezCore::element_open( $obj->before_widget_tag, $obj->before_widget_global_args );
								$str_after_widget = \WPezCore::element_close($obj->before_widget_tag);
							}

							$str_before_title = $obj_wp->before_title;
							$str_after_title  = $obj_wp->after_title;
							// if there's a before_widget_tag then we'll override the standard before_widget / after_widget
							if ( isset($obj->before_title_tag) && ! empty( $obj->before_title_tag ) && isset($obj->before_widget_global_args) ){

								$str_before_title = \WPezCore::element_open( $obj->before_title_tag, $obj->before_title_global_args );
								$str_after_title = \WPezCore::element_close($obj->before_title_tag);
							}

							// TODO - validation?
							register_sidebar( array(
								'name'        => $obj_wp->name,
								'id'          => $obj_wp->id,
								'description' => $obj_wp->description,
								'class' => $obj_wp->description,
								'before_widget' => $str_before_widget,
								'after_widget'  => $str_after_widget,
								'before_title'  => $str_before_title,
								'after_title'   => $str_after_title )
							);
						}
					}
				}
			}
		}

	} // END: class
} // END: if class exists