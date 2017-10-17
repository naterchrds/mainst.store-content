<?php

/**
 * Initialize the product Metaboxes. See /option-tree/assets/theme-mode/demo-meta-boxes.php for reference
 *
 * @since Cactus Alpha 1.0
 * @package Cactus
 */

add_action('admin_init', 'felis_product_MetaBoxes');

if ( ! function_exists('felis_product_MetaBoxes')) {
    function felis_product_MetaBoxes()
    {
        $product_meta_boxes = array(
            'id'       => 'product_meta_box',
            'title'    => esc_html__('Settings', 'felis'),
            'desc'     => '',
            'pages'    => array('product'),
            'context'  => 'normal',
            'priority' => 'high',
            'fields'   => array(
				array(
                    'id'        => 'product_lookbook',
                    'label'     => esc_html__('Product Lookbook', 'felis'),
                    'std'       => '',
                    'type'      => 'gallery',
                ),
            )
        );

        if( function_exists( 'ot_register_meta_box' ) ){
            ot_register_meta_box($product_meta_boxes);
        }

    }
}

