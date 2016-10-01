<?php
/*
 * http://en.wikipedia.org/wiki/Aspect_ratio_%28image%29
 *
 * http://www.papersizes.org/a-paper-sizes-tsta.htm
 */

namespace WPezClasses\Reference;


if ( !class_exists( 'Aspect_Ratios' ) ) {
    class Aspect_Ratios{

        static function get($str_name = '', $bool_xpath = false ){

	        $file = __DIR__ . '/xml/aspect-ratios.xml';
	        $xml = simplexml_load_file( $file );

	        if ( $xml === false ){
	        	return false;
	        }

	        // all the ratio nodes
        	if ( empty($str_name) ){

		        $ratio = $xml->xpath("ratio");
		        if ( $bool_xpath === true){
		        	return $ratio;
		        }
		        $arr_converted =  self::xmlelement_to_stdclass($ratio);
		        return $arr_converted;
	        }
	        // or node by name
	        $str_name = strtolower($str_name);
	        $ratio = $xml->xpath("ratio[name='$str_name']");
	        if ( $bool_xpath === true){
		        return $ratio;
	        }
	        if ( ! empty($ratio) ){
		        $arr_converted = self::xmlelement_to_stdclass($ratio);
		        // return the node's obj sans the key
		        return $arr_converted[$str_name];
	        }
	        return $ratio;
        }

	    /**
	     * @param $xml
	     *
	     * @return array
	     */
        public function xmlelement_to_stdclass($xml){

	        $arr_new = array();
	        foreach ( $xml as $key => $xml_ele ){
	        	// ref http://stackoverflow.com/questions/1584725/quickly-convert-simplexmlobject-to-stdclass
		        $obj = json_decode(json_encode($xml_ele));
		        $arr_new[$obj->name] = $obj;
	        }
	        return $arr_new;

        }

    }
}