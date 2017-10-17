<?php
	/**
	 * @package cactus
	 */

	use App\Cactus;

	get_header();

	$felis_page_layout = Cactus::getOption('page_layout');
	?>
	<div id="page-content-container" class="container<?php echo ($felis_page_layout == 'full_width' ? '-fluid' : '');?> <?php echo 'page-' . esc_attr($felis_page_layout);?>">
		<div class="c-page-content c-index <?php echo 'page-' . Cactus::getOption('page_layout'); ?>">
			<div id="primary" class="content-area">
				<main id="main" class="site-main main-content">

					<?php $felis_sidebar = felis_get_theme_sidebar_setting(); ?>

					<div class="row">

						<div class="col-xs-12 col-sm-12 <?php echo( ( $felis_sidebar != 'hidden' && is_active_sidebar('main_sidebar') ) ? 'col-md-9' : '' ); ?> <?php echo ($felis_sidebar == 'left' ? 'pull-right' : '');?>  col-1">

							<section id="c-blog" class="c-entry-main c-blog">
								<div class="c-blog__inner">

									<?php if (have_posts()) : ?>

									<div id="loop-content" class="block-group felis_blog style-2">
										<div class="c-grid gutter-15 felis_blog__content">
		                                     <div class="col-md-12 ">
                                                        <div class="grid-row">
                                                            <div id="grid" class="c-grid__wrap grid_shuffle">
										<?php
										/* Start the Loop */
										$index = 1;
										set_query_var('felis_post_count', felis_get_post_count());

										while (have_posts()) : the_post(); ?>
										<?php

										set_query_var('cactus_loop_index', $index);

										get_template_part('html/loop/content', get_post_format());

										$index ++;
										?>

									<?php endwhile; ?>
										    	</div>
										    </div>
										</div>
									</div>
								</div>

							<?php else : ?>

							<?php get_template_part('html/loop/content', 'none'); ?>

						<?php endif; ?>

						<?php

										//Get Pagination
						the_posts_pagination( array(
						    'mid_size' => 2,
						    'prev_text' => wp_kses( __( '<i class="fa fa-caret-left"></i>', 'felis' ), array( 'i' => array( 'class'=>'fa fa-caret-left') ) ) ,
						    'next_text' => wp_kses( __( '<i class="fa fa-caret-right"></i>', 'felis' ), array( 'i' => array( 'class'=>'fa fa-caret-right' ) ) ) ,
						) );

						?>
					</div>
				</section>

			</div>


			<?php

			if ( $felis_sidebar != 'hidden' && is_active_sidebar( 'main_sidebar' ) ) {
				?>
				<div class="col-xs-12 col-sm-12 col-md-3 col-2">
					<?php get_sidebar(); ?>
				</div>
				<?php } ?>
				</div>
			</main>
		</div>
	</div>
</div>

<!--!c-page-content-->
<?php
get_footer();