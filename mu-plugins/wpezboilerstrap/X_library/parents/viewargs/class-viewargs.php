<?php

namespace WPezBoilerStrap\Library\Parents;

if ( ! class_exists('Viewargs')) {
    abstract class Viewargs
    {

        function __construct(){

        }

        public function get($str_meth){
            if ( method_exists($this, $str_meth) ){
                return $this->$str_meth();
            } else {
                return $str_meth . (' < mia - TODOx');
            }
        }

    }
}