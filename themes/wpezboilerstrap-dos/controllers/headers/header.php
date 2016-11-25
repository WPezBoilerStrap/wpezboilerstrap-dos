<?php

namespace WPezTheme;

if ( ! class_exists('Header')) {
	class Header extends \WPez\WPezBoilerStrap\Toolbox\Parents\Controller
	{


		/**
		 * @return bool|string
		 */
		public function get_view(){

			$gv = new \stdClass();

			$gv->active = true;
			$gv->class = '\\WPez\WPezBoilerStrap\Views\Groups\Group_One_V1';
			$gv->args = $this->get_view_args();
			$gv->method = 'render';

			$str_ret = $this->ez_gtp_loader($gv);

			return $str_ret;
		}

		/*
		 * return obj
		 */
		protected function language() {

			$lang= new \stdClass();

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
			$part->slug_path  = 'controllers\menus';
			$part->slug  = 'header-menu';
			$part->name  = '';
			$part->class = '\\WPezTheme\Header_Menu';
			$part->args  = $this->_gargs;
			$part->method = 'get_view';

			$str_nav = $this->ez_gtp_loader($part);

			$parts = new \stdClass();
			$parts->one = $str_nav;

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

			$str_method = 'header';

			$obj_vargs = $this->_vargs->get($str_method);

			return $obj_vargs;
		}



	}
}