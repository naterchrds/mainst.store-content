<?php

/**
 * Class CactusContentSlider2
 */
class CactusContentSlider2 extends CactusShortcode_Block {
	public function __construct( $params = null, $content = '' ) {
		parent::__construct( 'felis_content_slider_2', $params, $content );
	}

	public function renderShortcode( $params, $content ) {

		$id             = isset( $params['id'] ) ? $params['id'] : 'c-content-slide-2-' . rand( 1, 9999 );
		$count          = isset( $params['count'] ) && $params['count'] != '' ? $params['count'] : 12;
		$data_source    = isset( $params['data_source'] ) && $params['data_source'] != '' ? $params['data_source'] : 'post';
		$cats           = isset( $params['cats'] ) ? $params['cats'] : '';
		$posts          = isset( $params['posts'] ) ? $params['posts'] : '';
		$video_cats     = isset( $params['video_cats'] ) ? $params['video_cats'] : '';
		$videos         = isset( $params['videos'] ) ? $params['videos'] : '';
		$order          = isset( $params['order'] ) ? $params['order'] : 'DESC';
		$orderby        = isset( $params['orderby'] ) ? $params['orderby'] : 'date';
		$items_per_row  = isset( $params['items_per_row'] ) && $params['items_per_row'] != '' ? $params['items_per_row'] : 3;
		$item_rows   	= isset( $params['item_rows'] ) && $params['item_rows'] != '' ? $params['item_rows'] : 1;
		$autoplay       = isset( $params['autoplay'] ) && $params['autoplay'] != '' ? $params['autoplay'] : 0;
		$bullets        = isset( $params['bullets'] ) && $params['bullets'] != '' ? $params['bullets'] : false;
		$bullets_align  = isset( $params['bullets_align'] ) && $params['bullets_align'] != '' ? $params['bullets_align'] : 'left';
		
		


		ob_start();
		?>
		<div class='felis-section felis_7'>
			<div id="<?php echo esc_attr( $id ); ?>" class='sc-slider slider_video style-1 dots-<?php echo esc_attr( $bullets_align ); ?>'>
				<div class='c-slider_wrap c-grid' data-autoplay="<?php echo esc_attr( $autoplay ); ?>"  data-dots="<?php echo esc_attr( $bullets ); ?>" data-count='<?php echo esc_attr( $items_per_row ); ?>' data-rows='<?php echo esc_attr( $item_rows ); ?>'>
					<div class='c-slider__inner'>
						<?php
							if ( $data_source == 'post' ) {
								$shortcode_query = App\Models\Database::getPosts( $count, $order, 1, $orderby, array(
									'categories' => $cats,
									'ids'        => $posts
									) );
							} else {
								$shortcode_query = App\Models\Database::getPosts( $count, $order, 1, $orderby, array(
									'categories' => $video_cats,
									'category_taxonomy' => 'ct_video_cat',
									'ids'        => $videos,
									'post_type'  => 'ct_video',
									) );
							}
							
							if ( $shortcode_query->have_posts() ) {

								while ( $shortcode_query->have_posts() ) {

									$shortcode_query->the_post();
									if ( has_post_thumbnail() ) {
										$video_url = get_post_meta( get_the_id(), 'video_url', true );
										if ( $video_url != '' ) {
											$link_class = 'swipebox-video';
											$link_url = $video_url;
											$btn_play = '<span class="c-btn btn-play"><span></span></span>';
										} else {
											$link_class = 'swipebox';
											$link_url = get_the_post_thumbnail_url( get_the_id(), 'full' );
											$btn_play = '';
										}
										$image_url = get_the_post_thumbnail_url( get_the_id(), array( 500, 500 ) );
										?>
										<div class='c-slider_item'>
											<div class="c-thumb__wrap">
	                                            <div class="c-thumb bg-image ratio-11">
	                                                <div class="c-thumb-inner">
	                                                   <div class="c-thumb ratio-11">
			                                                <div class="c-thumb-inner">
			                                                    <a href="<?php echo esc_url( $link_url ); ?>" class="<?php echo esc_attr( $link_class ); ?>" tabindex="0">
			                                                       <img class="c-image-grayscale img-responsive" alt="<?php get_the_title(); ?>" src="<?php echo esc_url( $image_url ); ?>" />
			                                                       <?php echo $btn_play; ?>
			                                                    </a>
			                                                </div>
	                                            		</div>
	                                                </div>
	                                            </div>
	                                        </div>
										</div>
										<?php
									}
								}//while have_posts
							}//if have_posts
							wp_reset_postdata();
						
						?>
					</div>
				</div>
			</div>
		</div>

		<?php
		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}

}

