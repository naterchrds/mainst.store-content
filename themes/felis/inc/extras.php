<?php

use App\Cactus;

function felis_get_preset($preset){
	$settings = array(
			array(
				'toplink_bg' => '#1B0D1D',
				'toplink_text_color' => '#79717A',
				'toplink_icons_color' => '#FFD417',
				'toplink_icons_hover_color' => '#FFFFFF',
				'nav_bg' => '#FFD417',
				'nav_item_color' => '#111111',
				'nav_item_hover_color' => '#FFD417',
				'nav_item_hover_bg' => '#111111',
				'nav_sub_bg' => '#111111',
				'nav_sub_item_color' => '#FFD417',
				'nav_sub_item_hover_color' => '#FFFFFF',
				'nav_sub_item_hover_bg' => '#1b0d1d',
				'topbar_bg' => '#FFF',
				'header_heading_color' => '#FFFFFF',
				'header_contact_color' => '#FFFFFF',
				'header_contact_icon_color' => '#FFD417',
				'header_secondary_menu_color' => '#FFFFFF',
				'header_secondary_menu_hover_color' => '#FFD417',
				'search_icon_bg' => '#111111',
				'search_icon_color' => '#FFD417',
				'search_icon_hover_bg' => '#ca383a',
				'search_icon_hover_color' => '#FFFFFF',
				'search_icon_text_color' => 'rgba(255, 255, 255, 0.5)',
				'link_color' => '#000',
				'link_hover_color' => '#ff00ff',
				'btn_bg' => '#ca383a',
				'btn_color' => '#fff',
				'btn_hover_bg' => '#FFD417',
				'btn_hover_color' => '#111',				
				'gradient_color_start' => '#360033',
				'gradient_color_end' => '#0b8793',
				'gradient_opacity' => '0.65',
				'other_color' => '#f0ad4e',
				'custom_css' => ''
			),
			array(
				'toplink_bg' => '#1f2667',
				'toplink_text_color' => '#FFF0F0',
				'toplink_icons_color' => '#FF00F0',
				'toplink_icons_hover_color' => '#000',
				'nav_bg' => '#999',
				'nav_item_color' => '#111111',
				'nav_item_hover_color' => '#FFF',
				'nav_item_hover_bg' => '#000',
				'nav_sub_bg' => '#FF0000',
				'nav_sub_item_color' => '#FFF',
				'nav_sub_item_hover_color' => '#000',
				'nav_sub_item_hover_bg' => '#333',
				'topbar_bg' => '#002E5A', 
				'header_heading_color' => '#000',
				'header_contact_color' => '#FF00F0',
				'header_contact_icon_color' => '#FFFFF0',
				'header_secondary_menu_color' => '#000',
				'header_secondary_menu_hover_color' => '#FFF',
				'search_icon_bg' => '#111111',
				'search_icon_color' => '#000',
				'search_icon_hover_bg' => '#fff',
				'search_icon_hover_color' => '#FF0000',
				'search_icon_text_color' => '#111',
				'link_color' => '#000',
				'link_hover_color' => '#ff00ff',
				'btn_bg' => '#ca383a',
				'btn_color' => '#fff',
				'btn_hover_bg' => '#FFD417',
				'btn_hover_color' => '#111',
				'gradient_color_start' => '#000',
				'gradient_color_end' => '#FFF',
				'gradient_opacity' => '0.65',
				'other_color' => '#f0ad4e',
				'custom_css' => ''
			),
			array()
		);
		
	return isset($settings[$preset]) ? $settings[$preset] : array();
}

/**
 * Get sidebar setting for a particular page
 */
function felis_get_theme_sidebar_setting(){
    $sidebar = '';
    
    if(is_404()){
        $sidebar = 'hidden';
    } elseif(is_home() || is_archive() || is_search()){
        $sidebar = Cactus::getOption('archive_sidebar', 'right');
    } elseif(is_page()){
        $sidebar = Cactus::getOption('page_sidebar', 'right');
    } else {
        $sidebar = Cactus::getOption('single_sidebar', 'right');
    }
    
    return apply_filters('cactus_sidebar_setting', $sidebar);
}


/**
 * Get header background URL of a page
 */
function felis_get_header_background_url(){
	$header_bg = Cactus::getOption('default_header_background');
	
	if(isset($header_bg['background-image']) && $header_bg['background-image'] != ''){
		return $header_bg['background-image'];
	} else {
		return get_parent_theme_file_uri('/images/page-header-bg-default.jpg');
	}
}
