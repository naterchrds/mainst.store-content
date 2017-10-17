<?php

/**
 * Class CactusWooProductSlider
 */
class CactusWooProductSlider extends CactusShortcode_Block {
	public function __construct( $params = null, $content = '' ) {
		parent::__construct( 'felis_woo_product_slider', $params, $content );
	}

	public function renderShortcode( $params, $content ) {

		$id              = isset( $params['id'] ) ? $params['id'] : 'c-content-slide-2-' . rand( 1, 9999 );
		$count           = isset( $params['count'] ) && $params['count'] != '' ? $params['count'] : 12;
		$layout          = isset( $params['layout'] ) && $params['layout'] != '' ? $params['layout'] : 1;
		$cats            = isset( $params['product_cat'] ) ? $params['product_cat'] : '';
		$products        = isset( $params['product'] ) ? $params['product'] : '';
		$order           = isset( $params['order'] ) ? $params['order'] : 'DESC';
		$orderby         = isset( $params['orderby'] ) ? $params['orderby'] : 'date';
		$items_per_row   = isset( $params['items_per_row'] ) && $params['items_per_row'] != '' ? $params['items_per_row'] : 3;
		$autoplay        = isset( $params['autoplay'] ) && $params['autoplay'] != '' ? $params['autoplay'] : '0';
		$shortcode_query = App\Models\Database::getPosts( $count, $order, 1, $orderby, array(
			'categories' => $cats,
			'category_taxonomy' => 'product_cat',
			'ids'        => $products,
			'post_type'  => 'product',
		) );

		if ( $layout == 2 ) {
			$class = 'btn btn-add-cart';
		}

		if ( $items_per_row > 2 ) {
			$image_size = 'felis_misc_thumb_1';
		} else {
			$image_size = 'felis_misc_thumb_3';
		}


		ob_start();
		?>
		<section class="felis-section woocommerce">
			<div id="<?php echo esc_attr( $id ); ?>" class="sc-slider product-slider style-<?php echo esc_attr( $layout ); ?>">
				<div class="c-slider_wrap" data-autoplay="<?php echo esc_attr( $autoplay ); ?>" data-count="<?php echo esc_attr( $items_per_row ); ?>" data-dots="false" data-arrows="true">
					<div class="c-slider__inner">
		<?php
			if ( $shortcode_query->have_posts() ) {

				while ( $shortcode_query->have_posts() ) {
					$shortcode_query->the_post();

					$product = wc_get_product( get_the_id() );
					?>
					<div class="c-slider_item">
						<div class="product_wrap">
							<div class="product-inner">
								<?php woocommerce_show_product_loop_sale_flash(); ?>
								<div class="product-thumbnail">
									<a href="<?php echo get_permalink(); ?>"><?php 
									if ( has_post_thumbnail() ) {
										echo get_the_post_thumbnail( get_the_id(), $image_size, array( 'class' => 'img-responsive' ) ); 
									} else {
										wc_placeholder_img( $image_size );
									}
									
									?>
									</a>
								</div>
								<div class="product-content">
									<div class="product-name">
										<h3><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
									</div>
									<?php if ( $layout == 2 ): ?>
									<?php  echo wc_get_product_category_list( get_the_id() ,', ', '<div class="product-cats"><h4>', '</h4></div>' ); ?>
									<?php  echo $product->get_price_html(); ?>
									<?php endif; ?>
									<?php if ( $layout == 1 ): ?>
									<div class="product-price">
										<span><?php echo $product->get_price_html(); ?></span>
									</div>
									<?php endif; ?>
									<div class="add-cart">
										<?php echo apply_filters( 'woocommerce_loop_add_to_cart_link',
											sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s"><i class="ion-ios-cart"></i>%s</a>',
												esc_url( $product->add_to_cart_url() ),
												1,
												esc_attr( $product->get_id() ),
												esc_attr( $product->get_sku() ),
												esc_attr( isset( $class ) ? $class : 'button product_type_'.$product->get_type().' add_to_cart_button ajax_add_to_cart' ),
												esc_html( $product->add_to_cart_text() )
											),
										$product ); ?>
									</div>
								</div>
							</div>
						</div>
					</div>

					<?php

				}
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

$productSlider = new CactusWooProductSlider();


/**
 * Register to Visual Composer
 */

add_action( 'after_setup_theme', 'reg_felis_woo_product_slider' );

function reg_felis_woo_product_slider() {
	if ( function_exists( 'vc_map' ) ) {

		$felis_woo_product_slider_params = CactusShortcode_Block::extend_params( array(



			array(
				'admin_label' => true,
				'type'        => 'dropdown',
				'class'       => '',
				'heading'     => esc_html__( 'Layout Style', 'felis' ),
				'param_name'  => 'layout',
				'value'       => array(
					esc_html__( 'Style 1', 'felis' ) => '1',
					esc_html__( 'Style 2', 'felis' ) => '2',
					),
				'description' => esc_html__( 'Choose layout style to show', 'felis' ),
			),

			array(
				'admin_label' => true,
				'type'        => 'textfield',
				'class'       => '',
				'heading'     => esc_html__( 'Total Items', 'felis' ),
				'param_name'  => 'count',
				'value'       => '12',
				'description' => esc_html__( 'Set max limit for items slider or enter -1 to display all (limited to 1000).', 'felis' ),
		
			),


			array(
				'admin_label' => true,
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Select Number of items per row', 'felis' ),
				'param_name'  => 'items_per_row',
				'value'       => array(
					esc_html__( '2 items', 'felis' ) => '2',
					esc_html__( '3 items', 'felis' ) => '3',
					esc_html__( '4 items', 'felis' ) => '4',
					esc_html__( '6 items', 'felis' ) => '6',
					),
				'std'         => '3',
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


			array(
				'type' => 'autocomplete',
				'heading' => __( 'Select Specific Categories', 'felis' ),
				'param_name' => 'product_cat',
				'settings' => array(
								'multiple' => true,
								'sortable' => true,
								'unique_values' => true,
								// In UI show results except selected. NB! You should manually check values in backend
							),
				'description' => __( 'Search for product category name to get autocomplete suggestions', 'felis' ),
			),

			


			array(
				'type'        => 'autocomplete',
				'heading'     => __( 'Select Specific Products', 'felis' ),
				'param_name'  => 'product',
				'settings' => array(
									'multiple' => true,
									'sortable' => true,
									'unique_values' => true,
									// In UI show results except selected. NB! You should manually check values in backend
								),
				'description' => __( 'Search for product ID or product title to get autocomplete suggestions', 'felis' ),
			),

			
			array(
				'type'        => 'dropdown',
				'admin_label' => true,
				'class'       => '',
				'heading'     => esc_html__( 'Order by', 'felis' ),
				'param_name'  => 'orderby',
				'value'       => array(
					esc_html__( 'Date', 'felis' )           => 'date',
					esc_html__( 'ID', 'felis' )             => 'ID',
					esc_html__( 'Author', 'felis' )         => 'author',
					esc_html__( 'Title', 'felis' )          => 'title',
					esc_html__( 'Name', 'felis' )           => 'name',
					esc_html__( 'Modified', 'felis' )       => 'modified',
					esc_html__( 'Random', 'felis' )         => 'rand',
					esc_html__( 'Comment count', 'felis' )  => 'comment_count',
					esc_html__( 'Menu order', 'felis' )     => 'menu_order',
				),
				'description' => 'Select how to sort retrieved products. More at <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>. Default by Title'
			),

			array(
				'type'        => 'dropdown',
				'admin_label' => true,
				'class'       => '',
				'heading'     => esc_html__( 'Order', 'felis' ),
				'param_name'  => 'order',
				'value'       => array(
					esc_html__( 'DESC', 'felis' ) => 'DESC',
					esc_html__( 'ASC', 'felis' )  => 'ASC',
				),
				'description' => 'Designates the ascending or descending order. More at <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>. Default by ASC'
			),
		) );

	

	vc_map( array(
		'name'                    => esc_html__( 'Felis Woo Product Slider', 'felis' ),
		'base'                    => 'felis_woo_product_slider',
		'content_element'         => true,
		'icon'                    => CT_SHORTCODE_PLUGIN_URL . '/shortcodes/img/ct_woo_product_slider.png',
		'category'                => esc_html__( 'Felis Shortcodes', 'felis' ),
		'params'                  => $felis_woo_product_slider_params,
		) );
	}

}

function felis_product_autocomplete_suggester( $query) {
	global $wpdb;
	$post_id = (int) $query;
	$post_results = $wpdb->get_results( $wpdb->prepare( "SELECT a.ID AS id, a.post_title AS title FROM {$wpdb->posts} AS a
				WHERE a.post_type = 'product' AND a.post_status != 'trash' AND ( a.ID = '%d' OR a.post_title LIKE '%%%s%%' )", $post_id > 0 ? $post_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

	$results = array();
	if ( is_array( $post_results ) && ! empty( $post_results ) ) {
		foreach ( $post_results as $value ) {
			$data = array();
			$data['value'] = $value['id'];
			$data['label'] = $value['title'];
			$results[] = $data;
		}
	}

	return $results;
}


function felis_product_autocomplete_suggester_render( $query ) {
	$query = trim( $query['value'] ); // get value from requested
	if ( ! empty( $query ) ) {

		$post_object = get_post( (int) $query );
		if ( is_object( $post_object ) ) {
			$post_title = $post_object->post_title;
			$post_id = $post_object->ID;

			$data = array();
			$data['value'] = $post_id;
			$data['label'] = $post_title;

			return ! empty( $data ) ? $data : false;
		}

		return false;
	}

	return false;
}

function felis_product_category_autocomplete_suggester( $query) {
    $term_results = get_terms( 'product_cat', array('name__like' => $query ) );

    $results = array();
    if ( is_array( $term_results ) && ! empty( $term_results ) ) {
        foreach ( $term_results as $value ) {
            $data = array();
            $data['value'] = $value->term_id;
            $data['label'] = $value->name;
            $results[] = $data;
        }
    }

    return $results;
}

function felis_product_category_autocomplete_suggester_render( $query ) {
    $query = trim( $query['value'] ); // get value from requested
    if ( ! empty( $query ) ) {

        $term_object = get_term_by( 'id', (int) $query, 'product_cat' );
        if ( is_object( $term_object ) ) {
            $term_id = $term_object->term_id;
            $term_name = $term_object->name;

            $data = array();
            $data['value'] = $term_id;
            $data['label'] = $term_name;

            return ! empty( $data ) ? $data : false;
        }

        return false;
    }

    return false;
}

add_filter( 'vc_autocomplete_felis_woo_product_slider_product_cat_callback', 'felis_product_category_autocomplete_suggester', 10, 1 );
add_filter( 'vc_autocomplete_felis_woo_product_slider_product_cat_render', 'felis_product_category_autocomplete_suggester_render', 10, 1 );

add_filter( 'vc_autocomplete_felis_woo_product_slider_product_callback', 'felis_product_autocomplete_suggester', 10, 1 );
add_filter( 'vc_autocomplete_felis_woo_product_slider_product_render', 'felis_product_autocomplete_suggester_render', 10, 1 );
