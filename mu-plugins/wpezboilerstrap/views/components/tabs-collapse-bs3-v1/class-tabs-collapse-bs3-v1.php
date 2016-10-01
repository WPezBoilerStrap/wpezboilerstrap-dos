<?php

namespace WPezBoilerStrap\Views\Components;

if ( ! class_exists( 'Tabs_Collapse_BS3_V1' ) ) {

	class Tabs_Collapse_BS3_V1 extends \WPezBoilerStrap\Toolbox\Parents\View {

		protected function view( $lang, $mod, $parts, $vargs ) {

			$str_nav_tabs = '';
			$str_tab_panes = '';
			if ( is_array($vargs->tabs)) {
				foreach ( $vargs->tabs as $key => $obj ) {

					// -- TABS --

					// a tab can be active (or not). therefore, the tab_global_attrs can be set at the vargs or row obj level
					$arr_tab_global_attrs = $vargs->tab_global_attrs;
					if ( isset($obj->tab_global_attrs) && ! empty($obj->tab_global_attrs) && is_array($obj->tab_global_attrs)){
						$arr_tab_global_attrs = $obj->tab_global_attrs;
					}

					// tab_tag
					// tab_global_attrs - class = active?
					$str_nav_tabs .= $this->element_open($vargs->tab_tag, $arr_tab_global_attrs);
						// $str_nav_tabs .= $this->element_open( 'div', array( 'class' => " TODO" ) );

					// tab_link_global_attrs
					// Note: This href MUST match the id= of the content_wrap_global_attrs (below)
					$str_nav_tabs .= '<a href="#' . sanitize_html_class( $obj->tab_link_href ).'" ' . $this->global_attrs($vargs->tab_link_global_attrs) .  '>';

					// tab_icon_tag
					// tab_icon_global_attrs
					$str_nav_tabs .= $this->element_open($vargs->tab_icon_tag, $obj->tab_icon_global_attrs);
						//$str_nav_tabs .= '<i class="' . esc_attr( $obj->button_icon_class ) . '"></i>';
					$str_nav_tabs .= $this->element_close($vargs->tab_icon_tag);

					// tab_name_tag
					// tab_name_global_attrs
					$str_nav_tabs .= $this->element_open($vargs->tab_name_tag, $obj->tab_name_global_attrs);
						// $str_nav_tabs .= '<span class="' . esc_attr( $obj->button_Xicon_class ) . '">' . esc_attr( $obj->name ) . '</span>';
					// tab_name
					$str_nav_tabs .= esc_attr( $obj->tab_name );
					$str_nav_tabs .= $this->element_close($vargs->tab_name_tag);

					$str_nav_tabs .= '</a>';
					$str_nav_tabs .= $this->element_close( $vargs->tab_tag );

					// -- PANES --

					// pane_wrap_tag = TODO?
					// pane_wrap_global_attrs
					$str_tab_panes .= '<span id="' . sanitize_html_class( $obj->tab_link_href ) . '"' . $this->global_attrs($vargs->pane_wrap_global_attrs). '>';

					// pane_inner_tag
					// pane_inner_global_attrs
					$str_tab_panes .= $this->element_open($vargs->pane_inner_tag , $vargs->pane_inner_global_attrs);
						// $str_tab_panes .= $this->element_open( 'div', array( 'class' => "well" ) );


					// pane_icon
					$str_tab_panes .= $this->element_open($obj->pane_icon_tag, $obj->pane_icon_global_attrs);
					$str_tab_panes .= $this->element_close($obj->pane_icon_tag);
						// $str_tab_panes .= '<i class="' . esc_attr( $obj->button_icon_class ) . '"></i>';

					// pane_name
					if ( $obj->pane_name_active !== false ) {
						$str_tab_panes .= $this->element_open( $vargs->pane_name_tag, $vargs->pane_name_global_attrs );
						// pane_name
						$str_tab_panes .= esc_attr( $obj->pane_name );
						$str_tab_panes .= $this->element_close( $vargs->pane_name_tag );
					}

					// pane_desc
					if ( $obj->pane_desc_active !== false) {
						$str_tab_panes .= $this->element_open( $vargs->pane_desc_tag, $vargs->pane_desc_global_attrs );
						// pane_name
						$str_tab_panes .= esc_attr( $obj->pane_desc );
						$str_tab_panes .= $this->element_close( $vargs->pane_desc_tag );
					}

					// if mod then mod->$property else if parts then $parts->$property
					$str_content = '';
					if ( isset($obj->pane_source) && ( $obj->pane_source == 'mod' || $obj->pane_source == 'parts') ) {
						$str_prop = $obj->source_property;
						$str_content .= $mod->$str_prop;
						$str_content .= $parts->$str_prop;
					}
					//$prop = $obj->vws;
					$str_tab_panes .= $this->element_open($vargs->pane_content_tag , $vargs->pane_content_global_attrs);
					$str_tab_panes .= $str_content;
					$str_tab_panes .= $this->element_close($vargs->pane_content_tag);

					// pane_desc
					if ( $obj->pane_footnote_active !== false) {
						$str_tab_panes .= $this->element_open($vargs->pane_footnote_tag , $vargs->pane_footnote_global_attrs);
						$str_tab_panes .= esc_attr($obj->pane_footnote);
						$str_tab_panes .= $this->element_close($vargs->pane_footnote_tag);
					}



					// content_wrap_tag
					$str_tab_panes .= $this->element_close( $vargs->pane_inner_tag );
					// tab_wrap_element
					$str_tab_panes .= '</span>';

				}
			}

			$str_ret = '';

			if ( ! empty($str_nav_tabs) && ! empty($str_tab_panes) ) {

				/*
				 * wrapper_class
				 * ??
				 * row_class
				 */

				// tabs_wrap_outer_tag
				// + global_attrs
				$str_ret .= $this->element_open($vargs->tabs_wrapper_outer_tag, $vargs->tabs_wrapper_outer_global_attrs);
				$str_ret .= $this->element_open($vargs->tabs_wrapper_inner_tag,$vargs->tabs_wrapper_inner_global_attrs);
				$str_ret .= $str_nav_tabs;
				$str_ret .= $this->element_close($vargs->tabs_wrapper_inner_tag);
				$str_ret .= $this->element_close($vargs->tabs_wrapper_outer_tag);


				// tabs_content_wrap_tag
				// tabs_content_wrap_global_attrs
				$str_ret .= $this->element_open($vargs->panes_wrapper_tag, $vargs->panes_wrapper_global_attrs);

				$str_ret .= $str_tab_panes;

				$str_ret .= $this->element_close($vargs->panes_wrapper_tag);
			} else {

				$str_ret .= '<!-- tabs-collapse empty -->';
			}

			return $str_ret;
		}


		protected function lang_defaults() {

			$lang = new \stdClass();

			return $lang;
		}

		protected function mod_defaults() {

			$mod = new \stdClass();

			$mod->share = "Share pane - TODO";
			$mod->cats = "Categories pane - TODO";
			$mod->tags = "Tags pane - TODO";
			return $mod;
		}


		protected function parts_defaults() {

			$parts = new \stdClass();

			$parts->search = "Search pane - TODO";

			return $parts;
		}

		protected function vargs_defaults() {

			//$obj = new \stdClass();

			// $str_method = 'index-body';

			// $obj_vargs = $this->_wpezconfig->get('viewargs');

			// return $obj_vargs->get($str_method);

			//return $obj;

			/*
			$obj_enc = new \stdClass();

			$obj_enc->active = false;            // an enclosure master switch - default is true

			$obj_enc->semantic_active = true;   // default is true
			$obj_enc->semantic_tag = 'tag_TODO';
			$obj_enc->semantic_global_attrs = array(
				'class' => 'my semantic class test'
			);

			$obj_enc->wrapper_active = true;   // default is true
			$obj_enc->wrapper_tag = 'tag_TODO';
			$obj_enc->wrapper_global_attrs = array(
				'class' => 'my wrapper class test'
			);

			*/
			$vargs = new \stdClass();

			// $vargs->enclose = $obj_enc;

			// the wrappers for the tabs and the content / panes
			$vargs->tabs_wrapper_outer_tag = 'div';
			$vargs->tabs_wrapper_outer_global_attrs = array(
				"class" => "row blog-controls"
			);
			$vargs->tabs_wrapper_inner_tag = 'div';
			$vargs->tabs_wrapper_inner_global_attrs = array(
				"class" => "col-sm-5 col-sm-offset-7"
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
			$vargs->pane_icon_tag = 'i';

			$vargs->pane_name_tag = 'span';
			$vargs->pane_name_global_attrs = array();

			$vargs->pane_desc_tag = 'span';
			$vargs->pane_desc_global_attrs = array();

			$vargs->pane_footnote_tag = 'div';
			$vargs->pane_footnote_global_attrs = array();


			// the individual tabs / panes

			$arr = array();

			// SHARE
			$tab = new \stdClass();

			// tab_global_attrs - can be set global but override at each individual row
			$tab->tab_global_attrs = array(
				'class' => " TODO-OBJ"
			);
			$tab->tab_name = 'Share';   // TODO language?
			$tab->tab_link_href = 'au-share';
			$tab->tab_icon_global_attrs = array(
				"class" => 'fa fa-share-alt fa-fw'
			);
			// these are different so you have control
			$tab->pane_icon_global_attrs = array(
				"class" => 'fa fa-share-alt fa-fw'
			);
			// on off swtich for the name
			$tab->pane_name_active = true;
			// duplicated / different so you have control
			$tab->pane_name = 'Share';
			// on off switch for the descrption
			$tab->pane_desc_active = true;
			$tab->pane_desc = " - Ex his ferri tation dolore, nam no invidunt reprimique.";
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
			$tab->pane_icon_global_attrs = array(
				"class" => 'fa fa-flag fa-fw'
			);
			$tab->pane_name_active = true;
			$tab->pane_name = 'Categories';
			$tab->pane_desc_active = false;
			$tab->pane_desc = " - Lorem ipsum dolor sit amet, dictas principes intellegebat ne ius.";
			$tab->pane_source = 'mod';
			$tab->source_property = 'cats';
			$arr[] = $tab;

			// TAGS
			$tab = new \stdClass();
			$tab->tab_name = "Tags";
			$tab->tab_link_href = 'au-tags';
			$tab->tab_icon_global_attrs = array(
				"class" => 'fa fa-tags fa-fw'
			);
			$tab->pane_icon_global_attrs = array(
				"class" => 'fa fa-tags fa-fw'
			);
			$tab->pane_name_active = true;
			$tab->pane_name = 'Tags';
			$tab->pane_desc_active = false;
			$tab->pane_desc = " - In sea meis soleat periculis. Ad mei accommodare comprehensam.";
			$tab->pane_source = 'mod';
			$tab->source_property = 'tags';
			$arr[] = $tab;

			// SEARCH
			$tab = new \stdClass();
			$tab->tab_name = "Search";
			$tab->tab_link_href = 'au-search';
			$tab->tab_icon_global_attrs = array(
				"class" => 'fa fa-search fa-fw'
			);
			$tab->pane_icon_global_attrs = array(
				"class" => 'fa fa-search fa-fw'
			);
			$tab->pane_name_active = true;
			$tab->pane_name = 'Search';
			$tab->pane_desc_active = false;
			$tab->pane_desc = " - Ut sale etiam urbanitas mel. No repudiare patrioque scripserit mea.";
			$tab->pane_source = 'parts';
			$tab->source_property = 'search';
			$arr[] = $tab;

			$vargs->tabs = $arr;

			return $vargs;
		}
	}
}
