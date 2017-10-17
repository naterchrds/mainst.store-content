<?php

    namespace App\Plugins\Widgets;

    use App\Views;
    use App\Models\Database;
    use App\Cactus;

    class Posts extends \WP_Widget
    {
        function __construct()
        {
            $options = array(
                'classname'   => 'c-w-posts',
                'description' => esc_html__('Show Posts', 'felis')
				
            );
            parent::__construct('c-w-posts', esc_html__('Felis - Posts', 'felis'), $options);
        }

        function form($instance) {
            $default_value = array(
            	'title' => esc_html__( 'Felis - Posts', 'felis' ),
				'number_of_posts' => '3',
				'order_by' => 'date',
				'order' => 'ASC',
            	'category' => '',
            	'tags' => '',
            	'post_ids' => '',
            );

            $instance = wp_parse_args( ( array )$instance, $default_value );

            $title = esc_attr($instance['title']);
            $category = esc_attr($instance['category']);
            $tags = esc_attr($instance['tags']);
            $post_ids = esc_attr($instance['post_ids']);
            $number_of_posts = esc_attr($instance['number_of_posts']);
            $order = esc_attr($instance['order']);
            $order_by = esc_attr($instance['order_by']);

            // Create form
            $html = '';

            $html .= '<p>';
            $html .= '<label>' . esc_html__('Title', 'felis') . ': </label>';
            $html .= '<input class="widefat" type="text" name="' . $this->get_field_name('title') . '" value="' . $title . '"/>';
            $html .= '</p>';
			
			$html .= '<p>';
            $html .= '<label>' . esc_html__('Number of posts', 'felis') . ': </label>';
            $html .= '<input class="widefat" type="text" name="' . $this->get_field_name('number_of_posts') . '" value="' . $number_of_posts . '"/>';
            $html .= '</p>';
			
			$date   = $order_by == 'date' ? 'selected="selected"' : '';
            $rand   = $order_by == 'rand' ? 'selected="selected"' : '';
            $comment_count  = $order_by == 'comment_count' ? 'selected="selected"' : '';
            $html .= '<p><label>' . esc_html__('Choose how to query posts', 'felis') . ': </label></p>';
            $html .= '<p>';
            $html .= '<select name="' . $this->get_field_name('order_by') . '">
						<option value="date"' . $date . '>' . esc_html__('Latest Posts', 'felis') . '</option>
						<option value="rand"' . $rand . '>' . esc_html__('Random Posts', 'felis') . '</option>
						<option value="comment_count"' . $comment_count . '>' . esc_html__('Most Commented', 'felis') . '</option>
					</select>';
            $html .= '</p>';
			
			$ASC   = $order == 'ASC' ? 'selected="selected"' : '';
            $DESC  = $order == 'DESC' ? 'selected="selected"' : '';
            $html .= '<p><label>' . esc_html__('Choose order of posts', 'felis') . ': </label></p>';
            $html .= '<p>';
            $html .= '<select name="' . $this->get_field_name('order') . '">
						<option value="ASC"' . $ASC . '>' . esc_html__('ASC', 'felis') . '</option>
						<option value="DESC"' . $DESC . '>' . esc_html__('DESC', 'felis') . '</option>
					</select>';
            $html .= '</p>';
			
            $html .= '<p>';
            $html .= '<label>' . esc_html__('Category - Category ID or Slug', 'felis') . ': </label>';
            $html .= '<input class="widefat" type="text" name="' . $this->get_field_name('category') . '" value="' . $category . '"/>';
            $html .= '</p>';

            $html .= '<p>';
            $html .= '<label>' . esc_html__('Tags - Tag List', 'felis') . ': </label>';
            $html .= '<input class="widefat" type="text" name="' . $this->get_field_name('tags') . '" value="' . $tags . '"/>';
            $html .= '</p>';

            $html .= '<p>';
            $html .= '<label>' . esc_html__('Post IDs - If this param is used, other params are ignored', 'felis') . ' </label>';
            $html .= '<input class="widefat" type="text" name="' . $this->get_field_name('post_ids') . '" value="' . $post_ids . '"/>';
            $html .= '</p>';

            echo $html;
        }

        function update($new_instance, $old_instance) {
            $instance = $old_instance;

            $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
            $instance[ 'number_of_posts' ] = strip_tags( $new_instance[ 'number_of_posts' ] );
            $instance[ 'order_by' ] = strip_tags( $new_instance[ 'order_by' ] );
            $instance[ 'order' ] = strip_tags( $new_instance[ 'order' ] );
            $instance[ 'category' ] = strip_tags( $new_instance[ 'category' ] );
            $instance[ 'tags' ] = strip_tags( $new_instance[ 'tags' ] );
            $instance[ 'post_ids' ] = strip_tags( $new_instance[ 'post_ids' ] );

            return $instance;
        }

        function widget($args, $instance) {
            $direction = '';
            if ( is_rtl() ) {
                $direction = 'dir="ltr"';
            }
			
			$lazyload = 'off';
			if(function_exists('ot_get_option')){
				$lazyload = ot_get_option('lazyload', 'off');
			}

            extract($args);
			
            $title = isset( $instance[ 'title' ] ) && $instance[ 'title' ] != '' ? $instance[ 'title' ] : '';
            $number_of_posts = isset( $instance[ 'number_of_posts' ] ) && $instance[ 'number_of_posts' ] != '' ? $instance[ 'number_of_posts' ] : '3';
            $order_by = isset( $instance[ 'order_by' ] ) && $instance[ 'order_by' ] != '' ? $instance[ 'order_by' ] : 'date';
            $order = isset( $instance[ 'order' ] ) && $instance[ 'order' ] != '' ? $instance[ 'order' ] : 'ASC';
            $cats = isset( $instance[ 'category' ] ) && $instance[ 'category' ] != '' ? $instance[ 'category' ] : '';
            $tags = isset( $instance[ 'tags' ] ) && $instance[ 'tags' ] != '' ? $instance[ 'tags' ] : '';
            $post_ids = isset( $instance[ 'post_ids' ] ) && $instance[ 'post_ids' ] != '' ? $instance[ 'post_ids' ] : '';
			
			$custom_wg_wrap_class = 'c-w-latest-posts';
			$content_text_class = '';
			$figure_class = 'c-thumbnail';
			$heading_tag_open = '<h6 class="heading">';
			$heading_tag_close = '</h6>';
			
			$custom_wg_wrap_class = 'c-w-latest-posts';
			$thumb_size = array(110,110);
			$figure_class = 'c-thumbnail';
			$heading_tag_open = '<h6 class="heading">';
			$heading_tag_close = '</h6>';
			


			//add extra class to Before Widget
			if( strpos($before_widget, 'class') === false ) {
				$before_widget = str_replace('>', 'class="'. $custom_wg_wrap_class . '">', $before_widget);
			}
			else {
				$before_widget = str_replace('class="', 'class="'. $custom_wg_wrap_class . ' ', $before_widget);
			}

            $the_query = Database::getPosts($number_of_posts, $order, 1, $order_by, array('categories' => $cats, 'tags' => $tags, 'ids' => $post_ids));

            $html = $before_widget;

            if ($title != '') {
				$html .= $args['before_title'];
				$widget_title_tag = apply_filters('widget_title_tag', 'div', $instance, $this->id_base);
				$html .= apply_filters('widget_title', $title, $instance, $this->id_base);
				$html .= $args['after_title'];
			}

            $html .= '<ul class="block-group">';

            if ($the_query->have_posts()) {

                while ($the_query->have_posts()) {

                    $html .= '<li class="block">';

                    $the_query->the_post();

                    $postid = get_the_ID();
					
					if (!has_post_thumbnail($postid)) {
						$content_text_class = 'no-thumb';
					}else{
						$content_text_class = '';
					}
					
					$html .= '<div class="block-left">';
					
					

                    if (has_post_thumbnail($postid)) {
						

                        $thumbnail = new Views\parseThumbnail();

                        $html .= '<figure class="'.$figure_class.'">
                                    <a title="' . get_the_title() . '" href="' . get_permalink() . '">' . $thumbnail->render($thumb_size) . '</a>
                                  </figure>';
						
                    }
					
					$html .= '</div>';
					
				
					$html .= '<div class="block-right '.$content_text_class.'">';


                    $html .= '<div class="c-title">
                              	<div class="item-title">
									'.$heading_tag_open.'
                                  		<a href="' . get_permalink() . '" title="'. get_the_title() .'">'.get_the_title().'</a>
									'.$heading_tag_close.'	
                                </div>
							  </div>';
					
					$html .= '<div class="c-date">
                            <div class="item-date">
                                <p><a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" title="' . get_the_author() . '">' . esc_html__( 'By ', 'felis' ) . get_the_author() . '</a></p>
                            </div>
                          </div>';
  
					

                    $html .= '</li>';
                }

                wp_reset_postdata();
            }

            $html .= '</ul>';

            $html .= $after_widget;
			
			echo $html;
        }
    }

    add_action('widgets_init', create_function('', 'return register_widget("App\Plugins\Widgets\Posts");'));