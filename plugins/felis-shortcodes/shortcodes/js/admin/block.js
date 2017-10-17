// JavaScript Document
(function () {
	tinymce.PluginManager.add('cactus_block', function (editor, url) {
		editor.addButton('cactus_block', {
			text: '',
            id: 'cactus_shortcode_block',
			tooltip: 'Felis Block',
			icon: 'icon-block',
			onclick: function () {
				// Open window
                var body = [
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
							type: 'listbox',
							name: 'color_mask',
							label: 'Color Mask',
							'values': [
								{text: 'No', value: 'off'},
								{text: 'Add Mask', value: 'on'}
							]
						},

						{type: 'textbox', name: 'mobile_padding', label: 'Mobile Padding', tooltip: 'Padding on mobile screen. Format: TOP RIGHT BOTTOM LEFT. ex: 0px 0px 0px 0px'},
						
						{type: 'textbox', name: 'mobile_margin', label: 'Mobile Margin', tooltip: 'Margin on mobile screen. Format: TOP RIGHT BOTTOM LEFT. ex: 0px 0px 0px 0px'},	
					];
                    
				body = body.concat(CACTUS_SHORTCODE_DESIGN_OPTIONS);
				
				editor.windowManager.open({
					title: 'Cactus Block',
					body: body,
					onsubmit: function (e) {
						var alignment = e.data.alignment;
						var colormask = e.data.color_mask;
						var mobile_padding = e.data.mobile_padding;
						var mobile_margin = e.data.mobile_margin;
						editor.insertContent('[felis_block mobile_margin="' + mobile_margin + '" mobile_padding="' + mobile_padding + '" alignment="' + alignment + '" ' + (colormask != '' && colormask != 'off' ? 'color_mask="on" ' : ' ') + cactus_shortcode_get_design_params(e.data) + '][/felis_block]');
					}
				});
			}
		});
	});
})();
