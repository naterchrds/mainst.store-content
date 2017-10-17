<?php

/**
 * Initialize the video presentation Metaboxes. See /option-tree/assets/theme-mode/demo-meta-boxes.php for reference
 *
 * @since Cactus Alpha 1.0
 * @package Cactus
 */

add_action('admin_init', 'felis_video_MetaBoxes');

if ( ! function_exists('felis_video_MetaBoxes')) {
    function felis_video_MetaBoxes()
    {
        $video_meta_boxes = array(
            'id'       => 'product_meta_box',
            'title'    => esc_html__('Settings', 'felis'),
            'desc'     => '',
            'pages'    => array('ct_video'),
            'context'  => 'normal',
            'priority' => 'high',
            'fields'   => array(
                array(
                    'id'        => 'video_url',
                    'label'     => esc_html__('Video Url', 'felis'),
                    'desc'      => esc_html__('Enter Video Url. This \'s only use for Felis Content Slider 2 shortcode and Felis Content Grid shortcode', 'felis'),
                    'std'       => '',
                    'type'      => 'text',
                ),
            )
        );

        if( function_exists( 'ot_register_meta_box' ) ){
            ot_register_meta_box($video_meta_boxes);
        }

    }
}