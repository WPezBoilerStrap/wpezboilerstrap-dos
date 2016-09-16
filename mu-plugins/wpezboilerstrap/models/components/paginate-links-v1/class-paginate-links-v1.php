<?php

namespace WPezBoilerStrap\Models\Components;

if ( ! class_exists('Paginate_Links_V1') ) {
	class Paginate_Links_V1 {

		public function __construct() {

		}

		/**
		 * Take WP's paginate_links() and parses it into an ez friendly format
		 *
		 * @param array $arr_args
		 *
		 * @return array
		 */
		public function get_pagination( $arr_args = array() ) {

			$str_links = paginate_links( $arr_args );

			if ( ! isset( $str_links ) || empty( $str_links ) ) {
				return array();
			}

			$arr_links = explode( "\n", $str_links );

			$arr_objs  = array();
			$int_count = count( $arr_links );
			foreach ( $arr_links as $key => $str_link ) {
				$l = new \stdClass();
				// the links from get_the_posts_pagination() use both ' (single quote) and " (double quote) and that effect which regex pattern to use
				$pattern = "|<a.*(?=href='([^\"]*)')[^>]*>(.*)</a>|i";
				if ( ( $key == 0 || $key == ( $int_count - 1 ) ) && ( ! isset( $arr_args['prev_next'] ) || $arr_args['prev_next'] === true ) ) {
					$pattern = "|<a.*(?=href=\"([^\"]*)\")[^>]*>(.*)</a>|i";
				}

				preg_match_all( $pattern, $str_link, $arr_link );

				if ( isset( $arr_link[1][0] ) ) {
					$l->url    = $arr_link[1][0];
					$l->type   = 'page';
					$l->anchor = $arr_link[2][0];
				} else {

					$l->url    = '';
					$l->type   = 'current';
					$l->anchor = strip_tags( $str_link );
				}

				$arr_objs[] = $l;
			}

			if ( ! isset( $arr_args['prev_next'] ) || ( isset( $arr_args['prev_next'] ) && $arr_args['prev_next'] === true ) ) {
				if ( ! empty( $arr_objs[0]->url ) ) {
					$arr_objs[0]->type = 'prev';
				}
				if ( ! empty( $arr_objs[ $int_count - 1 ]->url ) ) {
					$arr_objs[ $int_count - 1 ]->type = 'next';
				}
			}

			return $arr_objs;
		}
	}
}