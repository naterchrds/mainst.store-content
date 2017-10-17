<?php

use App\Views\CactusView;


?>

<div class="c-post-author">
	<div class="post-author__wrap">
		<div class="c-avatar">
			<div class="item-avatar">
				<?php CactusView::render('AuthorAvatar'); ?>
			</div>
		</div>
		<div class="c-information">
			<div class="c-name">
				<h4 class="heading">
					<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a>
				</h4>
			</div>
			<div class="c-summary">
				<div class="item-summary">
					<p><?php the_author_meta('description'); ?></p>
				</div>
			</div>
		</div>
	</div>
</div>
<!--!author-->
<?php
