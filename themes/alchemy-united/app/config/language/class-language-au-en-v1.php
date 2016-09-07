<?php

namespace WPezTheme;

if ( ! class_exists('Language_AU_En_V1')){
    class Language_AU_En_V1 extends \WPezBoilerStrap\Toolbox\Parents\Language {

    	private $_brand = 'Alchemy United';

    	public function ez__construct() {
		    // TODO: Implement ez__construct() method.
	    }

	    public function index() {
		    $o      = new \stdClass();
		    $o->one = 'index';

		    return $o;
	    }

	    protected function header_nav(){

	    	$obj = new \stdClass();

		    $obj->brand_title = 'Home: ' . $this->_brand;
	        $obj->brand_name =  $this->_brand;

            return $obj;
        }

    }
}