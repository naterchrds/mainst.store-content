<?php

/**
 * Class CactusContentSlider
 */
class CactusContentSlider extends CactusShortcode_Block {
	public function __construct( $params = null, $content = '' ) {
		parent::__construct( 'felis_content_slider', $params, $content );
	}

	public function renderShortcode( $params, $content ) {
		$id  = 'c-content-slide-' . rand( 1, 9999 );
		$item_style    = isset( $params['item_style'] ) && $params['item_style'] != '' ? $params['item_style'] : '1';
		$wrap_style    = isset( $params['wrap_style'] ) && $params['wrap_style'] != '' ? $params['wrap_style'] : '';
		$title  = isset( $params['title'] ) && $params['title'] != '' ? $params['title'] : '';
		$subtitle  = isset( $params['subtitle'] ) && $params['subtitle'] != '' ? $params['subtitle'] : '';

		ob_start();
		?>
	
		<section id="<?php echo esc_attr( $id ); ?>" class="felis-section ct_content_slider felis_4 style-<?php echo $item_style; ?>">
			<?php if ( $wrap_style == '') : ?>
			<div class="c-slider_wrap post-slider" data-autoplay="0" data-dots="1" data-count="1" data-fade="true">
				<div class="c-slider__inner <?php echo ( $item_style != 1 ) ? 'overlay-gradient' : '' ?>">
					<?php echo do_shortcode( str_replace( '[felis_content_slide ', '[felis_content_slide  title="'.$title.'" subtitle="'.$subtitle.'" item_style="' . $item_style . '" ', str_replace( '<br class="cactus_br" />', '', $content ) ) ); ?>
				</div>
			</div>
		<?php else: ?>
		<?php
		   $items_count  = substr_count( $content, "[felis_content_slide" );
		   $content_reg = preg_match_all( '/\[felis_content_slide(.*?)?\](?:(.+?)?\[\/felis_content_slide\])?/s', $content, $matches );
		?>
			    <div class="c-page-scroll">
			        <div id="menu-center">
			            <ul>
			            	<?php
			            	$j = 0;
			            	for ( $i=0; $i < $items_count ; $i++ ) { 
			            		$j++;
			            		if ( $j == 1 ) {
			            			$active = 'class="active"';
			            		}
			            		?>
			            		<li>
			            			<a <?php echo $active; ?> href="#scr-item-<?php echo esc_html( $j ); ?>">0<?php echo esc_html( $j ); ?></a>
			                	</li>
			            		<?php
			            	}
			                ?>
			            </ul>
			        </div>
			        <?php
			        $count = 0;
			        foreach ( $matches[0] as $content_match ) {
                        $count ++;
                        ?>
                        <div class="c-scroll-item" id='scr-item-<?php echo esc_attr( $count ); ?>'>
                        <?php
                        	echo do_shortcode( str_replace( '[felis_content_slide ', '[felis_content_slide wrap_style="'.$wrap_style.'" title="'.$title.'" subtitle="'.$subtitle.'" item_style="' . $item_style . '" ', str_replace( '<br class="cactus_br" />', '', $content_match ) ) );
                        ?>
                    	</div>
                        <?php
                    }
			        ?>
			        </div>
			<?php endif; ?>
			
		</section>




		<?php
		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}

}

$contentSlider = new CactusContentSlider();

/**
 * Class CactusContentSlide
 */
class CactusContentSlide extends CactusShortcode_Element {
	public function __construct( $params = null, $content = '' ) {
		parent::__construct( 'felis_content_slide', $params, $content );
	}

