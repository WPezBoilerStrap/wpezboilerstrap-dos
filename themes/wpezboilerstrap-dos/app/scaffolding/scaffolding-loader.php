<?php
/*
 *
 */

namespace WPezTheme;

if ( !class_exists( 'Scaffolding_Loader' ) ) {

    class Scaffolding_Loader
    {

        function __construct()
        {

            $this->loader();
        }

        public function loader( $g = '' )
        {

            foreach ( $this->args() as $obj ) {
                if ( $obj->active === true ) {

	                $str_slug = $obj->slug;
	                if ( isset($obj->slug_path) && ! empty($obj->slug_path) ) {
		                $str_slug = $obj->slug_path . '/' . $obj->slug;
	                }
	                /**
	                 * This is IMPORTANT. By using gtp() the child theme can naturally override any of these files
	                 */
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
*/

            /**
            $obj = new \stdClass();
            $obj->active = false;
            $obj->slug = 'app\scaffolding\helpers\helpers-build';
            $obj->name = '';

            $arr['helpers_build'] = $obj;
             */

            //
            $obj = new \stdClass();
            $obj->active = true;
	        $obj->slug_path = 'app\scaffolding\images';
            $obj->slug = 'images-args';
            $obj->name = '';

            $arr['images'] = $obj;

            //
            $obj = new \stdClass();
            $obj->active = true;
	        $obj->slug_path = 'app\scaffolding\images';
            $obj->slug = 'images-build';
            $obj->name = '';

            $arr['images_build'] = $obj;

	        //===========================================================================
            //
            $obj = new \stdClass();
            $obj->active = true;
	        $obj->slug_path = 'app\scaffolding\menus';
            $obj->slug = 'menus-args';
            $obj->name = '';

            $arr['menus'] = $obj;
            //
            $obj = new \stdClass();
            $obj->active = true;
	        $obj->slug_path = 'app\scaffolding\menus';
            $obj->slug = 'menus-build';
            $obj->name = '';

            $arr['menus_build'] = $obj;

            //
            $obj = new \stdClass();
            $obj->active = true;
	        $obj->slug_path = 'app\scaffolding\scripts';
            $obj->slug = 'scripts-args';
            $obj->name = '';

            $arr['scripts'] = $obj;

            //
            $obj = new \stdClass();
            $obj->active = true;
	        $obj->slug_path = 'app\scaffolding\scripts';
            $obj->slug = 'scripts-build';
            $obj->name = '';

            $arr['scripts_build'] = $obj;

            //
            $obj = new \stdClass();
            $obj->active = true;
	        $obj->slug_path = 'app\scaffolding\sidebars';
	        $obj->slug = 'sidebars-args';
            $obj->name = '';

            $arr['sidebars'] = $obj;

            //
            $obj = new \stdClass();
            $obj->active = true;
	        $obj->slug_path = 'app\scaffolding\sidebars';
	        $obj->slug = 'sidebars-build';
            $obj->name = '';
            $obj->new_active = true;
            $obj->new = '\\WPezTheme\Scaffolding\Sidebars_Build'; // ref: http://stackoverflow.com/questions/5287315/can-php-namespaces-contain-variables

            $arr['sidebars_build'] = $obj;


	        // == styles
	        $obj = new \stdClass();
            $obj->active = true;
	        $obj->slug_path = 'app\scaffolding\styles';
            $obj->slug = 'styles-args';
            $obj->name = '';

            $arr['styles'] = $obj;

            //
            $obj = new \stdClass();
            $obj->active = true;
	        $obj->slug_path = 'app\scaffolding\styles';
            $obj->slug = 'styles-build';
            $obj->name = '';
            $obj->new_active = true;
            $obj->new = '\\WPezTheme\Scaffolding\Styles_Build';

            $arr['styles_build'] = $obj;


	        // == theme-support
	        $obj = new \stdClass();
	        $obj->active = true;
	        $obj->slug_path = 'app\scaffolding\theme-support';
	        $obj->slug = 'theme-support-args';
	        $obj->name = '';

	        $arr['theme_support_args'] = $obj;

	        //
	        $obj = new \stdClass();
	        $obj->active = true;
	        $obj->slug_path = 'app\scaffolding\theme-support';
	        $obj->slug = 'theme-support-build';
	        $obj->name = '';
	        $obj->new_active = true;
	        $obj->new = '\\WPezTheme\Scaffolding\Theme_Support_Build';


            $arr['theme_support_build'] = $obj;

            return $arr;

        }

    }
}