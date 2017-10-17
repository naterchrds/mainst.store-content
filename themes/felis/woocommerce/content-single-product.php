<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

use App\Cactus;
global $product;
?>

<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }



$style = cactus::getOption( 'product_single_tyle', 1 );
$classes = array();
if ( is_active_sidebar( 'left-sidebar' ) ) {
	
}
// $classes[] = 'container';
$classes[] = 'style-'.$style;
$attachment_ids = $product->get_gallery_image_ids();
$link_gallery = '';
if ( ! empty( $attachment_ids ) ) {
	$link_gallery = wp_get_attachment_image_src( $attachment_ids[0], 'full' );
	$link_gallery = $link_gallery[0];
}
?>

<div id="product-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

	<?php
		if ( $style == 1 ) {
		/**
		 * woocommerce_before_single_product_summary hook.
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
		
	?>
	<div class="navigation-wrap">
		<?php if ( $link_gallery != '' ) : ?>
		<div class="view-gallery">
			<a class="swipebox" href="<?php echo esc_url( $link_gallery ); ?>"><i class="fa fa-search"></i><?php esc_html_e( 'View Gallery', 'felis' );?></a>
		</div>
		<?php endif; ?>
		<div class="product-navigation">
		<?php
			previous_post_link( '%link', '');
			next_post_link('%link', '');
		?>
		</div>
	</div>
	<div class="row product-summary">
		<div class="col-md-6">
			<div class="entry-summary">

			<?php
				/**
				 * woocommerce_single_product_summary hook.
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_rating - 10
				 * @hooked woocommerce_template_single_price - 10
				 * @hooked woocommerce_template_single_excerpt - 20
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 * @hooked WC_Structured_Data::generate_product_data() - 60
				 */
				do_action( 'woocommerce_single_product_summary' );
			?>

		</div></div><!-- .summary -->
		<div class="col-md-6">
		<?php
			/**
			 * woocommerce_after_single_product_summary hook.
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 * @hooked woocommerce_upsell_display - 15
			 * @hooked woocommerce_output_related_products - 20
			 */
			woocommerce_output_product_data_tabs();
			
		?>
		</div>
	</div>
	<?php woocommerce_upsell_display(); ?>
	<?php woocommerce_output_related_products(); ?>
	
	<?php } else { ?>
	<div class="product-summary">
		<div class="col-md-6">
			<?php do_action( 'woocommerce_before_single_product_summary' ); ?>
		</div>
		<div class="col-md-6 entry-summary">
			<?php do_action( 'woocommerce_single_product_summary' ); ?>
		</div>
		<div class="navigation-wrap">
			<?php if ( $link_gallery != '' ) : ?>
				<div class="view-gallery">
					<a class="swipebox" href="<?php echo esc_url( $link_gallery ); ?>"><i class="fa fa-search"></i><?php esc_html_e( 'View Gallery', 'felis' );?></a>
				</div>
			<?php endif; ?>
			<div class="product-navigation">
			<?php
				previous_post_link( '%link', '');
				next_post_link('%link', '');
			?>
			</div>
		</div>
		<div>
			<?php do_action( 'woocommerce_after_single_product_summary' ); ?>
		</div>
	</div>

	<?php } ?>
</div><!-- #product-<?php the_ID(); ?> -->