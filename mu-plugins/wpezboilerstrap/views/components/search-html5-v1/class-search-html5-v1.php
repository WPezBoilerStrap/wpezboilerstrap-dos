<?php

namespace WPezBoilerStrap\Views\Components;

class Search_HTML5_V1 extends \WPezBoilerStrap\Toolbox\Parents\View {

	function view( $lang, $mod, $parts, $vargs ) {

		$str_ret = ' Component Search Form TODO<br>';

		$str_ret .= $this->element_open('form', $vargs->form_global_attrs );
		$str_ret .= '<label>';
		$str_ret .= '<span class="screen-reader-text">' . _x( 'Search for:', 'label' ) . '</span>';
		$str_ret .=  '<input' . $this->global_attrs($vargs->input_search_global_attrs) . ' value="' . esc_attr($mod->search_query) . '" />';
		$str_ret .= '</label>';
		$str_ret .=  '<input type="submit" class="search-submit" value="'. esc_attr_x( 'Search', 'submit button' ) .'" />';
		$str_ret .= '</form>';

		return $str_ret;

	}

	protected function lang_defaults() {

		$lang = new \stdClass();

		return $lang;
	}

	protected function mod_defaults() {

		global $wp_query;

		$mod = new \stdClass();

		$mod->input_search_value =  $wp_query->seach_query;

		return $mod;
	}


	protected function parts_defaults() {

		$parts = new \stdClass();

		return $parts;
	}

	protected function vargs_defaults() {

		$vargs = new \stdClass();

		$vargs->form_global_attrs = array(
			'role' => 'search',
			'method' => 'get',
			'class' => 'search-form TODO',
			'action' => esc_url( home_url( '/' ))
		);
		$vargs->input_search_global_attrs = array(
			'type' => 'search',
			'class' => 'search-field',
			'placeholder' => 'Search',
			'name' => "s"
		);

		return $vargs;
	}
}

