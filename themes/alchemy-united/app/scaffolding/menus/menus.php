<?php


namespace WPezTheme\Scaffolding;

if ( !class_exists( 'Menus' ) ) {
    class Menus
    {

        public function __construct()
        {

        }

        public function get( $str = 'args' )
        {
            if ( method_exists($this, $str ) ) {
                return $this->$str();
            }
            return array();
        }

        protected function args()
        {
            $arr = array();

            $arr['menu_main'] = $this->menu_main( true );

            $arr['menu_categories'] = $this->menu_categories( true );

	        $arr['menu_tags'] = $this->menu_tags( true );

	        $arr['menu_social_share'] = $this->menu_social_share( true );

            $arr['menu_footer'] = $this->menu_footer( false );

            return $arr;

        }

        protected function menu_main( $bool_active = true )
        {
            $obj = new \stdClass();

            $theme_location = 'menu_main';
            $walker = new \WPezClasses\Menus\Walker_BS3_V1();

            $obj->active = $bool_active;
            $obj->description = 'Menu: Main';  // key => description is used for register_nav_menus()
            $obj->theme_location = $theme_location;
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


        protected function menu_categories( $bool_active = true )
        {

            $obj = new \stdClass();
            $theme_location = 'menu_categories';
            $walker = new \WPezClasses\Menus\Walker_Simple_List_V1();


            $obj->active = $bool_active;
            $obj->description = 'Menu: Categories';  // key => description is used for register_nav_menus()
            $obj->theme_location = $theme_location;
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

	    protected function menu_tags( $bool_active = true )
	    {

		    $obj = new \stdClass();
		    $theme_location = 'menu_tags';
		    $walker = new \WPezClasses\Menus\Walker_Simple_List_V1();


		    $obj->active = $bool_active;
		    $obj->description = 'Menu: Tags';  // key => description is used for register_nav_menus()
		    $obj->theme_location = $theme_location;
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

	    protected function menu_social_share( $bool_active = true )
	    {

		    $obj = new \stdClass();
		    $theme_location = 'menu_social_share';
		    $walker = new \WPezClasses\Menus\Walker_Social_Share_V1();


		    $obj->active = $bool_active;
		    $obj->description = 'Menu: Social Share';  // key => description is used for register_nav_menus()
		    $obj->theme_location = $theme_location;
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

        protected function menu_footer( $bool_active = true )
        {
            $obj = new \stdClass();
            $theme_location = 'menu_footer';

            $obj->active = $bool_active;
            $obj->description = 'Menu: Footer';  // key => description is used for register_nav_menus()
            $obj->theme_location = $theme_location;
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
                'walker' => NULL, // new Class_WP_ezClasses_Menu_Walker_Bootstrap_3x_1(),
                'theme_location' => $theme_location,
                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            );

            return $obj;
        }

    }
}