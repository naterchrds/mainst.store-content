<?php

use App\Views\CactusView;
use App\Cactus;

/**
 * The Template for displaying all single posts.
 *
 * @package cactus
 */

get_header();

/**
 *
 * @author
 * @since 1.0
 * @code     CactusThemes
 */
do_action('felis_before_main_page');

$felis_page_layout = Cactus::getOption('page_layout');
?>

	<!-- #site-navigation -->
	<div class="container<?php echo ($felis_page_layout == 'full_width' ? '-fluid' : '');?>">
		<section class="c-page-content felis_blog c-blog-post <?php echo 'page-' . esc_attr($felis_page_layout);?>">
			<div id="primary" class="content-area">
				<main id="main" class="site-main main-content">
					<?php
					
					$felis_sidebar = Cactus::getOption('single_sidebar');
					$felis_page_gutter = Cactus::getOption( 'page_gutter', 'on' ) == 'off' ? 'no-gutter' : ''; 
					?>
					<div id="main-content" class="row felis_blog__content">
						<div class="col-xs-12 blog__content_wrap <?php echo ($felis_sidebar != 'hidden' && is_active_sidebar('main_sidebar') ? 'col-sm-12 col-md-9' : 'col-sm-12 col-md-12');?> <?php echo esc_attr( $felis_page_gutter );?> <?php echo ($felis_sidebar == 'left' ? 'pull-right' : '');?>  col-1">
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
							<section class="c-entry-main">

								<?php while (have_posts()) : the_post(); ?>
									<?php get_template_part( 'html/single/content', get_post_format() ); ?>
									<?php 
									$CactusView = new CactusView();
									$CactusView->renderPostNavigation();
									?>
									<?php get_template_part( 'html/single/related' ); ?>

									<?php
									// If comments are open or we have at least one comment, load up the comment template
									if ( comments_open() || '0' != get_comments_number() ) :
										comments_template();
									endif;
									?>

								<?php endwhile; // end of the loop. ?>
							</section>
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
							do_action('felis_after_content'); ?>
						</div>
						
						<?php if( $felis_sidebar != 'full' && is_active_sidebar('main_sidebar') ) { ?>
						<div class="col-xs-12 col-sm-12 col-md-3  col-2">
							<?php get_sidebar(); ?>
						</div>
						<?php } ?>
					</div>
				</main>
				<!-- main -->
			</div>
			<!-- primary -->

		</section>
		<!-- #c-page-content -->
	</div>

	<!--Get Bottom Sidebar-->
<?php

/**
 * @author
 * @since 1.0
 * @code     CactusThemes
 */
do_action('felis_after_main_page');

get_footer();