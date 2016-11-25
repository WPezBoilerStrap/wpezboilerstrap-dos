<?php

namespace WPezTheme;

if ( ! class_exists('Blog_Loop')) {
	class Blog_Loop extends \WPez\WPezBoilerStrap\Toolbox\Parents\Controller
	{

		/**
		 * return string
		 */
		public function get_view(){

			$str_ret = '';

			$obj_gv = new \stdClass();

			$obj_gv->active = true;
			$obj_gv->class = '\\WPez\WPezBoilerStrap\Views\Posts\Post_List_Layout_V1';
		//	$obj_gv->class = '\\WPez\WPezBoilerStrap\Views\Groups\Group_Four_V1';
			$obj_gv->args = $this->get_view_args();
			//$obj_gv->method = 'render';
			$obj_gv->method = false;

			$obj_view = $this->ez_gtp_loader($obj_gv);

			$str_ret = '';
			$arr_posts = $obj_gv->args->mod->posts;

			foreach ($arr_posts as $key => $obj){

				$obj_view->set_mod($obj);
				$str_ret .= $obj_view->render();

			}

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

			global $wp_query;

			$mod = new \stdClass();

			$tools_cloning = new \WPez\WPezBoilerStrap\Toolbox\Tools\Cloning();
			$model_users = new \WPez\WPezBoilerStrap\Models\Users\User_V1();
			$model_single = new \WPez\WPezBoilerStrap\Models\Posts\Single_V1();

			$arr_taxs = array(
				'category' => true,
				'post_tag' => true
			);
			$str_img_size = 'thumbnail';

			/**
			 * we're going to create a new array of post details (e.g., permalink)
			 * this is to avoid - however rare - any potential of conflicts in property names
			 * with the standard post object. PITA but it's safer / smarter this way.
			 *
			 * in theory, there's also the potential to cache details at the post ID level. so
			 * it makes sense to key this array with the post ID.
			 */
			$arr_posts = array();
			// TODO - check to make sure we have posts?
			foreach ( $wp_query->posts as $key => $obj_post){

				$obj_new = $tools_cloning->ez_clone($obj_post);

				// get the terms
				$obj_new->terms = $model_single->get_these_terms($obj_new->ID, $arr_taxs);
				// add some image stuff
				$obj_new->img = $model_single->featured_image_min($obj_new->ID, $str_img_size);
				// add the user  author
				$obj_new->user = $model_users->user_min($obj_new->post_author);

				$arr_posts[$obj_new->ID] = $obj_new;
			}
			$mod->posts = $arr_posts;
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
			$obj_enc->semantic_tag = 'article';
			$obj_enc->semantic_global_attrs = array(
				'itemscope' =>'',
				'itemtype' => "http://schema.org/BlogPosting"
			);

			$obj_enc->view_wrapper_active = true;   // default is true
			$obj_enc->view_wrapper_tag = 'div';
			$obj_enc->view_wrapper_global_attrs = array(
				'class' => 'container'
			);

			$vargs = new \stdClass();
			$vargs->enclXose = $obj_enc;

			$vargs->date_format = 'F d, Y';

			return $vargs;
		}

	}
}