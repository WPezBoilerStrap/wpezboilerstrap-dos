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

            $ins_sba = new Sidebars_Args();
            $arr_args = $ins_sba->get();

            $obj_rsb = new \WPez\WPezClasses\Scaffolding\Register_Sidebar();

           $x = $obj_rsb->ez_loader( $arr_args );

        }
    }

}
//new Sidebars_Build();