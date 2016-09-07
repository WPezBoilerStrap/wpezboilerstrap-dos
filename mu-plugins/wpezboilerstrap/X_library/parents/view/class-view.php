<?php

namespace WPezBoilerStrap\Library\Parents;

if ( ! class_exists('View')) {
    abstract class View
    {

    	protected $_controller;
        protected $_view;


	    protected $mod;

        public function __construct( $obj_controller = '' )
        {
            // TODO - other validation
            if ( ! is_object( $obj_controller ) ) {
                $this->_view = '';
            } else {
            	$this->_controller = $obj_controller;
	            $this->mod =  $obj_controller->get( 'mod' );
	            $this->_view = $this->view( $obj_controller->get( 'lang' ), $this->mod, $obj_controller->get( 'vargs' ), $obj_controller->get( 'vws' ) );
            }
        }

        public function set($mod){
        	$this->mod = $mod;
	        $obj_controller = $this->_controller;
	        $this->_view = $this->view( $obj_controller->get( 'lang' ), $this->mod, $obj_controller->get( 'vargs' ), $obj_controller->get( 'vws' ) );

        }



        public function get()
        {

        //	$obj_args = $this->_controller;
        //	var_dump($obj_args);
	    //   $this->_view = $this->view( $obj_args->get( 'lang' ), $obj_args->get( 'mod' ), $obj_args->get( 'vargs' ), $obj_args->get( 'vws' ) );

	      return $this->_view;
        }

        /**
         * The view should always return a string, or at the very least, not echo
         * @param $lang
         * @param $mod
         * @param $vargs
         * @param $vws
         *
         * @return string
         */
        function view( $lang, $mod, $vargs, $vws )
        {
        	$mod = $this->mod;
            return '';

        }

    }
}