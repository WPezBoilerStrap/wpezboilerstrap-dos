<?php

namespace WPezTheme;

if ( ! class_exists('Single')) {
	class Single extends \WPezBoilerStrap\Toolbox\Parents\Controller
	{
		protected $_wpezconfig;

		public function __construct() {

			// $this->_wpezconfig = WPezConfig::ez_new();
		}

		/**
		 * return string
		 */
		public function get_view(){

			$obj = new \stdClass();

			$obj->active = true;
			$obj->class = '\\WPezBoilerStrap\Views\Groups\Group_Three_V1';
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

			$part        = new \stdClass();

			$part->active = true;
			$part->slug  = 'controllers\components\tabs-collapse';
			$part->name  = '';
			$part->class = '\\WPezTheme\Tabs_Collapse';
			$part->args  = '';
			$part->method = 'get_view';

			$str_accord = $this->ez_loader($part);

			$obj->one = $str_accord;

			// -
			$part        = new \stdClass();

			$part->active = true;
			$part->slug  = 'controllers\single-wrapper';
			$part->name  = '';
			$part->class = '\\WPezTheme\Single_Wrapper';
			$part->args  = '';
			$part->method = 'get_view';

			$str_sing_wrap = $this->ez_loader($part);

			$obj->two = $str_sing_wrap;


			// -
			$part        = new \stdClass();

			$part->active = true;
			$part->slug  = 'controllers\single-prev-next';
			$part->name  = '';
			$part->class = '\\WPezTheme\Single_Prev_Next';
			$part->args  = '';
			$part->method = 'get_view';

			$str_sing_np = $this->ez_loader($part);

			$obj->three = $str_sing_np;

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