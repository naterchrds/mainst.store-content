/**
 * Declare list of shortcodes. Id must be the same with each shortcode ID (declared in their related .js file)
 */
var CACTUS_SHORTCODES_LIST = {
	typo: 'Typo',
	image: 'Image',
	block: 'Block',
	iconboxes: 'Iconboxes',
	info_box: 'Info Box',
	info_box_2: 'Info Box 2',
	content_slider: 'Content Slider',
	content_slider_2: 'Content Slider 2',
	content_grid: 'Content Grid',
	woo_product_slider: 'Woo Product Slider',
	woo_category_slider: 'Woo Category Slider',
	testimonials: 'Testimonials',
	

};

/**
 *
 * DO NOT EDIT BELOW THIS LINE ============================================
 *
 */

var cactus_shortcode_createColorPickAction = function () {
	// Taken from core plugins
	var editor = tinymce.activeEditor;

	var colorPickerCallback = editor.settings.color_picker_callback;

	if (colorPickerCallback) {
		return function () {
			var self = this;

			colorPickerCallback.call(
				editor,
				function (value) {
					self.value(value).fire('change');
				},
				self.value()
			);
		};
	}
};

/**
 * Default Effect Options for shortcode.element
 */
var CACTUS_SHORTCODE_EFFECT_OPTIONS = [
	{
		type: 'listbox',
		name: 'aos',
		label: 'Animation Effect',
		values: [
			{text: 'none', value: 'none'},
			{text: 'fade', value: 'fade'},
			{text: 'fade-up', value: 'fade-up'},
			{text: 'fade-down', value: 'fade-down'},
			{text: 'fade-left', value: 'fade-left'},
			{text: 'fade-right', value: 'fade-right'},
			{text: 'fade-up-right', value: 'fade-up-right'},
			{text: 'fade-up-left', value: 'fade-up-left'},
			{text: 'fade-down-right', value: 'fade-down-right'},
			{text: 'fade-down-left', value: 'fade-down-left'},
			{text: 'flip-up', value: 'flip-up'},
			{text: 'flip-down', value: 'flip-down'},
			{text: 'flip-left', value: 'flip-left'},
			{text: 'flip-right', value: 'flip-right'},
			{text: 'slide-up', value: 'slide-up'},
			{text: 'slide-left', value: 'slide-left'},
			{text: 'slide-right', value: 'slide-right'},
			{text: 'zoom-in', value: 'zoom-in'},
			{text: 'zoom-in-up', value: 'zoom-in-up'},
			{text: 'zoom-in-down', value: 'zoom-in-down'},
			{text: 'zoom-in-left', value: 'zoom-in-left'},
			{text: 'zoom-in-right', value: 'zoom-in-right'},
			{text: 'zoom-out', value: 'zoom-out'},
			{text: 'zoom-out-up', value: 'zoom-out-up'},
			{text: 'zoom-out-down', value: 'zoom-out-down'},
			{text: 'zoom-out-left', value: 'zoom-out-left'},
			{text: 'zoom-out-right', value: 'zoom-out-right'},
		],
		tooltip: 'Choose come-in effect for this element'
	},
	{
		type: 'textbox',
		name: 'aos_delay',
		label: 'Animation Delay',
		value: "100",
		id: '_aos_delay',
		tooltip: 'Number of milliseconds before showing up'
	},
	{
		type: 'textbox',
		name: 'aos_offset',
		label: 'Animation Offset',
		value: "100",
		id: '_aos_offset',
		tooltip: 'Number of milliseconds of animation duration'
	},
	{
		type: 'textbox',
		name: 'aos_duration',
		label: 'Animation Duration',
		value: "400",
		id: '_aos_duration',
		tooltip: 'Duration of animation, in milliseconds'
	},
	{
		type: 'listbox',
		name: 'aos_easing',
		label: 'Animation Easing',
		values: [
			{text: 'none', value: 'none'},
			{text: 'linear', value: 'linear'},
			{text: 'ease', value: 'ease'},
			{text: 'ease-in', value: 'ease-in'},
			{text: 'ease-out', value: 'ease-out'},
			{text: 'ease-in-out', value: 'ease-in-out'},
			{text: 'ease-in-back', value: 'ease-in-back'},
			{text: 'ease-out-back', value: 'ease-out-back'},
			{text: 'ease-in-out-back', value: 'ease-in-out-back'},
			{text: 'ease-in-sine', value: 'ease-in-sine'},
			{text: 'ease-out-sine', value: 'ease-out-sine'},
			{text: 'ease-in-out-sine', value: 'ease-in-out-sine'},
			{text: 'ease-in-quad', value: 'ease-in-quad'},
			{text: 'ease-out-quad', value: 'ease-out-quad'},
			{text: 'ease-in-out-quad', value: 'ease-in-out-quad'},
			{text: 'ease-in-cubic', value: 'ease-in-cubic'},
			{text: 'ease-out-cubic', value: 'ease-out-cubic'},
			{text: 'ease-in-out-cubic', value: 'ease-in-out-cubic'},
			{text: 'ease-in-quart', value: 'ease-in-quart'},
			{text: 'ease-out-quart', value: 'ease-out-quart'},
			{text: 'ease-in-out-quart', value: 'ease-in-out-quart'},
		],
		tooltip: 'Choose Easing Effect'
	},
	{
		type: 'listbox',
		name: 'aos_once',
		label: 'Animation Loop',
		values: [
			{text: 'Once', value: 'true'},
			{text: 'Infinite', value: 'false'}
			],
		tooltip: 'Only animate once or infinite'
	}
];

