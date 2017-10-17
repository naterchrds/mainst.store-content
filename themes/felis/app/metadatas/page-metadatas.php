<?php

/**
 * Initialize the Page Metaboxes. See /option-tree/assets/theme-mode/demo-meta-boxes.php for reference
 *
 * @since Cactus Alpha 1.0
 * @package cactus
 */

add_action( 'admin_init', 'felis_page_MetaBoxes' );

if ( ! function_exists( 'felis_page_MetaBoxes' ) ) {
	function felis_page_MetaBoxes() {

		$page_meta_boxes = array(
			'id'       => 'page_meta_box',
			'title'    => esc_html__('Page Settings', 'felis'),
			'desc'     => '',
			'pages'    => array('page'),
			'context'  => 'normal',
			'priority' => 'high',
			'fields'   => array(

				/*
				 * Page Layout Tab
				 * */
				array(
					'label' => esc_html__('Page Layout', 'felis'),
					'id'    => 'page_layout_tab',
					'type'  => 'tab'
					),

				array(
					'id'      => 'logo_image',
					'label'   => esc_html__( 'Page Logo Image', 'felis' ),
					'desc'    => esc_html__( 'Upload your logo image of your page', 'felis' ),
					'std'     => '',
					'type'    => 'upload',
				),

				array(
					'id'      => 'page_layout',
					'label'   => esc_html__('Body Container', 'felis'),
					'desc'    => esc_html__('Select "Default" to use settings in Theme Options', 'felis'),
					'std'     => 'default',
					'type'    => 'radio-image',
					'class'   => '',
					'choices' => array(
						array(
							'value' => 'default',
							'label' => esc_html__('Default', 'felis'),
							'src'   => get_parent_theme_file_uri('/images/options/default.jpg'),
							),
						array(
							'value' => 'full_width',
							'label' => esc_html__('Full-Width', 'felis'),
							'src'   => get_parent_theme_file_uri('/images/options/body/full-width.jpg'),
							),
						array(
							'value' => 'container',
							'label' => esc_html__('Container', 'felis'),
							'src'   => get_parent_theme_file_uri('/images/options/body/container.jpg'),
							),
						array(
							'value' => 'boxed',
							'label' => esc_html__('Boxed', 'felis'),
							'src'   => get_parent_theme_file_uri('/images/options/body/boxed.jpg'),
							)
						)
					),

					array(
						'id'      => 'page_sidebar',
						'label'   => esc_html__('Page Sidebar', 'felis'),
						'desc'    => esc_html__('Choose Sidebar Layout for Page', 'felis'),
						'std'     => 'default',
						'type'    => 'radio-image',
						'class'   => '',
						'choices' => array(
							array(
								'value' => 'default',
								'label' => esc_html__('Default', 'felis'),
								'src'   => get_parent_theme_file_uri('/images/options/default.jpg'),
								),
							array(
								'value' => 'left',
								'label' => esc_html__('Left', 'felis'),
								'src'   => get_parent_theme_file_uri('/images/options/sidebar/sidebar-left.jpg'),
								),
							array(
								'value' => 'right',
								'label' => esc_html__('Right', 'felis'),
								'src'   => get_parent_theme_file_uri('/images/options/sidebar/sidebar-right.jpg'),                            ),
							array(
								'value' => 'full',
								'label' => esc_html__('Hidden', 'felis'),
								'src'   => get_parent_theme_file_uri('/images/options/sidebar/sidebar-hidden.jpg'),
								)
							)
						),

					array(
						'id'           => 'social_left',
						'label'        => esc_html__('Social Left Panel', 'felis'),
						'desc'         => esc_html__('Enable Social Panel on the Left', 'felis'),
						'std'          => 'on',
						'type'         => 'on-off',
						),

					array(
						'id'      => 'social_position',
						'label'   => esc_html__( 'Social Position', 'felis' ),
						'desc'    => esc_html__( 'Choose Social Left Position', 'felis' ),
						'std'     => 'dark',
						'type'    => 'select',
						'condition' => 'social_left:is(on)',
						'choices' => array(
							array(
								'value' => 'fixed',
								'label' => esc_html__( 'Fixed', 'felis' ),
								),
							array(
								'value' => 'absolute',
								'label' => esc_html__( 'Absolute', 'felis' ),
								)
							),
						),

					array(
						'id'      => 'social_text_schema',
						'label'   => esc_html__( 'Social Text Schema', 'felis' ),
						'desc'    => esc_html__( 'Choose Text Color Schema', 'felis' ),
						'std'     => 'dark',
						'type'    => 'select',
						'condition' => 'social_left:is(on)',
						'choices' => array(
							array(
								'value' => 'dark',
								'label' => esc_html__( 'Dark', 'felis' )
								),
							array(
								'value' => 'light',
								'label' => esc_html__( 'Light', 'felis' )
								)
							),
						),


					array(
						'id'    => 'page_gutter',
						'label' => esc_html__('Gutter', 'felis'),
						'desc'  => esc_html__('Turn off Page Gutter, which is the padding left & right 15px. It will help to build really full-width page', 'felis'),
						'std'   => 'on',
						'type'  => 'on-off'
						),

					array(
						'id'           => 'background',
						'label'        => esc_html__('Page Background', 'felis'),
						'desc'         => esc_html__('Set Page Background', 'felis'),
						'std'          => '',
						'type'         => 'background'
						),

					array(
						'id'    => 'page_padding',
						'label' => esc_html__('Page Padding', 'felis'),
						'desc'  => esc_html__('Turn off Page Padding. Default "80px 0"', 'felis'),
						'std'   => 'on',
						'type'  => 'on-off',
						),



					/*
					 * Page Header Tab
					 * */
					array(
						'label' => esc_html__('Header Settings', 'felis'),
						'id'    => 'page_header_tab',
						'type'  => 'tab'
						),
					
					array(
						'id'      => 'header_style',
						'label'   => esc_html__('Header Layout', 'felis'),
						'desc'    => esc_html__('Select "Default" to use settings in Theme Options', 'felis'),
						'std'     => '',
						'type'    => 'radio-image',
						'choices' => array(
							array(
								'value' => '',
								'label' => esc_html__('Default', 'felis'),
								'src'   => get_parent_theme_file_uri('/images/options/default.jpg'),
								),
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
							)
						),

					array(
						'id'      => 'header_icon_color',
						'label'   => esc_html__('Header Icon Color', 'felis'),
						'desc'    => 'Choose type of Header Content',
						'std'     => 'default',
						'type'    => 'select',
						'condition' => 'header_style:is(2)',
						'choices' => array(
							array(
								'value' => '',
								'label' => esc_html__('Light', 'felis'),
								'src'   => ''
								),
							array(
								'value' => 'dark',
								'label' => esc_html__('Dark', 'felis'),
								'src'   => ''
								),
	
						),
					),
					
					
					

					array(
						'id'      => 'page_header_type',
						'label'   => esc_html__('Header Type', 'felis'),
						'desc'    => 'Choose type of Header Content',
						'std'     => 'default',
						'type'    => 'select',
						'choices' => array(
							array(
								'value' => 'default',
								'label' => esc_html__('Use Global Setting', 'felis'),
								'src'   => ''
								),
							array(
								'value' => 'custom_content',
								'label' => esc_html__('Custom Content', 'felis'),
								'src'   => ''
								),
							array(
								'value' => 'custom_slider',
								'label' => esc_html__('Custom Slider', 'felis'),
								'src'   => ''
								),
							array(
								'value' => 'hidden',
								'label' => esc_html__('Hidden', 'felis'),
								'src'   => ''
								),
							)
						),

					array(
						'id'    => 'breadcrumb',
						'label' => esc_html__( 'Breadcrumb', 'felis' ),
						'desc'  => esc_html__( 'You can disable Breadcrumb for this page using this option', 'felis' ),
						'std'   => 'on',
						'type'  => 'on-off',
						'condition' => 'page_header_type:not(hidden),page_header_type:not(custom_slider)',
						),

					array(
						'id'    => 'page_subtitle',
						'label' => esc_html__( 'Page Heading Subtitle', 'felis' ),
						'desc'  => esc_html__( 'You can add a subtitle to header section of this page using this option.', 'felis' ),
						'type'  => 'text',
						'condition' => 'page_header_type:not(hidden),page_header_type:not(custom_slider)',
						),
					
					array(
						'id'    => 'header_mask',
						'label' => esc_html__('Header Background - Color Mask', 'felis'),
						'desc'  => esc_html__('Turn on/off the Color Mask on Header', 'felis'),
						'std'   => 'on',
						'type'  => 'on-off',
						'condition' => 'page_header_type:is(custom_content), page_header_type:is(custom_slider)'
						),

					array(
						'id'    => 'page_header_content',
						'label' => esc_html__('Custom Content', 'felis'),
						'desc'  => esc_html__('Custom Content for Page Header. Use Slider Shortcode here if choose "Custom Slider"', 'felis'),
						'std'   => '',
						'type'  => 'textarea',
						'condition' => 'page_header_type:is(custom_slider)'
						),

					array(
						'id'    => 'page_header_background',
						'label' => esc_html__('Page Header Background', 'felis'),
						'desc'  => esc_html__('Upload Image to use as Header Background', 'felis'),
						'std'   => '',
						'type'  => 'background',
						'condition' => 'page_header_type:is(custom_content)'
						),
					array(
						'id'    => 'page_header_background_parallax',
						'label' => esc_html__('Page Header Background Parallax', 'felis'),
						'desc'  => esc_html__('Enable Parallax Effect for Header Background. Turn it off if you see trouble with content inside Page Header. When turning on Parallax effect, some properties including background-attachment, background-position and background-size will not work', 'felis'),
						'std'   => 'on',
						'type'  => 'on-off',
						'condition' => 'page_header_type:is(custom_content)'
						),
					

					array(
						'label' => esc_html__('Footer Settings', 'felis'),
						'id'    => 'page_footer_tab',
						'type'  => 'tab'
						),

					
					
					array(
						'id'           => 'footer_background',
						'label'        => esc_html__('Footer Background', 'felis'),
						'desc'         => esc_html__('Set custom Background for Footer, only appeared when Container Layout is chosen', 'felis'),
						'std'          => '',
						'type'         => 'background',
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
					)
				);


		if ( function_exists( 'ot_register_meta_box' ) ){
			ot_register_meta_box( $page_meta_boxes );
		}
	}
}

/**
 * Return names of meta fields which may contain shortcodes, so they can be parsed in CT Shortcodes plugin to generate custom CSS
 **/
add_filter( 'ct_shortcodes_parse_shortcode_custom_css_in_metas', 'felis_meta_fields_contain_shortcodes' );
function felis_meta_fields_contain_shortcodes( $metas ){
	$metas = array_merge( $metas, array( 'page_header_content' ) );
	return $metas;
}
