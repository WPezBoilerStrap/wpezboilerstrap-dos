<?php

namespace WPez\WPezBoilerStrap\Views\Headers;

if ( ! class_exists('Header_V1') ) {
	class Header_V1 extends \WPez\WPezBoilerStrap\Toolbox\Parents\View {

		function view( $mod, $parts, $vargs ) {

			// TODO? - this is really just a group
			$str_ret = '';

			$str_ret .= '<header>';

			$str_ret .= '<div id="' . esc_attr( $vargs->wrap_id ) . '" class="' . esc_attr( $vargs->wrap_class ) . '">';

			$str_ret .= $parts->nav;

			$str_ret .= '</div>';

			$str_ret .= '</header>';

			return $str_ret;

		}

		protected function lang_defaults() {
			// TODO: Implement lang_defaults() method.
		}

		protected function mod_defaults() {
			// TODO: Implement mod_defaults() method.
		}

		protected function parts_defaults() {

			$obj = new \stdClass();

			$obj->nav = 'PARTS -> NAV';

			return $obj;
		}

		protected function vargs_defaults() {

			$obj = new \stdClass();

			$obj->wrap_id = 'WRAP_ID';
			$obj->wrap_class = 'WRAP_CLASS';

			return $obj;
		}
	}
}