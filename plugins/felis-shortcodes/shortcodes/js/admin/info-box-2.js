// JavaScript Document
(function () {
	tinymce.PluginManager.add('cactus_info_box_2', function (editor, url) {
		editor.addButton('cactus_info_box_2', {
			text: '',
			tooltip: 'Info Box 2',
			id: 'cactus_shortcode_info_box_2',
			onclick: function () {
				// Open window
				var body = [


					{type: 'textbox', name: 'title', label: 'Title of Box'},
					{type: 'textbox', name: 'subtitle', label: 'Subtitle of Box'},

					{
						type: 'textbox',
						name: 'image',
						label: 'Default Image ID',
						tooltip: 'ID of attachment or full URL of Image.'
					},


					

					{
						type: 'textbox',
						name: 'item_image',
						label: 'Item Image ID',
						tooltip: 'ID of attachment or full URL of Image.'
					},

					{type: 'textbox', name: 'item_number', label: 'Number of Info Box Item'},
					{type: 'textbox', name: 'item_title', label: 'Title of Info Box Item'},
					{type: 'textbox', name: 'content', label: 'Content', multiline: true},

					{
						type: 'listbox',
						name: 'item_aos',
						label: 'AOS effect',
						'values': [
							{text: 'None', value: 'none'},
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
						tooltip: 'AOS delay value of item in block'
					},

					{
						type: 'textbox',
						name: 'item_aos_delay',
						label: 'AOS delay value',
						tooltip: 'AOS delay value of item in block'
					},

					{
						type: 'textbox',
						name: 'item_aos_offset',
						label: 'AOS delay offset',
						tooltip: 'AOS delay offset value of item in block'
					},


				];

				body = body.concat(CACTUS_SHORTCODE_DESIGN_OPTIONS);


				editor.windowManager.open({
					title: 'Felis Content Slider',
					body: body,
					onsubmit: function (e) {


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

						var item_image = e.data.item_image;
						if (item_image != '') {
							item_image = 'item_image="' + item_image + '"';
						}

						var item_title = e.data.item_title;
						if (item_title != '') {
							item_title = 'item_title="' + item_title + '"';
						}

						var item_number = e.data.item_number;
						if (item_number != '') {
							item_number = 'item_number="' + item_number + '"';
						}

						var item_aos = e.data.item_aos;
						if (item_aos != '' && item_aos != 'none') {
							item_aos = 'item_aos="' + item_aos + '"';
						}

						var item_aos_delay = e.data.item_aos_delay;
						if (item_aos_delay != '' && item_aos != '' && item_aos != 'none') {
							item_aos_delay = 'item_aos_delay="' + item_aos_delay + '"';
						}

						var item_aos_offset = e.data.item_aos_offset;
						if (item_aos_offset != '' && item_aos != '' && item_aos != 'none') {
							item_aos_offset = 'item_aos_offset="' + item_aos_offset + '"';
						}




						var content = e.data.content;

						var shortcode = '[felis_info_box_2 '+title+' ' +subtitle+ ' '+image+' ' + cactus_shortcode_get_design_params(e.data) + ']';
						for (i = 0; i < 4; i++) {
							shortcode += '[felis_info_box_item '+item_title+'  '+item_number+'  '+item_image+' '+item_aos+' '+item_aos_delay+' '+item_aos_offset+' ]' + content + '[/felis_info_box_item]';
						}
						shortcode += '[/felis_info_box_2]<br class="cactus_br"/>';
						// Insert content when the window form is submitted
						editor.insertContent(shortcode);
					}
				});
			}
		});
	});
})();
