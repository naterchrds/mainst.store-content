<?php
/**
 * @package cactus
 */
$getSocialShare = new App\Views\ParseSocials();

$felis_social_share = $getSocialShare->renderSocialShare( get_the_ID(), false ); 

if ( $felis_social_share != '' ) : 
?>

<div class="c-post-share">
	<div class="row">
		<div class="col-xs-12 ">
			<div class="block">
          	   <?php echo wp_kses( $felis_social_share, array(
    'ul' => array( 'class' => array() ),
    'li' => array( 'class' => array() ),
    'a' => array(
        'href' => array(),
        'title' => array(),
        'rel' => array(),
        'onclick' => array(),
        'target' => array(),
    ),
    'i'=> array( 'class' => array() )
    ) ); ?>
			</div>
		</div>
	</div>
</div>
<?php 
endif;