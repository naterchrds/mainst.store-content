jQuery(document).ready(function() {

	//show hide settings when choose page tempate
	var page_tpl_obj 				= jQuery('select[name=page_template]');
	var page_tpl 					= jQuery('select[name=page_template]').val();
	
	jQuery(window).load(function(){
		
		/* MegaMenu in Appearance > Menu*/
		jQuery( ".menu-item.menu-item-depth-0").each(function(index,item) {
			jQuery(item).find(".edit-menu-item-menu_style").change(function(){
				var mega_num_items	= jQuery(item).find('.wpmega-num_items');
				var mega_orderby	= jQuery(item).find('.wpmega-orderby');
				if(jQuery(item).find(".edit-menu-item-menu_style").val()=="preview-2"){
					mega_num_items.show();
					mega_orderby.show();   
				}else{
					mega_num_items.hide();
					mega_orderby.hide();
				}
			}).change();
		
		});
				
		var cactus_playlist	= jQuery('#cactus-playlist');
		cactus_playlist.hide();
		
		
		var post_format = jQuery('input[name=post_format]:checked', '#post-formats-select').val();
		if(post_format == 'video'){
			cactus_playlist.show();   
		}else{
			cactus_playlist.hide();  
		}
		
		
		jQuery('#post-formats-select').on('change', function() {
		   	var post_format = jQuery('input[name=post_format]:checked', '#post-formats-select').val();
		   	if(post_format == 'video'){
				cactus_playlist.show();   
		   	}else{
				cactus_playlist.hide();  
			}
		});
		
		var setting_page_content_tab	= jQuery('#page_meta_box.postbox .ot-metabox-tabs .ot-metabox-nav li[aria-controls="setting_page_content_tab"]');
		var setting_page_slider_tab		= jQuery('#page_meta_box.postbox .ot-metabox-tabs .ot-metabox-nav li[aria-controls="setting_page_slider_tab"]');
		var setting_enable_page_title	= jQuery('#setting_enable_page_title');
		var setting_heading_schema		= jQuery('#setting_heading_schema');

		if(page_tpl == 'page-templates/front-page.php'){
			setting_page_content_tab.show();
			setting_page_slider_tab.show();
			setting_enable_page_title.hide();
			setting_heading_schema.hide();
		} else if(page_tpl == 'page-templates/faq-page.php'){

		} else  {
			setting_page_content_tab.hide();
			setting_page_slider_tab.hide();
			setting_enable_page_title.show();
			setting_heading_schema.show();
		}

		page_tpl_obj.change(function(event) {
			if(jQuery(this).val() == 'page-templates/front-page.php'){
				setting_page_content_tab.show(200);
				setting_page_slider_tab.show(200);
				setting_enable_page_title.hide(200);
			setting_heading_schema.hide(200);
			}else{
				setting_page_content_tab.hide(200);
				setting_page_slider_tab.hide(200);
				setting_enable_page_title.show(200);
			setting_heading_schema.show(200);
			}
		});
	});


	jQuery(document).on('click','#id_cactus_alert button',function(e) {
		jQuery('.mce-foot button').trigger( "click" );
		if(jQuery('#option-tree-settings-api').has(e.target) && jQuery('#option-tree-settings-api').length){ //in theme option
			jQuery('.ui-tabs-panel[aria-hidden=false] #cactus_alert_shortcode button').trigger( "click" );
		}else{
			jQuery('#cactus_alert_shortcode button').trigger( "click" );
		}
	});

	jQuery(document).on('click','#id_cactus_button button',function(e) {
		jQuery('.mce-foot button').trigger( "click" );
		if(jQuery('#option-tree-settings-api').has(e.target) && jQuery('#option-tree-settings-api').length){ //in theme option
			jQuery('.ui-tabs-panel[aria-hidden=false] #cactus_button_shortcode button').trigger( "click" );
		}else{
			jQuery('#cactus_button_shortcode button').trigger( "click" );
		}
	});

	jQuery(document).on('click','#id_cactus_dropcap button',function(e) {
		jQuery('.mce-foot button').trigger( "click" );
		if(jQuery('#option-tree-settings-api').has(e.target) && jQuery('#option-tree-settings-api').length){ //in theme option
			jQuery('.ui-tabs-panel[aria-hidden=false] #cactus_dropcap_shortcode button').trigger( "click" );
		}else{
			jQuery('#cactus_dropcap_shortcode button').trigger( "click" );
		}
	});

	jQuery(document).on('click','#id_cactus_tooltip button',function(e) {
		jQuery('.mce-foot button').trigger( "click" );
		if(jQuery('#option-tree-settings-api').has(e.target) && jQuery('#option-tree-settings-api').length){ //in theme option
			jQuery('.ui-tabs-panel[aria-hidden=false] #cactus_tooltip_shortcode button').trigger( "click" );
		}else{
			jQuery('#cactus_tooltip_shortcode button').trigger( "click" );
		}
	});

	jQuery(document).on('click','#id_cactus_client button',function(e) {
		jQuery('.mce-foot button').trigger( "click" );
		if(jQuery('#option-tree-settings-api').has(e.target) && jQuery('#option-tree-settings-api').length){ //in theme option
			jQuery('.ui-tabs-panel[aria-hidden=false] #cactus_client_shortcode button').trigger( "click" );
		}else{
			jQuery('#cactus_client_shortcode button').trigger( "click" );
		}
	});

	jQuery(document).on('click','#id_cactus_icon_box button',function(e) {
		jQuery('.mce-foot button').trigger( "click" );
		if(jQuery('#option-tree-settings-api').has(e.target) && jQuery('#option-tree-settings-api').length){ //in theme option
			jQuery('.ui-tabs-panel[aria-hidden=false] #cactus_icon_box_shortcode button').trigger( "click" );
		}else{
			jQuery('#cactus_icon_box_shortcode button').trigger( "click" );
		}
	});

	jQuery(document).on('click','#id_cactus_icon_list button',function(e) {
		jQuery('.mce-foot button').trigger( "click" );
		if(jQuery('#option-tree-settings-api').has(e.target) && jQuery('#option-tree-settings-api').length){ //in theme option
			jQuery('.ui-tabs-panel[aria-hidden=false] #cactus_icon_list_shortcode button').trigger( "click" );
		}else{
			jQuery('#cactus_icon_list_shortcode button').trigger( "click" );
		}
	});

	jQuery(document).on('click','#id_cactus_special_heading button',function(e) {
		jQuery('.mce-foot button').trigger( "click" );
		if(jQuery('#option-tree-settings-api').has(e.target) && jQuery('#option-tree-settings-api').length){ //in theme option
			jQuery('.ui-tabs-panel[aria-hidden=false] #cactus_special_heading_shortcode button').trigger( "click" );
		}else{
			jQuery('#cactus_special_heading_shortcode button').trigger( "click" );
		}
	});

	jQuery(document).on('click','#id_cactus_compare_table button',function(e) {
		jQuery('.mce-foot button').trigger( "click" );
		if(jQuery('#option-tree-settings-api').has(e.target) && jQuery('#option-tree-settings-api').length){ //in theme option
			jQuery('.ui-tabs-panel[aria-hidden=false] #cactus_compare_shortcode button').trigger( "click" );
		}else{
			jQuery('#cactus_compare_shortcode button').trigger( "click" );
		}
	});

	jQuery(document).on('click','#id_cactus_content_box button',function(e) {
		jQuery('.mce-foot button').trigger( "click" );
		if(jQuery('#option-tree-settings-api').has(e.target) && jQuery('#option-tree-settings-api').length){ //in theme option
			jQuery('.ui-tabs-panel[aria-hidden=false] #cactus_content_box_shortcode button').trigger( "click" );
		}else{
			jQuery('#cactus_content_box_shortcode button').trigger( "click" );
		}
	});

	jQuery(document).on('click','#id_cactus_services button',function(e) {
		jQuery('.mce-foot button').trigger( "click" );
		if(jQuery('#option-tree-settings-api').has(e.target) && jQuery('#option-tree-settings-api').length){ //in theme option
			jQuery('.ui-tabs-panel[aria-hidden=false] #cactus_services_shortcode button').trigger( "click" );
		}else{
			jQuery('#cactus_services_shortcode button').trigger( "click" );
		}
	});

	jQuery(document).on('click','#id_cactus_map button',function(e) {
		jQuery('.mce-foot button').trigger( "click" );
		if(jQuery('#option-tree-settings-api').has(e.target) && jQuery('#option-tree-settings-api').length){ //in theme option
			jQuery('.ui-tabs-panel[aria-hidden=false] #cactus_map_shortcode button').trigger( "click" );
		}else{
			jQuery('#cactus_map_shortcode button').trigger( "click" );
		}
	});

	jQuery(document).on('click','#id_cactus_contact_box button',function(e) {
		jQuery('.mce-foot button').trigger( "click" );
		if(jQuery('#option-tree-settings-api').has(e.target) && jQuery('#option-tree-settings-api').length){ //in theme option
			jQuery('.ui-tabs-panel[aria-hidden=false] #cactus_contact_box_shortcode button').trigger( "click" );
		}else{
			jQuery('#cactus_contact_box_shortcode button').trigger( "click" );
		}
	});

	jQuery(document).on('click','#id_cactus_story_box button',function(e) {
		jQuery('.mce-foot button').trigger( "click" );
		if(jQuery('#option-tree-settings-api').has(e.target) && jQuery('#option-tree-settings-api').length){ //in theme option
			jQuery('.ui-tabs-panel[aria-hidden=false] #cactus_story_box_shortcode button').trigger( "click" );
		}else{
			jQuery('#cactus_story_box_shortcode button').trigger( "click" );
		}
	});

	jQuery(document).on('click','#id_cactus_tab button',function(e) {
		jQuery('.mce-foot button').trigger( "click" );
		if(jQuery('#option-tree-settings-api').has(e.target) && jQuery('#option-tree-settings-api').length){ //in theme option
			jQuery('.ui-tabs-panel[aria-hidden=false] #cactus_tab_shortcode button').trigger( "click" );
		}else{
			jQuery('#cactus_tab_shortcode button').trigger( "click" );
		}
	});

	jQuery(document).on('click','#id_cactus_blog button',function(e) {
		jQuery('.mce-foot button').trigger( "click" );
		if(jQuery('#option-tree-settings-api').has(e.target) && jQuery('#option-tree-settings-api').length){ //in theme option
			jQuery('.ui-tabs-panel[aria-hidden=false] #cactus_blog_shortcode button').trigger( "click" );
		}else{
			jQuery('#cactus_blog_shortcode button').trigger( "click" );
		}
	});

	jQuery(document).on('click','#id_cactus_testimonial button',function(e) {
		jQuery('.mce-foot button').trigger( "click" );
		if(jQuery('#option-tree-settings-api').has(e.target) && jQuery('#option-tree-settings-api').length){ //in theme option
			jQuery('.ui-tabs-panel[aria-hidden=false] #cactus_testimonial_shortcode button').trigger( "click" );
		}else{
			jQuery('#cactus_testimonial_shortcode button').trigger( "click" );
		}
	});

	jQuery(document).on('click','#id_cactus_video button',function(e) {
		jQuery('.mce-foot button').trigger( "click" );
		if(jQuery('#option-tree-settings-api').has(e.target) && jQuery('#option-tree-settings-api').length){ //in theme option
			jQuery('.ui-tabs-panel[aria-hidden=false] #cactus_video_shortcode button').trigger( "click" );
		}else{
			jQuery('#cactus_video_shortcode button').trigger( "click" );
		}
	});
	
	jQuery(document).on('click','#id_cactus_portfolio button',function(e) {
		jQuery('.mce-foot button').trigger( "click" );
		if(jQuery('#option-tree-settings-api').has(e.target) && jQuery('#option-tree-settings-api').length){ //in theme option
			jQuery('.ui-tabs-panel[aria-hidden=false] #cactus_portfolio_shortcode button').trigger( "click" );
		}else{
			jQuery('#cactus_portfolio_shortcode button').trigger( "click" );
		}
	});
	jQuery(document).on('click','#id_cactus_headline button',function(e) {
		jQuery('.mce-foot button').trigger( "click" );
		if(jQuery('#option-tree-settings-api').has(e.target) && jQuery('#option-tree-settings-api').length){ //in theme option
			jQuery('.ui-tabs-panel[aria-hidden=false] #cactus_headline_shortcode button').trigger( "click" );
		}else{
			jQuery('#cactus_headline_shortcode button').trigger( "click" );
		}
	});



});

