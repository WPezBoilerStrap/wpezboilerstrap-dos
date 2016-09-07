<?php

namespace WPezBoilerStrap\Models\Posts;

// Post_Next_Prev_V1
class Single_V1 {

	protected $_str_adjacent_img_size;
	protected $_arr_taxs;

	public function __construct() {
		$this->_str_adjacent_img_size = 'thumbnail';
		$this->_arr_taxs = array(
			'category' => true,
			'post_tag' => true
		);
	}


	public function set( $str_prop_name = '', $mix_value ) {
		if ( property_exists( $this, $str_prop_name ) ) {
			$this->$str_prop_name = $mix_value;
		}
	}

	/**
	 * @param bool $bool_in_same_term
	 * @param array $arr_excluded_terms
	 * @param string $str_taxonomy
	 *
	 * @return \stdClass
	 */
	public function get_adjacent( $bool_in_same_term = false, $arr_excluded_terms = array(), $str_taxonomy = 'category' ) {

		global $post;

		$ga = new \stdClass();

		// prev
		$bool_prev     = true;

		$obj = new \stdClass();
		$obj->post = get_adjacent_prev( $bool_in_same_term, $arr_excluded_terms, $str_taxonomy );
		$ga->prev = $obj;

		// next
		$obj = new \stdClass();
		$obj->post = get_adjacent_next( $bool_in_same_term, $arr_excluded_terms, $str_taxonomy );
		$ga->next = $obj;

		return $ga;
	}

	public function get_adjacent_prev( $bool_in_same_term = false, $arr_excluded_terms = array(), $str_taxonomy = 'category' ) {
		$bool_prev = true;
		return get_adjacent_post( $bool_in_same_term, $arr_excluded_terms, $bool_prev, $str_taxonomy );
	}

	public function get_adjacent_next( $bool_in_same_term = false, $arr_excluded_terms = array(), $str_taxonomy = 'category' ) {
		$bool_prev     = false;
		return get_adjacent_post( $bool_in_same_term, $arr_excluded_terms, $bool_prev, $str_taxonomy );
	}


	public function get_adjacent_links_min( $bool_in_same_term = false, $arr_excluded_terms = array(), $str_taxonomy = 'category' ) {
		return $this->get_adjacent_links( $bool_in_same_term, $arr_excluded_terms, $str_taxonomy, 'min' );
	}

	public function get_adjacent_links_max( $bool_in_same_term = false, $arr_excluded_terms = array(), $str_taxonomy = 'category' ) {
		return $this->get_adjacent_links( $bool_in_same_term, $arr_excluded_terms, $str_taxonomy, 'max' );
	}

	public function get_adjacent_links_all( $bool_in_same_term = false, $arr_excluded_terms = array(), $str_taxonomy = 'category' ) {
		return $this->get_adjacent_links( $bool_in_same_term, $arr_excluded_terms, $str_taxonomy, 'all' );
	}


	public function get_adjacent_links( $bool_in_same_term = false, $arr_excluded_terms = array(), $str_taxonomy = 'category', $str_size = 'min' ) {

		if ( ! in_array( $str_size, array( 'min', 'max', 'all' ) ) ) {
			$str_size = 'min';
		};
		if ( in_array( $str_size, array( 'max', 'all' ) ) ) {
			$obj_users_v1  = new \WPezBoilerStrap\Models\Users\User_V1();
			$obj_single_v1 = new \WPezBoilerStrap\Models\Posts\Single_V1();
		}

		$arr_pn = array('prev','next');

		$obj_pn = new \stdClass();

		$arr_pn = array('prev','next');
		foreach ( $arr_pn as $k => $val){

			$obj = new \stdClass();
			$str_meth = 'get_adjacent_' . $val;
			$obj->post = $this->$str_meth( $bool_in_same_term, $arr_excluded_terms, $str_taxonomy );
			$obj_pn->$val = $obj;

			$gal = new \stdClass();

			$obj_px         = new \stdClass();
			$obj_px->exists = false;

			if ( is_object( $obj->post ) ) {

				$obj_px->exists  = true;
				$obj_px->ID      = $obj->post->ID;
				$obj_px->url     = get_permalink( $obj->post );
				$obj_px->title   = $obj->post->post_title;
				$obj_px->excerpt = $obj->post->post_excerpt;
				if ( $str_size == 'max' || $str_size == 'all' ) {
					$obj_px->author = $obj_users_v1->user_min( $obj->post->post_author );
					$obj_px->terms  = $obj_single_v1->get_terms_multi( $obj->post->ID, $this->_arr_taxs );
				}
				if ( $str_size == 'all' ) {
					$obj_px->img = $obj_single_v1->featured_image_min( $obj->post->ID, $this->_str_adjacent_img_size );
				}
			}
			$obj_pn->$val->post_extra = $obj_px;
		}

		return $obj_pn;
	}



	public function get_terms( $mix_post_id = '', $str_tax = false ) {

		if ( empty( $mix_post_id ) || $str_tax === false ) {
			return array();
		}

		$int_post_id = (int) $mix_post_id;

		$arr_objs = get_the_terms( $int_post_id, $str_tax );
		if ( $arr_objs === false || is_array( $arr_objs->errors ) ) {
			return array();
		}
		foreach ( $arr_objs as $key => $obj ) {
			$obj->url    = get_term_link( $obj, $str_tax );
			$obj->anchor = $obj->name;
			$obj->title  = $obj->name;
			if ( ! empty( $obj->description ) ) {
				$obj->title = $obj->name . ' - ' . $obj->description;
			}
		}

		return $arr_objs;
	}