$contentSlider2 = new CactusContentSlider2();


/**
 * Register to Visual Composer
 */

add_action( 'after_setup_theme', 'reg_felis_content_slider_2' );

function reg_felis_content_slider_2() {
	if ( function_exists( 'vc_map' ) ) {

		$felis_content_slider_2_params = CactusShortcode_Block::extend_params( array(
			array(
				'admin_label' => true,
				'type'        => 'dropdown',
				'class'       => '',
				'heading'     => esc_html__( 'Data Source', 'felis' ),
				'param_name'  => 'data_source',
				'value'       => array(
					esc_html__( 'Post', 'felis' ) => 'post',
					esc_html__( 'Video Presentation', 'felis' ) => 'video',
					),
				'description' => esc_html__( 'Select Number of rows to show', 'felis' ),

				),

			array(
				'admin_label' => true,
				'type'        => 'textfield',
				'class'       => '',
				'heading'     => esc_html__( 'Total Items', 'felis' ),
				'param_name'  => 'count',
				'description' => esc_html__( 'Set max limit for items in slide or enter -1 to display all (limited to 1000).', 'felis' ),
				),

			array(
				'type' => 'autocomplete',
				'heading' => __( 'Select Specific Categories', 'felis' ),
				'param_name' => 'cats',
				'settings' => array(
					'multiple' => true,
					'sortable' => true,
					'unique_values' => true,
						// In UI show results except selected. NB! You should manually check values in backend
					),
				'description' => __( 'Search for category name to get autocomplete suggestions', 'felis' ),
				'dependency'  => array(
					'element' => 'data_source',
					'value'   => 'post'
					),
				),

			array(
				'type'        => 'autocomplete',
				'heading'     => __( 'Select specific Posts', 'felis' ),
				'param_name'  => 'posts',
				'settings' => array(
					'multiple' => true,
					'sortable' => true,
					'unique_values' => true,
									// In UI show results except selected. NB! You should manually check values in backend
					),
				'description' => __( 'Search for post ID or post title to get autocomplete suggestions', 'felis' ),
				'dependency'  => array(
					'element' => 'data_source',
					'value'   => 'post'
					),
				),


			array(
				'type' => 'autocomplete',
				'heading' => __( 'Select Specific Video Categories', 'felis' ),
				'param_name' => 'video_cats',
				'settings' => array(
					'multiple' => true,
					'sortable' => true,
					'unique_values' => true,
						// In UI show results except selected. NB! You should manually check values in backend
					),
				'description' => __( 'Search for video category name to get autocomplete suggestions', 'felis' ),
				'dependency'  => array(
					'element' => 'data_source',
					'value'   => 'video'
					),
				),

			array(
				'type'        => 'autocomplete',
				'heading'     => __( 'Select Specific Video Presentation', 'felis' ),
				'param_name'  => 'videos',
				'settings' => array(
					'multiple' => true,
					'sortable' => true,
					'unique_values' => true,
									// In UI show results except selected. NB! You should manually check values in backend
					),
				'description' => __( 'Search for video ID or post title to get autocomplete suggestions', 'felis' ),
				'dependency'  => array(
					'element' => 'data_source',
					'value'   => 'video'
					),
				),

			array(
				'type'        => 'dropdown',
				'admin_label' => true,
				'class'       => '',
				'heading'     => esc_html__( 'Order by', 'felis' ),
				'param_name'  => 'orderby',
				'value'       => array(
					esc_html__( 'Date', 'felis' )           => 'date',
					esc_html__( 'ID', 'felis' )             => 'ID',
					esc_html__( 'Author', 'felis' )         => 'author',
					esc_html__( 'Title', 'felis' )          => 'title',
					esc_html__( 'Name', 'felis' )           => 'name',
					esc_html__( 'Modified', 'felis' )       => 'modified',
					esc_html__( 'Parent', 'felis' )         => 'parent',
					esc_html__( 'Random', 'felis' )         => 'rand',
					esc_html__( 'Comment count', 'felis' )  => 'comment_count',
					esc_html__( 'Menu order', 'felis' )     => 'menu_order',
					esc_html__( 'None', 'felis' )           => 'none',
					),
				'description' => 'Select order type.',
				),

			array(
				'type'        => 'dropdown',
				'admin_label' => true,
				'class'       => '',
				'heading'     => esc_html__( 'Order', 'felis' ),
				'param_name'  => 'order',
				'value'       => array(
					esc_html__( 'DESC', 'felis' ) => 'DESC',
					esc_html__( 'ASC', 'felis' )  => 'ASC',
					),
				'description' => 'Select sorting order.',
				),

			array(
				'admin_label' => true,
				'type'        => 'dropdown',
				'class'       => '',
				'heading'     => esc_html__( 'Number of rows', 'felis' ),
				'param_name'  => 'item_rows',
				'value'       => array(
					esc_html__( '1 row', 'felis' ) => '1',
					esc_html__( '2 rows', 'felis' ) => '2',
					),
				'description' => esc_html__( 'Select Number of rows to show', 'felis' ),

				),

			array(
				'admin_label' => true,
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Select Number of items per row', 'felis' ),
				'param_name'  => 'items_per_row',
				'value'       => array(
					esc_html__( '2 items', 'felis' ) => '2',
					esc_html__( '3 items', 'felis' ) => '3',
					esc_html__( '4 items', 'felis' ) => '4',
					esc_html__( '6 items', 'felis' ) => '6',
					),
				'std'         => '3',
				'description' => esc_html__( 'The width of item depends on the number of items per row based on 12 columns. For example, if you choose 4 items per row, the width of each item will be 3 columns. Especially, if you want the width of each items is 3 columns, you can choose four items, then you just need to put 3 items per row.', 'felis' ),
				),


			array(
				'admin_label' => true,
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Autoplay', 'felis' ),
				'param_name'  => 'autoplay',
				'description' => esc_html__( 'Autoplay the slider or not', 'felis' ),
				),
			
			array(
				'admin_label' => true,
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Bullets', 'felis' ),
				'param_name'  => 'bullets',
				'description' => esc_html__( 'Enable the slider bullets or not', 'felis' ),
				'value'		  => array(
					'' => 'true'),
				),

			array(
				'admin_label' => true,
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Bullets Alignment', 'felis' ),
				'param_name'  => 'bullets_align',
				'value'       => array(
					esc_html__( 'Left', 'felis' ) => 'left',
					esc_html__( 'Right', 'felis' )  => 'right',
					esc_html__( 'Center', 'felis' )  => 'center',
					),
				'dependency'  => array(
					'element' => 'bullets',
					'value'   => 'true'
					),
				),

			) );

			



			vc_map( array(
				'name'                    => esc_html__( 'Felis Content Slider 2', 'felis' ),
				'base'                    => 'felis_content_slider_2',
				'content_element'         => true,
				'icon'                    => CT_SHORTCODE_PLUGIN_URL . '/shortcodes/img/ct_content_slider_2.png',
				'category'                => esc_html__( 'Felis Shortcodes', 'felis' ),
				'params'                  => $felis_content_slider_2_params,
			) );
	}

}

