<?php

namespace WPezTheme;

if ( ! class_exists( 'Index_Body')) {
	class Index_Body extends \WPez\WPezBoilerStrap\Toolbox\Parents\Controller
	{

		/**
		 * @return mixed
		 */
		public function get_view(){

			$gv = new \stdClass();

			$gv->active = true;
			$gv->class = '\\WPez\WPezBoilerStrap\Views\Groups\Group_Three_V1';
			$gv->args = $this->get_view_args();
			$gv->method = 'render';

			$str_ret = $this->ez_gtp_loader($gv);

			return $str_ret;

		}

		/*
		 * return obj
		 */
		protected function language() {

			$lang = new \stdClass();

			return $lang;
		}

		/*
		 * return obj
		 */
		protected function model() {

			$mod = new \stdClass();

			return $mod;
		}

		/*
		 * return obj
		 */
		protected function partials() {

			$part        = new \stdClass();

			$part->active = true;
			$part->slug_path = 'controllers/headers';
			$part->slug  = 'header';
			$part->name  = '';
			$part->class = '\\WPezTheme\Header';
			$part->args  = $this->_gargs;
			$part->method = 'get_view';

			$str_header = $this->ez_gtp_loader($part);

			//
			$part        = new \stdClass();

			$part->active = true;
			$part->slug_path = 'controllers';
			$part->slug  = 'main';
			$part->name  = '';
			$part->class = '\\WPezTheme\main';
			$part->args  = $this->_gargs;
			$part->method = 'get_view';

			$str_main = $this->ez_gtp_loader($part);

			//
			$part        = new \stdClass();

			$part->active = true;
			$part->slug_path = 'controllers/footers';
			$part->slug  = 'footer-group';
			$part->name  = '';
			$part->class = '\\WPezTheme\Footer_Group';
			$part->args  = $this->_gargs;
			$part->method = 'get_view';

			$str_footer  = $this->ez_gtp_loader($part);

			//
			$parts = new \stdClass();

			$parts->one = $str_header;
			$parts->two = $str_main;
			$parts->three = $str_footer;

			return $parts;
		}

		/*
		 * return obj
		 */
		protected function router() {

			$obj = new \stdClass();

			return $obj;
		}

		/*
		 * return obj
		 */
		protected function viewargs() {

			$str_method = 'index_body';
			$vargs = $this->_vargs->get($str_method);

			return $vargs;
		}

	}
}