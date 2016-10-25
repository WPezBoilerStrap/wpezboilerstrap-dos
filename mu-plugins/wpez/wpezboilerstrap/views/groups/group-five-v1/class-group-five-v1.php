<?php

namespace WPez\WPezBoilerStrap\Views\Groups;

if ( ! class_exists('Group_Five_V1') ) {
	class Group_Five_V1 extends \WPez\WPezBoilerStrap\Toolbox\Parents\View {

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

			return new \stdClass();
		}

		protected function mod_defaults() {

			return new \stdClass();
		}

		protected function parts_defaults() {

			$parts = new \stdClass();

			$parts->one = 'PARTS->ONE';
			$parts->two = 'PARTS->TWO';
			$parts->three = 'PARTS->THREE';
			$parts->four = 'PARTS->FOUR';
			$parts->five = 'PARTS->FIVE';

			return $parts;
		}

		protected function vargs_defaults() {

			return new \stdClass();
		}

	}
}