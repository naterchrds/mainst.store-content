<?php

/**
 * Class CactusInfoBox2
 */
class CactusInfoBox2 extends CactusShortcode_Block {
	public function __construct( $params = null, $content = '' ) {
		parent::__construct( 'felis_info_box_2', $params, $content );
	}

	public function renderShortcode( $params, $content ) {
		$id  = 'c-ib2-' . rand( 1, 9999 );
		$title  = isset( $params['title'] ) && $params['title'] != '' ? $params['title'] : '';
		$subtitle  = isset( $params['subtitle'] ) && $params['subtitle'] != '' ? $params['subtitle'] : '';
		$image  = isset( $params['image'] ) && $params['image'] != '' ? $params['image'] : '';
		$slide_url = '#';

		if ( $image != '' &&  is_numeric( $image ) ) {
			$image_src = wp_get_attachment_image_src( $image, 'full' );
			$image_src = $image_src[0];
		}
		ob_start();
		?>

		<section id="<?php echo esc_attr( $id ); ?>" class="felis-section felis_info_box_2">
			<div class="row">
				<div class="col-md-8 left-panel">
						<?php if ( $title != '' ) : ?>
						<div class="c-title">
							<div class="text-gradient">
								<h2 class="font-special"><a href="<?php echo esc_url( $slide_url ); ?>"><?php echo esc_html( $title  ); ?></a></h2>
							</div>
						</div>
						<?php endif; ?>
						<?php if ( $subtitle != '' ) : ?>
						<div class="sub-title">
							<h3><?php echo esc_html( $subtitle ); ?></h3>
						</div>
						<?php endif; ?>
						<?php if ( $image_src != '' ) : ?>
						<div class="c-content">
							<div class="c-thumb__wrap">
								<div class="c-thumb">
									<div class="c-thumb-inner c-image-default ib2-image">
										<img src="<?php echo esc_url( $image_src ); ?>" alt="<?php echo esc_attr( $title  ); ?>" class="img-responsive default-image" />
										<img src="<?php echo esc_url( $image_src ); ?>"  class="img-responsive replace-image" alt="replace-<?php echo esc_attr( $title  ); ?>" />
									</div>
								</div>
							</div>
						</div>
						<?php endif; ?>
					</div>
					
					<div class="col-md-4 right-panel">
						<ul class="list-unstyled">
							<?php 
								echo do_shortcode( str_replace( '[felis_info_box_item ', '[felis_info_box_item ', str_replace( '<br class="cactus_br" />', '', $content ) ) );
							?>
							
						</ul>
					</div>
				
			</div>
		</section>


		<?php
		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}

}

$infoBox2 = new CactusInfoBox2();

/**
 * Class CactusIB2Item
 */
class CactusIB2Item extends CactusShortcode_Element {
	public function __construct( $params = null, $content = '' ) {
		parent::__construct( 'felis_info_box_item', $params, $content );
		$this->wrapper_tag = 'li';
	}

	

	/**
	 * @param $params
	 * @param $content
	 *
	 * @return string
	 */
	public function renderShortcode( $params, $content ) {
		$item_image  = isset( $params['item_image'] ) && $params['item_image'] != '' ? $params['item_image'] : '';
		$slide_url  = isset( $params['slide_url'] ) && $params['slide_url'] != '' ? $params['slide_url'] : '#';
		$title  = isset( $params['title'] ) && $params['title'] != '' ? $params['title'] : '';
		$item_title  = isset( $params['item_title'] ) && $params['item_title'] != '' ? $params['item_title'] : '';
		$animation  = isset( $params['animation'] ) && $params['animation'] != '' ? $params['animation'] : '';
		$item_number = isset( $params['item_number'] ) && $params['item_number'] != '' ? $params['item_number'] : '';
		

		$content = preg_replace( '#^<\/p>|<p>$#', '', $content );

		if ( $item_image != '' &&  is_numeric( $item_image ) ) {
			$image_src = wp_get_attachment_image_src( $item_image, 'full' );
			$image_src = $image_src[0];
		}

		$effect_css        = $this->get_element_classes( $params );
		$effect_attributes = $this->get_element_attributes( $params );
		ob_start();
		
		?>
			<li class="ib2-item <?php echo esc_attr( $effect_css ); ?>" data-img="<?php echo esc_url( $image_src ); ?>" <?php echo $effect_attributes; ?>>
				<?php if ( $item_title != '' ) : ?>
					<div class="header-item">
						<span class="number-item"><?php echo esc_html( $item_number ); ?></span>
						<h5 class="title-item"><?php echo esc_html( $item_title  ); ?></h5>
					</div>
				<?php endif; ?>
				<?php if ( $content != '' ) : ?>
					<div class="c-content content-text content-item">
						<?php echo do_shortcode( $content, true ); ?>
					</div>
				<?php endif; ?>
			</li>
					
		<?php
		

		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}
}

