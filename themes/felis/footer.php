<?php
	/**
	 * The template for displaying the footer.
	 *
	 * Contains the closing of the #content div and all content after
	 *
	 * @package cactus
	 */
	use App\Cactus;
    $footer_text_schema = Cactus::getOption( 'footer_text_schema' );

?>

</div>
<?php 
    if ( class_exists( 'woocommerce') && is_singular( 'product' ) ) {

        $lookbook = get_post_meta( get_the_id(), 'product_lookbook', true );
        $lookbook = $lookbook != '' ? explode( ',', $lookbook ) : '';       
        if ( ! empty( $lookbook ) ) :
?>
        <div class="row">
            <div class="c-slider_wrap single-product-slider" data-count="1">
                <div class="c-slider__inner">
                    <?php foreach ( $lookbook as $key => $value ) { 
                        $image = wp_get_attachment_image_src( $value, 'full' );
                    ?>

                    <div class="c-slider_item">
                        <div class="c-thumb__wrap">
                            <div class="c-thumb bg-image ratio-32">
                                <div class="c-thumb-inner">
                                    <div class="bg_image c-image-color" style="background-image: url(<?php echo esc_attr( $image[0] ); ?>);"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
<?php endif; ?>
        <div class="container-fluid">
            <div class="row woo-single-bottom">
                <?php 
                    if ( is_active_sidebar( 'woo_single_sidebar' ) ) {
                        dynamic_sidebar( 'woo_single_sidebar' );
                    }
                ?>
            </div>
        </div>
<?php  } ?> 
<!-- !.c-wrapper-->
<div id="footer-wrapper" class="">
        <footer id="colophon" class="site-footer footer-container <?php echo esc_attr( $footer_text_schema ); ?>">
                
               <?php if ( is_active_sidebar( 'footer_sidebar' ) ) { ?>
                <div class="c-footer__top">
                    <div id="footer-top-wrapper" class="container">
                        <?php if ( is_active_sidebar( 'footer_sidebar' ) ) { ?>
                            <div class="row">
                                <div class="c-sidebar">
                                    <div id="footer-sidebar" class="footer-sidebar" role="complementary">
                                        <?php dynamic_sidebar( 'footer_sidebar' );?>
                                    </div>
                                </div>
                            </div><!--!links-->
                        <?php } ?>
                        <!--!links-->
                    </div>
                </div>
                <!--!footer-top-->
                <?php } ?>
                <div class="c-footer__bottom">
                    <div id="footer-bottom-wrapper" class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 ">
                                <div class="c-copyright">
                        <?php
                            if ( Cactus::getOption( 'copyright' ) != '' ) {
                                echo '<p>' . wp_kses_post( Cactus::getOption( 'copyright' ) ) . '</p>';
                            } else { ?>
                               <p><?php printf( esc_html__( '&copy; %1$s CactusThemes Inc. All rights reserved', 'felis' ), esc_attr( date( 'Y' ) ) ); ?></p>
                               <?php } ?>
                                </div>
                            </div>
                           <!--  <div class="col-xs-12 col-sm-6 col-md-6 ">
                                <div class="c-footer-menu pull-right">
                                </div>
                            </div> -->
                        </div>
                    </div>
                
                </div>
                <!--!footer-bottom-->
            

        </footer>
        <!--!site-footer-->

</div><!-- !#footer-wrapper -->
</div>
<!--!#page-->
</div>
<!-- !.body_wrap-->
</div>
<!-- close Wrap -->
<?php wp_footer(); ?>
</body>
</html>