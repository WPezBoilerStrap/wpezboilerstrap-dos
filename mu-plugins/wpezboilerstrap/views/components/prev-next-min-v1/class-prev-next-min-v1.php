<?php

namespace WPezBoilerStrap\Views\Components;

if ( ! class_exists( 'Prev_Next_Min_V1' ) ) {
	class Prev_Next_Min_V1 extends \WPezBoilerStrap\Toolbox\Parents\View {

		protected function view( $lang, $mod, $parts, $vargs ) {

			// simplify the nested objs a bit
			$obj_prev   = $mod->prev->post;
			$obj_prev_x = $mod->prev->post_extra;

			$obj_next   = $mod->next->post;
			$obj_next_x = $mod->next->post_extra;

			// let's go!
			$str_ret = '';
			$str_ret .= '<nav aria-label="' . esc_attr( $lang->aria_label ) . '">';
			$str_ret .= '<ul class="' . esc_attr( $vargs->ul_class ) . '">';

			$str_ret .= '<li class="' . esc_attr( $vargs->prev_li_class ) . '">';
			if ( ! empty( $obj_prev_x->url ) && ! empty( $obj_prev->post_title ) ) {

				$str_ret .= '<a href="' . esc_url( $obj_prev_x->url ) . ' ">';
				$str_ret .= ' <span class="' . esc_attr( $vargs->prev_span_class ) . '" aria-hidden="true">';
				$str_ret .= esc_attr( $vargs->prev_icon );
				$str_ret .= '</span> ';
				$str_ret .= esc_attr( $obj_prev->post_title );
				$str_ret .= '</a>';
			}
			$str_ret .= '</li>';

			$str_ret .= '<li class="' . esc_attr( $vargs->next_li_class ) . '">';
			if ( ! empty( $obj_next_x->url ) && ! empty( $obj_next->post_title ) ) {

				$str_ret .= '<a href="' . esc_url( $obj_next_x->url ) . ' ">';
				$str_ret .= esc_attr( $obj_next->post_title );
				$str_ret .= ' <span class="' . esc_attr( $vargs->next_span_class ) . '" aria-hidden="true">';
				$str_ret .= esc_attr( $vargs->next_icon );
				$str_ret .= '</span> ';
				$str_ret .= '</a>';
			}
			$str_ret .= '</li>';

			$str_ret .= '</ul>';
			$str_ret .= '</nav>';

			return $str_ret;
		}


		protected function lang_defaults() {

			$lang = new \stdClass();

			$lang->aria_label = 'ARIA_LABEL';

			return $lang;
		}

		protected function mod_defaults() {

			$mod = new \stdClass();

			$obj_post             = new \stdClass();
			$obj_post->post_title = 'MOD->PREV POST_TITLE';
			$obj_post_x           = new \stdClass();
			$obj_post_x->url      = 'http://MOD-POST_X-PREV-URL.com';

			$obj_prev = new \stdClass();

			$obj_prev->post       = $obj_post;
			$obj_prev->post_extra = $obj_post_x;

			$obj_post             = new \stdClass();
			$obj_post->post_title = 'MOD->NEXT POST_TITLE';
			$obj_post_x           = new \stdClass();
			$obj_post_x->url      = 'http://MOD-POST_X-NEXT-URL.com';

			$obj_next = new \stdClass();

			$obj_next->post       = $obj_post;
			$obj_next->post_extra = $obj_post_x;

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

			$vargs->ul_class = 'UL_CLASS'; // e.g., 'pager';

			$vargs->prev_li_class   = 'PREV_LI CLASS'; // e.g., 'previous';
			$vargs->prev_span_class = 'PREV_SNAP CLASS'; // e.g., some font awesome class
			$vargs->prev_icon       = '&larr;';

			$vargs->next_li_class   = 'NEXT_LI CLASS'; // e.g., 'next';
			$vargs->next_span_class = 'NEXT_SNAP CLASS'; // e.g., some font awesome class
			$vargs->next_icon       = '&rarr;';

			return $vargs;
		}
	}
}