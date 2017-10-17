<?php

/**
 * Class CactusShortcodeTestimonials
 */
class CactusShortcodeTestimonials extends CactusShortcode_Block {
	public function __construct( $params = null, $content = '' ) {
		parent::__construct( 'felis_testimonials', $params, $content );
	}

	public function renderShortcode( $params, $content ) {
		$randID         = 'c-testimonials-' . rand( 1, 999 );
		$autoplay       = isset( $params['autoplay'] ) && $params['autoplay'] != '' ? $params['autoplay'] : true;
		$item_style     = isset( $params['item_style'] ) && $params['item_style'] != '' ? $params['item_style'] : '1';
		//start
		ob_start();
		?>

		<section id="<?php echo esc_attr( $randID ); ?>" class="c-testimonials felis-section style-<?php echo esc_attr( $item_style ); ?>" data-id="<?php echo esc_attr( $randID ); ?>" data-autoplay="<?php echo esc_attr( $autoplay ); ?>">
			<?php echo do_shortcode( str_replace( '[felis_testimonial ', '[felis_testimonial ', str_replace( '<br class="cactus_br" />', '', $content ) ) ); ?>
		</section>
		<?php
		//end
		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}

}

$CactusShortcodeTestimonials = new CactusShortcodeTestimonials();

/**
 * Class CactusShortcodeTestimonial
 */
class CactusShortcodeTestimonial extends CactusShortcode {
	public function __construct( $params = null, $content = '' ) {
		parent::__construct( 'felis_testimonial', $params, $content );
	}

	/**
	 * @param $params
	 * @param $content
	 *
	 * @return string
	 */
	public function renderShortcode( $params, $content ) {
		$avatar         = isset( $params['avatar'] ) && $params['avatar'] != '' ? $params['avatar'] : '';
		$name           = isset( $params['name'] ) && $params['name'] != '' ? $params['name'] : '';
		$title          = isset( $params['title'] ) && $params['title'] != '' ? $params['title'] : '';


		$avatar_url = $background_url = '';
		if ( is_numeric( $avatar ) ) {
			$avatar_url = wp_get_attachment_image_src( $avatar, 'thumbnail');
			$avatar_url = $avatar_url[0];
		} else {
			$avatar_url = $avatar;
		}

		ob_start();
		?>

		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="author-style-3">
					<div class="content">
						<div class="author-avatar"><img src="<?php echo esc_attr( $avatar_url ); ?>" class="img-responsive" alt="<?php echo esc_attr( $name ); ?>"></div>
						<div class="detail">
							<p class="author-description"><?php echo wp_kses_post( $content ); ?></p>
							<h5 class="author-name"><?php echo esc_html( $name ); ?></h5>
							<p class="author-job"><?php echo esc_html( $title ); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
		//end
		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}
}

$CactusShortcodeTestimonial = new CactusShortcodeTestimonial();

/**
 * Register to Visual Composer
 */

add_action( 'after_setup_theme', 'reg_felis_testimonials' );

function reg_felis_testimonials() {
	if ( function_exists( 'vc_map' ) ) {

		$testimonials_params = CactusShortcode_Block::extend_params( array(
			array(
				'admin_label' => true,
				'type'        => 'dropdown',
				'class'       => '',
				'heading'     => esc_html__( 'Item Style', 'felis' ),
				'param_name'  => 'item_style',
				'value'       => array(
					esc_html__( 'Style 1', 'felis' ) => '1',
					esc_html__( 'Style 2', 'felis' ) => '2',
					),
				'description' => esc_html__( 'Choose testimonial style', 'felis' ),
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
				'description' => esc_html__( 'Autoplay the testimonial slideshow or not', 'felis' ),
				),
			
			) );

		$testimonial_params = array(
			array(
				'type'        => 'attach_image',
				'heading'     => esc_html__( 'Avatar', 'felis' ),
				'param_name'  => 'avatar',
				'value'       => '',
				'description' => esc_html__( 'Avatar image', 'felis' ),
				),
			array(
				'admin_label' => true,
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Name', 'felis' ),
				'param_name'  => 'name',
				'value'       => '',
				'description' => esc_html__( 'Name of person', 'felis' ),
				),
			array(
				'admin_label' => true,
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Title', 'felis' ),
				'param_name'  => 'title',
				'value'       => '',
				'description' => esc_html__( 'Title of person', 'felis' ),
				),
			array(
				'type'       => 'textarea_html',
				'heading'    => esc_html__( 'Content', 'felis' ),
				'param_name' => 'content',
				'value'      => '',
				),
			);

		vc_map( array(
			'name'            => esc_html__( 'Felis Testimonials', 'felis' ),
			'base'            => 'felis_testimonials',
			'content_element' => true,
			'as_parent'       => array( 'only' => 'felis_testimonial' ),
			'icon'            => CT_SHORTCODE_PLUGIN_URL . '/shortcodes/img/ct_testimonials.png',
			'category'        => esc_html__( 'Felis Shortcodes', 'felis' ),
			'params'          => $testimonials_params,
			'js_view'         => 'VcColumnView'
			) );

		vc_map( array(
			'name'     => esc_html__( 'Testimonial Item', 'felis' ),
			'base'     => 'felis_testimonial',
			'as_child' => array( 'only' => 'felis_testimonials' ),
			// Use only|except attributes to limit parent (separate multiple values with comma)
			'icon'     => CT_SHORTCODE_PLUGIN_URL . '/shortcodes/img/ct_testimonial.png',
			'params'   => $testimonial_params,
			) );
	}
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_felis_testimonials extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_felis_testimonial extends WPBakeryShortCode {
		}
	}
}