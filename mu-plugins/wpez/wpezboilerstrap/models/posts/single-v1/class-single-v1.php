<?php

namespace WPez\WPezBoilerStrap\Models\Posts;

// Post_Next_Prev_V1
class Single_V1 {

	public function get_these_terms( $mix_post_id = '', $arr_taxs = '' ) {

		$tools_clone = new \WPez\WPezBoilerStrap\Toolbox\Tools\Cloning();

		if ( ! is_array( $arr_taxs ) ) {
			// default to cat and tag
			$arr_taxs =  array(
				'category' => true,
				'post_tag' => true
			);
		}
		$obj_ret = new \stdClass();
		$arr     = array();
		foreach ( $arr_taxs as $key => $bool ) {
			if ( $bool !== false ) {
				$str_prop           = strtolower( trim( $key ) );
				$arr_objs = get_the_terms($mix_post_id, $key);
				$obj_ret->$str_prop = $tools_clone->ez_clone_get_the_terms($arr_objs);
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