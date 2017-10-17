<?php

/**
 * Class CactusIconBoxes
 */
class CactusIconBoxes extends CactusShortcode_Block {
	public function __construct( $params = null, $content = '' ) {
		parent::__construct( 'felis_iconboxes', $params, $content );
	}

	public function renderShortcode( $params, $content ) {
		$id            = 'c-icon-box-' . rand( 1, 9999 );
		$item_style    = isset( $params['item_style'] ) && $params['item_style'] != '' ? $params['item_style'] : '1';
		$items_per_row = isset( $params['items_per_row'] ) && $params['items_per_row'] != '' ? $params['items_per_row'] : '3';


		ob_start();
		?>

		<section id="<?php echo esc_attr( $id ); ?>" class="felis-section ct-iconboxes felis_<?php echo esc_attr( $item_style ); ?>">
				<div class="row">
					<div class="sc-icon_box">
						<?php echo do_shortcode( str_replace( '[felis_iconbox ', '[felis_iconbox  item_style="' . $item_style . '" items_per_row="' . $items_per_row . '" ', str_replace( '<br class="cactus_br" />', '', $content ) ) ); ?>
					</div>
				</div>
		</section>


		<?php
		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}

}

$iconBoxes = new CactusIconBoxes();

/**
 * Class CactusIconBox
 */
class CactusIconBox extends CactusShortcode_Element {
	public function __construct( $params = null, $content = '' ) {
		parent::__construct( 'felis_iconbox', $params, $content );
		$this->wrapper_tag = 'li';
	}


