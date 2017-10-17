// JavaScript Document
(function () {
	tinymce.PluginManager.add('cactus_woo_product_slider', function (editor, url) {
		editor.addButton('cactus_woo_product_slider', {
			text: '',
			tooltip: 'Woo Product Slider',
			id: 'cactus_shortcode_woo_product_slider',
			onclick: function () {
				// Open window
				var body = [

					{
						type: 'listbox',
						name: 'layout',
						label: 'Slider Style',
						'values': [
							{text: 'Style 1', value: '1'},
							{text: 'Style 2', value: '2'},
						]
					},


					{type: 'textbox', name: 'count', label: 'Total Items'},

					{
						type: 'listbox',
						name: 'items_per_row',
						label: 'Select Number of items per row',
						'values': [
							{text: '2 items', value: '2'},
							{text: '3 items', value: '3'},
							{text: '4 items', value: '4'},
							{text: '6 items', value: '6'}
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

					{type: 'textbox', name: 'cats', label: 'Category', tooltip: 'List of cat ID or slug, separated by a comma'},
					
					{type: 'textbox', name: 'ids_', label: 'Ids', tooltip: 'Specify post IDs to retrieve'},


					{
						type: 'listbox',
						name: 'order',
						label: 'Order',
						'values': [
							{text: 'DESC', value: 'DESC'},
							{text: 'ASC', value: 'ASC'}
						]
					},
					
					{
						type: 'listbox',
						name: 'orderby',
						label: 'Order by',
						'values': [
							{text: 'Date', value: 'date'},
							{text: 'ID', value: 'ID'},
							{text: 'Author', value: 'author'},
							{text: 'Title', value: 'title'},
							{text: 'Name', value: 'name'},
							{text: 'Modified', value: 'modified'},
							{text: 'Parent', value: 'parent'},
							{text: 'Random', value: 'rand'},
							{text: 'Comment count', value: 'comment_count'},
							{text: 'Menu order', value: 'menu_order'},
							{text: 'Meta value', value: 'meta_value'},
							{text: 'Meta value num', value: 'meta_value_num'},
							{text: 'Post__in', value: 'post__in'},
							{text: 'None', value: 'none'}
						]
					},


				];

				body = body.concat(CACTUS_SHORTCODE_DESIGN_OPTIONS);


				editor.windowManager.open({
					title: 'Felis Product Silder',
					body: body,
					onsubmit: function (e) {


						var layout = e.data.layout;
						if ( layout != '' ) {
							layout = 'layout="' + layout + '"';
						}

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

						var cats = e.data.cats;
						if ( cats != '' ) {
							cats = 'product_cat="' + cats + '"';
						}

						var ids = e.data.ids_;
						if ( ids != '' ) {
							ids = 'product="' + ids + '"';
						}

						var order = e.data.order;
						if ( order != '' ) {
							order = 'order="' + order + '"';
						}

						var orderby = e.data.orderby;
						if ( orderby != '' ) {
							orderby = 'orderby="' + orderby + '"';
						}


						var shortcode = '[felis_woo_product_slider '+layout+' '+count+' '+items_per_row+' '+autoplay+' '+cats+' '+ids+' '+order+' '+orderby+' ' + cactus_shortcode_get_design_params(e.data) + '][/felis_woo_product_slider]';
						// Insert content when the window form is submitted
						editor.insertContent(shortcode);
					}
				});
			}
		});
	});
})();
