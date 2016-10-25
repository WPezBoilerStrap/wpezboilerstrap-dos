<?php

namespace WPez\WPezBoilerStrap\Views\Groups;

if ( ! class_exists('Group_Four_V1') ) {
	class Group_Four_V1 extends \WPez\WPezBoilerStrap\Toolbox\Parents\View {

		public function view( $lang, $mod, $parts, $vargs ) {

			$str_ret = '';

			$str_ret .= $parts->one;

			$str_ret .= $parts->two;

			$str_ret .= $parts->three;

			$str_ret .= $parts->four;

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
			$parts->four  = 'PARTS->FOUR';

			return $parts;
		}

		protected function vargs_defaults() {

			return new \stdClass();
		}

	}
}
