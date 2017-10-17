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
				<?php
					preg_match("/<embed\s+(.+?)>/i", $post->post_content, $matches_emb); if(isset($matches_emb[0])){ echo $matches_emb[0];}
					preg_match("/<source\s+(.+?)>/i", $post->post_content, $matches_sou) ;
					preg_match('/\<object(.*)\<\/object\>/is', $post->post_content, $matches_oj);
					preg_match('/<iframe.*src=\"(.*)\".*><\/iframe>/isU', $post->post_content, $matches);
					preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $post->post_content, $match);

					if(!isset($matches_emb[0]) && isset($matches_sou[0])){
					  echo $matches_sou[0];
					}else if(!isset($matches_sou[0]) && isset($matches_oj[0])){
					  echo $matches_oj[0];
					}else if( !isset($matches_oj[0]) && isset($matches[0])){
					  echo $matches[0];
					}else if( !isset($matches[0]) && isset($match[0])){
					  foreach ($match as $matc) {
						  if(isset($matc[0])){
							if(wp_oembed_get($matc[0])){
								echo '<div class="c-entry-audio">'.wp_oembed_get($matc[0]).'</div>';
							}
						  }
					  }
					}
				?>
				<div class="c-meta">
					<div class="item-meta entry-meta">
						<ul>
							<li class="entry-category">
								<?php $cactus_postMeta->renderPostCategory( true ); ?>
							</li>
							<li class="entry-date">
								<?php $cactus_postMeta->renderPublishDate(); ?>
							</li>
						</ul>
						 
						 
					</div>
				</div>
				<div class="c-maintitle">
					<h1><?php the_title(); ?></h1>
				</div>
				<div class="c-subtitle">
					<h2><?php echo esc_html( $subtitle ); ?></h2>
				</div>
				<?php get_template_part( 'html/single/content', 'social-share' ); ?>
			</header>
		</div>
		<div class="col-xs-12 ">
            <div class="entry-content">
                <div class="item-content">
                    <?php 
                    $content =  preg_replace ('#<embed(.*?)>(.*)#is', ' ', get_the_content());
					$content =  preg_replace ('@<iframe[^>]*?>.*?</iframe>@siu', ' ', $content);
					preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $content, $match);
					foreach ($match[0] as $amatch) {
						if(strpos($amatch,'soundcloud.com') !== false){
							$content = str_replace($amatch, '', $content);
						}
					}
					$content = preg_replace('%<object.+?</object>%is', '', $content);

					echo apply_filters('the_content',$content);
                    ?>
                </div>
                <div class="item-tags">
                    <?php the_tags( '<h5>' . esc_html__( 'Tags: ', 'felis' ) . '</h5><ul class="list-inline"><li>', '</li> <li>', '</li></ul>' ); ?>
                </div>
					<?php get_template_part( 'html/single/content', 'social-share' ); ?>
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