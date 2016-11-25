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


		public static function ez_post_img_v1( $mod, $vargs ) {

			$str_ret = '';
			if ( ! isset( $vargs->img_active ) || ( isset( $vargs->img_active ) && $vargs->img_active !== false ) ) {

				// what is being requested
				$str_vargs_img_type = 'min';
				if (isset($vargs->img_type) ){
					$str_vargs_img_type = strtolower(trim($vargs->img_type));
				}
				$int_vargs_img_type = self::img_level($str_vargs_img_type);

				// what img_type is on the $mod->img
				$str_img_type = 'min';
				if (isset($mod->img->img_type) ){
					$str_img_type = strtolower(trim($mod->img->img_type));
				}
				$int_img_type = self::img_level($str_img_type);

				// based on the above, test to see which "level" of img we could / should provide
				if ( $int_vargs_img_type <= $int_img_type ){
					// TODO - allow the vargs to specify the v#
					$str_method = 'ez_post_img_' . $str_vargs_img_type . '_v1';
					if ( method_exists(get_class(), $str_method) ){
						return self::$str_method($mod, $vargs);
					}
				} else {
					$str_method = 'ez_post_img_' . $str_img_type . '_v1';
					if ( method_exists(get_class(), $str_method) ){
						return self::$str_method($mod, $vargs);
					}
				}
				// if nothing happened (e.g., method didn't exist) then default to min
				return self::ez_post_img_min_v1( $mod, $vargs );

			}
			return $str_ret;
		}

		protected static function img_level($str_type = 'min'){

			switch ($str_type){
				case 'min':
					return 10;
				case 'max':
					return 20;
				case 'all':
					return 100;
				default:
					return 10;
			}
		}

		// TODO - Add url wrapper to image.
		public static function ez_post_img_min_v1( $mod, $vargs ) {

			$vargs = (object) array_merge( (array) self::ez_post_img_v1_vargs_defaults(), (array) $vargs );

			$str_ret = '';
			if ( isset( $mod->img ) && ! empty( $mod->img->url ) ) {

				$str_ret .= self::element_open( $vargs->img_wrapper_tag, $vargs->img_wrapper_global_attrs );

				$arr_alt = array('alt' => $mod->title);
				$arr_img_global_attrs = array_merge( $arr_alt, (array)$vargs->img_global_attrs );

				$str_ret .= '<figure>';
				$str_ret .= '<img src="' . esc_url( $mod->img->url ) . '" ' . self::global_attrs($arr_img_global_attrs). '>';
				$str_ret .= '</figure>';

				$str_ret .= self::element_close( $vargs->img_wrapper_tag );
			}

			return $str_ret;
		}

		// TODO
		public static function ez_post_img_max_v1( $mod, $vargs ) {
			echo '<h3>TODO - ez_post_img_max_v1</h3>';

			return self::ez_post_img_min_v1( $mod, $vargs );
		}

		// TODO
		public static function ez_post_img_all_v1( $mod, $vargs ) {

			echo '<h3>TODO - ez_post_img_all_v1</h3>';

			return self::ez_post_img_min_v1( $mod, $vargs );
		}


		protected static function ez_post_img_v1_vargs_defaults() {

			$vargs = new \stdClass();

			$vargs->img_active               = true;
			$vargs->img_wrapper_tag          = 'span';
			$vargs->img_wrapper_global_attrs = array(
				'class' => 'ez-post-img-wrapper'
			);

			$vargs->img_global_attrs = array(
				'class' => 'img-responsive ez-post-img-wrapper__img',
				// 'alt' => false   // use this to override the default alt =
			);

			return $vargs;
		}



		public static function ez_post_title_v1( $mod, $vargs ) {

			$vargs = (object) array_merge( (array) self::ez_post_title_v1_vargs_defaults(), (array) $vargs );

			$str_ret = '';
			if ( $vargs->title_active !== false ) {

				$str_ret .= self::element_open( $vargs->title_wrapper_tag, $vargs->title_wrapper_global_attrs );
				$str_ret .= self::element_open( $vargs->title_tag, $vargs->title_global_attrs );

				$str_link_open  = '';
				$str_link_close = '';
				if ( isset($mod->url) && filter_var( $mod->url, FILTER_VALIDATE_URL ) && $vargs->url_active != false ) {

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


		protected static function ez_post_title_v1_vargs_defaults() {

			$vargs = new \stdClass();

			$vargs->title_active = true;

			$vargs->title_wrapper_tag          = 'div';
			$vargs->title_wrapper_global_attrs = array(
				'class' => 'ez-post-title-wrapper'
			);
			$vargs->title_tag                  = 'h1';
			$vargs->title_global_attrs         = array(
				'itemprop' => 'headline'
			);
			$vargs->url_active                 = true;
			$vargs->url_global_attrs           = array(
				'rel' => 'bookmark'
			);

			return $vargs;
		}

		public static function ez_post_date_v1( $mod, $vargs ) {

			$vargs = (object) array_merge( (array) self::ez_post_date_v1_vargs_defaults(), (array) $vargs );

			$str_ret = '';
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

		protected static function ez_post_date_v1_vargs_defaults() {

			$vargs = new \stdClass();

			$vargs->date_active               = true;
			$vargs->date_wrapper_tag          = 'span';
			$vargs->date_wrapper_global_attrs = array(
				'class' => 'ez-post-date-wrapper'
			);

			$vargs->url_active       = true;
			$vargs->url_global_attrs = array();

			$vargs->date_icon_tag          = false; // 'i'
			$vargs->date_icon_global_attrs = array(); // 'class' => 'fa fa-calendar fa-fw'
			$vargs->date_text_tag          = 'span';
			$vargs->date_text_global_attrs = array(
				'class' => 'ez-screen-reader-text'
			);
			$vargs->date_text              = 'Published: ';

			$vargs->post_date_tag          = 'span';
			$vargs->post_date_global_attrs = array();
			$vargs->date_format            = 'F d, Y';

			$vargs->time_post_date_global_attrs     = array(
				'class'    => 'ez-post-date-wrapper__date-published',
				'itemprop' => 'datePublished',
			);
			$vargs->time_post_date_format           = 'c';
			$vargs->time_post_modified_global_attrs = array(
				'class'    => 'ez-post-date-wrapper__date-modified',
				'itemprop' => 'dateModified',
			);
			$vargs->time_post_modified_format       = 'c';

			return $vargs;
		}

		public static function ez_post_author_v1( $mod, $vargs ) {

			$vargs = (object) array_merge( (array) self::ez_post_author_v1_vargs_defaults(), (array) $vargs );

			$str_ret = '';
			if ( $vargs->author_active !== false ) {

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


		// TODO - Make the authod a post_link
		protected static function ez_post_author_v1_vargs_defaults() {

			$vargs = new \stdClass();

			$vargs->author_active               = true;
			$vargs->author_wrapper_tag          = 'span';
			$vargs->author_wrapper_global_attrs = array(
				'class'     => 'ez-post-author-wrapper',
				'itemprop'  => 'author',
				'itemscope' => '',
				'itemtype'  => 'http://schema.org/Person'
			);

			$vargs->user_posts_url_active       = true;
			$vargs->user_posts_url_global_attrs = array();

			$vargs->author_icon_tag          = false;
			$vargs->author_icon_global_attrs = array(); // 'class' => 'fa fa-calendar fa-fw'

			$vargs->author_text_tag          = 'span';
			$vargs->author_text_global_attrs = array(
				'class' => 'ez-post-author-wrapper__author-text'
			);
			$vargs->author_text              = 'Written by: ';

			$vargs->display_name_tag          = 'span';
			$vargs->display_name_global_attrs = array(
				'class'    => 'ez-post-author-wrapper__author-display-name',
				'itemprop' => 'name'
			);

			return $vargs;
		}

		public static function ez_post_category_v1( $mod, $vargs ) {

			$vargs = (object) array_merge( (array) self::ez_post_category_v1_vargs_defaults(), (array) $vargs );

			if ( $vargs->category_active !== false ) {

				$vargs_term = new \stdClass();

				$vargs_term->term_active = $vargs->category_active;
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

		protected static function ez_post_category_v1_vargs_defaults() {

			$vargs = new \stdClass();

			$vargs->category_active               = true;
			$vargs->category_wrapper_tag          = 'span';
			$vargs->category_wrapper_global_attrs = array(
				'class'    => 'ez-post-category-wrapper ez-post-term-wrapper',
				'itemprop' => 'articleSection'
			);

			$vargs->category_icon_tag          = false;
			$vargs->category_icon_global_attrs = array();
			$vargs->category_text_tag          = 'span';
			$vargs->category_text_global_attrs = array();
			$vargs->category_text              = 'Category: ';

			$vargs->category_implode_glue = ', ';

			return $vargs;
		}

		public static function ez_post_post_tag_v1( $mod, $vargs ) {

			$vargs = (object) array_merge( (array) self::ez_post_post_tag_v1_vargs_defaults(), (array) $vargs );

			if ( $vargs->post_tag_active !== false ) {

				$vargs_term = new \stdClass();

				$vargs_term->term_active = $vargs->post_tag_active;
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

		protected static function ez_post_post_tag_v1_vargs_defaults() {

			$vargs = new \stdClass();

			$vargs->post_tag_active               = true;
			$vargs->post_tag_wrapper_tag          = 'span';
			$vargs->post_tag_wrapper_global_attrs = array(
				'class'    => 'ez-post-post-tag-wrapper ez-post-term-wrapper',
				'itemprop' => 'keywords'
			);

			$vargs->post_tag_icon_tag          = false;
			$vargs->post_tag_icon_global_attrs = array();

			$vargs->post_tag_text_tag          = 'span';
			$vargs->post_tag_text_global_attrs = array();
			$vargs->post_tag_text              = 'Tags: ';

			$vargs->post_tag_implode_glue = ', ';

			return $vargs;
		}


		public static function ez_post_term_v1( $arr_mod_term, $vargs_term ) {

			$vargs = (object) array_merge( (array) self::ez_post_term_vargs_defaults(), (array) $vargs_term );

			$str_ret = '';
			if ( $vargs->term_active !== false ) {

				$str_ret .= self::element_open( $vargs->term_wrapper_tag, $vargs->term_wrapper_global_attrs );

				$str_ret .= self::icon_text(
					$vargs->term_icon_tag,
					$vargs->term_icon_global_attrs,
					$vargs->term_text_tag,
					$vargs->term_text_global_attrs,
					$vargs->term_text );

				$arr_to_implode = array();
				if ( is_array( $arr_mod_term ) ) {
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
				if ( isset( $vargs->term_implode_glue ) ) {
					$str_ig = esc_attr( $vargs->term_implode_glue );
				}
				$str_implode = implode( $str_ig, $arr_to_implode );

				$str_ret .= $str_implode;
				$str_ret .= self::element_close( $vargs->term_wrapper_tag );
			}
			return $str_ret;

		}


		public static function ez_post_term_vargs_defaults() {

			$vargs = new \stdClass();

			$vargs->term_active = true;
			$vargs->term_wrapper_tag          = 'span';
			$vargs->term_wrapper_global_attrs = array();

			$vargs->term_icon_tag          = false;
			$vargs->term_icon_global_attrs = array();
			$vargs->term_text_tag          = 'span';
			$vargs->term_text_global_attrs = array();

			$vargs->implode_glue = ', ';

			return $vargs;
		}


		public static function ez_post_post_excerpt_v1( $mod, $vargs ) {

			$str_ret = '';
			if ( isset( $mod->orig_obj->post_excerpt ) && ! empty( $mod->orig_obj->post_excerpt ) ) {

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

		protected static function ez_post_post_excerpt_v1_vargs_defaults() {

			$vargs                               = new \stdClass();

			$vargs->excerpt_active               = true;
			$vargs->excerpt_wrapper_tag          = 'span';
			$vargs->excerpt_wrapper_global_attrs = array(
				'class' => 'ez-post-post-excerpt-wrapper'
			);
			$vargs->excerpt_tag                  = 'h2';
			$vargs->excerpt_global_attrs         = array(
				'itemprop' => 'description'
			);

			return $vargs;
		}



		public static function ez_post_read_more_v1( $mod, $vargs ) {

			$vargs = (object) array_merge( (array) self::ez_post_read_more_v1_vargs_defaults(), (array) $vargs );

			if ( $vargs->read_more_active !== false ) {

				$rm_mod        = new \stdClass();
				$rm_mod->url   = $mod->url;
				$rm_mod->title = $mod->title;

				$rm_vargs = new \stdClass();

				$rm_vargs->link_active               = $vargs->read_more_active;
				$rm_vargs->link_wrapper_tag          = $vargs->read_more_wrapper_tag;
				$rm_vargs->link_wrapper_global_attrs = array(
					'class' => 'ez-post-read-more-wrapper'
				);
				$rm_vargs->link_title_text           = $vargs->read_more_title_text;
				$rm_vargs->link_global_attrs         = $vargs->read_more_global_attrs;
				$rm_vargs->link_text                 = $vargs->read_more_text;
				$rm_vargs->link_icon_location        = $vargs->read_more_icon_location; // 'before' 'after'
				$rm_vargs->link_icon_tag                 = $vargs->read_more_icon_tag;
				$rm_vargs->link_icon_global_attrs        = $vargs->read_more_icon_global_attrs;

				return self::ez_post_link_v1($rm_mod, $rm_vargs);

			}
			return '';
		}

		protected static function ez_post_read_more_v1_vargs_defaults() {

			$vargs = new \stdClass();

			$vargs->read_more_active               = true;
			$vargs->read_more_wrapper_tag          = 'span';
			$vargs->read_more_wrapper_global_attrs = array(
				'class' => 'ez-post-read-more-wrapper'
			);
			$vargs->read_more_title_text           = 'Read article: ';
			$vargs->read_more_global_attrs         = array();
			$vargs->read_more_text                 = 'Read More';
			$vargs->read_more_icon_location        = false; // 'before' 'after'
			$vargs->read_more_icon_tag             = 'i';
			$vargs->read_more_icon_global_attrs    = array();

			return $vargs;
		}



		public static function ez_post_edit_v1( $mod, $vargs ) {

			$vargs = (object) array_merge( (array) self::ez_post_edit_v1_vargs_defaults(), (array) $vargs );

			if ( $vargs->edit_active !== false ) {

				if ( ! $edit_url = get_edit_post_link( $mod->ID ) ) {
					return '';
				}

				$rm_mod        = new \stdClass();
				$rm_mod->url   = $edit_url;
				$rm_mod->title = $mod->title;

				$rm_vargs = new \stdClass();

				$rm_vargs->link_active               = $vargs->edit_active;
				$rm_vargs->link_wrapper_tag          = $vargs->edit_wrapper_tag;
				$rm_vargs->link_wrapper_global_attrs = array(
					'class' => 'ez-post-edit-wrapper'
				);
				$rm_vargs->link_title_text           = $vargs->edit_title_text;
				$rm_vargs->link_global_attrs         = $vargs->edit_global_attrs;
				$rm_vargs->link_text                 = $vargs->edit_text;
				$rm_vargs->link_icon_location        = $vargs->edit_icon_location; // 'before' 'after'
				$rm_vargs->link_icon_tag                 = $vargs->edit_icon_tag;
				$rm_vargs->link_icon_global_attrs        = $vargs->edit_icon_global_attrs;

				return self::ez_post_link_v1($rm_mod, $rm_vargs);

			}
			return '';
		}

		protected static function ez_post_edit_v1_vargs_defaults() {

			$vargs = new \stdClass();

			$vargs->edit_active               = true;
			$vargs->edit_wrapper_tag          = 'span';
			$vargs->edit_wrapper_global_attrs = array(
				'class' => 'ez-post-edit-wrapper'
			);
			$vargs->edit_title_text           = 'Edit article: ';
			$vargs->edit_global_attrs         = array();
			$vargs->edit_text                 = 'Edit This';
			$vargs->edit_icon_location        = false; // 'before' 'after'
			$vargs->edit_icon_tag             = 'i';
			$vargs->edit_icon_global_attrs    = array();

			return $vargs;
		}

		public static function ez_post_comment_v1( $mod, $vargs){
			return '<h6>TODO - Comments Link</h6>';
		}



		/**
		 * @param $mod
		 * @param $vargs
		 *
		 * @return string
		 */
		public static function ez_post_link_v1( $mod, $vargs ) {

			$vargs = (object) array_merge( (array) self::ez_post_link_v1_vargs_defaults(), (array) $vargs );

			$str_ret = '';
			if ( $vargs->link_active !== false ) {

				$str_icon_before = '';
				$str_icon_after  = '';
				if ( $vargs->link_icon_location == 'before' || $vargs->link_icon_location == 'after' ) {

					$str_icon = self::element_open( $vargs->link_icon_tag, $vargs->link_icon_global_attrs );
					$str_icon .= self::element_close( $vargs->link_icon_tag );

					if ( $vargs->link_icon_location == 'before' && ! empty( $str_icon ) ) {
						$str_icon_before = $str_icon;
					} elseif ( ! empty( $str_icon ) ) {
						$str_icon_after = $str_icon;
					}
				}

				$str_ret .= self::element_open( $vargs->link_wrapper_tag, $vargs->link_wrapper_global_attrs );

				$arr_global_attrs = array_merge(array('title' => $vargs->link_title_text . $mod->title), (array) $vargs->link_global_attrs);

				$str_ret .= '<a href="' . esc_url( $mod->url ) . '" ' . self::global_attrs( $arr_global_attrs ) . '>';
				$str_ret .= $str_icon_before;
				$str_ret .= esc_attr( $vargs->link_text );
				$str_ret .= $str_icon_after;
				$str_ret .= '</a>';

				$str_ret .= self::element_close( $vargs->link_wrapper_tag );
			}

			return $str_ret;

		}

		protected static function ez_post_link_v1_vargs_defaults() {

			$vargs = new \stdClass();

			$vargs->link_active               = true;
			$vargs->link_wrapper_tag          = 'span';
			$vargs->link_wrapper_global_attrs = array(
				'class' => 'ez-post-link'
			);
			$vargs->link_title_text           = 'Link Title Text ';
			$vargs->link_global_attrs         = array();
			$vargs->link_text                 = 'Link Text';
			$vargs->link_icon_location        = false; // 'before' 'after'
			$vargs->link_icon_tag             = 'i';
			$vargs->link_icon_global_attrs    = array();

			return $vargs;
		}


		public static function ez_post_post_content_v1( $mod, $vargs ) {

			$str_ret = '';

			if ( isset( $mod->orig_obj->post_content ) ) {

				$vargs = (object) array_merge( (array) self::ez_post_post_content_v1_vargs_defaults(), (array) $vargs );

				if ( $vargs->content_active !== false ) {

					$str_ret .= self::element_open( $vargs->content_wrapper_tag, $vargs->content_wrapper_global_attrs );
					$str_ret .= self::element_open( $vargs->content_tag, $vargs->content_global_attrs );

					$str_ret .= wp_kses_post( $mod->get_the_content );

					$str_ret .= self::element_close( $vargs->content_tag );
					$str_ret .= self::element_close( $vargs->content_wrapper_tag );
				}
			}

			return $str_ret;

		}

		protected static function ez_post_post_content_v1_vargs_defaults() {

			$vargs                               = new \stdClass();

			$vargs->content_active               = true;
			$vargs->content_wrapper_tag          = 'span';
			$vargs->content_wrapper_global_attrs = array(
				'class' => 'ez-post-post-content-wrapper ez-post-the-content-wrapper'
			);
			$vargs->content_tag                  = 'span';
			$vargs->content_global_attrs         = array(
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