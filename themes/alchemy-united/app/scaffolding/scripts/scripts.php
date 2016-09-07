<?php

namespace WPezTheme\Scaffolding;

if ( ! class_exists('Scripts') ) {

    class Scripts
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


        /**
         *
         */
        protected function args()
        {

            $arr = array();

            /**
             * == jquery
             */
            $obj = new \stdClass();

            $obj->active = true;
            $obj->handle = 'jquery';
            $obj->src = NULL;
            $obj->deps = array();
            $obj->ver = NULL;
            $obj->in_footer = NULL;             // in_footer is required for type: script - both are listed for consistency / convenience

            $obj->type = 'wp_core';             // default is 'script' else 'wp-script' has to be specified
            $obj->conditional_tags = array();
            $obj->when = array(                 // no array() or empty array() defaults to array('wp' => true
                'wp' => true,                   // standard register / enqueue
                'admin' => false,               // used in conjunction with hook: admin_enqueue_scripts => https://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
                'login' => false);              // used in conjunction with hook: login_enqueue_scripts => https://codex.wordpress.org/Plugin_API/Action_Reference/login_enqueue_scripts

            $obj->host = 'wp local';            // for internal use
            $obj->note = 'TODO';                // for internal use

            $arr['jquery'] = $obj;


            /**
             * == bootstrap js
             */
            $obj = new \stdClass();

            $obj->active = true;
            $obj->handle = 'bootstrap_js';
            $obj->src = '//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js';
            $obj->deps = array('jquery');
            $obj->ver = 'maxcdn_3.2.0';
            $obj->in_footer = true;    // in_footer is required for type: script - both are listed for consistency / convenience

            $obj->conditional_tags = array();

            $obj->host = 'maxcdn';
            $obj->note = 'TODO';

            $arr['bootstrap_js'] = $obj;

            /**
             * == wp's comment reply
             */
            $obj = new \stdClass();

            $obj->active = true;
            $obj->handle = 'comment-reply';
            $obj->ver = 'wp_4.5.x';
            $obj->in_footer = true;

            $obj->type = 'wp_script';
            $obj->conditional_tags = array(
                'tags' => array(
                    'is_singular' => true,
                    'get_option' => 'thread_comments',
                    'is_front_page' => false
                )
            );

            $obj->host = 'wp_local';
            $obj->note = 'TODO';

            $arr['wp_comment_reply'] = $obj;

            return $arr;
        }

    }
}