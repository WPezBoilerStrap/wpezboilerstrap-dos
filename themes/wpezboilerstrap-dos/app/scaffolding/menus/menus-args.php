<?php


namespace WPezTheme\Scaffolding;

if ( !class_exists( 'Menus_Args' ) ) {
    class Menus_Args
    {

        public function __construct(){}

        public function get( $str = 'args' ) {
            if ( method_exists($this, $str ) ) {
                return $this->$str();
            }
            return array();
        }

        protected function args(){

            $arr = array();

            $arr['menu_main'] = $this->menu_main( false );

            $arr['menu_categories'] = $this->menu_categories( true );

	        $arr['menu_tags'] = $this->menu_tags( true );

	        $arr['menu_social_share'] = $this->menu_social_share( true );

            $arr['menu_footer'] = $this->menu_footer( false );

            return $arr;
        }


        // TODO protected function master()

        protected function menu_main( $bool_active = true ){


            $theme_location = 'menu_main';
	        $theme_description = 'Menu: Main';  // key => description is used for register_nav_menus()
            $walker = new \WPez\WPezClasses\Menus\Walker_BS3_V1();

	        // --
	        $obj = new \stdClass();
            $obj->active = $bool_active;

	        $obj_rnm = new \stdClass();
	        $obj_rnm->location =  $theme_location;
	        $obj_rnm->description = $theme_description;

	        $obj->register_nav_menu = $obj_rnm;

            $obj->wp_nav_menu = array(
                'menu' => $theme_location,
                'menu_class' => 'nav navbar-nav navbar-right',
                'menu_id' => 'ez-menu-main',
                'container' => 'div',
                'container_class' => 'collapse navbar-collapse bs-navbar-collapse',
                'container_id' => 'menu-main-wnm',
                'fallback_cb' => false,
                'before' => '',
                'after' => '',
                'link_before' => '',
                'link_after' => '',
                'echo' => false,
                'depth' => 0,
                'walker' => $walker,
                'theme_location' => $theme_location,
                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            );

            return $obj;
        }


        protected function menu_categories( $bool_active = true ) {

	        $theme_location = 'menu_categories';
	        $theme_description = 'Menu: Categories';
	        $walker = new \WPez\WPezClasses\Menus\Walker_Simple_List_V1();

	        // --
	        $obj = new \stdClass();
	        $obj->active = $bool_active;

	        $obj_rnm = new \stdClass();
	        $obj_rnm->location =  $theme_location;
	        $obj_rnm->description = $theme_description;

	        $obj->register_nav_menu = $obj_rnm;

            $obj->wp_nav_menu = array(
                'menu' => $theme_location,
                'menu_class' => 'nav navbar-nav navbar-right',
                'menu_id' => 'ez-menu-global',
                'container' => 'div',
                'container_class' => 'collapse navbar-collapse bs-navbar-collapse',
                'container_id' => 'menu-global-wnm',
                'fallback_cb' => false,
                'before' => '',
                'after' => '',
                'link_before' => '',
                'link_after' => '',
                'echo' => false,
                'depth' => 0,
                'walker' => $walker,
                'theme_location' => $theme_location,
                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            );

            return $obj;
        }

	    protected function menu_tags( $bool_active = true ) {

		    $theme_location = 'menu_tags';
		    $theme_description = 'Menu: Tags';
		    $walker = new \WPez\WPezClasses\Menus\Walker_Simple_List_V1();

		    // --
		    $obj = new \stdClass();
		    $obj->active = $bool_active;

		    $obj_rnm = new \stdClass();
		    $obj_rnm->location =  $theme_location;
		    $obj_rnm->description = $theme_description;

		    $obj->register_nav_menu = $obj_rnm;

		    $obj->wp_nav_menu = array(
			    'menu' => $theme_location,
			    'menu_class' => 'nav navbar-nav navbar-right',
			    'menu_id' => 'ez-menu-global',
			    'container' => 'div',
			    'container_class' => 'collapse navbar-collapse bs-navbar-collapse',
			    'container_id' => 'menu-global-wnm',
			    'fallback_cb' => false,
			    'before' => '',
			    'after' => '',
			    'link_before' => '',
			    'link_after' => '',
			    'echo' => false,
			    'depth' => 0,
			    'walker' => $walker,
			    'theme_location' => $theme_location,
			    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		    );

		    return $obj;
	    }

	    protected function menu_social_share( $bool_active = true ){

		    $theme_location = 'menu_social_share';
		    $theme_description = 'Menu: Social Share';
		    $walker = new \WPez\WPezClasses\Menus\Walker_Social_Share_V1();

		    // --
		    $obj = new \stdClass();
		    $obj->active = $bool_active;

		    $obj_rnm = new \stdClass();
		    $obj_rnm->location =  $theme_location;
		    $obj_rnm->description = $theme_description;

		    $obj->register_nav_menu = $obj_rnm;

		    $obj->wp_nav_menu = array(
			    'menu' => $theme_location,
			    'menu_class' => 'nav navbar-nav navbar-right',
			    'menu_id' => 'ez-menu-social-share',
			    'container' => 'div',
			    'container_class' => 'collapse navbar-collapse bs-navbar-collapse',
			    'container_id' => 'menu-global-wnm',
			    'fallback_cb' => false,
			    'before' => '',
			    'after' => '',
			    'link_before' => '',
			    'link_after' => '',
			    'echo' => false,
			    'depth' => 0,
			    'walker' => $walker,
			    'theme_location' => $theme_location,
			    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		    );

		    return $obj;
	    }


        protected function menu_footer( $bool_active = true ) {

	        $theme_location = 'menu_footer';
	        $theme_description = 'Menu: Footer';
	        $walker = NULL;

	        // --
	        $obj = new \stdClass();
	        $obj->active = $bool_active;

	        $obj_rnm = new \stdClass();
	        $obj_rnm->location =  $theme_location;
	        $obj_rnm->description = $theme_description;

	        $obj->register_nav_menu = $obj_rnm;

            $obj->wp_nav_menu = array(
                'menu' => $theme_location,
                'menu_class' => 'nav navbar-nav',
                'menu_id' => 'ez-menu-footer',
                'container' => 'div',
                'container_class' => 'collapse navbar-collapse bs-navbar-collapse',
                'container_id' => 'menu-footer-wnm',
                'fallback_cb' => false,
                'before' => '',
                'after' => '',
                'link_before' => '',
                'link_after' => '',
                'echo' => false,
                'depth' => 0,
                'walker' => $walker,
                'theme_location' => $theme_location,
                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            );

            return $obj;
        }

    }
}