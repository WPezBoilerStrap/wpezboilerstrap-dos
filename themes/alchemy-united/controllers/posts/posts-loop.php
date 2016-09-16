<?php

namespace WPezTheme;

if ( ! class_exists('Posts_Loop')) {
	class Posts_Loop extends \WPezBoilerStrap\Toolbox\Parents\Controller
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
			$gv->class = '\\WPezBoilerStrap\Views\Posts\Post_List_Layout_V1';
			$gv->args = $this->get_view_args();
			// $gv->args->use = "defaults";
			$gv->method = false;  // false means we get an instance of the class back

			$obj_view = $this->ez_loader($gv);

			$str_ret = '';
			$arr_posts = $gv->args->mod->posts;

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

			$mod = new \stdClass();

			global $wp_query;

			$obj_users_v1 = new \WPezBoilerStrap\Models\Users\User_V1();
			$obj_single_v1 = new \WPezBoilerStrap\Models\Posts\Single_V1();

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

				$obj_new = new \stdClass;

				$obj_new = $this->ez_clone($obj_post);

				// add the terms
				$obj_new->ezx->terms = $obj_single_v1->get_terms_multi( $obj_new->ID, $arr_taxs);
				// add the featured image
				$obj_new->ezx->img = $obj_single_v1->featured_image_min($obj_new->ID, $str_img_size);
				// add the user  author
				$obj_new->ezx->user = $obj_users_v1->user_min($obj_new->post_author);

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

			$vargs = new \stdClass();

			$vargs->date_format = 'Y';

			return $vargs;
		}



	}
}