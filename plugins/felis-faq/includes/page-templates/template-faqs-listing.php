
<?php
	/**
	 * Template Name: FAQ Page
	 *
	 * @package felis
	 */
	
	use App\Cactus;
	
	get_header();

	/**
	 * felis_before_main_page hook
	 *
	 * @hooked cactus_output_before_main_page - 10
	 * @hooked felis_output_top_sidebar - 89
	 *
	 * @author
	 * @since 1.0
	 * @code     CactusThemes
	 */
	do_action('felis_before_main_page');

	?>
	<section class="c-page-content c-index">
		<div id="primary" class="content-area">
			<main id="main" class="site-main main-content">

				<?php 

				$felis_sidebar = Cactus::getOption( 'page_sidebar', 'full' );
				$felis_page_gutter = Cactus::getOption( 'page_gutter', 'on' ) == 'off' ? 'no-gutter' : ''; 

				?>

				<div class="container c-container">
					<div class="row c-row <?php echo $felis_sidebar == 'left' ? 'revert-sidebar' : '';?>">
						<div class="col-xs-12 <?php echo $felis_sidebar != 'full' ? 'col-sm-12 col-md-9' : 'col-sm-12 col-md-12';?> c-column <?php echo esc_attr($felis_page_gutter);?> col-1">
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


										$all_cats = get_categories( 'taxonomy='.FelisFaq::TAX_CATEGORY.'&type='.FelisFaq::POST_TYPE );
										$custom_terms = get_terms( 'ct_faq_cat' );
										if ( is_array( $custom_terms ) ) {
											?>
											<div class="felis_tabs">
												<div class="c-tabs tabs-vertical-left">
													<ul class="nav nav-tabs col-sm-3">
														<?php
														$i = 1;
														foreach ( $custom_terms as $key => $value ) {
															$term_meta = get_option( FelisFaq::TAX_CATEGORY.'_'.$value->term_id );
															?>
															<li class="<?php echo ( $i == 1) ? 'active' : ''; ?>">
																<div class="c-icon-box icon-center backgorund_box">
																	<span class="icon">
																		<i class="<?php echo esc_attr( $term_meta['icon'] ); ?>"></i>
																	</span>
																	<h6><?php echo esc_html( $value->name ); ?></h6>
																	<a href="#tab<?php echo esc_attr( $i ); ?>" data-toggle="tab"></a>
																</div>
															</li>
															<?php
															$i++;
														}
														?>
													</ul>

													<div class="tab-content">

														<?php
														$j = 1;
														foreach ( $custom_terms as $key => $value ) { ?>
														<div class="tab-pane <?php echo ( $j == 1) ? 'active' : ''; ?>" id="tab<?php echo esc_attr( $j ); ?>">
															<?php
															$args = array(
																'post_type' => FelisFaq::POST_TYPE,
																FelisFaq::TAX_CATEGORY => $value->slug
																);
															$felis_custom_query = new WP_Query( $args );

															if ( $felis_custom_query->have_posts() ) : ?>
															<div class="c-accordions_wrap">
																<ul class="accordions_list">
																	<?php while ($felis_custom_query->have_posts()) : $felis_custom_query->the_post(); ?>
																	<li class="parent has-child">
																		<a class="accordion-target" href=""><?php the_title(); ?></a>
																		<div class="c-accordions_content">
																			<?php the_content(); ?>
																		</div>
																	</li>
																<?php endwhile; ?>
																<?php wp_reset_postdata(); ?>
															</ul>
														</div>

													<?php endif; $j++; ?>
												</div>
												<?php
											}

											?>
										</div>
									</div>
								</div>
								<?php
							}



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

								<?php

								if( $felis_sidebar != 'full' ) {?>
								<div class="col-xs-12 col-sm-12 col-md-3 c-column col-2">
									<?php get_sidebar(); ?>
								</div>
								<?php }?>
							</div>
						</div>

					</main>
				</div>
			</section>
			<!--!c-page-content-->

		</section>
		<!--!site-content-->
		<?php

	/**
	 * felis_after_main_page hook
	 *
	 * @hooked felis_output_after_main_page - 90
	 * @hooked felis_output_bottom_sidebar - 91
	 *
	 * @author
	 * @since 1.0
	 * @code     CactusThemes
	 */
	do_action('felis_after_main_page');

	get_footer();