<?php

	// Prevent direct access to this file
	defined( 'ABSPATH' ) || die( 'Direct access to this file is not allowed.' );

	/**
	 * Custom settings array that will eventually be
	 * passes to the OptionTree Settings API Class.
	 */
	$cactus_theme_options = array(
		'contextual_help' => array(
			'content' => array(
				array(
					'id'      => 'option_types_help',
					'title'   => esc_html__( 'Option Types', 'felis' ),
					'content' => '<p>' . esc_html__( 'Help content goes here!', 'felis' ) . '</p>'
				)
			),
			'sidebar' => '<p>' . esc_html__( 'Sidebar content goes here!', 'felis' ) . '</p>'
		),
		'sections'        => array(
			array(
				'id'    => 'general',
				'title' => '<i class="fa fa-cogs"><!-- --></i>' . esc_html__( 'General', 'felis' ),
			),
			array(
				'id'    => 'custom_colors',
				'title' => '<i class="fa fa-magic"><!-- --></i>' . esc_html__( 'Custom Colors', 'felis' ),
			),
			array(
				'id'    => 'custom_fonts',
				'title' => '<i class="fa fa-magic"><!-- --></i>' . esc_html__( 'Custom Fonts', 'felis' ),
			),
			array(
				'id'    => 'header',
				'title' => '<i class="fa fa-tasks"><!-- --></i>' . esc_html__( 'Header', 'felis' ),
			),
			array(
				'id'    => 'archives',
				'title' => '<i class="fa fa-th-list"><!-- --></i>' . esc_html__( 'Blog', 'felis' ),
			),
			array(
				'id'    => 'single_post',
				'title' => '<i class="fa fa-file-text-o"><!-- --></i>' . esc_html__( 'Single Post', 'felis' ),
			),
			array(
				'id'    => 'single_page',
				'title' => '<i class="fa fa-file"><!-- --></i>' . esc_html__( 'Single Page', 'felis' ),
			),
			array(
				'id'    => 'search',
				'title' => '<i class="fa fa-search"><!-- --></i>' . esc_html__( 'Search', 'felis' ),
			),
			array(
				'id'    => '404',
				'title' => '<i class="fa fa-exclamation-triangle"><!-- --></i>' . esc_html__( '404', 'felis' ),
			),
			array(
				'id'    => 'social_share',
				'title' => '<i class="fa fa-share-square-o"><!-- --></i>' . esc_html__( 'Social Sharing', 'felis' ),
			),
			array(
				'id'    => 'misc',
				'title' => '<i class="fa fa-sliders"><!-- --></i>' . esc_html__( 'Misc', 'felis' ),
			)
		),
		'settings'        => array(

			/*
         * General
         * */
			array(
				'id'      => 'logo_image',
				'label'   => esc_html__( 'Logo Image', 'felis' ),
				'desc'    => esc_html__( 'Upload your logo image', 'felis' ),
				'std'     => '',
				'type'    => 'upload',
				'section' => 'general',
			),
			array(
				'id'      => 'retina_logo_image',
				'label'   => esc_html__( 'Retina Logo (optional)', 'felis' ),
				'desc'    => esc_html__( 'Retina logo should be two time bigger than the custom logo. Retina Logo is optional, use this setting if you want to strictly support retina devices.', 'felis' ),
				'std'     => '',
				'type'    => 'upload',
				'section' => 'general',
			),

			array(
				'id'      => 'copyright',
				'label'   => esc_html__( 'Copyright Text', 'felis' ),
				'desc'    => esc_html__( 'Appear in Footer', 'felis' ),
				'type'    => 'text',
				'section' => 'general'
			),


			/*
         * Layout
         *
		 */
			array(
				'id'      => 'page_layout',
				'label'   => esc_html__( 'Body Container', 'felis' ),
				'desc'    => esc_html__( 'Set container for Body', 'felis' ),
				'std'     => 'container',
				'type'    => 'radio-image',
				'class'   => '',
				'choices' => array(
					array(
						'value' => 'full_width',
						'label' => esc_html__( 'Full-Width', 'felis' ),
						'src'   => get_parent_theme_file_uri( '/images/options/body/full-width.jpg' ),
					),
					array(
						'value' => 'container',
						'label' => esc_html__( 'Container', 'felis' ),
						'src'   => get_parent_theme_file_uri( '/images/options/body/container.jpg' ),
					),
					array(
						'value' => 'boxed',
						'label' => esc_html__( 'Boxed', 'felis' ),
						'src'   => get_parent_theme_file_uri( '/images/options/body/boxed.jpg' ),
					)
				),
				'section' => 'general',
			),

			array(
				'id'      => 'background',
				'label'   => esc_html__( 'Page Background', 'felis' ),
				'desc'    => esc_html__( 'Set Page Background', 'felis' ),
				'type'    => 'background',
				'section' => 'general'
			),


			array(
				'id'      => 'site_custom_colors',
				'label'   => esc_html__( 'Custom Colors', 'felis' ),
				'desc'    => esc_html__( 'Show Custom Colors settings', 'felis' ),
				'std'     => 'off',
				'type'    => 'on-off',
				'section' => 'custom_colors'
			),


			array(
				'id'        => 'link_color',
				'label'     => esc_html__( 'Link - Color', 'felis' ),
				'desc'      => esc_html__( 'Choose Color for Hyper Link', 'felis' ),
				'std'       => '',
				'type'      => 'colorpicker',
				'section'   => 'custom_colors',
				'condition' => 'site_custom_colors:is(on)'
			),

			array(
				'id'        => 'link_hover_color',
				'label'     => esc_html__( 'Link - Hover Color', 'felis' ),
				'desc'      => esc_html__( 'Choose Hover Color for Hyper Link', 'felis' ),
				'std'       => '',
				'type'      => 'colorpicker',
				'section'   => 'custom_colors',
				'condition' => 'site_custom_colors:is(on)'
			),

			array(
				'id'      => 'header_custom_colors',
				'label'   => esc_html__( 'Customize Navigation Colors', 'felis' ),
				'desc'    => esc_html__( 'Change various color settings on Header', 'felis' ),
				'std'     => 'off',
				'type'    => 'on-off',
				'section' => 'custom_colors',
			),


			array(
				'id'        => 'nav_bg',
				'label'     => esc_html__( 'Navigation - Background Color', 'felis' ),
				'desc'      => esc_html__( 'Choose background color for the Navigation', 'felis' ),
				'std'       => '',
				'type'      => 'colorpicker',
				'section'   => 'custom_colors',
				'condition' => 'header_custom_colors:is(on)'
			),

			array(
				'id'        => 'nav_item_color',
				'label'     => esc_html__( 'Navigation - Item Color', 'felis' ),
				'desc'      => esc_html__( 'Choose color for menu items on Navigation', 'felis' ),
				'std'       => '',
				'type'      => 'colorpicker',
				'section'   => 'custom_colors',
				'condition' => 'header_custom_colors:is(on)'
			),

			array(
				'id'        => 'nav_item_hover_color',
				'label'     => esc_html__( 'Navigation - Item Hover Color', 'felis' ),
				'desc'      => esc_html__( 'Choose hover color for menu items on Navigation', 'felis' ),
				'std'       => '',
				'type'      => 'colorpicker',
				'section'   => 'custom_colors',
				'condition' => 'header_custom_colors:is(on)'
			),

			array(
				'id'        => 'nav_item_hover_bg',
				'label'     => esc_html__( 'Navigation - Item Hover Background Color', 'felis' ),
				'desc'      => esc_html__( 'Choose background hover color for menu items on Navigation', 'felis' ),
				'std'       => '',
				'type'      => 'colorpicker',
				'section'   => 'custom_colors',
				'condition' => 'header_custom_colors:is(on)'
			),

			array(
				'id'        => 'nav_item_current_bg',
				'label'     => esc_html__( 'Navigation - Background Color of Current Item', 'felis' ),
				'desc'      => esc_html__( 'Choose background color for current menu item', 'felis' ),
				'std'       => '',
				'type'      => 'colorpicker',
				'section'   => 'custom_colors',
				'condition' => 'header_custom_colors:is(on)'
			),

			array(
				'id'        => 'nav_item_current_color',
				'label'     => esc_html__( 'Navigation - Text Color of Current Item', 'felis' ),
				'desc'      => esc_html__( 'Choose text color for current menu item', 'felis' ),
				'std'       => '',
				'type'      => 'colorpicker',
				'section'   => 'custom_colors',
				'condition' => 'header_custom_colors:is(on)'
			),

			array(
				'id'        => 'nav_sub_bg',
				'label'     => esc_html__( 'Navigation - Background Color For Sub Menu', 'felis' ),
				'desc'      => esc_html__( 'Choose background color for sub menu of Navigation', 'felis' ),
				'std'       => '',
				'type'      => 'colorpicker',
				'section'   => 'custom_colors',
				'condition' => 'header_custom_colors:is(on)'
			),

			array(
				'id'        => 'nav_sub_item_color',
				'label'     => esc_html__( 'Navigation - Sub Menu Item Color', 'felis' ),
				'desc'      => esc_html__( 'Choose color for sub menu item of Navigation', 'felis' ),
				'std'       => '',
				'type'      => 'colorpicker',
				'section'   => 'custom_colors',
				'condition' => 'header_custom_colors:is(on)'
			),

			array(
				'id'        => 'nav_sub_item_hover_color',
				'label'     => esc_html__( 'Navigation - Sub Menu Item Hover Color', 'felis' ),
				'desc'      => esc_html__( 'Choose hover color for sub menu item of Navigation', 'felis' ),
				'std'       => '',
				'type'      => 'colorpicker',
				'section'   => 'custom_colors',
				'condition' => 'header_custom_colors:is(on)'
			),

			array(
				'id'        => 'nav_sub_item_hover_bg',
				'label'     => esc_html__( 'Navigation - Sub Menu Item Hover Background Color', 'felis' ),
				'desc'      => esc_html__( 'Choose hover background color for sub menu item of Navigation', 'felis' ),
				'std'       => '',
				'type'      => 'colorpicker',
				'section'   => 'custom_colors',
				'condition' => 'header_custom_colors:is(on)'
			),

			array(
				'id'      => 'mask_custom_colors',
				'label'   => esc_html__( 'Customize Gradient Color', 'felis' ),
				'desc'    => esc_html__( 'Change various color settings for Default Gradient Color', 'felis' ),
				'std'     => 'off',
				'type'    => 'on-off',
				'section' => 'custom_colors',
			),


			array(
				'id'        => 'gradient_color_start',
				'label'     => esc_html__( 'Gradient Mask - Start Color', 'felis' ),
				'desc'      => esc_html__( 'Choose Start Color for the Gradient Mask. To have an idea, check this: https://uigradients.com', 'felis' ),
				'std'       => '#0e1555',
				'type'      => 'colorpicker',
				'section'   => 'custom_colors',
				'condition' => 'mask_custom_colors:is(on)'
			),
			array(
				'id'        => 'gradient_color_end',
				'label'     => esc_html__( 'Gradient Mask - End Color', 'felis' ),
				'desc'      => esc_html__( 'Choose End Color for the Gradient Mask. To have an idea, check this: https://uigradients.com', 'felis' ),
				'std'       => '#932b77',
				'type'      => 'colorpicker',
				'section'   => 'custom_colors',
				'condition' => 'mask_custom_colors:is(on)'
			),

			array(
				'id'        => 'gradient_color_deg',
				'label'     => esc_html__( 'Gradient Mask - Degree', 'felis' ),
				'desc'      => esc_html__( 'Choose Degree for the Gradient Mask. To have an idea, check this: https://uigradients.com', 'felis' ),
				'std'       => '0',
				'type'      => 'text',
				'section'   => 'custom_colors',
				'condition' => 'mask_custom_colors:is(on)'
			),
			array(
				'id'        => 'gradient_opacity',
				'label'     => esc_html__( 'Gradient Mask - Opacity', 'felis' ),
				'desc'      => esc_html__( 'Set opacity for the Gradient Mask, from 0 to 1', 'felis' ),
				'std'       => '0.9',
				'type'      => 'text',
				'section'   => 'custom_colors',
				'condition' => 'mask_custom_colors:is(on)'
			),



			array(
				'id'      => 'footer_background',
				'label'   => esc_html__( 'Footer Background', 'felis' ),
				'desc'    => esc_html__( 'Set custom Background for Footer', 'felis' ),
				'std'     => '',
				'type'    => 'background',
				'section' => 'custom_colors',
			),

			array(
				'id'        => 'footer_heading_color',
				'label'     => esc_html__( 'Footer - Heading Color', 'felis' ),
				'desc'      => esc_html__( 'Choose color for heading, widget title on footer', 'felis' ),
				'std'       => '',
				'type'      => 'colorpicker',
				'section'   => 'custom_colors',
			),

			array(
				'id'        => 'footer_text_color',
				'label'     => esc_html__( 'Footer - Text Color', 'felis' ),
				'desc'      => esc_html__( 'Choose color for text on footer', 'felis' ),
				'std'       => '',
				'type'      => 'colorpicker',
				'section'   => 'custom_colors',
			),

			array(
				'id'        => 'footer_link_color',
				'label'     => esc_html__( 'Footer - Link Color', 'felis' ),
				'desc'      => esc_html__( 'Choose color for link on footer', 'felis' ),
				'std'       => '',
				'type'      => 'colorpicker',
				'section'   => 'custom_colors',
			),


			array(
				'id'        => 'footer_link_hover_color',
				'label'     => esc_html__( 'Footer - Link Hover Color', 'felis' ),
				'desc'      => esc_html__( 'Choose color for link hover on footer', 'felis' ),
				'std'       => '',
				'type'      => 'colorpicker',
				'section'   => 'custom_colors',
			),
			


			

			/*
         * Typography
         * */
			array(
				'id'       => 'custom_gooogle_font',
				'label'    => esc_html__( 'Custom Google Fonts', 'felis' ),
				'desc'     => esc_html__( 'Load custom Google Fonts to be used in Typography shortcode or your own custom code', 'felis' ),
				'std'      => '',
				'type'     => 'google-fonts',
				'section'  => 'custom_fonts',
				'operator' => 'and'
			),

			array(
				'id'       => 'font_using_custom',
				'label'    => esc_html__( 'Custom Font Settings', 'felis' ),
				'desc'     => esc_html__( 'Customize default Font Settings', 'felis' ),
				'std'      => 'off',
				'type'     => 'on-off',
				'section'  => 'custom_fonts',
				'operator' => 'and',
			),
			array(
				'id'        => 'main_font_on_google',
				'label'     => esc_html__( 'Use Google Font for Main Font', 'felis' ),
				'desc'      => esc_html__( 'If you use Google Font for Main Font Family, turn this on', 'felis' ),
				'std'       => 'on',
				'type'      => 'on-off',
				'section'   => 'custom_fonts',
				'operator'  => 'and',
				'condition' => 'font_using_custom:is(on)'
			),
			array(
				'id'        => 'main_font_google_family',
				'label'     => esc_html__( 'Main Font Family', 'felis' ),
				'desc'      => esc_html__( 'Choose Google Fonts for Main Font', 'felis' ),
				'std'       => '',
				'type'      => 'google-fonts',
				'section'   => 'custom_fonts',
				'operator'  => 'and',
				'condition' => 'font_using_custom:is(on),main_font_on_google:is(on)'
			),
			array(
				'id'        => 'main_font_family',
				'label'     => esc_html__( 'Main Font Family', 'felis' ),
				'desc'      => esc_html__( 'Enter name of font family here', 'felis' ),
				'std'       => '',
				'type'      => 'text',
				'section'   => 'custom_fonts',
				'operator'  => 'and',
				'condition' => 'font_using_custom:is(on),main_font_on_google:is(off)'
			),
			array(
				'id'           => 'main_font_size',
				'label'        => esc_html__( 'Main Font Size', 'felis' ),
				'desc'         => esc_html__( 'Choose Font Size. Default is 14px', 'felis' ),
				'std'          => '14',
				'type'         => 'numeric-slider',
				'min_max_step' => '10,20,1',
				'section'      => 'custom_fonts',
				'operator'     => 'and',
				'condition'    => 'font_using_custom:is(on)'
			),
			array(
				'id'        => 'main_font_weight',
				'label'     => esc_html__( 'Main Font Weight', 'felis' ),
				'desc'      => esc_html__( 'Choose Font Weight.', 'felis' ),
				'std'       => '',
				'type'      => 'select',
				'section'   => 'custom_fonts',
				'choices'   => array(
					array(
						'value' => 'normal',
						'label' => esc_html__( 'Normal', 'felis' ),
						'src'   => ''
					),
					array(
						'value' => 'bold',
						'label' => esc_html__( 'Bold', 'felis' ),
						'src'   => ''
					),
					array(
						'value' => 'bolder',
						'label' => esc_html__( 'Bolder', 'felis' ),
						'src'   => ''
					),
					array(
						'value' => 'initial',
						'label' => esc_html__( 'Initial', 'felis' ),
						'src'   => ''
					),
					array(
						'value' => 'lighter',
						'label' => esc_html__( 'Lighter', 'felis' ),
						'src'   => ''
					),
					array(
						'value' => '100',
						'label' => esc_html__( '100', 'felis' ),
						'src'   => ''
					),
					array(
						'value' => '200',
						'label' => esc_html__( '200', 'felis' ),
						'src'   => ''
					),
					array(
						'value' => '300',
						'label' => esc_html__( '300', 'felis' ),
						'src'   => ''
					),
					array(
						'value' => '400',
						'label' => esc_html__( '400', 'felis' ),
						'src'   => ''
					),
					array(
						'value' => '400',
						'label' => esc_html__( '500', 'felis' ),
						'src'   => ''
					),
					array(
						'value' => '600',
						'label' => esc_html__( '600', 'felis' ),
						'src'   => ''
					),
					array(
						'value' => '700',
						'label' => esc_html__( '700', 'felis' ),
						'src'   => ''
					),
					array(
						'value' => '800',
						'label' => esc_html__( '800', 'felis' ),
						'src'   => ''
					),
					array(
						'value' => '900',
						'label' => esc_html__( '900', 'felis' ),
						'src'   => ''
					),
				),
				'operator'  => 'and',
				'condition' => 'font_using_custom:is(on)'
			),
			array(
				'id'           => 'main_font_line_height',
				'label'        => esc_html__( 'Main Font Line Height', 'felis' ),
				'desc'         => esc_html__( 'Choose Font Line Height. Default is 1.7', 'felis' ),
				'std'          => '1.7',
				'type'         => 'numeric-slider',
				'min_max_step' => '1,3,0.1',
				'section'      => 'custom_fonts',
				'operator'     => 'and',
				'condition'    => 'font_using_custom:is(on)'
			),
			array(
				'id'        => 'heading_font_on_google',
				'label'     => esc_html__( 'Use Google Font for Heading Font', 'felis' ),
				'desc'      => esc_html__( 'If you use Google Font for Heading Font Family, turn this on', 'felis' ),
				'std'       => 'on',
				'type'      => 'on-off',
				'section'   => 'custom_fonts',
				'operator'  => 'and',
				'condition' => 'font_using_custom:is(on)'
			),
			array(
				'id'        => 'heading_font_google_family',
				'label'     => esc_html__( 'Heading Font Family', 'felis' ),
				'desc'      => esc_html__( 'Heading Font is used for all heading tags (ie. H1, H2, H3, H4, H5, H6)', 'felis' ),
				'std'       => '',
				'type'      => 'google-fonts',
				'section'   => 'custom_fonts',
				'operator'  => 'and',
				'condition' => 'font_using_custom:is(on),heading_font_on_google:is(on)'
			),
			array(
				'id'        => 'heading_font_family',
				'label'     => esc_html__( 'Heading Font Family', 'felis' ),
				'desc'      => esc_html__( 'Heading Font is used for all heading tags (ie. H1, H2, H3, H4, H5, H6). Enter name of font family here', 'felis' ),
				'std'       => '',
				'type'      => 'text',
				'section'   => 'custom_fonts',
				'operator'  => 'and',
				'condition' => 'font_using_custom:is(on),heading_font_on_google:is(off)'
			),
			array(
				'id'           => 'heading_font_size_h1',
				'label'        => esc_html__( 'H1 - Font Size', 'felis' ),
				'desc'         => esc_html__( 'Choose font size for H1. Default is 47px', 'felis' ),
				'std'          => '47',
				'section'      => 'custom_fonts',
				'type'         => 'numeric-slider',
				'min_max_step' => '20,80,1',
				'condition'    => 'font_using_custom:is(on)'
			),
			array(
				'id'           => 'h1_line_height',
				'label'        => esc_html__( 'H1 - Line Height', 'felis' ),
				'desc'         => esc_html__( 'Choose Font Line Height.  Default is 1.4', 'felis' ),
				'std'          => '1.4',
				'type'         => 'numeric-slider',
				'min_max_step' => '1,3,0.1',
				'section'      => 'custom_fonts',
				'operator'     => 'and',
				'condition'    => 'font_using_custom:is(on)'
			),

			array(
				'id'           => 'h1_font_weight',
				'label'        => esc_html__( 'H1 - Font Weight', 'felis' ),
				'desc'         => esc_html__( 'Choose Font Weight', 'felis' ),
				'std'          => '900',
				'type'         => 'numeric-slider',
				'min_max_step' => '100,900,100',
				'section'      => 'custom_fonts',
				'operator'     => 'and',
				'condition'    => 'font_using_custom:is(on)'
			),

			array(
				'id'           => 'heading_font_size_h2',
				'label'        => esc_html__( 'H2 - Font Size', 'felis' ),
				'desc'         => esc_html__( 'Choose font size for H2. Default is 35px', 'felis' ),
				'std'          => '35',
				'section'      => 'custom_fonts',
				'type'         => 'numeric-slider',
				'min_max_step' => '20,80,1',
				'condition'    => 'font_using_custom:is(on)'
			),

			array(
				'id'           => 'h2_line_height',
				'label'        => esc_html__( 'H2 - Line Height', 'felis' ),
				'desc'         => esc_html__( 'Choose Font Line Height.  Default is 1.4', 'felis' ),
				'std'          => '1.4',
				'type'         => 'numeric-slider',
				'min_max_step' => '1,3,0.1',
				'section'      => 'custom_fonts',
				'operator'     => 'and',
				'condition'    => 'font_using_custom:is(on)'
			),

			array(
				'id'           => 'h2_font_weight',
				'label'        => esc_html__( 'H2 - Font Weight', 'felis' ),
				'desc'         => esc_html__( 'Choose Font Weight', 'felis' ),
				'std'          => '900',
				'type'         => 'numeric-slider',
				'min_max_step' => '100,900,100',
				'section'      => 'custom_fonts',
				'operator'     => 'and',
				'condition'    => 'font_using_custom:is(on)'
			),

			array(
				'id'           => 'heading_font_size_h3',
				'label'        => esc_html__( 'H3 - Font Size', 'felis' ),
				'desc'         => esc_html__( 'Choose font size for H3. Default is 24px', 'felis' ),
				'std'          => '24',
				'section'      => 'custom_fonts',
				'type'         => 'numeric-slider',
				'min_max_step' => '10,60,1',
				'condition'    => 'font_using_custom:is(on)'
			),

			array(
				'id'           => 'h3_line_height',
				'label'        => esc_html__( 'H3 - Line Height', 'felis' ),
				'desc'         => esc_html__( 'Choose Font Line Height.  Default is 1.4', 'felis' ),
				'std'          => '1.4',
				'type'         => 'numeric-slider',
				'min_max_step' => '1,3,0.1',
				'section'      => 'custom_fonts',
				'operator'     => 'and',
				'condition'    => 'font_using_custom:is(on)'
			),

			array(
				'id'           => 'h3_font_weight',
				'label'        => esc_html__( 'H3 - Font Weight', 'felis' ),
				'desc'         => esc_html__( 'Choose Font Weight', 'felis' ),
				'std'          => '900',
				'type'         => 'numeric-slider',
				'min_max_step' => '100,900,100',
				'section'      => 'custom_fonts',
				'operator'     => 'and',
				'condition'    => 'font_using_custom:is(on)'
			),

			array(
				'id'           => 'heading_font_size_h4',
				'label'        => esc_html__( 'H4 - Font Size', 'felis' ),
				'desc'         => esc_html__( 'Choose font size for H4. Default is 18px', 'felis' ),
				'std'          => '18',
				'section'      => 'custom_fonts',
				'type'         => 'numeric-slider',
				'min_max_step' => '10,40,1',
				'condition'    => 'font_using_custom:is(on)'
			),

			array(
				'id'           => 'h4_line_height',
				'label'        => esc_html__( 'H4 - Line Height', 'felis' ),
				'desc'         => esc_html__( 'Choose Font Line Height.  Default is 1.4', 'felis' ),
				'std'          => '1.4',
				'type'         => 'numeric-slider',
				'min_max_step' => '1,3,0.1',
				'section'      => 'custom_fonts',
				'operator'     => 'and',
				'condition'    => 'font_using_custom:is(on)'
			),

			array(
				'id'           => 'h4_font_weight',
				'label'        => esc_html__( 'H4 - Font Weight', 'felis' ),
				'desc'         => esc_html__( 'Choose Font Weight', 'felis' ),
				'std'          => '600',
				'type'         => 'numeric-slider',
				'min_max_step' => '100,900,100',
				'section'      => 'custom_fonts',
				'operator'     => 'and',
				'condition'    => 'font_using_custom:is(on)'
			),

			array(
				'id'           => 'heading_font_size_h5',
				'label'        => esc_html__( 'H5 - Font Size', 'felis' ),
				'desc'         => esc_html__( 'Choose font size for H5. Default is 16px', 'felis' ),
				'std'          => '16',
				'section'      => 'custom_fonts',
				'type'         => 'numeric-slider',
				'min_max_step' => '10,30,1',
				'condition'    => 'font_using_custom:is(on)'
			),

			array(
				'id'           => 'h5_line_height',
				'label'        => esc_html__( 'H5 - Line Height', 'felis' ),
				'desc'         => esc_html__( 'Choose Font Line Height.  Default is 1.4', 'felis' ),
				'std'          => '1.4',
				'type'         => 'numeric-slider',
				'min_max_step' => '1,3,0.1',
				'section'      => 'custom_fonts',
				'operator'     => 'and',
				'condition'    => 'font_using_custom:is(on)'
			),

			array(
				'id'           => 'h5_font_weight',
				'label'        => esc_html__( 'H5 - Font Weight', 'felis' ),
				'desc'         => esc_html__( 'Choose Font Weight', 'felis' ),
				'std'          => '600',
				'type'         => 'numeric-slider',
				'min_max_step' => '100,900,100',
				'section'      => 'custom_fonts',
				'operator'     => 'and',
				'condition'    => 'font_using_custom:is(on)'
			),

			array(
				'id'           => 'heading_font_size_h6',
				'label'        => esc_html__( 'H6 - Font Size', 'felis' ),
				'desc'         => esc_html__( 'Choose font size for H6. Default is 14px', 'felis' ),
				'std'          => '14',
				'section'      => 'custom_fonts',
				'type'         => 'numeric-slider',
				'min_max_step' => '10,20,1',
				'condition'    => 'font_using_custom:is(on)'
			),

			array(
				'id'           => 'h6_line_height',
				'label'        => esc_html__( 'H6 - Line Height', 'felis' ),
				'desc'         => esc_html__( 'Choose Font Line Height.  Default is 1.4', 'felis' ),
				'std'          => '1.4',
				'type'         => 'numeric-slider',
				'min_max_step' => '1,3,0.1',
				'section'      => 'custom_fonts',
				'operator'     => 'and',
				'condition'    => 'font_using_custom:is(on)'
			),

			array(
				'id'           => 'h6_font_weight',
				'label'        => esc_html__( 'H6 - Font Weight', 'felis' ),
				'desc'         => esc_html__( 'Choose Font Weight', 'felis' ),
				'std'          => '500',
				'type'         => 'numeric-slider',
				'min_max_step' => '100,900,100',
				'section'      => 'custom_fonts',
				'operator'     => 'and',
				'condition'    => 'font_using_custom:is(on)'
			),

			array(
				'id'        => 'navigation_font_on_google',
				'label'     => esc_html__( 'Use Google Font for Main Navigation', 'felis' ),
				'desc'      => esc_html__( 'If you use Google Font for Main Navigation Items, turn this on', 'felis' ),
				'std'       => 'on',
				'type'      => 'on-off',
				'section'   => 'custom_fonts',
				'operator'  => 'and',
				'condition' => 'font_using_custom:is(on)'
			),
			array(
				'id'        => 'navigation_font_google_family',
				'label'     => esc_html__( 'Main Navigation - Google Font', 'felis' ),
				'desc'      => esc_html__( 'Choose font to be used for Main Navigation Items', 'felis' ),
				'std'       => '',
				'type'      => 'google-fonts',
				'section'   => 'custom_fonts',
				'operator'  => 'and',
				'condition' => 'font_using_custom:is(on),navigation_font_on_google:is(on)'
			),
			array(
				'id'        => 'navigation_font_family',
				'label'     => esc_html__( 'Main Navigation - Font Family', 'felis' ),
				'desc'      => esc_html__( 'Enter name of font family to be used for Main Navigation Items', 'felis' ),
				'std'       => '',
				'type'      => 'text',
				'section'   => 'custom_fonts',
				'operator'  => 'and',
				'condition' => 'font_using_custom:is(on),navigation_font_on_google:is(off)'
			),
			array(
				'id'           => 'navigation_font_size',
				'label'        => esc_html__( 'Main Navigation - Font Size', 'felis' ),
				'desc'         => esc_html__( 'Choose font size for Main Navigation Items. Default is 18px', 'felis' ),
				'std'          => '18',
				'section'      => 'custom_fonts',
				'type'         => 'numeric-slider',
				'min_max_step' => '10,26,1',
				'condition'    => 'font_using_custom:is(on)'
			),

			array(
				'id'           => 'navigation_font_weight',
				'label'        => esc_html__( 'Main Navigation - Font Weight', 'felis' ),
				'desc'         => esc_html__( 'Choose Font Weight', 'felis' ),
				'std'          => '400',
				'type'         => 'numeric-slider',
				'min_max_step' => '100,900,100',
				'section'      => 'custom_fonts',
				'operator'     => 'and',
				'condition'    => 'font_using_custom:is(on)'
			),

			array(
				'id'        => 'custom_font_1',
				'label'     => esc_html__( 'Custom Font 1', 'felis' ),
				'desc'      => esc_html__( 'Upload your own font and enter name "custom_font_1" in "Main Font Family or Special Font Family" setting above. Allow File Types: ttf, eot, otf, woff', 'felis' ),
				'std'       => '',
				'type'      => 'upload',
				'section'   => 'custom_fonts',
				'operator'  => 'and',
				'condition' => 'font_using_custom:is(on)'
			),

			array(
				'id'        => 'custom_font_2',
				'label'     => esc_html__( 'Custom Font 2', 'felis' ),
				'desc'      => esc_html__( 'Upload your own font and enter name "custom_font_2" in "Main Font Family, Heading Font Family or Meta Font Family" setting above. Allow File Types: ttf, eot, otf, woff', 'felis' ),
				'std'       => '',
				'type'      => 'upload',
				'section'   => 'custom_fonts',
				'operator'  => 'and',
				'condition' => 'font_using_custom:is(on)'
			),

			array(
				'id'        => 'custom_font_3',
				'label'     => esc_html__( 'Custom Font 3', 'felis' ),
				'desc'      => esc_html__( 'Upload your own font and enter name "custom_font_3" in "Main Font Family, Heading Font Family or Meta Font Family" setting above. Allow File Types: ttf, eot, otf, woff', 'felis' ),
				'std'       => '',
				'type'      => 'upload',
				'section'   => 'custom_fonts',
				'operator'  => 'and',
				'condition' => 'font_using_custom:is(on)'
			),

			array(
				'id'      => 'header_style',
				'label'   => esc_html__( 'Header Style', 'felis' ),
				'desc'    => esc_html__( 'Choose Header style', 'felis' ),
				'std'     => 1,
				'type'    => 'radio-image',
				'section' => 'header',
				'choices' => array(
					array(
						'value' => '1',
						'label' => esc_html__( 'Style 1', 'felis' ),
						'src'   => get_parent_theme_file_uri( '/images/options/header/header-01.jpg' ),
					),
					array(
						'value' => '2',
						'label' => esc_html__( 'Style 2', 'felis' ),
						'src'   => get_parent_theme_file_uri( '/images/options/header/header-02.jpg' ),
					),
				
				),
			),

			array(
				'id'      => 'nav_sticky',
				'label'   => esc_html__( 'Sticky Menu', 'felis' ),
				'desc'    => esc_html__( 'Enable/ Disable the Sticky Menu', 'felis' ),
				'std'     => 1,
				'type'    => 'select',
				'section' => 'header',
				'choices' => array(
					array(
						'value' => 0,
						'label' => esc_html__( 'Disable', 'felis' ),
						'src'   => ''
					),
					array(
						'value' => 1,
						'label' => esc_html__( 'Always sticky', 'felis' ),
						'src'   => ''
					),
					array(
						'value' => 2,
						'label' => esc_html__( 'When page is scrolled up', 'felis' ),
						'src'   => ''
					)
				),
			),


			array(
				'id'        => 'sticky_background',
				'label'     => esc_html__( 'Background Color for Sticky Nav', 'felis' ),
				'desc'      => esc_html__( 'Choose Background Color', 'felis' ),
				'std'       => '',
				'type'      => 'colorpicker',
				'section'   => 'header',
				'condition' => 'nav_sticky:not(0)'
			),

			array(
				'id'        => 'sticky_logo',
				'label'     => esc_html__( 'Logo Image for Sticky Nav', 'felis' ),
				'desc'      => esc_html__( 'Upload your Logo Image used on Sticky Nav', 'felis' ),
				'std'       => '',
				'type'      => 'upload',
				'section'   => 'header',
				'condition' => 'nav_sticky:not(0)'
			),

			/*
         * Archives
         * */
			array(
				'id'      => 'blog_heading',
				'label'   => esc_html__( 'Blog Heading', 'felis' ),
				'desc'    => esc_html__( 'Set Heading Text for Blog', 'felis' ),
				'std'     => '',
				'type'    => 'text',
				'section' => 'archives'
			),

			array(
				'id'      => 'blog_subtitle',
				'label'   => esc_html__( 'Blog Subtitle', 'felis' ),
				'desc'    => esc_html__( 'Set Subtitle Text for Blog', 'felis' ),
				'std'     => '',
				'type'    => 'text',
				'section' => 'archives'
			),

			array(
				'id'      => 'archive_sidebar',
				'label'   => esc_html__( 'Blog Sidebar', 'felis' ),
				'desc'    => '',
				'std'     => 'hidden',
				'type'    => 'radio-image',
				'section' => 'archives',
				'choices' => array(
					array(
						'value' => 'left',
						'label' => esc_html__( 'Left', 'felis' ),
						'src'   => get_parent_theme_file_uri( '/images/options/sidebar/sidebar-left.jpg' ),
					),
					array(
						'value' => 'right',
						'label' => esc_html__( 'Right', 'felis' ),
						'src'   => get_parent_theme_file_uri( '/images/options/sidebar/sidebar-right.jpg' ),
					),
					array(
						'value' => 'hidden',
						'label' => esc_html__( 'Hidden', 'felis' ),
						'src'   => get_parent_theme_file_uri( '/images/options/sidebar/sidebar-hidden.jpg' ),
					)
				),
			),

			array(
				'id'      => 'custom_excerpt_length',
				'label'   => esc_html__( 'Custom Excerpt Length', 'felis' ),
				'desc'    => esc_html__( 'Enter number of excerpt length to display. Ex: 55.</br>Default of WordPress is 55 words', 'felis' ),
				'std'     => '',
				'type'    => 'text',
				'section' => 'archives',
			),

			array(
				'id'      => 'more_text',
				'label'   => esc_html__( 'Reading More Text', 'felis' ),
				'desc'    => esc_html__( 'Enter text to display after more tag or the post does not have title. Ex: Continue Reading.</br>', 'felis' ),
				'std'     => 'Continue Reading',
				'type'    => 'text',
				'section' => 'archives',
			),

			/*
         * Single Post
         * */
			array(
				'id'      => 'single_sidebar',
				'label'   => esc_html__( 'Sidebar', 'felis' ),
				'desc'    => '',
				'std'     => 'hidden',
				'type'    => 'radio-image',
				'section' => 'single_post',
				'choices' => array(
					array(
						'value' => 'left',
						'label' => esc_html__( 'Left', 'felis' ),
						'src'   => get_parent_theme_file_uri( '/images/options/sidebar/sidebar-left.jpg' ),
					),
					array(
						'value' => 'right',
						'label' => esc_html__( 'Right', 'felis' ),
						'src'   => get_parent_theme_file_uri( '/images/options/sidebar/sidebar-right.jpg' ),
					),
					array(
						'value' => 'hidden',
						'label' => esc_html__( 'Hidden', 'felis' ),
						'src'   => get_parent_theme_file_uri( '/images/options/sidebar/sidebar-hidden.jpg' ),
					)
				),
			),

			array(
				'id'      => 'single_author',
				'label'   => esc_html__( 'Author', 'felis' ),
				'desc'    => esc_html__( 'Enable About Author info', 'felis' ),
				'std'     => 'on',
				'type'    => 'on-off',
				'section' => 'single_post',
			),
			array(
				'id'      => 'single_published_date',
				'label'   => esc_html__( 'Published Date', 'felis' ),
				'desc'    => esc_html__( 'Enable Published Date info', 'felis' ),
				'std'     => 'on',
				'type'    => 'on-off',
				'section' => 'single_post',
			),
			array(
				'id'      => 'single_categories',
				'label'   => esc_html__( 'Categories', 'felis' ),
				'desc'    => esc_html__( 'Show Categories info', 'felis' ),
				'std'     => '',
				'type'    => 'on-off',
				'section' => 'single_post',
			),
			array(
				'id'      => 'single_tags',
				'label'   => esc_html__( 'Tags', 'felis' ),
				'desc'    => esc_html__( 'Show Tags list', 'felis' ),
				'std'     => '',
				'type'    => 'on-off',
				'section' => 'single_post',
			),
			array(
				'id'      => 'show_related_post',
				'label'   => esc_html__( 'Show Related Posts', 'felis' ),
				'desc'    => '',
				'std'     => 'on',
				'type'    => 'on-off',
				'section' => 'single_post',
			),
			array(
				'id'        => 'get_related_post_by',
				'label'     => esc_html__( 'Related Posts By', 'felis' ),
				'desc'      => esc_html__( 'Choose Related posts condition', 'felis' ),
				'std'       => '',
				'type'      => 'select',
				'section'   => 'single_post',
				'condition' => 'show_related_post:is(on)',
				'choices'   => array(
					array(
						'value' => '',
						'label' => esc_html__( 'Tags', 'felis' ),
						'src'   => ''
					),
					array(
						'value' => 'cat',
						'label' => esc_html__( 'Category', 'felis' ),
						'src'   => ''
					)
				)
			),

			/*
         * Single Page
         * */
			array(
				'id'           => 'page_sidebar',
				'label'        => esc_html__( 'Sidebar', 'felis' ),
				'desc'         => '',
				'std'          => 'right',
				'type'         => 'radio-image',
				'section'      => 'single_page',
				'rows'         => '',
				'post_type'    => '',
				'taxonomy'     => '',
				'min_max_step' => '',
				'class'        => '',
				'choices'      => array(
					array(
						'value' => 'left',
						'label' => esc_html__( 'Left', 'felis' ),
						'src'   => get_parent_theme_file_uri( '/images/options/sidebar/sidebar-left.jpg' ),
					),
					array(
						'value' => 'right',
						'label' => esc_html__( 'Right', 'felis' ),
						'src'   => get_parent_theme_file_uri( '/images/options/sidebar/sidebar-right.jpg' ),
					),
					array(
						'value' => 'full',
						'label' => esc_html__( 'Hidden', 'felis' ),
						'src'   => get_parent_theme_file_uri( '/images/options/sidebar/sidebar-hidden.jpg' ),
					)
				),
			),
			//Page Breadcumb
			//Page Comments
			array(
				'id'       => 'page_comments',
				'label'    => esc_html__( 'Enable Comments by default', 'felis' ),
				'desc'     => esc_html__( 'Enable Comment Panel under Single Pages', 'felis' ),
				'std'      => 'on',
				'type'     => 'on-off',
				'section'  => 'single_page',
				'operator' => 'and'
			),
			array(
				'id'       => 'search_exclude_page',
				'label'    => esc_html__( 'Exclude Pages', 'felis' ),
				'desc'     => esc_html__( 'Exclude Pages from Search Results', 'felis' ),
				'std'      => 'off',
				'type'     => 'on-off',
				'section'  => 'search',
				'operator' => 'and'
			),
			/*
         * 404 page
         * */
			array(
				'id'      => 'page404_head_tag',
				'label'   => esc_html__( 'Head Title Tag', 'felis' ),
				'desc'    => esc_html__( 'Content of Title Tag (to be appeared on browser Tab Name)', 'felis' ),
				'std'     => '',
				'type'    => 'text',
				'section' => '404',
			),
			array(
				'id'      => 'page404_featured_image',
				'label'   => esc_html__( 'Page Featured Image', 'felis' ),
				'desc'    => esc_html__( 'Upload your Featured Image into 404 Page', 'felis' ),
				'std'     => '',
				'type'    => 'upload',
				'section' => '404',
			),
			array(
				'id'      => 'page404_title',
				'label'   => esc_html__( 'Page Title', 'felis' ),
				'desc'    => esc_html__( 'Title of the Page', 'felis' ),
				'std'     => '',
				'type'    => 'text',
				'section' => '404',
			),
			array(
				'id'      => 'page404_content',
				'label'   => esc_html__( 'Page Content', 'felis' ),
				'desc'    => esc_html__( 'Content of the Page', 'felis' ),
				'std'     => '',
				'type'    => 'textarea',
				'section' => '404',
				'rows'    => '8',
			),

			/*
         * Misc
         * */
		
			array(
				'id'      => 'echo_meta_tags',
				'label'   => esc_html__( 'SEO - Echo Meta Tags', 'felis' ),
				'desc'    => esc_html__( 'By default, felis generates its own SEO meta tags (for example: Facebook Meta Tags). If you are using another SEO plugin like YOAST or a Facebook plugin, you can turn off this option', 'felis' ),
				'std'     => 'on',
				'type'    => 'on-off',
				'section' => 'misc',
			),

			array(
				'id'       => 'lazyload',
				'label'    => esc_html__( 'Lazyload', 'felis' ),
				'desc'     => esc_html__( 'Enable to use Image Lazyload.', 'felis' ),
				'std'      => 'off',
				'type'     => 'on-off',
				'section'  => 'misc',
				'operator' => 'and'
			),
			
			array(
				'id'           => 'scroll_effect',
				'label'        => esc_html__( 'Enable Smooth Scroll Effect', 'felis' ),
				'desc'         => '',
				'std'          => 'off',
				'type'         => 'on-off',
				'section'      => 'misc',
				'min_max_step' => '',
			),

			array(
				'id'           => 'aos_disable',
				'label'        => esc_html__( 'Mobile Animation', 'felis' ),
				'desc'         => esc_html__( 'Disable Animation on mobile to improve performance', 'felis' ),
				'std'          => 'off',
				'type'         => 'on-off',
				'section'      => 'misc',
				'min_max_step' => '',
			),

			array(
				'id'       => 'loading_fontawesome',
				'label'    => esc_html__( 'Turn On/Off loading FontAwesome', 'felis' ),
				'desc'     => esc_html__( 'If you don\'t use FontAwesome (a Font Icons library), you can turn it off to save bandwidth', 'felis' ),
				'std'      => 'on',
				'type'     => 'on-off',
				'section'  => 'misc',
				'operator' => 'and'
			),

			array(
				'id'       => 'loading_ionicons',
				'label'    => esc_html__( 'Turn On/Off loading Ionicons', 'felis' ),
				'desc'     => esc_html__( 'If you don\'t use Ionicons (a Font Icons library), you can turn it off to save bandwidth', 'felis' ),
				'std'      => 'on',
				'type'     => 'on-off',
				'section'  => 'misc',
				'operator' => 'and'
			),

			array(
				'id'       => 'loading_ct_icons',
				'label'    => esc_html__( 'Turn On/Off loading CT-Icons', 'felis' ),
				'desc'     => esc_html__( 'If you don\'t use CT-Icons (a Font Icons library), you can turn it off to save bandwidth', 'felis' ),
				'std'      => 'on',
				'type'     => 'on-off',
				'section'  => 'misc',
				'operator' => 'and'
			),

			array(
				'id'      => 'custom_css',
				'label'   => esc_html__( 'Custom CSS', 'felis' ),
				'desc'    => esc_html__( 'Enter custom CSS. Ex: <i>.class{ font-size: 13px; }</i>', 'felis' ),
				'std'     => '',
				'type'    => 'css',
				'section' => 'misc',
				'rows'    => '5',
			),
			array(
				'id'       => 'facebook_app_id',
				'label'    => esc_html__( 'Facebook App ID', 'felis' ),
				'desc'     => esc_html__( '(Optional) Enter your Facebook App ID. It is useful when you share your post on Facebook', 'felis' ),
				'std'      => '',
				'type'     => 'text',
				'section'  => 'misc',
				'operator' => 'and'
			),
			
			array(
				'id'      => 'post_edit_link',
				'label'   => esc_html__( 'Enable Post Edit Link', 'felis' ),
				'desc'    => esc_html__( 'Show Post Edit Link from front-end for Editor', 'felis' ),
				'std'     => 'off',
				'type'    => 'on-off',
				'section' => 'misc'
			),

			/*
         * End
         * */
		)
	);

	/* Add settings panel for Thumb Sizes */
	$thumb_sizes = App\config\ThemeConfig::getAllThumbSizes();
	if ( is_array( $thumb_sizes ) ) {
		foreach ( $thumb_sizes as $size => $config ) {
			$custom_settings['settings'][] = array(
				'id'      => $size,
				'label'   => $config[3],
				'desc'    => $config[4],
				'std'     => 'on',
				'type'    => 'on-off',
				'section' => 'misc',
			);
		}
	}
