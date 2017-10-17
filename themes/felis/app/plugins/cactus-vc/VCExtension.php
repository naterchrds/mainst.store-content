<?php
	/**
	 * Visual Composer extension
	 *
	 * @package colossal
	 */

	namespace App\Plugins\Cactus_VC;

	class VCExtension {
		public static $page_slug = 'cactus-vc';

		private static $instance;

		public static function getInstance() {
			if ( null == self::$instance ) {
				self::$instance = new VCExtension();
			}

			return self::$instance;
		}

		public static function initialize() {
			$VCExtension = VCExtension::getInstance();

			add_action( 'init', array( $VCExtension, 'init' ) );
		}

		public function init() {
			// add background position parameter to VC row
			$elements = array( 'vc_row', 'vc_row_inner', 'vc_column', 'vc_column_inner' );
			foreach ( $elements as $element ) {
				vc_add_param( $element, array(
					"type"       => "dropdown",
					"class"      => "",
					"heading"    => esc_html__( "Background Position", 'felis' ),
					"param_name" => "background_position",
					'group'      => esc_html__( 'Additional Options', 'felis' ),
					"value"      => array(
						esc_html__( 'None', 'felis' )          => '',
						esc_html__( "center center", 'felis' ) => "center center",
						esc_html__( "left center", 'felis' )   => "left center",
						esc_html__( "right center", 'felis' )  => "right center",
						esc_html__( "center top", 'felis' )    => "center top",
						esc_html__( "left top", 'felis' )      => "left top",
						esc_html__( "right top", 'felis' )     => "right top",
						esc_html__( "center bottom", 'felis' ) => "center bottom",
						esc_html__( "left bottom", 'felis' )   => "left bottom",
						esc_html__( "right bottom", 'felis' )  => "right bottom",

					)
				) );

				vc_add_param( $element, array(
					"type"       => "dropdown",
					"class"      => "",
					"heading"    => esc_html__( "Background Attachment", 'felis' ),
					"param_name" => "background_attachment",
					'group'      => esc_html__( 'Additional Options', 'felis' ),
					"value"      => array(
						esc_html__( 'None', 'felis' )    => '',
						esc_html__( "Initial", 'felis' ) => "initial",
						esc_html__( "Inherit", 'felis' ) => "inherit",
						esc_html__( "Local", 'felis' )   => "local",
						esc_html__( "Fixed", 'felis' )   => "fixed",
						esc_html__( "Scroll", 'felis' )  => "scroll"

					)
				) );

				vc_add_param( $element, array(
					"type"       => "dropdown",
					"class"      => "",
					"heading"    => esc_html__( "Color Mask", 'felis' ),
					"param_name" => "color_mask",
					'group'      => esc_html__( 'Additional Options', 'felis' ),
					"value"      => array(
						esc_html__( 'No', 'felis' )  => '',
						esc_html__( "Yes", 'felis' ) => "yes"
					)
				) );

				vc_add_param( $element, array(
					"type"        => "textfield",
					"class"       => "",
					"heading"     => esc_html__( "Padding On Mobile", 'felis' ),
					"param_name"  => "mobile_padding",
					'group'       => esc_html__( 'Additional Options', 'felis' ),
					'description' => esc_html__( "Change padding values on mobile screen, format 'TOP RIGHT BOTTOM LEFT', for example '0px 0px 0px 0px'", 'felis' )
				) );

				vc_add_param( $element, array(
					"type"        => "textfield",
					"class"       => "",
					"heading"     => esc_html__( "Margin On Mobile", 'felis' ),
					"param_name"  => "mobile_margin",
					'group'       => esc_html__( 'Additional Options', 'felis' ),
					'description' => esc_html__( "Change margin values on mobile screen, format 'TOP RIGHT BOTTOM LEFT', for example '0px 0px 0px 0px'", 'felis' )
				) );
			}
		}

	}