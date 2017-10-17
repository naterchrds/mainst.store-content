// JavaScript Document
(function () {
	tinymce.PluginManager.add('cactus_info_box', function (editor, url) {
		editor.addButton('cactus_info_box', {
			text: '',
			tooltip: 'Info Boxe',
			id: 'cactus_shortcode_info_box',
			onclick: function () {
				// Open window
				var body = [


					{
						type: 'listbox',
						name: 'box_style',
						label: 'Box Style',
						'values': [
							{text: 'Style 1', value: '1'},
							{text: 'Style 2', value: '2'},
						]
					},

					{type: 'textbox', name: 'title', label: 'Title of box'},
					{type: 'textbox', name: 'subtitle', label: 'Subtitle of box'},

					{type: 'textbox', name: 'content', label: 'Content', multiline: true},

					{
						type: 'listbox',
						name: 'content_align',
						label: 'Content Alignment',
						'values': [
							{text: 'Left', value: 'left'},
							{text: 'Right', value: 'right'},
						]
					},

					{type: 'textbox', name: 'padding_bottom', label: 'Content Padding Bottom', tooltip: 'In pixels. Example: 30px'},

					{
						type: 'textbox',
						name: 'image',
						label: 'Image ID',
						tooltip: 'ID of attachment or full URL of Image.'
					},

					{
						type: 'listbox',
						name: 'image_align',
						label: 'Image Alignment',
						'values': [
							{text: 'Right', value: 'right'},
							{text: 'Left', value: 'left'},
							
						]
					},



				];

				body = body.concat(CACTUS_SHORTCODE_DESIGN_OPTIONS);


				editor.windowManager.open({
					title: 'Felis Info Box',
					body: body,
					onsubmit: function (e) {


						var box_style = e.data.box_style;
						if ( box_style != '') {
							box_style = 'box_style="' + box_style + '"';
						}

						var title = e.data.title;
						if ( title != '') {
							title = 'title="' + title + '"';
						}

						var subtitle = e.data.subtitle;
						if ( subtitle != '') {
							subtitle = 'subtitle="' + subtitle + '"';
						}

						var content_align = e.data.content_align;
						if ( content_align != '') {
							content_align = 'content_align="' + content_align + '"';
						}

						var padding_bottom = e.data.padding_bottom;
						if ( padding_bottom != '') {
							padding_bottom = 'padding_bottom="' + padding_bottom + '"';
						}


						var image = e.data.image;
						if ( image != '') {
							image = 'image="' + image + '"';
						}

						var image_align = e.data.image_align;
						if ( image_align != '') {
							image_align = 'image_align="' + image_align + '"';
						}

						var content = e.data.content;

						var shortcode = '[felis_info_box '+box_style+' '+title+' '+subtitle+' '+content_align+' '+padding_bottom+' '+image+' '+image_align+' ' + cactus_shortcode_get_design_params(e.data) + ']';
	
						shortcode += content+'[/felis_info_box]';
						// Insert content when the window form is submitted
						editor.insertContent(shortcode);
					}
				});
			}
		});
	});
})();
