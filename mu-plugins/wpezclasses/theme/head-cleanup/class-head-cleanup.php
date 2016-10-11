<?php
/**
 * The usual WordPress head cleanup suspects wrapped into an ez to use class (@link https://github.com/WPezClasses/class-wp-ezclasses-theme-head-cleanup-1)
 *
 * WordPress tends to add stuff in the head that are sometimes / often considered unnecessary and excessive. This is that snippet ez'tized.
 *
 * PHP version 5.3
 *
 * LICENSE: TODO
 *
 * @package WPezClasses
 * @author Mark Simchock <mark.simchock@alchemyunited.com>
 * @since 0.5.0
 * @license TODO
 */

namespace WPezClasses\Theme;

// No WP? Die! Now!!
if (!defined('ABSPATH')) {
	header( 'HTTP/1.0 403 Forbidden' );
	die();
}

if (! class_exists('Head_Cleanup') ) {
	class Head_Cleanup {

		protected $_obj_loaded;
		protected $_bool_ver_modify;
		protected $_bool_ver_remove;
		// http://php.net/manual/en/function.hash.php
		protected $_str_hash_algo;
		protected $_hash_date;


		public function __construct(){

			// don't do anything unless the ez_loader() is accessed.
			$this->_obj_loaded = false;

			add_action( 'init', array($this, 'ez_head_cleanup'), 50);

			$this->_bool_ver_modify = false;
			$this->_bool_ver_remove = false;
			$this->_str_hash_algo = 'md5';
			$this->_hash_date = "Y";

			add_filter( 'style_loader_src', array($this, 'wp_ver_modify_css_js'), 9999 );
			add_filter( 'script_loader_src', array($this, 'wp_ver_modify_css_js'), 9999 );

		}

		/**
		 * on (or off) bool to set which cleanups you want to do, or not. use the ez_loader to pass in your own
		 *
		 * @return \stdClass
		 */
		public function hc_defaults(){

			// REF: // http://www.themelab.com/remove-code-wordpress-header

			$obj = new \stdClass();

			// == set a
			$obj->rsd_link = true;
			$obj->wlwmanifest_link = true;
			$obj->index_rel_link = true;
			// WP version
			$obj->wp_generator = true;

			// == set b
			$obj->parent_post_rel_link = true;
			$obj->start_post_rel_link = true;
			$obj->adjacent_posts_rel_link_wp_head = true;
			$obj->wp_shortlink_wp_head = true;

			// -- set c
			$obj->feed_links = true;

			// - set d
			$obj->feed_links_extra = true;

			// set oth
			$obj->wp_ver_modify = true;
			$obj->wp_ver_remove = true;

			return $obj;
		}


		/**
		 * the remove_action() for each set is slightly different but they do fall into groups. this is that mapping
		 *
		 * @return mixed
		 */
		public function set_map(){
			// map the change to the appropriate remove_action method

			//set_a
			$arr_set_map['rsd_link'] = 'a';
			$arr_set_map['wlwmanifest_link'] = 'a';
			$arr_set_map['index_rel_link'] = 'a';
			$arr_set_map['wp_generator'] = 'a';

			// set_b
			$arr_set_map['parent_post_rel_link'] = 'b'; 	// 10, 0
			$arr_set_map['start_post_rel_link'] = 'b';	// 10, 0
			$arr_set_map['adjacent_posts_rel_link_wp_head'] = 'b';	// 10, 0
			$arr_set_map['wp_shortlink_wp_head'] = 'b'; 	// 10, 0

			// set_c
			$arr_set_map['feed_links'] = 'c'; 	// , 2);

			//set_d
			$arr_set_map['feed_links_extra'] = 'd'; 	// ,3);

			// oth
			$arr_set_map['wp_ver_modify'] = 'oth';
			$arr_set_map['wp_ver_remove'] = 'oth';

			return  $arr_set_map;
		}


		/**
		 * Load the obj and stash it while we wait for the action(s) to fire. if an $obj_args isn't passed we use the defaults "as is"
		 *
		 * @param string $obj_args
		 *
		 * @return bool
		 */
		public function ez_loader( $obj_args = '') {

			$this->_obj_loaded = new \stdClass();
			if ( is_object( $obj_args ) ) {
				$this->_obj_loaded = $obj_args;

				return true;
			}
			return false;
		}


		/**
		 * This is where the magic happens.
		 */
		public function ez_head_cleanup() {

			$arr_args = (array) $this->hc_defaults();
			if ( is_object( $this->_obj_loaded )){
				$arr_args = array_merge( (array)$this->hc_defaults(), (array) $this->_obj_loaded );
			} else {
				return;
			}

			foreach ( $arr_args as $str_key => $bool_var ){

				if ( $bool_var === true && isset($this->set_map()[$str_key]) ){

					$str_map_val = $this->set_map()[$str_key];

					/**
					 * - - IMPORTANT - -
					 * if elseif is said to be slight faster than Switch / Case.
					 * Over-optimizing? Perhaps. But better habits are better than bad one, eh? :)
					 */
					if ( $str_map_val == 'a' ){

						remove_action('wp_head', $str_key );

					} elseif ( $str_map_val == 'b' ){

						remove_action('wp_head', $str_key, 10, 0);

					} elseif ( $str_map_val == 'c' ){

						remove_action('wp_head', $str_key, 2 );

					} elseif ( $str_map_val == 'd' ){

						remove_action('wp_head', $str_key, 3 );

					} elseif ( $str_map_val == 'oth' ){

						$this->other($str_key);
					}
				}
			}
		}


		/**
		 * make it ez to add other oth's
		 *
		 * @param string $str_key
		 */
		protected function other($str_key = ''){

			if ( $str_key == 'wp_ver_modify'){
				$this->_bool_ver_modify = true;
				$this->_bool_ver_remove = false;
			} elseif ( $str_key == 'wp_ver_remove'){
				$this->_bool_ver_modify = false;
				$this->_bool_ver_remove = true;
			}
		}

		/**
		 * rather than totally remove the version (which helps the browser) let's just make it a bit more difficult to ID
		 */
		public function wp_ver_modify_css_js( $str_src ) {

			if ( $this->_bool_ver_modify === false && $this->_bool_ver_remove === false ){
				return $str_src;
			}

			if ( strpos( $str_src, 'ver=' ) &&  strpos( $str_src, '/wp-includes/' ) ) {

				if ( $this->_bool_ver_remove === true ){
					// TODO esc_url?
					return remove_query_arg( 'ver', $str_src );
				}
				// TODO esc_url?
				// we'll hash the year so the src ver is still browser cache friendly
				$str_src = str_replace('ver=','ver=' . hash($this->_str_hash_algo, date($this->_hash_date)) .'-', $str_src);
			}
			return $str_src;
		}

	}
}