<?php

    use App\Views\CactusView;
    use App\Cactus;

    /**
     * The Template for displaying all single pages.
     *
     * @package cactus
     */

    get_header();
	
	$felis_page_layout = Cactus::getOption('page_layout');
?>

	
    <!-- #site-navigation -->
	<div id="page-content-container" class="container<?php echo ($felis_page_layout == 'full_width' ? '-fluid' : '');?> <?php echo 'page-' . esc_attr($felis_page_layout);?>">
		
		<?php
		
		/**
		 *
		 * @author
		 * @since 1.0
		 * @code     CactusThemes
		 */
		do_action('felis_before_main_page');
		
		?>
		
		<div class="c-page-content c-single-page">
			<div id="primary" class="content-area">
				<main id="main" class="site-main main-content">
					<?php 
					
					$felis_sidebar = Cactus::getOption( 'page_sidebar', 'full' );
					$felis_page_gutter = Cactus::getOption( 'page_gutter', 'on' ) == 'off' ? 'no-gutter' : ''; 
					
					?>
					
						<div id="main-content" class="row">
							<div class="col-xs-12 <?php echo ($felis_sidebar != 'full' ? 'col-sm-12 col-md-9' : 'col-sm-12 col-md-12');?> <?php echo esc_attr( $felis_page_gutter );?> <?php echo ($felis_sidebar == 'left' ? 'pull-right' : '');?> col-1">
								<?php

									/**
									 * felis_before_content hook
									 *
									 * @hooked felis_output_bodytop_sidebar - 10
									 *
									 * @author
									 * @since 1.0
									 * @code     CactusThemes
									 */
									do_action('felis_before_content');
								?>
								<div class="c-entry-main">

									<?php while (have_posts()) : the_post(); ?>
										<?php get_template_part('html/single/content', 'page'); ?>

										<?php
										// If comments are open or we have at least one comment, load up the comment template
										$cactus_pagecomments = \App\Cactus::getOption('page_comments', 'on');
										
										if ( ! is_front_page() ) {
											if ($cactus_pagecomments == 'on' && ( comments_open() || '0' != get_comments_number() )) :
											comments_template();
											endif;
										}
										
										?>
									<?php endwhile; // end of the loop. ?>
								</div>
								
								<!-- row -->

								<?php

									/**
									 * felis_after_content hook
									 *
									 * @hooked felis_output_bodybottom_sidebar - 10
									 *
									 * @author
									 * @since 1.0
									 * @code     CactusThemes
									 */
									do_action('felis_after_content');
								?>
							</div>
							
							<?php
							
							if( $felis_sidebar != 'full' ) {?>
							<div class="col-xs-12 col-sm-12 col-md-3  col-2">
								<?php get_sidebar(); ?>
							</div>
							<?php }?>
							
						</div>

				</main>
				<!-- main -->
			</div>
			<!-- primary -->	
		</div>
		<!-- #c-page-content -->
		
		<?php

			/**
			 *
			 * @author
			 * @since 1.0
			 * @code     CactusThemes
			 */
			do_action('felis_after_main_page');
		?>
	</div>

<?php 
    get_footer();