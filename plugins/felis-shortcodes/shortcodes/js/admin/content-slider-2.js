// JavaScript Document
(function () {
	tinymce.PluginManager.add('cactus_content_slider_2', function (editor, url) {
		editor.addButton('cactus_content_slider_2', {
			text: '',
			tooltip: 'Content Slider 2',
			id: 'cactus_shortcode_content_slider_2',
			onclick: function () {
				// Open window
				var body = [

					{
						type: 'listbox',
						name: 'data_source',
						label: 'Data Source',
						'values': [
							{text: 'Post', value: 'post'},
							{text: 'Attachment', value: 'attachment'}
						]
					},

					{type: 'textbox', name: 'include', label: 'Images', tooltip: 'Specify Image IDs to retrieve if you chosse Attachment Data Source'},

					{type: 'textbox', name: 'count', label: 'Total Items', tooltip: 'Set max limit for items in slide or enter -1 to display all (limited to 1000).'},
					
					
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

					{
						type: 'listbox',
						name: 'item_rows',
						label: 'Number of rows',
						'values': [
							{text: '1 row', value: '1'},
							{text: '2 rows', value: '2'}
						]
					},

					{
						type: 'listbox',
						name: 'items_per_row',
						label: 'Select Number of items per row',
						'values': [
							{text: '2 rows', value: '2'},
							{text: '3 rows', value: '3'},
							{text: '4 rows', value: '4'},
							{text: '6 rows', value: '6'}
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

					{
						type: 'listbox',
						name: 'bullets',
						label: 'Bullets',
						'values': [
							{text: 'Disable', value: '0'},
							{text: 'Enable', value: '1'}
						]
					},

					{
						type: 'listbox',
						name: 'bullets_align',
						label: 'Bullets Alignment',
						'values': [
							{text: 'Left', value: 'left'},
							{text: 'Right', value: 'right'},
							{text: 'Center', value: 'center'}
						]
					},

				];

				body = body.concat(CACTUS_SHORTCODE_DESIGN_OPTIONS);


				editor.windowManager.open({
					title: 'Felis Content Slider 2',
					body: body,
					onsubmit: function (e) {

						var data_source = e.data.data_source;
						if ( data_source != '' ) {
							data_source = 'data_source="' + data_source + '"';
						}

						var include = e.data.include;
						if ( include != '' ) {
							include = 'include="' + include + '"';
						}


						var count = e.data.count;
						if ( count != '' ) {
							count = 'count="' + count + '"';
						}

						var item_rows = e.data.item_rows;
						if ( item_rows != '' ) {
							item_rows = 'item_rows="' + item_rows + '"';
						}

						var items_per_row = e.data.items_per_row;
						if ( items_per_row != '' ) {
							items_per_row = 'items_per_row="' + items_per_row + '"';
						}

						var autoplay = e.data.autoplay;
						if ( autoplay != '' ) {
							autoplay = 'autoplay="' + autoplay + '"';
						}

						var bullets = e.data.bullets;
						if ( bullets != '' ) {
							bullets = 'bullets="' + bullets + '"';
						}

						var bullets_align = e.data.bullets_align;
						if ( bullets_align != '' ) {
							bullets_align = 'bullets_align="' + bullets_align + '"';
						}

						var cats = e.data.cats;
						if ( cats != '' ) {
							cats = 'cats="' + cats + '"';
						}

						var ids = e.data.ids_;
						if ( ids != '' ) {
							ids = 'posts="' + ids + '"';
						}

						var order = e.data.order;
						if ( order != '' ) {
							order = 'order="' + order + '"';
						}

						var orderby = e.data.orderby;
						if ( orderby != '' ) {
							orderby = 'orderby="' + orderby + '"';
						}


						var shortcode = '[felis_content_slider_2 '+data_source+' '+include+' '+count+' '+item_rows+' '+items_per_row+' '+autoplay+' '+bullets+' '+bullets_align+' '+ids+' '+order+' '+orderby+' '+cats+' ' + cactus_shortcode_get_design_params(e.data) + ']';

						shortcode += '[/felis_content_slider_2]';
						// Insert content when the window form is submitted
						editor.insertContent(shortcode);
					}
				});
			}
		});
	});
})();
