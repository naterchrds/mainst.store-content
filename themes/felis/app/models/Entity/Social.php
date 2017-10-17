<?php

    /**
     * Social Class
     *
     * @package cactus
     */

    namespace App\Models\Entity;

    use App\Models;

    class Social extends Models\Metadata
    {
        private $default_accounts;

        private $custom_accounts;

        private $target;
        
        private static $instance;
		
        public static function getInstance(){
            if(null == self::$instance){
                self::$instance = new Social();
            }
            
            return self::$instance;
        }
        
        public static function initialize(){
            $instance = self::getInstance();
            add_action('init', array($instance, 'init'));
        }
        
        function init(){
            if(function_exists('ot_settings_id')){
                add_filter(ot_settings_id() . '_args', array($this, 'filter_theme_options'));
            }
        }
        
        /**
         * Return array of default Social Account settings in Theme Options
         */
        public function get_theme_option_account_args(){
            return array(
				array(
					'id'           => 'facebook',
					'label'        => esc_html__('Facebook', 'felis'),
					'desc'         => esc_html__('The custom URL to your Facebook profile page (Please include http://)', 'felis'),
					'std'          => '',
					'type'         => 'text',
					'section'      => 'social_account'
				),
				array(
					'id'           => 'twitter',
					'label'        => esc_html__('Twitter', 'felis'),
					'desc'         => esc_html__('The custom URL to your Twitter profile page (Please include http://)', 'felis'),
					'std'          => '',
					'type'         => 'text',
					'section'      => 'social_account'
				),
				array(
					'id'           => 'linkedin',
					'label'        => esc_html__('LinkedIn', 'felis'),
					'desc'         => esc_html__('The custom URL to your LinkedIn profile page (Please include http://)', 'felis'),
					'std'          => '',
					'type'         => 'text',
					'section'      => 'social_account'
				),
				array(
					'id'           => 'tumblr',
					'label'        => esc_html__('Tumblr', 'felis'),
					'desc'         => esc_html__('The custom URL to your Tumblr profile page (Please include http://)', 'felis'),
					'std'          => '',
					'type'         => 'text',
					'section'      => 'social_account'
				),
				array(
					'id'           => 'google-plus',
					'label'        => esc_html__('Google Plus', 'felis'),
					'desc'         => esc_html__('The custom URL to your Goolge Plus profile page (Please include http://)', 'felis'),
					'std'          => '',
					'type'         => 'text',
					'section'      => 'social_account'
				),
				array(
					'id'           => 'pinterest',
					'label'        => esc_html__('Pinterest', 'felis'),
					'desc'         => esc_html__('The custom URL to your Pinterest profile page (Please include http://)', 'felis'),
					'std'          => '',
					'type'         => 'text',
					'section'      => 'social_account'
				),
				array(
					'id'           => 'youtube',
					'label'        => esc_html__('Youtube', 'felis'),
					'desc'         => esc_html__('The custom URL to your Youtube profile page (Please include http://)', 'felis'),
					'std'          => '',
					'type'         => 'text',
					'section'      => 'social_account'
				),
				array(
					'id'           => 'flickr',
					'label'        => esc_html__('Flickr', 'felis'),
					'desc'         => esc_html__('The custom URL to your Flickr profile page (Please include http://)', 'felis'),
					'std'          => '',
					'type'         => 'text',
					'section'      => 'social_account'
				),
				array(
					'id'           => 'dribbble',
					'label'        => esc_html__('Dribbble', 'felis'),
					'desc'         => esc_html__('The custom URL to your Dribble profile page (Please include http://)', 'felis'),
					'std'          => '',
					'type'         => 'text',
					'section'      => 'social_account'
				),
				array(
					'id'           => 'behance',
					'label'        => esc_html__('Behance', 'felis'),
					'desc'         => esc_html__('The custom URL to your Behance profile page (Please include http://)', 'felis'),
					'std'          => '',
					'type'         => 'text',
					'section'      => 'social_account'
				),
				array(
					'id'           => 'envelope',
					'label'        => esc_html__('Email', 'felis'),
					'desc'         => esc_html__('The custom URL to your Email account', 'felis'),
					'std'          => '',
					'type'         => 'text',
					'section'      => 'social_account',
				),
				array(
					'id'           => 'rss',
					'label'        => esc_html__('RSS', 'felis'),
					'desc'         => esc_html__('Your website RSS Feed URL', 'felis'),
					'std'          => '',
					'type'         => 'text',
					'section'      => 'social_account',
				)
			);
        }
        
        /**
         * Social Sharing options
         */
        public function get_theme_option_sharing_args(){
            return array(
                array(
                    'id'           => 'social_left',
                    'label'        => esc_html__('Social Left Panel', 'felis'),
                    'desc'         => esc_html__('Enable Social Panel on the Left', 'felis'),
                    'std'          => 'on',
                    'type'         => 'on-off',
                    'section'      => 'social_share'
                ),

                array(
                    'id'      => 'social_text_schema',
                    'label'   => esc_html__( 'Social Text Schema', 'felis' ),
                    'desc'    => esc_html__( 'Choose Text Color Schema', 'felis' ),
                    'std'     => 'dark',
                    'type'    => 'select',
                    'section' => 'social_share',
                    'condition' => 'social_left:is(on)',
                    'choices' => array(
                        array(
                            'value' => 'dark',
                            'label' => esc_html__( 'Dark', 'felis' )
                        ),
                        array(
                            'value' => 'light',
                            'label' => esc_html__( 'Light', 'felis' )
                        )
                    ),
                    'section'      => 'social_share',
                ),

                array(
                    'id'      => 'social_position',
                    'label'   => esc_html__( 'Social Position', 'felis' ),
                    'desc'    => esc_html__( 'Choose Social Left Position', 'felis' ),
                    'std'     => 'dark',
                    'type'    => 'select',
                    'condition' => 'social_left:is(on)',
                    'choices' => array(
                        array(
                            'value' => 'fixed',
                            'label' => esc_html__( 'Fixed', 'felis' )
                            ),
                        array(
                            'value' => 'absolute',
                            'label' => esc_html__( 'Absolute', 'felis' )
                            )
                        ),
                    'section'      => 'social_share',
                    ),


                array(
                    'id'           => 'sharing_facebook',
                    'label'        => esc_html__('Facebook Share', 'felis'),
                    'desc'         => esc_html__('Enable Facebook Share button', 'felis'),
                    'std'          => 'on',
                    'type'         => 'on-off',
                    'section'      => 'social_share'
                ),
                array(
                    'id'           => 'sharing_twitter',
                    'label'        => esc_html__('Twitter Share', 'felis'),
                    'desc'         => esc_html__('Enable Twitter Tweet button', 'felis'),
                    'std'          => 'on',
                    'type'         => 'on-off',
                    'section'      => 'social_share'
                ),
                array(
                    'id'           => 'sharing_linkedIn',
                    'label'        => esc_html__('LinkedIn Share', 'felis'),
                    'desc'         => esc_html__('Enable LinkedIn Share button', 'felis'),
                    'std'          => 'off',
                    'type'         => 'on-off',
                    'section'      => 'social_share'
                ),
                array(
                    'id'           => 'sharing_tumblr',
                    'label'        => esc_html__('Tumblr Share', 'felis'),
                    'desc'         => esc_html__('Enable Tumblr Share button', 'felis'),
                    'std'          => 'on',
                    'type'         => 'on-off',
                    'section'      => 'social_share'
                ),
                array(
                    'id'           => 'sharing_google',
                    'label'        => esc_html__('Google+ Share', 'felis'),
                    'desc'         => esc_html__('Enable Google+ Share button', 'felis'),
                    'std'          => 'on',
                    'type'         => 'on-off',
                    'section'      => 'social_share'
                ),
                array(
                    'id'           => 'sharing_pinterest',
                    'label'        => esc_html__('Pinterest Share', 'felis'),
                    'desc'         => esc_html__('Enable Pinterest Pin button', 'felis'),
                    'std'          => 'off',
                    'type'         => 'on-off',
                    'section'      => 'social_share'
                ),
                array(
                    'id'           => 'sharing_email',
                    'label'        => esc_html__('Email Share', 'felis'),
                    'desc'         => esc_html__('Enable Email button', 'felis'),
                    'std'          => 'off',
                    'type'         => 'on-off',
                    'section'      => 'social_share'
                ));
        }
        
        /**
         * Return array of theme option args
         */
        public function get_theme_option_args(){
            return array_merge($this->get_theme_option_account_args(), array(
                            array(
                                'id'       => 'custom_social_account',
                                'label'    => esc_html__('Custom Social Accounts', 'felis'),
                                'desc'     => esc_html__('Add Social Account', 'felis'),
                                'type'     => 'list-item',
                                'class'    => '',
                                'section'  => 'social_account',
                                'choices'  => array(),
                                'settings' => array(
                                    array(
                                        'label'     => esc_html__('Icon Font Awesome', 'felis'),
                                        'id'        => 'icon_custom_social_account',
                                        'type'      => 'text',
                                        'desc'      => esc_html__('Enter Font Awesome class (Ex: fa-facebook)', 'felis'),
                                    ),
                                    array(
                                        'label'     => esc_html__('URL', 'felis'),
                                        'id'        => 'url_custom_social_account',
                                        'type'      => 'text',
                                        'desc'      => esc_html__('Enter full link to your account (including http://)', 'felis'),
                                    ),
                                )
                            ),
                            array(
                                'id'           => 'open_social_link_new_tab',
                                'label'        => esc_html__('Open Social link in new tab?', 'felis'),
                                'desc'         => '',
                                'std'          => 'on',
                                'type'         => 'on-off',
                                'section'      => 'social_account'
                            )
                        ),
                        $this->get_theme_option_sharing_args());
        }
        
        /** 
         * Add Social Accounts options to Theme Options
         */
        function filter_theme_options( $args ) {
            $args['settings'] = array_merge($args['settings'], $this->get_theme_option_args());
            
            return $args;
        }

        /**
         * @return array
         */
        public function getDefaultSocialAccounts()
        {
            $arr = array();
            
            foreach($this->get_theme_option_account_args() as $arg){
                $arr = array_merge($arr, array($arg['id'] => $arg['label']));
            }

            $this->default_accounts = $arr;

            return  $arr;
        }

        /**
         * @return bool|mixed|null|string
         */
        public function getCustomSocialAccounts()
        {
            $this->custom_accounts = $this->getOption('custom_social_account', '');

            return $this->custom_accounts;
        }

        /**
         * @return string
         */
        public function getTargetOpenSocial()
        {
            $this->target = $this->getOption('open_social_link_new_tab', 'on') == 'on' ? '_blank' : '_parent';

            return $this->target;
        }
    }
