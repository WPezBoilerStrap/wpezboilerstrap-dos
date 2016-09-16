<?php



namespace WPezBoilerStrap\Views\Components;

class Search_HTML5_V1 extends \WPezBoilerStrap\Toolbox\Parents\View {


	function view( $lang, $mod, $parts, $vargs ) {

		$str_ret = 'Search HTML5 - TODO: testing';

		$str_ret .= $this->element_open('form', $vargs->form_global_attrs );
		$str_ret .= '<label>';
		$str_ret .= '<span class="' . $vargs->screen_reader_class . '">' . esc_attr($lang->screen_reader_text) . '</span>';
		$str_ret .= $this->element_open('input', $vargs->input_search_global_attrs );
		$str_ret .= '</label>';
		$str_ret .= $this->element_open('input', $vargs->input_submit_global_attrs );
		$str_ret .= '</form>';

		return $str_ret;

	}

	protected function lang_defaults() {

		$lang = new \stdClass();

		$lang->screen_reader_text ='Search for';
		$lang->input_search_placeholder = 'Search';
		$lang->input_submit_value = 'Search';

		return $lang;
	}

	protected function mod_defaults() {

		$mod = new \stdClass();

		$mod->seach_query = get_search_query();

		return $mod;
	}


	protected function parts_defaults() {

		$parts = new \stdClass();
		return $parts;
	}

	// REF - https://developer.wordpress.org/reference/hooks/get_search_form/
	protected function vargs_defaults() {

		$lang = $this->lang_defaults();
		$mod = $this->mod_defaults();

		$vargs = new \stdClass();

		// IMPORTANT - at a minimum, these are required. keys, as well as - for the most part - values
		$vargs->form_global_attrs = array(
			'role' => 'search',
			'method' => 'get',
			'class' => 'search-form TODO',
			'action' => esc_url( home_url( '/' ))  // mod?
		);

		// IMPORTANT - at a minimum, these are required. keys, as well as - for the most part - values
		$vargs->input_search_global_attrs = array(
			'type' => 'search',
			'class' => 'search-field',
			'placeholder' => $lang->input_search_placeholder, // language
			'name' => "s",
			'value' => $mod->seach_query // see mod() above
		);

		// IMPORTANT - at a minimum, these are required. keys, as well as - for the most part - values
		$vargs->input_submit_global_attrs = array(
			'type' => 'submit',
			'class' => 'search-submit',
			'value' => $lang->input_submit_value  // language
		);

		$vargs->screen_reader_class = 'screen-reader-text';

		return $vargs;
	}
}

