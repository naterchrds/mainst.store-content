<?php

    /**
     * Color Helper
     */

    namespace App\Helpers;

    class Color
    {
        public function __construct()
        {

        }

        /**
         * Convert HEX to RGB
         *
         * @param $hex
         *
         * @return string
         *
         * @since Cactus Alpha 1.0
         * @package cactus
         */
        function hex2rgb($hex)
        {
            $hex = str_replace("#", "", $hex);

            if (strlen($hex) == 3) {
                $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
                $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
                $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
            } else {
                $r = hexdec(substr($hex, 0, 2));
                $g = hexdec(substr($hex, 2, 2));
                $b = hexdec(substr($hex, 4, 2));
            }
            $rgb = array($r, $g, $b);

            return $rgb; //Returns an array with the rgb values
        }

        /**
         * Convert RGB to HEX
         *
         * @param $rgb
         *
         * @return string
         *
         * @since Cactus Alpha 1.0
         * @package cactus
         */
        function rgb2hexa($rgb)
        {
            if (count($rgb) == 3) {
                if ($rgb[0] < 10) {
                    $hex1 = '0' . $rgb[0];
                } else {
                    $hex1 = dechex($rgb[0]);
                }
                if ($rgb[1] < 10) {
                    $hex2 = '0' . $rgb[1];
                } else {
                    $hex2 = dechex($rgb[1]);
                }
                if ($rgb[2] < 10) {
                    $hex3 = '0' . $rgb[2];
                } else {
                    $hex3 = dechex($rgb[2]);
                }

                return $hex1 . $hex2 . $hex3;
            }

            return '000';
        }

        /**
         * Get Gradient Color
         *
         * @param $basic_hexa
         * @param $step_rgb
         *
         * @return mixed
         *
         * @since Cactus Alpha 1.0
         * @package cactus
         */
        function colorGradientGenerator($basic_hexa, $step_rgb)
        {
            $basic_rbg = $this->hex2rgb($basic_hexa);

            $r = $basic_rbg[0] - $step_rgb[0];

            if ($r < 0) {
                $r = 0;
            }

            $g = $basic_rbg[1] - $step_rgb[1];
            if ($g < 0) {
                $g = 0;
            }

            $b = $basic_rbg[2] - $step_rgb[2];
            if ($b < 0) {
                $b = 0;
            }

            return $this->rgb2hexa(array($r, $g, $b));
        }

        /* Add opacity to a Hexa color */
        public static function felis_hex2rgba($hex,$opacity) {
            
            $hex = str_replace("#", "", $hex);

            if(strlen($hex) == 3) {
                $r = hexdec(substr($hex,0,1).substr($hex,0,1));
                $g = hexdec(substr($hex,1,1).substr($hex,1,1));
                $b = hexdec(substr($hex,2,1).substr($hex,2,1));
            } else {
                $r = hexdec(substr($hex,0,2));
                $g = hexdec(substr($hex,2,2));
                $b = hexdec(substr($hex,4,2));
            }
            
            $opacity = $opacity/100;
            
            $rgba = array($r, $g, $b, $opacity);
            
            return implode(",", $rgba); // returns the rgb values separated by commas
        }

    }