<?php

namespace WPezTheme;

if ( ! class_exists('Single_Wrapper')) {
	class Single_Wrapper extends \WPezBoilerStrap\Toolbox\Parents\Controller
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
			$obj->class = '\\WPezBoilerStrap\Views\Groups\Group_Two_V1';
			$obj->args = $this->get_view_args();
			$obj->method = 'render';

			$str_ret = $this->ez_loader($obj);

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

			$gtp_path = $this->gtp_path(__DIR__) . '////';


			$obj = new \stdClass();

			$part        = new \stdClass();

			$part->active = true;
			$part->slug_path = $gtp_path;
			$part->slug  = 'single-post-header';
			$part->name  = '';
			$part->class = '\\WPezTheme\Single_Post_Header';
			$part->args  = $this->model();
			$part->method = 'get_view';

			$str_sing_ph = $this->ez_loader($part);

			$obj->one = $str_sing_ph;

			// -
			$part        = new \stdClass();

			$part->active = true;
			$part->slug_path = $gtp_path;
			$part->slug  = 'single-content';
			$part->name  = '';
			$part->class = '\\WPezTheme\Single_Content';
			$part->args  = '';
			$part->method = 'get_view';

			$str_sing_con = $this->ez_loader($part);

			$obj->two = $str_sing_con;

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

			// ->enclose
			$enc = new \stdClass();
			$enc->semantic_tag = 'article';


			$obj = new \stdClass();
			$obj->enclose = $enc;

			return $obj;
		}



	}
}