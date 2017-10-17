<?php

    /**
     * 1.0
     * @package    CactusThemes
     * @author     CactusThemes Team <hi@cactusthemes.com>
     * @copyright  Copyright (C) 2014 CactusThemes.com. All Rights Reserved.
     * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
     *
     * Websites: http://www.cactusthemes.com
     */
    namespace App;

	// Prevent direct access to this file
    defined('ABSPATH') || die( 'Direct access to this file is not allowed.' );

	require get_parent_theme_file_path('/app/core.php');

    require get_parent_theme_file_path('/app/plugins/cactus-walker-nav-menu/Custom_Walker_Nav_Menu.php');
	require get_parent_theme_file_path('/app/plugins/cactus-walker-nav-menu/Custom_Walker_Nav_Menu_Woo.php');

    /**
     * Core class.
     *
     * @package  CactusThemes
     * @since    1.0
     */
    class CactusStarter extends Cactus
    {

        private static $instance;

        public static function getInstance()
        {
            if (null == self::$instance) {
                self::$instance = new CactusStarter();
            }

            return self::$instance;
        }

        /**
         * Initialize Cactus Core.
         *
         * @return  void
         */
        public function initialize()
        {
            add_action('template_redirect', array($this, 'set_content_width'), 0);

            parent::initialize();
			
			if(class_exists('woocommerce')){
				Plugins\Cactus_WooCommerce\WooCommerce::initialize();
			}
			
			if(defined('TRIBE_EVENTS_FILE')){
				Plugins\Cactus_Events_Calendar\Events_Calendar::initialize();
			}
			
			if(class_exists('Vc_Manager')){
				Plugins\Cactus_VC\VCExtension::initialize();
			}
			

            $this->registerWidgets();

            /**
             * Custom template tags and functions for this theme.
             */
            require get_parent_theme_file_path('/inc/extras.php');

            add_action('after_setup_theme', array($this, 'addThemeSupport'));
            add_action('widgets_init', array($this, 'registerSidebar'));
            add_action('after_setup_theme', array($this, 'registerNavMenus'));


            add_action('wp_enqueue_scripts', array($this, 'enqueueScripts'));

            add_action('cactus_release_logs', array($this, 'release_logs'));
            add_filter('theme_page_templates', array($this, 'makewp_exclude_page_templates'));
			
			
        }

        /**
         * Set the content width in pixels, based on the theme's design and stylesheet.
         *
         * Priority 0 to make it available to lower priority callbacks.
         *
         * @global int $content_width
         */
        function set_content_width()
        {

            $content_width = 980;

            $GLOBALS['content_width'] = apply_filters('felis_content_width', $content_width);
        }

        /**
         * Hides the custom post template for pages on WordPress 4.6 and older
         *
         * @param array $post_templates Array of page templates. Keys are filenames, values are translated names.
         *
         * @return array Filtered array of page templates.
         */
        function makewp_exclude_page_templates($post_templates)
        {
            if (version_compare($GLOBALS['wp_version'], '4.7', '<')) {
                // unset( $post_templates['page-templates/my-full-width-post-template.php'] );
            }

            return $post_templates;
        }

        /**
         * Add Theme Support
         *
         * @return void
         */
        function addThemeSupport()
        {
            load_theme_textdomain('felis', get_parent_theme_file_path('/languages'));

            add_theme_support('automatic-feed-links');

            add_theme_support("title-tag");

            add_theme_support('post-thumbnails');

            add_theme_support('post-formats',
                array(
                    'audio',
                    'video',
                )
            );

            add_theme_support('custom-background');
            add_theme_support( 'custom-header', apply_filters( 'felis_header_args', array(
                'default-image'      => get_parent_theme_file_uri( '/assets/images/header.jpg' ),
            ) ) );

            add_theme_support('html5',
                array(
                    'comment-list',
                    'search-form',
                    'comment-form',
                    'gallery',
                    'caption',
                )
            );

            // register thumb sizes
            do_action('cactus_reg_thumbnail');
        }

        /**
         * Cactus Sidebar Init
         *
         * @since Cactus Alpha 1.0
         */
        function registerSidebar() {
            register_sidebar(array(
                'name'          => esc_html__('Main Sidebar', 'felis'),
                'id'            => 'main_sidebar',
                'description'   => esc_html__('Main Sidebar used by all pages', 'felis'),
                'before_widget' => '<div class="row"><div id="%1$s" class="widget %2$s"><div class="widget__inner %2$s__inner">',
                'after_widget'  => '</div></div></div>',
                'before_title'  => '<div class="widget-title"><h4 class="heading">',
                'after_title'   => '</h4></div>',
            ));
			

            register_sidebar(array(
                'name'          => esc_html__('Footer Sidebar', 'felis'),
                'id'            => 'footer_sidebar',
                'description'   => esc_html__('Appear in Footer', 'felis'),
                'before_widget' => '<div id="%1$s" class="widget %2$s "><div class="widget__inner %2$s__inner">',
                'after_widget'  => '</div></div>',
                'before_title'  => '<div class="c-title widget-title"><h4 class="heading">',
                'after_title'   => '</h4></div>',
            ));

            if ( class_exists( 'WooCommerce' ) ) {
                register_sidebar(array(
                    'name'          => esc_html__('Woo Single Widget', 'felis'),
                    'id'            => 'woo_single_sidebar',
                    'description'   => esc_html__('Appear after single product content above the footer', 'felis'),
                    'before_widget' => '<div id="%1$s" class="widget %2$s "><div class="widget__inner %2$s__inner">',
                    'after_widget'  => '</div></div>',
                    'before_title'  => '<div class="c-title widget-title"><h4 class="heading">',
                    'after_title'   => '</h4></div>',
                ));
            }
            

        }

        /**
         * Register Menu Location
         *
         * @since Cactus Alpha 1.0
         */
        function registerNavMenus()
        {
            register_nav_menus(array(
                'primary_menu' => esc_html__('Primary Menu', 'felis'),
                'mobile_menu'  => esc_html__('Mobile Menu', 'felis'),
            ));
        }

        /**
         * Enqueue needed scripts
         */
        function enqueueScripts() {
            wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800,300');

	        if ($this->getOption('loading_fontawesome', 'on') == 'on') {
		        wp_enqueue_style('fontawesome', get_parent_theme_file_uri('/css/fonts/css/font-awesome.min.css'));
	        }
	        if ($this->getOption('loading_ionicons', 'on') == 'on') {
		        wp_enqueue_style('ionicons', get_parent_theme_file_uri('/css/fonts/ionicons/css/ionicons.min.css'));
	        }
	        if ($this->getOption('loading_ct_icons', 'on') == 'on') {
		        wp_enqueue_style('felis-icons', get_parent_theme_file_uri('/css/fonts/ct-icon/ct-icon.css'));
	        }

            wp_enqueue_style('slick-theme', get_parent_theme_file_uri('/js/slick/slick-theme.css'));
            wp_enqueue_style('slick', get_parent_theme_file_uri('/js/slick/slick.css'));
            wp_enqueue_style('swipebox', get_parent_theme_file_uri('/js/swipebox/css/swipebox.min.css'));
            wp_enqueue_style('animate', get_parent_theme_file_uri('/css/animate.css'));
            wp_enqueue_style('bootstrap', get_parent_theme_file_uri('/css/bootstrap.min.css'));

            wp_enqueue_style('aos', get_parent_theme_file_uri('/css/aos.css'));
			
			wp_enqueue_style('felis-css', get_stylesheet_uri());

            wp_enqueue_script('slick', get_parent_theme_file_uri('/js/slick/slick.min.js'), array('jquery'), '1.6', true);

            wp_enqueue_script('aos', get_parent_theme_file_uri('/js/aos.js'), array(), '', true);
            wp_enqueue_script('swipebox', get_parent_theme_file_uri('/js/swipebox/js/jquery.swipebox.min.js'), array(), '', true);
            
			
			wp_enqueue_script('felis-js', get_parent_theme_file_uri('/js/scripts.js'), array(), '', true);

            /**
             * Right To Left CSS
             */
            if ( is_rtl() ) {
                wp_enqueue_style( 'rtl', get_parent_theme_file_uri() . '/rtl.css' );
            }


			/**
			 * Add Custom CSS
			 */
			require get_parent_theme_file_path('/css/custom.css.php');

			$custom_css = felis_custom_CSS();

			wp_add_inline_style('felis-css', $custom_css);
        }

        /**
         * Include required widgets for each theme
         *
         * @return void
         */
        public function registerWidgets()
        {

          
			/** 
			* felis Posts Widget Init
			*
			*/
			$felisPost = new Plugins\Widgets\Posts();

        }

        public function release_logs()
        {
            // sample release logs
            ?>
            <ul>
                <li><span>First release</span></li>
            </ul>
            <?php
        }
    }


    $cactus = CactusStarter::getInstance();
    $cactus->initialize();