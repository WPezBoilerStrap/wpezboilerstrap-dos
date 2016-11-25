<?php

namespace WPezTheme;

if ( ! class_exists('Viewargs_AU_BS3_V1')){
    class Viewargs_AU_BS3_V1 extends \WPez\WPezBoilerStrap\Toolbox\Parents\Viewargs{

    	public function ez__construct() {}


	    protected function index(){

		    $vargs = new \stdClass();

		    $vargs->lang_attrs = get_language_attributes();
		    $vargs->html_global_attrs = array(
			    'class' => 'no-js'
		    );
		    $vargs->charset = get_bloginfo( 'charset' );
		    $vargs->viewport_content = 'width=device-width, initial-scale=1.0';
		    $vargs->html5shiv = 'https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js';
		    $vargs->respondjs = 'https://oss.maxcdn.com/respond/1.4.2/respond.min.js';
		    $vargs->body_class = '';

		    return $vargs;
	    }

	    protected function index_body(){

		    $obj_enc = new \stdClass();

		    $obj_enc->active = false;

		    $obj_enc->semantic_active = true;
		    $obj_enc->semantic_tag = 'section';
		    $obj_enc->semantic_global_attrs = array(
			    //'class' => 'my semantic class test'
		    );

		    $obj_enc->view_wrapper_active = true;
		    $obj_enc->view_wrapper_tag = 'div';
		    $obj_enc->view_wrapper_global_attrs = array(
			   // 'class' => 'my wrapper class test'
		    );

		    $vargs = new \stdClass();
		    $vargs->enclose = $obj_enc;

		    return $vargs;

	    }

	    protected function header() {

		    $obj_enc = new \stdClass();

		    $obj_enc->active = true;            // an enclosure master switch

		    $obj_enc->semantic_active = true;
		    $obj_enc->semantic_tag = 'header';
		    $obj_enc->semantic_global_attrs = array(
			    //'class' => 'my semantic class test'
		    );

		    $obj_enc->view_wrapper_active = false;
		    $obj_enc->view_wrapper_tag = 'div';
		    $obj_enc->view_wrapper_global_attrs = array(
			    // 'class' => 'HEADER-CLASS'
		    );

		    $vargs = new \stdClass();
		    $vargs->enclose = $obj_enc;

		    return $vargs;
        }


        protected function header_nav_bs3(){

            $vargs = new \stdClass();

	        $vargs->wrapper_global_attrs = array(
		        'id' => 'nav-main',
		        'class' => 'navbar navbar-default',
		        'role' => 'navigation'
	        );
	        $vargs->inner_global_attrs = array(
		        'class' => 'container',
	        );
	        $vargs->header_global_attrs = array(
		        'class' => 'navbar-header',
	        );
	        $vargs->button_global_attrs = array(
		        'type' => 'button',
		        'class' => 'navbar-toggle collapsed',
		        'data-toggle' => 'collapse',
		        'data-target' => '.navbar-collapse'
	        );

	        $vargs->brand_class = 'navbar-brand';

            return $vargs;
        }

        protected function footer_wrapper(){

	        $obj_enc = new \stdClass();

	        $obj_enc->active = true;            // an enclosure master switch

	        $obj_enc->semantic_active = true;
	        $obj_enc->semantic_tag = 'footer';
	        $obj_enc->semantic_global_attrs = array(
		        //'class' => 'my semantic class test'
	        );

	        $obj_enc->view_wrapper_active = false;
	        $obj_enc->view_wrapper_tag = 'div';
	        $obj_enc->view_wrapper_global_attrs = array(
		        // 'class' => 'HEADER-CLASS'
	        );

	        $vargs = new \stdClass();
	        $vargs->enclose = $obj_enc;

	        return $vargs;

        }

        protected function footer_bottom($arg = ''){

	        $obj_enc = new \stdClass();

	        $obj_enc->active = true;            // an enclosure master switch - default is true

	        $obj_enc->semantic_active = true;   // default is true
	        $obj_enc->semantic_tag = 'div';
	        $obj_enc->semantic_global_attrs = array(
		        'class' => 'container'
	        );

	        $obj_enc->view_wrapper_active = true;   // default is true
	        $obj_enc->view_wrapper_tag = 'div';
	        $obj_enc->view_wrapper_global_attrs = array(
		        'class' => 'row'
	        );


	        $vargs = new \stdClass();
	        $vargs->enclose = $obj_enc;

	        $vargs->left_tag = 'div';
	        $vargs->left_global_attrs = array(
		        'class' => 'col-xs-12 col-md-5'
	        );

	        $vargs->middle_tag = 'div';
	        $vargs->middle_global_attrs = array(
		        'class' => 'col-xs-12 col-md-2'
	        );

	        $vargs->right_tag = 'div';
	        $vargs->right_global_attrs = array(
		        'class' => 'col-xs-12 col-md-5 text-right'
	        );

	        $vargs->copyright_symbol = '&copy; ';

	        $vargs->logo_url = 'http://placehold.it/75x75';
	        $vargs->logo_class = array(
		        'class' => 'center-block'
	        );

	        $vargs->href_back_to_top = '#top';

	        return $vargs;
        }


        protected function main($arg = ''){

	        $obj_enc = new \stdClass();

	        $obj_enc->active = true;            // an enclosure master switch - default is true

	        $obj_enc->semantic_active = true;   // default is true
	        $obj_enc->semantic_tag = 'section';
	        $obj_enc->semantic_global_attrs = array(
		        //'class' => 'container'
	        );

	        $obj_enc->view_wrapper_active = false;   // default is true
	        $obj_enc->view_wrapper_tag = 'row';
	        $obj_enc->view_wrapper_global_attrs = array(
		        //'class' => 'my wrapper class test'
	        );


	        $vargs = new \stdClass();
	        $vargs->enclose = $obj_enc;

	        return $vargs;
        }

        protected function page(){

	        $obj = new \stdClass();

	        $obj->semantic     = 'section';
	        $obj->title_wrap   = 'H1'; // e.g., H1
	        $obj->content_wrap = 'div'; // e.g., div

	        return $obj;
        }

        protected function single_main($arg = ''){

	        $obj_enc = new \stdClass();

	        $obj_enc->active = true;            // an enclosure master switch - default is true

	        $obj_enc->semantic_active = true;   // default is true
	        $obj_enc->semantic_tag = 'article';
	        $obj_enc->semantic_global_attrs = array(
		        //'class' => 'container'
	        );

	        $obj_enc->view_wrapper_active = false;   // default is true
	        $obj_enc->view_wrapper_tag = 'row';
	        $obj_enc->view_wrapper_global_attrs = array(
		        //'class' => 'my wrapper class test'
	        );


	        $vargs = new \stdClass();
	        $vargs->enclose = $obj_enc;

	        return $vargs;


        }

        protected function single_post_header($arg = ''){

	        $obj_enc = new \stdClass();

	        $obj_enc->active = true;            // an enclosure master switch - default is true

	        $obj_enc->semantic_active = true;   // default is true
	        $obj_enc->semantic_tag = 'header';
	        $obj_enc->semantic_global_attrs = array(
		        //'class' => 'my semantic class test'
	        );

	        $obj_enc->view_wrapper_active = false;   // default is true
	        $obj_enc->view_wrapper_tag = 'tag_TODO';
	        $obj_enc->view_wrapper_global_attrs = array(
		       // 'class' => 'my wrapper class test'
	        );

	        $vargs = new \stdClass();
	        $vargs->enclose = $obj_enc;

	        $vargs->title_tag = 'h1';
	        $vargs->title_tag_global_attrs = array(
		      //  'class' => 'title class'
	        );

	        $vargs->display_name_wrapper_tag = 'p';
	        $vargs->display_name_wrapper_global_attrs = array();
	        $vargs->display_name_icon_tag = 'i';
	        $vargs->display_name_icon_global_attrs = array(
		        'class' => 'fa fa-user fa-fw'
	        );

	        // http://www.plus2net.com/php_tutorial/php_date_format.php
	        $vargs->date_format = 'd M Y';

	        $vargs->post_date_wrapper_tag = 'div';
	        $vargs->post_date_wrapper_global_attrs = array();
	        $vargs->post_date_icon_tag = 'i';
	        $vargs->post_date_icon_global_attrs = array(
		        'class' => 'fa fa-calendar fa-fw'
	        );
	        $vargs->post_date_tag = 'span';
	        $vargs->post_date_global_attrs = array();

	        return $vargs;
        }


        protected function single_term_category(){

	        $vargs = new \stdClass();

	        $vargs->wrapper_tag = 'p'; // e.g. 'p';
	        $vargs->wrapper_global_attrs = array(
		    //    'id' => 'VARGS-WRAPPER_GLOBAL_ATTRS-ID',
		        'class' => 'text-left',
		    //    'itemscope' => '',
		    //    'itemtype' => 'http://schema.org/Movie'
	        );


	        $vargs->icon_label_wrapper_tag = false;
	        $vargs->icon_label_wrapper_global_attrs = array(
		        'class' => 'VARGS-ICON_SPAN_CLASS' // e.g., some FA class
	        );

	        $vargs->icon_tag = 'i';
	        $vargs->icon_global_attrs = array(
		        'class' => 'fa fa-flag fa-fw' // e.g., some FA class
	        );
	        $vargs->text_tag = 'span';
	        $vargs->text_global_attrs = array(
		        'class' => 'test' // e.g., some FA class
	        );
	        $vargs->link_class = false; // apply to every link
	        $vargs->link_rel = 'category';
	        $vargs->implode_glue = ', ';

	        return $vargs;
        }

	    protected function single_term_post_tag(){

		    $vargs = new \stdClass();

		    $vargs->wrapper_tag = 'p'; // e.g. 'p';
		    $vargs->wrapper_global_attrs = array(
			    //    'id' => 'VARGS-WRAPPER_GLOBAL_ATTRS-ID',
			    'class' => 'text-left'
		    );


		    $vargs->icon_label_wrapper_tag = false;
		    $vargs->icon_label_wrapper_global_attrs = array(
		        'class' => 'VARGS-ICON_SPAN_CLASS' // e.g., some FA class
		    );

		    $vargs->icon_tag = 'i';
		    $vargs->icon_global_attrs = array(
			    'class' => 'fa fa-tags fa-fw' // e.g., some FA class
		    );
		    $vargs->text_tag = 'span';
		    $vargs->text_global_attrs = array(
			    'class' => false // e.g., some FA class
		    );
		    $vargs->link_class = false; // apply to every link
		    $vargs->link_rel = 'tag';
		    $vargs->implode_glue = ', ';

		    return $vargs;
	    }

        protected function single_prev_next(){

	        $obj_enc = new \stdClass();

	        $obj_enc->active = true;            // an enclosure master switch

	        $obj_enc->semantic_active = true;
	        $obj_enc->semantic_tag = 'nav';
	        $obj_enc->semantic_global_attrs = array(
		        'class' => 'container'
	        );

	        $obj_enc->view_wrapper_active = true;
	        $obj_enc->view_wrapper_tag = 'div';
	        $obj_enc->view_wrapper_global_attrs = array(
		        'class' => 'row'
	        );

	        $vargs = new \stdClass();
	        $vargs->enclose = $obj_enc;

	        $vargs->wrapper_tag = 'ul';
	        $vargs->wrapper_global_attrs = array(
		        'class' => 'pager'
	        );

	        $vargs->page_tag = 'li';
	        $vargs->page_prev_global_attrs = array(
		        'class' => 'previous',
		        'title' => 'Previous'
	        );

	        $vargs->page_next_global_attrs = array(
		        'class' => 'next',
		        'title' => 'Next'
	        );

	        //if you don't want to use the font based icons make icon_tag = false
	        $vargs->icon_tag = 'i';
	        $vargs->icon_prev_global_attrs = array(
		        'class' => 'glyphicon glyphicon-chevron-left',
		        'aria-hidden' => "true"
	        );
	        $vargs->prev_icon = ''; // '&larr;';

	        $vargs->icon_next_global_attrs = array(
		        'class' => 'glyphicon glyphicon-chevron-right',
		        'aria-hidden' => "true"
	        );
	        $vargs->next_icon       = ''; // '&rarr;';

	        return $vargs;
        }


        protected function tabs_collapse($arg = ''){

	        $vargs = new \stdClass();

	        // $vargs->enclose = $obj_enc;

	        // the wrappers for the tabs and the content / panes
	        $vargs->tabs_wrapper_outer_tag = 'div';
	        $vargs->tabs_wrapper_outer_global_attrs = array(
		        "class" => "container blog-controls"
	        );
	        $vargs->tabs_wrapper_inner_tag = 'div';
	        $vargs->tabs_wrapper_inner_global_attrs = array(
		        "class" => "col-sm-7 col-sm-offset-5"
	        );

	        $vargs->panes_wrapper_tag = 'div';
	        $vargs->panes_wrapper_global_attrs = array(
		        "id" => "my-collapse-TODO",
		        "class" => "container blog-controls-open"
	        );

	        // the "globals" for the tabs and panes
	        $vargs->tab_tag = 'div';
	        // tab_global_attrs - can be set global but override at each individual row
	        $vargs->tab_global_attrs = array(
		        'class' => " TODO-VARGS"
	        );
	        $vargs->tab_link_global_attrs = array(
		        "class" => "btn btn-link col-xs-3",
		        "data-toggle" => "collapse",
		        "aria-expanded" => "false",
		        "aria-controls" => "collapseExample"
	        );
	        $vargs->tab_icon_tag = 'i';
	        $vargs->tab_name_global_attrs = array(

	        );

	        // $vargs->pane_wrap_tag = 'div';
	        $vargs->pane_wrap_global_attrs = array(
		        "class" => "col-lg-12 TODO collapse"
	        );
	        $vargs->pane_inner_tag = 'div';
	        $vargs->pane_inner_global_attrs = array(
		        'class' => "well"
	        );

	        $vargs->pane_name_tag = 'span';
	        $vargs->pane_name_global_attrs = array();

	        $vargs->pane_desc_tag = 'span';
	        $vargs->pane_desc_global_attrs = array();

	        $vargs->pane_footnote_tag = 'div';
	        $vargs->pane_footnote_global_attrs = array();


	        // the individual tabs / panes

	        $arr = array();

	        $str_pane_icon_tag = 'i';

	        // SHARE
	        $tab = new \stdClass();

	        // tab_global_attrs - can be set global but override at each individual row
	        $tab->tab_global_attrs = array(
		        'class' => " TODO-OBJ"
	        );
	        $tab->tab_name = '&nbsp;Share';   // TODO language?
	        $tab->tab_link_href = 'au-share';
	        $tab->tab_icon_global_attrs = array(
		        "class" => 'fa fa-share-alt fa-fw'
	        );
	        $tab->pane_icon_tag = $str_pane_icon_tag;
	        // these are different so you have control
	        $tab->pane_icon_global_attrs = array(
		        "class" => 'fa fa-share-alt fa-fw'
	        );
	        // on off swtich for the name
	        $tab->pane_name_active = true;
	        // duplicated / different so you have control
	        $tab->pane_name = 'Share';
	        // on off switch for the descrption
	        $tab->pane_desc_active = false;
	        $tab->pane_desc = " - Ex his ferri tation dolore, nam no invidunt reprimique.";
	        $tab->pane_footnote_active = false;
	        $tab->pane_footnote_tag = false;
	        $tab->pane_footnote = '';
	        // this pane's content come from mod() or parts()
	        $tab->pane_source = 'mod'; // or parts
	        // what property of mod() or parts()?
	        $tab->source_property = 'share';
	        $arr[] = $tab;

	        // CATEGORIES
	        $tab = new \stdClass();
	        $tab->tab_name = 'Categories';
	        $tab->tab_link_href = 'au-categories';
	        $tab->tab_icon_global_attrs = array(
		        "class" => 'fa fa-flag fa-fw'
	        );
	        $tab->pane_icon_tag = false; // $str_pane_icon_tag
	        $tab->pane_icon_global_attrs = array(
		        "class" => 'fa fa-flag fa-fw'
	        );
	        $tab->pane_name_active = false;
	        $tab->pane_name = 'Categories';
	        $tab->pane_desc_active = false;
	        $tab->pane_desc = " - Lorem ipsum dolor sit amet, dictas principes intellegebat ne ius.";
	        $tab->pane_footnote_active = false;
	        $tab->pane_footnote_tag = 'div';
	        $tab->pane_footnote = '';
	        $tab->pane_source = 'parts';
	        $tab->source_property = 'cats';
	        $arr[] = $tab;

	        // TAGS
	        $tab = new \stdClass();
	        $tab->tab_name = "Tags";
	        $tab->tab_link_href = 'au-tags';
	        $tab->tab_icon_global_attrs = array(
		        "class" => 'fa fa-tags fa-fw'
	        );
	        $tab->pane_icon_tag = false; // $str_pane_icon_tag;
	        $tab->pane_icon_global_attrs = array(
		        "class" => 'fa fa-tags fa-fw'
	        );
	        $tab->pane_name_active = false;
	        $tab->pane_name = 'Tags';
	        $tab->pane_desc_active = false;
	        $tab->pane_desc = " - In sea meis soleat periculis. Ad mei accommodare comprehensam.";
	        $tab->pane_footnote_active = false;
	        $tab->pane_footnote_tag = false;
	        $tab->pane_footnote = '';
	        $tab->pane_source = 'parts';
	        $tab->source_property = 'tags';
	        $arr[] = $tab;

	        // SEARCH
	        $tab = new \stdClass();
	        $tab->tab_name = "Search";
	        $tab->tab_link_href = 'au-search';
	        $tab->tab_icon_global_attrs = array(
		        "class" => 'fa fa-search fa-fw'
	        );
	        $tab->pane_icon_tag = $str_pane_icon_tag;
	        $tab->pane_icon_global_attrs = array(
		        "class" => 'fa fa-search fa-fw'
	        );
	        $tab->pane_name_active = true;
	        $tab->pane_name = 'Search';
	        $tab->pane_desc_active = false;
	        $tab->pane_desc = " - Ut sale etiam urbanitas mel. No repudiare patrioque scripserit mea.";
	        $tab->pane_footnote_active = false;
	        $tab->pane_footnote_tag = false;
	        $tab->pane_footnote = '';
	        $tab->pane_source = 'parts';
	        $tab->source_property = 'search';
	        $arr[] = $tab;

	        $vargs->tabs = $arr;

	        return $vargs;

        }

	    protected function tabs_menu_categories(){

		    $vargs = new \stdClass();

		    $vargs->wrapper_tag = 'span'; // e.g. 'p';
		    $vargs->wrapper_global_attrs = array(
			    //    'id' => 'VARGS-WRAPPER_GLOBAL_ATTRS-ID',
			    'class' => 'text-left'
		    );


		    $vargs->icon_label_wrapper_tag = false;
		    $vargs->icon_label_wrapper_global_attrs = array(
		        'class' => 'VARGS-ICON_SPAN_CLASS' // e.g., some FA class
		    );

		    $vargs->icon_tag = 'i';
		    $vargs->icon_global_attrs = array(
			    'class' => 'fa fa-flag fa-fw' // e.g., some FA class
		    );
		    $vargs->name_tag = 'span';
		    $vargs->name_global_attrs = array(
			    'class' => false // e.g., some FA class
		    );
		    $vargs->link_class = false; // apply to every link
		    $vargs->link_rel = 'tag';
		    $vargs->implode_glue = ', ';

		    return $vargs;
	    }

	    protected function tabs_menu_tags(){

		    $vargs = new \stdClass();

		    $vargs->wrapper_tag = 'span'; // e.g. 'p';
		    $vargs->wrapper_global_attrs = array(
			    //    'id' => 'VARGS-WRAPPER_GLOBAL_ATTRS-ID',
			    'class' => 'text-left'
		    );


		    $vargs->icon_label_wrapper_tag = false;
		    $vargs->icon_label_wrapper_global_attrs = array(
		        'class' => 'VARGS-ICON_SPAN_CLASS' // e.g., some FA class
		    );


		    $vargs->icon_tag = 'i';
		    $vargs->icon_global_attrs = array(
			    'class' => 'fa fa-tags fa-fw' // e.g., some FA class
		    );
		    $vargs->name_tag = 'span';
		    $vargs->name_global_attrs = array(
			    'class' => false // e.g., some FA class
		    );
		    $vargs->link_class = false; // apply to every link
		    $vargs->link_rel = 'tag';
		    $vargs->implode_glue = ', ';

		    return $vargs;
	    }


	    protected function is_archive($arg = ''){

		    $obj_enc = new \stdClass();

		    // an enclosure master switch - default is true
		    $obj_enc->active = false;

		    $obj_enc->semantic_active = true;
		    $obj_enc->semantic_tag = 'nav';
		    $obj_enc->semantic_global_attrs = array(
			    //'class' => 'my semantic class test'
		    );

		    $obj_enc->view_wrapper_active = false;
		    $obj_enc->view_wrapper_tag = 'div';
		    $obj_enc->view_wrapper_global_attrs = array(
			    // 'class' => 'HEADER-CLASS'
		    );

		    $vargs = new \stdClass();
		    $vargs->enclose = $obj_enc;

		    // note: this wrapper is NOT the enclose wrapper. they are independent.
		    $vargs->wrapper_tag = 'p';
		    $vargs->wrapper_global_attrs = array();

		    $vargs->name_tag = 'span';
		    $vargs->name_global_attrs = array();

		    // master on/off for the description
		    $vargs->description_active = true;
		    // if empty (description) === true then continue to render desc_tag + global_attrs
		    // false means that if the description is empty don't do the tag + global_attrs
		    $vargs->description_empty = true;
		    $vargs->description_tag = 'p';
		    $vargs->description_global_attrs = array();

		    return $vargs;




	    }

	    protected function posts_pagination($arg = ''){

		    $obj_enc = new \stdClass();

		    $obj_enc->active = true;            // an enclosure master switch

		    $obj_enc->semantic_active = true;
		    $obj_enc->semantic_tag = 'nav';
		    $obj_enc->semantic_global_attrs = array(
			    'class' => 'container'
		    );

		    $obj_enc->view_wrapper_active = true;
		    $obj_enc->view_wrapper_tag = 'div';
		    $obj_enc->view_wrapper_global_attrs = array(
			    'class' => 'row text-center'
		    );

		    $vargs = new \stdClass();
		    $vargs->enclose = $obj_enc;

		    $vargs->wrapper_tag = 'ul';
		    $vargs->wrapper_global_attrs = array(
			    'class' => 'pagination',
			    'aria-label' => 'Page navigation',
		    );
		    $vargs->page_tag = 'li';
		    $vargs->page_class_current = 'active';

		    $vargs->icon_tag = 'i';
		    $vargs->icon_prev_global_attrs = array(
			    'class' => 'glyphicon glyphicon-chevron-left',
			    'aria-hidden' => "true"
		    );

		    $vargs->icon_next_global_attrs = array(
			    'class' => 'glyphicon glyphicon-chevron-right',
			    'aria-hidden' => "true"
		    );

		    return $vargs;




	    }

    }
}