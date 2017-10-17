<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;
$attachment_ids = $product->get_gallery_image_ids();
if ( ! empty( $attachment_ids ) ) {
	?>
	<div class="sc-slider slider_single_gallery style-1">
		<div class="c-slider_wrap" data-count="1" data-arrows="false" data-dots="false">
			<div class="c-slider__inner">
			<?php
			
			foreach ( $attachment_ids as $attachment_id ) {
				$image_src = wp_get_attachment_image_src( $attachment_id, 'full' );
				$image_src_full = wp_get_attachment_image_src( $attachment_id, 'full' );
				$image_title    = get_post_field( 'post_excerpt', $attachment_id );
				?>
					<div class="c-slider_item">
						<div class="c-thumb__wrap">
							<div class="c-thumb">
								<div class="c-thumb-inner c-image-grayscale product-image">
									<a class="swipebox" href="<?php echo esc_url( $image_src_full[0] ); ?>">
										<img src="<?php echo esc_url( $image_src[0] ); ?>" class="img-responsive" alt="<?php echo esc_attr( $image_title ); ?>">
									</a>
								</div>
							</div>
						</div>
					</div>
				
				<?php
				$link_gallery = $image_src_full[0];
			}
			
			?>
				
			</div>
			
		</div>
	</div>

	<?php
} else if ( has_post_thumbnail() ) {
	?>
	<div class="felis-product-image">
	<?php
	the_post_thumbnail( 'shop_single' );
	?>
	</div>
<?php
}
?>
