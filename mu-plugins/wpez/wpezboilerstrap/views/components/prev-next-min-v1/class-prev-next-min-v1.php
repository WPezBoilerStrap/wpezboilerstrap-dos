<?php

namespace WPez\WPezBoilerStrap\Views\Components;

if ( ! class_exists( 'Prev_Next_Min_V1' ) ) {
	class Prev_Next_Min_V1 extends \WPez\WPezBoilerStrap\Toolbox\Parents\View {

		protected function view( $lang, $mod, $parts, $vargs ) {
			
			$mac = $this->_mac;

			// $obj_prev_orig   = $mod->prev->orig_obj;
			$obj_prev = $mod->prev;

			//$obj_next_orig   = $mod->next->orig_obj;
			$obj_next = $mod->next;

			$str_ret = '';
			$str_ret .= $mac::element_open($vargs->wrapper_tag, $vargs->wrapper_global_attrs);

			// prev
			$str_ret .= $mac::element_open($vargs->page_tag, $vargs->page_prev_global_attrs);

			if ( ! empty( $obj_prev->url ) && ! empty( $obj_prev->title ) ) {

				$aria_label = ' aria-label="' . esc_attr($vargs->aria_label_prev) . '" ';
				$str_ret .= '<a href="' . esc_url( $obj_prev->url ) . '"' . $aria_label . '>';

				/*
				 * This isn't as tricky as it looks :)
				 * Essentially you can:
				 * -- Use a font icon (icon_prev_global_attrs) - tag = false will leave it out
				 * -- Use an ascii "icon" (prev_icon) - leave it blank if you don't want it.
				 * -- Override the wp_post title with some other text title
				 * That should cover most basic use cases. Hopefully :)
				 */
				$str_ret .= $mac::element_open($vargs->icon_tag, $vargs->icon_prev_global_attrs);
				$str_ret .= esc_attr( $vargs->prev_icon );
				$str_ret .= $mac::element_close($vargs->icon_tag);

				$str_title = esc_attr( $obj_prev->title );
				// or use your own title. for example, perpahs a simple "Prav" and "Next" will do?
				if ( ! empty($lang->prev_title) && $lang->prev_title !== false ){
					$str_title = esc_attr($lang->prev_title);
				}
				$str_ret .= $str_title;
				$str_ret .= '</a>';
			}
			$str_ret .= $mac::element_close($vargs->page_tag);

			// next
			$str_ret .= $mac::element_open($vargs->page_tag, $vargs->page_next_global_attrs);
			if ( ! empty( $obj_next->url ) && ! empty( $obj_next->title ) ) {

				$aria_label = ' aria-label="' . esc_attr($vargs->aria_label_next) . '" ';
				$str_ret .= '<a href="' . esc_url( $obj_next->url ) . '"' . $aria_label . '>';

				$str_title = esc_attr( $obj_next->title );
				if ( ! empty($lang->next_title) && $lang->next_title !== false ){
					$str_title = esc_attr($lang->next_title);
				}
				$str_ret .= $str_title;

				$str_ret .= $mac::element_open($vargs->icon_tag, $vargs->icon_next_global_attrs);
				$str_ret .= esc_attr( $vargs->next_icon );
				$str_ret .= $mac::element_close($vargs->icon_tag);

				$str_ret .= '</a>';
			}
			$str_ret .= $mac::element_close($vargs->page_tag);

			$str_ret .= $mac::element_close($vargs->wrapper_tag);
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
			$obj_post->title = 'MOD-Prev Title';
			$obj_post->url  = 'http://MOD-PREV-URL.com';
			$obj_post->orig_obj = 'WP_Post Object';

			$mod->prev = $obj_post;

			$obj_post             = new \stdClass();
			$obj_post->title = 'MOD-Next Title';
			$obj_post->url  = 'http://MOD-NEXT-URL.com';
			$obj_post->orig_obj = 'WP_Post Object';

			$mod->next = $obj_post;

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
				'class' => 'pager',
				'aria-label' => 'Page navigation',
			);

			$vargs->page_tag = 'li';
			$vargs->page_prev_global_attrs = array(
				'class' => 'previous'
			);

			$vargs->page_next_global_attrs = array(
				'class' => 'next'
			);

			$vargs->aria_label_prev = "Previous";
			$vargs->aria_label_next= "Next";

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