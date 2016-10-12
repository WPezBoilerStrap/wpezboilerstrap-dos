<?php


namespace WPezTheme\Scaffolding;

if ( !class_exists( 'Sidebars_Args' ) ) {
    class Sidebars_Args
    {

        public function __construct()
        {

        }

        public function get( $str = 'args' )
        {
            if ( $str == 'args' ) {
                return $this->args();
            }

            return array();
        }

        protected function master( $str_key = 'd1' )
        {

            $str_default_key = 'd1';

            $arr = array();

            $obj = new \stdClass();
            $obj->active = true;    // ezBS do not use this, but you certainly could
            $obj->description = 'WPezBoilerStrap Default 1 Description';
            $obj->before_widget = '<div id="WP-EZC-WIDGET-ID" class="wp-ezbs-widget WP-EZC-WIDGET-CLASS">';
            $obj->after_widget = '</div>';
            $obj->before_title = '<div class="wp-ezbs-widget-title">';
            $obj->after_title = '</div>';

            $arr['d1'] = $obj;

            $obj = new \stdClass();
            $obj->active = true;    // ezBS do not use this, but you certainly could
            $obj->description = 'WPezBoilerStrap Default 2 Description';
            $obj->before_widget = '<div id="WP-EZC-WIDGET-ID" class="wp-ezbs-widget WP-EZC-WIDGET-CLASS">';
            $obj->after_widget = '</div>';
            $obj->before_title = '<div class="wp-ezbs-widget-title">';
            $obj->after_title = '</div>';

            $arr['d2'] = $obj;

	        $obj = new \stdClass();
	        $obj->before_widget = '<li id="%1$s" class="widget %2$s">';
	        $obj->after_widget  = '</li>';
	        $obj->before_title  = '<h2 class="widgettitle">';
	        $obj->after_title   = '</h2>';

	        $arr['wp'] = $obj;

	        $obj = new \stdClass();
	        $obj->before_widget = '';
	        $obj->after_widget  = '';
	        $obj->before_title  = '';
	        $obj->after_title   = '';

	        $arr['b'] = $obj;


            if ( isset($arr[ $str_key]) ){
                return $arr[ $str_key ];
            } else {
                return $arr[$str_default_key];
            }
        }

        /*
         * 'name'          => __( 'Sidebar name', 'theme_text_domain' ),
         * 'id'            => 'unique-sidebar-id',
         * 'description'   => '',
         * 'class'         => '',
         * 'before_widget' => '<li id="%1$s" class="widget %2$s">',
         * 'after_widget'  => '</li>',
         * 'before_title'  => '<h2 class="widgettitle">',
         * 'after_title'
         */

        protected function args()
        {

            $arr = array();

            //
	        $obj_rs = new \stdClass();

	        $obj_rs->name = 'Sidebar A';
	        $obj_rs->id = 'unique-sidebar-id-a';
	        $obj_rs->description = 'This is a description';
	        $obj_rs->class = 'some-class';
	        $obj_rs->before_widgetx = '<li id="%1$s" class="widget %2$s">';
	        $obj_rs->after_widgetx  = '</li>';
	        $obj_rs->before_titlex  = '<h2 class="widgettitle">';
	        $obj_rs->after_titlex   = '</h2>';

	        $obj = new \stdClass();

	        $obj->active = true;
	        $obj->register_sidebar = $obj_rs;
	        // if you have standard before_ and after_ you can specify it here
	        $obj->defaults = $this->master('b');
	        // or you can be detailed
            $obj->before_widget_tag = 'div';
	        $obj->before_widget_global_args = array(
		        'id' => '%1$s',
		        'class' => 'widget %2$s'
	        );
	        $obj->before_title_tag = 'h1';
	        $obj->before_title_global_args = array(
		        'id' => 'ga-title-id',
		        'class' => 'ga-title-class'
	        );

	         $arr['sidebar_a'] = $obj;


            return $arr;

        }
    }
}