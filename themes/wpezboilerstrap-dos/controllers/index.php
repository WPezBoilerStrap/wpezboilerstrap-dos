<?php

namespace WPezTheme;

if ( ! class_exists( 'Index')) {
	class Index extends \WPez\WPezBoilerStrap\Toolbox\Parents\Controller
	{

		/**
		 * @return mixed
		 */
		public function get_view(){

			$gv = new \stdClass();

			$gv->active = true;
			$gv->class = '\\WPez\WPezBoilerStrap\Views\Indexes\Index_BS3_V1';
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

			$parts       = new \stdClass();

			$part = new \stdClass();

			$parts->pre_head_close = ''; // e.g. add google analytics snippet

			$part->active = true;
			$part->slug  = 'controllers/index-body';
			$part->name  = '';
			$part->class = '\\WPezTheme\Index_Body';
			$part->args  = $this->_gargs;
			$part->method = 'get_view';

			$str_body = $this->ez_gtp_loader($part);
			$parts->body = $str_body;



			return $parts;
		}

		/*
		 * return obj
		 */
		protected function router() {

			$route = new \stdClass();

			return $route;
		}

		/*
		 * return obj
		 */
		protected function viewargs() {

			$str_method = 'index';

			$vargs = $this->_vargs->get($str_method);

			return $vargs;
		}

	}
}