jQuery(document).ready(function(){
	var defaultVal=jQuery('input[name=post_format]:checked', '#post').val();
	checkPostformat(defaultVal);
	jQuery('input[name=post_format]', '#post').click(function(){
		var keyVal=jQuery(this).val();
		checkPostformat(keyVal);
	});
	function checkPostformat(strVal){

		switch(strVal) {
		case "0":
		case "audio":
		case "quote":
			jQuery('#post_meta_box #setting_standard_post_layout').show('slow');
			jQuery('#post_meta_box #setting_video_post_layout').hide('slow');
			jQuery('#post_meta_box #setting_gallery_post_layout').hide('slow');
			jQuery('#post_meta_box #setting_image_upvote').hide('slow');
			break;
		case "video":
			jQuery('#post_meta_box #setting_video_post_layout').show('slow');
			jQuery('#post_meta_box #setting_standard_post_layout').hide('slow');
			jQuery('#post_meta_box #setting_gallery_post_layout').hide('slow');
			jQuery('#post_meta_box #setting_image_upvote').hide('slow');
			break;
		case "gallery":
			jQuery('#post_meta_box #setting_gallery_post_layout').show('slow');
			jQuery('#post_meta_box #setting_standard_post_layout').hide('slow');
			jQuery('#post_meta_box #setting_video_post_layout').hide('slow');
			jQuery('#post_meta_box #setting_image_upvote').show('slow');
			break;	
		default:
			jQuery('#post_meta_box #setting_gallery_post_layout').hide('slow');
			jQuery('#post_meta_box #setting_standard_post_layout').hide('slow');
			jQuery('#post_meta_box #setting_video_post_layout').hide('slow');
			jQuery('#post_meta_box #setting_image_upvote').hide('slow');
			break;
		}
	};
});

