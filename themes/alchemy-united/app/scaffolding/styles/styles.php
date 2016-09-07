<?php

namespace WPezTheme\Scaffolding;

if (! class_exists('Styles') ) {
    class Styles{

        public function __construct(){


        }

        public function get( $str = 'args' )
        {
            if ( $str == 'args' ) {
                return $this->args();
            }
            return array();
        }

        /**
         *
         */
        protected function args(){

            $arr = array ();

            /**
             * == google font: lobster
             */
            $obj = new \stdClass();

            $obj->active = true;
            $obj->handle = 'font_google_lobster';
            $obj->src = '//fonts.googleapis.com/css?family=Lobster';
            $obj->deps = array();
            $obj->ver = 'v1';
            $obj->media = 'all';	            // default = 'all'

            $obj->add_data_active = true;      // ref: https://developer.wordpress.org/reference/functions/wp_style_add_data/
            $obj->add_data = array ('key' => 'value');

            $obj->conditional_tags = array();
            $obj->when = array(                 // no array() or empty array() is the same as (keys) 'wp', 'admin' and 'login' all set to true.
                'wp' => true,                  // standard register / enqueue
                'admin' => true,              // used in conjunction with hook: admin_enqueue_scripts => https://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
                'login' => true);
            $obj->when = array();
            $obj->host = 'google';			// for internal use
            $obj->note = 'TODO font-family:';				// for internal use

            $arr['font_lobster'] = $obj;

            /**
             * == font_awesome_css
             */
            $obj = new \stdClass();

            $obj->active = true;
            $obj->handle = 'fa_css';
            $obj->src = '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css';
            $obj->deps = array();
            $obj->ver = 'maxcdn_4.2.0';
            $obj->media = 'all';

            $obj->add_data_active = false;

            $obj->conditional_tags = array();
            $obj->when = array();
            $obj->host = 'maxcdn';
            $obj->note = 'TODO';

            $arr['font_awesome_css'] = $obj;

            /**
             * == bootstrap_css
             */
            $obj = new \stdClass();

            $obj->active = true;
            $obj->handle = 'bootstrap_css';
            $obj->src = '//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css';
            $obj->deps = array();
            $obj->ver = 'maxcdn_3.2.0';
            $obj->media = 'all';	        // in_footer is required for type: script - both are listed for consistency / convenience

            $obj->conditional_tags = array();
            $obj->when = array();
            $obj->host = 'maxcdn';
            $obj->note = 'TODO';

            $arr['bootstrap_css'] = $obj;


            /**
             * == custom_css
             */
            $obj = new \stdClass();

            $obj->active = true;
            $obj->handle = 'app_min_css';
            $obj->src = get_stylesheet_directory_uri() . '/app/assets/dist/css/app.min.css';
            $obj->deps =  array('bootstrap_css', 'fa_css');
            $obj->ver = 's_0.0.1';
            $obj->media = 'all';

            $obj->conditional_tags = array();
            $obj->when = array();

            $obj->host = 'local';
            $obj->note = 'TODO';

            $arr['custom_css'] = $obj;

            return $arr;
        }
    }
}