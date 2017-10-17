<?php
    /**
     * @package cactus
     */

    $cactus_postMeta = new App\Views\ParseMeta();
    $classes = array();
    $classes[] = 'grid-item';
    $classes[] = 'width-50';
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
    <div class="grid-item__inner">
        <?php if ( is_sticky( get_the_id() ) ) : ?>
                    <i class="sticky-post fa fa-thumb-tack"></i>
                    <?php endif; ?>
        <?php if ( has_post_thumbnail() ) : ?>
        <div class="c-thumb__wrap">
            <div class="c-thumb ratio-169">
                <div class="c-thumb-inner c-image-grayscale">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    <?php echo felis_thumbnail( array( 640, 427 ) ); ?>
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="item__details clearfix">
            <?php 
            $categories = get_the_category();
            if ( ! empty( $categories ) ) : 
            ?>
            <div class="grid-item__category">
                <?php $cactus_postMeta->renderPostCategory( true ); ?>
            </div>
            <?php endif; ?>
            <div class="grid-item__title">
                <?php $cactus_postMeta->renderPostTitle('h3'); ?>
            </div>
            <div class="grid-item__content">
                <?php
                $more_text = \App\Cactus::getOption( 'more_text', 'Continue Reading' );
                if ( strpos( $post->post_content, '<!--more-->' ) ) {
                    the_content( $more_text );
                }
                else {
                    the_excerpt();
                }
                if ( $post->post_title == '' ) : ?>
                <a href="<?php the_permalink(); ?>" class="more-link"><?php echo esc_html( $more_text );  ?></a>

                <?php endif; ?>
            </div>
        </div>
    </div>
</div>