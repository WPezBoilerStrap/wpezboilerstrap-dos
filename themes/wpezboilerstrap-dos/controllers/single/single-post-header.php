<?php

namespace WPezTheme;

if ( ! class_exists('Single_Post_Header')) {
	class Single_Post_Header extends \WPez\WPezBoilerStrap\Toolbox\Parents\Controller
	{
		protected $_wpezconfig;

		public function __construct($mix_args = '') {

			$this->_wpezconfig = WPezConfig::ez_new();
		}

		/**
		 * return string
		 */
		public function get_view(){

			$gv = new \stdClass();

			$gv->active = true;
			$gv->class = '\\WPez\WPezBoilerStrap\Views\Posts\Post_Header_V1';
			$gv->args = $this->get_view_args();
			$gv->method = 'render';

			$str_ret = $this->ez_loader($gv);

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

			global $post;

			$new_cloning = new \WPez\WPezBoilerStrap\Toolbox\Tools\Cloning();

			$mod = $new_cloning->ez_clone($post);

			$obj_user = new \WPez\WPezBoilerStrap\Models\Users\User_V1();
			$mod->user = $obj_user->user_min($mod->post_author);

			return $mod;

		}

		/**
		 * return obj
		 */
		protected function partials() {

			$gtp_path = $this->gtp_path(__DIR__) ;

			$part        = new \stdClass();

			$part->active = true;
			$part->slug_path = $gtp_path;
			$part->slug  = 'single-term-group';
			$part->name  = '';
			$part->class = '\\WPezTheme\Single_Term_Group';
			$part->args  = '';
			$part->method = 'get_view';

			$str_term_wrap = $this->ez_loader($part);

			$part        = new \stdClass();

			$part->active = false; // <<<
			$part->slug_path = $gtp_path;
			$part->slug  = 'single-term-post-tag';
			$part->name  = '';
			$part->class = '\\WPezTheme\Single_Term_Post_tag';
			$part->method = 'get_view';

			//$str_term_tags = $this->ez_loader($part);

			$parts = new \stdClass();

			$parts->one = $str_term_wrap;
			$parts->two = '';

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

			$str_method = 'single_post_header';
			$vargs = $this->_wpezconfig->ez_get('viewargs', $str_method);

			return $vargs;
		}



	}
}