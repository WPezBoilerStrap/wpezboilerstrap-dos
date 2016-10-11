<?php

namespace WPezTheme\Scaffolding;

if ( ! class_exists('Scripts_Args') ) {

    class Scripts_Args
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


        // https://developer.wordpress.org/reference/functions/wp_enqueue_script/
        protected function master(){

        	$obj_wpes = new \stdClass();

	        $obj_wpes->handle = NULL;
	        $obj_wpes->src = false;
	        $obj_wpes->deps = array();
	        $obj_wpes->ver = false;
	        $obj_wpes->in_footer = false;

	        $obj_action = new \stdClass();
	        // standard frontend register / enqueue
	        $obj_action->wp = true;
	        // used in conjunction with hook: admin_enqueue_scripts => https://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
	        $obj_action->admin = false;
	        // used in conjunction with hook: login_enqueue_scripts => https://codex.wordpress.org/Plugin_API/Action_Reference/login_enqueue_scripts
	        $obj_action->login = false;

	        // -
	        $obj = new \stdClass();

	        $obj->active = true;
	        $obj->wp_enqueue_script = $obj_wpes;
	        // The ezWay - See WPezCore for details :)
	        $obj->conditional_tags = array();
	        // no array() or empty array() defaults to array('wp' => true)
	        $obj->action_enqueue_scripts = $obj_action;

	        return $obj;
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
	        $obj = $this->master();
	        $obj->active = true;

	        $obj->wp_enqueue_script->handle = 'jquery';

	        $arr['jquery'] = $obj;

            /**
             * == bootstrap js
             */
	        $obj = $this->master();
	        $obj->active = true;

	        $obj->wp_enqueue_script->handle = 'bootstrap_js';
	        $obj->wp_enqueue_script->src = '//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js';
	        $obj->wp_enqueue_script->deps = array('jquery');
	        $obj->wp_enqueue_script->ver = 'maxcdn_3.2.0';
	        $obj->wp_enqueue_script->in_footer = true;

	        $arr['bootstrap_js'] = $obj;

            /**
             * == wp's comment reply
             */
	        $obj = $this->master();

	        $obj->active = true;
	        $obj->wp_enqueue_script->handle = 'comment-reply';
	        $obj->conditional_tags = array(
		        'tags' => array(
			        'is_singular' => true,
			        'get_option' => 'thread_comments',
			        'is_front_page' => false
		        )
	        );

	        $arr['wp_comment_reply'] = $obj;

            return $arr;
        }

    }
}