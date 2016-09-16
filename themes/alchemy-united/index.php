<?php

namespace WPezTheme;

// No WP? Die! Now!!
if ( ! defined('ABSPATH') ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die();
}

// TODO - alter the template hierarchy so it goes straight to index

get_template_part('controllers\index');
$au = new Index();
echo $au->get_view();