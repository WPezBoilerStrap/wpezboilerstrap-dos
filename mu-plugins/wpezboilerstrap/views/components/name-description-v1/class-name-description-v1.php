<?php

namespace WPezBoilerStrap\Views\Components;

if ( ! class_exists('Name_Description_V1')) {
	class Name_Description_V1 extends \WPezBoilerStrap\Toolbox\Parents\View {

		protected function view( $lang, $mod, $parts, $vargs ) {

			$a = new \stdClass();
			$a->one = "one";
			$a->two = 'two';

			var_dump($a);

			$b = new \stdClass();
			$b->one = "one1111111111111111";
			$b->three = 'three';

			$c = (object) array_merge( (array) $a, (array) $b );

			var_dump($c);

			$str_ret = '';

			$x = '\WPezBoilerStrap\Toolbox\Tools\View_Macros';
			$test = 'test2';
			$x::$test('comp name desc');

			$str_ret .= $this->element_open($vargs->wrapper_tag, $vargs->wrapper_global_attrs);

			$str_ret .= $this->element_open($vargs->name_tag, $vargs->name_global_attrs);
			$str_ret .= esc_attr($mod->name);
			$str_ret .= $this->element_close($vargs->name_tag);

			if ( $vargs->description_active !== false && ( ! empty($mod->description) === true || ( empty($mod->description) === true && $vargs->description_empty === true )) ) {
				$str_ret .= $this->element_open( $vargs->description_tag, $vargs->description_global_attrs );
				$str_ret .= esc_attr( $mod->description );
				$str_ret .= $this->element_close( $vargs->description_tag );
			}

			$str_ret .= $this->element_close($vargs->wrapper_tag);

			return $str_ret;
		}


		protected function lang_defaults() {

			$lang = new \stdClass();

			return $lang;
		}

		protected function mod_defaults() {

			$mod = new \stdClass();

			$mod->name = 'Mod: Name';
			$mod->description = 'Mod-Description';

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

			$obj_enc->wrapper_active = false;
			$obj_enc->wrapper_tag = 'div';
			$obj_enc->wrapper_global_attrs = array(
				// 'class' => 'HEADER-CLASS'
			);

			$vargs = new \stdClass();
			$vargs->enclose = $obj_enc;

			// note: this wrapper is NOT the enclose wrapper. they are independent.
			$vargs->wrapper_tag = 'div';
			$vargs->wrapper_global_attrs = array();

			$vargs->name_tag = 'h1';
			$vargs->name_global_attrs = array();

			// master on/off for the description
			$vargs->description_active = true;
			// if empty (description) === true then continue to render desc_tag + global_attrs
			// false means that if the description is empty don't do the tag + global_attrs
			$vargs->description_empty = true;
			$vargs->description_tag = 'p';
			$vargs->description_global_attrs = array();

			return $vargs;
		}
	}
}