function felis_blog_post_autocomplete_suggester( $query) {
	global $wpdb;
	$post_id = (int) $query;
	$post_results = $wpdb->get_results( $wpdb->prepare( "SELECT a.ID AS id, a.post_title AS title FROM {$wpdb->posts} AS a
		WHERE a.post_type = 'post' AND a.post_status != 'trash' AND ( a.ID = '%d' OR a.post_title LIKE '%%%s%%' )", $post_id > 0 ? $post_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

	$results = array();
	if ( is_array( $post_results ) && ! empty( $post_results ) ) {
		foreach ( $post_results as $value ) {
			$data = array();
			$data['value'] = $value['id'];
			$data['label'] = $value['title'];
			$results[] = $data;
		}
	}

	return $results;
}


function felis_post_autocomplete_suggester_render( $query ) {
	$query = trim( $query['value'] ); // get value from requested
	if ( ! empty( $query ) ) {

		$post_object = get_post( (int) $query );
		if ( is_object( $post_object ) ) {
			$post_title = $post_object->post_title;
			$post_id = $post_object->ID;

			$data = array();
			$data['value'] = $post_id;
			$data['label'] = $post_title;

			return ! empty( $data ) ? $data : false;
		}

		return false;
	}

	return false;
}

function felis_term_category_autocomplete_suggester( $query) {
	$term_results = get_terms( 'category', array('name__like' => $query ) );

	$results = array();
	if ( is_array( $term_results ) && ! empty( $term_results ) ) {
		foreach ( $term_results as $value ) {
			$data = array();
			$data['value'] = $value->term_id;
			$data['label'] = $value->name;
			$results[] = $data;
		}
	}

	return $results;
}

function felis_term_category_autocomplete_suggester_render( $query ) {
	$query = trim( $query['value'] ); // get value from requested
	if ( ! empty( $query ) ) {

		$term_object = get_term_by( 'id', (int) $query, 'category' );
		if ( is_object( $term_object ) ) {
			$term_id = $term_object->term_id;
			$term_name = $term_object->name;

			$data = array();
			$data['value'] = $term_id;
			$data['label'] = $term_name;

			return ! empty( $data ) ? $data : false;
		}

		return false;
	}

	return false;
}


function felis_video_autocomplete_suggester( $query) {
	global $wpdb;
	$post_id = (int) $query;
	$post_results = $wpdb->get_results( $wpdb->prepare( "SELECT a.ID AS id, a.post_title AS title FROM {$wpdb->posts} AS a
		WHERE a.post_type = 'ct_video' AND a.post_status != 'trash' AND ( a.ID = '%d' OR a.post_title LIKE '%%%s%%' )", $post_id > 0 ? $post_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

	$results = array();
	if ( is_array( $post_results ) && ! empty( $post_results ) ) {
		foreach ( $post_results as $value ) {
			$data = array();
			$data['value'] = $value['id'];
			$data['label'] = $value['title'];
			$results[] = $data;
		}
	}

	return $results;
}


function felis_video_autocomplete_suggester_render( $query ) {
	$query = trim( $query['value'] ); // get value from requested
	if ( ! empty( $query ) ) {

		$post_object = get_post( (int) $query );
		if ( is_object( $post_object ) ) {
			$post_title = $post_object->post_title;
			$post_id = $post_object->ID;

			$data = array();
			$data['value'] = $post_id;
			$data['label'] = $post_title;

			return ! empty( $data ) ? $data : false;
		}

		return false;
	}

	return false;
}

function felis_video_category_autocomplete_suggester( $query) {
	$term_results = get_terms( 'ct_video_cat', array('name__like' => $query ) );

	$results = array();
	if ( is_array( $term_results ) && ! empty( $term_results ) ) {
		foreach ( $term_results as $value ) {
			$data = array();
			$data['value'] = $value->term_id;
			$data['label'] = $value->name;
			$results[] = $data;
		}
	}

	return $results;
}

function felis_video_category_autocomplete_suggester_render( $query ) {
	$query = trim( $query['value'] ); // get value from requested
	if ( ! empty( $query ) ) {

		$term_object = get_term_by( 'id', (int) $query, 'ct_video_cat' );
		if ( is_object( $term_object ) ) {
			$term_id = $term_object->term_id;
			$term_name = $term_object->name;

			$data = array();
			$data['value'] = $term_id;
			$data['label'] = $term_name;

			return ! empty( $data ) ? $data : false;
		}

		return false;
	}

	return false;
}

add_filter( 'vc_autocomplete_felis_content_slider_2_cats_callback', 'felis_term_category_autocomplete_suggester', 10, 1 );
add_filter( 'vc_autocomplete_felis_content_slider_2_cats_render', 'felis_term_category_autocomplete_suggester_render', 10, 1 );

add_filter( 'vc_autocomplete_felis_content_slider_2_posts_callback', 'felis_blog_post_autocomplete_suggester', 10, 1 );
add_filter( 'vc_autocomplete_felis_content_slider_2_posts_render', 'felis_post_autocomplete_suggester_render', 10, 1 );

add_filter( 'vc_autocomplete_felis_content_slider_2_video_cats_callback', 'felis_video_category_autocomplete_suggester', 10, 1 );
add_filter( 'vc_autocomplete_felis_content_slider_2_video_cats_render', 'felis_video_category_autocomplete_suggester_render', 10, 1 );

add_filter( 'vc_autocomplete_felis_content_slider_2_videos_callback', 'felis_video_autocomplete_suggester', 10, 1 );
add_filter( 'vc_autocomplete_felis_content_slider_2_videos_render', 'felis_video_autocomplete_suggester_render', 10, 1 );
