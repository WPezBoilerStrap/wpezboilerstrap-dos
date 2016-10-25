<?php

namespace WPez\WPezBoilerStrap\Models\Components;

if ( ! class_exists('Adjacent_Post_V1')) {
	class Adjacent_Post_V1 {

		public function __construct() {

		}

		/**
		 * @param bool $bool_in_same_term
		 * @param array $arr_excluded_terms
		 * @param string $str_taxonomy
		 *
		 * @return \stdClass
		 */
		public function get_adjacent_posts( $bool_in_same_term = false, $arr_excluded_terms = array(), $str_taxonomy = 'category' ) {

			global $post;

			$new_clone = new \WPez\WPezBoilerStrap\Toolbox\Tools\Cloning();

			$adj_posts = new \stdClass();

			// prev
			$obj_prev = $this->get_adjacent_prev( $bool_in_same_term, $arr_excluded_terms, $str_taxonomy );
			$obj_prev_new = $new_clone->ez_clone($obj_prev);
			$adj_posts->prev = $obj_prev_new;

			// next
			$obj_next = $this->get_adjacent_next( $bool_in_same_term, $arr_excluded_terms, $str_taxonomy );
			$obj_next_new = $new_clone->ez_clone($obj_next);
			$adj_posts->next = $obj_next_new;

			return $adj_posts;

		}

		public function get_adjacent_prev( $bool_in_same_term = false, $arr_excluded_terms = array(), $str_taxonomy = 'category' ) {
			$bool_prev = true;
			return get_adjacent_post( $bool_in_same_term, $arr_excluded_terms, $bool_prev, $str_taxonomy );
		}

		public function get_adjacent_next( $bool_in_same_term = false, $arr_excluded_terms = array(), $str_taxonomy = 'category' ) {
			$bool_prev = false;
			return get_adjacent_post( $bool_in_same_term, $arr_excluded_terms, $bool_prev, $str_taxonomy );
		}

	}
}