<?php

/**
 * All the good add_theme_support things wrapped up in one
 *
 * Ref - http://codex.wordpress.org/add_theme_support
 */

namespace WPezTheme\Scaffolding;

if ( ! class_exists( 'Theme_Support_Args' ) ) {
	class Theme_Support_Args {

		public function __construct() {
		}

		public function get( $str = 'args' ) {
			if ( $str == 'args' ) {
				return $this->args();
			}
		}

		protected function args() {

			$arr = array();

			$arr['post_formats'] = $this->post_formats( false );

			$arr['post_thumbnail'] = $this->post_thumbnail( true);

			$arr['custom_background'] = $this->custom_background( false );

			$arr['custom_header'] = $this->custom_header( false );

			$arr['custom_logo'] = $this->custom_logo( false );

			$arr['automatic_feed_links'] = $this->automatic_feed_links( false );

			$arr['html5'] = $this->html5( true );

			$arr['title_tag'] = $this->title_tag( true );

			$arr['aesop'] = $this->aesop( false );

			return $arr;
		}

		protected function post_formats( $bool_active = true ) {

			/**
			 * http://codex.wordpress.org/add_theme_support#Post_Formats
			 *
			 * http://codex.wordpress.org/Post_Formats
			 */
			$obj = new \stdClass();

			$obj->active    = $bool_active;
			$obj->feature   = 'post-formats';
			$obj->args_type = 'active_bool';    // 'value_pairs', 'active_bool', 'none'
			$obj->args      = array(
				'aside'   => false,
				'gallery' => false,
				'link'    => false,
				'image'   => false,
				'quote'   => false,
				'status'  => false,
				'video'   => false,
				'audio'   => false,
				'chat'    => false
			);

			return $obj;
		}


		protected function post_thumbnail( $bool_active = true ) {
			/**
			 * http://codex.wordpress.org/add_theme_support#Post_Thumbnails
			 *
			 * -- "be aware that add_theme_support( 'post-formats' ) will override the formats as defined by the parent theme, not add to it."
			 * -- "This feature must be called before the init hook is fired. That means it needs to be placed directly into functions.php or within a function attached to the 'after_setup_theme' hook."
			 * -- "For custom post types, you can also add post thumbnails using the register_post_type function as well."
			 *
			 * http://codex.wordpress.org/Post_Thumbnails
			 *
			 * ----
			 * re: 'args' - if we specify which post_types to support then it will only support those post_types. this
			 * also means that custom CPTs might get mucked up
			 */
			$obj = new \stdClass();

			$obj->active    = $bool_active;
			$obj->feature   = 'post-thumbnails';
			$obj->args_type = 'active_bool';
			$obj->args      = array(
				//'post'			=> true,
				//'page'			=> true,
				//	'custom_cpt_1'	=> false,
				//	'custom_cpt_2'	=> false
			);

			return $obj;
		}


		protected function custom_background( $bool_active = true ) {
			/**
			 * http://codex.wordpress.org/add_theme_support#Custom_Background
			 *
			 * http://codex.wordpress.org/Custom_Backgrounds
			 */
			$obj = new \stdClass();

			$obj->active    = $bool_active;
			$obj->feature   = 'custom-background';
			$obj->args_type = 'value_pairs';
			$obj->args      = array(
				'default-color'          => '',
				'default-image'          => '',
				'wp-head-callback'       => '_custom_background_cb',
				'admin-head-callback'    => '',
				'admin-preview-callback' => ''
			);

			return $obj;
		}

		protected function custom_header( $bool_active = true ) {
			/**
			 * http://codex.wordpress.org/add_theme_support#Custom_Header
			 *
			 * http://codex.wordpress.org/Custom_Headers
			 */
			$obj = new \stdClass();

			$obj->active    = $bool_active;
			$obj->feature   = 'custom-header';
			$obj->args_type = 'value_pairs';
			$obj->args      = array(
				'default-image'          => '',
				'random-default'         => false,
				'width'                  => 0,
				'height'                 => 0,
				'flex-height'            => false,
				'flex-width'             => false,
				'default-text-color'     => '',
				'header-text'            => true,
				'uploads'                => true,
				'wp-head-callback'       => '',
				'admin-head-callback'    => '',
				'admin-preview-callback' => ''
			);

			return $obj;
		}


		protected function custom_logo( $bool_active = true ) {

			/**
			 * http://codex.wordpress.org/Function_Reference/add_theme_support#Custom_Logo
			 */
			$obj = new \stdClass();

			$obj->active    = $bool_active;
			$obj->feature   = 'custom-logo';
			$obj->args_type = 'value_pairs';
			$obj->args      = array(
				'height'      => 100,
				'width'       => 400,
				'flex-height' => true,
				'flex-width'  => true,
				'header-text' => array( 'site-title', 'site-description' ),
			);

			return $obj;
		}


		protected function automatic_feed_links( $bool_active = true ) {
			/**
			 * http://codex.wordpress.org/add_theme_support#Feed_Links
			 */
			$obj = new \stdClass();

			$obj->active    = $bool_active;
			$obj->feature   = 'automatic-feed-links';
			$obj->args_type = 'none';

			return $obj;
		}

		protected function html5( $bool_active = true ) {

			/**
			 * http://codex.wordpress.org/add_theme_support#HTML5
			 */
			$obj = new \stdClass();

			$obj->active    = $bool_active;
			$obj->feature   = 'html5';
			$obj->args_type = 'active_bool';
			$obj->args      = array(
				'comment-list' => true,
				'comment-form' => true,
				'search-form'  => true,
				'gallery'      => true,
				'caption'      => true,
			);

			return $obj;
		}

		protected function title_tag( $bool_active = true ) {
			/**
			 * http://codex.wordpress.org/add_theme_support#Title_Tag
			 */
			$obj = new \stdClass();

			$obj->active    = $bool_active;
			$obj->feature   = 'title-tag';
			$obj->args_type = 'none';

			return $obj;
		}


		protected function aesop( $bool_active = true ) {
			/**
			 * http://aesopstoryengine.com/developers/
			 */

			// TODO add define(�AI_CORE_UNSTYLED�,true); + This might be out of date. Check aesop.

			$obj = new \stdClass();

			$obj->active    = $bool_active;
			$obj->feature   = 'aesop-component-styles';
			$obj->args_type = 'value_pairs'; // 'value_pairs', 'active_bool', 'none'
			$obj->args      = array(
				'parallax'   => true,
				'image'      => true,
				'quote'      => true,
				'gallery'    => true,
				'content'    => true,
				'video'      => true,
				'audio'      => true,
				'collection' => true,
				'chapter'    => true,
				'document'   => true,
				'character'  => true,
				'map'        => true,
				'timeline'   => true
			);

			return $obj;
		}

	}
}
