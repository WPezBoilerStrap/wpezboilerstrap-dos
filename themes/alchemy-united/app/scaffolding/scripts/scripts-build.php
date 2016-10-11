<?php


namespace WPezTheme\Scaffolding;

if ( !class_exists( 'Scripts_Build' ) ) {

    class Scripts_Build
    {

        function __construct() {

            add_action( 'after_setup_theme', array($this, 'build') );
        }

        public function build(){

            $ins_s = new Scripts_Args();
            $arr_args = $ins_s->get();

            $ins_wpe = new \WPezClasses\WPezCore\WP_Enqueue();

	        $ins_wpe->ez_loader($arr_args);

        }
    }

}

new Scripts_Build();