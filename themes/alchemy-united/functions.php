<?php
/**
 * functions.php - Uber stripped down.
 */

namespace WPezTheme;

add_theme_support( 'post-thumbnails' );

if ( ! class_exists('Functions')){
    class Functions{

        function __construct(){

	        get_template_part('app\config\class-wpezconfig');

	        $this->build_loader();

            add_filter( 'the_content', array($this, 'the_content_filter') );
        }

        protected function build_loader(){

	        $obj = WPezConfig::ez_new();

            $b = $obj->get('build');

            get_template_part($b->slug, $b->name);
            if ( class_exists($b->class)){
                new $b->class();
            } else {
                // TODO?
            }
        }

        function the_content_filter($content) {

            $content = str_replace('<p><img', '<p class="p-image"><img' ,$content);
            // otherwise returns the database content
            return $content;
        }

    }
}
new Functions();