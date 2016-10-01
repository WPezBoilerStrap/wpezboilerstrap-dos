<?php

namespace WPezBoilerStrap\Views\Posts;

if ( ! class_exists('Post_Header_V1')) {
	class Post_Header_V1 extends \WPezBoilerStrap\Toolbox\Parents\View {

		protected function view( $lang, $mod, $parts, $vargs ) {

			$obj_wp_post = $mod->orig_obj;
		//	$obj_ezx = $mod->ezx;
			$obj_user = $mod->user;

			$str_ret = '';

			$str_ret .= $this->element_open($vargs->post_date_wrapper_tag, $vargs->post_date_wrapper_global_attrs);

			// date
			$str_ret .= $this->element_open($vargs->post_date_icon_tag, $vargs->post_date_icon_global_attrs);
			$str_ret .= $this->element_close($vargs->post_date_icon_tag);

			$str_ret .= $this->element_open($vargs->post_date_tag, $vargs->post_date_global_attrs);
			$str_ret .= esc_attr(date($vargs->date_format, strtotime($obj_wp_post->post_date)));
			$str_ret .= $this->element_close($vargs->post_date_tag);

			$str_ret .= $this->element_close($vargs->post_date_wrapper_tag);

			// title
			$str_ret .=  $this->element_open($vargs->title_tag, $vargs->title_tag_global_attrs);
			$str_ret .= esc_attr( $obj_wp_post->post_title );
			$str_ret .= $this->element_close($vargs->title_tag);

			// author - display_name = post author
			$str_ret .= $this->element_open($vargs->display_name_wrapper_tag, $vargs->display_name_wrapper_global_attrs);

			$str_ret .= $this->element_open($vargs->display_name_icon_tag, $vargs->display_name_icon_global_attrs);
			$str_ret .= $this->element_close($vargs->display_name_icon_tag);

			$str_ret .= $this->element_open($vargs->display_name_tag, $vargs->display_name_global_attrs);
			$str_ret .= esc_attr( $obj_user->display_name );
			$str_ret .= $this->element_close($vargs->display_name_tag);

			$str_ret .= $this->element_close($vargs->display_name_wrapper_tag);

			// --
			$str_ret .= $parts->one;

			$str_ret .= $parts->two;



			return $str_ret;
		}


		protected function lang_defaults() {

			$obj = new \stdClass();

			return $obj;
		}

		protected function mod_defaults() {



			$post = new\stdClass();

			$post->post_title = 'MOD-POST POST_TITLE';
			$post->post_date = 'MOD-POST POST-DATE';

			$ezx = new \stdClass();
			$ezx_user = new \stdClass();

			$ezx_user->display_name = 'MOD-EZX-USER DISPLAY_NAME';

			$ezx->user = $ezx_user;

			$mod = new \stdClass();

			$mod->wp_post = $post;

			$mod->ezx = $ezx;

			return $mod;
		}


		protected function parts_defaults() {

			$obj = new \stdClass();

			$obj->cats = '<p>PARTS->ONE</p>';
			$obj->tags = '<p>PARTS->TWO</p>';

			return $obj;
		}

		protected function vargs_defaults() {

			$vargs = new \stdClass();



			$vargs->title_tag = 'h1';
			$vargs->title_tag_global_attrs = array(
				'class' => 'title class'
			);

			$vargs->display_name_wrapper_tag = 'p';
			$vargs->display_name_wrapper_global_attrs = array();
			$vargs->display_name_icon_tag = 'i';
			$vargs->display_name_icon_global_attrs = array(
				'class' => 'fa fa-user fa-fw'
			);
			$vargs->display_name_tag = 'span';
			$vargs->display_name_global_attrs = array();

			// http://www.plus2net.com/php_tutorial/php_date_format.php
			$vargs->date_format = 'F d, Y';

			$vargs->post_date_wrapper_tag = 'p';
			$vargs->post_date_wrapper_global_attrs = array();
			$vargs->post_date_icon_tag = 'i';
			$vargs->post_date_icon_global_attrs = array(
				'class' => 'fa fa-calendar fa-fw'
			);
			$vargs->post_date_tag = 'span';
			$vargs->post_date_global_attrs = array();


			return $vargs;
		}
	}
}