<?php

namespace WPez\WPezBoilerStrap\Views\Groups;

if ( ! class_exists('Group_Three_V1') ) {
	class Group_Three_V1 extends \WPez\WPezBoilerStrap\Toolbox\Parents\View {

		public function view( $mod, $parts, $vargs ) {

			$str_ret = '';

			$str_ret .= $parts->one;

			$str_ret .= $parts->two;

			$str_ret .= $parts->three;

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

			$parts->one   = 'PARTS->ONE';
			$parts->two   = 'PARTS->TWO';
			$parts->three = 'PARTS->THREE';

			return $parts;
		}

		protected function vargs_defaults() {

			return new \stdClass();
		}

	}
}
