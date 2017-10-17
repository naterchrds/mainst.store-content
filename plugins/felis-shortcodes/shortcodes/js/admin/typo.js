// JavaScript Document
(function () {
	tinymce.PluginManager.add('cactus_typo', function (editor, url) {
		editor.addButton('cactus_typo', {
			text: '',
            id: 'cactus_shortcode_typo',
			tooltip: 'Felis Typo',
			icon: 'icon-typo',
			onclick: function () {
				// Open window
                var body = [
						
						{type: 'textbox', name: 'content', label: 'Content', multiline: true},
						
						{type: 'textbox', name: 'html_tag', label: 'HTML tag ', tooltip: 'tag to wrap the text. Default is div'},
						
						{type: 'textbox', name: 'size', label: 'Font Size', tooltip: 'In Pixel. Example: 14px'},
					
						{
							type: 'listbox', 
							name: 'weight',
							label: 'Font Weight',
							'values': [
								{text: 'Weight', value: ''},
								{text: '100', value: '100'},
								{text: '200', value: '200'},
								{text: '300', value: '300'},
								{text: '400', value: '400'},
								{text: '500', value: '500'},
								{text: '500', value: '500'},
								{text: '600', value: '600'},
								{text: '700', value: '700'},
								{text: '800', value: '800'},
								{text: '900', value: '900'},
								{text: 'Bold', value: 'bold'},
								{text: 'Bolder', value: 'bolder'},
								{text: 'Inherit', value: 'inherit'},
								{text: 'Initial', value: 'initial'},
								{text: 'Lighter', value: 'lighter'},
								{text: 'Normal', value: 'normal'},
							]
						},
					
						{
							type: 'listbox',
							name: 'style',
							label: 'Font Style',
							'values': [
								{text: 'Style', value: ''},
								{text: 'inherit', value: 'inherit'},
								{text: 'initial', value: 'initial'},
								{text: 'italic', value: 'italic'},
								{text: 'normal', value: 'normal'},
								{text: 'oblique', value: 'oblique'},
							]
						},
						
						{type: 'textbox', name: 'spacing', label: 'Letter Spacing', tooltip: 'Letter Spacing value, including suffix. For example: 10px'},
					
						{
							type: 'listbox',
							name: 'color_style',
							label: 'Color Style',
							'values': [
								{text: 'Default', value: 'default'},
								{text: 'Single', value: 'single'},
								{text: 'Gradient', value: 'gradient'},
							]
						},

						{type: 'textbox', classes: 'colorbox', placeholder: '#000000', name: 'single_color', label: 'Single Color', value: "#", id: 'newcolorpicker_typosinglecolor'},
						{type: 'textbox', classes: 'colorbox', placeholder: '#000000', name: 'gradient_from', label: 'Gradient From Color', value: "#", id: 'newcolorpicker_typofromcolor'},
						{type: 'textbox', classes: 'colorbox', placeholder: '#000000', name: 'gradient_to', label: 'Gradient To Color', value: "#", id: 'newcolorpicker_typotocolor'},
					
						{type: 'textbox', name: 'padding', label: 'Padding', value: "", id: 'typo_padding', tooltip: 'Format: TOP RIGHT BOTTOM LEFT. ex: 0px 0px 0px 0px'},
						
						{type: 'textbox', name: 'margin', label: 'Margin', value: "", id: 'typo_margin', tooltip: 'Format: TOP RIGHT BOTTOM LEFT. ex: 0px 0px 0px 0px'},	
						
						{
							type: 'listbox',
							name: 'alignment',
							label: 'Alignment',
							'values': [
								{text: 'Align Left', value: 'left'},
								{text: 'Align Right', value: 'right'},
								{text: 'Align Center', value: 'center'},
							]
						},
					
						{
							type: 'textbox',
							name: 'line_height',
							label: 'Line Height',
							'values': '',
							tooltip: 'Text Line Height. Ex: 1.5em or 24px'
						},
						
						{
							type: 'listbox',
							name: 'border',
							label: 'Border Bottom',
							'values': [
								{text: 'None', value: 'none'},
								{text: 'Solid', value: 'solid'},
								{text: 'Dashed', value: 'dashed'},
								{text: 'Dotted', value: 'dotted'},
								{text: 'Double', value: 'double'},
								{text: 'Groove', value: 'groove'},
								{text: 'Inset', value: 'inset'},
								{text: 'Outset', value: 'outset'},
								{text: 'Ridge', value: 'ridge'},
							],
							tooltip: 'Choose type of border bottom'
						},
						
						{
							type: 'textbox',
							name: 'border_width',
							label: 'Border Width',
							'values': '',
							tooltip: 'Set width of Border Bottom, in pixels. Default is 1px'
						},
						
						{type: 'textbox', name: 'font_family', label: 'Font Family ', tooltip: 'Enter custom Font Family Name for this typo'},
						
						{type: 'textbox', name: 'mobile_size', label: 'Mobile Font Size', tooltip: 'Font Size on mobile screen, in Pixel. Example: 14px'},

	                    {type: 'textbox', name: 'mobile_line_height', label: 'Mobile Line Height', tooltip: 'Line Height on mobile screen, in Pixel. Example: 26px'},
						
						{type: 'textbox', name: 'mobile_padding', label: 'Mobile Padding', tooltip: 'Padding on mobile screen. Format: TOP RIGHT BOTTOM LEFT. ex: 0px 0px 0px 0px'},
						
						{type: 'textbox', name: 'mobile_margin', label: 'Mobile Margin', tooltip: 'Margin on mobile screen. Format: TOP RIGHT BOTTOM LEFT. ex: 0px 0px 0px 0px'},	
						
						{
							type: 'listbox',
							name: 'mobile_alignment',
							label: 'Mobile Alignment',
							'values': [
								{text: 'Default', value: ''},
								{text: 'Align Left', value: 'left'},
								{text: 'Align Right', value: 'right'},
								{text: 'Align Center', value: 'center'},
							]
						},

						{
							type: 'listbox',
							name: 'line_top',
							label: 'Line Top',
							'values': [
								{text: 'Disable', value: '0'},
								{text: 'Enable', value: '1'},
							]
						},
					
					];
                    
				body = body.concat(CACTUS_SHORTCODE_EFFECT_OPTIONS);
				
				editor.windowManager.open({
					title: 'Felis Typo',
					body: body,
					onsubmit: function (e) {
						
						var size = e.data.size;
						var weight = e.data.weight;
						var style = e.data.style;
						var color_style = e.data.color_style;
						var single_color = e.data.single_color;
						var gradient_from = e.data.gradient_from;
						var gradient_to = e.data.gradient_to;
						var padding = e.data.padding;
						var margin = e.data.margin;
						var alignment = e.data.alignment;
						var line_height = e.data.line_height;
						var html_tag = e.data.html_tag;
						var letter_spacing = e.data.spacing;
						var font_family = e.data.font_family;
						var border = e.data.border;
						var border_width = e.data.border_width;
						var mobile_size = e.data.mobile_size;
						var mobile_line_height = e.data.mobile_line_height;
						var mobile_padding = e.data.mobile_padding;
						var mobile_margin = e.data.mobile_margin;
						var mobile_alignment = e.data.mobile_alignment;
						var line_top = e.data.line_top;
						
						if(html_tag === ''){
							html_tag = 'div';
						}
						var content = e.data.content;
						
						editor.insertContent('[felis_typo' + 
												(size != '' ? ' size="' + size + '"' : '') + 
												(weight != '' ? ' weight="' + weight + '"' : '') + 
												(style != '' ? ' style="' + style + '"' : '') + 
												(color_style != '' ? ' color_style="' + color_style + '"' : '') + 
												(single_color != '' && single_color != '#' ? ' single_color="' + single_color + '"' : '') + 
												(gradient_from != '' && gradient_from != '#' ? ' gradient_from="' + gradient_from + '"' : '') + 
												(gradient_to != '' && gradient_to != '#' ? ' gradient_to="' + gradient_to + '"' : '') + 
												(padding != '' ? ' padding="' + padding + '"' : '') + 
												(margin != '' ? ' margin="' + margin + '"' : '') + 
												' alignment="' + alignment + '"' + 
												(line_height != '' ? ' line_height="' + line_height + '"' : '') + 
												(html_tag != '' ? ' html_tag="' + html_tag + '" ' : '') + 
												cactus_shortcode_get_effect_params(e.data) + 
												(letter_spacing != '' ? ' spacing="' + letter_spacing + '"' : '') + 
												(font_family != '' ? ' font_family="' + font_family + '"' : '' ) + 
												((border != '' && border != 'none') ? ' border="' + border + '"' + (border_width != '' ? ' border_width="' + border_width + '"' : '') : '') + 
												(mobile_size != '' ? ' mobile_size="' + mobile_size + '"' : '') + (mobile_line_height != '' ? ' mobile_line_height="' + mobile_line_height + '"' : '') +
												(mobile_padding != '' ? ' mobile_padding="' + mobile_padding + '"' : '') + 
												(mobile_margin != '' ? ' mobile_margin="' + mobile_margin + '"' : '') + 
												(mobile_alignment != '' ? ' mobile_alignment="' + mobile_alignment + '"' : '') + 
												(line_top != '' ? ' line_top="' + line_top + '"' : '') + 
												']' + content + '[/felis_typo]');
					}
				});
			}
		});
	});
})();
