<?php

namespace WPezTheme;

if ( ! class_exists('Posts_Pagination')) {
	class Posts_Pagination extends \WPezBoilerStrap\Toolbox\Parents\Controller
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

			$gv = new \stdClass();

			$gv->active = true;
			$gv->class = '\\WPezBoilerStrap\Views\Components\Pagination_V1';
			$gv->args = $this->get_view_args();
		//	$obj_gv->args->use = 'defaults';
			$gv->method = 'render';

			$str_ret = $this->ez_loader($gv);

			return $str_ret;
		}

		/**
		 * return obj
		 */
		protected function language() {

			$lang = new \stdClass();

			$lang->prev = ' Prev';
			$lang->next = 'Next ';

			return $lang;
		}

		/**
		 * return obj
		 */
		protected function model() {

			global $post;

			$mod = new \stdClass();


			$loop = new \WPezBoilerStrap\Models\Components\Paginate_Links_V1();
			$arr_pages = $loop->get_pagination();
			$mod->pages = $arr_pages;

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

			$vargs = new \stdClass();

			$vargs->wrapper_tag = 'ul';
			$vargs->wrapper_global_attrs = array(
				'class' => 'pagination'
			);
			$vargs->page_tag = 'li';
			$vargs->page_class_current = 'active';

			$vargs->icon_tag = 'i';
			$vargs->icon_prev_global_attrs = array(
				'class' => 'glyphicon glyphicon-chevron-left',
				'aria-hidden' => "true"
			);

			$vargs->icon_next_global_attrs = array(
				'class' => 'glyphicon glyphicon-chevron-right',
				'aria-hidden' => "true"
			);

			return $vargs;
		}



	}
}