<?php

namespace WPezTheme\Scaffolding;

if ( !class_exists( 'Images_Build' ) ) {

    class Images_Build
    {

        function __construct()
        {
            add_action( 'init', array($this, 'build') );
        }

        public function build(){

            $obj_i = new Images();
            $arr_args = $obj_i->get();

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
            $arr_args['w1170o']->featured_image = true;

            /**
             * let's use a longer more complete list of ratios;
             */
            $obj_ratios = new \WPezClasses\Standards\Aspect_Ratios();
            $arr_ratios = $obj_ratios->get();

            $obj_ais = new \WPezClasses\Scaffolding\Add_Image_Size();
            $obj_ais->set('resize_ratios', $arr_ratios);

            // do it!
            $x = $obj_ais->loader($arr_args);

            $obj_helper = new \WPezClasses\Scaffolding\Helpers_Images();
            $obj_helper->set_isnc_append($arr_args);

        }
    }

}
new Images_Build();