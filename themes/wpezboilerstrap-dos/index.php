<?php

namespace WPezTheme;

// No WP? Die! Now!!
if ( ! defined('ABSPATH') ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die();
}

// TODO - alter the template hierarchy so it goes straight to index

get_template_part('app/wpeztheme-config/wpeztheme-config');
$ins_config = new WPezTheme_Config();

// gargs is short for "global args" -  we will keep passing it forward. from controler to controler
$arr_gargs = array();
$arr_args['config'] = $ins_config->get_all();

// ready! let's go!!
get_template_part('controllers/index');
$au = new Index($arr_args);

echo $au->get_view();