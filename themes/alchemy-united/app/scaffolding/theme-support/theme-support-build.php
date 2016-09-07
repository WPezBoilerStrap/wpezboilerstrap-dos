<?php
/**
 *
 */

namespace WPezTheme\Scaffolding;

if ( ! class_exists( 'Theme_Support_Build' ) ) {

    class Theme_Support_Build
    {

        function __construct()
        {

            add_action( 'add_theme_support', array($this, 'build') );

        }

        public function build()
        {

            $obj_ts = new Scaffolding\Theme_Support();
            $arr_args = $obj_ts->get();

            $obj_ats = new \Class_WPezClasses_Scaffolding_Add_Theme_Support();

            // do it!
            $x = $obj_ats->loader( $arr_args );
        }
    }

}

new Theme_Support_Build();