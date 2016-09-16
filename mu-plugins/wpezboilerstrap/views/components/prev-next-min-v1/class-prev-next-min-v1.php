<?php

namespace WPezBoilerStrap\Views\Components;

if ( ! class_exists( 'Prev_Next_Min_V1' ) ) {
	class Prev_Next_Min_V1 extends \WPezBoilerStrap\Toolbox\Parents\View {

		protected function view( $lang, $mod, $parts, $vargs ) {

			// simplify the nested objs a bit
			$obj_prev   = $mod->prev->wp_post;
			$obj_prev_ezx = $mod->prev->ezx;

			$obj_next   = $mod->next->wp_post;
			$obj_next_ezx = $mod->next->ezx;

			$str_ret = '';
			$str_ret .= $this->element_open($vargs->wrapper_tag, $vargs->wrapper_global_attrs);

			// prev
			$str_ret .= $this->element_open($vargs->page_tag, $vargs->page_prev_global_attrs);
			if ( ! empty( $obj_prev_ezx->permalink ) && ! empty( $obj_prev->post_title ) ) {

				$str_ret .= '<a href="' . esc_url( $obj_prev_ezx->permalink ) . ' ">';

				/*
				 * This isn't as tricky as it looks :)
				 * Essentially you can:
				 * -- Use a font icon (icon_prev_global_attrs) - tag = false will leave it out
				 * -- Use an ascii "icon" (prev_icon) - leave it blank if you don't want it.
				 * -- Override the wp_post title with some other text title
				 * That should cover most basic use cases. Hopefully :)
				 */
				$str_ret .= $this->element_open($vargs->icon_tag, $vargs->icon_prev_global_attrs);
				$str_ret .= esc_attr( $vargs->prev_icon );
				$str_ret .= $this->element_close($vargs->icon_tag);

				$str_title = esc_attr( $obj_prev->post_title );
				if ( ! empty($lang->prev_title) && $lang->prev_title !== false ){
					$str_title = esc_attr($lang->prev_title);
				}
				$str_ret .= $str_title;
				$str_ret .= '</a>';
			}
			$str_ret .= $this->element_close($vargs->page_tag);

			// next
			$str_ret .= $this->element_open($vargs->page_tag, $vargs->page_next_global_attrs);
			if ( ! empty( $obj_next_ezx->permalink ) && ! empty( $obj_next->post_title ) ) {

				$str_ret .= '<a href="' . esc_url( $obj_next_ezx->permalink ) . ' ">';

				$str_title = esc_attr( $obj_next->post_title );
				if ( ! empty($lang->next_title) && $lang->next_title !== false ){
					$str_title = esc_attr($lang->next_title);
				}
				$str_ret .= $str_title;

				$str_ret .= $this->element_open($vargs->icon_tag, $vargs->icon_next_global_attrs);
				$str_ret .= esc_attr( $vargs->next_icon );
				$str_ret .= $this->element_close($vargs->icon_tag);

				$str_ret .= '</a>';
			}
			$str_ret .= $this->element_close($vargs->page_tag);

			$str_ret .= $this->element_close($vargs->wrapper_tag);
			return $str_ret;
		}

		protected function lang_defaults() {

			$lang = new \stdClass();

			// one use these if you want to override the wp_post titles.
			//$lang->prev_title      = 'Lang - Override Prev Title';
			//$lang->next_title      = 'Lang - Override Next Title';

			return $lang;
		}

		protected function mod_defaults() {

			$mod = new \stdClass();

			$obj_post             = new \stdClass();
			$obj_post->post_title = 'MOD - Prev Post_Title';
			$obj_post_x           = new \stdClass();
			$obj_post_x->permalink  = 'http://MOD-POST_X-PREV-URL.com';

			$obj_prev = new \stdClass();

			$obj_prev->wp_post       = $obj_post;
			$obj_prev->ezx = $obj_post_x;

			$obj_post             = new \stdClass();
			$obj_post->post_title = 'MOD - Next Post_Title';
			$obj_post_x           = new \stdClass();
			$obj_post_x->permalink  = 'http://MOD-POST_X-NEXT-URL.com';

			$obj_next = new \stdClass();

			$obj_next->wp_post       = $obj_post;
			$obj_next->ezx = $obj_post_x;

			$mod->prev = $obj_prev;
			$mod->next = $obj_next;

			return $mod;
		}


		protected function parts_defaults() {

			$parts = new \stdClass();

			return $parts;
		}

		protected function vargs_defaults() {

			$vargs = new \stdClass();

			$vargs->wrapper_tag = 'ul';
			$vargs->wrapper_global_attrs = array(
				'class' => 'pager'
			);

			$vargs->page_tag = 'li';
			$vargs->page_prev_global_attrs = array(
				'class' => 'previous'
			);

			$vargs->page_next_global_attrs = array(
				'class' => 'next'
			);

			//if you don't want to use the font based icons make icon_tag = false
			$vargs->icon_tag = 'i';
			$vargs->icon_prev_global_attrs = array(
				'class' => 'glyphicon glyphicon-chevron-left',
				'aria-hidden' => "true"
			);
			$vargs->prev_icon = ''; // '&larr;';

			$vargs->icon_next_global_attrs = array(
				'class' => 'glyphicon glyphicon-chevron-right',
				'aria-hidden' => "true"
			);
			$vargs->next_icon       = ''; // '&rarr;';

			return $vargs;
		}


	}
}