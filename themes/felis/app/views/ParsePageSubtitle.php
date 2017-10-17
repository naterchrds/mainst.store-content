<?php

	/**
	 * Class ParsePageSubtitle
	 *
	 * @since Cactus Alpha 1.0
	 * @package cactus
	 */

	namespace App\Views;
	
	use App\Cactus;

	class ParsePageSubtitle {

		public function __construct() {

		}

		public function render( $echo = 1, $auto_h = 1 ) {
			global $post;

			$subtitle = '';
			
			if ( is_single() && ! is_attachment() ) {
				$subtitle = Cactus::getOption( 'post_sub_title' );
			} else if ( is_singular( 'page' ) )  {
				$subtitle = Cactus::getOption( 'page_subtitle' );
			} else if ( is_home() ) {
				$subtitle = ( Cactus::getOption( 'blog_subtitle' ) != '' ) ? cactus::getOption( 'blog_subtitle' ) : get_bloginfo( 'description' );
			} else if ( is_search() ) {
				$felis_found_posts = felis_get_found_posts();

				if ( $felis_found_posts > 1 || $felis_found_posts == 0 ) {
					$count = sprintf( esc_html__('(%d results)', 'felis'), $felis_found_posts );
				} else {
					$count = sprintf( esc_html__('(%d result)', 'felis'), $felis_found_posts );
				}
				
				$subtitle = sprintf( wp_kses( __( 'Search result for "<i>%s</i>"', 'felis' ), array( 'i' => array() ) ), esc_html( get_search_query( false ) ) );
				$subtitle .= ' ' . $count;
			}

			$subtitle = apply_filters('cactus_page_subtitle', $subtitle );
			
			if ( $echo ) {
				echo wp_kses_post($subtitle);
			} else {
				return $subtitle;
			}
		}
	}
