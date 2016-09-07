<?php

namespace WPezTheme;

if ( ! class_exists('TODO_VIEW')) {
	class TODO_VIEW extends \WPezBoilerStrap\Toolbox\Parents\View {

		protected function view( $lang, $mod, $parts, $vargs ) {
			return '';
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