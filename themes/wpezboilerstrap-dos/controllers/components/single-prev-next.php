<?php

namespace WPezTheme;

if ( ! class_exists('Single_Prev_Next')) {
	class Single_Prev_Next extends \WPez\WPezBoilerStrap\Toolbox\Parents\Controller
	{

		/**
		 * return string
		 */
		public function get_view(){

			$obj = new \stdClass();

			$obj->active = true;
			$obj->class = '\\WPez\WPezBoilerStrap\Views\Components\Prev_Next_Min_V1';
			$obj->args = $this->get_view_args();
		//	$obj->args->use = 'defaults';
			$obj->method = 'render';

			$str_ret = $this->ez_gtp_loader($obj);

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

			$obj_adj_v1 = new \WPez\WPezBoilerStrap\Models\Components\Adjacent_Post_V1();
			//	$ga = $single->get_adjacent();
			$mod = $obj_adj_v1->get_adjacent_posts();

			return $mod;
		}

		/**
		 * return obj
		 */
		protected function partials() {

			$parts = new \stdClass();

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

			// $obj = new \stdClass();

			$str_method = 'single_prev_next';

			$vargs = $this->_vargs->get($str_method);

			return $vargs;

		}



	}
}