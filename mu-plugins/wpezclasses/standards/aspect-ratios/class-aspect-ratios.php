<?php
/*
 * http://en.wikipedia.org/wiki/Aspect_ratio_%28image%29
 *
 * http://www.papersizes.org/a-paper-sizes-tsta.htm
 */

// TODO - use XML?


namespace WPezClasses\Standards;


if ( !class_exists( 'Aspect_Ratios' ) ) {
    class Aspect_Ratios{

        static function get(){

            $arr = array();

            // traditional tv
            $obj = new \stdClass();
            $obj->w = 4;
            $obj->h = 3;
            $arr['tv'] = $obj;
            $arr['4x3'] = $obj;

            // academy standard film aspect ratio
            $obj = new \stdClass();
            $obj->w = 1.375;
            $obj->h = 1;
            $arr['academy'] = $obj;
            $arr['1.375x1'] = $obj;

            // imax
            $obj = new \stdClass();
            $obj->w = 1.43;
            $obj->h = 1;
            $arr['imax'] = $obj;
            $arr['1.43x1'] = $obj;

            // traditional photo
            $obj = new \stdClass();
            $obj->w = 3;
            $obj->h = 2;
            $arr['photo'] = $obj;
            $arr['3x2'] = $obj;

            // letter (paper) = 1:1.2941
            $obj = new \stdClass();
            $obj->w = 11;
            $obj->h = 8.5;
            $arr['letter'] = $obj;
            $arr['11x8.5'] = $obj;

            // legal (paper) = 1:1.6471
            $obj = new \stdClass();
            $obj->w = 14;
            $obj->h = 8.5;
            $arr['legal'] = $obj;
            $arr['14x8.5'] = $obj;

            // junior legal (paper) = 1:1.6000
            $obj = new \stdClass();
            $obj->w = 8;
            $obj->h = 5;
            $arr['jrlegal'] = $obj;
            $arr['8x5'] = $obj;

            // ledger / tabloid (paper) = 1:1.5455
            $obj = new \stdClass();
            $obj->w = 17;
            $obj->h = 11;
            $arr['ledger'] = $obj;
            $arr['tabloid'] = $obj;
            $arr['17x11'] = $obj;

            // a4 (paper)
            $obj = new \stdClass();
            $obj->w = 297;
            $obj->h = 210;
            $arr['a4'] = $obj;
            $arr['297x210'] = $obj;

            // a4 (paper)
            $obj = new \stdClass();
            $obj->w = 297;
            $obj->h = 210;
            $arr['a4'] = $obj;
            $arr['297x210'] = $obj;

            // golden ratio
            $obj = new \stdClass();
            $obj->w = 16.18;
            $obj->h = 10;
            $arr['golden'] = $obj;
            $arr['16.18x10'] = $obj;

            // hd video
            $obj = new \stdClass();
            $obj->w = 16;
            $obj->h = 9;
            $arr['video'] = $obj;
            $arr['16x9'] = $obj;

            // widescreen_cinema
            $obj = new \stdClass();
            $obj->w = 24;
            $obj->h = 10;
            $arr['widescreen'] = $obj;
            $arr['24x10'] = $obj;

            // square
            $obj = new \stdClass();
            $obj->w = 1;
            $obj->h = 1;
            $arr['square'] = $obj;
            $arr['sqr'] = $obj;
            $arr['1x1'] = $obj;

            // 1.5 x 1
            $obj = new \stdClass();
            $obj->w = 1.5;
            $obj->h = 1;
            $arr['1.5x1'] = $obj;

            // 2 x 1
            $obj = new \stdClass();
            $obj->w = 2;
            $obj->h = 1;
            $arr['2x1'] = $obj;

            // 2.5 x 1
            $obj = new \stdClass();
            $obj->w = 2.5;
            $obj->h = 1;
            $arr['2.5x1'] = $obj;

            // 3 x 1
            $obj = new \stdClass();
            $obj->w = 3;
            $obj->h = 1;
            $arr['3x1'] = $obj;

            // 4 x 1
            $obj = new \stdClass();
            $obj->w = 4;
            $obj->h = 1;
            $arr['4x1'] = $obj;

            // 5 x 1
            $obj = new \stdClass();
            $obj->w = 5;
            $obj->h = 1;
            $arr['5x1'] = $obj;

            // 6 x 1
            $obj = new \stdClass();
            $obj->w = 8;
            $obj->h = 1;
            $arr['6x1'] = $obj;

            return $arr;
        }
    }
}