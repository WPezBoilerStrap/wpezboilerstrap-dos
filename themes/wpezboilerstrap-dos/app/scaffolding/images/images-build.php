<?php

namespace WPezTheme\Scaffolding;

if ( ! class_exists( 'Images_Build' ) ) {
    class Images_Build {

    	protected $_jpeg_quality;
	    protected $_featured_image_key;

        function __construct() {

            add_action( 'init', array($this, 'build') );
        }

        public function build(){

            $ins_images = new Images_Args();
            $arr_objs_ez = $ins_images->get();
	        $obj_settings = $ins_images->get('settings');

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
            if ( isset($arr_objs_ez[ $obj_settings->featured_image_key ])) {
	            $arr_objs_ez[ $obj_settings->featured_image_key ]->featured_image = true;
            }

	        // - let's use a longer more complete list of ratios;
            $obj_ratios = new \WPez\WPezClasses\Reference\Aspect_Ratios();
            $arr_ratios = $obj_ratios->ez_get();

	        // - add image size
	        $ins_ais = new \WPez\WPezClasses\Scaffolding\Add_Image_Size();
	        // set the new ratious
	        $ins_ais->set('ratios', $arr_ratios);
	        // load'em up!
	        $ins_ais->ez_loader($arr_objs_ez);

	        // and now to the helpers
            $ins_img_help = new \WPez\WPezClasses\Scaffolding\Helpers_Images();
	        // remove the h and w when inseting an img
	        $ins_img_help->remove_width_height_attributes();
	        // adjust the jpeg quality
	        $ins_img_help->jpeg_quality($obj_settings->jpeg_quality);
	        // add / remove image size to the select when adding an image
	        $ins_img_help->image_size_names_choose_append($arr_objs_ez);
	        // $ins_img_help->image_size_names_choose_remove();
	        //$ins_img_help->image_size_names_choose_replace($arr_objs_ez);
        }

    }
}
new Images_Build();