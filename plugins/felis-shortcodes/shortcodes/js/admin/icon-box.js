// JavaScript Document
(function () {
	tinymce.PluginManager.add('cactus_iconboxes', function (editor, url) {
		editor.addButton('cactus_iconboxes', {
			text: '',
			tooltip: 'Icon Boxes',
			id: 'cactus_shortcode_iconboxes',
			onclick: function () {
				// Open window
				var body = [

					{
						type: 'listbox',
						name: 'item_style',
						label: 'IconBox Style',
						'values': [
							{text: 'Style 1', value: '1'},
							{text: 'Style 2', value: '2'},
							{text: 'Style 3', value: '3'},
						]
					},


					{
						type: 'listbox',
						name: 'items_per_row',
						label: 'Number of items per row',
						'values': [
							{text: '3 items', value: '3'},
							{text: '1 item', value: '1'},
							{text: '2 items', value: '2'},
							{text: '4 items', value: '4'},
							{text: '6 items', value: '6'},
						],
						tooltip: 'The width of item depends on the number of items per row based on 12 columns. For example, if you choose 4 items per row, the width of each item will be 3 columns. Especially, if you want the width of each items is 3 columns, you can choose four items, then you just need to put 3 items per row.'
					},

					{type: 'textbox', name: 'title', label: 'Title of box'},

					{
						type: 'textbox',
						name: 'title_color',
						label: 'Title Color',
						classes: 'colorbox',
						value: "",
						id: 'newcolorpicker_iconboxcolor',
						tooltip: 'Title color of the box.'
					},

					{type: 'textbox', name: 'content', label: 'Content', multiline: true},

					{
						type: 'textbox',
						name: 'content_color',
						label: 'Content Color',
						classes: 'colorbox',
						value: "",
						id: 'newcolorpicker_iconboxcolor_content',
						tooltip: 'Content color of the box.'
					},

					{
						type: 'textbox',
						name: 'icon',
						label: 'CSS Class name of icon',
						tooltip: "Icon CSS Class. Ex: fa fa-home"
					},

					{
						type: 'listbox',
						name: 'icon_color_style',
						label: 'Icon Color Style',
						'values': [
								{text: 'Default', value: 'default'},
								{text: 'Single', value: 'single'},
								{text: 'Gradient', value: 'gradient'},
							],
						tooltip: 'Icon color of the box.'
					},

					{
						type: 'textbox',
						name: 'icon_single_color',
						label: 'Icon Single Color',
						classes: 'colorbox',
						value: "",
						id: 'newcolorpicker_iconsinglecolor',
						tooltip: 'Icon single color'
					},

					{
						type: 'textbox',
						name: 'icon_gradient_from',
						label: 'Icon Gradient From Color',
						classes: 'colorbox',
						value: "",
						id: 'newcolorpicker_iconfromcolor',
						tooltip: 'Icon Gradient From Color'
					},

					{
						type: 'textbox',
						name: 'icon_gradient_to',
						label: 'Icon Gradient to Color',
						classes: 'colorbox',
						value: "",
						id: 'newcolorpicker_icontocolor',
						tooltip: 'Icon gradient to Color'
					},

					{
						type: 'textbox',
						name: 'border_color',
						label: 'Icon Border Color',
						classes: 'colorbox',
						value: "",
						id: 'newcolorpicker_iconbordercolor',
						tooltip: 'Icon Border Color for Style 3'
					},

					{
							type: 'listbox',
							name: 'main_color',
							label: 'Main Color',
							'values': [
								{text: 'Default', value: 'default'},
								{text: 'Single', value: 'single'},
								{text: 'Gradient', value: 'gradient'},
							],
							tooltip: 'Main color for Style 2'
					},

					{
						type: 'textbox',
						name: 'main_single_color',
						label: 'Main Single Color',
						classes: 'colorbox',
						value: "",
						id: 'newcolorpicker_mainsinglecolor',
						tooltip: 'Main single color for Style 2'
					},

					{
						type: 'textbox',
						name: 'main_gradient_from',
						label: 'Main Gradient From Color',
						classes: 'colorbox',
						value: "",
						id: 'newcolorpicker_mainfromcolor',
						tooltip: 'Main Gradient From Color for Style 2'
					},

					{
						type: 'textbox',
						name: 'main_gradient_to',
						label: 'Main Gradient to Color',
						classes: 'colorbox',
						value: "",
						id: 'newcolorpicker_maintocolor',
						tooltip: 'Main Gradient to Color for Style 2'
					},


					{type: 'textbox', name: 'box_url', label: 'Box Url'},

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
					title: 'Felis IconBox',
					body: body,
					onsubmit: function (e) {


						var item_style = e.data.item_style;
						if (item_style != '') {
							item_style = 'item_style="' + item_style + '"';
						}

						var items_per_row = e.data.items_per_row;
						if (items_per_row != '') {
							items_per_row = 'items_per_row="' + items_per_row + '"';
						}

						var icon = e.data.icon;
						if (icon != '') {
							icon = 'icon="' + icon + '"';
						}

						var title = e.data.title;
						if (title != '') {
							title = 'title="' + title + '"';
						}

						var title_color = e.data.title_color;
						if (title_color != '') {
							title_color = 'title_color="' + title_color + '"';
						}

						var icon_color_style = e.data.icon_color_style;
						var icon_single_color = '';
						var icon_gradient_from = '';
						var icon_gradient_to = '';
						if ( icon_color_style != '' ) {
								

							

							if ( icon_color_style == 'single' ) {
								icon_single_color = e.data.icon_single_color;
								if (icon_single_color != '') {
									icon_single_color = 'icon_single_color="' + icon_single_color + '"';
								}
							} else if ( icon_color_style == 'gradient' ) {
								icon_gradient_from = e.data.icon_gradient_from;
								icon_gradient_to = e.data.icon_gradient_to;
								if (icon_gradient_from != '') {
									icon_gradient_from = 'icon_gradient_from="' + icon_gradient_from + '"';
								}
								if (icon_gradient_to != '') {
									icon_gradient_to = 'icon_gradient_to="' + icon_gradient_to + '"';
								}
							}

							icon_color_style = 'icon_color_style="' + icon_color_style + '"';
						}

						var content_color = e.data.content_color;
						if (content_color != '') {
							content_color = 'content_color="' + content_color + '"';
						}content_color

						var border_color = e.data.border_color;
						if (border_color != '') {
							border_color = 'border_color="' + border_color + '"';
						}

						var main_color = e.data.main_color;
						var main_single_color = '';
						var main_gradient_from = '';
						var main_gradient_to = '';
						if ( main_color != '' ) {
							
							if ( main_color == 'single' ) {
								main_single_color = e.data.main_single_color;
								if (main_single_color != '') {
									main_single_color = 'main_single_color="' + main_single_color + '"';
								}
							} else if ( main_color == 'gradient' ) {
								main_gradient_from = e.data.main_gradient_from;
								main_gradient_to = e.data.main_gradient_to;
								if (main_gradient_from != '') {
									main_gradient_from = 'main_gradient_from="' + main_gradient_from + '"';
								}

								if (main_gradient_to != '') {
									main_gradient_to = 'main_gradient_to="' + main_gradient_to + '"';
								}
							}

							main_color = 'main_color="' + main_color + '"';
				 		}


						var box_url = e.data.box_url;
						if (box_url != '') {
							box_url = 'box_url="' + box_url + '"';
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

						var shortcode = '[felis_iconboxes '+item_style+' '+items_per_row+' ' + cactus_shortcode_get_design_params(e.data) + ']<br class="cactus_br"/>';
						for (i = 0; i < e.data.items_per_row; i++) {
							shortcode += '[felis_iconbox '+icon+' ' + icon_color_style + ' '+icon_single_color+' '+icon_gradient_from+' '+icon_gradient_to+' '+title+' ' + title_color + ' '+content_color+' ' + main_color + ' '+border_color+' ' + main_single_color + ' ' + main_gradient_from + ' ' + main_gradient_to + ' '+box_url+' ' + item_aos + ' ' + item_aos_delay + ' ' + item_aos_offset + ' ]' + content + '[/felis_iconbox]';
						}
						shortcode += '[/felis_iconboxes]<br class="cactus_br"/>';
						// Insert content when the window form is submitted
						editor.insertContent(shortcode);
					}
				});
			}
		});
	});
})();
