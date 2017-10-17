<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

use App\Cactus;
use App\Helpers\Number;
?>

<div class="system-status">
		<table class="widefat system-status-debug" cellspacing="0">
			<tbody>
				<tr>
					<td colspan="3" data-export-label="Cactus Versions">
						<span class="get-system-status"><a href="#" class="button-primary debug-report"><?php esc_html_e( 'Get System Report', 'felis' ); ?></a><span class="system-report-msg"><?php esc_html_e( 'Click the button to produce a report, then copy and paste into your support ticket.', 'felis' ); ?></span></span>

						<div id="debug-report">
							<textarea readonly="readonly"></textarea>
							<p class="submit"><button id="copy-for-support" class="button-primary" href="#" data-tip="<?php esc_html_e( 'Copied!', 'felis' ); ?>"><?php esc_html_e( 'Copy for Support', 'felis' ); ?></button></p>
						</div>
					</td>
				</tr>
			</tbody>
		</div>
		<h3 class="screen-reader-text"><?php esc_html_e( 'Cactus Versions', 'felis' ); ?></h3>
		<table class="widefat" cellspacing="0">
			<thead>
				<tr>
					<th colspan="3" data-export-label="Cactus Versions"><?php esc_html_e( 'Theme Version', 'felis' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td data-export-label="Current Version"><?php esc_html_e( 'Current Installed Version:', 'felis' ); ?></td>
					<td class="help">&nbsp;</td>
					<td><?php echo Cactus::getThemeVersion(); ?></td>
				</tr>
			</tbody>
		</table>

		<h3 class="screen-reader-text"><?php esc_html_e( 'WordPress Environment', 'felis' ); ?></h3>
		<table class="widefat" cellspacing="0">
			<thead>
				<tr>
					<th colspan="3" data-export-label="WordPress Environment"><?php esc_html_e( 'WordPress Environment', 'felis' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td data-export-label="Home URL"><?php esc_html_e( 'Home URL:', 'felis' ); ?></td>
					<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The URL of your site\'s homepage.', 'felis' ) . '">[?]</a>'; ?></td>
					<td><?php echo esc_url(home_url('/')); ?></td>
				</tr>
				<tr>
					<td data-export-label="Site URL"><?php esc_html_e( 'Site URL:', 'felis' ); ?></td>
					<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The root URL of your site.', 'felis' ) . '">[?]</a>'; ?></td>
					<td><?php echo site_url('/'); ?></td>
				</tr>
				<tr>
					<td data-export-label="WP Version"><?php esc_html_e( 'WP Version:', 'felis' ); ?></td>
					<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The version of WordPress installed on your site.', 'felis' ) . '">[?]</a>'; ?></td>
					<td><?php bloginfo( 'version' ); ?></td>
				</tr>
				<tr>
					<td data-export-label="WP Multisite"><?php esc_html_e( 'WP Multisite:', 'felis' ); ?></td>
					<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'Whether or not you have WordPress Multisite enabled.', 'felis' ) . '">[?]</a>'; ?></td>
					<td><?php echo ( is_multisite() ) ? '&#10004;' : '&ndash;'; ?></td>
				</tr>
				<tr>
					<td data-export-label="WP Memory Limit"><?php esc_html_e( 'WP Memory Limit:', 'felis' ); ?></td>
					<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The maximum amount of memory (RAM) that your site can use at one time.', 'felis' ) . '">[?]</a>'; ?></td>
					<td>
						<?php
                                                
						$memory = Number::let_to_num( WP_MEMORY_LIMIT );
						if ( $memory < 64000000 ) {
							echo '<mark class="error">' . sprintf( esc_html__( '%1$s - We recommend setting memory to at least <strong>64MB</strong>. To learn how, see: <a href="%2$s" target="_blank" rel="noopener noreferrer">Increasing memory allocated to PHP.</a>', 'felis' ), size_format( $memory ), 'http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP' ) . '</mark>';
						} else {
							echo '<mark class="yes">' . size_format( $memory ) . '</mark>';
						}
						?>
					</td>
				</tr>
				<tr>
					<td data-export-label="WP Debug Mode"><?php esc_html_e( 'WP Debug Mode:', 'felis' ); ?></td>
					<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'Displays whether or not WordPress is in Debug Mode.', 'felis' ) . '">[?]</a>'; ?></td>
					<td>
						<?php if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) : ?>
							<mark class="yes">&#10004;</mark>
						<?php else : ?>
							<mark class="no">&ndash;</mark>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td data-export-label="Language"><?php esc_html_e( 'Language:', 'felis' ); ?></td>
					<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The current language used by WordPress. Default = English', 'felis' ) . '">[?]</a>'; ?></td>
					<td><?php echo get_locale() ?></td>
				</tr>
			</tbody>
		</table>

		<h3 class="screen-reader-text"><?php esc_html_e( 'Server Environment', 'felis' ); ?></h3>
		<table class="widefat" cellspacing="0">
			<thead>
				<tr>
					<th colspan="3" data-export-label="Server Environment"><?php esc_html_e( 'Server Environment', 'felis' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td data-export-label="Server Info"><?php esc_html_e( 'Server Info:', 'felis' ); ?></td>
					<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'Information about the web server that is currently hosting your site.', 'felis' ) . '">[?]</a>'; ?></td>
					<td><?php echo esc_html( $_SERVER['SERVER_SOFTWARE'] ); ?></td>
				</tr>
				<tr>
					<td data-export-label="PHP Version"><?php esc_html_e( 'PHP Version:', 'felis' ); ?></td>
					<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The version of PHP installed on your hosting server.', 'felis' ) . '">[?]</a>'; ?></td>
					<td><?php if ( function_exists( 'phpversion' ) ) { echo esc_html( phpversion() ); } ?></td>
				</tr>
				<?php if ( function_exists( 'ini_get' ) ) : ?>
					<tr>
						<td data-export-label="PHP Post Max Size"><?php esc_html_e( 'PHP Post Max Size:', 'felis' ); ?></td>
						<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The largest file size that can be contained in one post.', 'felis' ) . '">[?]</a>'; ?></td>
						<td><?php echo size_format( Number::let_to_num( ini_get( 'post_max_size' ) ) ); ?></td>
					</tr>
					<tr>
						<td data-export-label="PHP Time Limit"><?php esc_html_e( 'PHP Time Limit:', 'felis' ); ?></td>
						<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The amount of time (in seconds) that your site will spend on a single operation before timing out (to avoid server lockups)', 'felis' ) . '">[?]</a>'; ?></td>
						<td>
							<?php
							$time_limit = ini_get( 'max_execution_time' );

							if ( 180 > $time_limit && 0 != $time_limit ) {
								echo '<mark class="error">' . sprintf( esc_html__( '%1$s - We recommend setting max execution time to at least 180. <br /> To import classic demo content, <strong>300</strong> seconds of max execution time is required.<br />See: <a href="%2$s" target="_blank" rel="noopener noreferrer">Increasing max execution to PHP</a>', 'felis' ), $time_limit, 'http://codex.wordpress.org/Common_WordPress_Errors#Maximum_execution_time_exceeded' ) . '</mark>';
							} else {
								echo '<mark class="yes">' . $time_limit . '</mark>';
								if ( 300 > $time_limit && 0 != $time_limit ) {
									echo '<br /><mark class="error">' . esc_html__( 'Current time limit is sufficient, but if you need import classic demo content, the required time is <strong>300</strong>.', 'felis' ) . '</mark>';
								}
							}
							?>
						</td>
					</tr>
					<tr>
						<td data-export-label="PHP Max Input Vars"><?php esc_html_e( 'PHP Max Input Vars:', 'felis' ); ?></td>
						<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The maximum number of variables your server can use for a single function to avoid overloads.', 'felis' ) . '">[?]</a>'; ?></td>
						<?php
						$registered_navs = get_nav_menu_locations();
						$menu_items_count = array( '0' => '0' );
						foreach ( $registered_navs as $handle => $registered_nav ) {
							$menu = wp_get_nav_menu_object( $registered_nav );
							if ( $menu ) {
								$menu_items_count[] = $menu->count;
							}
						}

						$max_items = max( $menu_items_count );
						
                        $required_input_vars = $max_items * 12;

						?>
						<td>
							<?php
							$max_input_vars = ini_get( 'max_input_vars' );
							$required_input_vars = $required_input_vars + ( 500 + 1000 );
							// 1000 = theme options
							if ( $max_input_vars < $required_input_vars ) {
								echo '<mark class="error">' . sprintf( __( '%1$s - Recommended Value: %2$s.<br />Max input vars limitation will truncate POST data such as menus. See: <a href="%3$s" target="_blank" rel="noopener noreferrer">Increasing max input vars limit.</a>', 'felis' ), $max_input_vars, '<strong>' . $required_input_vars . '</strong>', 'http://sevenspark.com/docs/ubermenu-3/faqs/menu-item-limit' ) . '</mark>';
							} else {
								echo '<mark class="yes">' . $max_input_vars . '</mark>';
							}
							?>
						</td>
					</tr>
					<tr>
						<td data-export-label="SUHOSIN Installed"><?php esc_html_e( 'SUHOSIN Installed:', 'felis' ); ?></td>
						<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'Suhosin is an advanced protection system for PHP installations. It was designed to protect your servers on the one hand against a number of well known problems in PHP applications and on the other hand against potential unknown vulnerabilities within these applications or the PHP core itself.
		If enabled on your server, Suhosin may need to be configured to increase its data submission limits.', 'felis'  ) . '">[?]</a>'; ?></td>
						<td><?php echo extension_loaded( 'suhosin' ) ? '&#10004;' : '&ndash;'; ?></td>
					</tr>
					<?php if ( extension_loaded( 'suhosin' ) ) :  ?>
						<tr>
							<td data-export-label="Suhosin Post Max Vars"><?php esc_html_e( 'Suhosin Post Max Vars:', 'felis' ); ?></td>
							<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The maximum number of variables your server can use for a single function to avoid overloads.', 'felis' ) . '">[?]</a>'; ?></td>
							<?php
							$registered_navs = get_nav_menu_locations();
							$menu_items_count = array( '0' => '0' );
							foreach ( $registered_navs as $handle => $registered_nav ) {
								$menu = wp_get_nav_menu_object( $registered_nav );
								if ( $menu ) {
									$menu_items_count[] = $menu->count;
								}
							}

							$max_items = max( $menu_items_count );
							if ( Cactus()->settings->get( 'disable_megamenu' ) ) {
								$required_input_vars = $max_items * 20;
							} else {
								$required_input_vars = $max_items * 12;
							}
							?>
							<td>
								<?php
								$max_input_vars = ini_get( 'suhosin.post.max_vars' );
								$required_input_vars = $required_input_vars + ( 500 + 1000 );

								if ( $max_input_vars < $required_input_vars ) {
									echo '<mark class="error">' . sprintf( __( '%1$s - Recommended Value: %2$s.<br />Max input vars limitation will truncate POST data such as menus. See: <a href="%3$s" target="_blank" rel="noopener noreferrer">Increasing max input vars limit.</a>', 'felis' ), $max_input_vars, '<strong>' . ( $required_input_vars ) . '</strong>', 'http://sevenspark.com/docs/ubermenu-3/faqs/menu-item-limit' ) . '</mark>';
								} else {
									echo '<mark class="yes">' . $max_input_vars . '</mark>';
								}
								?>
							</td>
						</tr>
						<tr>
							<td data-export-label="Suhosin Request Max Vars"><?php esc_html_e( 'Suhosin Request Max Vars:', 'felis' ); ?></td>
							<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The maximum number of variables your server can use for a single function to avoid overloads.', 'felis' ) . '">[?]</a>'; ?></td>
							<?php
							$registered_navs = get_nav_menu_locations();
							$menu_items_count = array( '0' => '0' );
							foreach ( $registered_navs as $handle => $registered_nav ) {
								$menu = wp_get_nav_menu_object( $registered_nav );
								if ( $menu ) {
									$menu_items_count[] = $menu->count;
								}
							}

							$max_items = max( $menu_items_count );
							if ( Cactus()->settings->get( 'disable_megamenu' ) ) {
								$required_input_vars = $max_items * 20;
							} else {
								$required_input_vars = ini_get( 'suhosin.request.max_vars' );
							}
							?>
							<td>
								<?php
								$max_input_vars = ini_get( 'suhosin.request.max_vars' );
								$required_input_vars = $required_input_vars + ( 500 + 1000 );

								if ( $max_input_vars < $required_input_vars ) {
									echo '<mark class="error">' . sprintf( __( '%1$s - Recommended Value: %2$s.<br />Max input vars limitation will truncate POST data such as menus. See: <a href="%3$s" target="_blank" rel="noopener noreferrer">Increasing max input vars limit.</a>', 'felis' ), $max_input_vars, '<strong>' . ( $required_input_vars + ( 500 + 1000 ) ) . '</strong>', 'http://sevenspark.com/docs/ubermenu-3/faqs/menu-item-limit' ) . '</mark>';
								} else {
									echo '<mark class="yes">' . $max_input_vars . '</mark>';
								}
								?>
							</td>
						</tr>
						<tr>
							<td data-export-label="Suhosin Post Max Value Length"><?php esc_html_e( 'Suhosin Post Max Value Length:', 'felis' ); ?></td>
							<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'Defines the maximum length of a variable that is registered through a POST request.', 'felis' ) . '">[?]</a>'; ?></td>
							<td><?php
								$suhosin_max_value_length = ini_get( 'suhosin.post.max_value_length' );
								$recommended_max_value_length = 2000000;

							if ( $suhosin_max_value_length < $recommended_max_value_length ) {
								echo '<mark class="error">' . sprintf( __( '%1$s - Recommended Value: %2$s.<br />Post Max Value Length limitation may prohibit the Theme Options data from being saved to your database. See: <a href="%3$s" target="_blank" rel="noopener noreferrer">Suhosin Configuration Info</a>.', 'felis' ), $suhosin_max_value_length, '<strong>' . $recommended_max_value_length . '</strong>', 'http://suhosin.org/stories/configuration.html' ) . '</mark>';
							} else {
								echo '<mark class="yes">' . $suhosin_max_value_length . '</mark>';
							}
							?></td>
						</tr>
					<?php endif; ?>
				<?php endif; ?>
				<tr>
					<td data-export-label="ZipArchive"><?php esc_html_e( 'ZipArchive:', 'felis' ); ?></td>
					<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'ZipArchive is required for importing demos. They are used to import and export zip files specifically for sliders.', 'felis' ) . '">[?]</a>'; ?></td>
					<td><?php echo class_exists( 'ZipArchive' ) ? '<mark class="yes">&#10004;</mark>' : '<mark class="error">ZipArchive is not installed on your server, but is required if you need to import demo content.</mark>'; ?></td>
				</tr>
				<tr>
					<td data-export-label="MySQL Version"><?php esc_html_e( 'MySQL Version:', 'felis' ); ?></td>
					<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The version of MySQL installed on your hosting server.', 'felis' ) . '">[?]</a>'; ?></td>
					<td>
						<?php global $wpdb; ?>
						<?php echo esc_html($wpdb->db_version()); ?>
					</td>
				</tr>
				<tr>
					<td data-export-label="Max Upload Size"><?php esc_html_e( 'Max Upload Size:', 'felis' ); ?></td>
					<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The largest file size that can be uploaded to your WordPress installation.', 'felis' ) . '">[?]</a>'; ?></td>
					<td><?php echo size_format( wp_max_upload_size() ); ?></td>
				</tr>
				<tr>
					<td data-export-label="DOMDocument"><?php esc_html_e( 'DOMDocument:', 'felis' ); ?></td>
					<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'DOMDocument is required for the Fusion Builder plugin to properly function.', 'felis' ) . '">[?]</a>'; ?></td>
					<td><?php echo class_exists( 'DOMDocument' ) ? '<mark class="yes">&#10004;</mark>' : '<mark class="error">DOMDocument is not installed on your server, but is required if you need to use the Fusion Page Builder.</mark>'; ?></td>
				</tr>
				<tr>
					<td data-export-label="WP Remote Get"><?php esc_html_e( 'WP Remote Get:', 'felis' ); ?></td>
					<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'Cactus uses this method to communicate with different APIs, e.g. Google, Twitter, Facebook.', 'felis' ) . '">[?]</a>'; ?></td>
					<?php $response = wp_safe_remote_get( 'https://build.envato.com/api/', array( 'decompress' => false, 'user-agent' => 'cactus-remote-get-test' ) ); ?>
					<td><?php echo ( ! is_wp_error( $response ) && $response['response']['code'] >= 200 && $response['response']['code'] < 300 ) ? '<mark class="yes">&#10004;</mark>' : '<mark class="error">wp_remote_get() failed. Some theme features may not work. Please contact your hosting provider and make sure that https://build.envato.com/api/ is not blocked.</mark>'; ?></td>
				</tr>
				<tr>
					<td data-export-label="WP Remote Post"><?php esc_html_e( 'WP Remote Post:', 'felis' ); ?></td>
					<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'Cactus uses this method to communicate with different APIs, e.g. Google, Twitter, Facebook.', 'felis' ) . '">[?]</a>'; ?></td>
					<?php $response = wp_safe_remote_post( 'https://envato.com/', array( 'decompress' => false, 'user-agent' => 'cactus-remote-get-test' ) ); ?>
					<td><?php echo ( ! is_wp_error( $response ) && $response['response']['code'] >= 200 && $response['response']['code'] < 300 ) ? '<mark class="yes">&#10004;</mark>' : '<mark class="error">wp_remote_post() failed. Some theme features may not work. Please contact your hosting provider and make sure that https://envato.com/ is not blocked.</mark>'; ?></td>
				</tr>
				<tr>
					<td data-export-label="GD Library"><?php esc_html_e( 'GD Library:', 'felis' ); ?></td>
					<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'Cactus uses this library to resize images and speed up your site\'s loading time', 'felis' ) . '">[?]</a>'; ?></td>
					<td>
						<?php
						$info = esc_attr__( 'Not Installed', 'felis' );
						if ( extension_loaded( 'gd' ) && function_exists( 'gd_info' ) ) {
							$info = esc_attr__( 'Installed', 'felis' );
							$gd_info = gd_info();
							if ( isset( $gd_info['GD Version'] ) ) {
								$info = esc_html($gd_info['GD Version']);
							}
						}
						echo $info;
						?>
					</td>
				</tr>
			</tbody>
		</table>

		<h3 class="screen-reader-text"><?php esc_html_e( 'Active Plugins', 'felis' ); ?></h3>
		<table class="widefat" cellspacing="0" id="status">
			<thead>
				<tr>
					<th colspan="3" data-export-label="Active Plugins (<?php echo count( (array) get_option( 'active_plugins' ) ); ?>)"><?php esc_html_e( 'Active Plugins', 'felis' ); ?> (<?php echo count( (array) get_option( 'active_plugins' ) ); ?>)</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$active_plugins = (array) get_option( 'active_plugins', array() );

				if ( is_multisite() ) {
					$active_plugins = array_merge( $active_plugins, get_site_option( 'active_sitewide_plugins', array() ) );
				}

				foreach ( $active_plugins as $plugin ) {

					$plugin_data    = @get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin );
					$dirname        = dirname( $plugin );
					$version_string = '';
					$network_string = '';

					if ( ! empty( $plugin_data['Name'] ) ) {

						// Link the plugin name to the plugin url if available.
						$plugin_name = esc_html( $plugin_data['Name'] );

						if ( ! empty( $plugin_data['PluginURI'] ) ) {
							$plugin_name = '<a href="' . esc_url( $plugin_data['PluginURI'] ) . '" title="' . esc_html__( 'Visit plugin homepage' , 'felis' ) . '">' . $plugin_name . '</a>';
						}
						?>
						<tr>
							<td><?php echo $plugin_name; ?></td>
							<td class="help">&nbsp;</td>
							<td><?php printf( _x( 'by %s', 'by author', 'felis' ), $plugin_data['Author'] ) . ' &ndash; ' . esc_html( $plugin_data['Version'] ) . $version_string . $network_string; ?></td>
						</tr>
						<?php
					}
				}
				?>
			</tbody>
		</table>
	</div>