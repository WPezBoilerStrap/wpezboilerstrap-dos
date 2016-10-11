<?php

namespace WPezTheme;

if ( ! class_exists('Blog_Group')) {
	class Blog_Group extends \WPezBoilerStrap\Toolbox\Parents\Controller
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
			$obj_gv->class = '\\WPezBoilerStrap\Views\Groups\Group_Four_V1';
			$obj_gv->args = $this->get_view_args();
			$obj_gv->method = 'render';

			$str_ret = $this->ez_loader($obj_gv);

			return $str_ret;
		}

		/**
		 * return obj
		 */
		protected function language() {

			$lang = new \stdClass();

			return $lang;
		}

		/**
		 * return obj
		 */
		protected function macros() {

			$mac = new \stdClass();

			return $mac;
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



			$part        = new \stdClass();

			$part->active = true;
			$part->slug_path = 'controllers\components';
			$part->slug  = 'tabs-collapse';
			$part->name  = '';
			$part->class = '\\WPezTheme\Tabs_Collapse';
			$part->args  = '';
			$part->method = 'get_view';

			$str_accord = $this->ez_loader($part);

			// -
			$part        = new \stdClass();

			$part->active = true;
			$part->slug_path = $this->gtp_path(__DIR__);
			$part->slug  = 'is-archive';
			$part->name  = '';
			$part->class = '\\WPezTheme\Is_Archive';
			$part->args  = '';
			$part->method = 'get_view';

			$str_is_arch = $this->ez_loader($part);

			// -
			$part        = new \stdClass();

			$part->active = true;
			$part->slug_path = $this->gtp_path(__DIR__);
			$part->slug  = 'blog-loop';
			$part->name  = '';
			$part->class = '\\WPezTheme\Blog_Loop';
			$part->args  = '';
			$part->method = 'get_view';

			$str_sing_wrap = $this->ez_loader($part);

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

			$parts = new \stdClass();
			$parts->one = $str_accord;
			$parts->two = $str_is_arch;
			$parts->three = $str_sing_wrap;
			$parts->four = $str_posts_pg;

			return $parts;
		}


		/**
		 * return obj
		 */
		protected function router() {

			$route = new \stdClass();

			return $route;
		}


		/**
		 * return obj
		 */
		protected function viewargs() {

			$vargs = new \stdClass();

			return $vargs;
		}



	}
}