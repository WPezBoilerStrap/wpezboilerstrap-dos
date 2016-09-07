<?php

namespace WPezTheme;

if ( ! class_exists('Viewargs_AU_BS3_V1')){
    class Viewargs_AU_BS3_V1 extends \WPezBoilerStrap\Toolbox\Parents\Viewargs{

    	public function ez__construct() {
		    // TODO: Implement ez__construct() method.
	    }


	    protected function index(){

		    $va = new \stdClass();
		    //	$va->language_attributes = TODO;
		    $va->html_class = 'no-js';
		    $va->viewport_content = 'width=device-width, initial-scale=1.0';
		    $va->html5shiv = 'https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js';
		    $va->respondjs = 'https://oss.maxcdn.com/respond/1.4.2/respond.min.js';
		    $va->body_class = '';

		    return $va;
	    }

	    protected function header() {

            $obj = new \stdClass();
            $obj->wrap_id = 'nav-main-header';
            $obj->wrap_class = 'header';

            return $obj;
        }


        protected function header_nav_bs3(){

            $obj = new \stdClass();

            $obj->wrap_id = 'nav-main';
            $obj->wrap_class = 'navbar navbar-default';
            $obj->wrap_role = 'navigation';
            $obj->inner_class = 'container';
            $obj->header_class = 'navbar-header';
            $obj->data_target = '.navbar-collapse';
	        $obj->brand_class = 'navbar-brand';

            return $obj;
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

	        $vargs->ul_class = 'pager';

	        $vargs->prev_li_class = 'previous';
	        $vargs->prev_span_class = 'none'; // e.g., some font awesome class
			$vargs->prev_icon = '&larr;';

			$vargs->next_li_class = 'next';
			$vargs->next_span_class = 'none'; // e.g., some font awesome class
			$vargs->next_icon = '&rarr;';

			return $vargs;



        }

    }
}