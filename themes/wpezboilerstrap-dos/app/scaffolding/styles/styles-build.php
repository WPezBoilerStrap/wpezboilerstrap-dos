<?php


namespace WPezTheme\Scaffolding;

if ( !class_exists( 'Styles_Build' ) ) {

    class Styles_Build {

	    function __construct() {
		    add_action( 'after_setup_theme', array( $this, 'build' ) );
	    }

	    public function build() {

		    $ins_s    = new Styles_Args();
		    $arr_args = $ins_s->get();

		    $ins_wpe = new \WPez\WPezClasses\WPezCore\WP_Enqueue();

		    $ins_wpe->ez_loader( $arr_args );

	    }
    }
}
