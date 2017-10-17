<?php

$cactus_required_plugins = array(
            array(
                'name'     => 'Option Tree',
                'slug'     => 'option-tree',
                'required' => true
            ),
			
			array(
                'name'     => 'WPBakery Visual Composer',
                'slug'     => 'js_composer',
                'source'  => get_template_directory() . '/app/plugins/packages/js_composer.zip',
                'required' => true,
				'version' => '5.2.1'
            ),

            array(
                'name'     => 'Revolution Slider',
                'slug'     => 'revslider',
                'source'  => get_template_directory() . '/app/plugins/packages/revslider.zip',
                'required' => true,
				'version' => '5.4.5.2'
            ), 
			
			array(
                'name'     => 'Felis Shortcodes',
                'slug'     => 'felis-shortcodes',
				'source'  => get_template_directory() . '/app/plugins/packages/felis-shortcodes.zip',
                'required' => true,
				'version' => '1.0'
            ),

            array(
                'name'     => 'Felis FAQ',
                'slug'     => 'felis-faq',
                'source'  => get_template_directory() . '/app/plugins/packages/felis-faq.zip',
                'required' => true,
				'version' => '1.0'
            ),

             array(
                'name'     => 'Felis Video Presentation',
                'slug'     => 'felis-video-presentation',
                'source'  => get_template_directory() . '/app/plugins/packages/felis-video-presentation.zip',
                'required' => true,
				'version' => '1.0'
            ),

            array(
                'name'     => 'WooCommerce',
                'slug'     => 'woocommerce',
                'required' => true
            ),

            array(
                'name'     => 'Contact Form 7',
                'slug'     => 'contact-form-7',
                'required' => true
            ),
			
        );