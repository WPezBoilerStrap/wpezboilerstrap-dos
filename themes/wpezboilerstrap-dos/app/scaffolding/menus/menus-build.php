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

            $ins_menus = new Menus_Args();
            $arr_args = $ins_menus->get();
            
            $ins_rnm = new \WPez\WPezClasses\Scaffolding\Register_Nav_Menu();

            $x = $ins_rnm->ez_loader( $arr_args );

        }
    }

}
new Menus_Build();