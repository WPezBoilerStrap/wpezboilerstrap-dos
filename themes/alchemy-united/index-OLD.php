<?php

namespace WPezTheme;

if ( ! class_exists('Index')) {
	class Index {

		protected $_route;

		function __construct($route = 'TODO') {


			$obj = new WPezConfig();
			$obj_all = $obj->get('all');

			// add the route to the "all" object.
			$obj_all->route = $route;

			get_template_part('test-controller');

			$new = new \test_controller();

			$x = $new->view();

			echo $x;

			$x = WPezConfig_2::ez_new('xxx');

			var_dump($x->get('all'));

			/**
			 * let the loading begin
			 */
			$vc = new \stdClass();
			$vc->c_slug = 'controllers\index-body';
			//$x->c_name = '';
			$vc->c_class = '\\WPezTheme\Controllers\Index_Body';

			//$vc->v_slug = false;
			//$x->v_name = '';
			$vc->v_class = '\\WPezBoilerStrap\Views\Wrappers\Index_BS3_V1';

			// what's the name of the method in the language class for this view?
			$vc->v_meth_lang = 'index';
			// what's the name of the method in the markup class for this view?
			$vc->v_meth_vargs = 'index';

			// lvc = l-oad v-iew (and) c-ontroller
			$obj_view = \WPezCore::ez_lvc($vc, $obj_all);

			return;

		}
	}
}
new Index();
