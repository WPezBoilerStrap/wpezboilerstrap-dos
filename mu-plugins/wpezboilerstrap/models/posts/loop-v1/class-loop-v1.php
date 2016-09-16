<?php

namespace WPezBoilerStrap\Models\Posts;

if ( ! class_esits('Loop_V1') ) {
	class Loop_V1 {

		public function __construct() {

		}

		/**
		 * @param string $arr_posts
		 *
		 * @return array|string
		 */
		public function deep_copy( $arr_posts = '' ) {

			if ( empty ( $arr_posts ) || ! is_array( $arr_posts ) ) {
				return $arr_posts;
			}
			$arr_new = array();
			foreach ( $arr_posts as $key => $obj ) {
				$arr_new[ $key ] = clone $obj;
			}

			return $arr_new;

		}
	}
}