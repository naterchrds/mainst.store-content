<?php
    /**
     * @package cactus
     */

    $cactus_postMeta =  new App\Views\ParseMeta();
?>

<article id="post-<?php the_id();?>" class="post">
	<div class="block">
		<?php if ( has_post_thumbnail() ): ?>
			<div class="related-thumbnail">
                <div class="item-thumbnail">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    	<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'img-responsive' ) ); ?>
                    </a>
                    <div class="item-overlay"></div>
                </div>
            </div>
		<?php endif; ?>
		<div class="related-content">
            <div class="related-title">
                <h3 class="h6 limit-lines_2"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
            </div>
            <div class="related-subtitle">
                <h6 class="limit-lines_2"><?php echo get_the_excerpt( 10 ); ?></h6>
            </div>
            <div class="related-meta">
				<?php $cactus_postMeta->renderPublishDate(); ?>    
            </div>
        </div>
	</div>
</article>