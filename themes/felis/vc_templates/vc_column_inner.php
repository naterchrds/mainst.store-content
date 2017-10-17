<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $width
 * @var $css
 * @var $offset
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column_Inner
 */
$el_class = $width = $css = $offset = '';
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );

$css_classes = array(
	$this->getExtraClass( $el_class ),
	'wpb_column',
	'vc_column_container',
	$width,
);

if ( vc_shortcode_custom_css_has_property( $css, array(
	'border',
	'background',
) ) ) {
	$css_classes[] = 'vc_col-has-fill';
}

$wrapper_attributes = array();

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';

/**
 * Added in Colossal 1.0
 */
$background_position = (isset($atts['background_position']) && $atts['background_position'] != '') ? 'background-position: '.$atts['background_position'].' !important' : '';

$background_attachment = (isset($atts['background_attachment']) && $atts['background_attachment'] != '') ? 'background-attachment: '.$atts['background_attachment'].' !important' : '';

$mobile_padding = (isset($atts['mobile_padding']) && $atts['mobile_padding'] != '') ? ' data-mobile-padding="' . $atts['mobile_padding'] . '" ' : '';
$mobile_margin = (isset($atts['mobile_margin']) && $atts['mobile_margin'] != '') ? ' data-mobile-margin="' . $atts['mobile_margin'] . '" ' : '';


$extra_style = '';
if(isset($atts['color_mask']) && $atts['color_mask'] == 'yes'){
	$extra_style = ";position: relative";
}

$output .= '<div class="vc_column-inner ' . esc_attr( trim( vc_shortcode_custom_css_class( $css ) ) ) . '" style="'.$background_position.';' . $background_attachment . ';'.$extra_style.'" ' . $mobile_padding . $mobile_margin . '>';

if(isset($atts['color_mask']) && $atts['color_mask'] == 'yes'){
	$output .= '<div class="mask"><!-- --></div>';
}
// end custom

$output .= '<div class="wpb_wrapper">';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';

echo $output;
