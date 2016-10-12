<?php

namespace WPezTheme\Scaffolding;


if ( !class_exists( 'Images_Args' ) ) {
    class Images_Args
    {

        public function __construct(){
        }

        public function get($str = 'args'){

	        if ( method_exists($this, $str ) ) {
		        return $this->$str();
	        }
            return array();
        }


        protected function settings(){

        	$obj = new \stdClass();

	        $obj->jpeg_quality = 90;
	        $obj->featured_image_key = 'w1170_off';

	        return $obj;
        }


        protected function master(){

	        $obj_master = new \stdClass();

	        // simple on/off switch for this set of args. false tells the loader to ignore it
	        $obj_master->active = true;

	        // wp = standard wp args: https://developer.wordpress.org/reference/functions/add_image_size/
	        $obj_master_wp = new \stdClass();
	        // string - required
	        $obj_master_wp->name = 'TODO';
	        // int or false -
	        $obj_master_wp->width = 0;
	        // int or false
	        $obj_master_wp->height = false;
	        // bool or array - see:
	        $obj_master_wp->crop = true;
	        // == the wp object
	        $obj_master->add_image_size = $obj_master_wp;

	        // aspect ratio
	        $obj_master->ratio = 'TODO';
	        // orientation: 'port' or 'land'
	        $obj_master->orientation = 'land';
	        // - / + (float). a fudge factor if you will. offset only applies when width is used as the baseline (off which the height is calculated)
	        $obj_master->offset = 0;
	        $obj_master->featured_image = false;

	        // nc = names_choose e - in the admin media manager
	        $obj_master_nc = new \stdClass();
	        // on or off
	        $obj_master_nc->active = true;
	        // text in the media gallery select (when picking / inserting and image)
	        $obj_master_nc->select = 'TODO';
	        // == the nc object
	        $obj_master->names_choose = $obj_master_nc;

	        // pf = picture_fill - another ez offering.
	        $obj_master_pf = new \stdClass();
	        // on of off
	        $obj_master_pf->active = true;
	        // what's the 'w' (width) "breakpoint". for more details see Class_WP_ezClasses_Templates_Picturefill_js
	        $obj_master_pf->w = 'w';
	        // a list of sizes[] keys that this should be excluded from.
	        $obj_master_pf->exclude_from_sizes = array();
	        // == the pf object
	        $obj_master->picturefill = $obj_master_pf;

	        return $obj_master;
        }


        protected function args()
        {

	        // the object we create will be stored in this array
            $arr = array();

            /**
             * = w100 ==================================
             */
            $obj = $this->master();

	         // this isn't necessary, just convenient to make it obvious
	        $obj->active = true;
	        $obj->add_image_size->name = 'w100';
	        $obj->add_image_size->width = 100;
	        $obj->ratio = 'square';

	        // names_choose - on or off
	        $obj->names_choose->active = true;
	        // text in the media gallery select (when picking / inserting and image)
	        $obj->names_choose->select = 'Ratio: Square';

            $arr['w100'] = $obj;

	        /**
	         * = w600 ==================================
	         */
	        $obj = $this->master();

	        // this isn't necessary, just convenient to make it obvious
	        $obj->active = true;
	        $obj->add_image_size->name = 'w600';
	        $obj->add_image_size->width = 600;
	        $obj->ratio = 'photo';

	        // names_choose - on or off
	        $obj->names_choose->active = true;
	        // text in the media gallery select (when picking / inserting and image)
	        $obj->names_choose->select = 'Ratio: Photo';

	        $arr['w600'] = $obj;

	        /**
	         * = w750 ==================================
	         */
	        $obj = $this->master();

	        // this isn't necessary, just convenient to make it obvious
	        $obj->active = true;
	        $obj->add_image_size->name = 'w750';
	        $obj->add_image_size->width = 750;
	        $obj->ratio = 'photo';

	        // names_choose - on or off
	        $obj->names_choose->active = true;
	        // text in the media gallery select (when picking / inserting and image)
	        $obj->names_choose->select = 'Ratio: Photo';
	        $obj->picturefill->w = 768;

	        $arr['w750'] = $obj;

	        /**
	         * = w970 ==================================
	         */
	        $obj = $this->master();

	        // this isn't necessary, just convenient to make it obvious
	        $obj->active = true;
	        $obj->add_image_size->name = 'w970';
	        $obj->add_image_size->width = 970;
	        $obj->ratio = 'photo';

	        // names_choose - on or off
	        $obj->names_choose->active = true;
	        // text in the media gallery select (when picking / inserting and image)
	        $obj->names_choose->select = 'Ratio: Photo';
	        $obj->picturefill->w = 922;

	        $arr['w970'] = $obj;


	        /**
	         * = w1170off ==================================
	         */
	        $obj = $this->master();

	        // this isn't necessary, just convenient to make it obvious
	        $obj->active = true;
	        $obj->add_image_size->name = 'w1170_off';
	        $obj->add_image_size->width = 1170;

	        $obj->ratio = 'photo';
	        // if full width = 1170. this image will be ideal for width of 9 (of 12) columns.
	        $obj->offset = -3/12;

	        // names_choose - on or off
	        $obj->names_choose->active = true;
	        // text in the media gallery select (when picking / inserting and image)
	        $obj->names_choose->select = 'Ratio: Photo';
	        $obj->picturefill->w = 1200;

	        $arr['w1170_off'] = $obj;

	        /**
	         * = w1170 ==================================
	         */
	        $obj = $this->master();

	        // this isn't necessary, just convenient to make it obvious
	        $obj->active = true;
	        $obj->add_image_size->name = 'w1170';
	        $obj->add_image_size->width = 1170;
	        $obj->ratio = 'widescreen';

	        // names_choose - on or off
	        $obj->names_choose->active = true;
	        // text in the media gallery select (when picking / inserting and image)
	        $obj->names_choose->select = 'Ratio: Widescreen';

	        $obj->picturefill->w = 1200;

	        $arr['w1170'] = $obj;

	        /**
	         * = w1170 ==================================
	         */
	        $obj = $this->master();

	        // this isn't necessary, just convenient to make it obvious
	        $obj->active = true;
	        $obj->add_image_size->name = 'w1920';
	        $obj->add_image_size->width = 1920;
	        $obj->add_image_size->height = 1080;
	        // note: hd *is* a ratio in the reference / acpect_ratios. this is mostly to demo the "custom" capability.
	        $obj->ratio = 'custom';
	        // if full width = 1170. this image will be ideal for width of 9 (of 12) columns.

	        // names_choose - on or off
	        $obj->names_choose->active = true;
	        // text in the media gallery select (when picking / inserting and image)
	        $obj->names_choose->select = 'Ratio: HD';

	        $arr['w1920'] = $obj;

	        /**
	         * = The End ==================================
	         */
            return $arr;

        }

    }
}