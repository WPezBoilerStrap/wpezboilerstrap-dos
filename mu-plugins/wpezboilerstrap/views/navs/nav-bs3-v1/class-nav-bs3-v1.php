<?php

namespace WPezBoilerStrap\Views\Navs;

if ( ! class_exists('Nav_BS3_V1') ) {
	class Nav_BS3_V1 extends \WPezBoilerStrap\Toolbox\Parents\View {

		function view( $lang, $mod, $parts, $vargs ) {

			$str_ret = '';

			$str_ret .= '<div id="' . esc_attr( $vargs->wrap_id ) . '" class="' . esc_attr( $vargs->wrap_class ) . '" role="' . esc_attr( $vargs->wrap_role ) . '">';

			$str_ret .= '<div class="' . esc_attr( $vargs->inner_class ) . '">';

			$str_ret .= '<div class="' . esc_attr( $vargs->header_class ) . '">';

			$str_ret .= '<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="' . $vargs->data_target . '">';
			$str_ret .= '<span class="sr-only">Toggle navigation</span>';
			$str_ret .= '<span class="icon-bar"></span>';
			$str_ret .= '<span class="icon-bar"></span>';
			$str_ret .= '<span class="icon-bar"></span>';

			$str_ret .= '</button>';
			$str_ret .= '<a class="' . esc_attr( $vargs->brand_class ) . '" href="' . esc_url( $mod->brand_url ) . '" title="' . esc_html( $lang->brand_title ) . '">' . esc_html( $lang->brand_name ) . '</a>';

			$str_ret .= '</div>';

			$str_ret .= $mod->wp_nav_menu;

			$str_ret .= '</div>';
			$str_ret .= '</div>';

			return $str_ret;

		}

		protected function lang_defaults() {

			$obj = new \stdClass();
			$obj->brand_title = 'BRAND_TITLE';
			$obj->brand_name = 'BRAND_NAME';

			return $obj;
		}

		protected function mod_defaults() {

			$obj = new \stdClass();

			$obj->brand_url = 'http://BRAND_URL.com';
			$obj->wp_nav_menu = 'WP_NAV_MENU';

			return $obj;
		}

		protected function parts_defaults() {
			// TODO: Implement parts_defaults() method.
		}

		protected function vargs_defaults() {

			$obj = new \stdClass();

			$obj->wrap_id = 'WRAP_ID';
			$obj->wrap_class = 'WRAP_CLASS';
			$obj->wrap_role = 'WRAP_ROLE';
			$obj->inner_class = 'INNER_CLASS'; // e.g., containter
			$obj->header_class = 'HEADER_CLASS'; // e.g., navbar-header
			$obj->data_target = 'DATA_TARGET'; // e.g., .navbar-collapse
			$obj->brand_class = 'BRAND_LINK_CLASS'; // e.g., navbar-brand

			return $obj;
		}

	}
}