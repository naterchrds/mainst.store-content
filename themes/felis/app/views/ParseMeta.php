<?php

    /**
     * Class ParseMeta
     *
     * @since Cactus Alpha 1.0
     * @package cactus
     */

    namespace App\Views;

    class ParseMeta
    {
        public function __construct()
        {

        }

        /**
         * Display post title
         *
         * @cactusthemes
         *
         * @since Cactus Alpha 1.0
         * @package cactus
         */
        public function renderPostTitle($tag = 'h3', $link = 1)
        {
            if ($link) {
                the_title(sprintf('<%s class="heading"><a href="%s" title="%s" rel="bookmark">', $tag, esc_url(get_permalink()), get_the_title()), sprintf('</a></%s>', $tag));
            } else {
                the_title(sprintf('<%s class="heading">', $tag), sprintf('</a></%s>', $tag));
            }

        }

        /**
         * Display post meta
         *
         * @cactusthemes
         *
         * @since Cactus Alpha 1.0
         * @package cactus
         */
        public function renderPostMeta($args = array('date', 'author', 'comment_count', 'category'))
        { ?>
					<div class="c-meta">
						<div class="item-meta entry-meta">
							<ul>
                  <?php
                      $cactus_showdate = \App\Cactus::getOption('single_published_date', 'on');
                      if ('post' == get_post_type() && $cactus_showdate == 'on' && in_array('date', $args)) : ?>
												<li class="entry-date">
                            <?php $this->renderPublishDate(); ?>
												</li>
                      <?php endif; ?>

                  <?php

                      $cactus_show_author = \App\Cactus::getOption('single_author', 'on');

                      if ($cactus_show_author == 'on' && in_array('author', $args)): ?>
												<li class="entry-author">
													<div class="item-author">
                              <?php $this->renderAuthorLink( true ); ?>
													</div>
												</li>
                      <?php endif; ?>

                  <?php if ( ! post_password_required() && ( comments_open() && 0 != get_comments_number() ) && in_array('comment_count', $args) ) : ?>
								<li class="entry-comments">
											<span class="comments-link">
												<?php comments_popup_link('', esc_html__('1 Comment', 'felis'), esc_html__('% Comments', 'felis')); ?>
											</span>
								</li>
                  <?php endif; ?><!-- .entry-comments -->

                  <?php

                      $cactus_show_categories = \App\Cactus::getOption('single_categories', 'on');

                      if ($cactus_show_categories == 'on' && in_array('category', $args)) :

                          $categories = get_the_category();

                          if ( ! empty($categories)) { ?>

														<li class="entry-category">
															<div class="c-category">
																<div class="item-category">
                                    <?php $this->renderPostCategory( true ); ?>
																</div>
															</div>
														</li>
                          <?php }
                      endif; ?>
							</ul>
						</div>
					</div>
            <?php
        }

        /**
         * @return string
         *
         * @since Cactus Alpha 1.0
         * @package cactus
         */
        public function renderPostCategory( $echo = 0 )
        {
            $output = '';

            $categories = get_the_category();

            if ( ! empty($categories)) {
                $html_array = array();
                foreach ($categories as $category) {
                    $cat_name = $category->name;
                    $cat_url  = get_category_link($category->term_id);

                    array_push($html_array, '<a href="' . esc_url($cat_url) . '" title="' . esc_html__('View all posts in ', 'felis') . esc_attr($cat_name) . '">' . esc_html($cat_name) . '</a>');
                }

                $output .= implode(', ', $html_array);
            }
			
			if( !$echo ) {
				return $output;
			} else echo wp_kses($output, array('a' => array('href' => array(), 'class' => array(), 'title' => array())));
        }

        /**
         * Author meta tag of current post (in loop)
         *
         * @return string
         */
        function renderAuthorLink( $echo )
        {
            $output = '<a href="' . get_author_posts_url(get_the_author_meta('ID')) . '" class="author-url">' . get_the_author() . '</a>';
			
			if(!$echo)
				return $output;
			else echo wp_kses($output, array('a' => array('href' => array(), 'class' => array())));
        }


        /**
         * Get Publish Date
         *
         * @since Cactus Alpha 1.0
         * @package cactus
         */
        function renderPublishDate()
        {
            $time_string = '<time class="published" datetime="%1$s">%2$s</time>';

            $time_string = sprintf($time_string,
                esc_attr(get_the_date('c')),
                esc_html(get_the_date()),
                esc_attr(get_the_modified_date('c')),
                esc_html(get_the_modified_date())
            );
            printf('<span class="posted-on"> %1$s</span>',
                sprintf('<a href="%1$s" rel="bookmark">%2$s</a>',
                    esc_url(get_permalink()),
                    $time_string
                )
            );
        }
    }