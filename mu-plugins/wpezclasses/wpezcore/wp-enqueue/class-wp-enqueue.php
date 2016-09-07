<?php
/**
 * Takes your arrays (of fonts, scripts and/or styles) and enqueues them.
 *
 * More info: (@link http://codex.wordpress.org/Function_Reference/get_search_form)
 *
 * PHP version 5.3
 *
 * LICENSE: TODO
 *
 * @package WP ezClasses
 * @author  Mark Simchock <mark.simchock@alchemyunited.com>
 * @since   0.5.0
 */

namespace WPezClasses\WPezCore;

if ( !class_exists( 'WP_Enqueue' ) ) {
    class WP_Enqueue
    {

        protected $_obj_cond_tags;

        public function __construct( $obj_cond_tags = '')
        {
            // inject an instance of the wpezcore conditional tags class. note: else ignore that check
            $this->_obj_cond_tags = false;
            if ( is_object($obj_cond_tags) &&  method_exists($obj_cond_tags, 'evaluate')){
                $this->_obj_cond_tags = $obj_cond_tags;
            }
        }


        protected function ez_defaults()
        {
            $arr_defaults = array(
                'log' => false,
                'filters' => false,
                'validation' => false,
            );

            return $arr_defaults;
        }

        /**
         * @return stdClass
         */
        protected function basics()
        {

            $obj = new \stdClass();

            $obj->url = plugin_dir_url( __FILE__ );
            $obj->path = plugin_dir_path( __FILE__ );
            $obj->path_parent = dirname( $this->_path );
            $obj->basename = plugin_basename( __FILE__ );
            $obj->file = __FILE__;

            return $obj;
        }

        protected function defaults()
        {
            $arr = array(
                'active' => true,
                'src' => false,
                'deps' => array(),
                'ver' => false,
                'in_footer' => false,
                'media' => 'all',
                'add_data_active' => false,
                'add_data' => array(),  // key => value
                'conditional_tags' => array(),
                'when' => array('wp' => true)
            );
            return $arr;
        }

        public function style_media_supported(){

            $arr =  array(
                'all' 			=> true,
                'braille'		=> true,
                'embossed'		=> true,
                'handheld'		=> true,
                'print'			=> true,
                'projection'	=> true,
                'screen'		=> true,
                'speech'		=> true,
                'tty'			=> true,
                'tv'			=> true,
            );

            return $arr;
        }

        /**
         * @param string $arr_args
         * @param string $str_type - style or script
         * @param string $wtr_wp - register or enqueue
         * @param string $wtr_when - 'wp', 'login' or 'admin'
         */
        protected function loader( $arr_args = '', $str_type = '', $str_wp = '', $str_when = 'wp' )
        {
            $str_type = strtolower( $str_type);
            $str_wp = strtolower($str_wp);
            $str_when = strtolower($str_when);

            if ( isset($arr_args) && is_array( $arr_args ) && !empty($arr_args) && ($str_type == 'script' || $str_type == 'style') && ($str_wp == 'register' || $str_wp == 'enqueue') ) {

                foreach ( $arr_args as $key => $obj_orig ) {

                    $obj = (object) array_merge($this->defaults(), (array) $obj_orig);

                    if ( ( isset($obj->when) && ! is_array($obj->when )) ||
                    ( isset($obj->when) && is_array($obj->when) && ! empty($obj->when) && isset($obj->when[$str_when]) && $obj->when[$str_when] === false  ) ) {
                       echo '<br>--<br>';
                        continue;
                    }


                    $bool_cond_tags = true;
                    if ( $this->_obj_cond_tags !== false && is_array($obj->conditional_tags) && ! empty($obj->conditional_tags)){
                        $bool_cond_tags = $this->_obj_cond_tags->evaluate($obj->conditional_tags);
                    }

                    if ( $bool_cond_tags == true && $obj->active === true && (is_string( $obj->handle ) && !empty($obj->handle)) && (($str_type == 'script' && $obj->type == 'wp_core') || (is_string( $obj->src ) && !empty($obj->src))) ) {

                        if ( $str_type == 'style' ) {

                            $str_media = $this->validate_media( $obj->media );
                            if ( $str_wp == 'register' ) {

                                wp_register_style( $obj->handle, $obj->src, $obj->deps, $obj->ver, $str_media );
                            }
                            elseif ( $str_wp == 'enqueue' && wp_style_is( $obj->handle, 'registered' ) ) {

                                wp_enqueue_style( $obj->handle );
                                $this->wp_style_add_data( $obj );
                            }
                            elseif ( $str_wp == 'enqueue' ) {

                                wp_enqueue_style( $obj->handle, $obj->src, $obj->deps, $obj->ver, $str_media );
                                $this->wp_style_add_data( $obj );
                            }
                            else {
                                // TODO - error log?
                            }

                        }
                        elseif ( $str_type == 'script' ) {
                            if ( $str_wp == 'register' && $obj->type != 'wp_core' ) {
                                wp_register_script( $obj->handle, $obj->src, $obj->deps, $obj->ver, $obj->in_footer );
                            }
                            elseif ( $str_wp == 'enqueue' && wp_script_is( $obj->handle, 'registered' ) ) {

                                wp_enqueue_script( $obj->handle );
                            }
                            elseif ( $str_wp == 'enqueue' ) {
                                wp_enqueue_script( $obj->handle, $obj->src, $obj->deps, $obj->ver, $obj->in_footer );
                            }
                            else {
                                // TODO - error log?
                            }
                        }
                    }

                }
            }
        }

        /**
         * @param string $obj
         *
         * ref: https://developer.wordpress.org/reference/functions/wp_style_add_data/
         */
        protected function wp_style_add_data($obj = '' ){

            if ( $obj->add_data_active == true && ( isset($obj->add_data) && is_array($obj->add_data) && ! empty($obj->add_data)) ){
                reset($obj->add_data);
                $first_key = key($obj->add_data);
                if ( isset($obj->add_data[$first_key])){
                    wp_style_add_data($obj->handle, $first_key  , $obj->add_data[$first_key]);
                }
            }
        }


        protected function validate_media($str_media){

            $str_media = strtolower($str_media);
            $arr_media = $this->style_media_supported();
            if ( isset($arr_media[$str_media]) && $arr_media[$str_media] === true ){
                return $str_media;
            }
            return 'all';
        }


        /**
         * @param string $arr_arg
         */
        public function register_style( $arr_args = ''){
            $this->loader($arr_args, 'style', 'register', 'wp');
        }

        /**
         * Use with hook: 'login_enqueue_scripts'
         * Note: This hook is used for both scripts and styles
         * ref: http://codex.wordpress.org/Plugin_API/Action_Reference/login_enqueue_scripts
         *
         * @param string $arr_arg
         */
        public function login_register_styles( $arr_args = ''){
           $this->loader($arr_args, 'style', 'register', 'login');
        }

        /**
         * @param string $arr_arg
         */
        public function register_style_admin( $arr_args = ''){
            $this->loader($arr_args, 'style', 'register', 'login');
        }

        /**
         * @param string $arr_arg
         */
        public function register_script( $arr_args = ''){
            $this->loader($arr_args, 'script', 'register', 'wp');
        }

        /**
         * Use with hook: 'login_enqueue_scripts'
         * Note: This hook is used for both scripts and styles
         * ref: http://codex.wordpress.org/Plugin_API/Action_Reference/login_enqueue_scripts
         * @param string $arr_arg
         */
        public function login_register_scripts( $arr_args = ''){
            // TODO $this->loader($arr_args, 'script', 'register');
        }

        /**
         * @param string $arr_arg
         */
        public function register_script_admin( $arr_args = ''){
            // TODO  $this->loader($arr_args, 'script', 'register');
        }


        /**
         * @param string $arr_arg
         */
        public function enqueue_style($arr_args = '')
        {
            $this->loader($arr_args, 'style', 'enqueue', 'wp');
        }

        /**
         * Use with hook: 'login_enqueue_scripts'
         * Note: This hook is used for both scripts and styles
         * ref: http://codex.wordpress.org/Plugin_API/Action_Reference/login_enqueue_scripts
         *
         * @param string $arr_arg
         */
        public function login_enqueue_styles($arr_args = '')
        {
            $this->loader($arr_args, 'style', 'enqueue', 'login');
        }

        /**
         * @param string $arr_arg
         */
        public function enqueue_style_admin($arr_args = '')
        {
            $this->loader($arr_args, 'style', 'enqueue', 'admin');
        }

        /**
         * @param string $arr_arg
         */
        public function enqueue_script($arr_args = '')
        {
            $this->loader($arr_args, 'script', 'enqueue', 'wp');
        }

        /**
         * Use with hook: 'login_enqueue_scripts'
         * Note: This hook is used for both scripts and styles
         * ref: http://codex.wordpress.org/Plugin_API/Action_Reference/login_enqueue_scripts
         *
         * @param string $arr_arg
         */
        public function login_enqueue_scripts($arr_args = '')
        {
            $this->loader($arr_args, 'script', 'enqueue', 'login');
        }

        /**
         * @param string $arr_arg
         */
        public function enqueue_script_admin($arr_args = '')
        {
            $this->loader($arr_args, 'script', 'enqueue', 'admin');
        }

    }
}