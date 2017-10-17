<?php
/**
 * WooCommerce extension
 *
 * @package cactus
 */

namespace App\Plugins\Cactus_WooCommerce;

use \App\Cactus;

class WooCommerce{
    public static $page_slug = 'cactus-woocommerce';

    private static $instance;

	public static function getInstance(){
		if(null == self::$instance){
			self::$instance = new WooCommerce();
		}

		return self::$instance;
	}

    public static function initialize(){
        $woocommerce = WooCommerce::getInstance();
		
		add_action( 'widgets_init', array( $woocommerce, 'registerSidebar' ) );
        add_action( 'after_setup_theme', array($woocommerce, 'add_woocommerce_support' ) );

        remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
        add_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 40 );

        add_filter('option_tree_settings_args', array($woocommerce, 'register_theme_options'));

        $template = WooCommerceTemplate::getInstance();
        $template->setup();
		
        add_filter( 'cactus_page_title', array( $woocommerce, 'archives_title' ) );
		add_filter( 'cactus_page_subtitle', array( $woocommerce, 'archives_subtitle' ) );
        add_action( 'init',  array( $woocommerce, 'ct_remove_wc_breadcrumbs' ) );

        add_filter( 'woocommerce_output_related_products_args', array( $woocommerce, 'ct_related_products_args' ) );
        add_filter( 'woocommerce_add_to_cart_fragments', array( $woocommerce, 'ct_header_add_to_cart_fragment' ) );

    }

    /**
     * Ensure cart contents update when products are added to the cart via AJAX
     */
    public function ct_header_add_to_cart_fragment( $fragments ) {
     
        ob_start();
        felis_cart_link();
        $fragments['a.cart-contents'] = ob_get_clean();
         
        return $fragments;
    }
 

    public function ct_related_products_args( $args ) {
        $args['posts_per_page'] = 3; // 3 related products
        return $args;
    }


    public function ct_remove_wc_breadcrumbs() {
        remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
    }
	
	/**
	 * Change page title of Archives page
	 */
	public function archives_title($page_title){
		if ( is_shop() ) {
			return Cactus::getOption( 'woocommerce_archive_title', '' );
		}
		
		return $page_title;
	}

    /**
     * Change page title of Archives page
     */
    public function archives_subtitle( $page_subtitle ){
        if ( is_shop() ) {
            return Cactus::getOption( 'woocommerce_archive_subtitle', '' );
        }
        
        return $page_subtitle;
    }
	
	/**
	 * Register WooCommerce sidebar
	 */
	public function registerSidebar(){
		register_sidebar(array(
                'name'          => esc_html__('WooCommerce Sidebar', 'felis'),
                'id'            => 'woo_sidebar',
                'description'   => esc_html__('Used by all WooCommerce pages', 'felis'),
                'before_widget' => '<div class="row"><div id="%1$s" class="widget %2$s "><div class="widget__inner %2$s__inner">',
                'after_widget'  => '</div></div></div>',
                'before_title'  => '<div class="widget-title"><h4 class="heading">',
                'after_title'   => '</h4></div>',
            ));
	}

	/**
	 * Add Theme Options for WooCommerce
	 */
    public function register_theme_options( $custom_settings ) {
        $custom_settings['sections'][] = array(
                                        'id' => 'woocommerce',
                                        'title' => '<i class="fa fa-shopping-cart"><!-- --></i>' . esc_html__('WooCommerce', 'felis')
                                    );
		
		$custom_settings['settings'][] = array(
                                        'id' => 'woocommerce_archive_title',
                                        'label'        => esc_html__('Archives Page Title', 'felis'),
                                        'desc'         => esc_html__('Page Title of WooCommerce All Products page', 'felis'),
                                        'std'          => 'Shop',
                                        'type'         => 'text',
                                        'section'      => 'woocommerce',
                                    );
        $custom_settings['settings'][] = array(
                                        'id' => 'woocommerce_archive_subtitle',
                                        'label'        => esc_html__('Archives Page Subtitle', 'felis'),
                                        'desc'         => esc_html__('Page Subtitle of WooCommerce All Products page', 'felis'),
                                        'std'          => 'Shop Subtitle',
                                        'type'         => 'text',
                                        'section'      => 'woocommerce',
                                    );
		
		$custom_settings['settings'][] = array(
                                        'id'           => 'woocommerce_sidebar_position',
                                        'label'        => esc_html__('Shop Sidebar Position', 'felis'),
                                        'desc'         => esc_html__('Choose Sidebar Position for Shop and Single Product page', 'felis'),
                                        'std'          => 'default',
                                        'type'         => 'select',
                                        'section'      => 'woocommerce',
                                        'choices'       => array(
                                                                array(
                                                                    'value' => 'default',
                                                                    'label' => esc_html__('Default', 'felis')
                                                                ),
																array(
                                                                    'value' => 'left',
                                                                    'label' => esc_html__('Left', 'felis')
                                                                ),
                                                                array(
                                                                    'value' => 'right',
                                                                    'label' => esc_html__('Right', 'felis')
                                                                ),
                                                                array(
                                                                    'value' => 'full',
                                                                    'label' => esc_html__('Hidden', 'felis')
                                                                )
                                                            )
                                    );

        $custom_settings['settings'][] = array(
                                        'id' => 'woocommerce_count',
                                        'label'        => esc_html__('Posts Per Page', 'felis'),
                                        'desc'         => esc_html__('Enter number of products per page in All Products page', 'felis'),
                                        'std'          => 9,
                                        'type'         => 'text',
                                        'section'      => 'woocommerce',
                                    );

       
        $custom_settings['settings'][] = array(
                                        'id' => 'product_single_tyle',
                                        'label'        => esc_html__('Product Single Style', 'felis'),
                                        'desc'         => esc_html__('Choose Style for the product single page. Default is style 1', 'felis'),
                                        'std'          => 1,
                                        'type'         => 'select',
                                        'section'      => 'woocommerce',
                                        'choices'       => array(
                                                                array(
                                                                    'value' => 1,
                                                                    'label' => esc_html__('Style 1', 'felis')
                                                                ),
                                                                array(
                                                                    'value' => 2,
                                                                    'label' => esc_html__('Style 2', 'felis')
                                                                ),
                                                                )
                                    );

        return $custom_settings;
    }

    /**
     * return global variable $woocommerce_loop
     */
    public static function get_woocommerce_loop(){
        global $woocommerce_loop;

        return $woocommerce_loop;
    }

    public function add_woocommerce_support() {
        add_theme_support( 'woocommerce' );
    }

    public function remove_fields_from_product_square_thumbnail_option( $fields, $field_id){
        if($field_id == 'product_square_thumbnail'){
            // only leave background-image for this option
            unset($fields[0]);
            unset($fields[1]);
            unset($fields[2]);
            unset($fields[3]);
            unset($fields[4]);
        }

        return $fields;
    }
}