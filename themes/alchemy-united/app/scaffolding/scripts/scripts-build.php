<?php


namespace WPezTheme\Scaffolding;

if ( !class_exists( 'Scripts_Build' ) ) {

    class Scripts_Build
    {

        function __construct()
        {

            add_action( 'wp_enqueue_scripts', array($this, 'build') );
        }

        public function build(){

            $obj_s = new Scripts();
            $arr_args = $obj_s->get();
            
            $obj_wpe = new \WPezClasses\WPezCore\WP_Enqueue();

            $obj_wpe->register_script($arr_args);
            $obj_wpe->enqueue_script($arr_args);

        }
    }

}

new Scripts_Build();