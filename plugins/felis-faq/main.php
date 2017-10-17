<?php

/*
Plugin Name: Felis FAQ
Description: Create FAQ posts and FAQ Categories.
Author: CactusThemes
Version: 1.0
Author URI: http://www.cactusthemes.com
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'FelisFaq' ) ) {	

class FelisFaq{
	
	// Name of main custom post type
	const POST_TYPE = 'ct_faq';
	
	// Name of category taxonomy of the main post type
	const TAX_CATEGORY = 'ct_faq_cat';
	
	const LANGUAGE_DOMAIN = 'felis';
	
	// Custom template relative url in theme, default is "ct-faq/"
	public $template_url;
	
	// Plugin directory path
	public $plugin_path;
	
	private static $instance;
		
	public static function getInstance(){
		if(null == self::$instance){
			self::$instance = new FelisFaq();
		}
		
		return self::$instance;
	}
	
	private function __construct() {
		// constructor	
		add_action( 'init', array( $this,'init' ), 0 );
		add_action( 'init', array( $this, 'register_page_templates' ) );
	}
	
	/**
	 * Register page templates
	 */
	function register_page_templates(){
		if( !class_exists( 'PageTemplater' ) ){
			require 'includes/page-templater.php';
		}
           
		$page_templ = array(
                    'felis-faq/includes/page-templates/template-faqs-listing.php' => esc_html__( 'FAQ Page', 'felis' ),
                );
        
        $page_templater = PageTemplater::get_instance( $page_templ );
	}
	

	/**
	 * Register some actions and filters. Called very soon with priority = 0
	 */
	function init(){
		load_plugin_textdomain( self::LANGUAGE_DOMAIN, false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
		
		$this->template_url = apply_filters( 'ct_faq_template_url', 'ct-faq/' );

		$this->register_post_type();
		
		add_action( self::TAX_CATEGORY.'_add_form_fields', array( $this, 'register_metadata' ) );
		add_action( self::TAX_CATEGORY.'_edit_form_fields', array( $this, 'cactus_taxonomy_edit_meta_field' ) );
		add_action( 'edited_'.self::TAX_CATEGORY, array( $this, 'cactus_save_taxonomy_custom_meta' ),  10, 2 );
		add_action( 'create_'.self::TAX_CATEGORY, array( $this, 'cactus_save_taxonomy_custom_meta' ),  10, 2 );
		
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

	

	/* Register ct_faq post type and its custom taxonomies */
	function register_post_type(){
		$labels = array(
			'name'               => esc_html__( 'FAQs', 'felis' ),
			'singular_name'      => esc_html__( 'FAQ', 'felis' ),
			'add_new'            => esc_html__( 'Add New FAQ', 'felis' ),
			'add_new_item'       => esc_html__( 'Add New FAQ', 'felis' ),
			'edit_item'          => esc_html__( 'Edit FAQ', 'felis' ),
			'new_item'           => esc_html__( 'New FAQ', 'felis' ),
			'all_items'          => esc_html__( 'All FAQs', 'felis' ),
			'view_item'          => esc_html__( 'View FAQ', 'felis' ),
			'search_items'       => esc_html__( 'Search FAQ', 'felis' ),
			'not_found'          => esc_html__( 'No FAQ found', 'felis' ),
			'not_found_in_trash' => esc_html__( 'No FAQ found in Trash', 'felis' ),
			'parent_item_colon'  => '',
			'menu_name'          => esc_html__( 'Felis FAQ', 'felis' ),
		  );

		$slug_ev =  'faq';
		$slug_faq_cat =  'faq-category';
		
		if($slug_ev == '' ){
			$slug_ev = 'faq';
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
			'supports'           => array( 'title', 'editor', 'author' )
		  );

		register_post_type( self::POST_TYPE , $args );
		
		/* Register Faq Categories */
		$ct_faq_cat_labels = array(
			'name' => esc_html__( 'FAQ Categories', 'felis' ),
			'singular_name' => esc_html__( 'FAQ Category', 'felis' )
		);
		

		register_taxonomy( self::TAX_CATEGORY, self::POST_TYPE, array(
																'labels' => $ct_faq_cat_labels,
																'show_admin_column' => true,
																'hierarchical' => true,
																'rewrite' => array(
																				'slug' => $slug_faq_cat
																			)
																)
							);
							
		do_action(self::POST_TYPE . '_after_register_post_type' );
	}
	
	/**
	 * Register metadata for ct_faq post type, using Options Tree API. It has list-item type option
	 */
	function register_metadata(){
		// this will add the custom meta field to the add new term page
		?>
		<div class="form-field">
			<label for="term_meta[icon]"><?php _e( 'Icon', 'felis' ); ?></label>
			<input type="text" name="term_meta[icon]" id="term_meta[icon]" value="">
			<p class="description"><?php _e( 'Enter Icon class, for example "fa fa-home"','felis' ); ?></p>
		</div>
	<?php
		
		do_action( self::POST_TYPE . '_after_register_metadata' );
	}

	function cactus_taxonomy_edit_meta_field( $term ) {
 
		// put the term ID into a variable
		$t_id = $term->term_id;
	 
		// retrieve the existing value(s) for this meta field. This returns an array
		$term_meta = get_option( self::TAX_CATEGORY."_$t_id" ); ?>
		<tr class="form-field">
		<th scope="row" valign="top"><label for="term_meta[icon]"><?php _e( 'Icon', 'felis' ); ?></label></th>
			<td>
				<input type="text" name="term_meta[icon]" id="term_meta[icon]" value="<?php echo esc_attr( $term_meta['icon'] ) ? esc_attr( $term_meta['icon'] ) : ''; ?>">
				<p class="description"><?php _e( 'Enter Icon class, for example "fa fa-home"','felis' ); ?></p>
			</td>
		</tr>
	<?php
	}

	function cactus_save_taxonomy_custom_meta( $term_id ) {
		if ( isset( $_POST['term_meta'] ) ) {
			$t_id = $term_id;
			$term_meta = get_option( self::TAX_CATEGORY."_$t_id" );
			$cat_keys = array_keys( $_POST['term_meta'] );
			foreach ( $cat_keys as $key ) {
				if ( isset ( $_POST['term_meta'][$key] ) ) {
					$term_meta[$key] = $_POST['term_meta'][$key];
				}
			}
			// Save the option array.
			update_option( self::TAX_CATEGORY."_$t_id", $term_meta );
		}
	}
	
	
	/**
	 * Get list of default meta of Faq
	 *
	 * @return array
	 */

} // end class

} // end check if exists

/**
 * Init ct_faq
 */
function ct_faq(){
	return FelisFaq::getInstance();
}

ct_faq();