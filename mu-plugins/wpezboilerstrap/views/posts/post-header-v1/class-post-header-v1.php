<?php

namespace WPezBoilerStrap\Views\Posts;

if ( ! class_exists('Post_Header_V1')) {
	class Post_Header_V1 extends \WPezBoilerStrap\Toolbox\Parents\View {

		protected function view( $lang, $mod, $parts, $vargs ) {

			$obj_wp_post = $mod->wp_post;
			$obj_ezx = $mod->ezx;
			$obj_user = $mod->ezx->user;

			$str_ret = '';

			$str_ret .=  $this->element_open('h1', '');
			$str_ret .= esc_attr( $obj_wp_post->post_title );
			$str_ret .= $this->element_close('h1');

			$str_ret .= $parts->one;

			$str_ret .= $parts->two;

			// TODO - consider adding "snippets" for view bits that repeat often.
			$str_ret .= $this->element_open('p');
			$str_ret .= $this->element_open('span', array('class' => 'fa fa-tags fa-fw'));
			$str_ret .= $this->element_close('span');
			$str_ret .= $this->element_open('span', '');
			$str_ret .= esc_attr( $obj_user->display_name );
			$str_ret .= $this->element_close('span');
			$str_ret .= $this->element_close('p');

			$vargs->date_format ='Y';

			$str_ret .= $this->element_open('p');
			$str_ret .= $this->element_open('span', array('class' => 'fa fa-tags fa-fw'));
			$str_ret .= $this->element_close('span');
			$str_ret .= $this->element_open('span', '');
			$str_ret .= esc_attr(date($vargs->date_format, strtotime($obj_wp_post->post_date)));
			$str_ret .= $this->element_close('span');
			$str_ret .= $this->element_close('p');

			return $str_ret;
		}


		protected function lang_defaults() {

			$obj = new \stdClass();

			return $obj;
		}

		protected function mod_defaults() {

			$obj = new \stdClass();

			$post = new\stdClass();

			$post->post_title = 'MOD->POST_TITLE';
			$post->post_date = 'MOD->POST-DATE';

			$obj->post = $post;

			$ezx = new \stdClass();
			$ezx_user = new \stdClass();

			$ezx_user->display_name = 'MOD-EZX-USER-DISPLAY_NAME';

			$ezx->user = $ezx_user;
			$obj->ezx = $ezx;

			return $obj;
		}


		protected function parts_defaults() {

			$obj = new \stdClass();

			$obj->cats = '<p>PARTS->ONE</p>';
			$obj->tags = '<p>PARTS->TWO</p>';

			return $obj;
		}

		protected function vargs_defaults() {

			$vargs = new \stdClass();

			$vargs->date_format = 'TODO';

			$vargs->post_title_tag = 'h1';
			$vargs->post_title_tag_global_attrs = array(
				'class' => 'title class'
			);


			return $vargs;
		}
	}
}