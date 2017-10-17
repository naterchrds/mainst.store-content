<?php

    /**
     * Class ParseHead
     *
     * @since Cactus Alpha 1.0
     * @package cactus
     */

    namespace App\Views;

    class ParseHead
    {
        public function __construct()
        {

        }
		
		/**
		 * Print page meta tags 
		 */
		public static function meta_tags(){
			$description = get_bloginfo('description');
    
			$meta_tags_html = '';
			if(is_single()){
				global $post;
				
				$post_format	= get_post_format($post->ID) != '' && get_post_format($post->ID) == 'video'  ? 'video.movie' : 'article' ;
				$post_url = get_permalink($post->ID);

				$description = $post->post_excerpt;
				if($description == '')
					$description = substr(strip_tags($post->post_content), 0,165);
				
				$thumbnail_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));

				$meta_tags_html .= '<meta property="og:image" content="' . esc_attr($thumbnail_url) . '"/>';
				$meta_tags_html .= '<meta property="og:title" content="' . esc_attr(get_the_title($post->ID)) . '"/>';
				$meta_tags_html .= '<meta property="og:url" content="' . esc_url($post_url) . '"/>';
				$meta_tags_html .= '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '"/>';
				$meta_tags_html .= '<meta property="og:type" content="' . esc_attr($post_format) . '"/>';
				$meta_tags_html .= '<meta property="og:description" content="' . esc_attr(strip_shortcodes($description)) . '"/>';
				$meta_tags_html .= '<meta property="fb:app_id" content="' . \App\Cactus::getOption('facebook_app_id') . '" />';
				
				// Meta for twitter
				$meta_tags_html .= '<meta name="twitter:card" content="summary" />';
				$meta_tags_html .= '<meta name="twitter:site" content="@' . esc_attr(get_bloginfo('name')) . '" />';
				$meta_tags_html .= '<meta name="twitter:title" content="' . esc_attr(get_the_title($post->ID)) . '" />';
				$meta_tags_html .= '<meta name="twitter:description" content="' . esc_attr(strip_shortcodes($description)) . '" />';
				$meta_tags_html .= '<meta name="twitter:image" content="' . esc_attr($thumbnail_url) . '" />';
				$meta_tags_html .= '<meta name="twitter:url" content="' . esc_url(get_permalink($post->ID)) . '" />';
				
				global $_wp_additional_image_sizes;
			
				$width = 696;
				$height = 391;

				if(isset($_wp_additional_image_sizes['thumbnail'])){
					$width = $_wp_additional_image_sizes[ 'thumbnail' ]['width'];
					$height = $_wp_additional_image_sizes[ 'thumbnail' ]['height'];
				}
				
				$logo = \App\Cactus::getOption('logo_image');


			}

			$meta_tags_html .= ' <meta name="description" content="' . esc_attr(strip_shortcodes($description)) . '" />';
			$meta_tags_html .= '<meta name="generator" content="' . esc_attr(esc_html__('Powered by felis - A powerful multi-purpose theme by CactusThemes', 'felis')) . '" />';
			echo apply_filters('felis-meta-tags', $meta_tags_html);
			
			do_action('felis-meta-tags');
		}
    }