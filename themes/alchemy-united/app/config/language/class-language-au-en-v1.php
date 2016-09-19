<?php

namespace WPezTheme;

if ( ! class_exists('Language_AU_En_V1')){
    class Language_AU_En_V1 extends \WPezBoilerStrap\Toolbox\Parents\Language {

    	private $_brand = 'Alchemy United';

    	public function ez__construct() {
		    // TODO: Implement ez__construct() method.
	    }

	    public function index() {

		    $lang      = new \stdClass();
		    $lang->one = 'index';

		    return $lang;
	    }

	    protected function header_nav(){

	    	$lang = new \stdClass();

		    $lang->brand_title = 'Home: ' . $this->_brand;
	        $lang->brand_name =  $this->_brand;

            return $lang;
        }

    }
}