// JavaScript Document
(function () {
	tinymce.PluginManager.add('cactus_image', function (editor, url) {
		editor.addButton('cactus_image', {
			text: '',
            id: 'cactus_shortcode_image',
			tooltip: 'Felis Image',
			icon: 'icon-image',
			onclick: function () {
				// Open window
                var body = [
						
						{
							type: 'textbox',
							name: 'image',
							label: 'Image ID',
							tooltip: 'ID of attachment or full URL of Image.'
						},

						{
							type: 'textbox',
							name: 'image_size',
							label: 'Image Size',
							tooltip: 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).'
						},

						{
							type: 'textbox',
							name: 'image_link',
							label: 'Image Link',
							tooltip: 'Enter URL if you want this image to have a link.'
						},
					
						{
							type: 'listbox', 
							name: 'hover_style',
							label: 'Image Hover Style',
							'values': [
								{text: 'None', value: 'default'},
								{text: 'Glow', value: 'glow'},
								{text: 'Add Color', value: 'color'},
								{text: 'Gray Scale', value: 'grayscale'},
								{text: 'Fade In', value: 'fade-in'},
								{text: 'Fade Out', value: 'fade-out'},
								{text: 'Add Overlay', value: 'overlay-add'},
								{text: 'Remove Overlay', value: 'overlay-remove'},
								{text: 'Zoom In', value: 'zoom'},
								{text: 'Blur', value: 'blur'},
							]
						},
						
						{
							type: 'listbox',
							name: 'image_alignment',
							label: 'Image Alignment',
							'values': [
								{text: 'Left', value: 'pull-left'},
								{text: 'Center', value: 'center-block'},
								{text: 'Right', value: 'pull-right'},
							]
						},
					
					];
                    
				body = body.concat(CACTUS_SHORTCODE_EFFECT_OPTIONS);
				
				editor.windowManager.open({
					title: 'Felis Image',
					body: body,
					onsubmit: function (e) {
						
						var image = e.data.image;
						var image_size = e.data.image_size;
						var image_link = e.data.image_link;
						var hover_style = e.data.hover_style;
						var image_alignment = e.data.image_alignment;
						
						editor.insertContent('[felis_image' + 
												(image != '' ? ' image="' + image + '"' : '') + 
												(image_size != '' ? ' image_size="' + image_size + '"' : '') + 
												(image_link != '' ? ' image_link="' + image_link + '"' : '') + 
												(hover_style != '' ? ' hover_style="' + hover_style + '"' : '') + 
												cactus_shortcode_get_effect_params(e.data) + 
												(image_alignment != '' ? ' image_alignment="' + image_alignment + '"' : '') + 
												'][/felis_image]');
					}
				});
			}
		});
	});
})();
