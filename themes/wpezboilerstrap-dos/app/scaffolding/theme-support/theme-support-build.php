<?php
/**
 *
 */

namespace WPezTheme\Scaffolding;

if ( ! class_exists( 'Theme_Support_Build' ) ) {
    class Theme_Support_Build {

        function __construct(){

        	$this->build();
        }

        public function build(){

            $ins_ts = new Theme_Support_Args();
            $arr_args = $ins_ts->get();


            $obj_ats = new \WPezClasses\Scaffolding\Add_Theme_Support();

            // do it!
            $x = $obj_ats->ez_loader( $arr_args );
        }
    }
}
//new Theme_Support_Build();