<?php

/*
Plugin Name: Felis Video Presentation
Description: Create Video Presentation and Video Presentation Categories.
Author: CactusThemes
Version: 1.0
Author URI: http://www.cactusthemes.com
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'FelisVideo' ) ) {	

class FelisVideo{
	
	// Name of main custom post type
	const POST_TYPE = 'ct_video';

	// Name of category taxonomy of the main post type
	const TAX_CATEGORY = 'ct_video_cat';
	
	const LANGUAGE_DOMAIN = 'felis';
	
	
	// Plugin directory path
	public $plugin_path;
	
	private static $instance;
		
	public static function getInstance(){
		if(null == self::$instance){
			self::$instance = new FelisVideo();
		}
		
		return self::$instance;
	}
	
	private function __construct() {
		// constructor	
		add_action( 'init', array( $this,'init' ), 0 );
	}
	

	

	/**
	 * Register some actions and filters. Called very soon with priority = 0
	 */
	function init(){
		load_plugin_textdomain( self::LANGUAGE_DOMAIN, false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
		
		$this->register_post_type();
		
	}
	
	/**
	 * Get the plugin path.
	 *
	 * @access public
	 * @return string
	 */
	public function plugin_path() {
		if ( $this->plugin_path ) return $this->plugin_path;

		return $this->plugin_path = untrailingslashit( plugin_dir_path( __FILE__ ) );
	}
	/**
	 *
	 * Load custom page template for specific pages 
	 *
	 * @return string
	 */

	

	/* Register ct_video post type and its custom taxonomies */
	function register_post_type(){
		$labels = array(
			'name'               => esc_html__( 'Video Presentation', 'felis' ),
			'singular_name'      => esc_html__( 'Video', 'felis' ),
			'add_new'            => esc_html__( 'Add New Video', 'felis' ),
			'add_new_item'       => esc_html__( 'Add New Video', 'felis' ),
			'edit_item'          => esc_html__( 'Edit Video', 'felis' ),
			'new_item'           => esc_html__( 'New Video Presentation', 'felis' ),
			'all_items'          => esc_html__( 'All Videos', 'felis' ),
			'view_item'          => esc_html__( 'View Video', 'felis' ),
			'search_items'       => esc_html__( 'Search Video', 'felis' ),
			'not_found'          => esc_html__( 'No Video found', 'felis' ),
			'not_found_in_trash' => esc_html__( 'No Video found in Trash', 'felis' ),
			'parent_item_colon'  => '',
			'menu_name'          => esc_html__( 'Felis Video Presentation', 'felis' ),
		  );

		$slug_ev =  'video';
		$slug_video_cat =  'video-category';
		
		if($slug_ev == '' ){
			$slug_ev = 'video';
		}
		if ( $slug_ev )
			$rewrite =  array( 'slug' => untrailingslashit( $slug_ev ), 'with_front' => false, 'feeds' => true );
		else
			$rewrite = false;

		  $args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => $rewrite,
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail' )
		  );

		register_post_type( self::POST_TYPE , $args );
		
		/* Registe Video Presentation Categories */
		$ct_video_cat_labels = array(
			'name' => esc_html__( 'Video Categories', 'felis' ),
			'singular_name' => esc_html__( 'Video Category', 'felis' )
		);
		

		register_taxonomy( self::TAX_CATEGORY, self::POST_TYPE, array(
																'labels' => $ct_video_cat_labels,
																'show_admin_column' => true,
																'hierarchical' => true,
																'rewrite' => array(
																				'slug' => $slug_video_cat
																			)
																)
							);
							
		do_action(self::POST_TYPE . '_after_register_post_type' );
	}
	
	
	
	/**
	 * Get list of default meta of Video
	 *
	 * @return array
	 */

} // end class

} // end check if exists

/**
 * Init ct_video
 */
function ct_video(){
	return FelisVideo::getInstance();
}

ct_video();