<?php

/**
 * hooks to change template HTML
 * @package cactus
 *
 */


use App\Views\CactusView;
use App\Cactus;


/**
 * Print out page header
 */
add_action( 'felis_page_header', 'felis_output_page_header' );
function felis_output_page_header( $header_layout = '' ) {
	$header_type       = 'default';
	$header_content    = '';
	$header_height     = 0;
	$header_background_image = '';
	$page_background = array();

	if ( $header_type == 'hidden' ) {
		return;
	}

	if ( is_page() || is_single() ) {
		$header_type = Cactus::getOption( 'page_header_type', 'default' );
		if ($header_type != 'default' ) {
			$header_content    = Cactus::getOption( 'page_header_content' );
			$page_background = Cactus::getOption( 'page_header_background' );
			if(isset($page_background['background-image']) && $page_background['background-image'] != '' ) {
				$header_background_image = $page_background['background-image'];
			}
			$header_height     = Cactus::getOption( 'page_header_height' );
		}
	}

	
	$color_mask = Cactus::getOption( 'header_mask', 'on' );



	$page_layout = Cactus::getOption( 'page_layout' );




	if ( $header_type == 'default' || $header_type == 'custom_content' ) {


		$header_bg = Cactus::getOption( 'default_header_background', array());
		$header_bg_repeat = isset($header_bg['background-repeat']) ? $header_bg['background-repeat'] : '';
		$header_bg_attachment = isset($header_bg['background-attachment']) ? $header_bg['background-attachment'] : '';
		$header_bg_position = isset($header_bg['background-position']) ? $header_bg['background-position'] : '';
		$header_bg_size = isset($header_bg['background-size']) ? $header_bg['background-size'] : '';

		if(is_single() || is_page()) {
			if(isset($page_background['background-color']) && $page_background['background-color'] != '' ){
				$header_bg['background-color'] = $page_background['background-color'];

				$header_background_image = '';
			}

			if(isset($page_background['background-image']) && $page_background['background-image'] != '' ){
				$header_background_image = $page_background['background-image'];
			}

			if(isset($page_background['background-repeat']) && $page_background['background-repeat'] != '' ){
				$header_bg_repeat = $page_background['background-repeat'];
			}

			if(isset($page_background['background-attachment']) && $page_background['background-attachment'] != '' ){
				$header_bg_attachment = $page_background['background-attachment'];
			}

			if(isset($page_background['background-position']) && $page_background['background-position'] != '' ){
				$header_bg_position = $page_background['background-position'];
			}

			if(isset($page_background['background-size']) && $page_background['background-size'] != '' ){
				$header_bg_size = $page_background['background-size'];
			}
		}

		$background_color = '';

		if (isset($header_bg['background-color']) && $header_bg['background-color'] != '' ) {
			$background_color = $header_bg['background-color'];

			if(is_single() || is_page()){
				if (get_post_meta(get_the_ID(), 'page_header_background', true) == '' && $header_bg['background-image'] == '' ) {
					$header_background_image = '';
				}
			}
		}

		$style_background = '';
		if($background_color != '' ){
			$style_background .= 'background-color:' . $background_color . ';';
		}

		if($header_background_image != '' ){
			$style_background .= 'background-image:url( ' . esc_url($header_background_image) . ' );';
		}

		if($header_bg_repeat != '' ){
			$style_background .= 'background-repeat:' . $header_bg_repeat . ';';
		}
		$page_header_background_parallax = Cactus::getOption( 'page_header_background_parallax', 'off' );

		if ( $page_header_background_parallax == 'on' && $header_background_image != '' ) {
			$style_background .= 'background-attachment:fixed;';
		} else {
			if( $header_bg_attachment != '' ){
				$style_background .= 'background-attachment:' . $header_bg_attachment . ';';
			}
		}

		

		if($header_bg_size != '' ){
			$style_background .= 'background-size:' . $header_bg_size . ';';
		}

		if($header_bg_position != '' ){
			$style_background .= 'background-position:' . $header_bg_position . ';';
		}

		$page_header_height_adaptive = Cactus::getOption( 'page_header_height_adaptive', 'off' );
		$CactusView = new CactusView();
		?>

		<div class="c-page-header <?php echo ( $header_background_image != '' ) ? 'background-image': ''; ?>" <?php echo ( $style_background != '' ) ? 'style="'.$style_background.'"' : ''; ?> >
			<div class="c-page-header__inner">
				<div class="c-container container">
					<div class="row">
						<div class="col-xs-12  header-content" >
							<div class="block">
								<?php $breadcrumb = Cactus::getOption( 'breadcrumb', 'on' ); ?>
								<?php if ( $breadcrumb == 'on' ) : ?> 
								<div class="c-page-header__breadcumbs">
									<?php 
									if ( function_exists( 'is_shop' ) && is_shop() || function_exists( 'is_product' ) && is_product() ) { 
										if ( function_exists( 'woocommerce_breadcrumb' ) ) {
											woocommerce_breadcrumb();
										}
									} else {
										$CactusView->renderBreadcrumbs( true ); 
									}
									
									?>
								</div>
							<?php endif; ?>


							<?php if ( $header_background_image == '' ): ?>
							<?php if ( ( function_exists( 'is_product' ) && is_product() ) || is_singular( 'post' )  ): ?>
						<?php else: ?>

						<div class="c-page-header__title text-gradient">
							<h1 class="font-heading"><?php $CactusView->renderTitle( true ); ?></h1>
						</div>
						<div class="c-page-header__subtitle">
							<h3><?php $CactusView->renderSubtitle( true ); ?></h3>
						</div>
					<?php endif; ?>

				<?php else: ?>
				<div class="page-header-content">
					<div class="c-page-header__subtitle">
						<h3><?php $CactusView->renderSubtitle( true ); ?></h3>
					</div>
					<div class="c-page-header__title font-special">
						<h1 class="font-heading"><?php $CactusView->renderTitle( true ); ?></h1>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
</div>
</div>

	<?php if ( $color_mask == 'on' && $header_background_image != '' ) { ?>
	<div class="mask"></div>
	<?php } ?>
	</div>
<!--!c-page-header-->
<?php
	} else if ( $header_type == 'custom_slider' ){
		?>
		<section class="c-page-header custom-slider">
			<div class="c-page-header__inner">
				<?php echo do_shortcode( $header_content ); ?>
			</div>
		</section>

		<?php
	}
}



add_filter( 'excerpt_length', 'felis_custom_excerpt_length', 999 );
function felis_custom_excerpt_length( $length ) {
	return Cactus::getOption( 'custom_excerpt_length', $length );
}

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 *
 * @return string (Maybe) modified "read more" excerpt string.
 */
function felis_excerpt_more( $more ) {
	return ' ...';
}

add_filter( 'excerpt_more', 'felis_excerpt_more' );

add_filter( 'cactus_dashboard_heading', 'felis_welcome_text' );
function felis_welcome_text( $text ) {
	return esc_html__( 'Felis Dashboard', 'felis' );
}

add_filter( 'cactus_theme_document_url', 'felis_online_document' );
function felis_online_document( $url ) {
	return '//felis.cactusthemes.com/doc';
}