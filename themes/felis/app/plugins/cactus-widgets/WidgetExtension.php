<?php

	/**
	 * Class Widget
	 *
	 * @since Cactus Alpha 1.0
	 * @package cactus
	 */

	namespace App\Plugins\Widgets;

	use App\Cactus;

	class WidgetExtension
	{
		public function __construct()
		{
			global $cactus_options_widget_width, $cactus_options_widget_variation;

			if (( ! $cactus_options_widget_width = get_option('cactus_wg_custom_widget_width') ) || ! is_array($cactus_options_widget_width)) {
				$cactus_options_widget_width = array();
			}

			if (( ! $cactus_options_widget_variation = get_option('cactus_wg_custom_variation') ) || ! is_array($cactus_options_widget_variation)) {
				$cactus_options_widget_variation = array();
			}
			
			if (( ! $cactus_options_widget_icon = get_option('cactus_wg_custom_icon') ) || ! is_array($cactus_options_widget_icon)) {
				$cactus_options_widget_icon = array();
			}

			add_action('sidebar_admin_setup', array($this, 'add_widget_custom_variation_field'));
			add_filter('dynamic_sidebar_params', array($this, 'before_widget'));
			add_action('init', array($this, 'supportShortcode'));
			
			add_filter('widget_title', array($this, 'widget_title'), 10, 3);
		}
		
		/**
		 * Hide widget title of default WordPress Widget, such as Archives, Categories, if title is not set
		 */
		public function widget_title( $title, $instance = null, $id = ''){

			if(empty( $instance['title'] )){
				$title = '';
			}
			
			return $title;
		}

		/**
		 * Add Custom Variation field to let users set custom css class to any widget
		 *
		 * @since Cactus Alpha 1.0
		 * @package cactus
		 */
		public function add_widget_custom_variation_field()
		{
			global $wp_registered_widgets,
			$wp_registered_widget_controls,
			$cactus_options_widget_variation,
			$cactus_options_widget_width;
			$cactus_options_widget_icon;

			foreach ($wp_registered_widgets as $id => $widget) {
				if ( ! $wp_registered_widget_controls[$id]) {
					wp_register_widget_control($id, $widget['name'], array($this, 'emptyControlCallback'));
				}

				$wp_registered_widget_controls[$id]['callback_ct_redirect'] = $wp_registered_widget_controls[$id]['callback'];
				$wp_registered_widget_controls[$id]['callback']             = array($this, 'cactus_widget_add_custom_fields');

				array_push($wp_registered_widget_controls[$id]['params'], $id);
			}

			if ('post' == strtolower($_SERVER['REQUEST_METHOD'])) {
				foreach ((array) $_POST['widget-id'] as $widget_number => $widget_id) {
					$custom_variation = array(); // array of custom_variation, box_mode, color_schema values

					if (isset($_POST[$widget_id . '-cactus_wg_custom_variation'])) {
						array_push($custom_variation, trim($_POST[$widget_id . '-cactus_wg_custom_variation']));
					} else {
						array_push($custom_variation, '');
					}

					if (isset($_POST[$widget_id . '-cactus_wg_box_mode'])) {
						array_push($custom_variation, trim($_POST[$widget_id . '-cactus_wg_box_mode']));
					} else {
						array_push($custom_variation, '');
					}
					
					if (isset($_POST[$widget_id . '-cactus_wg_custom_icon'])) {
						array_push($custom_variation, trim($_POST[$widget_id . '-cactus_wg_custom_icon']));
					} else {
						array_push($custom_variation, '');
					}

					$cactus_options_widget_variation[$widget_id] = $custom_variation;

					if (isset($_POST[$widget_id . '-cactus_wg_custom_widget_width'])) {
						$cactus_options_widget_width[$widget_id] = trim($_POST[$widget_id . '-cactus_wg_custom_widget_width']);
					}
				}
			}

			update_option('cactus_wg_custom_widget_width', $cactus_options_widget_width);

			update_option('cactus_wg_custom_variation', $cactus_options_widget_variation);
		}

		/**
		 * Support running shortcode in Text Widget
		 *
		 * @since Cactus Alpha 1.0
		 * @package cactus
		 */
		public function supportShortcode()
		{
			global $wp_embed;

			return add_filter('widget_text', array($wp_embed, 'run_shortcode'), 8);
		}

		/**
		 * Support running shortcode in Text Widget
		 *
		 * @since Cactus Alpha 1.0
		 * @package cactus
		 */
		public function widgetAutoEmbed()
		{
			global $wp_embed;

			return add_filter('widget_text', array($wp_embed, 'autoembed'), 8);
		}

		/**
		 *
		 * @since Cactus Alpha 1.0
		 * @package cactus
		 */
		public function cactus_widget_add_custom_fields()
		{
			global $wp_registered_widget_controls,
			$cactus_options_widget_variation,
			$cactus_options_widget_width;

			$params = func_get_args();

			$id = array_pop($params);

			$callback = $wp_registered_widget_controls[$id]['callback_ct_redirect'];
			if (is_callable($callback)) {
				call_user_func_array($callback, $params);
			}

			$values = ! empty($cactus_options_widget_variation[$id]) ? $cactus_options_widget_variation[$id] : array();

			if (isset($params[0]['number'])) {
				$number = $params[0]['number'];
			}

			if ($number == - 1) {
				$number = "__i__";
				$values = array();
			}

			$id_disp = $id;

			if (isset($number)) {
				$id_disp = $wp_registered_widget_controls[$id]['id_base'] . '-' . $number;
			}

			echo '<div class="widget-separator"><!-- --></div><a href="javascript:void(0)" class="btn-widget_appearance">' . esc_html__('Change Widget Appearance', 'felis') . '</a>';

			if (is_array($values) && count($values) == 3) {
				$custom_variation = $values[0];
				$box_mode         = $values[1];
				$widget_icon = $values[2];
			} else {
				$custom_variation = '';
				$box_mode         = '';
				$widget_icon = '';
			}

			echo '<div class="widget-appearance-settings">';

			echo "<p class='widget_appearance' style='display:none'><label for='" . $id_disp . "-cactus_wg_box_mode'>" . esc_html__('Box Mode', 'felis') . ": <select class='widefat' name='" . $id_disp . "-cactus_wg_box_mode' id='" . $id_disp . "-cactus_wg_box_mode'>
			<option value='' " . selected($box_mode, '', false) . ">" . esc_html__('Default', 'felis') . "</option>
			<option value='ui-boxed' " . selected($box_mode, 'ui-boxed', false) . ">" . esc_html__('Boxed', 'felis') . "</option>
			<option value='ui-wide' " . selected($box_mode, 'ui-wide', false) . ">" . esc_html__('Wide', 'felis') . "</option></select></label></p>";

			echo "<p class='widget_appearance' style='display:none'><label for='" . $id_disp . "-cactus_wg_custom_variation'>" . esc_html__('Custom Variation - CSS Classes', 'felis') . ": <input class='widefat' type='text' name='" . $id_disp . "-cactus_wg_custom_variation' id='" . $id_disp . "-cactus_wg_custom_variation' value='" . $custom_variation . "' /></label></p>";

			$value = ! empty($cactus_options_widget_width[$id]) ? htmlspecialchars(stripslashes($cactus_options_widget_width[$id]), ENT_QUOTES) : '';


			if ($number == - 1) {
				$number = "%i%";
				$value  = "";
			}

			$html = '';

			$html .= "<p class='widget_appearance uni-footer-width' style='display:none' id='uni-" . $id_disp . "'>";
			$html .= "<label for='" . $id_disp . "-cactus_wg_custom_widget_width'>" . esc_html__('Widget Width', 'felis') . ":";
			$html .= "<select name='" . $id_disp . "-cactus_wg_custom_widget_width' id='" . $id_disp . "-cactus_wg_custom_widget_width'>";
			$html .= "<option value='col-xs-12 col-md-12' " . ( $value == 'col-xs-12 col-md-12' ? 'selected="selected"' : '' ) . ">col-md-12</option>";
			$html .= "<option value='col-xs-12 col-md-11' " . ( $value == 'col-xs-12 col-md-11' ? 'selected="selected"' : '' ) . ">col-md-11</option>";
			$html .= "<option value='col-xs-12 col-md-10' " . ( $value == 'col-xs-12 col-md-10' ? 'selected="selected"' : '' ) . ">col-md-10</option>";
			$html .= "<option value='col-xs-12 col-md-9' " . ( $value == 'col-xs-12 col-md-9' ? 'selected="selected"' : '' ) . ">col-md-9</option>";
			$html .= "<option value='col-xs-12 col-md-8' " . ( $value == 'col-xs-12 col-md-8' ? 'selected="selected"' : '' ) . ">col-md-8</option>";
			$html .= "<option value='col-xs-12 col-md-7' " . ( $value == 'col-xs-12 col-md-7' ? 'selected="selected"' : '' ) . ">col-md-7</option>";
			$html .= "<option value='col-xs-12 col-md-6' " . ( $value == 'col-xs-12 col-md-6' ? 'selected="selected"' : '' ) . ">col-md-6</option>";
			$html .= "<option value='col-xs-12 col-md-5' " . ( $value == 'col-xs-12 col-md-5' ? 'selected="selected"' : '' ) . ">col-md-5</option>";
			$html .= "<option value='col-xs-12 col-md-4' " . ( $value == 'col-xs-12 col-md-4' ? 'selected="selected"' : '' ) . ">col-md-4</option>";
			$html .= "<option value='col-xs-12 col-md-3' " . ( $value == 'col-xs-12 col-md-3' ? 'selected="selected"' : '' ) . ">col-md-3</option>";
			$html .= "<option value='col-xs-12 col-md-2' " . ( $value == 'col-xs-12 col-md-2' ? 'selected="selected"' : '' ) . ">col-md-2</option>";
			$html .= "<option value='col-xs-12 col-md-1' " . ( $value == 'col-xs-12 col-md-1' ? 'selected="selected"' : '' ) . ">col-md-1</option>";
			$html .= "</select>";
			$html .= "</label>";
			$html .= "</p>";

			echo $html;
			
			echo "<p class='widget_appearance' style='display:none'><label for='" . $id_disp . "-cactus_wg_custom_icon'>" . esc_html__('Font Icon - CSS Classes', 'felis') . ": <input class='widefat' type='text' name='" . $id_disp . "-cactus_wg_custom_icon' id='" . $id_disp . "-cactus_wg_custom_icon' value='" . $widget_icon . "' /></label></p>";

			echo '</div>';
		}

		public function before_widget( $params ) {
			global $cactus_options_widget_width, $cactus_options_widget_variation;

			$id            = $params[0]['widget_id'];
			$widget_width_class = ! empty($cactus_options_widget_width[$id]) ? htmlspecialchars(stripslashes($cactus_options_widget_width[$id]), ENT_QUOTES) : '';
			
			
			$classe_to_add = $widget_width_class;

			$widget_variation = isset($cactus_options_widget_variation[$id]) ? $cactus_options_widget_variation[$id] : array();
			if ( is_array( $widget_variation ) && count( $widget_variation ) == 3) {
				$custom_variation = $widget_variation[0];
				$box_mode         = $widget_variation[1];
				$widget_icon     = $widget_variation[2];
			} else {
				$custom_variation = '';
				$box_mode         = '';
				$widget_icon = '';
			}

			if ($params[0]['before_widget'] != '') {
				
				if ($classe_to_add == '') {
					global $wid_def;

					if ($wid_def == 1) {
						$classe_to_add = 'col-xs-12 col-md-4';
					} else {
						$classe_to_add = 'col-xs-12 col-md-12';
					}

				}

				$classe_to_add = 'class="widget ' . $classe_to_add . ' ';
				
				if ( $params[0]['id'] == 'footer_sidebar' || $params[0]['id'] == 'woo_single_sidebar' ) {
					$df_box_mode = 'ui-wide';
				} else {
					
					$df_box_mode = 'ui-boxed';
				}


				$classe_to_add .= ' ' . ( $custom_variation ? htmlspecialchars(stripslashes($custom_variation), ENT_QUOTES) . ' ' : '' );

				$classe_to_add .= ' ' . ( $box_mode ? htmlspecialchars(stripslashes($box_mode), ENT_QUOTES) . ' ' : $df_box_mode );



				$params[0]['before_widget'] = implode($classe_to_add, explode('class="widget', $params[0]['before_widget'], 2));
				
				if ( $widget_icon != '' && ( strpos( $id, 'calendar' ) === false ) ) {
					$params[0]['before_widget'] .= '<i class="' . $widget_icon . '"></i>';
				}
				
				// check if widget has title, wrap content of widget into a div
				// get widget name
				$widget_name = substr($id, 0, strrpos($id, '-'));
				$w_index = substr($id, strrpos($id, '-') + 1);
				
				$w_options = get_option('widget_' . $widget_name);
				$w_options = $w_options[$w_index];
				if(isset($w_options['title']) && $w_options['title'] != ''){
					$params[0]['after_title'] .= '<div class="widget-content">';
					$params[0]['after_widget'] .= '</div>';
				} else {
					$params[0]['before_widget'] .= '<div class="widget-content">';
					$params[0]['after_widget'] .= '</div>';
				}

				if ( strpos( $id, 'calendar' )  !== false ) {
					$params[0]['before_title']  = '<div class="widget-title"><i class="' . $widget_icon . '"></i><h4 class="heading">';
				} else {
					$params[0]['before_title']  = '<div class="widget-title"><h4 class="heading">';
				}
			} else {

				// for widgets added by Custom Sidebars, the 'before_widget' and 'after_widget' is empty
				// so add default classes here
				$classe_to_add .= ' ' . ( $custom_variation ? htmlspecialchars(stripslashes($custom_variation), ENT_QUOTES) . ' ' : '' );

				$classe_to_add .= ' ' . ( $box_mode ? htmlspecialchars(stripslashes($box_mode), ENT_QUOTES) . ' ' : 'ui-wide' );

				$classe_to_add = apply_filters('cactus_before_widget_classes', $classe_to_add, $params);

				// get widget name
				$widget_name = substr($id, 0, strrpos($id, '-'));
				//$options = get_option( 'widget_felis_social_accounts' );
				global $wp_registered_widgets;

				// get widget classname
				$classname_ = '';
				foreach ((array) $wp_registered_widgets[$id]['classname'] as $cn) {
					if (is_string($cn)) {
						$classname_ .= '_' . $cn;
					} elseif (is_object($cn)) {
						$classname_ .= '_' . get_class($cn);
					}
				}
				$classname_ = ltrim($classname_, '_');

				$params[0]['before_widget'] = '<div class="row"><div id="' . $id . '" class="widget widget_' . $widget_name . ' ' . $classname_ . ' ' . $classe_to_add . '"><div class="widget__inner widget_' . $widget_name . '_inner">';
				$params[0]['after_widget']  = '</div></div></div>';
				// if ( ( strpos( $id, 'calendar' ) === true ) ) {
				// 	$params[0]['before_title']  = '<div class="widget-title"><i class="' . $widget_icon . '"></i><h4 class="heading">';
				// } else {
				// 	$params[0]['before_title']  = '<div class="widget-title"><i class="' . $widget_icon . '"></i><h4 class="heading">';
				// }
				
				$params[0]['after_title']   = '</h4></div>';
				
				// check if widget has title, wrap content of widget into a div
				$w_index = substr($id, strrpos($id, '-') + 1);
				
				$w_options = get_option('widget_' . $widget_name);
				$w_options = $w_options[$w_index];
				if(isset($w_options['title']) && $w_options['title'] != ''){
					$params[0]['after_title'] .= '<div class="widget-content">';
					$params[0]['after_widget'] .= '</div>';
				} else {
					$params[0]['before_widget'] .= '<div class="widget-content">';
					$params[0]['after_widget'] .= '</div>';
				}
			}

			return $params;
		}

		/**
		 * Intentional empty. Do not delete
		 */
		public function emptyControlCallback()
		{

		}
	}