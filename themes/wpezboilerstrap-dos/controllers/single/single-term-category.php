<?php

namespace WPezTheme;

if ( ! class_exists( 'Single_Term_Category' ) ) {
	class Single_Term_Category extends \WPez\WPezBoilerStrap\Toolbox\Parents\Controller {

		protected $_wpezconfig;

		public function __construct() {

			$this->_wpezconfig = WPezConfig::ez_new();
		}

		/**
		 * return string
		 */
		public function get_view() {

			$str_ret = '';

			$obj = new \stdClass();

			$obj->active = true;
			$obj->class = '\\WPez\WPezBoilerStrap\Views\Components\Icon_Name_Links_V1';
			$obj->args = $this->get_view_args();
			// $obj->args->use = 'defaults';
			$obj->method = 'render';

			$str_ret = $this->ez_loader($obj);

			return $str_ret;
		}

		/**
		 * return obj
		 */
		protected function language() {

			$lang = new \stdClass();

			$lang->name = 'Categories: '; // e.g. Tags, Catgories, etc.

			return $lang;
		}

		/**
		 * @return \stdClass
		 */
		protected function macros() {

			$mac = new \stdClass();

			return $mac;
		}

		/**
		 * return obj
		 */
		protected function model() {

			global $post;

			$mod = new \stdClass();

			$arr_objs = get_the_terms($post->ID, 'category');

			$tools_clone = new \WPez\WPezBoilerStrap\Toolbox\Tools\Cloning();
			$arr_objs = $tools_clone->ez_clone_get_the_terms($arr_objs);

			$mod->name = $this->language()->name;
			$mod->array_objects = $arr_objs ;

			return $mod;
		}

		/**
		 * return obj
		 */
		protected function partials() {

			$obj = new \stdClass();

			return $obj;
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

			$str_method = 'single_term_category';

			$vargs = $this->_wpezconfig->ez_get('viewargs', $str_method);
			return $vargs;
		}


	}
}