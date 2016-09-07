<?php

namespace WPezTheme\Scaffolding;


if ( !class_exists( 'Images' ) ) {
    class Images
    {

        public function __construct(){
        }

        public function get($str = 'args'){

            if ($str == 'args'){
                return $this->args();
            }
            return array();
        }


        protected function args()
        {

            $arr = array();

            /**
             * you can do it this way
             *
             * = w100
             */
            $obj = new \stdClass();
            // mc = names_choose
            $obj_nc = new \stdClass();
            // picture_fill
            $obj_pf = new \stdClass();

            $obj->active = true;                    // on / off switch for this key's args. false tells the loader to ignore it
            $obj->name = 'w100';                    // name, as used for add_image_size() name arg
            $obj->width = 100;                      // width (int), or false
            $obj->height = false;                   // height (int), or false
            $obj->crop = true;                      // bool, as used for add_image_size()'s crop arg
            $obj->ratio = 'square';                 // The ezWay - define the height and ratio and ez takes care of the rest
            $obj->orientation = 'land';             // orientation: 'port' or 'land'
            $obj->offset = 0;                       // - / + (float). a fudge factor if you will. offset only applies when width is used as the baseline (off which the height is calculated)

            // nc = names_choose - in the admin media manager
            $obj_nc->active = true;                 // on or off?
            $obj_nc->select = 'Ratio: Square';      // text in the select
            $obj->names_choose = $obj_nc;

            // pf = picturefill - another ez offering.
            $obj_pf->active = true;                 // on of off
            $obj_pf->w = 'w';                       // what's the 'w' (width) "breakpoint". for more details see Class_WP_ezClasses_Templates_Picturefill_js
            $obj_pf->exclude_from_sizes = array();  // a list of sizes[] keys that this should be excluded from.
            $obj->picturefill = $obj_pf;

            $arr['w100'] = $obj;        // note: the key can be whatever you want. it's not used as a setting / parm / args. it's just a key.


            /**
             * or you can do it with the add image size helper method
             *
             * = w970
             */
            $arr['w600'] = \WPezCore::ez_ais_obj(
                true,
                'w600',
                600,
                false,
                true,
                'photo',
                'land',
                0,
                false,
                true,
                'Ratio: Photo',
                true,
                'w',
                array() );

            /**
             * = w750
             */
            $obj = new \stdClass();
            // mc = names_choose
            $obj_nc = new \stdClass();
            // picture_fill
            $obj_pf = new \stdClass();

            $obj->active = true;
            $obj->name = 'w750';
            $obj->width = 750;
            $obj->height = false;
            $obj->crop = true;
            $obj->ratio = 'photo';
            $obj->orientation = 'land';
            $obj->offset = 0;

            // nc = names_choose - in the admin media manager
            $obj_nc->active = true;
            $obj_nc->select = 'Ratio: Photo';
            $obj->names_choose = $obj_nc;

            // pf = picturefill - another ez offering.
            $obj_pf->active = true;
            $obj_pf->w = 768;
            $obj_pf->exclude_from_sizes = array();
            $obj->picturefill = $obj_pf;

            $arr['w750'] = $obj;

            /**
             * = w970
             */
            $obj = new \stdClass();
            // mc = names_choose
            $obj_nc = new \stdClass();
            // picture_fill
            $obj_pf = new \stdClass();

            $obj->active = true;
            $obj->name = 'w970';
            $obj->width = 970;
            $obj->height = false;
            $obj->crop = true;
            $obj->ratio = 'photo';
            $obj->orientation = 'land';
            $obj->offset = 0;

            // nc = names_choose - in the admin media manager
            $obj_nc->active = true;
            $obj_nc->select = 'Ratio: Photo';
            $obj->names_choose = $obj_nc;

            // pf = picturefill - another ez offering.
            $obj_pf->active = true;
            $obj_pf->w = 922;
            $obj_pf->exclude_from_sizes = array();
            $obj->picturefill = $obj_pf;

            $arr['w970'] = $obj;


            /**
             * = w1170o  o = offset (example)
             */
            $obj = new \stdClass();
            // mc = names_choose
            $obj_nc = new \stdClass();
            // picture_fill
            $obj_pf = new \stdClass();

            $obj->active = true;
            $obj->name = 'w1170o';
            $obj->width = 1170;
            $obj->height = false;
            $obj->crop = true;
            $obj->ratio = 'photo';
            $obj->orientation = 'land';
            $obj->offset = -3 / 12;           // full width = 1170. this image will be ideal for 9 (of 12) columns.

            // nc = names_choose - in the admin media manager
            $obj_nc->active = true;
            $obj_nc->select = 'Ratio: Photo';
            $obj->names_choose = $obj_nc;

            // pf = picturefill - another ez offering.
            $obj_pf->active = true;
            $obj_pf->w = 1200;
            $obj_pf->exclude_from_sizes = array();
            $obj->picturefill = $obj_pf;

            $arr['w1170o'] = $obj;

            /**
             * = w1170
             */
            $obj = new \stdClass();
            // mc = names_choose
            $obj_nc = new \stdClass();
            // picture_fill
            $obj_pf = new \stdClass();

            $obj->active = true;
            $obj->name = 'w1170';
            $obj->width = 1170;
            $obj->height = false;
            $obj->crop = true;
            $obj->ratio = 'widescreen';             // note: w1170 will fail to load unless widescreen is added to the resize_ratios array
            $obj->orientation = 'land';
            $obj->offset = 0;

            // nc = names_choose - in the admin media manager
            $obj_nc->active = true;
            $obj_nc->select = 'Ratio: Widescreen';
            $obj->names_choose = $obj_nc;

            // pf = picturefill - another ez offering.
            $obj_pf->active = true;
            $obj_pf->w = 1200;
            $obj_pf->exclude_from_sizes = array();
            $obj->picturefill = $obj_pf;

            $arr['w1170'] = $obj;

            /**
             * = w1920
             */
            $obj = new \stdClass();
            // mc = names_choose
            $obj_nc = new \stdClass();
            // picture_fill
            $obj_pf = new \stdClass();

            $obj->active = true;
            $obj->name = 'w1920';
            $obj->width = 1920;
            $obj->height = 1080;
            $obj->crop = true;
            $obj->ratio = 'custom';
            $obj->orientation = 'land';
            $obj->offset = 0;

            // nc = names_choose - in the admin media manager
            $obj_nc->active = true;
            $obj_nc->select = 'Ratio: HD';
            $obj->names_choose = $obj_nc;

            // pf = picturefill - another ez offering.
            $obj_pf->active = true;
            $obj_pf->w = 'w';
            $obj_pf->exclude_from_sizes = array();
            $obj->picturefill = $obj_pf;

            $arr['w1170'] = $obj;


            return $arr;

        }

    }
}