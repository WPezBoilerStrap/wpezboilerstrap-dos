<?php

namespace WPezTheme\Scaffolding;

if (! class_exists('Styles_Args') ) {
    class Styles_Args{

        public function __construct(){}

        public function get( $str = 'args' )
        {
            if ( $str == 'args' ) {
                return $this->args();
            }
            return array();
        }


	    // https://developer.wordpress.org/reference/functions/wp_enqueue_style/
	    protected function master(){

		    $obj_wpes = new \stdClass();

		    $obj_wpes->handle = NULL;
		    $obj_wpes->src = false;
		    $obj_wpes->deps = array();
		    $obj_wpes->ver = false;
		    $obj_wpes->media = 'all';

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
		    $obj->wp_enqueue_style = $obj_wpes;
		    // The ezWay - See WPezCore for details :)
		    $obj->conditional_tags = array();
		    // no array() or empty array() defaults to array('wp' => true)
		    $obj->action_enqueue_scripts = $obj_action;
		    // ref: https://developer.wordpress.org/reference/functions/wp_style_add_data/
		    $obj->add_data_active = false;
		    // array ('key1' => 'value1', 'key2' => 'value2' );
		    $obj->add_data = array ();

		    return $obj;
	    }

        /**
         *
         */
        protected function args(){

            $arr = array ();

            /**
             * == google font: lobster
             */
	        $obj = $this->master();

	        $obj->active = true;
	        $obj->wp_enqueue_style->handle = 'font_google_lobster';
	        $obj->wp_enqueue_style->src = '//fonts.googleapis.com/css?family=Lobster';
	        $obj->wp_enqueue_style->ver = 'v1';

	        $arr['font_lobster'] = $obj;

            /**
             * == font_awesome_css
             */
	        $obj = $this->master();

	        $obj->active = true;
	        $obj->wp_enqueue_style->handle = 'fa_css';
	        $obj->wp_enqueue_style->src = '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css';
	        $obj->wp_enqueue_style->ver = 'maxcdn_4.2.0';

	        $arr['font_awesome_css'] = $obj;

            /**
             * == bootstrap_css
             */
	        $obj = $this->master();

	        $obj->active = true;
	        $obj->wp_enqueue_style->handle = 'bootstrap_css';
	        $obj->wp_enqueue_style->src = '//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css';
	        $obj->wp_enqueue_style->ver = 'maxcdn_3.2.0';

	        $arr['bootstrap_css'] = $obj;

            /**
             * == custom_css
             */
	        $obj = $this->master();

	        $obj->active = true;
	        $obj->wp_enqueue_style->handle = 'app_min_css';
	        $obj->wp_enqueue_style->src = get_stylesheet_directory_uri() . '/app/assets/dist/css/app.min.css';
	        $obj->wp_enqueue_style->deps =  array('bootstrap_css', 'fa_css');
	        $obj->wp_enqueue_style->ver = 'v_0.0.1';

	        $arr['app_css'] = $obj;

            return $arr;
        }
    }
}