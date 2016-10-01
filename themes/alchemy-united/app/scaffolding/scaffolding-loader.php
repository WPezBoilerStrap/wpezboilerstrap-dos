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
                    get_template_part( $obj->slug, $obj->name );

                    if ( $obj->new_active === true && class_exists( $obj->new ) ) {
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
            $obj->slug = 'app\scaffolding\images\images';
            $obj->name = '';

            $arr['images'] = $obj;

            //
            $obj = new \stdClass();
            $obj->active = true;
            $obj->slug = 'app\scaffolding\images\images-build';
            $obj->name = '';

            $arr['images_build'] = $obj;

            //
            $obj = new \stdClass();
            $obj->active = true;
            $obj->slug = 'app\scaffolding\menus\menus';
            $obj->name = '';

            $arr['menus'] = $obj;
            //
            $obj = new \stdClass();
            $obj->active = true;
            $obj->slug = 'app\scaffolding\menus\menus-build';
            $obj->name = '';

            $arr['menus_build'] = $obj;

            //
            $obj = new \stdClass();
            $obj->active = true;
            $obj->slug = 'app\scaffolding\scripts\scripts';
            $obj->name = '';

            $arr['scripts'] = $obj;

            //
            $obj = new \stdClass();
            $obj->active = true;
            $obj->slug = 'app\scaffolding\scripts\scripts-build';
            $obj->name = '';

            $arr['scripts_build'] = $obj;

            //
            $obj = new \stdClass();
            $obj->active = true;
            $obj->slug = 'app\scaffolding\sidebars\sidebars';
            $obj->name = '';

            $arr['sidebars'] = $obj;

            //
            $obj = new \stdClass();
            $obj->active = true;
            $obj->slug = 'app\scaffolding\sidebars\sidebars-build';
            $obj->name = '';
            $obj->new_active = true;
            $obj->new = '\\WPezTheme\Scaffolding\Sidebars_Build'; // ref: http://stackoverflow.com/questions/5287315/can-php-namespaces-contain-variables

            $arr['sidebars_build'] = $obj;

            //
            $obj = new \stdClass();
            $obj->active = true;
            $obj->slug = 'app\scaffolding\styles\styles';
            $obj->name = '';

            $arr['styles'] = $obj;

            //
            $obj = new \stdClass();
            $obj->active = true;
            $obj->slug = 'app\scaffolding\styles\styles-build';
            $obj->name = '';
            $obj->new_active = true;
            $obj->new = '\\WPezTheme\Scaffolding\Styles_Build';

            $arr['styles_build'] = $obj;

            /**
            $obj = new \stdClass();
            $obj->active = true;
            $obj->slug = 'app\scaffolding\theme-support\theme-support-build';
            $obj->name = '';


            $arr['there_support_build'] = $obj;
*/
            return $arr;

        }

    }
}