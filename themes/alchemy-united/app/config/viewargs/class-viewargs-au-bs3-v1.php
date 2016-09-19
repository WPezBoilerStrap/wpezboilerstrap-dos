<?php

namespace WPezTheme;

if ( ! class_exists('Viewargs_AU_BS3_V1')){
    class Viewargs_AU_BS3_V1 extends \WPezBoilerStrap\Toolbox\Parents\Viewargs{

    	public function ez__construct() {
		    // TODO: Implement ez__construct() method.
	    }


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

		    $obj_enc->wrapper_active = true;
		    $obj_enc->wrapper_tag = 'div';
		    $obj_enc->wrapper_global_attrs = array(
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

		    $obj_enc->wrapper_active = false;
		    $obj_enc->wrapper_tag = 'div';
		    $obj_enc->wrapper_global_attrs = array(
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

        protected function page(){

	        $obj = new \stdClass();

	        $obj->semantic     = 'section';
	        $obj->title_wrap   = 'H1'; // e.g., H1
	        $obj->content_wrap = 'div'; // e.g., div

	        return $obj;
        }


        protected function single_term_category(){

	        $vargs = new \stdClass();

	        $vargs->wrapper_tag = 'p'; // e.g. 'p';
	        $vargs->wrapper_global_attrs = array(
		    //    'id' => 'VARGS-WRAPPER_GLOBAL_ATTRS-ID',
		        'class' => 'text-left'
	        );
	        $vargs->icon_span_global_attrs = array(
		        'class' => 'fa fa-flag fa-fw' // e.g., some FA class
	        );
	        $vargs->label_span_global_attrs = array(
		        'class' => false // e.g., some FA class
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
		    $vargs->icon_span_global_attrs = array(
			    'class' => 'fa fa-tags fa-fw' // e.g., some FA class
		    );
		    $vargs->label_span_global_attrs = array(
			    'class' => false // e.g., some FA class
		    );
		    $vargs->link_class = false; // apply to every link
		    $vargs->link_rel = 'tag';
		    $vargs->implode_glue = ', ';

		    return $vargs;
	    }

        protected function single_prev_next(){

	        $vargs = new \stdClass();

	        $vargs->wrapper_tag = 'ul';
	        $vargs->wrapper_global_attrs = array(
		        'class' => 'pager'
	        );

	        $vargs->page_tag = 'li';
	        $vargs->page_prev_global_attrs = array(
		        'class' => 'previous'
	        );

	        $vargs->page_next_global_attrs = array(
		        'class' => 'next'
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

    }
}