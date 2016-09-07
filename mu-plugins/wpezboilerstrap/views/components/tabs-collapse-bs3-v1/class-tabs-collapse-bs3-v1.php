<?php

namespace WPezBoilerStrap\Views\Components;

if ( ! class_exists( 'Tabs_Collapse_BS3_V1' ) ) {

	class Tabs_Collapse_BS3_V1 extends \WPezBoilerStrap\Toolbox\Parents\View {

		protected function view( $lang, $mod, $parts, $vargs ) {

			/*
			 * button_wrap_class
			 * button_class
			 * button_href *  = content_id (below)
			 * button_icon_class * ?? ELSE button_anchor
			 *
			 */

			$str_tab_buttons = '';
			$str_tab_content = '';
			if ( is_array($vargs->tabs)) {
				foreach ( $vargs->tabs as $key => $obj ) {

					$str_tab_buttons .= $this->element_open( 'div', array( 'class' => "col-xs-3 TODO" ) );
					$str_tab_buttons .= '<a class="btn btn-link" data-toggle="collapse" href="#' . sanitize_html_class( $obj->button_href ) . '" aria-expanded="false" aria-controls="collapseExample">';
					$str_tab_buttons .= '<span class="' . esc_attr( $obj->button_icon_class ) . '"></span>';
					$str_tab_buttons .= '<span class="' . esc_attr( $obj->button_icon_class ) . '">' . esc_attr( $obj->name ) . '</span>';
					$str_tab_buttons .= '</a>';
					$str_tab_buttons .= $this->element_close( 'div' );

					$str_tab_content .= '<div class="collapse col-lg-12 TODO" id="' . sanitize_html_class( $obj->button_href ) . '">';
					$str_tab_content .= $this->element_open( 'div', array( 'class' => "well" ) );
					$str_tab_content .= '<span class="' . esc_attr( $obj->button_icon_class ) . '"></span>';
					$str_tab_content .= $this->element_open( 'span' );
					$str_tab_content .= esc_attr( $obj->name );
					$$str_tab_content .= $this->element_close( 'span' );

					// if mod then mod->$property else if parts then $parts->$property
					$str_content = '';
					$str_prop = $obj->property;
					if ( $obj->source == 'mod' || $obj->source == 'parts' ) {
						$str_content = $mod->$str_prop;
						$str_content .= $parts->$str_prop;
					}
					//$prop = $obj->vws;
					$str_tab_content .= $str_content;
					$str_tab_content .= $this->element_close( 'div' );
					$str_tab_content .= '</div>';

				}
			}

			$str_ret = '';

			$str_ret .= 'Tabs Collapse BS3 1 - TODO<br>';

			/*
			 * wrapper_class
			 * ??
			 * row_class
			 */

			$str_ret .= '<div class="blog-controls clearfix TODO ">';
			$str_ret .= '<div class="col-sm-5 col-sm-offset-7 TODO">';
			$str_ret .= '<div class="row TODO">';

			$str_ret .= $str_tab_buttons;

			$str_ret .= '</div>';
			$str_ret .= '</div>';
			$str_ret .= '</div>';


			/*
			 * wrapper
			 */
			$str_ret .= '<div id="my-collapse-TODO" class="row blog-controls-open">';

			$str_ret .= $str_tab_content;

			$str_ret .= '</div>';

			return $str_ret;
		}


		protected function lang_defaults() {

			$lang = new \stdClass();

			return $lang;
		}

		protected function mod_defaults() {

			$mod = new \stdClass();

			return $mod;
		}


		protected function parts_defaults() {

			$parts = new \stdClass();

			return $parts;
		}

		protected function vargs_defaults() {

			/*
			$obj_enc = new \stdClass();

			$obj_enc->active = false;            // an enclosure master switch - default is true

			$obj_enc->semantic_active = true;   // default is true
			$obj_enc->semantic_tag = 'tag_TODO';
			$obj_enc->semantic_global_attrs = array(
				'class' => 'my semantic class test'
			);

			$obj_enc->wrapper_active = true;   // default is true
			$obj_enc->wrapper_tag = 'tag_TODO';
			$obj_enc->wrapper_global_attrs = array(
				'class' => 'my wrapper class test'
			);
			*/

			$vargs = new \stdClass();

			// $vargs->enclosure = $obj_enc;

			return $vargs;
		}
	}
}
