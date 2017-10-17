<?php

    /* Get Theme Options here and echo custom CSS */

    /**
     * Class CustomCSS
     */

    if ( ! function_exists('felis_custom_CSS')) {

        function felis_custom_CSS()
        {
            
            $cactus   = new App\Cactus();
            $typography = new App\Models\Entity\Typography();
            
            // background
            $background = $cactus->getOption('background');

            //Color
			$site_custom_colors = $cactus->getOption('site_custom_colors', 'off');
			$header_custom_colors = $cactus->getOption('header_custom_colors', 'off');
			$mask_custom_colors = $cactus->getOption('mask_custom_colors', 'off');
			
			$custom_css = '';
			
			$nav_bg = '';
			$nav_item_color = '';
			$nav_item_hover_color = '';
			$nav_item_hover_bg = '';
			$nav_sub_bg = '';
			$nav_sub_item_color = '';
			$nav_sub_item_hover_color = '';
			$nav_sub_item_hover_bg = '';
			$header_heading_color = '';
			$header_secondary_menu_color = '';
			$header_secondary_menu_hover_color = '';
			$search_icon_bg = '';
			$search_icon_color = '';
			$search_icon_hover_bg = '';
			$search_icon_hover_color = '';
			$search_icon_text_color = '';
			$nav_item_current_bg = '';
			$nav_item_current_color = '';

			$link_color = '';
			$link_hover_color = '';


			$gradient_color_start = '';
			$gradient_color_end = '';
			$gradient_mask_opacity = '';
			$gradient_color_deg = '';

			if($header_custom_colors == 'on' || (is_page() && get_post_meta(get_the_ID(), 'header_colors', true) == 'on')){
				$nav_item_color = $cactus->getOption('nav_item_color', '');
				$nav_item_hover_color = $cactus->getOption('nav_item_hover_color', '');
				$nav_item_hover_bg = $cactus->getOption('nav_item_hover_bg', '');
				$nav_sub_bg = $cactus->getOption('nav_sub_bg', '');
				$nav_sub_item_color = $cactus->getOption('nav_sub_item_color', '');
				$nav_sub_item_hover_color = $cactus->getOption('nav_sub_item_hover_color', '');
				$nav_sub_item_hover_bg = $cactus->getOption('nav_sub_item_hover_bg', '');
				$header_heading_color = $cactus->getOption('header_heading_color', '');
				$header_contact_color = $cactus->getOption('header_contact_color', '');
				$header_contact_icon_color = $cactus->getOption('header_contact_icon_color', '');
				$header_secondary_menu_color = $cactus->getOption('header_secondary_menu_color', '');
				$header_secondary_menu_hover_color = $cactus->getOption('header_secondary_menu_hover_color', '');
				$search_icon_bg = $cactus->getOption('search_icon_bg', '');
				$search_icon_color = $cactus->getOption('search_icon_color', '');
				$search_icon_hover_bg = $cactus->getOption('search_icon_hover_bg', '');
				$search_icon_hover_color = $cactus->getOption('search_icon_hover_color', '');
				$search_icon_text_color = $cactus->getOption('search_icon_text_color', '');
				$nav_bg = $cactus->getOption('nav_bg', '');
				$nav_item_current_bg = $cactus->getOption('nav_item_current_bg', '');;
				$nav_item_current_color = $cactus->getOption('nav_item_current_color', '');;
			}
			
			// custom color
			if($site_custom_colors == 'on'){
				$link_color = $cactus->getOption('link_color', '');
				$link_hover_color = $cactus->getOption('link_hover_color', '');
				$btn_bg = $cactus->getOption('btn_bg', '');
				$btn_color = $cactus->getOption('btn_color', '');
				$btn_hover_bg = $cactus->getOption('btn_hover_bg', '');
				$btn_hover_color = $cactus->getOption('btn_hover_color', '');
				$color_secondary = $cactus->getOption('color_secondary', '');
				
			}

			if ( $mask_custom_colors == 'on' ) {
				$gradient_color_start = $cactus->getOption('gradient_color_start', '');
				$gradient_color_end = $cactus->getOption('gradient_color_end', '');
				$gradient_mask_opacity = $cactus->getOption('gradient_opacity', '');
				$gradient_color_deg = $cactus->getOption('gradient_color_deg', '0');

				if ($gradient_color_start != '' && $gradient_color_end != '' && $gradient_mask_opacity != '') {
					$custom_css .= '.mask, .text-gradient h1, .text-gradient .h1, .text-gradient h2, .text-gradient .h2, .text-gradient h3, .text-gradient .h3, .text-gradient h4, 
					.text-gradient .h4, .text-gradient h5, .text-gradient .h5, .text-gradient h6, .text-gradient .h6, 
					.cart-count, .c-slider_wrap.post-slider .c-slider__inner .slick-dots li.slick-active button, .bg-gradient:before, .bg-gradient, .c-icon-box.backgorund_box:after, .woocommerce input[type="submit"].button, .post .sticky-post,
					.site-header.style-1 .main-navigation .main-menu .main-navbar > li ul.sub-menu:before, .line-top:before, #comments.comments-area.style-2 #respond.comment-respond .comment-form .form-submit #submit, .site-header .main-navigation .search-navigation .search-main-menu,
					.site-header .main__menu.sticky .main-navigation .main-menu ul.main-navbar ul.sub-menu:before{
						background-color: ' . $gradient_color_start . ' !important;
						background: -webkit-gradient('.$gradient_color_deg.'deg, from(' . $gradient_color_start . '), to(' . $gradient_color_end . ') ) !important;
						background: -webkit-linear-gradient('.$gradient_color_deg.'deg, ' . $gradient_color_start . ', ' . $gradient_color_end . ') !important;
						background: -moz-linear-gradient('.$gradient_color_deg.'deg, ' . $gradient_color_start . ', ' . $gradient_color_end . ') !important;
						background: -ms-linear-gradient('.$gradient_color_deg.'deg, ' . $gradient_color_start . ', ' . $gradient_color_end . ') !important;
						background: -o-linear-gradient('.$gradient_color_deg.'deg, ' . $gradient_color_start . ', ' . $gradient_color_end . ') !important;
						opacity: ' . $gradient_mask_opacity . ';
					}';

					$custom_css .= '.text-gradient h1, .text-gradient .h1, .text-gradient h2, .text-gradient .h2, .text-gradient h3, .text-gradient .h3, .text-gradient h4, 
					.text-gradient .h4, .text-gradient h5, .text-gradient .h5, .text-gradient h6, .text-gradient .h6, .c-slider_wrap.post-slider .c-slider__inner .slick-dots li.slick-active button { -webkit-background-clip: text!important; }';

					$custom_css .= '.c-testimonials .detail:before { 
						background-color: ' . $gradient_color_start . ';
						background: -webkit-gradient(90deg, from(' . $gradient_color_start . '), to(' . $gradient_color_end . ') ) ;
						background: -webkit-linear-gradient(90deg, ' . $gradient_color_start . ', ' . $gradient_color_end . ') ;
						background: -moz-linear-gradient(90deg, ' . $gradient_color_start . ', ' . $gradient_color_end . ') ;
						background: -ms-linear-gradient(90deg, ' . $gradient_color_start . ', ' . $gradient_color_end . ') ;
						background: -o-linear-gradient(90deg, ' . $gradient_color_start . ', ' . $gradient_color_end . ') ;
						opacity: ' . $gradient_mask_opacity . ';
					}';

				}
			}
			
			if($nav_bg != ''){
				$custom_css .= '.site-header.style-1 .main-navigation {background-color:' . $nav_bg . ' !important}';
			}
			
			if($nav_item_color != ''){
				$custom_css .= '.site-header.style-1 .main-navigation .main-menu ul li a {color:' . $nav_item_color . '}';
			}
			
			if($nav_item_hover_color != ''){					
				$custom_css .= '.site-header.style-1 .main-navigation .main-menu ul li a:hover {color:' . $nav_item_hover_color . '}';
			}
			
			if($nav_item_hover_bg != ''){					
				$custom_css .= '.site-header.style-1 .main-navigation .main-menu .main-navbar > li:hover > a{background-color:' . $nav_item_hover_bg . '}';
			}
			
			if($nav_item_current_bg != ''){
				$custom_css .= '.site-header.style-1 .main-navigation .main-menu .navbar-nav > li.current-menu-item > a{background-color: ' . $nav_item_current_bg . '}';
			}
			
			if($nav_item_current_color != ''){
				$custom_css .= '.site-header.style-1 .main-navigation .main-menu .navbar-nav > li.current-menu-item > a{color: ' . $nav_item_current_color . '}';
			}
			
			if($nav_sub_bg != ''){
				$custom_css .= '.site-header.style-1 .main-navigation .main-menu ul li:hover > ul.sub-menu  li a{background-color:' . $nav_sub_bg . '}';
			}		

			if($nav_sub_item_color != ''){					

				$custom_css .= '.site-header.style-1 .main-navigation .main-menu ul li:hover > ul.sub-menu li a{color:' . $nav_sub_item_color . '}';
			}
			
			if($nav_sub_item_hover_color != ''){
				$custom_css .= '.site-header.style-1 .main-navigation .main-menu ul li:hover > ul.sub-menu li a:hover{color:' . $nav_sub_item_hover_color . '}';
			}
			
			if($nav_sub_item_hover_bg != ''){					
				$custom_css .= '.site-header.style-1 .main-navigation .main-menu ul li:hover > ul.sub-menu li a:hover{background-color:' . $nav_sub_item_hover_bg . '}';

			}
			
			if($header_heading_color != ''){
				$custom_css .= '.c-page-header .c-page-header__inner .c-page-header__title h1{color:' . $header_heading_color . '}';
			}

			$sticky_background = $cactus->getOption('sticky_background', '');
			if($sticky_background != ''){
				$custom_css .= '.site-header .main__menu.sticky .main-navigation {background-color: ' . $sticky_background . ' !important}';
			}
						


			if($link_color != ''){
				$custom_css .= 'a {color:' . $link_color . '}';
				
				//$custom_css .= '.c-wrapper .c-mobile-navigation .c-mobile-navigation__inner .mobile-main-menu ul li .panel-heading{border-bottom-color: ' . $link_color. '}';
			}
			
			if($link_hover_color != ''){
				$custom_css .= 'a:hover, a:focus, a a:active {color:' . $link_hover_color . '}';
			}
			
			
			if($cactus->getOption('font_using_custom', 'off') == 'on'){
				// Custom Fonts

				//Google Font
				$main_google_font = $cactus->getOption('main_font_on_google', 'off');

				$mainFontFamily       = $typography->getMainFontFamily();
				$headingFontFamily    = $typography->getHeadingFontFamily();
				$mainNavigationFont = $typography->getNavigationFontFamily();

				//Line Height
				$main_line_height  = $cactus->getOption('main_font_line_height', 1.7);

				$h1_line_height    = $cactus->getOption('h1_line_height', 1.5);
				$h2_line_height    = $cactus->getOption('h2_line_height', 1.5);
				$h3_line_height    = $cactus->getOption('h3_line_height', 1.5);
				$h4_line_height    = $cactus->getOption('h4_line_height', 1.5);
				$h5_line_height    = $cactus->getOption('h5_line_height', 1.5);
				$h6_line_height    = $cactus->getOption('h6_line_height', 1.5);
				
				$h1_font_weight    = $cactus->getOption('h1_font_weight', 900);
				$h2_font_weight    = $cactus->getOption('h2_font_weight', 900);
				$h3_font_weight    = $cactus->getOption('h3_font_weight', 900);
				$h4_font_weight    = $cactus->getOption('h4_font_weight', 600);
				$h5_font_weight    = $cactus->getOption('h5_font_weight', 600);
				$h6_font_weight    = $cactus->getOption('h6_font_weight', 500);
				
				$meta_font_line_height = $cactus->getOption('meta_font_line_height');

				//Font Size
				$mainFontFamily_size       = $cactus->getOption('main_font_size', 14);
				$h1_size    = $cactus->getOption('heading_font_size_h1', 47);
				$h2_size    = $cactus->getOption('heading_font_size_h2', 35);
				$h3_size    = $cactus->getOption('heading_font_size_h3', 24);
				$h4_size    = $cactus->getOption('heading_font_size_h4', 18);
				$h5_size    = $cactus->getOption('heading_font_size_h5', 16);
				$h6_size    = $cactus->getOption('heading_font_size_h6', 14);
				
				$custom_font_1 = $cactus->getOption('custom_font_1', '');
				$custom_font_2 = $cactus->getOption('custom_font_2', '');
				$custom_font_3 = $cactus->getOption('custom_font_3', '');

				//Font Wwight
				$main_font_weight = $cactus->getOption('main_font_weight', 'normal');

				/**
				 * Main Font Family
				 */
				if ($mainFontFamily != '') {
					$mainFontName = $typography->getGoogleFontName($mainFontFamily);

					$texts        = preg_split('/&/', $mainFontName);
					if (count($texts) > 1) {
						$mainFontName = $texts[0];
					}
					if ($mainFontName != '') {
						
						$custom_css .= '
							body{
								font-family: ' . esc_html($mainFontName) . ', serif;
							}';
					};
				}

				/**
				 * Main Font Weight
				 */
				if ($main_font_weight != '' && $main_font_weight != 'normal') {
					$custom_css .= '
						body{
							font-weight: ' . esc_html($main_font_weight) . ';
						}';
				}
				
				if($mainFontFamily_size != 14){
					$custom_css .= 'body {font-size: ' . $mainFontFamily_size . 'px}';
				}
				
				if($main_line_height != 1.7){
					$custom_css .= 'body{line-height: ' . $main_line_height . 'em}';
				}				

				/**
				 * Heading Font Family
				 */
				if ($headingFontFamily != '') {
					$headingFontName = $typography->getGoogleFontName($headingFontFamily);
					$texts           = preg_split('/&/', $headingFontName);
					if (count($texts) > 1) {
						$headingFontName = $texts[0];
					}
					if ($headingFontName != '') {

						$custom_css .= '
							h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6,
							h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, .h1 a, .h2 a, .h3 a, .h4 a, .h5 a, .h6 a
							{
								font-family: ' . esc_html($headingFontName) . ', serif;
							}';
					}
				}
				
				if($h1_size != 47){
					$custom_css .= 'h1, .h1{font-size: ' . $h1_size . 'px}';
				}
				
				if($h1_line_height != 1.4){
					$custom_css .= 'h1, .h1{line-height: ' . $h1_line_height . 'em}';
				}
				
				if($h1_font_weight != 900){
					$custom_css .= 'h1, .h1{font-weight: ' . $h1_font_weight . '}';
				}
				
				if($h2_size != 35){
					$custom_css .= 'h2, .h2{font-size: ' . $h2_size . 'px}';
				}
				
				if($h2_line_height != 1.4){
					$custom_css .= 'h2, .h2{line-height: ' . $h2_line_height . 'em}';
				}
				
				if($h2_font_weight != 900){
					$custom_css .= 'h2, .h2{font-weight: ' . $h2_font_weight . '}';
				}
				
				if($h3_size != 24){
					$custom_css .= 'h3, .h3{font-size: ' . $h3_size . 'px}';
				}
				
				if($h3_line_height != 1.4){
					$custom_css .= 'h3, .h3{line-height: ' . $h3_line_height . 'em}';
				}
				
				if($h3_font_weight != 900){
					$custom_css .= 'h3, .h3{font-weight: ' . $h3_font_weight . '}';
				}
				
				if($h4_size != 18){
					$custom_css .= 'h4, .h4{font-size: ' . $h4_size . 'px}';
				}
				
				if($h4_line_height != 1.4){
					$custom_css .= 'h4, .h4{line-height: ' . $h4_line_height . 'em}';
				}
				
				if($h4_font_weight != 600){
					$custom_css .= 'h4, .h4{font-weight: ' . $h4_font_weight . '}';
				}
				
				if($h5_size != 16){
					$custom_css .= 'h5, .h5{font-size: ' . $h5_size . 'px}';
				}
				
				if($h5_line_height != 1.4){
					$custom_css .= 'h5, .h5{line-height: ' . $h5_line_height . 'em}';
				}
				
				if($h5_font_weight != 600){
					$custom_css .= 'h5, .h5{font-weight: ' . $h5_font_weight . '}';
				}
				
				if($h6_size != 14){
					$custom_css .= 'h6, .h6{font-size: ' . $h6_size . 'px}';
				}
				
				if($h6_line_height != 1.4){
					$custom_css .= 'h6, .h6{line-height: ' . $h6_line_height . 'em}';
				}
				
				if($h6_font_weight != 600){
					$custom_css .= 'h6, .h6{font-weight: ' . $h6_font_weight . '}';
				}
				
				if($mainNavigationFont != ''){
					$custom_css .= '.main-navigation a{font-family: ' . esc_html($mainNavigationFont) . '}';
				}
				
				$mainNavigationFontSize = $cactus->getOption('navigation_font_size', 18);
				
				if($mainNavigationFontSize != 18){
					$custom_css .= '.main-navigation #menu-main-menu a, .main-navigation #menu-main-menu ul li:hover > ul li a {font-size: ' . $mainNavigationFontSize . 'px}';
				}
				
				$navigation_font_weight = $cactus->getOption('navigation_font_weight', 400);
				
				if($navigation_font_weight != 400){
					$custom_css .= '.main-navigation #menu-main-menu a{font-weight: ' . $navigation_font_weight . '}';
				}
				
				/**
				 * Custom Font 1
				 */
				if ($custom_font_1 != '') {
					$custom_css .= '
						@font-face {
							font-family: "custom_font_1";
							src: url(' . esc_url($custom_font_1) . ');
						}';
				}

				/**
				 * Custom Font 2
				 */
				if ($custom_font_2 != '') {
					$custom_css .= '
						@font-face {
							font-family: "custom_font_2";
							src: url(' . esc_url($custom_font_2) . ');
						}';
				}

				/**
				 * Custom Font 3
				 */
				if ($custom_font_3 != '') {
					$custom_css .= '
						@font-face {
							font-family: "custom_font_3";
							src: url(' . esc_url($custom_font_3) . ');
						}';
				}
			}
			
			$custom_css .= apply_filters('cactus_default_fonts_css', ''); 

			if(isset($background['background-color']) || isset($background['background-image'])){  
				$bg_css = \App\Helpers\Common::getBackgroundCSS($background);
				$custom_css .= 'body, #page, #content{' . $bg_css . '}';
			}

			
			$footer_background = $cactus->getOption( 'footer_background', '' );
			$footer_heading_color = $cactus->getOption( 'footer_heading_color', '' );
			$footer_text_color = $cactus->getOption( 'footer_text_color', '' );
			$footer_link_color = $cactus->getOption( 'footer_link_color', '' );
			$footer_link_hover_color = $cactus->getOption( 'footer_link_hover_color', '' );



			if ( isset($footer_background['background-color']) || isset($footer_background['background-image'] ) ){  
				$bg_css = \App\Helpers\Common::getBackgroundCSS($footer_background);
				$custom_css .= '.site-footer{' . $bg_css . '}';
			}

			if ( $footer_heading_color != '' ) {
				$custom_css .= '.site-footer .widget-title h4.heading, .site-footer .widget-title h4.heading a { color:' . $footer_heading_color . '!important }';
				$custom_css .= '.site-footer .subscribe_form .wpcf7-submit { background-color:' . $footer_heading_color . '}';
				$custom_css .= '.site-footer .subscribe_form .wpcf7-email { border-color:' . $footer_heading_color . '}';
			}

			if ( $footer_text_color != '' ) {
				$custom_css .= '.site-footer .widget p, .site-footer .widget i, .site-footer .widget.widget_search label:after { color:' . $footer_text_color . '!important }';
				$custom_css .= '.site-footer .widget ul li  { border-color:' . $footer_text_color . '!important; color:' . $footer_text_color . '!important }';
				$custom_css .= '.site-footer .widget .search-field { border-color:' . $footer_text_color . ' !important; color:' . $footer_text_color . ' !important }';
				$custom_css .= '.site-footer .subscribe_form .wpcf7-email { color:' . $footer_text_color . ' !important; }';
			}

			if ( $footer_link_color != '' ) {
				$custom_css .= '.site-footer .widget a, .site-footer .widget ul li a { color:' . $footer_link_color . '!important }';
				$custom_css .= '.site-footer .widget, .site-footer .amount { color:' . $footer_link_color . '!important }';
			}

			if ( $footer_link_hover_color != '' ) {
				$custom_css .= '.site-footer .widget a:hover { color:' . $footer_link_hover_color . '!important }';
			}
			
			
			


			// $footer_schema = $cactus->getOption('footer_schema', '');
			
			if($cactus->getOption('post_edit_link', 'off') == 'off'){
				$custom_css .= '#content .edit-link{display: none}';
			}

			/**
         		* retina logo process
         	*/
			$retina_logo = $cactus->getOption( 'retina_logo_image', '' );
			
			if($retina_logo != ''){
				$custom_css .= 
					'@media only screen and (-webkit-min-device-pixel-ratio: 2),(min-resolution: 192dpi) {
						/* Retina Logo */
						.wrap_branding a.logo{background:url(' . esc_url($retina_logo) . ') no-repeat center; background-size:contain;}
						.wrap_branding a.logo img{ opacity:0; visibility:hidden}
					}';
			}
			

            return $custom_css;

        }
    }