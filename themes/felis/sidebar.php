<?php
    /**
     * The Sidebar containing the main widget areas.
     *
     * @package cactus
     */

    $sidebar = felis_get_theme_sidebar_setting();

    if ($sidebar != 'hidden') {
        ?>
<section id="c-sidebar" class="c-sidebar">
	<div id="main-sidebar" class="main-sidebar" role="complementary">
        <?php
			if (is_active_sidebar('main_sidebar')) {
				dynamic_sidebar('main_sidebar');
			}
		?>
	</div>
</section>
<?php
	}