$info_box_2_item = new CactusIB2Item();

/**
 * Register to Visual Composer
 */

add_action( 'after_setup_theme', 'reg_felis_info_box_2' );

function reg_felis_info_box_2() {
	if ( function_exists( 'vc_map' ) ) {

		$felis_info_box_2_params = CactusShortcode_Block::extend_params( array(
			array(
				'admin_label' => true,
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Title', 'felis' ),
				'param_name'  => 'title',
				'value'       => '',
				'description' => esc_html__( 'Title of Box', 'felis' ),
				),

			array(
				'admin_label' => true,
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Title Url', 'felis' ),
				'param_name'  => 'title_url',
				'value'       => '',
				'description' => esc_html__( 'Title of Box', 'felis' ),
				),

			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Subtitle', 'felis' ),
				'param_name' => 'subtitle',
				'value'      => '',
				'description' => esc_html__( 'Subtitle of Box', 'felis' ),
				),
			array(
				'type'       => 'attach_image',
				'heading'    => esc_html__( 'Default Image', 'felis' ),
				'param_name' => 'image',
				'value'      => '',
				'admin_label' => true,
				),
			) 
		);

	$felis_info_box_item_params = CactusShortcode_Element::extend_params( array(
		array(
			'admin_label' => true,
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Number of item', 'felis' ),
			'param_name'  => 'item_number',
			'value'       => '',
			'description' => esc_html__( 'Number of item show on front-end', 'felis' ),
			),

		array(
			'admin_label' => true,
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Title', 'felis' ),
			'param_name'  => 'item_title',
			'value'       => '',
			'description' => esc_html__( 'Title of Item', 'felis' ),
			),

		array(
			'type'       => 'attach_image',
			'heading'    => esc_html__( 'Image', 'felis' ),
			'param_name' => 'item_image',
			'value'      => '',
			'admin_label' => true,
			),

		array(
			'type'       => 'textarea_html',
			'heading'    => esc_html__( 'Content', 'felis' ),
			'param_name' => 'content',
			'value'      => '',
			),


	) );

	vc_map( array(
		'name'                    => esc_html__( 'Felis Info Box 2', 'felis' ),
		'base'                    => 'felis_info_box_2',
		'content_element'         => true,
		'as_parent'               => array( 'only' => 'felis_info_box_item' ),
		'icon'                    => CT_SHORTCODE_PLUGIN_URL . '/shortcodes/img/ct_content_slider.png',
		'category'                => esc_html__( 'Felis Shortcodes', 'felis' ),
		'show_settings_on_create' => true,
		'params'                  => $felis_info_box_2_params,
		'js_view'                 => 'VcColumnView',
		) );

	vc_map( array(
		'name'            => esc_html__( 'Info Box 2 Item', 'felis' ),
		'base'            => 'felis_info_box_item',
		'content_element' => true,
		'as_child'        => array( 'only' => 'felis_info_box_2' ),
							// Use only|except attributes to limit parent (separate multiple values with comma)
		'icon'            => CT_SHORTCODE_PLUGIN_URL . '/shortcodes/img/ct_content_slide.png',
		'params'          => $felis_info_box_item_params,
		) );
	}
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_felis_info_box_2 extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_felis_info_box_item extends WPBakeryShortCode {
		}
	}
}