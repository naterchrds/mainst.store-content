<?php

/**
 * helper functions
 */
use App\Cactus;
use App\Models\Database;

/**
 * Get Front-Page template query settings
 */
function felis_get_front_page_query( $page = 1){
   $posts_per_page = Cactus::getOption('page_post_count') ? Cactus::getOption('page_post_count') : get_option('posts_per_page');
   $cats = Cactus::getOption('page_post_cats');
   $tags = Cactus::getOption('page_post_tags');
   $ids = Cactus::getOption('page_post_ids');
   $order = Cactus::getOption('page_post_order');
   $orderby = Cactus::getOption('page_post_orderby');
   
   $args = array(
                'post_type' => 'post',
                'categories' => $cats,
                'tags' => $tags,
                'ids' => $ids
                    );
   
   return Database::getPosts($posts_per_page, $order, $page, $orderby, $args);
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function felis_body_classes($classes){
	$classes[] = 'page';
	
	$header_layout = Cactus::getOption( 'header_style', 1 );
	$classes[] = 'header-style-' . $header_layout;
	
	// if we are in Full Page template and Sectionized mode, sticky menu should be turned off
	
	$sticky_menu = Cactus::getOption( 'nav_sticky', 1 );
	if($sticky_menu != 0){
		$classes[] = 'sticky-enabled';
		$classes[] = 'sticky-style-' . $sticky_menu;
	}

	// Adds a class of group-blog to blogs with more than 1 published author.
	if (is_multi_author()) {
		$classes[] = 'group-blog';
	}
	
	if ( is_page() ) {
		$page_padding = Cactus::getOption('page_padding', 'on');
		if( $page_padding == 'off' ) {
			$classes[] = 'no-padding';
		}
	}
	
	
	$sidebar = felis_get_theme_sidebar_setting();
	if($sidebar != 'full' && is_active_sidebar('main_sidebar')){
		$classes[] = 'is-sidebar';
	}
	
	$felis_page_layout = Cactus::getOption('page_layout');
	
	$aos_disable = Cactus::getOption('aos_disable', 'off');
	$classes[] = $aos_disable == 'off' ? 'aos_disabled' : '';
	
	return $classes;
}

add_filter('body_class', 'felis_body_classes');

add_filter( 'document_title_parts', 'felis_wp_title' );
function felis_wp_title( $title ) {
	
	if( is_404() ){
		$title['title'] = Cactus::getOption('page404_head_tag', $title['title']);
	}
	
	return $title;
}

if(!function_exists('remove_pages_from_search')){
	function felis_remove_pages_from_search() {
		if(Cactus::getOption('search_exclude_page') != 'off'){
			global $wp_post_types;
			$wp_post_types['page']->exclude_from_search = true;
		}
	}
}

add_action('init', 'felis_remove_pages_from_search');

/**
 * Use for global wp_query, get total number of posts in a query
 */
function felis_get_found_posts( $custom_query = null ){
	if(!$custom_query){
		global $wp_query; 
		$custom_query = $wp_query;
	} 
	
	$found_posts = 0;
	if($custom_query)
		$found_posts = $custom_query->found_posts;
	
	return $found_posts;
}

/**
 * Use for global wp_query, get total number of posts in a query
 */
function felis_get_post_count( $custom_query = null ){
	
	if(!$custom_query){
		global $wp_query; 
		$custom_query = $wp_query;
	}
	
	$post_count = 0;
	if($custom_query)
		$post_count = $custom_query->post_count;
	
	return $post_count;
}

/**
 * Setup postdata for object $item
 */
function felis_setup_postdata( $item ){
	global $post;
	$post = $item;
	setup_postdata($post);
}

/**
 * Set custom query to be Main Query, so we can use Template Tags like normal
 *
 * @return WP_Query main query to be returned later
 */
function felis_set_main_query( $custom_query ){
	global $wp_query;
	
	$temp_query = $wp_query;
	
	$wp_query = $custom_query;
	
	return $temp_query;
}

/**
 * create links to generate sample Contact Form 7 
 */
function felis_cf7_links_creating_forms() {
	
	$screen = get_current_screen();
	$action = isset($_GET['action']) ? esc_html($_GET['action']) : '';
	if($screen->id == 'toplevel_page_wpcf7' && $action != 'edit'){
		$act = isset($_GET['act']) ? esc_html($_GET['act']) : '';
		
		if($act == 'felis-create') {
			$style = isset($_GET['form']) ? intval($_GET['form']) : 1;
			
			$form = felis_create_sample_wpcf7($style);
			if($form) {
				?>
				<div class="notice notice-success is-dismissible">
					<p><?php echo esc_html__('Sample form created successfully!', 'felis');?></p>
				</div>
				<?php
			} else {
				?>
				<div class="notice notice-error is-dismissible">
					<p><?php echo esc_html__('Cannot create sample form. Please try again', 'felis');?></p>
				</div>
				<?php
			}
		}			
		?>
		<div class="notice felis-cf7-admin-links">
			<h4><?php echo esc_html__('Felis - Create Sample Forms', 'felis');?></h4>
			<p><?php echo sprintf(wp_kses(__('Click on below links to create pre-configured forms. For more information about customize contact forms, visit <a href="%s">our online document</a>', 'felis'), array('a' => array('href'=> array()))), 'http://felis.cactusthemes.com/doc/');?></p>
			<ul class="felis-cf7-sample-forms">
				<li><a href="<?php echo admin_url('admin.php?page=wpcf7&act=felis-create&form=1');?>" title="<?php esc_html_e('Click to generate form', 'felis');?>"><?php echo esc_html__('felis Contact Form', 'felis');?></a><img src="<?php echo get_parent_theme_file_uri() . '/images/cf7/contact.jpg';?>"/><span class="desc"><?php esc_html_e('Felis Contact Form use in Contact Page', 'felis');?></span></li>
				<li><a href="<?php echo admin_url('admin.php?page=wpcf7&act=felis-create&form=2');?>" title="<?php esc_html_e('Click to generate form', 'felis');?>"><?php echo esc_html__('felis Subscribe Form', 'felis');?></a><img src="<?php echo get_parent_theme_file_uri() . '/images/cf7/subscribe.jpg';?>"/><span class="desc"><?php esc_html_e('Felis Subscribe Form use in footer', 'felis');?></span></li>
			</ul>
		</div>
		<?php
	}
}
add_action( 'admin_notices', 'felis_cf7_links_creating_forms' );

/**
 * Create a sample Contact Form 7 
 *
 * @return WPCF7_Form
 */
function felis_create_sample_wpcf7( $style = 1){
	if ( function_exists( 'wpcf7_save_contact_form' ) ) {
		$title = '';
		$content = '';

		switch( $style ) {
			case 1:
				$title = 'Felis Contact Form';
				$content = '<div class="contact-form">
<div class="row">
<div class="col-md-6">[text* your-name placeholder "Your Name *"]</div>
<div class="col-md-6">[email* your-email placeholder "Your Email *"]</div>
<div class="col-md-6">[tel* your-phone-number placeholder "Your Phone Number *"]</div>
<div class="col-md-6">[text* your-subject placeholder "Subject"]</div>
</div>
<div class="row">
<div class="col-md-12">[textarea* your-message placeholder "Message"]</div>
</div>
<div class="row">
<div class="col-md-12">[submit class:bg-gradient "Post comment"]</div>
</div>
</div>';
				break;
			case 2:
				$title = 'Felis Subscribe Form';
				$content = '<div class="subscribe_form">
[email* your-email]<label>[submit]</label>
</div>';
				break;
		}

		if( $title != '' ) {
			$args = array(
						'id' => -1,
						'title' => $title,
						'locale' => null,
						'form' => $content,
						'mail' => null,
						'mail_2' => null,
						'messages' => null
					);
			
			return wpcf7_save_contact_form( $args );
		}
	}
	
	return false;
}

add_filter( 'next_post_link', 'ct_add_title_to_next_post_link' );
function ct_add_title_to_next_post_link( $link ) {
	$next_post = get_next_post();
	if ( $next_post ) {
		$title = $next_post->post_title;
		$link = str_replace( 'rel="next"', " title='".$title."' rel='next'", $link );
		return $link;
	}
	
}

add_filter( 'previous_post_link', 'ct_add_title_to_previous_post_link' );
function ct_add_title_to_previous_post_link( $link ) {
	$previous_post = get_previous_post();
	if ( $previous_post ) {
		$title = $previous_post->post_title;
		$link = str_replace( 'rel="prev"', " title='".$title."' rel='prev'", $link );
		return $link;
	}  
}

function ct_calendar( $output ) {
 	wp_cache_delete( 'get_calendar', 'calendar' );
    global $wpdb, $m, $monthnum, $year, $wp_locale, $posts;

	$key = md5( $m . $monthnum . $year );
	$cache = wp_cache_get( 'get_calendar', 'calendar' );

	if ( $cache && is_array( $cache ) && isset( $cache[ $key ] ) ) {
		/** This filter is documented in wp-includes/general-template.php */
		$output = $cache[ $key ];
		return $output;
	}

	if ( ! is_array( $cache ) ) {
		$cache = array();
	}

	// Quick check. If we have no posts at all, abort!
	if ( ! $posts ) {
		$gotsome = $wpdb->get_var("SELECT 1 as test FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' LIMIT 1");
		if ( ! $gotsome ) {
			$cache[ $key ] = '';
			wp_cache_set( 'get_calendar', $cache, 'calendar' );
			return;
		}
	}

	if ( isset( $_GET['w'] ) ) {
		$w = (int) $_GET['w'];
	}
	// week_begins = 0 stands for Sunday
	$week_begins = (int) get_option( 'start_of_week' );
	$ts = current_time( 'timestamp' );

	// Let's figure out when we are
	if ( ! empty( $monthnum ) && ! empty( $year ) ) {
		$thismonth = zeroise( intval( $monthnum ), 2 );
		$thisyear = (int) $year;
	} elseif ( ! empty( $w ) ) {
		// We need to get the month from MySQL
		$thisyear = (int) substr( $m, 0, 4 );
		//it seems MySQL's weeks disagree with PHP's
		$d = ( ( $w - 1 ) * 7 ) + 6;
		$thismonth = $wpdb->get_var("SELECT DATE_FORMAT((DATE_ADD('{$thisyear}0101', INTERVAL $d DAY) ), '%m')");
	} elseif ( ! empty( $m ) ) {
		$thisyear = (int) substr( $m, 0, 4 );
		if ( strlen( $m ) < 6 ) {
			$thismonth = '01';
		} else {
			$thismonth = zeroise( (int) substr( $m, 4, 2 ), 2 );
		}
	} else {
		$thisyear = gmdate( 'Y', $ts );
		$thismonth = gmdate( 'm', $ts );
	}

	$unixmonth = mktime( 0, 0 , 0, $thismonth, 1, $thisyear );
	$last_day = date( 't', $unixmonth );

	// Get the next and previous month and year with at least one post
	$previous = $wpdb->get_row("SELECT MONTH(post_date) AS month, YEAR(post_date) AS year
		FROM $wpdb->posts
		WHERE post_date < '$thisyear-$thismonth-01'
		AND post_type = 'post' AND post_status = 'publish'
			ORDER BY post_date DESC
			LIMIT 1");
	$next = $wpdb->get_row("SELECT MONTH(post_date) AS month, YEAR(post_date) AS year
		FROM $wpdb->posts
		WHERE post_date > '$thisyear-$thismonth-{$last_day} 23:59:59'
		AND post_type = 'post' AND post_status = 'publish'
			ORDER BY post_date ASC
			LIMIT 1");

	/* translators: Calendar caption: 1: month name, 2: 4-digit year */
	$calendar_caption = esc_html_x('%1$s %2$s', 'calendar caption', 'felis');
	$calendar_output = '<table id="wp-calendar">
	<caption>' . sprintf(
		$calendar_caption,
		'<span>'.$wp_locale->get_month_abbrev( $wp_locale->get_month( $thismonth ) ).'</span>',
		date( 'Y', $unixmonth )
	) . '</caption>
	<thead>
	<tr>';

	$myweek = array();

	for ( $wdcount = 0; $wdcount <= 6; $wdcount++ ) {
		$myweek[] = $wp_locale->get_weekday( ( $wdcount + $week_begins ) % 7 );
	}

	foreach ( $myweek as $wd ) {
		$day_name = $wp_locale->get_weekday_initial( $wd );
		$wd = esc_attr( $wd );
		$calendar_output .= "\n\t\t<th scope=\"col\" title=\"$wd\">$day_name</th>";
	}

	$calendar_output .= '
	</tr>
	</thead>

	<tfoot>
	<tr>';

	if ( $previous ) {
		$calendar_output .= "\n\t\t".'<td colspan="3" id="prev"><a href="' . get_month_link( $previous->year, $previous->month ) . '">&laquo; ' .
			$wp_locale->get_month_abbrev( $wp_locale->get_month( $previous->month ) ) .
		'</a></td>';
	} else {
		$calendar_output .= "\n\t\t".'<td colspan="3" id="prev" class="pad">&nbsp;</td>';
	}

	$calendar_output .= "\n\t\t".'<td class="pad">&nbsp;</td>';

	if ( $next ) {
		$calendar_output .= "\n\t\t".'<td colspan="3" id="next"><a href="' . get_month_link( $next->year, $next->month ) . '">' .
			$wp_locale->get_month_abbrev( $wp_locale->get_month( $next->month ) ) .
		' &raquo;</a></td>';
	} else {
		$calendar_output .= "\n\t\t".'<td colspan="3" id="next" class="pad">&nbsp;</td>';
	}

	$calendar_output .= '
	</tr>
	</tfoot>

	<tbody>
	<tr>';

	$daywithpost = array();

	// Get days with posts
	$dayswithposts = $wpdb->get_results("SELECT DISTINCT DAYOFMONTH(post_date)
		FROM $wpdb->posts WHERE post_date >= '{$thisyear}-{$thismonth}-01 00:00:00'
		AND post_type = 'post' AND post_status = 'publish'
		AND post_date <= '{$thisyear}-{$thismonth}-{$last_day} 23:59:59'", ARRAY_N);
	if ( $dayswithposts ) {
		foreach ( (array) $dayswithposts as $daywith ) {
			$daywithpost[] = $daywith[0];
		}
	}

	// See how much we should pad in the beginning
	$pad = calendar_week_mod( date( 'w', $unixmonth ) - $week_begins );
	if ( 0 != $pad ) {
		$calendar_output .= "\n\t\t".'<td colspan="'. esc_attr( $pad ) .'" class="pad">&nbsp;</td>';
	}

	$newrow = false;
	$daysinmonth = (int) date( 't', $unixmonth );

	for ( $day = 1; $day <= $daysinmonth; ++$day ) {
		if ( isset($newrow) && $newrow ) {
			$calendar_output .= "\n\t</tr>\n\t<tr>\n\t\t";
		}
		$newrow = false;

		if ( $day == gmdate( 'j', $ts ) &&
			$thismonth == gmdate( 'm', $ts ) &&
			$thisyear == gmdate( 'Y', $ts ) ) {
			$calendar_output .= '<td id="today">';
		} else {
			$calendar_output .= '<td>';
		}

		if ( in_array( $day, $daywithpost ) ) {
			// any posts today?
			$date_format = date( esc_html_x( 'F j, Y', 'daily archives date format', 'felis' ), strtotime( "{$thisyear}-{$thismonth}-{$day}" ) );
			/* translators: Post calendar label. 1: Date */
			$label = sprintf( esc_html__( 'Posts published on %s', 'felis' ), $date_format );
			$calendar_output .= sprintf(
				'<a href="%s" aria-label="%s">%s</a>',
				get_day_link( $thisyear, $thismonth, $day ),
				esc_attr( $label ),
				$day
			);
		} else {
			$calendar_output .= $day;
		}
		$calendar_output .= '</td>';

		if ( 6 == calendar_week_mod( date( 'w', mktime(0, 0 , 0, $thismonth, $day, $thisyear ) ) - $week_begins ) ) {
			$newrow = true;
		}
	}

	$pad = 7 - calendar_week_mod( date( 'w', mktime( 0, 0 , 0, $thismonth, $day, $thisyear ) ) - $week_begins );
	if ( $pad != 0 && $pad != 7 ) {
		$calendar_output .= "\n\t\t".'<td class="pad" colspan="'. esc_attr( $pad ) .'">&nbsp;</td>';
	}
	$calendar_output .= "\n\t</tr>\n\t</tbody>\n\t</table>";

	$cache[ $key ] = $calendar_output;
	wp_cache_set( 'get_calendar', $cache, 'calendar' );

	/** This filter is documented in wp-includes/general-template.php */
	$output = $calendar_output;
    return $output;
}
add_filter( 'get_calendar', 'ct_calendar' );


function ct_custom_upload_mimes( $mimes = array() ) {

	$mimes['ttf'] = "application/font-sfnt";
	$mimes['eot'] = "application/vnd.ms-fontobject";
	$mimes['otf'] =  'font/opentype';
    $mimes['woff'] = 'application/font-woff';

	return $mimes;
}

add_action('upload_mimes', 'ct_custom_upload_mimes');


if ( class_exists('WooCommerce') ) {
	function felis_woo_category() {
		global $wp_query, $post;
		// Setup Current Category
		$current_cat   = false;
		$cat_ancestors = array();

		if ( is_tax( 'product_cat' ) ) {
			$current_cat = $wp_query->queried_object;
		} 

		if ( $current_cat ) {
			$list_args['current_category'] = $current_cat->term_id;
			$cat_ancestors = get_ancestors( $current_cat->term_id, 'product_cat' );
		}
		
		$list_args['taxonomy'] = 'product_cat';
		$list_args['walker'] = new WC_Felis_Product_Cat_List_Walker;
		$list_args['title_li'] = '';
		$list_args['current_category_ancestors'] = $cat_ancestors;


		echo '<div class="archives-woo"><div class="cat-panel"> <span class="plus-toogle pull-right"></span> <span class="pull-right text-cat">'. esc_html__( 'Categories', 'felis' ) .'</span></div>
		<ul class="felis-product-categories">';

		wp_list_categories( $list_args );

		echo '</ul></div>';
		
	}
}