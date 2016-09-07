<?php

namespace WPezTheme\Controllers;

class Posts_Loop extends \WPezBoilerStrap\Library\Parents\Controller{


	function mod(){


		global $wp_query;

		$obj_loop_v1 = new \WPezBoilerStrap\Models\Posts\Loop_V1();
		// copy/clone the wp array.
		$arr_posts = $obj_loop_v1->deep_copy($wp_query->posts);

		$obj_users_v1 = new \WPezBoilerStrap\Models\Users\User_V1();
		$obj_single_v1 = new \WPezBoilerStrap\Models\Posts\Single_V1();

		$arr_taxs = array(
			'category' => true,
			'post_tag' => true
		);
		$str_img_size = 'thumbnail';

		/**
		 * we're going to create a new array of post details (e.g., permalink)
		 * this is to avoid - however rare - any potential of conflicts in property names
		 * with the standard post object. PITA but it's safer / smarter this way.
		 *
		 * in theory, there's also the potential to cache details at the post ID level. so
		 * it makes sense to key this array with the post ID.
		*/
		$arr_posts_details = array();
		foreach ( $arr_posts as $key => $obj){
			$obj_det = new \stdClass();

			$obj_det->url = get_permalink( $obj->ID );

			$obj_det->author = $obj_users_v1->user_min($obj->post_author);

			/*$arr = array();
			foreach ( $arr_taxs as $key => $bool ) {
				if ( $bool !== false) {
					$str_prop = 'term_' . strtolower(trim($key));
					$obj_det->$str_prop = $obj_single_v1->get_terms( $obj->ID, $key );
				}
			}
			*/
			$obj_det->terms = $obj_single_v1->get_terms_multi( $obj->ID, $arr_taxs);;

			$obj_det->img = $obj_single_v1->featured_image_min($obj->ID, $str_img_size);

			$arr_posts_details[$obj->ID] = $obj_det;

		}


		$m = new \stdClass();
		$m->posts = $arr_posts;
		$m->details = $arr_posts_details;

		return $m;
	}


	function vws(){

		$v = new \stdClass();

		$vc         = new \stdClass();
		$vc->c_slug = 'controllers\posts-pagination';
		//$x->c_name = '';
		$vc->c_class = '\\WPezTheme\Controllers\Posts_Pagination';

		//$vc->v_slug = false;
		//$x->v_name = '';
		$vc->v_class  = '\\WPezBoilerStrap\Views\Components\Pagination_V1';
		$vc->v_meth_lang = 'posts_loop';
		$vc->v_meth_vargs = 'posts_loop';

		$obj_view = \WPezCore::ez_lvc( $vc, $this->_all);

		$v->posts_pagination = $obj_view->get();

		return $v;
	}

}
