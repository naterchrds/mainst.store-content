// JavaScript Document
(function () {
	tinymce.PluginManager.add('cactus_woo_category_slider', function (editor, url) {
		editor.addButton('cactus_woo_category_slider', {
			text: '',
			tooltip: 'Woo Category Slider',
			id: 'cactus_shortcode_woo_category_slider',
			onclick: function () {
				// Open window
				var body = [

					{type: 'textbox', name: 'count', label: 'Total Items'},

					{
						type: 'listbox',
						name: 'items_per_row',
						label: 'Select Number of items per row',
						'values': [
							{text: '2 rows', value: '2'},
							{text: '3 rows', value: '3'},
						]
					},

					{
						type: 'listbox',
						name: 'autoplay',
						label: 'Autoplay',
						'values': [
							{text: 'Disable', value: '0'},
							{text: 'Enable', value: '1'}
						]
					},

					


				];

				body = body.concat(CACTUS_SHORTCODE_DESIGN_OPTIONS);


				editor.windowManager.open({
					title: 'Felis Category Product Slider',
					body: body,
					onsubmit: function (e) {


						var count = e.data.count;
						if ( count != '' ) {
							count = 'count="' + count + '"';
						}

						var items_per_row = e.data.items_per_row;
						if ( items_per_row != '' ) {
							items_per_row = 'items_per_row="' + items_per_row + '"';
						}

						var autoplay = e.data.autoplay;
						if ( autoplay != '' ) {
							autoplay = 'autoplay="' + autoplay + '"';
						}


						var shortcode = '[felis_woo_category_slider '+count+' '+items_per_row+' '+autoplay+' ' + cactus_shortcode_get_design_params(e.data) + '][/felis_woo_category_slider]';
						// Insert content when the window form is submitted
						editor.insertContent(shortcode);
					}
				});
			}
		});
	});
})();
