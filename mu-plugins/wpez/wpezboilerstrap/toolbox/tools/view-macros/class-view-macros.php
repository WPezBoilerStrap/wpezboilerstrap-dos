<?php

namespace WPez\WPezBoilerStrap\Toolbox\Tools;

	/*
	 * More info: http://scotty-t.com/2012/07/09/wp-you-oop/
	 */

// No WP? Die! Now!!
if ( ! defined( 'ABSPATH' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die();
}

if ( ! class_exists( 'View_Macros' ) ) {
	class View_Macros { // extends \WPez\WPezBoilerStrap\Toolbox\Parents\Singleton {

		static protected function alt_text($str_alt_text = ''){

			$str_ret = '';
			if ( ! empty($str_alt_text) && is_string($str_alt_text) ){

				$str_ret = ' alt="' . esc_attr($str_alt_text) . '" ';
			}
			return $str_ret;
		}


		static public function ez_post_title_v1( $mod, $vargs ) {

			$vargs = (object) array_merge( (array) self::ez_post_title_v1_vargs_defaults(), (array) $vargs );

			$str_ret = '';
			if ( $vargs->title_active !== false) {

				$str_ret .= self::element_open( $vargs->title_wrapper_tag, $vargs->title_wrapper_global_attrs );
				$str_ret .= self::element_open( $vargs->title_tag, $vargs->title_global_attrs );

				$str_link_open  = '';
				$str_link_close = '';
				if ( filter_var( $mod->url, FILTER_VALIDATE_URL ) && $vargs->url_active != false ) {

					$str_link_open  = '<a href="' . esc_url( $mod->url ) . '" ' . self::global_attrs( $vargs->url_global_attrs ) . '>';
					$str_link_close = '</a>';
				}

				$str_ret .= $str_link_open;
				$str_ret .= esc_attr( $mod->title );
				$str_ret .= $str_link_close;

				$str_ret .= self::element_close( $vargs->title_tag );
				$str_ret .= self::element_close( $vargs->title_wrapper_tag );
			}
			return $str_ret;
		}

		static protected function ez_post_title_v1_vargs_defaults() {

			$vargs = new \stdClass();

			$vargs->title_active = true;

			$vargs->title_wrapper_tag          = 'span';
			$vargs->title_wrapper_global_attrs = array();
			$vargs->title_tag                  = 'h1';
			$vargs->title_global_attrs         = array(
				'itemprop' => "headline"
			);
			$vargs->url_active                 = true;
			$vargs->url_global_attrs           = array();

			return $vargs;
		}

		static public function ez_post_date_v1( $mod, $vargs ) {

			$vargs = (object) array_merge( (array) self::ez_post_date_v1_vargs_defaults(), (array) $vargs );

			$str_ret              = '';
			if ( $vargs->date_active !== false ) {

				$str_ret .= self::element_open( $vargs->date_wrapper_tag, $vargs->date_wrapper_global_attrs );

				$str_link_open  = '';
				$str_link_close = '';
				if ( filter_var( $mod->url, FILTER_VALIDATE_URL ) && $vargs->url_active != false ) {

					$str_link_open  = '<a href="' . esc_url( $mod->url ) . '" ' . self::global_attrs( $vargs->url_global_attrs ) . '>';
					$str_link_close = '</a>';
				}

				$str_ret .= $str_link_open;

				$str_ret .= self::icon_text(
					$vargs->date_icon_tag,
					$vargs->date_icon_global_attrs,
					$vargs->date_text_tag,
					$vargs->date_text_global_attrs,
					$vargs->date_text );

				$str_ret .= self::element_open( $vargs->post_date_tag, $vargs->post_date_global_attrs );
				$str_ret .= mysql2date( $vargs->date_format, $mod->orig_obj->post_date );
				$str_ret .= self::element_close( $vargs->post_date_tag );

				$str_ret .= '<time ' . self::global_attrs( $vargs->time_post_date_global_attrs ) . ' content="' . get_the_date( $vargs->time_post_date_format, $mod->id ) . '" datetime="' . get_the_date( $vargs->time_post_date_format, $mod->id ) . '">';
				$str_ret .= mysql2date( $vargs->date_format, $mod->orig_obj->post_date );
				$str_ret .= '</time>';

				$str_ret .= '<time ' . self::global_attrs( $vargs->time_post_modified_global_attrs ) . ' content="' . get_the_modified_date( $vargs->time_post_modified_format, $mod->id ) . '" datetime="' . get_the_modified_date( $vargs->time_post_modified_format, $mod->id ) . '">';
				$str_ret .= mysql2date( $vargs->date_format, $mod->orig_obj->post_modified );
				$str_ret .= '</time>';

				$str_ret .= $str_link_close;

				$str_ret .= self::element_close( $vargs->date_wrapper_tag );
			}
			return $str_ret;
		}

		static protected function ez_post_date_v1_vargs_defaults() {

			$vargs = new \stdClass();

			$vargs->date_active = true;
			$vargs->date_wrapper_tag          = 'span';
			$vargs->date_wrapper_global_attrs = array();

			$vargs->url_active                     = true;
			$vargs->url_global_attrs = array();

			$vargs->date_icon_tag             = ''; // 'i'
			$vargs->date_icon_global_attrs = array(); // 'class' => 'fa fa-calendar fa-fw'
			$vargs->date_text_tag             = 'span';
			$vargs->date_text_global_attrs = array();
			$vargs->date_text = 'Published';

			$vargs->post_date_tag             = 'span';
			$vargs->post_date_global_attrs = array();
			$vargs->date_format           = 'F d, Y';

			$vargs->time_post_date_global_attrs = array(
				'class' => 'published',
				'itemprop' => 'datePublished',
			);
			$vargs->time_post_date_format = 'c';
			$vargs->time_post_modified_global_attrs = array(
				'class' => 'modified',
				'itemprop' => 'dateModified',
				);
			$vargs->time_post_modified_format   = 'c';

			return $vargs;
		}

		static public function ez_post_author_v1($mod, $vargs){

			$vargs = (object) array_merge( (array) self::ez_post_author_v1_vargs_defaults(), (array) $vargs );

			$str_ret              = '';
			if ( $vargs->author_active !== false) {

				$str_ret .= self::element_open( $vargs->author_wrapper_tag, $vargs->author_wrapper_global_attrs );

				$str_link_open  = '';
				$str_link_close = '';
				if ( isset( $mod->user->posts_url ) && filter_var( $mod->user->posts_url, FILTER_VALIDATE_URL ) && $vargs->user_posts_url_active != false ) {

					$str_link_open  = '<a href="' . esc_url( $mod->user->posts_url ) . '" ' . self::global_attrs( $vargs->user_posts_url_global_attrs ) . '>';
					$str_link_close = '</a>';
				}

				$str_ret .= $str_link_open;

				$str_ret .= self::icon_text(
					$vargs->author_icon_tag,
					$vargs->author_icon_global_attrs,
					$vargs->author_text_tag,
					$vargs->author_text_global_attrs,
					$vargs->author_text );

				$str_ret .= self::element_open( $vargs->display_name_tag, $vargs->display_name_global_attrs );
				$str_ret .= esc_attr( $mod->user->display_name );
				$str_ret .= self::element_close( $vargs->display_name_tag );

				$str_ret .= $str_link_close;

				$str_ret .= self::element_close( $vargs->author_wrapper_tag );
			}
			return $str_ret;
		}
		

		static protected function ez_post_author_v1_vargs_defaults (){

			$vargs = new \stdClass();

			$vargs->author_active = true;
			$vargs->author_wrapper_tag          = 'span';
			$vargs->author_wrapper_global_attrs = array(
				'itemprop' => 'author',
				'itemscope' => '',
				'itemtype' => 'http://schema.org/Person'
			);

			$vargs->user_posts_url_active = true;
			$vargs->user_posts_url_global_attrs = array();

			$vargs->author_icon_tag             = 'i';
			$vargs->author_icon_global_attrs = array(); // 'class' => 'fa fa-calendar fa-fw'

			$vargs->author_text_tag             = 'span';
			$vargs->author_text_global_attrs = array();
			$vargs->author_text = 'Written by: ';

			$vargs->display_name_tag             = 'span';
			$vargs->display_name_global_attrs = array(
				'itemprop' => 'name'
			);

			return $vargs;
		}

		public static function ez_post_category_v1($mod, $vargs){

			$vargs = (object) array_merge( (array) self::ez_post_category_v1_vargs_defaults(), (array) $vargs );

			if ( $vargs->category_active !== false ) {

				$vargs_term = new \stdClass();

				$vargs_term->term_wrapper_tag          = $vargs->category_wrapper_tag;
				$vargs_term->term_wrapper_global_attrs = $vargs->category_wrapper_global_attrs;

				$vargs_term->term_icon_tag          = $vargs->category_icon_tag;
				$vargs_term->term_icon_global_attrs = $vargs->category_icon_global_attrs;

				$vargs_term->term_text_tag          = $vargs->category_text_tag;
				$vargs_term->term_text_global_attrs = $vargs->category_text_global_attrs;
				$vargs_term->term_text              = $vargs->category_text;

				$vargs_term->term_implode_glue = $vargs->category_implode_glue;

				if ( isset( $mod->terms->category ) ) {
					return self::ez_post_term_v1( $mod->terms->category, $vargs_term );
				}
			}
			return '';
		}

		protected static function ez_post_category_v1_vargs_defaults(){

			$vargs = new \stdClass();

			$vargs->category_active = true;
			$vargs->category_wrapper_tag = 'span';
			$vargs->category_wrapper_global_attrs = array(
				'itemprop' => 'articleSection'
			);

			$vargs->category_icon_tag = 'i';
			$vargs->category_icon_global_attrs = array();
			$vargs->category_text_tag = 'span';
			$vargs->category_text_global_attrs = array();
			$vargs->category_text = 'Category: ';

			$vargs->category_implode_glue = ', ';
			
			return $vargs;
		}

		public static function ez_post_post_tag_v1($mod, $vargs){

			$vargs = (object) array_merge( (array) self::ez_post_post_tag_v1_vargs_defaults(), (array) $vargs );

			if ( $vargs->post_tag_active !== false ) {

				$vargs_term = new \stdClass();

				$vargs_term->term_wrapper_tag          = $vargs->post_tag_wrapper_tag;
				$vargs_term->term_wrapper_global_attrs = $vargs->post_tag_wrapper_global_attrs;

				$vargs_term->term_icon_tag          = $vargs->post_tag_icon_tag;
				$vargs_term->term_icon_global_attrs = $vargs->post_tag_icon_global_attrs;

				$vargs_term->term_text_tag          = $vargs->post_tag_text_tag;
				$vargs_term->term_text_global_attrs = $vargs->post_tag_text_global_attrs;
				$vargs_term->term_text              = $vargs->post_tag_text;

				$vargs_term->term_implode_glue = $vargs->post_tag_implode_glue;

				if ( isset( $mod->terms->category ) ) {
					return self::ez_post_term_v1( $mod->terms->post_tag, $vargs_term );
				}
			}
			return '';
		}

		protected static function ez_post_post_tag_v1_vargs_defaults(){

			$vargs = new \stdClass();

			$vargs->post_tag_active = true;
			$vargs->post_tag_wrapper_tag = 'span';
			$vargs->post_tag_wrapper_global_attrs = array(
				'itemprop' => 'keywords'
			);

			$vargs->post_tag_icon_tag = 'i';
			$vargs->post_tag_icon_global_attrs = array();

			$vargs->post_tag_text_tag = 'span';
			$vargs->post_tag_text_global_attrs = array();
			$vargs->post_tag_text = 'Tags: ';

			$vargs->post_tag_implode_glue = ', ';

			return $vargs;
		}



		public static function ez_post_term_v1( $arr_mod_term, $vargs_term){

			$vargs = (object) array_merge( (array) self::ez_post_term_vargs_defaults(), (array) $vargs_term );

			$str_ret              = '';
			$str_ret .= self::element_open( $vargs->term_wrapper_tag, $vargs->term_wrapper_global_attrs );

			$str_ret .= self::icon_text(
				$vargs->term_icon_tag,
				$vargs->term_icon_global_attrs,
				$vargs->term_text_tag,
				$vargs->term_text_global_attrs,
				$vargs->term_text );

			$arr_to_implode = array();
			if ( is_array($arr_mod_term) ) {
				foreach ( $arr_mod_term as $key => $obj ) {
					//   <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
					$str_link = '<a href="' . esc_url( $obj->url ) . '"';
					$str_link .= self::global_attrs( $obj->global_attrs ) . '>';
					$str_link .= esc_attr( $obj->anchor_text );
					$str_link .= '</a>'; // list close

					$arr_to_implode[] = $str_link;
				}
			}

			$str_ig = '';
			if ( isset($vargs->term_implode_glue) ) {
				$str_ig = esc_attr( $vargs->term_implode_glue );
			}
			$str_implode = implode($str_ig, $arr_to_implode);

			$str_ret .= $str_implode;
			$str_ret .= self::element_close( $vargs->term_wrapper_tag );

			return $str_ret;

		}


		public static function ez_post_term_vargs_defaults(){

			$vargs = new \stdClass();

			$vargs->term_wrapper_tag = 'span';
			$vargs->term_wrapper_global_attrs = array();

			$vargs->term_icon_tag = 'i';
			$vargs->term_icon_global_attrs = array();
			$vargs->term_text_tag = 'span';
			$vargs->term_text_global_attrs = array();

			$vargs->implode_glue = ', ';

			return $vargs;
		}


		public static function ez_post_post_excerpt_v1($mod, $vargs){

			$str_ret = '';
			if ( isset($mod->orig_obj->post_excerpt) && ! empty($mod->orig_obj->post_excerpt) ){

				$vargs = (object) array_merge( (array) self::ez_post_post_excerpt_v1_vargs_defaults(), (array) $vargs );
				if ( $vargs->excerpt_active !== false ) {
					$str_ret .= self::element_open( $vargs->excerpt_wrapper_tag, $vargs->excerpt_wrapper_global_attrs );
					$str_ret .= self::element_open( $vargs->excerpt_tag, $vargs->excerpt_global_attrs );

					$str_ret .= esc_attr( $mod->orig_obj->post_excerpt );

					$str_ret .= self::element_close( $vargs->excerpt_tag );
					$str_ret .= self::element_close( $vargs->excerpt_wrapper_tag );
				}
			}
			return $str_ret;

		}

		protected static function  ez_post_post_excerpt_v1_vargs_defaults(){

			$vargs = new \stdClass();
			$vargs->excerpt_active = true;
			$vargs->excerpt_wrapper_tag = 'span';
			$vargs->excerpt_wrapper_global_attrs = array();
			$vargs->excerpt_tag = 'h2';
			$vargs->excerpt_global_attrs = array(
				'itemprop' => 'description'
			);

			return $vargs;
		}

		public static function ez_post_post_content_v1($mod, $vargs){

			$str_ret = '';

			if ( isset($mod->orig_obj->post_content) ){

				$vargs = (object) array_merge( (array) self::ez_post_post_content_v1_vargs_defaults(), (array) $vargs );

				if ( $vargs->content_active !== false ) {

					$str_ret .= self::element_open( $vargs->content_wrapper_tag, $vargs->content_wrapper_global_attrs );
					$str_ret .= self::element_open( $vargs->content_tag, $vargs->content_global_attrs );

					$str_ret .= wp_kses_post( $mod->orig_obj->post_content );

					$str_ret .= self::element_close( $vargs->content_tag );
					$str_ret .= self::element_close( $vargs->content_wrapper_tag );
				}
			}
			return $str_ret;

		}

		protected static function  ez_post_post_content_v1_vargs_defaults(){

			$vargs = new \stdClass();
			$vargs->content_active = true;
			$vargs->content_wrapper_tag = 'span';
			$vargs->content_wrapper_global_attrs = array();
			$vargs->content_tag = 'span';
			$vargs->content_global_attrs = array(
				'itemprop' => 'articleBody'
			);

			return $vargs;
		}

		


		static public function icon_text( $icon_tag = false, $icon_gattrs = array(), $text_tag = false, $text_gattrs = array(), $str_text = '' ) {

			$str_ret = '';

			$str_ret .= self::element_open( $icon_tag, $icon_gattrs );
			$str_ret .= self::element_close( $icon_tag );

			if ( ! empty( $str_text ) ) {
				$str_ret .= self::element_open( $text_tag, $text_gattrs );
				$str_ret .= esc_attr( $str_text );
				$str_ret .= self::element_close( $text_tag );
			}
			return $str_ret;
		}


		/**
		 * @param string $obj_vargs
		 *
		 * @return bool
		 */
		static function enclose( $obj_vargs = '', $bool_enclose = true ) {

			/*
			 * every view can have an enclose (i.e., semantic wrapper* and a wrapper nested within that).
			 * (1) this standarizes it. it's (almost) always there. we can count on being
			 *     able to customize an enclose for any given a view
			 * (2) it's one less thing for the view dev to worry about.
			 * (3) that is, it "forces" the view to be as minimal as possible. beyond that,
			 *     the enclose_setup() takes care of what is (almost) always there.
			 */

			$arr_enclose = array( 'semantic', 'view_wrapper' );

			$obj_ret = new \stdClass();

			$obj_ret->semantic_open      = '';
			$obj_ret->semantic_close     = '';
			$obj_ret->view_wrapper_open  = '';
			$obj_ret->view_wrapper_close = '';

			// does the view not allow an encloses?
			if ( $bool_enclose === false || ! is_object( $obj_vargs ) ) {
				return $obj_ret;
			}

			if ( isset( $obj_vargs->enclose ) && is_object( $obj_vargs->enclose ) && ( ! isset( $obj_vargs->enclose->active ) || ( isset( $obj_vargs->enclose->active ) && $obj_vargs->enclose->active !== false ) ) ) {

				$obj_enc = $obj_vargs->enclose;
				foreach ( $arr_enclose as $key => $str_val ) {

					$str_val    = trim( $str_val );
					$str_active = trim( $str_val ) . '_active';

					if ( ! isset( $obj_enc->$str_active ) || $obj_enc->$str_active !== false ) {

						$str_tag  = $str_val . '_tag';
						$str_gats = $str_val . '_global_attrs';

						// set the properties for this enclose value
						$str_open            = $str_val . '_open';
						$str_close           = $str_val . '_close';
						$obj_ret->$str_open  = self::element_open( $obj_enc->$str_tag, $obj_enc->$str_gats );
						$obj_ret->$str_close = self::element_close( $obj_enc->$str_tag );
					}
				}
			}

			return $obj_ret;
		}


		/**
		 * ref: https://developer.mozilla.org/en-US/docs/Web/HTML/Global_attributes
		 *
		 * @param string $arr
		 *
		 * @return string
		 */
		static public function global_attrs( $arr = '' ) {

			$str_ret = '';
			if ( is_array( $arr ) ) {
				$arr_temp = array();
				foreach ( $arr as $key => $val ) {
					$esc_key = esc_attr( $key );
					$esc_val = esc_attr( $val );
					//TODO - add test for supported attrs
					if ( ! empty( $esc_key ) && ! empty( $esc_val ) ) {
						$arr_temp[] = $esc_key . '="' . $esc_val . '"';
					} elseif ( $esc_key = 'itemscope' ) {
						$arr_temp[] = 'itemscope';
					}
				}
				$str_ret = implode( " ", $arr_temp );
				if ( ! empty( $str_ret ) ) {
					// we'll "force" a leading ' ' since that's probably the usual need. it can be trimmed later
					$str_ret = ' ' . $str_ret;
				}
			}

			return $str_ret;
		}

		// TODO:
		static public function global_attrs_supported() {
		}


		/**
		 * @param string $str_ele
		 * @param string $arr_gats
		 * @param bool $mix_validation << TODO
		 *
		 * @return string
		 */
		static public function element_open( $str_ele = '', $arr_gats = '', $mix_validation = false ) {

			$str_ele_esc = esc_attr( $str_ele );

			$str_ret = '';
			// TODO - element tag validation?
			if ( ! empty( $str_ele_esc ) ) {
				$str_gats = self::global_attrs( $arr_gats );
				$str_ret .= '<' . $str_ele_esc . $str_gats . '>';
			}

			return $str_ret;
		}

		// TODO - HTML tags supported
		static public function element_open_supported() {
		}

		/**
		 * @param string $str_ele
		 * @param string $arr_gats
		 * @param bool $mix_validation
		 *
		 * @return string
		 */
		static public function element_close( $str_ele = '', $arr_gats = '', $mix_validation = false ) {

			$str_ele_esc = esc_attr( $str_ele );

			$str_ret = '';
			// TODO - element tag validation?

			if ( ! empty( $str_ele_esc ) ) {
				$str_ret .= '</' . $str_ele_esc . '>';
			}

			return $str_ret;
		}

	}
}