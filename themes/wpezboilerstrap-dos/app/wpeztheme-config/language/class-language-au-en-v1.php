<?php

namespace WPezTheme;

if ( ! class_exists('Language_AU_En_V1')){
    class Language_AU_En_V1 extends \WPez\WPezBoilerStrap\Toolbox\Parents\Language {

    	private $_brand = 'WPezBoilerStrap';


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

        protected function footer_bottom($args = ''){
	        $lang = new \stdClass();

	        $lang->copyright_time = '2016 ';
	        $lang->copyright_name = $this->_brand;

	        $lang->back_to_top = 'Back to Top';

	        return $lang;
        }

    }
}