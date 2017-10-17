<?php

/*
Plugin Name: Felis - Shortcodes
Plugin URI: http://www.cactusthemes.com/felis
Description: Enable shortcodes for felis theme
Version: 1.0
Author: CactusThemes
Author URI: http://www.cactusthemes.com/
License: Commercial
*/

/**
 * @package felis
 * @version 1.0
 */
 
if(!class_exists('CactusPlugin')){
    require 'inc/core/CactusPlugin.php';
}

if ( ! defined('CT_SHORTCODE_BASE_FILE')) {
    define('CT_SHORTCODE_BASE_FILE', __FILE__);
}
if ( ! defined('CT_SHORTCODE_BASE_DIR')) {
    define('CT_SHORTCODE_BASE_DIR', dirname(CT_SHORTCODE_BASE_FILE));
}
if ( ! defined('CT_SHORTCODE_PLUGIN_URL')) {
    define('CT_SHORTCODE_PLUGIN_URL', plugin_dir_url(__FILE__));
}
if ( ! defined('CT_SHORTCODE_VERSION')) {
    define('CT_SHORTCODE_VERSION', '1.0.0');
}
if ( ! function_exists('sc_get_plugin_url')) {
    function sc_get_plugin_url()
    {
        return plugin_dir_path(__FILE__);
    }
}

include sc_get_plugin_url() . 'configuration.php';

include sc_get_plugin_url() . 'shortcodes/class.shortcode.base.php';
include sc_get_plugin_url() . 'shortcodes/class.shortcode.element.php';
include sc_get_plugin_url() . 'shortcodes/class.shortcode.block.php';

global $cactus_shortcodes;


foreach ($cactus_shortcodes as $name => $params) {
    if (isset( $params['path'] )) {
        include $params['path'];
    }
}

include CT_SHORTCODE_BASE_DIR . '/inc/helpers.php';

include CT_SHORTCODE_BASE_DIR . '/inc/plugin-filters.php';
/**
 * core file. do not change
 */
include CT_SHORTCODE_BASE_DIR . '/inc/classes/ct-shortcodes.php';

/**
 * Plugin class
 */
class CT_Plugin_Shortcode extends CactusPlugin{
    private static $instance;
		
    public static function getInstance(){
        if(null == self::$instance){
            self::$instance = new CT_Plugin_Shortcode();
        }
        
        return self::$instance;
    }
    
    private function __construct() {
        // Variables
        $this->template_url			= apply_filters( 'cactus_shortcodes_template_url', 'ct-shortcodes/' );

        add_action( 'init', array($this,'init'), 0);
    }
        
    /**
     * Get the plugin path. This function must be defined here
     *
     * @access public
     * @return string
     */
    public function plugin_path() {
        if ( $this->plugin_path ) return $this->plugin_path;

        return $this->plugin_path = untrailingslashit( plugin_dir_path( __FILE__ ) );
    }
    
    public function init() {
        load_plugin_textdomain( 'felis', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
    }
}