	public function get_terms_multi( $mix_post_id = '', $arr_taxs = array() ) {

		if ( ! is_array( $arr_taxs ) ) {
			return 'TODO';
		}
		$obj_ret = new \stdClass();
		$arr     = array();
		foreach ( $arr_taxs as $key => $bool ) {
			if ( $bool !== false ) {
				$str_prop           = strtolower( trim( $key ) );
				$obj_ret->$str_prop = $this->get_terms( $mix_post_id, $key );
			}
		}

		return $obj_ret;
	}


	public function featured_image_min( $mix_post_id = '', $mix_size = 'thumbnail' ) {

		if ( empty ( $mix_post_id ) ) {
			return false;
		}

		$int_post_id           = (int) $mix_post_id;
		$int_post_thumbnail_id = get_post_thumbnail_id( $int_post_id );
		$obj_ret               = $this->image_min( $int_post_thumbnail_id, $mix_size );

		return $obj_ret;
	}

	public function featured_image_max( $mix_post_id = '', $mix_size = 'thumbnail' ) {


		if ( empty ( $mix_post_id ) ) {
			return false;
		}

		$int_post_id           = (int) $mix_post_id;
		$int_post_thumbnail_id = get_post_thumbnail_id( $int_post_id );
		$obj_ret               = $this->image_max( $int_post_thumbnail_id, $mix_size );

		return $obj_ret;
	}

	public function featured_image_all( $mix_post_id = '', $mix_size = 'thumbnail' ) {


		if ( empty ( $mix_post_id ) ) {
			return false;
		}

		$int_post_id           = (int) $mix_post_id;
		$int_post_thumbnail_id = get_post_thumbnail_id( $int_post_id );
		$obj_ret               = $this->image_all( $int_post_thumbnail_id, $mix_size );

		return $obj_ret;
	}


	public function image_min( $mix_img_id = '', $mix_size = 'thumbnail' ) {

		$obj_ret         = new \stdClass();
		$obj_ret->exists = false;
		if ( empty ( $mix_img_id ) ) {
			return $obj_ret;
		}

		$int_img_id = (int) $mix_img_id;
		$obj_ret    = $this->attachment_image_src( $int_img_id, $mix_size );

		return $obj_ret;
	}

	public function image_max( $mix_img_id = '', $mix_size = 'thumbnail' ) {

		$obj_ret         = new \stdClass();
		$obj_ret->exists = false;
		if ( empty ( $mix_img_id ) ) {
			return $obj_ret;
		}

		$obj_ret = $this->image_min( $mix_img_id, $mix_size );
		if ( ! $obj_ret->exists ) {
			return $obj_ret;
		}
		$obj_ret->basename = wp_basename( $obj_ret->url );
		$obj_ret->folder   = str_replace( wp_basename( $obj_ret->url ), '', $obj_ret->url );

		$obj_attach           = get_post( $obj_ret->ID );
		$obj_ret->title       = $obj_attach->post_title;
		$obj_ret->description = $obj_attach->post_content;
		$obj_ret->caption     = $obj_attach->post_excerpt;

		return $obj_ret;
	}


	public function image_all( $mix_img_id = '', $mix_size = 'thumbnail' ) {

		$obj_ret         = new \stdClass();
		$obj_ret->exists = false;
		if ( empty ( $mix_img_id ) ) {
			return $obj_ret;
		}

		$obj_ret = $this->image_max( $mix_img_id, $mix_size );
		if ( ! $obj_ret->exists ) {
			return $obj_ret;
		}

		$arr_img_meta = get_post_meta( $obj_ret->ID );
		if ( isset( $arr_img_meta['_wp_attachment_image_alt'][0] ) ) {
			$obj_ret->alt = $arr_img_meta['_wp_attachment_image_alt'][0];
		}

		if ( isset( $arr_img_meta['_wp_attachment_metadata'][0] ) ) {
			$arr_temp  = unserialize( $arr_img_meta['_wp_attachment_metadata'][0] );
			$arr_sizes = array_map(
				function ( $arr ) {
					return (object) $arr;
				},
				$arr_temp['sizes']
			);

			$obj_ret->sizes      = $arr_sizes;
			$obj_ret->image_meta = (object) $arr_temp['image_meta'];
		}

		return $obj_ret;
	}


	public function attachment_image_src( $mix_img_id = '', $mix_size = 'thumbnail' ) {

		$obj_ret         = new \stdClass();
		$obj_ret->exists = false;
		if ( empty ( $mix_img_id ) ) {
			return $obj_ret;
		}
		$int_img_id = (int) $mix_img_id;
		$mix_img    = wp_get_attachment_image_src( $int_img_id, $mix_size );
		if ( is_array( $mix_img ) ) {

			$obj_ret->exists = true;
			$obj_ret->ID     = $int_img_id;

			$obj_ret->url             = $mix_img[0];
			$obj_ret->width           = $mix_img[1];
			$obj_ret->height          = $mix_img[2];
			$obj_ret->is_intermediate = $mix_img[3];

		}

		return $obj_ret;
	}
}