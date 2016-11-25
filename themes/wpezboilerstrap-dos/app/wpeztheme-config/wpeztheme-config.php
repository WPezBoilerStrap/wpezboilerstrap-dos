<?php
/**
 *
 */

namespace WPezTheme;

if ( ! class_exists('WPezTheme_Config') ){
    class WPezTheme_Config extends \WPez\WPezBoilerStrap\Toolbox\Parents\Config{

    	private static $_lang = false;
	    private static $_opts = false;
	    private static $_route = false;
	    private static $_vargs = false;

	    /**
	     * @return mixed
	     */
        public function language(){

        	if ( self::$_lang === false ) {

		        $obj        = new \stdClass();

		        $obj->active = true;
		        $obj->slug_path = 'app/wpeztheme-config/language';
		        $obj->slug  = 'class-language-au';
		        $obj->name  = 'en-v1';

		        $this->ez_gtp( $obj );

		        self::$_lang = new Language_AU_En_V1();

	        }
	        return self::$_lang;
        }

	    /**
	     * @return mixed
	     */
	    public function options(){

		    if ( self::$_opts === false ) {

			    $obj        = new \stdClass();

			    $obj->active = true;
			    $obj->slug_path = 'app/wpeztheme-config/options';
			    $obj->slug  = 'class-options-au-v1';
			    $obj->name  = '';

			    $this->ez_gtp( $obj );

			    self::$_opts = new Options_AU_V1();

		    }
		    return self::$_opts;
	    }


	    /**
	     * @return mixed
	     */
	    public function router(){

		    if ( self::$_route === false ) {

			    $obj        = new \stdClass();

			    $obj->active = true;
			    $obj->slug_path  = 'app/wpeztheme-config/router';
			    $obj->slug  = 'class-router-au-v1';
			    $obj->name  = '';

			    $this->ez_gtp( $obj );

			    self::$_route = new Router_AU_V1();

		    }
		    return self::$_route;
	    }


	    /**
	     * @return mixed
	     */
	    public function viewargs(){

		    if ( self::$_vargs === false ) {

			    $obj        = new \stdClass();

			    $obj->active = true;
			    $obj->slug_path  = 'app/wpeztheme-config/viewargs';
			    $obj->slug  = 'class-viewargs-au-bs3-v1';
			    $obj->name  = '';

			    $this->ez_gtp( $obj );

			    $str_class_ns = 'WPezTheme\\';
			    $str_class = 'Viewargs_AU_BS3_V1';


			    if ( class_exists($str_class_ns . $str_class ) ) {
				    // ODD - the actual string value (sans the namespace) works fine. but when
				    // using it via a var the namespace has to be prefixed. ???
				    $temp = $str_class_ns . $str_class;
				    self::$_vargs = new $temp();
			    }
		    }
		    return self::$_vargs;
	    }

    }
}