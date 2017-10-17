<?php

global $cactus_shortcodes;

$cactus_shortcodes = array(
	'cactus_shortcode_list' => array(
		'classic_js' => CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/admin/all-shortcodes.js'
	),
	
	'cactus_typo' => array(
		'path' => 'shortcodes/typo.php',
		'classic_js' => CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/admin/typo.js',
		'class' => 'CactusTypo',
		'tag' => 'felis_typo'
	),

	'cactus_block' => array(
		'path' => 'shortcodes/block.php',
		'classic_js' => CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/admin/block.js',
		'class' => 'CactusBlock',
		'tag' => 'felis_block'
	),

	'cactus_image' => array(
		'path' => 'shortcodes/image.php',
		'classic_js' => CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/admin/image.js',
		'class' => 'CactusShortcode_Image',
		'tag' => 'felis_image'
	),
	
	'cactus_iconboxes' => array(
		'path' => 'shortcodes/icon-box.php',
		'classic_js' => CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/admin/icon-box.js',
		'class' => 'CactusIconBox',
		'tag' => 'felis_iconbox'
	),

	'cactus_info_box' => array(
		'path' => 'shortcodes/info-box.php',
		'classic_js' => CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/admin/info-box.js',
		'class' => 'CactusInfoBox',
		'tag' => 'felis_info_box'
	),

	'cactus_info_box_2' => array(
		'path' => 'shortcodes/info-box-2.php',
		'classic_js' => CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/admin/info-box-2.js',
		'class' => 'CactusInfoBox2',
		'tag' => 'felis_info_box_2'
	),

	'cactus_content_slider' => array(
		'path' => 'shortcodes/content-slider.php',
		'classic_js' => CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/admin/content-slider.js',
		'class' => 'CactusContentSlide',
		'tag' => 'felis_content_slide'
	),

	'cactus_content_slider_2' => array(
		'path' => 'shortcodes/content-slider-2.php',
		'classic_js' => CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/admin/content-slider-2.js',
		'class' => 'CactusContentSlide2',
		'tag' => 'felis_content_slide_2'
	),

	'cactus_content_grid' => array(
		'path' => 'shortcodes/content-grid.php',
		'classic_js' => CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/admin/content-grid.js',
		'class' => 'CactusContentGrid',
		'tag' => 'felis_content_grid'
	),

	'cactus_testimonials' => array(
		'path' => 'shortcodes/testimonials.php',
		'classic_js' => CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/admin/testimonials.js',
		'class' => 'CactusShortcodeTestimonials',
		'tag' => 'felis_testimonials'
	),

	'cactus_woo_product_slider' => array(
		'path' => 'shortcodes/woo-product-slider.php',
		'classic_js' => CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/admin/woo-product-slider.js',
		'class' => 'CactusWooProductSlider',
		'tag' => 'felis_woo_product_slider'
	),

	'cactus_woo_category_slider' => array(
		'path' => 'shortcodes/woo-category-slider.php',
		'classic_js' => CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/admin/woo-category-slider.js',
		'class' => 'CactusWooCategorySlider',
		'tag' => 'felis_woo_category_slider'
	),
);