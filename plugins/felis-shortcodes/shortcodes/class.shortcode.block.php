<?php

    /**
     * Advanced Shortcode with Design Options
     */
    class CactusShortcode_Block extends CactusShortcode_Element
    {
        public static function extend_params($params)
        {
            if ( ! is_array($params)) {
                return;
            }

            $params = CactusShortcode_Element::extend_params($params);

            return array_merge($params, array(
                    array(
                        "type"        => "checkbox",
                        "heading"     => esc_html__("Container", 'felis'),
                        "param_name"  => "container",
                        'group'       => esc_html__('Design Options', 'felis'),
                        "value"       => '',
                        "description" => esc_html__("Is boxed or full-width block", 'felis'),
                    ),
                    array(
                        "type"        => "textfield",
                        "heading"     => esc_html__("Padding", 'felis'),
                        "param_name"  => "padding",
                        'group'       => esc_html__('Design Options', 'felis'),
                        "value"       => '',
                        "description" => esc_html__("Padding of block. Default is '0px 0px 0px 0px' (TOP RIGHT BOTTOM LEFT)", 'felis'),
                    ),
                    array(
                        "type"        => "textfield",
                        "heading"     => esc_html__("Margin", 'felis'),
                        "param_name"  => "margin",
                        'group'       => esc_html__('Design Options', 'felis'),
                        "value"       => '',
                        "description" => esc_html__("Margin of block. Default is '0px 0px 0px 0px' (TOP RIGHT BOTTOM LEFT)", 'felis'),
                    ),
                    array(
                        "type"        => "checkbox",
                        "heading"     => esc_html__("No Gutter", 'felis'),
                        "param_name"  => "no-gutter",
                        'group'       => esc_html__('Design Options', 'felis'),
                        "value"       => '',
                        "description" => esc_html__("Is having gutter (left & right padding)", 'felis'),
                    ),
                    array(
                        "type"        => "attach_image",
                        "heading"     => esc_html__("Background Image", 'felis'),
                        "param_name"  => "background-image",
                        'group'       => esc_html__('Design Options', 'felis'),
                        "value"       => '',
                        "description" => esc_html__("Background Image", 'felis'),
                    ),
                    array(
                        "type"        => "colorpicker",
                        "heading"     => esc_html__("Background Color", 'felis'),
                        "param_name"  => "background-color",
                        'group'       => esc_html__('Design Options', 'felis'),
                        "value"       => '',
                        "description" => esc_html__("Background Color", 'felis'),
                    ),
                    array(
                        "type"        => "checkbox",
                        "heading"     => esc_html__("Parallax", 'felis'),
                        "param_name"  => "parallax",
                        'group'       => esc_html__('Design Options', 'felis'),
                        "value"       => '',
                        "description" => esc_html__("Enable Parallax Effect for background", 'felis'),
                    )
                )
            );
        }

        function get_open_shortcode_wrapper($atts, $content = '')
        {
            $block_class = '';
            $class       = '';

            $is_parallax = isset($atts['parallax']) && ($atts['parallax'] == 1 || $atts['parallax'] == 'true');

            $styles = array();
            if (isset($atts['padding'])) {
                array_push($styles, 'padding:' . $atts['padding']);
            }

            if (isset($atts['margin'])) {
                array_push($styles, 'margin:' . $atts['margin']);
            }

            $bg_styles = array();
            if (isset($atts['background-color'])) {
                if ($is_parallax) {
                    array_push($styles, 'background-color:' . $atts['background-color']);
                } else {
                    array_push($styles, 'background-color:' . $atts['background-color']);
                }
            }

            if (isset($atts['background-image'])) {
                $bg = $atts['background-image'];
                if (is_numeric($bg)) {
                    $bg = wp_get_attachment_url($bg);
                }

                array_push($styles, 'background-image:url(' . $bg . ')');
                array_push($styles, 'background-size:cover');
                if ($is_parallax) {
                    array_push($styles, 'background-attachment:fixed');
                } 
            }

            if (isset($atts['no-gutter']) && ($atts['no-gutter'] == 1 || $atts['no-gutter'] == 'true')) {
                $block_class .= 'no-gutter';
            }

            $open_html = '';

            $open_html .= '<div class="shortcode-block ' . $block_class . '" ' . ' style="' . implode(';', $styles) . '">';

            if (isset($atts['container']) && ($atts['container'] == 1 || $atts['container'] == 'true')) {
                $open_html .= '<div class="container"><div class="row"><div class="col-xs-12">';
            }

            $open_html .= parent::get_open_shortcode_wrapper($atts);

            return $open_html;

        }

        function get_close_shortcode_wrapper($atts, $content = '')
        {
            $close_html = '';

            $close_html .= parent::get_close_shortcode_wrapper($atts);

            if (isset($atts['container']) && ($atts['container'] == 1 || $atts['container'] == 'true')) {
                $close_html .= '</div></div></div>';
                /** .container **/
            }

            $close_html .= '</div>';
            /** .shortcode-block **/

            return $close_html;
        }
    }