<?php
/**
 * Class Block
 */
class CactusBlock extends CactusShortcode_Block
{
	public function __construct($params = null, $content = '')
	{
		parent::__construct('felis_block', $params, $content);
	}

	/**
	 * @param $atts
	 * @param $content
	 *
	 * @return string
	 */
	public function renderShortcode($atts, $content) {
		$rand_ID    		= (isset($atts['id']) && $atts['id'] != '') ? $atts['id'] : 'c-block-'.rand(1, 999);
		$alignment  = isset( $atts['alignment'] ) ? $atts['alignment'] : 'left';
		ob_start();
		?>
		<div id="<?php echo esc_attr($rand_ID);?>" class="c-block <?php echo 'text-'.esc_attr($alignment);?>">
			<?php echo do_shortcode(str_replace('<br class="cactus_br" />', '', $content)); ?>
			<?php if(isset($atts['color_mask']) && $atts['color_mask'] == 'on') { ?>
			<div class="mask"><!-- --></div>
			<?php } ?>
		</div>	
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	public function inlineCSSGenerator( $attrs = array() ) {
		$css      = '';

		if ( count( $attrs ) == 0 ) {
			$attrs = $this->attributes;
		}

		if ( $this->id == '' ) {
			$this->generate_id();
		}

		if(isset($attrs['mobile_margin']) && $attrs['mobile_margin'] != ''){
			$css .= '.mobile #' . $this->id . '{margin:' . $attrs['mobile_margin'] . ';}';
		}
		
		if(isset($attrs['mobile_padding']) && $attrs['mobile_padding'] != ''){
			$css .= '.mobile #' . $this->id . '{padding:' . $attrs['mobile_padding'] . ';}';
		}

		return $css;
	}
}

$block = new CactusBlock();

/**
 * add button to visual composer
 */
add_action( 'after_setup_theme', 'reg_felis_block' );

function reg_felis_block() {
	if ( function_exists( 'vc_map' ) ) {
		$params = CactusShortcode_Block::extend_params( 
			array(
				array(
					'admin_label' => true,
					'type' => 'dropdown',
					'heading' => esc_html__( 'Alignment', 'felis' ),
					'description' => esc_html__( 'This shortcode is used to create a block to contain other non-block elements.', 'felis' ),
					'param_name' => 'alignment',
					'value' => array(
						esc_html__( 'Align Left', 'felis' ) => 'left',
						esc_html__( 'Align Right', 'felis' ) => 'right',
						esc_html__( 'Align Center', 'felis' ) => 'center',
					),
				),
				array(
					'admin_label' => false,
					'type' => 'dropdown',
					'heading' => esc_html__( 'Color Mask', 'felis' ),
					'description' => esc_html__( 'Add default theme\'s color mask below the content and above the background', 'felis' ),
					'param_name' => 'color_mask',
					'std' => 'off',
					'value' => array(
						esc_html__( 'Add Mask', 'felis' ) => 'on',
						esc_html__( 'No', 'felis' ) => 'off'
					),
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
			)
		);
		vc_map( array(
			'name' => esc_html__('Felis Block', 'felis' ),
			'base' => 'felis_block',
			'icon' => CT_SHORTCODE_PLUGIN_URL . '/shortcodes/img/c_block.png',
			'controls' => 'full',
			'category' => esc_html__('Felis Shortcodes', 'felis' ),
			'params' => $params,
			'js_view' => 'VcColumnView',
			'content_element' => true,
			'is_container' => true
		) );
	}
	
	//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
	if(class_exists('WPBakeryShortCodesContainer')){
		class WPBakeryShortCode_felis_block extends WPBakeryShortCodesContainer{}
	}
}