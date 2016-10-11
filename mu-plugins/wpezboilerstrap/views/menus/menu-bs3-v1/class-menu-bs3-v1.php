<?php

namespace WPezBoilerStrap\Views\Menus;

if ( ! class_exists('Menu_BS3_V1') ) {
	class Menu_BS3_V1 extends \WPezBoilerStrap\Toolbox\Parents\View {

		function view( $lang, $mod, $parts, $vargs ) {
			
			$mac = $this->_mac;

			$str_ret = '';

			$str_ret .= '<div' . $mac::global_attrs($vargs->wrapper_global_attrs). '>';
			$str_ret .= '<div' . $mac::global_attrs($vargs->inner_global_attrs). '>';
			$str_ret .= '<div' . $mac::global_attrs($vargs->header_global_attrs). '>';

			$str_ret .= '<button' . $mac::global_attrs($vargs->button_global_attrs). '>';
			$str_ret .= '<span class="sr-only">Toggle navigation</span>';
			$str_ret .= '<span class="icon-bar"></span>';
			$str_ret .= '<span class="icon-bar"></span>';
			$str_ret .= '<span class="icon-bar"></span>';
			$str_ret .= '</button>';

			$str_ret .= '<a class="' . esc_attr( $vargs->brand_class ) . '" href="' . esc_url( $mod->brand_url ) . '" title="' . esc_html( $lang->brand_title ) . '">' . esc_html( $lang->brand_name ) . '</a>';

			$str_ret .= '</div>';

			$str_ret .= $mod->menu;

			$str_ret .= '</div>';
			$str_ret .= '</div>';


			return $str_ret;

		}

		protected function lang_defaults() {

			$lang = new \stdClass();
			$lang->brand_title = 'WPezBoilerStrap';
			$lang->brand_name = 'WPezBoilerStrap';

			return $lang;
		}

		protected function mod_defaults() {

			$mod = new \stdClass();

			$mod->brand_url = 'http://TODO.com';
			$mod->menu = 'INSERT MOD-MENU HERE';

			return $mod;
		}

		protected function parts_defaults() {
			$parts = new \stdClass();

			return $parts;
		}

		protected function vargs_defaults() {

			$obj_enc = new \stdClass();

			$obj_enc->active = true;            // an enclosure master switch - default is true

			$obj_enc->semantic_active = true;
			$obj_enc->semantic_tag = 'nav';
			$obj_enc->semantic_global_attrs = array(
				//'class' => 'my semantic class test'
			);

			$obj_enc->view_wrapper_active = false;
			$obj_enc->view_wrapper_tag = 'div';
			$obj_enc->view_wrapper_global_attrs = array(
				// 'class' => 'HEADER-CLASS'
			);

			$vargs = new \stdClass();
			$vargs->enclose = $obj_enc;

			$vargs->wrapper_global_attrs = array(
				'id' => 'nav-main',
				'class' => 'navbar navbar-default',
				'role' => 'navigation'
			);

			$vargs->inner_global_attrs = array(
				'class' => 'container',
			);

			$vargs->header_global_attrs = array(
				'class' => 'navbar-header',
			);

			$vargs->button_global_attrs = array(
				'type' => 'button',
				'class' => 'navbar-toggle collapsed',
				'data-toggle' => 'collapse',
				'data-target' => '.navbar-collapse'
			);

			$vargs->brand_class = 'navbar-brand'; 

			return $vargs;
		}

	}
}