<?php

/**
 * Class CactusContentGrid
 */
class CactusContentGrid extends CactusShortcode_Block {
	public function __construct( $params = null, $content = '' ) {
		parent::__construct( 'felis_content_grid', $params, $content );
	}

	public function renderShortcode( $params, $content ) {

		$id             = isset( $params['id'] ) ? $params['id'] : 'c-content-slide-2-' . rand( 1, 9999 );
		$count = 5;
		$data_source    = isset( $params['data_source'] ) ? $params['data_source'] : 'post';
		$cats           = isset( $params['cats'] ) ? $params['cats'] : '';
		$posts          = isset( $params['posts'] ) ? $params['posts'] : '';
		$video_cats     = isset( $params['video_cats'] ) ? $params['video_cats'] : '';
		$videos         = isset( $params['videos'] ) ? $params['videos'] : '';
		$order          = isset( $params['order'] ) ? $params['order'] : 'DESC';
		$orderby        = isset( $params['orderby'] ) ? $params['orderby'] : 'date';

		ob_start();
			?>
		<div class='felis-section felis-content-grid'>
			<div id="<?php echo esc_attr( $id ); ?>" class="sc-grid">
				<div class="c-grid gutter-5">
					<div class="grid-row">
						<div id="grid" class="c-grid__wrap grid_shuffle">
			<?php
			$i = 1;
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
				while ( $shortcode_query->have_posts() ) {
					$shortcode_query->the_post();
					if ( has_post_thumbnail() ) {
						$image_class = '';
						$video_url = get_post_meta( get_the_id(), 'video_url', true );
						
						if ( $video_url != '' ) {
							$link_class = 'swipebox-video c-btn btn-play';
							$link_url = $video_url;
						} else {
							$link_class = 'swipebox';
							$link_url = get_the_post_thumbnail_url( get_the_id(), 'full' );
						}

						if ( $i == 2 ) {
							$size = 30;
							$group = 'md';
							$image_url = get_the_post_thumbnail_url( get_the_id(), array( 500, 500) );
						} else if ( $i == 3 ) {
							$size = 60;
							$group = 'lg';
							$image_class = 'remove-5px height-50';
							$image_url = get_the_post_thumbnail_url( get_the_id(), 'large' );
						} else {
							$size = 10;
							$group = 'sm';
							$image_url = get_the_post_thumbnail_url( get_the_id(), 'thumbnail' );
						}
						
						?>
						<div class="grid-item width-<?php echo esc_attr( $size ); ?>" data-groups='["all","width-<?php echo esc_attr( $group ); ?>"]' data-date-created="" data-title="">
							<div class="grid-item__inner">
								<div class="c-thumb__wrap">
									<div class="c-thumb bg-image ratio-11 <?php echo esc_attr( $image_class ); ?>">
										<div class="c-thumb-inner">
											<a href="<?php echo esc_url( $link_url ); ?>"  class="<?php echo esc_attr( $link_class ); ?>"><span></span></a>
											<div class="bg_image c-image-grayscale" style="background-image: url( <?php echo esc_url( $image_url ); ?>);"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
						if( $i == 5 ) {
							break;
						}
						$i++;
					}
					
				}//while have_posts
				wp_reset_postdata();
			
		?>
						</div>
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

$contentGrid = new CactusContentGrid();


/**
 * Register to Visual Composer
 */

add_action( 'after_setup_theme', 'reg_felis_content_grid' );

function reg_felis_content_grid() {
	if ( function_exists( 'vc_map' ) ) {

		$felis_content_grid_params = CactusShortcode_Block::extend_params( array(
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
				'type' => 'autocomplete',
				'heading' => __( 'Select specific Categories', 'felis' ),
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
				'heading' => __( 'Select specific Categories Video', 'felis' ),
				'param_name' => 'video_cats',
				'settings' => array(
					'multiple' => true,
					'sortable' => true,
					'unique_values' => true,
						// In UI show results except selected. NB! You should manually check values in backend
					),
				'description' => __( 'Search for category name to get autocomplete suggestions', 'felis' ),
				'dependency'  => array(
					'element' => 'data_source',
					'value'   => 'video'
					),
				),

			array(
				'type'        => 'autocomplete',
				'heading'     => __( 'Select specific Video Presentation', 'felis' ),
				'param_name'  => 'videos',
				'settings' => array(
					'multiple' => true,
					'sortable' => true,
					'unique_values' => true,
									// In UI show results except selected. NB! You should manually check values in backend
					),
				'description' => __( 'Search for post ID or post title to get autocomplete suggestions', 'felis' ),
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

			) );


vc_map( array(
	'name'                    => esc_html__( 'Felis Content Grid', 'felis' ),
	'base'                    => 'felis_content_grid',
	'content_element'         => true,
	'icon'                    => CT_SHORTCODE_PLUGIN_URL . '/shortcodes/img/ct_content_grid.png',
	'category'                => esc_html__( 'Felis Shortcodes', 'felis' ),
	'params'                  => $felis_content_grid_params,
	) );
}

}



add_filter( 'vc_autocomplete_felis_content_grid_cats_callback', 'felis_term_category_autocomplete_suggester', 10, 1 );
add_filter( 'vc_autocomplete_felis_content_grid_cats_render', 'felis_term_category_autocomplete_suggester_render', 10, 1 );

add_filter( 'vc_autocomplete_felis_content_grid_posts_callback', 'felis_blog_post_autocomplete_suggester', 10, 1 );
add_filter( 'vc_autocomplete_felis_content_grid_posts_render', 'felis_post_autocomplete_suggester_render', 10, 1 );


add_filter( 'vc_autocomplete_felis_content_grid_video_cats_callback', 'felis_video_category_autocomplete_suggester', 10, 1 );
add_filter( 'vc_autocomplete_felis_content_grid_video_cats_render', 'felis_video_category_autocomplete_suggester_render', 10, 1 );

add_filter( 'vc_autocomplete_felis_content_grid_videos_callback', 'felis_video_autocomplete_suggester', 10, 1 );
add_filter( 'vc_autocomplete_felis_content_grid_videos_render', 'felis_video_autocomplete_suggester_render', 10, 1 );