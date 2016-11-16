<?php
/*
Plugin Name: WPezPlug for ACHQ
Plugin URI: TODO
Description: Custom WPezPlugin for ACHQ
Version: 0.0.1
Author: Mark "Chief Alchemist" Simchock for Alchemy United
Author URI: http://alchemyunited.com
License: GPLv2 or later
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wpez-achq
*/

namespace achq;

if ( ! class_exists('WPez_Achq') ){
	class WPez_Achq{

		function __construct() {

			// TODO move to a project-centric plugin, here for demo purposes only
			$hc = new \WPez\WPezClasses\Theme\Head_Cleanup();
			$hc->ez_loader();

		}

	}
}
new WPez_Achq();