/**
 * Default Design Options for shortcode.block
 */
var CACTUS_SHORTCODE_DESIGN_OPTIONS = CACTUS_SHORTCODE_EFFECT_OPTIONS.concat([
	{
		type: 'checkbox',
		name: 'container',
		label: 'Container',
		value: "",
		id: '_container',
		tooltip: 'Wrap the element in a container or not (full-width block)'
	},
	{
		type: 'textbox',
		name: 'padding',
		label: 'Padding',
		value: "",
		id: '_padding',
		tooltip: 'Format: TOP RIGHT BOTTOM LEFT. ex: 0px 0px 0px 0px'
	},
	{
		type: 'textbox',
		name: 'margin',
		label: 'Margin',
		value: "",
		id: '_margin',
		tooltip: 'Format: TOP RIGHT BOTTOM LEFT. ex: 0px 0px 0px 0px'
	},
	{
		type: 'checkbox',
		name: 'gutter',
		label: 'Gutter',
		value: "",
		id: '_gutter',
		tooltip: 'Gutter is the margin between columns'
	},
	{
		type: 'textbox',
		classes: 'colorbox',
		placeholder: '#000000',
		name: 'background_color',
		label: 'Background Color',
		value: "",
		tooltip: 'Hexa color of Background',
		id: '_background_2134234color'
	},
	{
		type: 'textbox',
		name: 'background_image',
		label: 'Background Image',
		value: "",
		id: '_background_image',
		tooltip: 'URL or Attachment ID of background image'
	},
	{
		type: 'checkbox',
		name: 'parallax',
		label: 'Parallax',
		value: "",
		id: '_parallax',
		tooltip: 'Enable Parallax effect for background image'
	},
]);
function cactus_shortcode_get_effect_params(data) {
	var params = '';
	if (data.aos != '') {
		params = ' aos="' + data.aos + '" aos-offset="' + data.aos_offset + '" aos-delay="' + data.aos_delay + '" aos-duration="' + data.aos_duration + '" aos-easing="' + data.aos_easing + '" ' + (data.aos_once == 'false' ? 'aos-once="false"' : '');
	}

	return params;
}

function cactus_shortcode_get_design_params(data) {
	var params = cactus_shortcode_get_effect_params(data);

	if (data.container != 0) {
		params += ' container="1" ';
	}

	if (data.padding != '') {
		params += ' padding="' + data.padding + '" ';
	}

	if (data.margin != '') {
		params += ' margin="' + data.margin + '" ';
	}

	if (data.gutter != 0) {
		params += ' gutter="1" ';
	}

	if (data.parallax != 0) {
		params += ' parallax="1" ';
	}

	if (data.background_image != '') {
		params += ' background-image="' + data.background_image + '" ';
	}

	if (data.background_color != '') {
		params += ' background-color="' + data.background_color + '" ';
	}

	return params;
}

(function () {
	var body = [];


	for (var key in CACTUS_SHORTCODES_LIST) {
		body.push({
			type: 'button',
			name: CACTUS_SHORTCODES_LIST[key],
			text: CACTUS_SHORTCODES_LIST[key],
			label: CACTUS_SHORTCODES_LIST[key],
			id: 'cactus_shortcode_' + key + '_opener'
		});
	}

	tinymce.PluginManager.add('cactus_shortcode_list', function (editor, url) {
		editor.addButton('cactus_shortcode_list', {
			text: '',
			tooltip: 'Shortcode',
			id: 'cactus_shortcode_listshortcode',
			icon: 'icons',
			onclick: function () {
				// Open window
				editor.windowManager.open({
					title: 'Shortcode',
					body: body,
				});

				jQuery('.mce-colorbox').each(function () {
					var $j = jQuery;
					var $this = $j(this);
					$j(this).wpColorPicker({
						change: function (event, ui) {
							$j('.mce-textbox', $this.closest('.wp-picker-container')).css({'background-color': ui.color.toString()});
						}
					});
				});
			}
		});
	});

	jQuery(document).ready(function () {
		for (var key in CACTUS_SHORTCODES_LIST) {
			jQuery(document).on('click', '#cactus_shortcode_' + key + '_opener button', (function (key) {
				return function () {
					jQuery('.mce-foot button').trigger("click");
					jQuery('#cactus_shortcode_' + key + ' button', jQuery(tinymce.activeEditor.container)).trigger("click");

					jQuery('.mce-colorbox').each(function () {
						var $j = jQuery;
						var $this = $j(this);
						$j(this).wpColorPicker({
							change: function (event, ui) {
								$j('.mce-textbox', $this.closest('.wp-picker-container')).css({'background-color': ui.color.toString()});
							}
						});
					});
				};
			})(key));
		}
	});

})();