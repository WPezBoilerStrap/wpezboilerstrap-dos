<?php
/*
 * http://en.wikipedia.org/wiki/Aspect_ratio_%28image%29
 *
 * http://www.papersizes.org/a-paper-sizes-tsta.htm
 */

namespace WPez\WPezClasses\Reference;


if ( ! class_exists( 'Aspect_Ratios' ) ) {
	class Aspect_Ratios {

		/**
		 * xpath "query" with results returned as is
		 *
		 * @param string $str_name
		 *
		 * @return bool|\SimpleXMLElement[]
		 */
		static public function get( $str_name = '' ) {

			$file = __DIR__ . '/xml/aspect-ratios.xml';
			$xml  = simplexml_load_file( $file );

			if ( $xml === false ) {
				return false;
			}

			// all the ratio nodes
			if ( empty( $str_name ) ) {
				$ratio = $xml->xpath( "ratio" );

				return $ratio;
			}
			// or node by name
			$str_name = strtolower( $str_name );
			$ratio    = $xml->xpath( "ratio[name='$str_name']" );

			return $ratio;
		}

		/**
		 * xpath query with ez processing to make it ez-friendly.
		 *
		 * @param string $str_name
		 *
		 * @return array|bool|mixed|\SimpleXMLElement[]
		 */
		static function ez_get( $str_name = '' ) {

			$file = __DIR__ . '/xml/aspect-ratios.xml';
			$xml  = simplexml_load_file( $file );

			if ( $xml === false ) {
				return false;
			}

			// all the ratio nodes
			if ( empty( $str_name ) ) {
				$ratio         = $xml->xpath( "ratio" );
				$arr_converted = self::xmlelement_to_stdclass( $ratio );

				return $arr_converted;
			}
			// or node by name
			$str_name = strtolower( $str_name );
			$ratio    = $xml->xpath( "ratio[name='$str_name']" );
			if ( ! empty( $ratio ) ) {
				$arr_converted = self::xmlelement_to_stdclass( $ratio );

				// return the node's obj sans the key
				return $arr_converted[ $str_name ];
			}
			return $ratio;
		}

		/**
		 * @param $xml
		 *
		 * @return array
		 */
		static public function xmlelement_to_stdclass( $xml ) {

			$arr_new = array();
			foreach ( $xml as $key => $xml_ele ) {
				// ref http://stackoverflow.com/questions/1584725/quickly-convert-simplexmlobject-to-stdclass
				$obj                   = json_decode( json_encode( $xml_ele ) );
				$arr_new[ $obj->name ] = $obj;
			}
			return $arr_new;
		}

	}
}