	/**
	 * @param $params
	 * @param $content
	 *
	 * @return string
	 */
	public function renderShortcode( $params, $content ) {
		$wrap_style  = isset( $params['wrap_style'] ) && $params['wrap_style'] != '' ? $params['wrap_style'] : '';
		$image  = isset( $params['image'] ) && $params['image'] != '' ? $params['image'] : '';
		$bg_image  = isset( $params['bg_image'] ) && $params['bg_image'] != '' ? $params['bg_image'] : '';
		$slide_url  = isset( $params['slide_url'] ) && $params['slide_url'] != '' ? $params['slide_url'] : '#';
		$title  = isset( $params['title'] ) && $params['title'] != '' ? $params['title'] : '';
		$subtitle  = isset( $params['subtitle'] ) && $params['subtitle'] != '' ? $params['subtitle'] : '';
		$animation  = isset( $params['animation'] ) && $params['animation'] != '' ? $params['animation'] : '';
		
		$image_src = '';
		$bg = '';

		if ( $bg_image != '' &&  is_numeric( $bg_image ) ) {
			$bg_image_src = wp_get_attachment_image_src( $bg_image, 'full' );
			$bg_image_src = $bg_image_src[0];
			$bg = 'style="background-image: url('.$bg_image_src.');background-size: cover;background-position: center; "';
		}

		if ( $image != '' &&  is_numeric( $image ) ) {
			$image_src = wp_get_attachment_image_src( $image, 'full' );
			$image_src = $image_src[0];
		}
		$content = preg_replace( '#^<\/p>|<p>$#', '', $content );
		ob_start();
		?>
		<?php if ( $wrap_style == '' ) : ?>
			<div class="c-slider_item bg-slider b-lazy" <?php echo ( $bg != '') ? wp_kses_post( $bg ) : ''; ?> >
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-sm-offset-right-4">
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
						</div>
						<?php if ( $image_src != '' ) : ?>
						<div class="col-sm-6 col-md-4">
							<div class="c-content">
								<div class="c-thumb__wrap">
									<div class="c-thumb" data-animation="<?php echo esc_attr( $animation ); ?>">
										<div class="c-thumb-inner c-image-default">
											<a href="<?php echo esc_url( $slide_url ); ?>">
												<img src="<?php echo esc_url( $image_src ); ?>" alt="<?php echo esc_attr( $title  ); ?>" class="img-responsive">
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php endif; ?>
						<?php if ( $content != '' ) : ?>
						<div class="col-sm-6 col-md-4">
							<div class="c-content content-text" data-animation="<?php echo esc_attr( $animation ); ?>">
								<?php echo do_shortcode( $content, true ); ?>
							</div>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php
		else :
		?>
	      <div class="container">
	        <div class="item-content">
	            <div class="item-content_wrap">
	                <div class="row">
	                    <div class="col-md-8 col-sm-offset-right-4">
	                    	<?php if ( $title != '' ) : ?>
	                        <div class="c-title">
	                            <div class="text-gradient">
	                                <h2 class="font-special"><a href="<?php echo esc_url( $slide_url ); ?>" tabindex="0"><?php echo esc_html( $title  ); ?></a></h2>
	                            </div>
	                        </div>
	                        <?php endif; ?>
	                        <?php if ( $subtitle != '' ) : ?>
	                        <div class="sub-title">
	                            <h3><?php echo esc_html( $subtitle ); ?></h3>
	                        </div>
	                         <?php endif; ?>
	                    </div>
	                    <?php if ( $image_src != '' ) : ?>
	                    <div class="col-sm-6 col-md-4">
	                        <div class="c-content">
	                            <div class="c-thumb__wrap">
	                                <div class="c-thumb animated" data-animation="<?php echo esc_attr( $animation ); ?>">
	                                    <div class="c-thumb-inner c-image-default">
	                                        <a href="<?php echo esc_url( $slide_url ); ?>" tabindex="0">
												<img src="<?php echo esc_url( $image_src ); ?>" alt="<?php echo esc_attr( $title  ); ?>" class="img-responsive">
											</a>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <?php endif; ?>
	                    <?php if ( $content != '' ) : ?>
						<div class="col-sm-6 col-md-4">
							<div class="c-content content-text" data-animation="<?php echo esc_attr( $animation ); ?>">
								<?php echo do_shortcode( $content, true ); ?>
							</div>
						</div>
						<?php endif; ?>
	                </div>
	            </div>
	        </div>
	    </div>
	    <?php if ( isset( $bg_image_src ) &&  $bg_image_src != '' ): ?>
	    <div class="bgs">
	        <div class="bg_content">
	            <img src="<?php echo esc_url( $bg_image_src ); ?>" alt="background-<?php echo esc_attr( $title ); ?>">
	        </div>
	    </div>
        <?php
        endif;
		endif;


		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}
}

$contentSlide = new CactusContentSlide();

/**
 * Register to Visual Composer
 */

add_action( 'after_setup_theme', 'reg_felis_content_slider' );

