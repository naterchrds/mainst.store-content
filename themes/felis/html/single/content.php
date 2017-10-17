<?php
/**
 * @package cactus
 */
use App\Cactus;
$cactus_postMeta =  new App\Views\ParseMeta();
$subtitle = Cactus::getOption('post_sub_title');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
		<div class="col-xs-12 ">
			<header class="entry-header">
				<?php if ( has_post_thumbnail() ): ?>
				<div class="c-entry-img">
					<div class="c-thumb__wrap">
						<div class="c-thumb ratio-169">
							<div class="c-thumb-inner c-image-grayscale">
			                   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    				<?php echo felis_thumbnail( 1024, 1024 ); ?>
                    			</a>
               				</div>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<div class="c-meta">
					<div class="item-meta entry-meta">
						<ul>
							<?php 
							$cactus_show_categories = \App\Cactus::getOption( 'single_categories', 'on' );
							if ( $cactus_show_categories == 'on' ) :
							?>
							<li class="entry-category">
								<?php $cactus_postMeta->renderPostCategory( true ); ?>
							</li>
							<?php endif; ?>
							<?php 
							$cactus_show_published_date = \App\Cactus::getOption( 'single_published_date', 'on' );
							if ( $cactus_show_published_date == 'on' ) :
							?>
							<li class="entry-date">
								<?php $cactus_postMeta->renderPublishDate(); ?>
							</li>
							<?php endif; ?>
						</ul>
						 
						 
					</div>
				</div>
				<div class="c-maintitle">
					<h1><?php the_title(); ?></h1>
				</div>
				<?php if ( $subtitle != '' ) : ?>
				<div class="c-subtitle">
					<h2><?php echo esc_html( $subtitle ); ?></h2>
				</div>
				<?php endif; ?>
				<?php get_template_part( 'html/single/content', 'social-share' ); ?>
			</header>
		</div>
		<div class="col-xs-12 ">
            <div class="entry-content">
                <div class="item-content">
                    <?php the_content(); ?>

                    <?php 
                    wp_link_pages( array(
						'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'felis' ),
						'after'       => '</div>',
						'link_before' => '<span class="page-number">',
						'link_after'  => '</span>',
					) ); 
					?>
                </div>
                <?php get_template_part( 'html/single/content', 'social-share' ); ?>
                <div class="item-tags">
                	<?php
	                	$cactus_show_tags = \App\Cactus::getOption( 'single_tags', 'on' );
	                	if ( $cactus_show_tags == 'on' ) {
	                		the_tags( '<h5>' . esc_html__( 'Tags', 'felis' ) . '</h5><ul class="list-inline"><li>', ',</li> <li>', '</li></ul>' );
	                	} 
                	?>
                </div>
                
					<?php 
						$cactus_show_author = \App\Cactus::getOption( 'single_author', 'on' );
						if ( $cactus_show_author == 'on' && get_the_author_meta( 'description' ) != '' ) {
							get_template_part( 'html/single/author' ); 
						}
					?>
            </div>
        </div>

	</div>
</article>
<!--!article-->