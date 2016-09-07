<?php


namespace WPezTheme\Scaffolding;

if ( !class_exists( 'Sidebars' ) ) {
    class Sidebars
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

        protected function defaults( $str_key = 'd1' )
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
            $obj = new \stdClass();
            $obj->active = true;
            $obj->name = 'Sidebar A';
            $obj->id_unique_sidebar = 'sidebar-a';
            $obj->description = 'This is a description';
            $obj->class_admin = 'span4';

            $obj->before_widget_tag = 'div';
            $obj->before_widget_id = 'sidebar-a';
            $obj->before_widget_class = 'widget-class';
            $obj->defaults = $this->defaults();
            $arr['sidebar_a'] = $obj;

            //
            $obj = new \stdClass();
            $obj->active = true;
            $obj->name = 'Sidebar B';
            $obj->id_unique_sidebar = 'sidebar-b';
            $obj->description = 'This is a description';
            $obj->class_admin = 'span4';

            $obj->before_widget_tag = 'div';
            $obj->before_widget_id = 'sidebar-b';
            $obj->before_widget_class = 'widget-class';
            $obj->defaults = $this->defaults();
            $arr['sidebar_b'] = $obj;

            return $arr;

        }
    }
}