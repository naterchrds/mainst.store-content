// JavaScript Document
(function () {
	tinymce.PluginManager.add('cactus_testimonials', function (editor, url) {
		editor.addButton('cactus_testimonials', {
			text: '',
			tooltip: 'Felis Testimonials',
			id: 'cactus_shortcode_testimonials',
			icon: 'icon-testimonials',
			onclick: function () {
				var body = [

					{
						type: 'listbox',
						name: 'item_style',
						label: 'Choose testimonial style',
						'values': [
							{text: 'Style 1', value: '1'},
							{text: 'Style 2', value: '2'},

						]
					},

					{
						type: 'listbox',
						name: 'autoplay',
						label: 'Autoplay the testimonial or not',
						'values': [
							{text: 'Disable', value: '0'},
							{text: 'Enable', value: '1'},

						]
					},


					{
						type: 'textbox',
						name: 'avatar',
						label: 'URL/ID – URL or Attachment ID of avatar image',
						tooltip: 'Avatar image'
					},

					{type: 'textbox', name: 'name', label: 'Name of person', tooltip: 'Name of person'},

					{type: 'textbox', name: 'title', label: 'Title of person', tooltip: 'Title of person'},


					{type: 'textbox', name: 'content', label: 'Content', multiline: true},

					{type: 'textbox', name: 'num_item', label: 'Number of Testimonial Item', value: 1},
				];

				body = body.concat(CACTUS_SHORTCODE_DESIGN_OPTIONS);


				editor.windowManager.open({
					title: 'Felis Testimonials',
					body: body,
					onsubmit: function (e) {


						var item_style = e.data.item_style;
						if (item_style != '') {
							item_style = 'item_style="' + item_style + '"';
						}

						var autoplay = e.data.autoplay;
						if (autoplay != '') {
							autoplay = 'autoplay="' + autoplay + '"';
						}

						var name = e.data.name;
						if (name != '') {
							name = 'name="' + name + '"';
						}

						var avatar = e.data.avatar;
						if (avatar != '') {
							avatar = 'avatar="' + avatar + '"';
						}

						var title = e.data.title;
						if (title != '') {
							title = 'title="' + title + '"';
						}


						var content = e.data.content;

						var num_item = e.data.num_item;

						if (num_item === '') {
							num_item = 1;
						}

						var shortcode = '[felis_testimonials ' + autoplay + ' ' + item_style + ' ' + cactus_shortcode_get_design_params(e.data) + ']<br class="cactus_br"/>';
						for (i = 0; i < num_item; i++) {
							shortcode += '[felis_testimonial ' + avatar + ' ' + name + ' ' + title + ' ' + cactus_shortcode_get_effect_params(e.data) + ']' + content + '[/felis_testimonial]';

						}
						shortcode += '[/felis_testimonials]<br class="cactus_br"/>';
						// Insert content when the window form is submitted
						editor.insertContent(shortcode);
					}
				});
			}
		});
	});
})();