//custom upload image in User Setting.
jQuery(document).ready(function($){

    var custom_uploader;

    $('#upload_image_button').click(function(e) {
        e.preventDefault();

        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }

        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });

        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            if($('#author_header_background').length > 0)
            	$('#author_header_background').val(attachment.url);
            if($('#cat_bg').length > 0)
            	$('#cat_bg').val(attachment.url);
        });
        //Open the uploader dialog
        custom_uploader.open();

    });

    $('#remove_image_button').click(function(e) {
    	if($('#cat_bg').length > 0)
    	{
        	$('#cat_bg').val("");
    	}
 	});

	$('#upload_image_button1').click(function(e) {

	    e.preventDefault();

	    //If the uploader object has already been created, reopen the dialog
	    if (custom_uploader) {
	        custom_uploader.open();
	        return;
	    }

	    //Extend the wp.media object
	    custom_uploader = wp.media.frames.file_frame = wp.media({
	        title: 'Choose Image',
	        button: {
	            text: 'Choose Image'
	        },
	        multiple: false
	    });

	    //When a file is selected, grab the URL and set it as the text field's value
	    custom_uploader.on('select', function() {
	        attachment = custom_uploader.state().get('selection').first().toJSON();
	        if($('#cat_bg').length > 0)
	        	$('#cat_bg').val(attachment.url);
	    });
	    //Open the uploader dialog
	    custom_uploader.open();

	});

});