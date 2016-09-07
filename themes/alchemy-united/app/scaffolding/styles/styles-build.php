<?php


namespace WPezTheme\Scaffolding;

if ( !class_exists( 'Styles_Build' ) ) {

    class Styles_Build
    {

        function __construct()
        {
            add_action( 'wp_enqueue_scripts', array($this, 'build') );
        }

        public function build(){

            $obj_s = new Styles();
            $arr_args = $obj_s->get();
            
            $obj_wpe = new \WPezClasses\WPezCore\WP_Enqueue();

            $obj_wpe->register_style($arr_args);
            $obj_wpe->enqueue_style($arr_args);

        }
    }

}