<?php

	/**
	 * CactusTypo
	 */
	class CactusTypo extends CactusShortcode_Element {
		public function __construct( $params = null, $content = '' ) {
			parent::__construct( 'felis_typo', $params, $content );
		}

		/**
		 * @param $atts
		 * @param $content
		 *
		 * @return string
		 */
		public function renderShortcode( $atts, $content ) {
			$id          = isset( $atts['id'] ) ? $atts['id'] : '';
			$size        = isset( $atts['size'] ) ? $atts['size'] : '';
			$weight      = isset( $atts['weight'] ) ? $atts['weight'] : '';
			$style       = isset( $atts['style'] ) ? $atts['style'] : '';
			$color_style = isset( $atts['color_style'] ) ? $atts['color_style'] : 'default';
			$padding     = isset( $atts['padding'] ) ? $atts['padding'] : '';
			$margin      = isset( $atts['margin'] ) ? $atts['margin'] : '';
			$alignment   = isset( $atts['alignment'] ) ? $atts['alignment'] : 'left';
			$line_height = isset( $atts['line_height'] ) ? $atts['line_height'] : '';
			$html_tag    = isset( $atts['html_tag'] ) ? $atts['html_tag'] : 'div';
			$line_top    = isset( $atts['line_top'] ) ? $atts['line_top'] : false;

			$class = '';
			$class_html = '';
			if ( $color_style == 'default' ) {
				$class .= 'text-gradient';
			}

			if ( $line_top == true ) {
				$class_html .= 'class="line-top"';
			} 
			ob_start();
			if ( $content != '' ):
				?>
							<div <?php echo( $id != '' ? ( 'id="' . $id . '"' ) : '' ); ?> class="c-typo <?php echo 'text-' . esc_attr( $alignment ); ?> <?php echo esc_attr( $class ); ?>">
				  <?php echo '<' . $html_tag . ' '.$class_html.'>' . wp_kses_post( ltrim( rtrim( $content, '<p>' ), '</p>' ) ) . '</' . $html_tag . '>'; ?>
							</div>
				<?php
			endif;
			$output = ob_get_contents();
			ob_end_clean();

			return $output;
		}

		/**
		 * @param array $attrs
		 *
		 * @return string
		 */
		public function inlineCSSGenerator( $attrs = array() ) {
			$css      = '';
			$html_tag = 'div';
			$color_style = 'default';
			if ( count( $attrs ) == 0 ) {
				$attrs = $this->attributes;
			}

			if ( is_array( $attrs ) ) {

				foreach ( $attrs as $att => $val ) {
					switch ( $att ) {
						case 'size':
							if ( $attrs['size'] != '' ) {
								$css .= 'font-size:' . $val . ';';
							}
							break;
						case 'weight':
							if ( $attrs['weight'] != '' ) {
								$css .= 'font-weight:' . $val . ';';
							}
							break;
						case 'style':
							if ( $attrs['style'] != '' ) {
								$css .= 'font-style:' . $val . ';';
							}
							break;
						case 'color_style':
							if ( $attrs['color_style'] != '' ) {
								$color_style = $val;
							}
							break;
						case 'single_color':
							if ( $attrs['single_color'] != '' ) {
								$single_color = $val;
							}
							break;
						case 'gradient_from':
							if ( $attrs['gradient_from'] != '' ) {
								$gradient_from = $val;
							}
							break;
						case 'gradient_to':
							if ( $attrs['gradient_to'] != '' ) {
								$gradient_to = $val;
							}
							break;
						case 'padding':
							if ( $attrs['padding'] != '' ) {
								$css .= 'padding:' . $val . ';';
							}
							break;
						case 'line_height':
							if ( $attrs['line_height'] != '' ) {
								$css .= 'line-height:' . $val . ';';
							}
							break;
						case 'html_tag':
							if ( $attrs['html_tag'] != '' ) {
								$html_tag = $val;
							}
							break;
						case 'spacing':
							if($attrs['spacing'] != ''){
								$css .= 'letter-spacing:' . $val . ';';
							}
							break;
						case 'font_family':
							if($attrs['font_family'] != ''){
								$css .= 'font-family:' . $val . ';';
							}
							break;
						case 'id':
							if( is_numeric( $val ) ) {
								$this->id = 'c-custom-'.$val;
							} else {
								$this->id = $val;
							}
							
							break;
						default:
							break;
					}
				}

				if ( $color_style != 'default' ) {
					if ( $color_style == 'single' && $single_color != '' ) {
						$css .= 'color:'.$single_color.';';
					} else if ( $gradient_from != '' && $gradient_to != '' ) {
						$css .= 'background:linear-gradient(to right, '.$gradient_from.', '.$gradient_to.');-webkit-background-clip: text;
							    -moz-background-clip: text;
							    background-clip: text;
							    -webkit-text-fill-color: transparent;
							    text-fill-color: transparent;';
					}
				}
				
				if ( $this->id == '' ) {
					$this->generate_id();
				}

				if ( $css != '' ) {
					$css = '#' . $this->id . '.c-typo > ' . $html_tag . '{' . $css . '}';
				}
				
				if(isset($attrs['margin']) && $attrs['margin'] != ''){
					$css .= '#' . $this->id . '.c-typo{margin:' . $attrs['margin'] . ';}';
				}
				
				if(isset($attrs['mobile_margin']) && $attrs['mobile_margin'] != ''){
					$css .= '.mobile #' . $this->id . '.c-typo{margin:' . $attrs['mobile_margin'] . ';}';
				}
				
				if(isset($attrs['mobile_padding']) && $attrs['mobile_padding'] != ''){
					$css .= '.mobile #' . $this->id . '.c-typo{padding:' . $attrs['mobile_padding'] . ';}';
				}
				
				if(isset($attrs['mobile_alignment']) && $attrs['mobile_alignment'] != ''){
					$css .= '.mobile #' . $this->id . '.c-typo{text-align:' . $attrs['mobile_alignment'] . ';}';
				}
				
				if(isset($attrs['mobile_size']) && $attrs['mobile_size'] != ''){
					$css .= '.mobile #' . $this->id . '.c-typo > ' . $html_tag . '{font-size:' . $attrs['mobile_size'] . ';}';
				}

				if(isset($attrs['mobile_line_height']) && $attrs['mobile_line_height'] != ''){
					$css .= '.mobile #' . $this->id . '.c-typo > ' . $html_tag . '{line-height:' . $attrs['mobile_line_height'] . ';}';
				}

				return $css;
			}
		}
	}

	$cactus_typo = new CactusTypo();

	/**
	 * add button to visual composer
	 */
	add_action( 'after_setup_theme', 'reg_felis_typo' );

	function reg_felis_typo() {
		if ( function_exists( 'vc_map' ) ) {
			$params = CactusShortcode_Element::extend_params(
				array(
					array(
						"type"       => "textarea",
						"heading"    => esc_html__( "Content", 'felis' ),
						"param_name" => "content",
						"value"      => "",
						"admin_label" => true,
					),
					array(
						"admin_label" => true,
						"type"        => "textfield",
						"heading"     => esc_html__( "Font Size", 'felis' ),
						"param_name"  => "size",
						"value"       => '',
						"description" => esc_html__( "In pixels. Example: 14px", 'felis' ),
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__( 'Font Weight', 'felis' ),
						'description' => esc_html__( 'Font Weight', 'felis' ),
						'param_name'  => 'weight',
						'value'       => array(
							esc_html__( 'Weight', 'felis' )  => '',
							esc_html__( '100', 'felis' )     => '100',
							esc_html__( '200', 'felis' )     => '200',
							esc_html__( '300', 'felis' )     => '300',
							esc_html__( '400', 'felis' )     => '400',
							esc_html__( '500', 'felis' )     => '500',
							esc_html__( '600', 'felis' )     => '600',
							esc_html__( '700', 'felis' )     => '700',
							esc_html__( '800', 'felis' )     => '800',
							esc_html__( '900', 'felis' )     => '900',
							esc_html__( 'Bold', 'felis' )    => 'bold',
							esc_html__( 'Bolder', 'felis' )  => 'bolder',
							esc_html__( 'Initial', 'felis' ) => 'initial',
							esc_html__( 'Lighter', 'felis' ) => 'lighter',
							esc_html__( 'Normal', 'felis' )  => 'normal',
						),
						'std'         => '',
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__( 'Font Style', 'felis' ),
						'description' => esc_html__( 'Font Style', 'felis' ),
						'param_name'  => 'style',
						'value'       => array(
							esc_html__( 'Style', 'felis' )   => '',
							esc_html__( 'Inherit', 'felis' ) => 'inherit',
							esc_html__( 'Initial', 'felis' ) => 'initial',
							esc_html__( 'Italic', 'felis' )  => 'italic',
							esc_html__( 'Normal', 'felis' )  => 'normal',
							esc_html__( 'Oblique', 'felis' ) => 'oblique',

						),
						'std'         => '',
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Letter Spacing', 'felis' ),
						'description' => esc_html__( 'Enter Letter Spacing value, including suffix. For example: "10px"', 'felis' ),
						'param_name'  => 'spacing',
						'std'         => '',
					),
					array(
						"type"        => "dropdown",
						"heading"     => esc_html__( "Color Style", 'felis' ),
						"param_name"  => "color_style",
						'value'       => array(
							esc_html__( 'Default Color', 'felis' )   => 'default',
							esc_html__( 'Single Color', 'felis' )   => 'single',
							esc_html__( 'Gradient Color', 'felis' )  => 'gradient',
							),
						"description" => esc_html__( "Style of Color Single or Gradient", 'felis' ),
						),
					array(
						"type"        => "colorpicker",
						"heading"     => esc_html__( "Single Color", 'felis' ),
						"param_name"  => "single_color",
						"value"       => "",
						"dependency"  => array(
							"element" => "color_style",
							"value"   => "single",
							),
						),
					array(
						"type"        => "colorpicker",
						"heading"     => esc_html__( "Gradient From Color", 'felis' ),
						"param_name"  => "gradient_from",
						"value"       => "",
						"dependency"  => array(
							"element" => "color_style",
							"value"   => "gradient",
							),
						),
					array(
						"type"        => "colorpicker",
						"heading"     => esc_html__( "Gradient To Color", 'felis' ),
						"param_name"  => "gradient_to",
						"value"       => "",
						"dependency"  => array(
							"element" => "color_style",
							"value"   => "gradient",
							),
						),
					array(
						"type"        => "textfield",
						"heading"     => esc_html__( "Padding", 'felis' ),
						"param_name"  => "padding",
						"value"       => "",
						"description" => esc_html__( 'Format: TOP RIGHT BOTTOM LEFT. ex: 0px 0px 0px 0px', 'felis' )
					),
					array(
						"type"        => "textfield",
						"heading"     => esc_html__( "Margin", 'felis' ),
						"param_name"  => "margin",
						"value"       => "",
						"description" => esc_html__( 'Format: TOP RIGHT BOTTOM LEFT. ex: 0px 0px 0px 0px', 'felis' )
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__( 'Alignment', 'felis' ),
						'description' => esc_html__( 'Text alignment', 'felis' ),
						'param_name'  => 'alignment',
						'value'       => array(
							esc_html__( 'Align Left', 'felis' )   => 'left',
							esc_html__( 'Align Right', 'felis' )  => 'right',
							esc_html__( 'Align Center', 'felis' ) => 'center',
						),
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Line Height', 'felis' ),
						'description' => esc_html__( 'Text Line Height. Ex: 1.5em or 24px', 'felis' ),
						'param_name'  => 'line_height',
						'value'       => '',
					),

					array(
						'type'        => 'checkbox',
						'heading'     => esc_html__( 'Line Top', 'felis' ),
						'description' => esc_html__( 'Turn On / Off the line on top', 'felis' ),
						'param_name'  => 'line_top',
					),
					
					
					array(
						'admin_label' => true,
						"type"        => "textfield",
						"heading"     => esc_html__( "HTML Tag", 'felis' ),
						"param_name"  => "html_tag",
						"value"       => "",
						"description" => esc_html__( 'HTML tag to wrap the text. Default is: ', 'felis' ) . '<b>div</b>',
					)
					,
					array(
						'admin_label' => true,
						"type"        => "textfield",
						"heading"     => esc_html__( "Font Family", 'felis' ),
						"param_name"  => "font_family",
						"value"       => "",
						"description" => esc_html__( 'Enter custom Font Family Name for this typo ', 'felis' ),
					),
					array(
						"type"        => "textfield",
						"heading"     => esc_html__( "Mobile Font Size", 'felis' ),
						"param_name"  => "mobile_size",
						"value"       => '',
						"description" => esc_html__( "Font Size on mobile screen, in pixels. Example: 14px", 'felis' ),
						"group" 	  => esc_html__('Responsive Settings', 'felis')
					),
                    array(
						"type"        => "textfield",
						"heading"     => esc_html__( "Mobile Line Height", 'felis' ),
						"param_name"  => "mobile_line_height",
						"value"       => '',
						"description" => esc_html__( "Line Height on mobile screen, in pixels. Example: 26px", 'felis' ),
						"group" 	  => esc_html__('Responsive Settings', 'felis')
					),
					array(
						"type"        => "textfield",
						"heading"     => esc_html__( "Mobile Padding", 'felis' ),
						"param_name"  => "mobile_padding",
						"value"       => "",
						"description" => esc_html__( 'Padding on mobile screen. Format: TOP RIGHT BOTTOM LEFT. ex: 0px 0px 0px 0px', 'felis' ),
						"group" 	  => esc_html__('Responsive Settings', 'felis')
					),
					array(
						"type"        => "textfield",
						"heading"     => esc_html__( "Mobile Margin", 'felis' ),
						"param_name"  => "mobile_margin",
						"value"       => "",
						"description" => esc_html__( 'Margin on mobile screen. Format: TOP RIGHT BOTTOM LEFT. ex: 0px 0px 0px 0px', 'felis' ),
						"group" 	  => esc_html__('Responsive Settings', 'felis')
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__( 'Mobile Alignment', 'felis' ),
						'description' => esc_html__( 'Text Alignment on mobile screen', 'felis' ),
						'param_name'  => 'mobile_alignment',
						'value'       => array(
							esc_html__( 'Default', 'felis' )   => '',
							esc_html__( 'Align Left', 'felis' )   => 'left',
							esc_html__( 'Align Right', 'felis' )  => 'right',
							esc_html__( 'Align Center', 'felis' ) => 'center',
						),
						"group" 	  => esc_html__('Responsive Settings', 'felis')
					),
				)
			);
			vc_map( array(
				'name'     => esc_html__( 'Felis Typo', 'felis' ),
				'base'     => 'felis_typo',
				'icon'     => CT_SHORTCODE_PLUGIN_URL . '/shortcodes/img/c_typo.png',
				'category' => esc_html__( 'Felis Shortcodes', 'felis' ),
				'params'   => $params,
			) );
		}
	}