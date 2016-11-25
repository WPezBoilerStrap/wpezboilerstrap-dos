<?php

namespace WPezTheme;

if ( ! class_exists('Blog_Loop_Group')) {
	class Blog_Loop_Group extends \WPez\WPezBoilerStrap\Toolbox\Parents\Controller
	{

		/**
		 * return string
		 */
		public function get_view(){

			$str_ret = '';

			$obj_gv = new \stdClass();

			$obj_gv->active = true;
			$obj_gv->class = '\\WPez\WPezBoilerStrap\Views\Groups\Group_One_V1';
			$obj_gv->args = $this->get_view_args();
			$obj_gv->method = 'render';

			$str_ret = $this->ez_gtp_loader($obj_gv);

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

			$mod = new \stdClass();
			return $mod;
		}

		/**
		 * return obj
		 */
		protected function partials() {

			// -
			$part        = new \stdClass();

			$part->active = true;
			$part->slug_path = 'controllers\blog';
			$part->slug  = 'blog-loop';
			$part->class = '\\WPezTheme\Blog_Loop';
			$part->args  = $this->_gargs;
			$part->method = 'get_view';

			$str_blog_loop = $this->ez_gtp_loader($part);

			$parts = new \stdClass();
			$parts->one = $str_blog_loop;

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

			$obj_enc = new \stdClass();

			$obj_enc->active = true;            // an enclosure master switch - default is true

			$obj_enc->semantic_active = true;   // default is true
			$obj_enc->semantic_tag = 'section';
			$obj_enc->semantic_global_attrs = array(
				//'class' => 'container'
			);

			$obj_enc->view_wrapper_active = true;   // default is true
			$obj_enc->view_wrapper_tag = 'div';
			$obj_enc->view_wrapper_global_attrs = array(
				'class' => 'TODO-container'
			);

			$vargs = new \stdClass();
			$vargs->enclose = $obj_enc;

			return $vargs;
		}



	}
}