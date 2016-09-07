<?php
/**
 *
 */

namespace WPezTheme;

if ( ! class_exists('WPezConfig') ){
    class WPezConfig{

       function __construct(){}

        public function get($str_meth = ''){

            if ( method_exists($this, $str_meth)){
                return $this->$str_meth();
            }
            return;
        }

        protected function all(){

            $obj = new \stdClass();

            $obj->build = $this->build();
            $obj->env = $this->environment();
            $obj->globals = $this->globals();
            $obj->lang = $this->language();
            $obj->vargs = $this->viewargs();

            return $obj;
        }


        static public function build(){

            $obj = new \stdClass();
            $obj->slug = 'app\build-loader';
            $obj->name = '';
            $obj->class = '\\WPezTheme\Build_Loader';

            return $obj;
        }


        protected function environment(){

            $obj = new \stdClass();
            $obj->current = 'TODO';
            return $obj;
        }


        public function globals(){

            $obj = new \stdClass();

	        $obj->get_pagination = array(
	        	'prev_text' => 'PREV',
		        'next_text' => 'NEXXXXT'
	        );

            return $obj;
        }

        protected function language(){

            $obj = new \stdClass();
            $obj->slug = '\app\language\language-au';
            $obj->name = 'en-v1';
            $obj->class = '\\WPezTheme\Language_AU_En_V1';

            get_template_part($obj->slug, $obj->name);

            return new $obj->class();
        }

        protected function viewargs(){

            $obj = new \stdClass();
            $obj->slug = '\app\viewargs\class-viewargs-au-bs3-v1';
            $obj->name = '';
            $obj->class = '\\WPezTheme\Viewargs_AU_BS3_V1';

            get_template_part($obj->slug, $obj->name);

            return new $obj->class();
        }

    }
}