function reg_felis_content_slider() {
	if ( function_exists( 'vc_map' ) ) {

		$felis_content_slider_params = CactusShortcode_Block::extend_params( array(

			array(
				'admin_label' => true,
				'type'        => 'dropdown',
				'class'       => '',
				'heading'     => esc_html__( 'Wrap Style', 'felis' ),
				'param_name'  => 'wrap_style',
				'value'       => array(
					esc_html__( 'Normal', 'felis' ) => '',
					esc_html__( 'By Scroll', 'felis' ) => 'by_scroll',
					),
				'description' => esc_html__( 'Choose Style', 'felis' ),
				),
			array(
				'admin_label' => true,
				'type'        => 'dropdown',
				'class'       => '',
				'heading'     => esc_html__( 'Item Style', 'felis' ),
				'param_name'  => 'item_style',
				'value'       => array(
					esc_html__( 'Style 1', 'felis' ) => '1',
					esc_html__( 'Style 2', 'felis' ) => '2',
					esc_html__( 'Style 3', 'felis' ) => '3',
					),
				'description' => esc_html__( 'Choose Style', 'felis' ),
				),
			array(
				'admin_label' => true,
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Title', 'felis' ),
				'param_name'  => 'title',
				'value'       => '',
				'description' => esc_html__( 'Title of Slider', 'felis' ),
				),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Subtitle', 'felis' ),
				'param_name' => 'subtitle',
				'value'      => '',
				'description' => esc_html__( 'Subtitle of Slider', 'felis' ),
				),
			) 
		);

	$felis_content_slide_params = array(
		

		array(
			'type'       => 'attach_image',
			'heading'    => esc_html__( 'Image', 'felis' ),
			'param_name' => 'image',
			'value'      => '',
			'admin_label' => true,
			),

		array(
			'type'       => 'textarea_html',
			'heading'    => esc_html__( 'Content', 'felis' ),
			'param_name' => 'content',
			'value'      => '',
			),

		array(
			'type'       => 'attach_image',
			'heading'    => esc_html__( 'Background Image', 'felis' ),
			'param_name' => 'bg_image',
			'value'      => '',
			'admin_label' => true,
			),

		array(
			'type' => 'animation_style',
			'heading' => __( 'Content Come In Animation', 'felis' ),
			'param_name' => 'animation',
			'value' => '',
			'settings' => array(
				'type' => 'in',
				'custom' => array(
					array(
						'label' => __( 'Default', 'felis' ),
						'values' => array(
							__( 'Top to bottom', 'felis' ) => 'top-to-bottom',
							__( 'Bottom to top', 'felis' ) => 'bottom-to-top',
							__( 'Left to right', 'felis' ) => 'left-to-right',
							__( 'Right to left', 'felis' ) => 'right-to-left',
							__( 'Appear from center', 'felis' ) => 'appear',
						),
					),
				),
			),
			'description' => __( 'Select type of animation for content to be animated when slider changed (Note: works only in modern browsers).', 'felis' ),
		),



		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Slide Url', 'felis' ),
			'param_name'  => 'slide_url',
			'value'       => '',
			'description' => esc_html__( 'URL to navigate', 'felis' ),
			),

	);

	vc_map( array(
		'name'                    => esc_html__( 'Felis Content Slider', 'felis' ),
		'base'                    => 'felis_content_slider',
		'content_element'         => true,
		'as_parent'               => array( 'only' => 'felis_content_slide' ),
		'icon'                    => CT_SHORTCODE_PLUGIN_URL . '/shortcodes/img/ct_content_slider.png',
		'category'                => esc_html__( 'Felis Shortcodes', 'felis' ),
		'show_settings_on_create' => true,
		'params'                  => $felis_content_slider_params,
		'js_view'                 => 'VcColumnView',
		) );

	vc_map( array(
		'name'            => esc_html__( 'Content Slide', 'felis' ),
		'base'            => 'felis_content_slide',
		'content_element' => true,
		'as_child'        => array( 'only' => 'felis_content_slider' ),
							// Use only|except attributes to limit parent (separate multiple values with comma)
		'icon'            => CT_SHORTCODE_PLUGIN_URL . '/shortcodes/img/ct_content_slide.png',
		'params'          => $felis_content_slide_params,
		) );
	}
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_felis_content_slider extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_felis_content_slide extends WPBakeryShortCode {
		}
	}
}