<?php

namespace TODO;

if ( ! class_exists('TODO')) {
	class TODO extends \WPezBoilerStrap\Toolbox\Parents\View {

		protected function view( $lang, $mod, $parts, $vargs ) {

			$str_ret = '';

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

			$obj_enc = new \stdClass();

			// an enclosure master switch - default is true
			$obj_enc->active = false;

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

			return $vargs;
		}
	}
}