<?php

namespace WPezTheme\Scaffolding;

if ( !class_exists( 'Menus_Build' ) ) {

    class Menus_Build
    {

        function __construct()
        {

            add_action( 'after_setup_theme', array($this, 'build') );
        }

        public function build()
        {

            $obj_m = new Menus();
            $arr_args = $obj_m->get();
            
            $obj_rnm = new \WPezClasses\Scaffolding\Register_Nav_Menu();

            $x = $obj_rnm->loader( $arr_args );

        }
    }

}
new Menus_Build();