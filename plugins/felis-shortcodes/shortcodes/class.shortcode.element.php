<?php

	/**
	 * Advanced Shortcode with Effect Options
	 */
	class CactusShortcode_Element extends CactusShortcode {
		public $wrapper_tag = '';

		public static function extend_params( $params ) {
			if ( ! is_array( $params ) ) {
				return;
			}

			return array_merge( $params, array(
				array(
					'type'        => 'textfield',
					'group'       => esc_html__( 'ID', 'felis' ),
					'param_name'  => 'id',
					'heading'     => esc_html__( 'Shortcode ID', 'felis' ),
					'description' => esc_html__( "ID must be unique. If you leave empty, ID will be generated automatically. If you copy or clone shortcodes, make sure you change the ID", 'felis' ),
					'group'       => esc_html__( 'Design Options', 'felis' ),
				),
					
				array(
					'type'        => 'dropdown',
					'group'       => esc_html__( 'Effect Options', 'felis' ),
					'param_name'  => 'aos',
					'heading'     => esc_html__( 'Come-in Effect', 'felis' ),
					'description' => esc_html__( "Choose Come-in Effect", 'felis' ),
					'value'       => array(
						'none'            => 'none',
						'fade'            => 'fade',
						'fade-up'         => 'fade-up',
						'fade-down'       => 'fade-down',
						'fade-left'       => 'fade-left',
						'fade-right'      => 'fade-right',
						'fade-up-right'   => 'fade-up-right',
						'fade-up-left'    => 'fade-up-left',
						'fade-down-right' => 'fade-down-right',
						'fade-down-left'  => 'fade-down-left',
						'flip-up'         => 'flip-up',
						'flip-down'       => 'flip-down',
						'flip-left'       => 'flip-left',
						'flip-right'      => 'flip-right',
						'slide-up'        => 'slide-up',
						'slide-down'      => 'slide-down',
						'slide-left'      => 'slide-left',
						'slide-right'     => 'slide-right',
						'zoom-in'         => 'zoom-in',
						'zoom-in-up'      => 'zoom-in-up',
						'zoom-in-down'    => 'zoom-in-down',
						'zoom-in-left'    => 'zoom-in-left',
						'zoom-in-right'   => 'zoom-in-right',
						'zoom-out'        => 'zoom-out',
						'zoom-out-up'     => 'zoom-out-up',
						'zoom-out-down'   => 'zoom-out-down',
						'zoom-out-left'   => 'zoom-out-left',
						'zoom-out-right'  => 'zoom-out-right'
					)
				),
				array(
					'type'        => 'textfield',
					'group'       => esc_html__( 'Effect Options', 'felis' ),
					'param_name'  => 'aos-delay',
					'value'       => '',
					'heading'     => esc_html__( 'Come-in Effect Delay' ),
					'description' => esc_html__( "Enter Come-in Effect Delay, in milliseconds", 'felis' ),
					'dependency'  => array(
						'element' => 'aos',
						'value'   => array(
							'fade',
							'fade-up',
							'fade-down',
							'fade-left',
							'fade-right',
							'fade-up-right',
							'fade-up-left',
							'fade-down-right',
							'fade-down-left',
							'flip-up',
							'flip-down',
							'flip-left',
							'flip-right',
							'slide-up',
							'slide-down',
							'slide-left',
							'slide-right',
							'zoom-in',
							'zoom-in-up',
							'zoom-in-down',
							'zoom-in-left',
							'zoom-in-right',
							'zoom-out',
							'zoom-out-up',
							'zoom-out-down',
							'zoom-out-left',
							'zoom-out-right'
						),
					),
				),
				array(
					'type'        => 'textfield',
					'group'       => esc_html__( 'Effect Options', 'felis' ),
					'param_name'  => 'aos-offset',
					'value'       => '',
					'heading'     => esc_html__( 'Come-in Effect Offset', 'felis' ),
					'description' => esc_html__( "Enter Come-in Offset Delay, in milliseconds", 'felis' ),
					'dependency'  => array(
						'element' => 'aos',
						'value'   => array(
							'fade',
							'fade-up',
							'fade-down',
							'fade-left',
							'fade-right',
							'fade-up-right',
							'fade-up-left',
							'fade-down-right',
							'fade-down-left',
							'flip-up',
							'flip-down',
							'flip-left',
							'flip-right',
							'slide-up',
							'slide-down',
							'slide-left',
							'slide-right',
							'zoom-in',
							'zoom-in-up',
							'zoom-in-down',
							'zoom-in-left',
							'zoom-in-right',
							'zoom-out',
							'zoom-out-up',
							'zoom-out-down',
							'zoom-out-left',
							'zoom-out-right'
						),
					),
				),
				array(
					'type'        => 'textfield',
					'group'       => esc_html__( 'Effect Options', 'felis' ),
					'param_name'  => 'aos-duration',
					'value'       => '',
					'heading'     => esc_html__( 'Animation Duration', 'felis' ),
					'description' => esc_html__( "Duration of animation, in milliseconds", 'felis' ),
					'dependency'  => array(
						'element' => 'aos',
						'value'   => array(
							'fade',
							'fade-up',
							'fade-down',
							'fade-left',
							'fade-right',
							'fade-up-right',
							'fade-up-left',
							'fade-down-right',
							'fade-down-left',
							'flip-up',
							'flip-down',
							'flip-left',
							'flip-right',
							'slide-up',
							'slide-down',
							'slide-left',
							'slide-right',
							'zoom-in',
							'zoom-in-up',
							'zoom-in-down',
							'zoom-in-left',
							'zoom-in-right',
							'zoom-out',
							'zoom-out-up',
							'zoom-out-down',
							'zoom-out-left',
							'zoom-out-right'
						),
					),
				),
				array(
					'type'        => 'dropdown',
					'group'       => esc_html__( 'Effect Options', 'felis' ),
					'param_name'  => 'aos-easing',
					'heading'     => esc_html__( 'Animation Easing', 'felis' ),
					'description' => esc_html__( "Choose Easing Effect", 'felis' ),
					'value'       => array(
						'none'              => 'none',
						'linear'            => 'linear',
						'ease'              => 'ease',
						'ease-in'           => 'ease-in',
						'ease-out'          => 'ease-out',
						'ease-in-out'       => 'ease-in-out',
						'ease-in-back'      => 'ease-in-back',
						'ease-out-back'     => 'ease-out-back',
						'ease-in-out-back'  => 'ease-in-out-back',
						'ease-in-sine'      => 'ease-in-sine',
						'ease-out-sine'     => 'ease-out-sine',
						'ease-in-out-sine'  => 'ease-in-out-sine',
						'ease-in-quad'      => 'ease-in-quad',
						'ease-out-quad'     => 'ease-out-quad',
						'ease-in-out-quad'  => 'ease-in-out-quad',
						'ease-in-cubic'     => 'ease-in-cubic',
						'ease-out-cubic'    => 'ease-out-cubic',
						'ease-in-out-cubic' => 'ease-in-out-cubic',
						'ease-in-quart'     => 'ease-in-quart',
						'ease-out-quart'    => 'ease-out-quart',
						'ease-in-out-quart' => 'ease-in-out-quart',
					),
					'dependency'  => array(
						'element' => 'aos',
						'value'   => array(
							'fade',
							'fade-up',
							'fade-down',
							'fade-left',
							'fade-right',
							'fade-up-right',
							'fade-up-left',
							'fade-down-right',
							'fade-down-left',
							'flip-up',
							'flip-down',
							'flip-left',
							'flip-right',
							'slide-up',
							'slide-down',
							'slide-left',
							'slide-right',
							'zoom-in',
							'zoom-in-up',
							'zoom-in-down',
							'zoom-in-left',
							'zoom-in-right',
							'zoom-out',
							'zoom-out-up',
							'zoom-out-down',
							'zoom-out-left',
							'zoom-out-right'
						),
					),
				),
				array(
					'type'        => 'dropdown',
					'group'       => esc_html__( 'Effect Options', 'felis' ),
					'param_name'  => 'aos-once',
					'heading'     => esc_html__( 'Animation Loop', 'felis' ),
					'description' => esc_html__( "Only animate once or infinite", 'felis' ),
					'value'       => array(
						'Once'            => 'true',
						'Infinite'              => 'false'
					),
					'dependency'  => array(
						'element' => 'aos',
						'value'   => array(
							'fade',
							'fade-up',
							'fade-down',
							'fade-left',
							'fade-right',
							'fade-up-right',
							'fade-up-left',
							'fade-down-right',
							'fade-down-left',
							'flip-up',
							'flip-down',
							'flip-left',
							'flip-right',
							'slide-up',
							'slide-down',
							'slide-left',
							'slide-right',
							'zoom-in',
							'zoom-in-up',
							'zoom-in-down',
							'zoom-in-left',
							'zoom-in-right',
							'zoom-out',
							'zoom-out-up',
							'zoom-out-down',
							'zoom-out-left',
							'zoom-out-right'
						),
					),
				),
				array(
					'type'        => 'textfield',
					'group'       => esc_html__( 'Design Options', 'felis' ),
					'param_name'  => 'extra_class',
					'value'       => '',
					'heading'     => esc_html__( 'CSS Class', 'felis' ),
					'description' => esc_html__( "Custom CSS Class", 'felis' ),
				)
			) );
		}

		function init() {
			if ( ! class_exists( 'App\Cactus' ) ) {
				return;
			}

			$this->meta      = new App\Views\ParseMeta();
			$this->thumbnail = new App\Views\ParseThumbnail();


			add_shortcode( $this->tag, array( $this, 'render_shortcode_wrapper' ) );
		}

		/**
		 * Get Element Classes to be used in the wrapper tag
		 */
		public function get_element_classes( $atts ) {
			if ( ( isset( $atts['aos'] ) && $atts['aos'] != '' && $atts['aos'] != 'none' ) || ( isset( $atts['extra_class'] ) && $atts['extra_class'] != '' ) ) {
				$css = 'shortcode-inner';

				if(isset($atts['aos']) && $atts['aos'] != '' && $atts['aos'] != 'none'){
					$css .= ' aos-init';
				}

				if ( isset( $atts['extra_class'] ) && $atts['extra_class'] != '' ) {
					$css .= ' ' . esc_attr( $atts['extra_class'] );
				}


				return $css;
			}

			return '';
		}

		/**
		 * Get Element Attributes list, in property string (data-xxx = "")
		 */
		public function get_element_attributes( $atts ) {
			if ( ( isset( $atts['aos'] ) && $atts['aos'] != '' && $atts['aos'] != 'none' ) ) {
				$offset   = isset( $atts['aos-offset'] ) ? intval( $atts['aos-offset'] ) : 100;
				$delay    = isset( $atts['aos-delay'] ) ? intval( $atts['aos-delay'] ) : 100;
				$duration = isset( $atts['aos-duration'] ) ? intval( $atts['aos-duration'] ) : 400;
				$easing   = isset( $atts['aos-easing'] ) && $atts['aos-easing'] != '' ? $atts['aos-easing'] : 'none';
				$loop = isset($atts['aos-once']) && $atts['aos-once'] == 'false' ? 'false' : 'true';

				$effect_props = array(
					'data-aos'          => $atts['aos'],
					'data-aos-offset'   => $offset,
					'data-aos-delay'    => $delay,
					'data-aos-duration' => $duration,
					'data-aos-easing'   => $easing,
					'data-aos-once'		=> $loop
				);

				$attributes = CactusShortcode::implode_props( $effect_props );

				return $attributes;
			}

			return '';
		}

		function render_shortcode_wrapper( $atts, $content ) {

			$html = $this->get_open_shortcode_wrapper( $atts, $content );
			$html .= $this->renderShortcode( $atts, $content );
			$html .= $this->get_close_shortcode_wrapper( $atts, $content );

			return $html;
		}

		function get_open_shortcode_wrapper( $atts, $content = '' ) {

			// For element having <li> wrapper, we cannot just wrap the <div> outside the <li>, thus we leave this task to the shortcode implementer
			if ( $this->wrapper_tag != 'li' ) {

				$css        = $this->get_element_classes( $atts );
				$attributes = $this->get_element_attributes( $atts );

				if ( $css != '' || $attributes != '' ) {

					return '<div class="' . $css . '" ' . $attributes . '>';

				}

			}

			return '';
		}

		function get_close_shortcode_wrapper( $atts, $content = '' ) {
			// For element having <li> wrapper, we cannot just wrap the <div> outside the <li>, thus we leave this task to the shortcode implementer
			if ( $this->wrapper_tag != 'li' ) {

				$css        = $this->get_element_classes( $atts );
				$attributes = $this->get_element_attributes( $atts );

				if ( $css != '' || $attributes != '' ) {
					return '</div>';
				}
			}

			return '';
		}
	}