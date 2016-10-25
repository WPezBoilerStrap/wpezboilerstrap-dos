<?php
/**
 * Methods related to WP's Conditional Tags
 *
 * Common snippets for Conditional Tags as WPezClasses methods(). (@link http://codex.wordpress.org/Conditional_Tags)
 *
 * PHP version 5.3
 *
 * LICENSE: TODO
 *
 * @package WPezClasses
 * @author  Mark Simchock <mark.simchock@alchemyunited.com>
 * @since   0.5.0
 * @license TODO
 */

/**
 * == Change Log ==
 *
 */

namespace WPez\WPezClasses\WPezCore;

if ( !defined( 'ABSPATH' ) ) {
    header( 'HTTP/1.0 403 Forbidden' );
    die();
}

if ( !class_exists( 'Conditional_Tags' ) ) {
    class Conditional_Tags
    {

        public function __construct()
        {

        }

        /**
         * @return array
         */
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
         *
         */
        protected function basics()
        {

            $this->_version = '0.5.0';
            $this->_url = plugin_dir_url( __FILE__ );
            $this->_path = plugin_dir_path( __FILE__ );
            $this->_path_parent = dirname( $this->_path );
            $this->_basename = plugin_basename( __FILE__ );
            $this->_file = __FILE__;

        }


        protected function defaults()
        {

            $arr = array(
                'tags' => array(),
                'operator' => 'and',
                'not' => ''
            );

            return $arr;
        }

        /**
         * Takes an array of format conditional_tag => condition, evaluates across the entire array and returns true or false
         *
         * A simplified programatic if conditional for WP conditional tags. Example: Use this method for defining which .js files should be enqueue'd when.
         *
         * - arr_args[]
         * --- 'tags'        array( conditional_tag1 => condition1, conditional_tag2 => condition2...)
         * --- 'operator'    Default: 'and' - 'and' or 'or' - How should the elements of the 'tags' array be evaluted?
         * --- 'not'        Default: '' (i.e., no not) - '', '!' or true - Take the tags + operator evalution and invert it?
         **/
        public function evaluate( $arr_args = array() )
        {

            global $post;

            // if we can't evaluate it then we (default) to false. in other words, given the args it can't eval to true, so then false
            if ( !is_array( $arr_args ) ) {
                return false;
            }

            $arr_args = array_merge( $this->defaults(), $arr_args );

            // if we can't evaluate it then we (default) to false.
            if ( !is_array( $arr_args['tags'] ) ) {
                return false;
            }

            // empthy returns true. if there are no tags then that will return true (for now?)
            if ( (is_array( $arr_args ) && empty($arr_args)) ) {
                return true;
            }

            // default: operator  = 'and'
            $str_operator = $this->defaults()['operator'];
            if ( strtolower( $arr_args['operator'] ) == 'and' || strtolower( $arr_args['operator'] ) == 'or' ) {
                $str_operator = strtolower( $arr_args['operator'] );
            }

            // Note: not => true feels awkward and prehaps confusing so we'll also use !
            $bool_not = $this->defaults()['not'];
            if ( $arr_args['not'] == '!' || $arr_args['not'] === true || $arr_args['not'] == '' ) {
                $bool_not = $arr_args['not'];
            }

            $arr_msg = array();
            $bool_evaluate = array();

            //merge all the _supported
            $arr_all_supported = array_merge(
                $this->supported_conditional_tags(),
                $this->supported_browser_detection(),
                $this->supported_only_in_loop(),
                $this->supported_tags_other()
            );

            foreach ( $arr_args['tags'] as $str_tag => $mix_condition ) {

                // TODOx $arr_msg_detail = array();

                // if there ARE tags in some form they we test - literally - for that. that is, "bad data" equates to not true (if you will).
                if ( !isset($str_tag) || !isset($mix_condition) ) {
                    // false = $arr_msg_detail[] = 'ERROR: conditional_tag and/or condition ! isset()';
                    $bool_evaluate['false'] = false;
                }

                $str_tag = strtolower( $str_tag );
                if ( is_string( $mix_condition ) ) {
                    $mix_condition = strtolower( $mix_condition );
                }

                if ( ! isset($arr_all_supported[ $str_tag ]) || (isset( $arr_all_supported[ $str_tag ]) && $arr_all_supported[$str_tag]['active'] === false ) ) {
                    // false = $arr_msg_detail[] = 'ERROR: conditional_tag ' . $str_tag . ' not supported';
                    $bool_evaluate['false'] = false;
                }
                elseif ( !is_bool( $mix_condition ) ) {
                    // condition is bool but this tag doesn't support bool
                    if ( isset($arr_all_supported[ $str_tag ]['bool_only']) && $arr_all_supported[ $str_tag ]['bool_only'] === true ) {
                        // flase = $arr_msg_detail[] = 'ERROR: conditional_tag accepts only condition bool';
                        $bool_evaluate['false'] = false;
                        // for when the condition is part of the conditional_tag's "question" || get_post_type() is a special case where we must test for == (and not get_post_type($mix_cond)
                    }
                    elseif ( ((is_string( $mix_condition ) || is_array( $mix_condition )) && $str_tag( $mix_condition )) || ($str_tag == 'get_post_type' && $mix_condition == get_post_type()) ) {
                        $bool_evaluate['true'] = true;
                    }
                    else {
                        // anything else...false
                        $bool_evaluate['false'] = false;
                    }

                }
                elseif ( is_bool( $mix_condition ) ) {
                    // supported_browser_detection() tags are a special case and we need to work some magic
                    $arr_sbt = $this->supported_browser_detection();
                    if ( isset($arr_sbt[ $str_tag ]) ) {
                        // there are wp globals for the browsers
                        global $$str_tag;
                        if ( $$str_tag === $mix_condition ) {
                            $bool_evaluate['true'] = true;
                        }
                        else {
                            $bool_evaluate['false'] = false;
                        }
                        // finally. simply test the tag against the (bool) condition
                    }
                    elseif ( $str_tag() === $mix_condition ) {
                        $bool_evaluate['true'] = true;
                    }
                    else {
                        $bool_evaluate['false'] = false;
                    }
                }
                // msg details?
                /* TODOx
                if ( ! empty($arr_msg_detail) ){
                    $arr_msg[$str_tag] = $arr_msg_detail;
                }
                */

                // TODO - perhaps there are cases where we can exit the foreach early? e.g., operstor = and && isset(bool_ev[false]) = it's over
            }


            // done looping...do we have an error msgs?
            /* TODOx
            if ( ! empty($arr_msg)){
                return array('active' => false, 'msg' => $arr_msg, 'source' => $str_return_source, 'arr_args' => 'error');
            }
            */

            //TODO - this probably a better way to do this next set of if / elseifs

            // if it's not not, then it's true
            if ( $bool_not == '!' || $bool_not === true ) {

                /**
                 * When 'not' == true we want to return the opposite of above. Except the Error will continue to return false
                 */

                // no errors + (operator = and (i.e., all must be true)) && (we have at least one false) = true
                if ( $str_operator == 'and' && isset($bool_evaluate['false']) ) {
                    // return array('status' => true, 'msg' => 'success', 'source' => $str_return_source, 'arr_args' => $arr_args);
                    return true;

                    // no errors + (operator = and (i.e., all must be true)) && (we have no false) = true
                }
                elseif ( $str_operator == 'and' && !isset($bool_evaluate['false']) ) {
                    // return array('status' => false, 'msg' => 'success', 'source' => $str_return_source, 'arr_args' => $arr_args);
                    return false;

                    // no erros + (operator = or) && (we have at least one true_ = true
                }
                elseif ( $str_operator == 'or' && isset($bool_evaluate['true']) ) {
                    // return array('status' => false, 'msg' => 'success', 'source' => $str_return_source, 'arr_args' => $arr_args);
                    return false;

                    // no errors + (operator = or) &&  (we have no true) = false
                }
                elseif ( $str_operator == 'or' && !isset($bool_evaluate['true']) ) {
                    // return array('status' => true, 'msg' => 'success', 'source' => $str_return_source, 'arr_args' => $arr_args);
                    return true;

                    // WTF? shouldn't happen but...
                }
                else {
                    // return array('status' => false, 'msg' => 'ERROR: conditional_tags_evaluate - evaluate failed. Note: This should never happen.', 'source' => $str_return_source, 'arr_args' => 'error');
                    return false;
                }

            }
            else {

                // no errors + (operator = and (i.e., all must be true)) && (we have at least one false) = true
                if ( $str_operator == 'and' && isset($bool_evaluate['false']) ) {
                    return false;
                    // no errors + (operator = and (i.e., all must be true)) && (we have no false) = true
                }
                elseif ( $str_operator == 'and' && !isset($bool_evaluate['false']) ) {
                    return true;
                    // no erros + (operator = or) && (we have at least one true_ = true
                }
                elseif ( $str_operator == 'or' && isset($bool_evaluate['true']) ) {
                    return true;
                    // no errors + (operator = or) &&  (we have no true) = false
                }
                elseif ( $str_operator == 'or' && !isset($bool_evaluate['true']) ) {
                    return false;
                    // WTF?
                }
                else {
                    return array('status' => false, 'msg' => 'ERROR: conditional_tags_evaluate - evaluate failed. Note: This should never happen.', 'source' => $str_return_source, 'arr_args' => 'error');
                }
            }
        }

        /**
         * http://codex.wordpress.org/Conditional_Tags#Conditional_Tags_Index
         */
        public function supported_conditional_tags()
        {

            $arr_tags =  array(
                'is_404' => array(
                    'active' => true,
                    'bool_only' => true),
                'is_admin' => array(
                    'active' => true,
                    'bool_only' => true),
                'is_archive' => array(
                    'active' => true,
                    'bool_only' => true),
                'is_attachment' => array(
                    'active' => true,
                    'bool_only' => true),
                'is_author' => array(
                    'active' => true,
                    'bool_only' => false), // false means ! bool are accepted as arguments. in this case, e.g. author ID might be passed

                'is_category' => array(
                    'active' => true,
                    'bool_only' => false),
                'is_child_theme' => array(
                    'active' => true,
                    'bool_only' => true),
                'is_comments_popup' => array(
                    'active' => true,
                    'bool_only' => true),
                'is_date' => array(
                    'active' => true,
                    'bool_only' => true),
                'is_day' => array(
                    'active' => true,
                    'bool_only' => true),

                'is_feed' => array(
                    'active' => true,
                    'bool_only' => true),
                'is_front_page' => array(
                    'active' => true,
                    'bool_only' => true),
                'is_home' => array(
                    'active' => true,
                    'bool_only' => true),
                'is_month' => array(
                    'active' => true,
                    'bool_only' => true),
                'is_multi_author' => array(
                    'active' => true,
                    'bool_only' => true),

                'is_multisite' => array(
                    'active' => true,
                    'bool_only' => true),
                'is_main_site' => array(
                    'active' => true,
                    'bool_only' => true),
                'is_new_day' => array(
                    'active' => true,
                    'bool_only' => true),
                'is_page' => array(
                    'active' => true,
                    'bool_only' => false),
                'is_page_template' => array(
                    'active' => true,
                    'bool_only' => false),

                'is_paged' => array(
                    'active' => true,
                    'bool_only' => true),
                'is_post_type_archive' => array(
                    'active' => true,
                    'bool_only' => false),
                'is_post_type_hierarchical' => array(
                    'active' => true,
                    'bool_only' => false),
                'is_preview' => array(
                    'active' => true,
                    'bool_only' => true),
                'is_rtl' => array(
                    'active' => true,
                    'bool_only' => true),

                'is_search' => array(
                    'active' => true,
                    'bool_only' => true),
                'is_single' => array(
                    'active' => true,
                    'bool_only' => false),
                'is_singular' => array(
                    'active' => true,
                    'bool_only' => false),
                'is_sticky' => array(
                    'active' => true,
                    'bool_only' => false),
                'is_super_admin' => array(
                    'active' => true,
                    'bool_only' => true),

                'is_tag' => array(
                    'active' => true,
                    'bool_only' => false),
                'is_tax' => array(
                    'active' => true,
                    'bool_only' => false),
                'is_time' => array(
                    'active' => true,
                    'bool_only' => true),
                'is_trackback' => array(
                    'active' => true,
                    'bool_only' => true),
                'is_year' => array(
                    'active' => true,
                    'bool_only' => true),

                'post_type_exists' => array(
                    'active' => true,
                    'bool_only' => false),
                'taxonomy_exists' => array(
                    'active' => true,
                    'bool_only' => false),
            );

            return $arr_tags;
        }

        /**
         *
         */
        public function supported_only_in_loop()
        {
            $arr_in_loop = array(
                'in_category' => array(
                    'active' => true,
                    'bool_only' => false),
                'comments_open' => array(
                    'active' => true,
                    'bool_only' => true),    // http://codex.wordpress.org/Conditional_Tags#Any_Page_Containing_Posts
                'get_post_type' => array(
                    'active' => true,
                    'bool_only' => false),
                'has_excerpt' => array(
                    'active' => true,
                    'bool_only' => false),

                'has_tag' => array(
                    'active' => true,
                    'bool_only' => false),    // post parm (currently) not supported by ezClasses http://codex.wordpress.org/Function_Reference/has_tag
                'has_term' => array(
                    'active' => true,
                    'bool_only' => false),    //
                'pings_open' => array(
                    'active' => true,
                    'bool_only' => true),    // http://codex.wordpress.org/Conditional_Tags#Any_Page_Containing_Posts
            );

            return $arr_in_loop;
        }

        /**
         * Note: Perhaps not always conditional tags
         */
        public function supported_tags_other()
        {

            $arr_other = array(
                'get_option' => array(
                    'active' => true,
                    'bool_only' => false),
                'is_active_sidebar' => array(
                    'active' => true,
                    'bool_only' => false),
                'wp_attachment_is_image' => array(
                    'active' => true,
                    'bool_only' => true),
                'current_user_can' => array(
                    'active' => true,
                    'bool_only' => false),  // NOTE: args are NOT supported, just the capability

                'is' => array(
                    'active' => true,
                    'bool_only' => true),
                'is_IIS' => array(
                    'active' => true,
                    'bool_only' => true),
                'is_iis' => array(
                    'active' => true,
                    'bool_only' => true),
                'is_iis7' => array(
                    'active' => true,
                    'bool_only' => true),
            );

            return $arr_other;
        }


        /**
         * http://codex.wordpress.org/Global_Variables
         */
        public function supported_browser_detection()
        {

            return array(
                'is_iphone' => array(
                    'active' => true,
                    'bool_only' => true),
                'is_chrome' => array(
                    'active' => true,
                    'bool_only' => true),
                'is_safari' => array(
                    'active' => true,
                    'bool_only' => true),
                'is_NS4' => array(
                    'active' => true,
                    'bool_only' => true),
                'is_ns4' => array(
                    'active' => true,
                    'bool_only' => true),

                'is_opera' => array(
                    'active' => true,
                    'bool_only' => true),
                'is_macIE' => array(
                    'active' => true,
                    'bool_only' => true),
                'is_macie' => array(
                    'active' => true,
                    'bool_only' => true),
                'is_winIE' => array(
                    'active' => true,
                    'bool_only' => true),
                'is_winie' => array(
                    'active' => true,
                    'bool_only' => true),

                'is_gecko' => array(
                    'active' => true,
                    'bool_only' => true),  // = firefox
                'is_lynx' => array(
                    'active' => true,
                    'bool_only' => true),
                'is_IE' => array(
                    'active' => true,
                    'bool_only' => true),
                'is_ie' => array(
                    'active' => true,
                    'bool_only' => true),
            );
        }

    }  // close: class
} // close: if class_exists