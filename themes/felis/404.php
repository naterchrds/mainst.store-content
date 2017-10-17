<?php

    

    /**
     * The Template for displaying 404 page.
     *
     * @package cactus
     */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package cactus
 */
use App\Views\CactusView;
use App\Cactus;

?>

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <div class="wrap">
    <div class="body_wrap">
      <header class="site-header style-2">
        <div class="header_inner">
          <div class="main__menu">
            <div class="main-navigation">
              <!-- menu -->
              <div class="wrap_branding">
                <div class="wrap_branding__inner">
                  <?php felis_get_logo( true, true ); ?>
                </div>
              </div>
            </div>
          </div>
          <!-- add more .. -->
        </div>
      </header>
    <div id="page" class="hfeed site">
      <div id="content" class="site-content">

	<!-- #site-navigation -->
	<div class="container-fluid">
		<section class="c-page-content c-page-404">

			<div id="primary" class="content-area">
				<main id="main" class="site-main main-content no-padding">

					<div id="main-content" class="row">

						<div class="col-xs-12">

							<section class="error-404 not-found">
								<div class="row">
									<div class="entry-featured-image col-sm-12 col-md-6">
                      <?php
                          $felis_featured_image = Cactus::getOption('page404_featured_image');

                          if ( $felis_featured_image != '' ) {
                              echo '<div class="c-thumbnail not-found-image"><img src="' . esc_url( $felis_featured_image ) . '" alt="404"/></div>';
                          } else {
                              echo '<div class="c-thumbnail not-found-image"><img src="'. get_template_directory_uri() .'/images/404.png" alt="404"/></div>';
                          }
                      ?>
									</div>
                  <div class="col-sm-12 col-md-6">
                    <div class="c-entry-main">
                    <div class="entry-content">
                        <?php $felis_content = Cactus::getOption('page404_content');

                          if ( $felis_content != '' ) {
                              echo wp_kses_post( $felis_content );
                          } else {
                              ?>
                              <h2><?php echo esc_html_e( 'Oops!', 'felis' ); ?></h2>
                            <p><?php esc_html_e( 'Look like this page doesn\'t exist.', 'felis' ); ?></p>
                            <a href="<?php echo esc_url(home_url( '/' )); ?>" class="c-btn-base change-color button-size-medium button-text-upper bg-gradient"><?php echo esc_html_e( 'Homepage', 'felis' ); ?> <i class="fa fa-long-arrow-right"></i></a>
                          <?php } ?>
                        </div>
                    </div>
                  </div>
                </div>

							</section>

						</div>

              <?php

                  /**
                   * felis_after_main_loop hook
                   *
                   * @hooked felis_output_after_main_loop - 10
                   *
                   * @author
                   * @since 1.0
                   * @code     CactusThemes
                   */
                  do_action('felis_after_main_loop'); ?>

					</div>
					<!-- row -->

				</main>
				<!-- main -->
			</div>
			<!-- primary -->

		</section>
		<!-- #c-page-content -->
	</div>
</div></div></div></div>
	<!--Get Bottom Sidebar-->
  <?php wp_footer(); ?>
</body>
</html>