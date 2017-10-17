<?php

/**
 * Class CactusWooCategorySlider
 */
class CactusWooCategorySlider extends CactusShortcode_Block {
	public function __construct( $params = null, $content = '' ) {
		parent::__construct( 'felis_woo_category_slider', $params, $content );
	}

	public function renderShortcode( $params, $content ) {

		$id              = isset( $params['id'] ) ? $params['id'] : 'c-content-slide-2-' . rand( 1, 9999 );
		$count           = isset( $params['count'] ) && $params['count'] != '' ? $params['count'] : '';
		$items_per_row   = isset( $params['items_per_row'] ) && $params['items_per_row'] != '' ? $params['items_per_row'] : 2;
		$autoplay        = isset( $params['autoplay'] ) && $params['autoplay'] != '' ? $params['autoplay'] : '0';


		ob_start();

				$taxonomy = 'product_cat';
				$orderby = 'name';    
				$hierarchical = 1;      
				$num = $count;
				$empty = 0;
				$arg = array(
				'taxonomy' => $taxonomy,
                'orderby' => $orderby,
                'hierarchical' => $hierarchical,
                'number' => $num,
                'hide_empty' => $empty
            );
            $all_categories = get_categories( $arg );
            
		?>
		<section>
			<div class="sc-slider category_slider">
				<div class="c-slider_wrap" data-autoplay="<?php echo esc_attr( $autoplay ); ?>" data-count="<?php echo esc_attr( $items_per_row ); ?>" data-dots="false" data-arrows="true">
					<div class="c-slider__inner">
						<?php 
						foreach ( $all_categories as $key => $value ) {
				            	if ( $value->category_parent != 0 ) {
				            		$parent_term = get_term_by( 'id', $value->category_parent, 'product_cat' );
				            	} else {
				            		$parent_term = '';
				            	}

			            		$cat_thumb_id = get_woocommerce_term_meta( $value->term_id, 'thumbnail_id', true );
			    				$cat_thumb = wp_get_attachment_image_src( $cat_thumb_id, 'felis_misc_thumb_3' );
			    				$cat_thumb_url = $cat_thumb[0];
			    				if ( $cat_thumb_url == '' ) {
			    					$cat_thumb_url = wc_placeholder_img_src();
			    				}
			    				$cat_url = get_term_link( $value->term_id, 'product_cat' );
			    				
			            		?>
					           <div class="c-slider_item">
									<div class="c-thumbnail">
										<a href="<?php echo esc_url( $cat_url );?>"><img src="<?php echo esc_url( $cat_thumb_url ); ?>" class="img-responsive" alt="<?php echo esc_attr( $value->name ); ?>">
										</a>
									</div>
									<div class="c-content">
										<?php if ( $value->category_description != '' ): ?>
										<div class="c-quote">
											<blockquote class="limit-lines_3">
												<p><?php echo esc_html( $value->category_description ); ?></p>
											</blockquote>
										</div>
										<?php endif; ?>
										<div class="c-name">
											<div class="text-gradient">
												<h3 class="font-heading c-title"><a href="<?php echo esc_url( $cat_url );?>"><?php echo esc_html( $value->name ); ?></a></h3>
											</div>
										</div>
										<?php if ( $parent_term != ''  ) : ?>
										<?php $parent_term_url = get_term_link( $parent_term->term_id, 'product_cat' ); ?>
										<div class="c-subtitle">
											<a href="<?php echo esc_url( $parent_term_url );?>"><?php echo esc_html( $parent_term->name ); ?></a>
										</div>
										<?php endif; ?>
									</div>
								</div>
			            		<?php

            			}
            			?>

					</div>
				</div>
			</div>
		</section>
		<?php
		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}

}

$categorySlider = new CactusWooCategorySlider();


/**
 * Register to Visual Composer
 */

add_action( 'after_setup_theme', 'reg_felis_woo_category_slider' );

function reg_felis_woo_category_slider() {
	if ( function_exists( 'vc_map' ) ) {

		$felis_woo_category_slider_params = CactusShortcode_Block::extend_params( array(


			array(
				'admin_label' => true,
				'type'        => 'textfield',
				'class'       => '',
				'heading'     => esc_html__( 'Total Items', 'felis' ),
				'param_name'  => 'count',
				'value'       => '',
				'description' => esc_html__( 'Set max limit for items slider. Leave blank to display all', 'felis' ),

				),


			array(
				'admin_label' => true,
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Select Number of items per row', 'felis' ),
				'param_name'  => 'items_per_row',
				'value'       => array(
					esc_html__( '2 items', 'felis' ) => '2',
					esc_html__( '3 items', 'felis' ) => '3',
					),
				'std'         => '2',
				'description' => esc_html__( 'The width of item depends on the number of items per row based on 12 columns. For example, if you choose 4 items per row, the width of each item will be 3 columns. Especially, if you want the width of each items is 3 columns, you can choose four items, then you just need to put 3 items per row.', 'felis' ),
				),


			array(
				'admin_label' => true,
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Autoplay', 'felis' ),
				'param_name'  => 'autoplay',
				'value'       => array(
					esc_html__( 'Disable', 'felis' ) => '0',
					esc_html__( 'Enable', 'felis' )  => '1',
					),
				'description' => esc_html__( 'Autoplay the slider or not', 'felis' ),
				),

			
			) );



vc_map( array(
	'name'                    => esc_html__( 'Felis Woo Category Slider', 'felis' ),
	'base'                    => 'felis_woo_category_slider',
	'content_element'         => true,
	'icon'                    => CT_SHORTCODE_PLUGIN_URL . '/shortcodes/img/ct_woo_category_slider.png',
	'category'                => esc_html__( 'Felis Shortcodes', 'felis' ),
	'params'                  => $felis_woo_category_slider_params,
	) );
}

}

