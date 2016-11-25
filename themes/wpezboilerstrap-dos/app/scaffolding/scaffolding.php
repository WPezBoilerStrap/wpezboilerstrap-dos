<?php
/*
 *
 */

namespace WPezTheme\Scaffolding;

if ( ! class_exists( 'Scaffolding' ) ) {

	class Scaffolding {

		function __construct() {

			add_action( 'init', array( $this, 'images' ) );

			add_action( 'after_setup_theme', array( $this, 'menus' ) );

			add_action( 'after_setup_theme', array( $this, 'scripts' ) );

			add_action( 'after_setup_theme', array( $this, 'sidebars' ) );

			add_action( 'after_setup_theme', array( $this, 'styles' ) );

			add_action( 'after_setup_theme', array( $this, 'theme_support' ) );

		}

		// TODO - clean this up / organize it. perhaps even make a second (or third) method
		public function images() {

			$obj            = new \stdClass();
			$obj->active    = true;
			$obj->slug_path = 'app/scaffolding/images';
			$obj->slug      = 'images-args';
			$obj->name      = '';

			$this->ez_gtp( $obj );

			$ins_args     = new Images_Args();
			$arr_args     = $ins_args->get();
			$obj_settings = $ins_args->get( 'settings' );

			/**
			 * Which of the image size args should be used for the featured image (i.e., set_post_thumbnail_size())?
			 * - Ref: http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
			 *
			 * Note 1: This 'name' will be used for set_post_thumbnail_size(), and will NOT (also) be used for the
			 * add_image_size() part of the process.
			 *
			 * The post_thumbnail is now more commonly known as the featured image. That is, it does not have to be
			 * a thumbnail in size.
			 * - Ref: http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
			 */
			if ( isset( $arr_args[ $obj_settings->featured_image_key ] ) ) {
				$arr_args[ $obj_settings->featured_image_key ]->featured_image = true;
			}

			// - let's use a longer more complete list of ratios;
			$ins_ratios = new \WPez\WPezClasses\Reference\Aspect_Ratios();
			$arr_ratios = $ins_ratios->ez_get();

			// - add image size
			$ins_ais = new \WPez\WPezClasses\Scaffolding\Add_Image_Size();
			// set the new ratious
			$ins_ais->set( 'ratios', $arr_ratios );
			// load'em up!
			$ins_ais->ez_loader( $arr_args );

			// and now to the helpers
			$ins_img_help = new \WPez\WPezClasses\Scaffolding\Helpers_Images();
			// remove the h and w when inseting an img
			$ins_img_help->remove_width_height_attributes();
			// adjust the jpeg quality
			$ins_img_help->jpeg_quality( $obj_settings->jpeg_quality );
			// add / remove image size to the select when adding an image
			$ins_img_help->image_size_names_choose_append( $arr_args );
			// $ins_img_help->image_size_names_choose_remove();
			//$ins_img_help->image_size_names_choose_replace($arr_args);
		}


		public function menus() {

			$obj            = new \stdClass();
			$obj->active    = true;
			$obj->slug_path = 'app/scaffolding/menus';
			$obj->slug      = 'menus-args';
			$obj->name      = '';

			$this->ez_gtp( $obj );

			$ins_args = new Menus_Args();
			$arr_args = $ins_args->get();

			$ins_ezc = new \WPez\WPezClasses\Scaffolding\Register_Nav_Menu();
			$ins_ezc->ez_loader( $arr_args );
		}


		public function scripts() {

			$obj            = new \stdClass();
			$obj->active    = true;
			$obj->slug_path = 'app/scaffolding/scripts';
			$obj->slug      = 'scripts-args';
			$obj->name      = '';

			$this->ez_gtp( $obj );

			$ins_args = new Scripts_Args();
			$arr_args = $ins_args->get();

			$ins_ezc = new \WPez\WPezClasses\WPezCore\WP_Enqueue();
			$ins_ezc->ez_loader( $arr_args );
		}


		public function sidebars() {

			$obj            = new \stdClass();
			$obj->active    = true;
			$obj->slug_path = 'app/scaffolding/sidebars';
			$obj->slug      = 'sidebars-args';
			$obj->name      = '';

			$this->ez_gtp( $obj );

			$ins_args = new Sidebars_Args();
			$arr_args = $ins_args->get();

			$ins_ezc = new \WPez\WPezClasses\Scaffolding\Register_Sidebar();
			$ins_ezc->ez_loader( $arr_args );
		}

		public function styles() {

			$obj            = new \stdClass();
			$obj->active    = true;
			$obj->slug_path = 'app/scaffolding/styles';
			$obj->slug      = 'styles-args';
			$obj->name      = '';

			$this->ez_gtp( $obj );

			$ins_args = new Styles_Args();
			$arr_args = $ins_args->get();

			$ins_ezc = new \WPez\WPezClasses\WPezCore\WP_Enqueue();
			$ins_ezc->ez_loader( $arr_args );
		}

		public function theme_support() {

			$obj            = new \stdClass();
			$obj->active    = true;
			$obj->slug_path = 'app/scaffolding/theme-support';
			$obj->slug      = 'theme-support-args';
			$obj->name      = '';

			$this->ez_gtp( $obj );

			$ins_args = new Theme_Support_Args();
			$arr_args = $ins_args->get();

			$ins_ezc = new \WPez\WPezClasses\Scaffolding\Add_Theme_Support();
			$ins_ezc->ez_loader( $arr_args );

		}


		public function ez_gtp( $obj = '' ) {

			if ( $obj->active === true ) {

				$str_slug = trim($obj->slug);
				if ( isset( $obj->slug_path ) && ! empty( $obj->slug_path ) ) {
					$str_slug = trim($obj->slug_path) . '/' . trim($obj->slug);
				}
				/**
				 * This is IMPORTANT. By using gtp() the child theme can naturally override any of these files
				 */
				get_template_part( $str_slug, trim($obj->name) );

			}
		}

		/*

		 public function loader( $g = '' )
		{

			foreach ( $this->args() as $obj ) {
				if ( $obj->active === true ) {

					$str_slug = $obj->slug;
					if ( isset($obj->slug_path) && ! empty($obj->slug_path) ) {
						$str_slug = $obj->slug_path . '/' . $obj->slug;
					}
					// This is IMPORTANT. By using gtp() the child theme can naturally override any of these files

	get_template_part( $str_slug, $obj->name );

	if ( isset($obj->new_active) && isset($obj->new) && $obj->new_active === true && class_exists( $obj->new ) ) {
	$str_new = $obj->new;
	new $str_new();
	}
}
}
}

		static function args()
		{

			$arr = array();

			/**
			$obj = new \stdClass();
			$obj->active = false;
			$obj->slug = 'app\scaffolding\document-ready\document-ready-build';
			$obj->name = '';

			$arr['document_ready'] = $obj;

			/**
			$obj = new \stdClass();
			$obj->active = false;
			$obj->slug = 'app\scaffolding\helpers\helpers-build';
			$obj->name = '';

			$arr['helpers_build'] = $obj;
			 */

		//
		/*
		$obj = new \stdClass();
		$obj->active = true;
		$obj->slug_path = 'app/scaffolding/images';
		$obj->slug = 'images-args';
		$obj->name = '';

		$arr['images'] = $obj;

		//
		$obj = new \stdClass();
		$obj->active = true;
		$obj->slug_path = 'app/scaffolding/images';
		$obj->slug = 'images-build';
		$obj->name = '';

		$arr['images_build'] = $obj;

		//===========================================================================
		//

		$obj = new \stdClass();
		$obj->active = true;
		$obj->slug_path = 'app/scaffolding/menus';
		$obj->slug = 'menus-args';
		$obj->name = '';

		$arr['menus'] = $obj;
		//
		$obj = new \stdClass();
		$obj->active = true;
		$obj->slug_path = 'app/scaffolding/menus';
		$obj->slug = 'menus-build';
		$obj->name = '';

		$arr['menus_build'] = $obj;

		//
		/*
		$obj = new \stdClass();
		$obj->active = true;
		$obj->slug_path = 'app/scaffolding/scripts';
		$obj->slug = 'scripts-args';
		$obj->name = '';

		$arr['scripts'] = $obj;

		//
		$obj = new \stdClass();
		$obj->active = true;
		$obj->slug_path = 'app/scaffolding/scripts';
		$obj->slug = 'scripts-build';
		$obj->name = '';

		$arr['scripts_build'] = $obj;

		//

		$obj = new \stdClass();
		$obj->active = true;
		$obj->slug_path = 'app/scaffolding/sidebars';
		$obj->slug = 'sidebars-args';
		$obj->name = '';

		$arr['sidebars'] = $obj;

		//
		$obj = new \stdClass();
		$obj->active = true;
		$obj->slug_path = 'app/scaffolding/sidebars';
		$obj->slug = 'sidebars-build';
		$obj->name = '';
		$obj->new_active = true;
		$obj->new = '\\WPezTheme\Scaffolding\Sidebars_Build'; // ref: http://stackoverflow.com/questions/5287315/can-php-namespaces-contain-variables

		$arr['sidebars_build'] = $obj;


		// == styles
		$obj = new \stdClass();
		$obj->active = false;
		$obj->slug_path = 'app/scaffolding/styles';
		$obj->slug = 'styles-args';
		$obj->name = '';

		$arr['styles'] = $obj;

		//
		$obj = new \stdClass();
		$obj->active = false;
		$obj->slug_path = 'app/scaffolding/styles';
		$obj->slug = 'styles-build';
		$obj->name = '';
		$obj->new_active = true;
		$obj->new = '\\WPezTheme\Scaffolding\Styles_Build';

		$arr['styles_build'] = $obj;


		// == theme-support
		$obj = new \stdClass();
		$obj->active = false;
		$obj->slug_path = 'app/scaffolding/theme-support';
		$obj->slug = 'theme-support-args';
		$obj->name = '';

		$arr['theme_support_args'] = $obj;

		//
		$obj = new \stdClass();
		$obj->active = false;
		$obj->slug_path = 'app/scaffolding/theme-support';
		$obj->slug = 'theme-support-build';
		$obj->name = '';
		$obj->new_active = true;
		$obj->new = '\\WPezTheme\Scaffolding\Theme_Support_Build';


		$arr['theme_support_build'] = $obj;


		return $arr;

	}
	*/

	}
}