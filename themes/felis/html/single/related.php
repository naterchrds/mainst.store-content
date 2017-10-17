<?php
    /**
     * The Template for displaying all related posts by Category & tag.
     *
     * @package cactus
     */
?>
<?php

    use App\Cactus;
    use App\Models\Database;

    $cactus_show_related_post = Cactus::getOption('show_related_post', 'on');

    if ($cactus_show_related_post == 'off') {
        return;
    }

    $cactus_related_items = Database::getRelatedPosts(get_the_ID());

    if ( ! $cactus_related_items->have_posts()) {
        return;
    }

?>

<div class="related-posts">
	<div class="row">

		<div class="heading-group">
			<div class="col-xs-12 ">
				<div class="item-heading">
					<h4 class="heading"><?php esc_html_e('Related Posts', 'felis');?></h4>
				</div>
			</div>
		</div>
		
		<div class="block-group">
    
        <?php

            while ( $cactus_related_items->have_posts() ) : $cactus_related_items->the_post();
            
                get_template_part('html/single/content', 'related');

            endwhile;
        ?>
		
		</div>
    </div>
</div>
<?php
    wp_reset_postdata();