	/**
	 * @param $params
	 * @param $content
	 *
	 * @return string
	 */
	public function renderShortcode( $params, $content ) {
		$item_style    = isset( $params['item_style'] ) && $params['item_style'] != '' ? $params['item_style'] : '1';
		$items_per_row = isset( $params['items_per_row'] ) && $params['items_per_row'] != '' ? $params['items_per_row'] : '3';
		$title         = isset( $params['title'] ) && $params['title'] != '' ? $params['title'] : '';
		$icon          = isset( $params['icon'] ) && $params['icon'] != '' ? $params['icon'] : '';
		$id            = isset( $params['id'] ) ? $params['id'] : '';
		$box_url       = isset( $params['box_url'] ) && $params['box_url'] != '' ? $params['box_url'] : '#';

		switch ( $items_per_row ) {
			case '1':
			$item_class = 'col-md-12';
			break;
			case '2':
			$item_class = 'col-md-6';
			break;
			case '3':
			$item_class = 'col-md-4';
			break;
			case '4':
			$item_class = 'col-md-3';
			break;
			case '6':
			$item_class = 'col-md-2';
			break;
			default:
			$item_class = 'col-md-4';
			break;
		}

		switch ( $item_style ) {
			case '1':
				$box_style = 'icon-left';
			break;
			case '2':
				$box_style = 'icon-center backgorund_box';
			break;
			case '3':
				$box_style = 'icon-left';
			break;

			default:
				# code...
			break;
		}
		$effect_css        = $this->get_element_classes( $params );
		$effect_attributes = $this->get_element_attributes( $params );
		ob_start();
		?>

		<div class="col-xs-12 col-sm-6 <?php echo esc_attr( $item_class ); ?>">
			<div id="<?php echo esc_attr( $id ); ?>" class="c-icon-box <?php echo esc_attr( $box_style ); ?> <?php echo esc_attr( $effect_css ); ?>" <?php echo $effect_attributes; ?>>
				<?php if ( $icon != '' ) { ?>
				<span class="icon">
					<i class="<?php echo esc_attr( $icon ); ?>"></i>
				</span>

				<?php } ?>
				<div class="icon-box_content">
					<?php if ( $title != '' ) {  ?>
					<h3 class="icon-box_title font-heading  "><a href="<?php echo esc_attr( $box_url ); ?>"><?php echo esc_html( $title ); ?></a></h3>
					<?php } ?>
					<?php if ( $content != '' ) {  ?>
					<div class="icon-box_desc">
						<p><?php echo wp_kses_post( $content ); ?> </p>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
		
		<?php
		

		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}

	public function inlineCSSGenerator( $attrs = array() ) {

		$css  = '';
		$icon_color_style = 'default';
		$icon_single_color = '';
		$border_color = '';
		$icon_gradient_from = '';
		$icon_gradient_to = '';
		$content_color  = '';
		$title_color   	= '';
		$single_color   = '';
		$main_color   	= 'default';
		$main_gradient_from   = '';
		$main_gradient_to     = '';
		$item_style     = '';

		
		if ( count( $attrs ) == 0 ) {
			$attrs = $this->attributes;
		}

		if ( is_array( $attrs ) ) {

			foreach ( $attrs as $att => $val ) {
				switch ( $att ) {
					case 'title_color':
						if ( $val != '' ) {
							$title_color    .= 'color:' . $val . ';';
						}
					break;

					case 'content_color':
						if ( $val != '' ) {
							$content_color .= 'color:' . $val . ';';
						}
					break;

					case 'icon_color_style':
						if ( $val != '' ) {
							$icon_color_style = $val;
						}
					break;

					case 'icon_single_color':
						if ( $val != '' ) {
							$icon_single_color .= 'color:' . $val . ';';
						}
					break;

					case 'icon_gradient_from':
						if ( $val != '' ) {
							$icon_gradient_from = $val;
						}
						
					break;

					case 'icon_gradient_to':
						if ( $val != '' ) {
							$icon_gradient_to = $val;
						}
						
					break;

					case 'main_color':
						if ( $val != '' ) {
							$main_color = $val;
						}
					break;

					case 'main_single_color':
						if ( $val != '' ) {
							$single_color .= 'background:'.$val.';';
						}
					break;

					case 'main_gradient_from':
						if ( $val != '' ) {
							$main_gradient_from = $val;
						}
						
					break;

					case 'main_gradient_to':
						if ( $val != '' ) {
							$main_gradient_to = $val;
						}
						
					break;

					case 'border_color':
						if ( $val != '' ) {
							$border_color = $val;
						}
						
					break;

					case 'item_style':
						if ( $val != '' ) {
							$item_style = $val;
						}
						
					break;

					case 'id':
						$this->id = $val;
					break;

					default:
					break;

				}
			}

			if ( $this->id == '' ) {
				$this->generate_id();
			}


			if ( $title_color != '' ) {
				$css .= '#' . $this->id . ' .icon-box_title > a{' . $title_color . '}';
			}


			if ( $content_color != '' ) {
				$css .= '#' . $this->id . ' .icon-box_desc > p {' . $content_color . '}';
			}

			if ( $border_color != ''  ) {
				$css .= '#' . $this->id . ' .icon  { border-color:' . $border_color . '}';
			}

			if ( $icon_color_style != 'default' ) {
				if ( $icon_color_style == 'gradient' ) {
					$css .= '#' . $this->id . ' .icon > i {  
						background: linear-gradient(to right, '.$icon_gradient_from.', '.$icon_gradient_to.');
					    -webkit-background-clip: text;
					    -moz-background-clip: text;
					    background-clip: text;
					    -webkit-text-fill-color: transparent;
					    text-fill-color: transparent;
					    padding-top: 3px;
					    padding-left: 1px; 
					}';
				} else {
					$css .= '#' . $this->id . ' .icon > i {' . $icon_single_color . '}';
				}

			}

			if ( $main_color != 'default' ) {
				if ( $main_color == 'gradient' && $main_gradient_from != '' && $main_gradient_to != '' ) {
					$css .= '#' . $this->id . '.c-icon-box.backgorund_box:after {  background: linear-gradient(to right, '.$main_gradient_from.', '.$main_gradient_to.' 50%); }';
				} else if ( $single_color != '') {
					$css .= '#' . $this->id . '.c-icon-box.backgorund_box:after {' . $single_color . '}';
				}

			}

			

			
			return $css;

		}
	}

}

$iconBox = new CactusIconBox();

/**
 * Register to Visual Composer
 */

