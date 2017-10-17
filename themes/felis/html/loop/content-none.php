<?php
  /**
   * The template part for displaying a message that posts cannot be found.
   *
   * Learn more: http://codex.wordpress.org/Template_Hierarchy
   *
   * @package bonsai
   */
?>

<section class="no-results not-found">
  <!-- .page-header -->

  <div class="page-content">

    <h2 class="page-title"><?php _e('Nothing Found', 'felis'); ?></h2>

    <?php if (is_home() && current_user_can('publish_posts')) : ?>

      <p><?php printf(esc_html__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'felis'), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

    <?php elseif (is_search()) : ?>

      <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'felis'); ?></p>
      <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <label>
          <span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'felis' ); ?></span>
          <input type="search" class="search-field content-none-input" placeholder="<?php esc_html_e( 'Search ...', 'felis' ); ?>" value="" name="s" style="">
        </label>
        <input type="submit" class="search-submit search-content-none c-btn-base change-color button-size-small button-text-upper bg-gradient" value="<?php esc_html_e( 'Search', 'felis' ); ?>">
      </form>

    <?php else : ?>

      <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'felis'); ?></p>
       <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <label>
          <span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'felis' ); ?></span>
          <input type="search" class="search-field content-none-input" placeholder="<?php esc_html_e( 'Search ...', 'felis' ); ?>" value="" name="s" style="">
        </label>
        <input type="submit" class="search-submit search-content-none c-btn-base change-color button-size-small button-text-upper bg-gradient" value="<?php esc_html_e( 'Search', 'felis' ); ?>">
      </form>

    <?php endif; ?>
  </div>
  <!-- .page-content -->
</section><!-- .no-results -->
