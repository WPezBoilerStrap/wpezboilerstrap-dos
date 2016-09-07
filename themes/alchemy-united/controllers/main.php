<?php

namespace WPezTheme;

if ( ! class_exists('Main')) {
	class Main extends \WPezBoilerStrap\Toolbox\Parents\Controller
	{
		protected $_wpezconfig;

		public function __construct() {

			// $this->_wpezconfig = WPezConfig::ez_new();
		}

		/*
 * return string
 */
		public function get_view(){

			$obj = new \stdClass();

			$obj->active = true;
			$obj->class = '\\WPezBoilerStrap\Views\Groups\Group_One_V1';
			$obj->args = $this->get_view_args();
			$obj->method = 'render';

			$str_ret = $this->ez_loader($obj);

			return $str_ret;
		}

		/*
		 * return obj
		 */
		protected function language() {

			$obj = new \stdClass();

			return $obj;
		}

		/*
		 * return obj
		 */
		protected function model() {

			$obj = new \stdClass();

			return $obj;
		}

		/*
		 * return obj
		 */
		protected function partials() {

			$obj = new \stdClass();

			if ( is_page() ){

				$part        = new \stdClass();

				$part->active = true;
				$part->slug  = 'controllers\page';
				$part->name  = '';
				$part->class = '\\WPezTheme\Page';
				$part->args  = '';
				$part->method = 'get_view';

				$obj->one = $this->ez_loader($part);

			} elseif ( is_single() ) {

				$part        = new \stdClass();

				$part->active = true;
				$part->slug  = 'controllers\single';
				$part->name  = '';
				$part->class = '\\WPezTheme\Single';
				$part->args  = '';
				$part->method = 'get_view';

				$obj->one = $this->ez_loader($part);

			} elseif ( is_404() ){

				$part        = new \stdClass();

				$part->active = true;
				$part->slug  = 'controllers\is-404';
				$part->name  = '';
				$part->class = '\\WPezTheme\Is_404';
				$part->args  = '';
				$part->method = 'get_view';

				$obj->one = $this->ez_loader($part);

			} else {

				$part        = new \stdClass();

				$part->active = true;
				$part->slug  = 'controllers\posts';
				$part->name  = '';
				$part->class = '\\WPezTheme\Posts';
				$part->args  = '';
				$part->method = 'get_view';

				$obj->one = $this->ez_loader($part);

			}
			return $obj;
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

			$obj = new \stdClass();

			return $obj;
		}



	}
}