<?php

namespace WPezTheme;

if ( ! class_exists( 'Single_Term_Category' ) ) {
	class Single_Term_Category extends \WPezBoilerStrap\Toolbox\Parents\Controller {

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
			$obj->class = '\\WPezBoilerStrap\Views\Components\Icon_Label_Links_V1';
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

			$lang->label = ' Categories: '; // e.g. Tags, Catgories, etc.

			return $lang;
		}

		/**
		 * return obj
		 */
		protected function model() {

			global $post;

			$obj = new \stdClass();

			$single = new \WPezBoilerStrap\Models\Posts\Single_V1();
			$obj->array_links = $single->get_terms($post->ID, 'category');

			return $obj;
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

			// $obj_vargs = $this->_wpezconfig->get('viewargs');

			// $x = $obj_vargs->get($str_method);

			$vargs = $this->_wpezconfig->ez_get('viewargs', $str_method);

			return $vargs;
		}


	}
}