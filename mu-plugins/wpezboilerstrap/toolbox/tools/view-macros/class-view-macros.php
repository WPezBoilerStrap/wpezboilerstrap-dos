<?php

namespace WPezBoilerStrap\Toolbox\Tools;

	/*
	 * More info: http://scotty-t.com/2012/07/09/wp-you-oop/
	 */

// No WP? Die! Now!!
if ( ! defined('ABSPATH') ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die();
}

if ( ! class_exists('View_Macros') ) {
	class View_Macros { // extends \WPezBoilerStrap\Toolbox\Parents\Singleton {


		static function test( $x = ''){

			echo '<h1>TEST ' . $x . '</h1>';


		}

		static function test2( $x = ''){

			echo '<h1>TEST2 ' . $x . '</h1>';

			self::test('111');
		}

	}
}