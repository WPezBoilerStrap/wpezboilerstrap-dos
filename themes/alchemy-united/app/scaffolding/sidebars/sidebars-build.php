<?php

namespace WPezTheme\Scaffolding;

if ( !class_exists( 'Sidebars_Build' ) ) {

    class Sidebars_Build
    {

        function __construct()
        {
            add_action( 'after_setup_theme', array($this, 'build') );
        }

        public function build()
        {

            $obj_sb = new Sidebars();
            $arr_args = $obj_sb->get();


            $obj_rsb = new \WPezClasses\Scaffolding\Register_Sidebar();

           $x = $obj_rsb->loader( $arr_args );

        }
    }

}
//new Sidebars_Build();