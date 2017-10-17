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
use App\Cactus;

$current_user = wp_get_current_user();

$cactus_header_layout = Cactus::getOption( 'header_style', 1 );
$header_icon_color = Cactus::getOption( 'header_icon_color', '' );
$social_left = Cactus::getOption( 'social_left', 'on' );
?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="wrap">
										<div class="c-mini_cart_bottom">
									<?php felis_cart_link(); ?>
								</div>
		<?php 
		if ( $social_left == 'on' ){
			$social_text_schema = Cactus::getOption( 'social_text_schema', 'dark' );
			$social_position = Cactus::getOption( 'social_position', 'fixed' );
			felis_social_left( $social_text_schema, $social_position ); 
		}
		
		?>
		<div class="body_wrap">
			<header class="site-header style-<?php echo esc_attr( $cactus_header_layout ); ?> <?php echo esc_attr( $header_icon_color ); ?>">
				<div class="header_inner">
					<div class="main__menu">
						<div class="main-navigation">
							<!-- menu -->
							<div class="wrap_branding">
								<div class="wrap_branding__inner">
									<?php felis_get_logo(); ?>
								</div>
							</div>
							<div class="main-menu">
								<?php
									if ( has_nav_menu('primary_menu') ) {

										wp_nav_menu(array(
											'theme_location' => 'primary_menu',
											'container'      => false,
											'menu_class'     => 'nav navbar-nav main-navbar',
											'walker'         => new App\Plugins\Walker_Nav_Menu\Custom_Walker_Nav_Menu()
											));

									}
								?>
							</div>	
							<div class="search-navigation">
                                        <div class="search-navigation__wrap">
                                            <ul class="main-menu-search nav-menu">
                                                <li class="menu-search">
                                                    <a title="<?php echo esc_attr_e( 'Open Search', 'felis' ); ?>" href="javascript:;" class="open-search-main-menu">Search Products
                                                        <i class="ion-ios-search-strong"></i>
                                                        <i class="ion-android-close"></i>
                                                    </a>
                                                    <ul class="search-main-menu">
                                                        <li>
                                                            <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
                                                                <input required class="search-val" type="text" placeholder="<?php echo esc_attr_e( 'Enter your keywords', 'felis' ); ?>" name="s" value="<?php echo esc_attr( get_search_query() ); ?>"> <i class="ion-ios-search-strong"></i>
                                                                <input class="btn-search" type="submit" value="<?php echo esc_attr_e( 'Search', 'felis' ); ?>">
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>	


							<div class="left-header">
								<div class="c-mini_cart">
									<?php felis_cart_link(); ?>
								</div>
								<div class="left-header__inner">
									
									<?php if ( class_exists( 'WooCommerce' ) ) : 
										global $woocommerce;
										$myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
									?>
									
									<div class="c-account">	
										<?php if ( $myaccount_page_id ) : 
										$myaccount_page_url = get_permalink( $myaccount_page_id );
									?>	
										<p class="left-header-account-name">
										<?php
	
										printf(
										__( '%1$s <a href="%2$s">Log out</a>', 'woocommerce' ),
											'<strong>' . esc_html( $current_user->user_email) . '</strong>',
												esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) )
												);
										?>
											
										</p>

										<a title="<?php 
										echo esc_attr_e( 'Your account', 'felis' ); 
										?>"  href="<?php echo esc_url( $myaccount_page_url ); ?>" class="btn"><?php esc_html_e( 'Account', 'felis' )  ?></a>


									</div>
									<?php endif; ?>
									<?php endif; ?>
									<div class="c-togle__menu">
										<button type="button" class="menu_icon__open">
											<span></span>
											<span></span>
											<span></span>
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- add more .. -->
				</div>
				<div class="mobile-menu menu-collapse off-canvas">
					<div class="close-nav">
						<button class="menu_icon__close">
							<span></span>
							<span></span>
						</button>
					</div>
					<div class="search-mobile">
						<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
                            <input required class="search-val" type="text" placeholder="" name="s" value="<?php echo esc_attr( get_search_query() ); ?>"> <i class="ion-ios-search-strong"></i>
                            <input class="btn-search" type="submit" value="<?php echo esc_attr_e( 'Search', 'felis' ); ?>">
                        </form>
					</div>
					<nav class="off-menu">
					<?php
					if ( has_nav_menu('mobile_menu') ) {

						wp_nav_menu(array(
							'theme_location' => 'mobile_menu',
							'container'      => false,
							'menu_class'     => 'nav navbar-nav main-navbar',
							'walker'         => new App\Plugins\Walker_Nav_Menu\Custom_Walker_Nav_Menu()
							));

					}
					?>
					</nav>
					<div class="bottom-canvas">
						<?php if ( class_exists( 'WooCommerce' ) ) : 
							global $woocommerce;
							$myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
						?>

						<div class="c-mini_cart">
							<?php felis_cart_link(); ?>
						</div>
						<?php if ( $myaccount_page_id ) : 
							$myaccount_page_url = get_permalink( $myaccount_page_id );
						?>
						<div class="c-account">
							<a title="<?php echo esc_attr_e( 'Your Account', 'felis' ); ?>"  href="<?php echo esc_url( $myaccount_page_url ); ?>"><i class="ion-android-person"></i></a>
						</div>
						<?php endif; ?>
						<?php endif; ?>
					</div>
				</div>
		</header>
		<div id="page" class="hfeed site">
			<div id="content" class="site-content">
				<?php do_action( 'felis_page_header', $cactus_header_layout ); ?>