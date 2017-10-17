// JavaScript Document
(function () {
	tinymce.PluginManager.add('cactus_content_grid', function (editor, url) {
		editor.addButton('cactus_content_grid', {
			text: '',
			tooltip: 'Content Grid',
			id: 'cactus_shortcode_content_grid',
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
					title: 'Felis Content Grid',
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


						var cats = e.data.cats;
						if ( cats != '' ) {
							cats = 'cats="' + cats + '"';
						}

						var ids = e.data.ids_;
						if ( ids != '' ) {
							ids = 'ids="' + ids + '"';
						}

						var order = e.data.order;
						if ( order != '' ) {
							order = 'order="' + order + '"';
						}

						var orderby = e.data.orderby;
						if ( orderby != '' ) {
							orderby = 'orderby="' + orderby + '"';
						}


						var shortcode = '[felis_content_grid '+data_source+' '+include+' '+ids+' '+cats+' '+order+' '+orderby+' ' + cactus_shortcode_get_design_params(e.data) + ']';

						shortcode += '[/felis_content_grid]';
						// Insert content when the window form is submitted
						editor.insertContent(shortcode);
					}
				});
			}
		});
	});
})();
