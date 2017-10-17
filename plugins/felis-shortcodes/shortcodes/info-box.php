<?php

/**
 * Class CactusInfoBox
 */
class CactusInfoBox extends CactusShortcode_Block {
	public function __construct( $params = null, $content = '' ) {
		parent::__construct( 'felis_info_box', $params, $content );
	}

	public function renderShortcode( $params, $content ) {

		$id     = isset( $params['id'] ) ? $params['id'] : 'c-info-box-' . rand( 1, 9999 );
		$box_style    = isset( $params['box_style'] ) && $params['box_style'] != '' ? $params['box_style'] : '1';
		$title  = isset( $params['title'] ) && $params['title'] != '' ? $params['title'] : '';
		$subtitle  = isset( $params['subtitle'] ) && $params['subtitle'] != '' ? $params['subtitle'] : '';
		$image  = isset( $params['image'] ) && $params['image'] != '' ? $params['image'] : '';
		$image_align = isset( $params['image_align'] ) && $params['image_align'] != '' ? $params['image_align'] : 'right';
		$content_align = isset( $params['content_align'] ) && $params['content_align'] != '' ? $params['content_align'] : 'left';
		$padding_bottom = isset( $params['padding_bottom'] ) && $params['padding_bottom'] != '' ? $params['padding_bottom'] : '';

		if ( $padding_bottom != '' ) {
			$padding_bottom = 'style="padding-bottom:'.$padding_bottom.';"';
		}

		if ( $image != '' &&  is_numeric( $image ) ) {
			$image_src = wp_get_attachment_image_src( $image, 'full' );
			$image_src = $image_src[0];
		}
		$content = preg_replace( '#^<\/p>|<p>$#', '', $content );
		ob_start();
		?>
		<section id="<?php echo esc_attr( $id ); ?>" class="felis-section felis_5 felis-info-box style-<?php echo esc_attr( $box_style ); ?>" style="background:url(<?php echo esc_attr( $image_src ); ?>) no-repeat top <?php echo esc_attr( $image_align ); ?>; background-size:contain">
			<!-- <div class="row"> -->
				<div class="col-md-12 header-panel">
					<div class="text-gradient">
						<h2 class="font-special"><?php echo esc_html( $title ); ?></h2>
					</div>
					<h3 class="font-heading"><?php echo esc_html( $subtitle ); ?></h3>
				</div>
				<?php if ( $content_align == 'left' ) :?>
				<div class="col-md-4 col-xs-12 content-panel" <?php echo wp_kses_post( $padding_bottom ); ?>>
					<?php echo do_shortcode( $content, true ); ?>
				</div>
				<?php endif; ?>
				<div class="col-md-4">
				</div>
				<?php if ( $content_align == 'right' ) :?>
				<div class="col-md-4 col-xs-12 content-panel" <?php echo wp_kses_post( $padding_bottom ); ?>>
					<?php echo do_shortcode( $content, true ); ?>
				</div>
				<?php endif; ?>
			<!-- </div> -->
		</section>

		<?php
		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}

}

$InfoBox = new CactusInfoBox();


/**
 * Register to Visual Composer
 */

add_action( 'after_setup_theme', 'reg_felis_info_box' );

function reg_felis_info_box() {
	if ( function_exists( 'vc_map' ) ) {

		$felis_info_box_params = CactusShortcode_Block::extend_params( array(

			array(
				'admin_label' => true,
				'type'        => 'dropdown',
				'class'       => '',
				'heading'     => esc_html__( 'Box Style', 'felis' ),
				'param_name'  => 'box_style',
				'value'       => array(
					esc_html__( 'Style 1', 'felis' ) => '1',
					esc_html__( 'Style 2', 'felis' ) => '2',
					),
				'description' => esc_html__( 'Choose info box style', 'felis' ),
			),
		
			array(
				'admin_label' => true,
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Title', 'felis' ),
				'param_name'  => 'title',
				'value'       => '',
				'description' => esc_html__( 'Title of Box', 'felis' ),
				),

			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Subtitle', 'felis' ),
				'param_name' => 'subtitle',
				'value'      => '',
				'description' => esc_html__( 'Subtitle of Box', 'felis' ),
				'admin_label' => true,
				),

			array(
				'type'       => 'attach_image',
				'heading'    => esc_html__( 'Image', 'felis' ),
				'param_name' => 'image',
				'value'      => '',
				'admin_label' => true,
				),

			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Image Alignment', 'felis' ),
				'param_name' => 'image_align',
				'value'      => array(
					esc_html__( 'Right', 'felis' ) => 'right',
					esc_html__( 'Left', 'felis' )  => 'left',
					),
				),
			

			array(
				'type'       => 'textarea_html',
				'heading'    => esc_html__( 'Content', 'felis' ),
				'param_name' => 'content',
				'value'      => '',
				),

			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Content Alignment', 'felis' ),
				'param_name' => 'content_align',
				'value'      => array(
					esc_html__( 'Left', 'felis' )  => 'left',
					esc_html__( 'Right', 'felis' ) => 'right',
					),
				),

			array(
				"type"        => "textfield",
				"heading"     => esc_html__( "Content Padding Bottom", 'felis' ),
				"param_name"  => "padding_bottom",
				"value"       => "",
				"description" => esc_html__( 'In pixels. Example: 30px', 'felis' )
			),

			) );


		vc_map( array(
			'name'                    => esc_html__( 'Felis Info Box', 'felis' ),
			'base'                    => 'felis_info_box',
			'content_element'         => true,
			'icon'                    => CT_SHORTCODE_PLUGIN_URL . '/shortcodes/img/ct_info_box.png',
			'category'                => esc_html__( 'Felis Shortcodes', 'felis' ),
			'params'                  => $felis_info_box_params,
		) );
	}

}
