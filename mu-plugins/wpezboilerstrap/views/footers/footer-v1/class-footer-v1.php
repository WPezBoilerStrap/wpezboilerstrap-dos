<?php

namespace WPezBoilerStrap\Views\Footers;

if ( ! class_exists('Footer_V1') ) {
	class Footer_V1 extends \WPezBoilerStrap\Toolbox\Parents\View {

		protected function view( $lang, $mod, $parts, $vargs ) {

			$str_ret = '';

			$str_ret .= $this->element_open($vargs->left_tag, $vargs->left_global_attrs );

			$str_ret .= '<p>';

			$str_ret .= esc_attr($vargs->copyright_symbol) . esc_attr($lang->copyright_time) . esc_attr($lang->copyright_name);

			$str_ret .= '</p>';

			$str_ret .= $this->element_close($vargs->left_tag);

			$str_ret .= $this->element_open($vargs->middle_tag, $vargs->middle_global_attrs );

			$str_ret .= '<img src="' . esc_url($vargs->logo_url) . '"' . $this->global_attrs($vargs->logo_class).  '>' ;

			$str_ret .= $this->element_close($vargs->middle_tag);


			$str_ret .= $this->element_open($vargs->right_tag, $vargs->right_global_attrs );

			$str_ret .= '<p>';

			$str_ret .= '<a href="' . esc_attr($vargs->back_to_top) .'">';

			$str_ret .= esc_attr($lang->back_to_top);

			$str_ret .= '</a>';

			$str_ret .= '</p>';



			$str_ret .= $this->element_close($vargs->right_tag);

			return $str_ret;
		}


		protected function lang_defaults() {

			$lang = new \stdClass();

			$lang->copyright_time = '2016 ';
			$lang->copyright_name = 'Brand Name';

			$lang->back_to_top = 'Back to Top';

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

			$obj_enc->active = true;            // an enclosure master switch - default is true

			$obj_enc->semantic_active = true;   // default is true
			$obj_enc->semantic_tag = 'footer';
			$obj_enc->semantic_global_attrs = array(
				'class' => 'container'
			);

			$obj_enc->wrapper_active = true;   // default is true
			$obj_enc->wrapper_tag = 'row';
			$obj_enc->wrapper_global_attrs = array(
				//'class' => 'my wrapper class test'
			);


			$vargs = new \stdClass();
			$vargs->enclose = $obj_enc;

			$vargs->left_tag = 'div';
			$vargs->left_global_attrs = array(
				'class' => 'col-xs-12 col-md-5'
			);

			$vargs->middle_tag = 'div';
			$vargs->middle_global_attrs = array(
				'class' => 'col-xs-12 col-md-2'
			);

			$vargs->right_tag = 'div';
			$vargs->right_global_attrs = array(
				'class' => 'col-xs-12 col-md-5 text-right'
			);

			$vargs->copyright_symbol = '&copy; ';

			$vargs->logo_url = 'http://placehold.it/75x75';
			$vargs->logo_class = array(
				'class' => 'center-block'
			);

			$vargs->back_to_top_href = '#top';

			return $vargs;



		}

	}
}