<?php

    /**
     * Class ParseAuthor
     */

    namespace App\Views;
	
	use App\Cactus;

    class ParseAuthor
    {

        /**
         * Get Author Avatar
         *
         * @author
         *
         * @since Cactus Alpha 1.0
         * @package cactus
         */

        public function __construct()
        {

        }

        public function renderAuthorAvatar($ID = false, $size = 80, $echo = true)
        {
            global $post;

            $user_avatar = false;
            $email       = '';

            if ($ID == false) {
                $ID    = get_the_author_meta('ID');
                $email = get_the_author_meta('email');
            } else {
                $email = get_the_author_meta('email', $ID);
            }

            $user_avatar = get_avatar($email, $size);

            if($echo){
                echo wp_kses($user_avatar, array('img' => array('alt' => array(), 'src' => array(), 'srcset' => array(),'class' => array(), 'width'  => array(), 'height' => array())));
            } else {
                return $user_avatar;
            }
        }
		
		/**
         * Render Social Account Buttons
         */
        public function renderSocialAccounts( $user_id, $echo = true )
        {
			$default_accounts = \App\Plugins\Cactus_Author\Author::getDefaultAccounts();
			
			// count number of icons
			$count = 0;
			
			$html = "";
			
			$html .= "<ul class='icon-social list-inline'>";

            foreach($default_accounts as $key => $title){
				$url = get_the_author_meta( $key, $user_id);
				
				if($url){
					
					$html .= '<li class="' . esc_attr($key) . '"><a rel="nofollow" href="' . esc_url($url) . '" title="' .$title . '"><i class="fa fa-'. esc_attr($key) . '"></i></a></li>';
					$count++;
				}
			}
			
			if($custom_acc = get_the_author_meta('cactus_account', $user_id)){
				foreach($custom_acc as $acc){
					if($acc['icon'] || $acc['url']){
						
						$html .= '<li class="cactus_account custom-account-'. sanitize_title(@$acc['title']) . '"><a rel="nofollow" href="'. esc_attr(@$acc['url']) . '" title="' . esc_attr(@$acc['title']) . '"><i class="fa '. esc_attr(@$acc['icon']) . '"></i></a></li>';
						$count++;
					}
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
								'i'=> array( 'class' => array() ),
								'div' => array( 'class' => array() )
								) );
			
			else return $html;
        }
    }