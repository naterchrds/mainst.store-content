<?php

    /**
     * ParsePostNavigation Class
     */

    namespace App\Views;

    class ParsePostNavigation
    {
        public function __construct()
        {

        }

        public function render( $echo = 1 ) {

            $prevPost = get_previous_post();
            $nextPost = get_next_post();


            if ( ! $nextPost && ! $prevPost ) {
                return;
            } else {
                if ( $prevPost ) {
                    $prevthumbnail = get_the_post_thumbnail( $prevPost->ID, array( 86,86 ), array( 'class' => 'img-responsive' ) );
                }
            }
            
            ?>
					
            <div class="c-post-navigation">
				<nav class="navigation post-navigation">
					<div class="nav-links">
                        <?php  if ( $prevPost ) :
                            $prevthumbnail = get_the_post_thumbnail( $prevPost->ID, array( 86,86 ), array( 'class' => 'img-responsive' ) );
                        ?>
                        <div class="col-xs-12 col-sm-6 no-gutter">
                            <div class="nav-previous">
                                <div class="nav-img">
                                    <?php previous_post_link( '%link', $prevthumbnail ) ?>
                                </div>
                                <div class="nav-content">
                                    <span class="meta-nav"><?php esc_html_e( 'Prev Post', 'felis' ); ?><i class="ion-ios-arrow-thin-left"></i> </span>
                                    <?php previous_post_link( '%link', '%title' ) ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php  if ( $nextPost ) :
                            $nextthumbnail = get_the_post_thumbnail( $nextPost->ID, array( 86,86 ), array( 'class' => 'img-responsive' ) );
                        ?>
                        <div class="col-xs-12 col-sm-6 no-gutter">
                            <div class="nav-next">
                                <div class="nav-img">
                                    <?php next_post_link( '%link', $nextthumbnail ) ?>
                                </div>
                                <div class="nav-content">
                                    <span class="meta-nav"><?php esc_html_e( 'Next Post', 'felis' ); ?><i class="ion-ios-arrow-thin-right"></i> </span>
                                    <?php next_post_link( '%link', '%title' ) ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
					</div>
					<!-- .nav-links -->
				</nav>
            </div>
            <?php
        }
    }