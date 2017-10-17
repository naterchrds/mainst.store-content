<?php

    /**
     * Initialize the Post Metaboxes. See /option-tree/assets/theme-mode/demo-meta-boxes.php for reference
     *
     * @since Cactus Alpha 1.0
     * @package cactus
     */

    add_action('admin_init', 'felis_post_MetaBoxes');

    if ( ! function_exists('felis_post_MetaBoxes')) {
        function felis_post_MetaBoxes() {
            $post_meta_boxes = array(
                'id'       => 'post_meta_box',
                'title'    => esc_html__('Settings', 'felis'),
                'desc'     => '',
                'pages'    => apply_filters('felis_post_types_for_metabox', array('post')),
                'context'  => 'normal',
                'priority' => 'high',
                'fields'   => array(
					array(
                        'label' => esc_html__('Metadata', 'felis'),
                        'id'    => 'post_metadata_tab',
                        'type'  => 'tab'
                    ),
					array(
                        'id'        => 'post_sub_title',
                        'label'     => esc_html__('Sub Title', 'felis'),
                        'desc'      => esc_html__('An additional title for the post', 'felis'),
                        'std'       => '',
                        'type'      => 'text',
                    ),
                 
                )
            );

            if ( class_exists( 'CT_Plugin_Shortcode' ) && class_exists( 'Vc_Manager' ) ) {
                $post_meta_boxes['fields'][] = array(
                        'id'        => 'video_url',
                        'label'     => esc_html__('Video Url', 'felis'),
                        'desc'      => esc_html__('Enter Video Url. This \'s only use for Felis Content Slider 2 shortcode and Felis Content Grid shortcode', 'felis'),
                        'std'       => '',
                        'type'      => 'text',
                    );
            }

            if( function_exists( 'ot_register_meta_box' ) ){
                ot_register_meta_box($post_meta_boxes);
            }

        }
    }