add_action( 'after_setup_theme', 'reg_felis_iconboxes' );

function reg_felis_iconboxes() {
	if ( function_exists( 'vc_map' ) ) {

		$felis_iconboxes_params = CactusShortcode_Block::extend_params( array(
			array(
				"admin_label" => true,
				"type"        => "dropdown",
				"class"       => "",
				"heading"     => esc_html__( "Item style", 'felis' ),
				"param_name"  => "item_style",
				"value"       => array(
					esc_html__( "Style 1", 'felis' ) => "1",
					esc_html__( "Style 2", 'felis' ) => "2",
					esc_html__( "Style 3", 'felis' ) => "3",
					),
				"description" => esc_html__( "Choose icon box style", 'felis' ),
				),
			
			array(
				"admin_label" => true,
				"type"        => "dropdown",
				"heading"     => esc_html__( "Select Number of items per row", 'felis' ),
				"param_name"  => "items_per_row",
				"value"       => array(
					esc_html__( "1 item", 'felis' )  => "1",
					esc_html__( "2 items", 'felis' ) => "2",
					esc_html__( "3 items", 'felis' ) => "3",
					esc_html__( "4 items", 'felis' ) => "4",
					esc_html__( "6 items", 'felis' ) => "6",
					),
				"std"         => "3",
				"description" => esc_html__( "The width of item depends on the number of items per row based on 12 columns. For example, if you choose 4 items per row, the width of each item will be 3 columns. Especially, if you want the width of each items is 3 columns, you can choose four items, then you just need to put 3 items per row.", 'felis' ),
				)
			) 
		);

	$felis_iconbox_params = CactusShortcode_Element::extend_params( array(
		array(
			"admin_label" => true,
			"type"        => "textfield",
			"heading"     => esc_html__( "Title", 'felis' ),
			"param_name"  => "title",
			"value"       => "",
			"description" => esc_html__( "Title of box", 'felis' ),
			),
		array(
			"type"        => "colorpicker",
			"heading"     => esc_html__( "Title Color", 'felis' ),
			"param_name"  => "title_color",
			"value"       => "",
			"description" => esc_html__( "Title color of the box.", 'felis' ),
			),
		array(
			"type"       => "textarea_html",
			"heading"    => esc_html__( "Content", 'felis' ),
			"param_name" => "content",
			"value"      => "",
			),
		array(
			"type"        => "colorpicker",
			"heading"     => esc_html__( "Content Color", 'felis' ),
			"param_name"  => "content_color",
			"value"       => "",
			"description" => esc_html__( "Content color of the box.", 'felis' ),
			),


		array(
			"type"        => "textfield",
			"heading"     => esc_html__( "Icon", 'felis' ),
			"param_name"  => "icon",
			"value"       => "",
			"description" => esc_html__( "Icon class, for example 'fa fa-home'", 'felis' ) . '</br><a href="http://fontawesome.io/icons/" target="_blank">' . esc_html__( "Font Awesome", 'felis' ) . '</a>, <a href="http://ionicons.com/cheatsheet.html" target="_blank">' . esc_html__( "Ionicons", 'felis' ) . '</a>, <a href="http://colossal1.cactusthemes.com/doc/ct-icon/icons-reference.html" target="_blank">' . esc_html__( "CT Icons", 'felis' ) . '</a>',
			),

		array(
			"type"        => "dropdown",
			"heading"     => esc_html__( "Icon Color Style", 'felis' ),
			"param_name"  => "icon_color_style",
			'value'       => array(
				esc_html__( 'Default Color', 'felis' )   => 'default',
				esc_html__( 'Single Color', 'felis' )   => 'single',
				esc_html__( 'Gradient Color', 'felis' )  => 'gradient',
				),
			"description" => esc_html__( "Icon style color of the box. Gradient style is not used for Ionicons", 'felis' ),
			),

		array(
			"type"        => "colorpicker",
			"heading"     => esc_html__( "Icon Single Color", 'felis' ),
			"param_name"  => "icon_single_color",
			"value"       => "",
			"description" => esc_html__( "Icon color of the box", 'felis' ),
			"dependency"  => array(
				"element" => "icon_color_style",
				"value"   => "single",
				),
			),

		array(
			"type"        => "colorpicker",
			"heading"     => esc_html__( "Icon Gradient From Color", 'felis' ),
			"param_name"  => "icon_gradient_from",
			"value"       => "",
			"dependency"  => array(
				"element" => "icon_color_style",
				"value"   => "gradient",
				),
			),
		array(
			"type"        => "colorpicker",
			"heading"     => esc_html__( "Icon Gradient To Color", 'felis' ),
			"param_name"  => "icon_gradient_to",
			"value"       => "",
			"dependency"  => array(
				"element" => "icon_color_style",
				"value"   => "gradient",
				),
			),

		array(
			"type"        => "dropdown",
			"heading"     => esc_html__( "Main Color", 'felis' ),
			"param_name"  => "main_color",
			'value'       => array(
				esc_html__( 'Default Color', 'felis' )   => 'default',
				esc_html__( 'Single Color', 'felis' )   => 'single',
				esc_html__( 'Gradient Color', 'felis' )  => 'gradient',
				),
			"description" => esc_html__( "Main color for Style 2", 'felis' ),
			),
		array(
			"type"        => "colorpicker",
			"heading"     => esc_html__( "Main Single Color", 'felis' ),
			"param_name"  => "main_single_color",
			"value"       => "",
			"description" => esc_html__( "Main single color for Style 2", 'felis' ),
			"dependency"  => array(
				"element" => "main_color",
				"value"   => "single",
				),
			),
		array(
			"type"        => "colorpicker",
			"heading"     => esc_html__( "Main Gradient From Color", 'felis' ),
			"param_name"  => "main_gradient_from",
			"value"       => "",
			"description" => esc_html__( "Main gradient from color for Style 2", 'felis' ),
			"dependency"  => array(
				"element" => "main_color",
				"value"   => "gradient",
				),
			),
		array(
			"type"        => "colorpicker",
			"heading"     => esc_html__( "Main Gradient To Color", 'felis' ),
			"param_name"  => "main_gradient_to",
			"value"       => "",
			"description" => esc_html__( "Main gradient to color for Style 2", 'felis' ),
			"dependency"  => array(
				"element" => "main_color",
				"value"   => "gradient",
				),
			),

		array(
			"type"        => "colorpicker",
			"heading"     => esc_html__( "Icon Border Color", 'felis' ),
			"param_name"  => "border_color",
			"value"       => "",
			"description" => esc_html__( "Icon Border Color for Style 3", 'felis' ),
			),

		array(
			"type"        => "textfield",
			"heading"     => esc_html__( 'Box Url', 'felis' ),
			"param_name"  => "box_url",
			"value"       => "",
			"description" => esc_html__( 'URL to navigate', 'felis' ),
			),


		) );

	vc_map( array(
		"name"                    => esc_html__( "Felis IconBoxes", 'felis' ),
		"base"                    => "felis_iconboxes",
		"content_element"         => true,
		"as_parent"               => array( "only" => "felis_iconbox" ),
		"icon"                    => CT_SHORTCODE_PLUGIN_URL . "/shortcodes/img/ct_iconboxes.png",
		"category"                => esc_html__( "Felis Shortcodes", 'felis' ),
		"show_settings_on_create" => true,
		"params"                  => $felis_iconboxes_params,
		"js_view"                 => "VcColumnView",
		) );

	vc_map( array(
		"name"            => esc_html__( "IconBox Item", 'felis' ),
		"base"            => "felis_iconbox",
		"content_element" => true,
		"as_child"        => array( 'only' => 'felis_iconboxes' ),
						// Use only|except attributes to limit parent (separate multiple values with comma)
		"icon"            => CT_SHORTCODE_PLUGIN_URL . "/shortcodes/img/ct_iconbox.png",
		"params"          => $felis_iconbox_params,
		) );
	}
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_felis_iconboxes extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_felis_iconbox extends WPBakeryShortCode {
		}
	}
}