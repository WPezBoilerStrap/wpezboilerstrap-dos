<?php

namespace WPezBoilerStrap\Views\Footers;

if ( ! class_exists('Footer_V1') ) {
	class Footer_V1 extends \WPezBoilerStrap\Library\Parents\View {

		function view( $lang, $mod, $vargs, $vws ) {

			$str_ret = '';

			$str_ret .= '<footer>';

			$str_ret .= ' - TODO footer - ';

			$str_ret .= '</footer>';

			return $str_ret;

		}

	}
}