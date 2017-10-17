<?php
/**
 * Template Tags hold functions to print out HTML
 *
 * @package cactus
 */
use App\Cactus;

/**
 * Get Thumbnail Image
 *
 * @return string - Image IMG tag
 */
if ( !function_exists( 'felis_thumbnail' ) ) {
    function felis_thumbnail($size = array(), $post_id = -1, $source_sizes = ''){
        $thumbnail = new App\Views\ParseThumbnail();
        return $thumbnail->render($size);
    }
}

/**
 * Echo meta data tags
 */
function felis_meta_tags(){
	App\Views\ParseHead::meta_tags();
}

function felis_get_logo( $echo = true, $main_logo_only = false ){
    $html = '<a class="logo" href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name')) . '">';

    $default_logo_url = get_parent_theme_file_uri( '/images/logo.png');


    $logo = Cactus::getOption('logo_image', '') == '' ? esc_url($default_logo_url) : Cactus::getOption('logo_image', '');

    $html .= '<img class="for-original" src="' . esc_url($logo) . '" alt="' . esc_attr(get_bloginfo('name')) . '"/>';
    $logo_sticky = Cactus::getOption('sticky_logo', '') == '' ? $logo : Cactus::getOption('sticky_logo', '');

    if($main_logo_only == false){
        $html .= '<img class="for-sticky" src="' . esc_url($logo_sticky) . '" alt="' . esc_attr(get_bloginfo('name')) . '"/>';
    }
    
    $html .= '</a>';

    if($echo) echo $html;

    else return $html;
}

function felis_social_left( $schema = 'dark', $position = 'fixed' ) {
    global $post;
    if ( is_singular( 'post' ) || is_404() || is_search() ) {
        return;
    }
    $getSocialShare = new App\Views\ParseSocials();
    $felis_social_share = $getSocialShare->renderSocialShare( $post->ID, true, 2, $schema, $position );
    if ( $felis_social_share ) {
        $felis_social_share;
    }
}


function felis_cart_link() {
    global $woocommerce;
    $cart_url = $woocommerce->cart->get_cart_url();
    $count = WC()->cart->get_cart_contents_count();
    ?>
    <a class="cart-contents" href="<?php echo esc_url( $cart_url ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'felis' ); ?>">
        <i class="ion-ios-cart"></i>
        <?php if ( $count != 0 ) : ?>
        <span class="cart-count"><?php echo esc_html( $count ); ?></span>
        <?php endif; ?>
    </a>

    <?php
}
