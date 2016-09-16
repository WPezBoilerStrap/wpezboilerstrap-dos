<?php

namespace WPezBoilerStrap\Models\Users;

/**
 * TODO
 * REF: http://www.wpsuperstars.net/author-box-plugins-for-wordpress/
 * get_avatar()
 */

class User_V1 {

	protected $arr_users;

	public function __construct() {

		$arr_users = array();

	}


	public function wp_user($mix_user = '', $int_blog_id = '') {

		if ( ctype_digit( $mix_user ) !== true ) {
			$int_user_id = '';
			$str_login_name    = $mix_user;
		} else {
			$int_user_id = (integer) $mix_user;
			$str_login_name    = '';
		}

		$obj_user = new \WP_User( $int_user_id, $str_login_name, $int_blog_id );

		return $obj_user;
	}



	public function user_min($mix_user = false, $int_blog_id = ''){

		if ($mix_user === false){
			return 'TODO';
		}

		/**
		 * we're going to prefix the user ID with a login name illegal character so that it
		 * can't be duplicated - as an assoc array key - by the username.
		 * by creating such unique keys we're able to "query" the array with isset().
		 *
		 *  in other words, for example, we dont want user_login = 222 to be confused with
		 *  user id = 222. unlikely, but none the less possible.
		 *
		 */

		$str_prefix = '&_';
		if ( ctype_digit( $mix_user ) !== true ) {
			$str_user_id = '';
			$str_login_name    = $mix_user;
		} else {
			$str_user_id = strval($mix_user);
			$str_login_name    = '';
		}

		/**
		 * in short, what we're trying to do here is to not go back to the DB if we've already done so.
		 * For example, when listing 10 blog posts, and the author is the same for all / most, there's
		 * no sense doing WP_User() multiple times.
		 *
		 * Note: The WP Codex's WP_User page isn't clear if / when WP will cache something, or not.
		 * This is a failsafe.
		 */

		$obj_ret = new \stdClass();
		if ( isset( $this->arr_users[$str_login_name] ) ) {

			$obj_u = $this->arr_users[$str_login_name];
			$obj_ret->ID = $obj_u->ID;
			$obj_ret->display_name = $obj_u->display_name;
			$obj_ret->posts_url = $obj_u->posts_url;

		} elseif ( isset( $this->arr_users[$str_prefix . $str_user_id] ) ) {

			$obj_u = $this->arr_users[$str_prefix . $str_user_id];
			$obj_ret->ID = $obj_u->ID;
			$obj_ret->display_name = $obj_u->display_name;
			$obj_ret->posts_url = $obj_u->posts_url;

		} else{

			$str_user = trim($str_user_id . $str_login_name);
			$obj_user  = $this->wp_user($str_user, $int_blog_id );
			$obj_ret->ID = $obj_user->ID;
			$obj_ret->display_name = $obj_user->display_name;
			$obj_ret->posts_url    = get_author_posts_url( $obj_user->ID );

			$temp = new \stdClass();
			$temp->ID = $obj_ret->ID;
			$temp->display_name = $obj_ret->display_name;
			$temp->posts_url    = $obj_ret->posts_url;

			// stuff it into the arr of users to avoid going back to the DB.
			$this->arr_users[ $obj_user->user_login ] = $temp;
			$this->arr_users[ $str_prefix . strval($obj_user->ID) ] = $temp;

		}
		return $obj_ret;
	}

	public function user_max(){
		//TODO
		/*
		 * 	$um = get_user_meta($int_user_id,'',true);

		var_dump ($um);

		$um = array_map( function( $a ){ return $a[0]; }, $um );
		 */
	}
}
