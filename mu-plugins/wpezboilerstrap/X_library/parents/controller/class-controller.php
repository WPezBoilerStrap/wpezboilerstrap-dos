<?php

namespace WPezBoilerStrap\Library\Parents;

if ( ! class_exists('Controller')) {
    abstract class Controller
    {

        protected $_all;
        protected $_lang;
        protected $_vargs;
        protected $_route;

	    protected $_mod;

        public function __construct( $obj_args, $meth_lang = '', $meth_vargs = '')
        {
           // ? $this->active = true;
            $this->_all = $obj_args;
            $this->_lang = $meth_lang;
            $this->_vargs = $meth_vargs;
            // break out the route just to make it easier to find
            $this->_route = $obj_arg->route;

	        $this->_mod = $this->mod();

        }


	    public function get( $str_meth = '' )
	    {
		    if ( $str_meth == 'mod' ) {
			    return $this->_mod;
		    } elseif ( method_exists( $this, $str_meth ) ) {
			    return $this->$str_meth();
		    }
		    else {
			    return 'TODO';
		    }
	    }

	    public function set_mod($x = ''){

		    $this->_mod = $x;
	    }


        /**
         * globals = globals  (from wp-ezconfig)
         *
         * @return mixed
         */
        function globals($str_prop = '')
        {
        	if (empty($str_prop)){
		        return $this->_all->globals;
	        }
        	if (property_exists($this->_all->globals, $str_prop )){
        		return $this->_all->globals->$str_prop;
	        }
	        return 'TODO';
        }


        /**
         * l = language (from wp-ezconfig)
         *
         * @return object
         */
        protected function lang()
        {

            if ( method_exists($this->_all->lang, 'get') ){
                return $this->_all->lang->get( $this->_lang );
            }
            return;
        }


	    /**
	     * mod = model
	     *
	     * @return \stdClass
	     */
        function mod()
        {
            $m = new \stdClass();
            return $m;
        }

        /**
         * vargs = viewargs(from wpezconfig)
         *
         * @return object
         */
        function vargs()
        {
            if ( method_exists($this->_all->vargs, 'get') ){
                return $this->_all->vargs->get($this->_vargs );
            }
            return;
        }

        /**
         * vws = views (other views / partials this view is a parent to)
         *
         * @return object
         */
        function vws()
        {
            $v = new \stdClass();
            return $v;
        }

    }
}