// JavaScript Document
(function () {
	tinymce.PluginManager.add('cactus_content_slider', function (editor, url) {
		editor.addButton('cactus_content_slider', {
			text: '',
			tooltip: 'Content Slider',
			id: 'cactus_shortcode_content_slider',
			onclick: function () {
				// Open window
				var body = [

					{
						type: 'listbox',
						name: 'wrap_style',
						label: 'Content Slider Wrap Style',
						'values': [
							{text: 'Normal', value: ''},
							{text: 'By Scroll', value: 'by_scroll'},
						]
					},

					{
						type: 'listbox',
						name: 'item_style',
						label: 'Content Slider Item Style',
						'values': [
							{text: 'Style 1', value: '1'},
							{text: 'Style 2', value: '2'},
							{text: 'Style 3', value: '3'},
						]
					},


					{type: 'textbox', name: 'title', label: 'Title of Slider'},
					{type: 'textbox', name: 'subtitle', label: 'Subtitle of Slider'},


					{type: 'textbox', name: 'content', label: 'Content', multiline: true},

					{
						type: 'textbox',
						name: 'image',
						label: 'Image ID',
						tooltip: 'ID of attachment or full URL of Image.'
					},

					{
						type: 'textbox',
						name: 'bg_image',
						label: 'Background Image ID',
						tooltip: 'ID of attachment or full URL of Background Image.'
					},

					{type: 'textbox', name: 'slide_url', label: 'Box Url'},

				];

				body = body.concat(CACTUS_SHORTCODE_DESIGN_OPTIONS);


				editor.windowManager.open({
					title: 'Felis Content Slider',
					body: body,
					onsubmit: function (e) {


						var wrap_style = e.data.wrap_style;
						if (wrap_style != '') {
							wrap_style = 'wrap_style="' + wrap_style + '"';
						}

						var item_style = e.data.item_style;
						if (item_style != '') {
							item_style = 'item_style="' + item_style + '"';
						}

						var title = e.data.title;
						if (title != '') {
							title = 'title="' + title + '"';
						}

						var subtitle = e.data.subtitle;
						if (subtitle != '') {
							subtitle = 'subtitle="' + subtitle + '"';
						}

						var image = e.data.image;
						if (image != '') {
							image = 'image="' + image + '"';
						}

						var bg_image = e.data.bg_image;
						if (bg_image != '') {
							bg_image = 'bg_image="' + bg_image + '"';
						}

						var slide_url = e.data.slide_url;
						if (slide_url != '') {
							slide_url = 'slide_url="' + slide_url + '"';
						}


						var content = e.data.content;

						var shortcode = '[felis_content_slider '+wrap_style+' '+item_style+' ' + cactus_shortcode_get_design_params(e.data) + ']';
						for (i = 0; i < 4; i++) {
							shortcode += '[felis_content_slide '+title+' ' +subtitle+ ' '+image+' '+bg_image+' ' +slide_url+ ' ]' + content + '[/felis_content_slide]';
						}
						shortcode += '[/felis_content_slider]<br class="cactus_br"/>';
						// Insert content when the window form is submitted
						editor.insertContent(shortcode);
					}
				});
			}
		});
	});
})();
