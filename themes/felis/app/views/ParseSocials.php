<?php

/**
 * Class CT_Social_V
 *
 * @since Cactus Alpha 1.0
 * @package cactus
 */

namespace App\Views;

use App\Models\Entity;

class ParseSocials {
	private $model;

	public function __construct() {
		$this->model = Entity\Social::getInstance();
	}

	/**
	 * Render Social Account Buttons
	 */
	public function renderSocialAccounts( $echo = true, $is_widget = false ) {
		$default_accounts = $this->model->getDefaultSocialAccounts();
		$custom_accounts  = $this->model->getCustomSocialAccounts();
		$target           = $this->model->getTargetOpenSocial();
		$social_wrap_class = 'icon-social list-inline';
		$social_class = 'social-icons';

		if($is_widget == true){
			$social_wrap_class = 'icon-social widget-style';
			$social_class = '';
		}

			// count number of icons
		$count = 0;

		$html = "";

		$html .= "<ul class='$social_wrap_class'>";

		foreach ($default_accounts as $key => $value) {

			$social_url = $this->model->getOption($key, '');
			$label      = $this->model->getLabel($key);

			if($is_widget == true){
				$social_class = "icon-$key";
			}

			if ($social_url) {
				if ($key == 'envelope') {
					$social_url = 'mailto:' . $social_url;
				}

				$html .= "<li>";

				if($is_widget == true){
					$html .= '<div class="social-icons icon-' . esc_attr($key) . '"><i class="fa fa-' . esc_attr($key) . '" aria-hidden="true"></i></div>';
				}

				$html .= '<a class="'.esc_attr($social_class).'" target="' . esc_attr($target) . '" href="' . esc_url($social_url) . '" title="' . esc_attr($label) . '">';

				if($is_widget == false){
					$html .= '<i class="fa fa-' . esc_attr($key) . '" aria-hidden="true"></i>';
				}else{
					$html .= esc_html($label);
				}

				$html .= '</a>';

				$html .= '</li>';

				$count++;
			}

		}

		if ($custom_accounts) {
			foreach ($custom_accounts as $value) {
				$custom_accounts_class = 'social-icons';

				$html .= "<li " . ((isset( $show_class ) && $show_class == true) ? 'class="custom-' . esc_attr($value['icon_custom_social_account']) . '"' : '') . ">";

				if($is_widget == true){
					$custom_accounts_class = 'icon-title-custom';
					$html .= '<div class="social-icons icon-custom icon-custom-' . strtolower(esc_attr($value["title"])) . '"><i class="fa ' . esc_attr($value["icon_custom_social_account"]) . '" aria-hidden="true"></i></div>';
				}

				$html .= '<a class="'.esc_attr($custom_accounts_class).'" target="' . esc_attr($target) . '" href="' . esc_url($value["url_custom_social_account"]) . '" title="' . esc_attr($value["title"]) . '">';

				if($is_widget == false){
					$html .= '<i class="fa fa ' . esc_attr($value["icon_custom_social_account"]) . '" aria-hidden="true"></i>';
				}else{
					$html .= esc_html($value["title"]);
				}

				$html .= '</a>';

				$html .= '</li>';

				$count++;
			}
		} 

		$html .= '</ul>';

		if(!$count) $html = '';

		if($echo) echo wp_kses( $html, array(
				'ul' => array( 'class' => array() ),
				'li' => array( 'class' => array() ),
				'a' => array(
					'href' => array(),
					'title' => array(),
					'rel' => array(),
					'onclick' => array(),
					'target' => array(),
					),
				'i'=> array( 'class' => array(), 'aria-hidden' => array()),
				'div' => array( 'class' => array() )
				) );

		else return $html;
	}

