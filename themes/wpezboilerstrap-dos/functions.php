<?php
/**
 * functions.php - Uber stripped down.
 */

namespace WPezTheme;



if ( ! class_exists('Functions')){
    class Functions{

        function __construct(){
	        
	        get_template_part('app/scaffolding/scaffolding');
	        new Scaffolding\Scaffolding();

	       // $this->build_loader();

            add_filter( 'the_content', array($this, 'the_content_filter') );

        }

        protected function Xbuild_loader(){

	        $obj = WPezConfig::ez_new();

            $b = $obj->get('scaffolding');

            get_template_part($b->slug, $b->name);
            if ( class_exists($b->class)){
                new $b->class();
            } else {
                // TODO?
            }
        }

        public function the_content_filter($content) {

            $content = str_replace('<p><img', '<p class="p-image"><img' ,$content);
            // otherwise returns the database content
            return $content;
        }

    }
}
new Functions();