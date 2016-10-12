<?php
/**
 *
 */

namespace WPezTheme;

if ( ! class_exists('WPezConfig') ){
    class WPezConfig extends \WPezBoilerStrap\Toolbox\Parents\WPezConfig{

    	private static $_lang;
	    private static $_opts;
	    private static $_route;
	    private static $_vargs;

       function ez__construct(){
       }


        protected function scaffolding(){

            $obj = new \stdClass();
            $obj->slug = 'app\scaffolding\scaffolding-loader';
            $obj->name = '';
            $obj->class = '\\WPezTheme\Scaffolding_Loader';

            return $obj;
        }



	    /**
	     * @return mixed
	     */
        public function language(){

        	if ( ! isset( self::$_lang )) {

		        $obj        = new \stdClass();

		        $obj->active = true;
		        $obj->slug  = '\app\config\language\class-language-au';
		        $obj->name  = 'en-v1';
		        $obj->class = '\\WPezTheme\Language_AU_En_V1';
		        $obj->args  = '';

		        self::$_lang = $this->gtp_loader( $obj );

	        }
	        return self::$_lang;
        }


	    /**
	     * @return mixed
	     */
        protected function options(){

	        if ( ! isset( self::$_opts )) {

		        $obj        = new \stdClass();

		        $obj->active = true;
		        $obj->slug_path = 'app\config\options';
		        $obj->slug  = 'class-options-au-v1';
		        $obj->name  = '';
		        $obj->class = '\\WPezTheme\Options_AU_V1';
		        $obj->args  = '';

		        self::$_opts = $this->gtp_loader( $obj );
	        }
	        return self::$_opts;

        }

	    /**
	     * @return mixed
	     */
	    protected function router(){

		    if ( ! isset( self::$_route )) {

			    $obj        = new \stdClass();

			    $obj->active = true;
			    $obj->slug_path  = 'app\config\options';
			    $obj->slug  = 'class-router-au-v1';
			    $obj->name  = '';
			    $obj->class = '\\WPezTheme\Router_AU_V1';
			    $obj->args  = '';

			    self::$_route = $this->gtp_loader($obj);
		    }
		    return self::$_route;
	    }


	    /**
	     * @return mixed
	     */
        protected function viewargs(){

	        if ( ! isset( self::$_vargs )) {

		        $obj        = new \stdClass();

		        $obj->active = true;
		        $obj->slug  = '\app\config\viewargs\class-viewargs-au-bs3-v1';
		        $obj->name  = '';
		        $obj->class = '\\WPezTheme\Viewargs_AU_BS3_V1';
		        $obj->args = '';

		        self::$_vargs = $this->gtp_loader($obj);
	        }
	        return self::$_vargs;
        }

    }
}