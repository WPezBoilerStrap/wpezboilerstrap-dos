<?php

namespace WPezTheme;

if ( ! class_exists('Posts')) {
	class Posts extends \WPezBoilerStrap\Toolbox\Parents\Controller
	{
		protected $_wpezconfig;

		public function __construct() {

			// $this->_wpezconfig = WPezConfig::ez_new();
		}

		/**
		 * return string
		 */
		public function get_view(){

			$str_ret = '';

			$obj_gv = new \stdClass();

			$obj_gv->active = true;
			$obj_gv->class = '\\WPezBoilerStrap\Views\Groups\Group_Three_V1';
			$obj_gv->args = $this->get_view_args();
			$obj_gv->method = 'render';

			$str_ret = $this->ez_loader($obj_gv);

			return $str_ret;
		}

		/**
		 * return obj
		 */
		protected function language() {

			$obj = new \stdClass();

			return $obj;
		}

		/**
		 * return obj
		 */
		protected function model() {

			$obj = new \stdClass();

			return $obj;
		}

		/**
		 * return obj
		 */
		protected function partials() {

			$parts = new \stdClass();

			$part        = new \stdClass();

			$part->active = true;
			$part->slug_path = 'controllers\components';
			$part->slug  = 'tabs-collapse';
			$part->name  = '';
			$part->class = '\\WPezTheme\Tabs_Collapse';
			$part->args  = '';
			$part->method = 'get_view';

			$str_accord = $this->ez_loader($part);

			$parts->one = $str_accord;

			// -
			$part        = new \stdClass();

			$part->active = true;
			$part->slug_path = $this->gtp_path(__DIR__);
			$part->slug  = 'posts-loop';
			$part->name  = '';
			$part->class = '\\WPezTheme\Posts_Loop';
			$part->args  = '';
			$part->method = 'get_view';

			$str_sing_wrap = $this->ez_loader($part);

			$parts->two = $str_sing_wrap;


			// -
			$part        = new \stdClass();

			$part->active = true;
			$part->slug_path = 'controllers\components';
			$part->slug  = 'posts-pagination';
			$part->name  = '';
			$part->class = '\\WPezTheme\Posts_Pagination';
			$part->args  = '';
			$part->method = 'get_view';

			$str_posts_pg = $this->ez_loader($part);

			$parts->three = $str_posts_pg;

			return $parts;
		}


		/**
		 * return obj
		 */
		protected function router() {

			$obj = new \stdClass();

			return $obj;
		}


		/**
		 * return obj
		 */
		protected function viewargs() {

			$obj = new \stdClass();

			return $obj;
		}



	}
}