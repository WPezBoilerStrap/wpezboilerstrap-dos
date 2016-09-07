<?php

namespace WPezBoilerStrap\Models\Posts;

class Loop_V1 {

	public function __construct() {

	}

	public function deep_copy($arr_posts = ''){

		if ( empty ($arr_posts) || ! is_array($arr_posts)){
			return $arr_posts;
		}
		$arr_new = array();
		foreach ( $arr_posts as $key => $obj){
			$arr_new[$key] = clone $obj;
		}
		return $arr_new;

	}


	public function get_pagination( $arr_args = array() ) {

		$temp = get_the_posts_pagination( $arr_args );

		$str_links = paginate_links( $arr_args );

		// var_dump($str_links);

		$arr_links = explode( "\n", $str_links );

		// var_dump($arr_links);

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

			//	var_dump($arr_link);
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

		//	var_dump($arr_objs);
		if ( ! isset( $arr_args['prev_next'] ) || ( isset( $arr_args['prev_next'] ) && $arr_args['prev_next'] === true ) ) {
			$arr_objs[0]->type                = 'prev';
			$arr_objs[ $int_count - 1 ]->type = 'next';
		}

		//	var_dump($arr_objs);

		return $arr_objs;
	}


}