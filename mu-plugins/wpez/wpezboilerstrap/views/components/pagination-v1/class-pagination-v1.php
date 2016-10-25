<?php

namespace WPez\WPezBoilerStrap\Views\Components;

if ( ! class_exists('Pagination_V1')) {
	class Pagination_V1 extends \WPez\WPezBoilerStrap\Toolbox\Parents\View {

		protected function view( $lang, $mod, $parts, $vargs ) {
			
			$mac = $this->_mac;

			$str_ret = '';

			$str_ret .= $mac::element_open($vargs->wrapper_tag, $vargs->wrapper_global_attrs );

			$str_temp = '';

			foreach ( $mod->pages as $key => $obj_page ) {

				// TODO - move this to vargs
				$arr_page_global_attrs = array();
				if ( $obj_page->type == 'current' && ! empty($vargs->page_class_current) && $vargs->page_class_current !== false  ){

					$arr_page_global_attrs = array(
						"class" => esc_attr($vargs->page_class_current)
					);
				}

				$str_temp .= $mac::element_open($vargs->page_tag, $arr_page_global_attrs);

				$str_url = esc_url($obj_page->url);
				if ( empty( $str_url )){
					$str_url = '#';
				}
				$str_temp .= '<a href="' . $str_url . '"' . '>';

				$str_anchor = esc_attr($obj_page->anchor);
				if ( $obj_page->type == 'prev' ){

					$str_anchor = $mac::element_open($vargs->icon_tag, $vargs->icon_prev_global_attrs);
					$str_anchor .= $mac::element_close($vargs->icon_tag);
					$str_anchor .= esc_attr($lang->prev);

				} elseif ( $obj_page->type == 'next' ){

					$str_anchor = esc_attr($lang->next);
					$str_anchor .= $mac::element_open($vargs->icon_tag, $vargs->icon_next_global_attrs);
					$str_anchor .= $mac::element_close($vargs->icon_tag);

				}

				$str_temp .= $str_anchor;

				$str_temp .= '</a>';

				$str_temp .= $mac::element_close($vargs->page_tag);

			}

			$str_ret .= $str_temp;

			$str_ret .= $mac::element_close($vargs->wrapper_tag);

			return $str_ret;
		}


		protected function lang_defaults() {

			$lang = new \stdClass();

			$lang->prev = 'Prev';
			$lang->next = 'Next ';

			return $lang;
		}

		
		protected function mod_defaults() {

			$mod = new \stdClass();

			$arr_pages = array();

			$obj_page = new \stdClass();
			$obj_page->url = 'http://MOD-URL-1.com';
			$obj_page->type = 'MOD->TYPE-1';
			$obj_page->anchor = 'MOD->ANCHOR-1';

			$arr_pages[] = $obj_page;

			$obj_page = new \stdClass();
			$obj_page->url = 'http://MOD-URL-2.com';
			$obj_page->type = 'MOD->TYPE-2';
			$obj_page->anchor = 'MOD->ANCHOR-2';

			$arr_pages[] = $obj_page;

			$mod->pages = $arr_pages;

			return $mod;
		}


		protected function parts_defaults() {

			$obj = new \stdClass();

			return $obj;
		}

		protected function vargs_defaults() {

			$vargs = new \stdClass();

			$vargs->wrapper_tag = 'ul';
			$vargs->wrapper_global_attrs = array(
				'class' => 'pagination  pagination-lg'
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