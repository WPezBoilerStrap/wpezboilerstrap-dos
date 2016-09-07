<?php

namespace WPezBoilerStrap\Views\Groups;

if ( ! class_exists('Group_Five_V1') ) {
	class Group_Five_V1 extends \WPezBoilerStrap\Toolbox\Parents\View {

		public function view( $lang, $mod, $parts, $vargs ) {

			$str_ret = '';

			$str_ret .= $parts->one;

			$str_ret .= $parts->two;

			$str_ret .= $parts->three;

			$str_ret .= $parts->four;

			$str_ret .= $parts->five;

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

			$obj->one = 'PARTS->ONE';
			$obj->two = 'PARTS->TWO';
			$obj->three = 'PARTS->THREE';
			$obj->four = 'PARTS->FOUR';
			$obj->five = 'PARTS->FIVE';

			return $obj;
		}

		protected function vargs_defaults() {

			$vargs = new \stdClass();
			return $vargs;
		}

	}
}