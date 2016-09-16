<?php

namespace WPezBoilerStrap\Models\Components;

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

			$ga = new \stdClass();

			// prev
			$obj          = new \stdClass();
			$obj_temp = $this->get_adjacent_prev( $bool_in_same_term, $arr_excluded_terms, $str_taxonomy );
			$obj->ID = $obj_temp->ID;
			$obj->post_author = $obj_temp->post_author;
			$obj->wp_post = $obj_temp;

			$ga->prev = $obj;

			$obj = new \stdClass();
			$obj->permalink = get_permalink($obj_temp);

			$ga->prev->ezx = $obj;

			// prev
			$obj          = new \stdClass();
			$obj_temp = $this->get_adjacent_next( $bool_in_same_term, $arr_excluded_terms, $str_taxonomy );
			$obj->ID = $obj_temp->ID;
			$obj->post_author = $obj_temp->post_author;
			$obj->wp_post = $obj_temp;

			$ga->next = $obj;

			$obj = new \stdClass();
			$obj->permalink = get_permalink($obj_temp);

			$ga->next->ezx = $obj;

			return $ga;

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