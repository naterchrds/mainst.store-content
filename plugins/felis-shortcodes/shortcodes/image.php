<?php

	/**
	 * CactusShortcode_Image
	 */
	class CactusShortcode_Image extends CactusShortcode_Element {
		public function __construct( $params = null, $content = '' ) {
			parent::__construct( 'felis_image', $params, $content );
		}

		/**
		 * @param $atts
		 * @param $content
		 *
		 * @return string
		 */
		public function renderShortcode( $atts, $content ) {
			$id          = isset( $atts['id'] ) ? $atts['id'] : '';
			$image       = isset( $atts['image'] ) ? $atts['image'] : '';
			$image_size  = isset( $atts['image_size'] ) ? $atts['image_size'] : 'full';
			$image_link  = isset( $atts['image_link'] ) ? $atts['image_link'] : '';
			$hover_style = isset( $atts['hover_style'] ) ? $atts['hover_style'] : 'default';
			$image_alignment = isset( $atts['image_alignment'] ) ? $atts['image_alignment'] : 'pull-left';
			
			

			if ( $image != '' &&  is_numeric( $image ) ) {
				$image_src = wp_get_attachment_image_src( $image, $image_size );
				$image_alt = get_post_meta( $image, '_wp_attachment_image_alt', true );
				$image_src = $image_src[0];
			}
			ob_start();
			if ( $image_src != '' ):
				?>
						<div class="c-thumb__wrap">
                            <div class="c-thumb">
                                <div class="c-thumb-inner c-image-<?php echo esc_attr( $hover_style ); ?>">
                                	<?php if ( $image_link != '' ) : ?>
                                	<a href="<?php echo esc_attr( $image_link ); ?>">
                                	<?php endif; ?>
                                        <img src="<?php echo esc_url( $image_src ); ?>" class="img-responsive <?php echo esc_attr( $image_alignment ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
                                    <?php if ( $image_link != '' ) : ?>
                                	</a>
                                	<?php endif; ?>
                                </div>
                            </div>
                        </div>
				<?php
			endif;
			$output = ob_get_contents();
			ob_end_clean();

			return $output;
		}
	
	}

	$cactus_image = new CactusShortcode_Image();

	/**
	 * add button to visual composer
	 */
	add_action( 'after_setup_theme', 'reg_felis_image' );

	function reg_felis_image() {
		if ( function_exists( 'vc_map' ) ) {
			$params = CactusShortcode_Element::extend_params(
				array(
					array(
						"type"       => "attach_image",
						"heading"    => esc_html__( "Image", 'felis' ),
						"param_name" => "image",
						"value"      => "",
						"admin_label" => true,
					),

					array(
						"type"       => "textfield",
						"heading"    => esc_html__( "Image Size", 'felis' ),
						"param_name" => "image_size",
						'description' => esc_html__( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'felis' ),
						"value"      => "full",
						"admin_label" => true,
					),

					array(
						"type"       => "textfield",
						"heading"    => esc_html__( "Image Link", 'felis' ),
						"param_name" => "image_link",
						'description' => esc_html__( 'Enter URL if you want this image to have a link', 'felis' ),
						"value"      => "#",
					),
					
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__( 'Image Hover Style', 'felis' ),
						'param_name'  => 'hover_style',
						'value'       => array(
							esc_html__( 'None', 'felis' )   => 'default',
							esc_html__( 'Glow', 'felis' )   => 'glow',
							esc_html__( 'Add Color', 'felis' )  => 'color',
							esc_html__( 'Gray Scale', 'felis' ) => 'grayscale',
							esc_html__( 'Fade In', 'felis' ) => 'fade-in',
							esc_html__( 'Fade Out', 'felis' ) => 'fade-out',
							esc_html__( 'Add Overlay', 'felis' ) => 'overlay-add',
							esc_html__( 'Remove Overlay', 'felis' ) => 'overlay-remove',
							esc_html__( 'Blur', 'felis' ) => 'blur',
							esc_html__( 'Zoom In', 'felis' ) => 'zoom',
						),
						'admin_label' => true,
					),

					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__( 'Image Aligment', 'felis' ),
						'description'     => esc_html__( 'Select image alignment.', 'felis' ),
						'param_name'  => 'image_alignment',
						'value'       => array(
							esc_html__( 'Left', 'felis' )   => 'pull-left',
							esc_html__( 'Center', 'felis' )  => 'center-block',
							esc_html__( 'Right', 'felis' ) => 'pull-right',
						),
						'admin_label' => true,
					),

				)
			);
			vc_map( array(
				'name'     => esc_html__( 'Felis Image', 'felis' ),
				'base'     => 'felis_image',
				'icon'     => CT_SHORTCODE_PLUGIN_URL . '/shortcodes/img/ct_image.png',
				'category' => esc_html__( 'Felis Shortcodes', 'felis' ),
				'params'   => $params,
			) );
		}
	}