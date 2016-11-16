<?php

namespace WPez\WPezBoilerStrap\Views\Components;

if ( ! class_exists( 'Icon_Text_Description_V1' ) ) {
	class Icon_Text_Description_V1 extends \WPez\WPezBoilerStrap\Toolbox\Parents\View {


		protected function view( $mod, $parts, $vargs ) {

			$mac = $this->_mac;

			$str_ret = '';
			$str_ret .= $mac::element_open( $vargs->wrapper_tag, $vargs->wrapper_global_attrs );

			$str_ret .= $mac::icon_text(
				$vargs->icon_tag,
				$vargs->icon_global_attrs,
				$vargs->text_tag,
				$vargs->text_global_attrs,
				$vargs->text
			);

			if ( $vargs->description_active !== false && ( ! empty( $mod->description ) === true || ( empty( $mod->description ) === true && $vargs->description_empty === true ) ) ) {
				$str_ret .= $mac::element_open( $vargs->description_tag, $vargs->description_global_attrs );
				$str_ret .= esc_attr( $mod->description );
				$str_ret .= $mac::element_close( $vargs->description_tag );
			}

			$str_ret .= $mac::element_close( $vargs->wrapper_tag );

			return $str_ret;
		}


		protected function lang_defaults() {

			$lang = new \stdClass();

			return $lang;
		}


		protected function mod_defaults() {

			$mod = new \stdClass();

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

			$obj_enc->semantic_active       = true;
			$obj_enc->semantic_tag          = 'nav';
			$obj_enc->semantic_global_attrs = array(//'class' => 'my semantic class test'
			);

			$obj_enc->view_wrapper_active       = false;
			$obj_enc->view_wrapper_tag          = 'div';
			$obj_enc->view_wrapper_global_attrs = array(// 'class' => 'HEADER-CLASS'
			);

			$vargs          = new \stdClass();
			$vargs->enclose = $obj_enc;

			// note: this wrapper is NOT the enclose wrapper. they are independent.
			$vargs->wrapper_tag          = 'div';
			$vargs->wrapper_global_attrs = array();

			$vargs->icon_tag          = 'i';
			$vargs->icon_global_attrs = array();

			$vargs->text = '';
			$vargs->text_tag          = 'h1';
			$vargs->text_global_attrs = array();

			// master on/off for the description
			$vargs->description_active = true;
			// if empty (description) === true then continue to render desc_tag + global_attrs
			// false means that if the description is empty don't do the tag + global_attrs
			$vargs->description_empty        = true;
			$vargs->description_tag          = 'p';
			$vargs->description_global_attrs = array();

			return $vargs;
		}
	}
}