<?php
	/**
 * WooCommerce Template Extension
 *
 * @package cactus
 */

namespace App\Plugins\Cactus_WooCommerce;

use \App\Cactus;

class WooCommerceTemplate {
	private static $instance;

	public static function getInstance()
	{
		if (null == self::$instance) {
			self::$instance = new WooCommerceTemplate();
		}

		return self::$instance;
	}

	public static $page_slug = 'cactus-woocommerce-template';

	public function setup()
	{
		// Override theme default specification for product # per row
		add_filter('loop_shop_columns', array($this, 'loop_columns'), 999);
		add_filter('woocommerce_product_thumbnails_columns', array($this, 'product_thumbnails_columns'));
		add_filter('loop_shop_per_page', array($this, 'posts_per_page'), 20);
		
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
		
		add_action( 'woocommerce_before_main_content', array($this, 'theme_wrapper_start'), 10);
		add_action( 'woocommerce_after_main_content', array($this, 'theme_wrapper_end'), 10);
		add_filter( 'woocommerce_product_description_heading', '__return_empty_string' );
		add_filter( 'woocommerce_product_additional_information_heading', '__return_empty_string' );
	}
	
	function theme_wrapper_start() {
		do_action('felis_before_main_page');
		
		$felis_page_layout = Cactus::getOption('page_layout');
		?>


		<!-- #site-navigation -->
		<div class="<?php echo is_singular( 'product' ) ? 'container' : 'container-fluid' ?>">
			<section class="c-page-content c-single-page <?php echo 'page-' . esc_attr($felis_page_layout);?>">
				<div id="primary" class="content-area">
					<main id="main" class="site-main main-content">

						<?php 

						$felis_sidebar = Cactus::getOption('woocommerce_sidebar_position'); 
						if($felis_sidebar == 'default'){
							$felis_sidebar = Cactus::getOption('page_sidebar', 'full');
						}

						if(!is_active_sidebar('woo_sidebar')){									
							$felis_sidebar = 'full';
						}

						$felis_page_gutter = Cactus::getOption('page_gutter', 'on') == 'off' ? 'no-gutter' : ''; 

						?>

						<div id="main-content" class="row">
							<div class="col-xs-12 <?php echo ($felis_sidebar != 'full' ? 'col-sm-12 col-md-9' : 'col-sm-12 col-md-12');?> <?php echo esc_attr($felis_page_gutter);?> <?php echo ($felis_sidebar == 'left' ? 'pull-right' : '');?> col-1">
	<?php

				/**
				 * felis_before_content hook
				 *
				 * @hooked felis_output_bodytop_sidebar - 10
				 *
				 * @author
				 * @since 1.0
				 * @code     CactusThemes
				 */
				do_action('felis_before_content');
				?>
				<div class="c-entry-main">
					<?php
				}

	function theme_wrapper_end() {
		$felis_sidebar = Cactus::getOption('woocommerce_sidebar_position'); 
		if($felis_sidebar == 'default'){
			$felis_sidebar = Cactus::getOption('page_sidebar', 'right');
		}
		?>
	</div>
	<!-- row -->

		<?php

		/**
		 * felis_after_content hook
		 *
		 * @hooked felis_output_bodybottom_sidebar - 10
		 *
		 * @author
		 * @since 1.0
		 * @code     CactusThemes
		 */
		do_action('felis_after_content');
		?>
							</div>

							<?php

							if($felis_sidebar != 'full' && is_active_sidebar('woo_sidebar')) {?>
							<div class="col-xs-12 col-sm-12 col-md-3  col-2">
								<?php dynamic_sidebar('woo_sidebar'); ?>
							</div>
							<?php }?>

						</div>

					</main>
					<!-- main -->
				</div>
				<!-- primary -->

			</section>
			<!-- #c-page-content -->
		</div>

		<?php
		do_action('felis_after_main_page');
	}

	/**
	 * Return posts per page
	 */
	function posts_per_page()
	{
		return \App\Cactus::getOption('woocommerce_count', 10);
	}

	/**
	 * Return number of items per row
	 */
	function loop_columns()
	{
		return \App\Cactus::getOption('woocommerce_items_per_row', 4);
	}
	
	function product_thumbnails_columns()
	{
		return 6;
	}
}