	/**
	 * Render Social Share Button
	 *
	 * @param bool|false $id
	 */
	public function renderSocialShare($id = false, $echo = true, $style = 1, $schema = 'dark', $position = 'fixed' ) {
		$url_share = ( isset( $_SERVER['HTTPS'] ) ? "https" : "http") . "://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."";
		if ( is_home() ) {
			$title_share = urlencode( get_bloginfo( 'name' ) );
		} else {
			$title_share = urlencode( wp_title( '', false, '' ) );
		}
		
		if ( !$id ) {
			$id = get_the_id();
		}

		$html = '';

		if ($this->model->getOption('sharing_facebook') == 'on') {
			$html .= '<li>
			<a class="social-icons icon-facebook"
			title="' . esc_html__('Share on Facebook', 'felis') . '"
			href="#" target="_blank" rel="nofollow" onclick="window.open(\'https://www.facebook.com/sharer/sharer.php?u=\' + \'' . $url_share . '\',\'facebook-share-dialog\',\'width=626,height=436\');return false;">
			<i class="fa fa-facebook"></i>
			</a>
			</li>';
		}

		if ($this->model->getOption('sharing_twitter') == 'on') {
			$html .= '<li>
			<a class="social-icons icon-twitter"
			href="#"
			title="' . esc_html__('Share on Twitter', 'felis') . '"
			rel="nofollow" target="_blank"
			onclick="window.open(\'http://twitter.com/share?text='. $title_share .'&amp;url=' . $url_share . '\',\'twitter-share-dialog\',\'width=626,height=436\');return false;">
			<i class="fa fa-twitter"></i>
			</a>
			</li>';
		}

		if ($this->model->getOption('sharing_linkedIn') == 'on') {
			$html .= '<li>
			<a class="social-icons icon-linkedin"
			href="#"
			title="' . esc_html__('Share on LinkedIn', 'felis') . '"
			rel="nofollow" target="_blank"
			onclick="window.open(\'http://www.linkedin.com/shareArticle?mini=true&url='. $url_share .'&amp;title=' . $title_share . '&amp;source=' . urlencode(get_bloginfo('name')) . '\',\'linkedin-share-dialog\',\'width=626,height=436\');return false;">
			<i class="fa fa-linkedin"></i>
			</a>
			</li>';
		}

		if ($this->model->getOption('sharing_tumblr') == 'on') {
			$html .= '<li>
			<a class="social-icons icon-tumblr"
			href="#"
			title="' . esc_html__('Share on Tumblr', 'felis') . '"
			rel="nofollow"
			target="_blank"
			onclick="window.open(\'http://www.tumblr.com/share/link?url='. $url_share . '&amp;name=' . $title_share . '\',\'tumblr-share-dialog\',\'width=626,height=436\');return false;">
			<i class="fa fa-tumblr"></i>
			</a>
			</li>';
		}

		if ($this->model->getOption('sharing_google') == 'on') {
			$html .= '<li>
			<a class="social-icons icon-google-plus"
			href="#"
			title="' . esc_html__('Share on Google Plus', 'felis') . '"
			rel="nofollow"
			target="_blank"
			onclick="window.open(\'https://plus.google.com/share?url='. $url_share .'\',\'googleplus-share-dialog\',\'width=626,height=436\');return false;">
			<i class="fa fa-google-plus"></i>
			</a>
			</li>';
		}

		if ( $this->model->getOption('sharing_pinterest') == 'on' ) {
			$html .= '<li>
			<a class="social-icons icon-pinterest"
			href="#"
			title="' . esc_html__('Pin this', 'felis') . '"
			rel="nofollow"
			target="_blank"
			onclick="window.open(\'//pinterest.com/pin/create/button/?url='.$url_share. '&amp;media=' . urlencode(wp_get_attachment_url(get_post_thumbnail_id($id))) . '&amp;description=' .$title_share . '\',\'pin-share-dialog\',\'width=626,height=436\');return false;">
			<i class="fa fa-pinterest"></i>
			</a>
			</li>';
		}

		if ( $this->model->getOption('sharing_email') == 'on' ) {
			$html .= '<li>
			<a class="social-icons icon-envelope"
			href="mailto:?subject='. wp_title() .'&amp;body='. $url_share . '"
			title="' . esc_html__('Email this', 'felis') . '">
			<i class="fa fa-envelope"></i>
			</a>
			</li>';
		}

		if ( $html != '' ) {
			if ( $style == 2 ) {
				$class = 'style-13-group social-left '.$schema.' '.$position;
			} else {
				$class = 'list-inline article-social-share social-list-btn';
			}
			$html = '<ul class="'.$class.'">' . $html . '</ul>';
		}

		if ( $echo ) {
			echo wp_kses( $html, array(
				'ul' => array( 'class' => array() ),
				'li' => array( 'class' => array() ),
				'a' => array(
					'href' => array(),
					'title' => array(),
					'rel' => array(),
					'onclick' => array(),
					'target' => array(),
					),
				'i'=> array( 'class' => array() )
				) );
		} else {
			return $html;
		}

	}
}