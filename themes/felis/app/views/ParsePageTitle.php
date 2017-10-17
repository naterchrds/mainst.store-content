<?php

    /**
     * Class ParsePageTitle
     *
     * @since Cactus Alpha 1.0
     * @package cactus
     */

    namespace App\Views;
    
    use App\Cactus;

    class ParsePageTitle {

        public function __construct() {

        }

        public function render( $echo = 1, $auto_h = 1 ) {
            global $post;

            $title = '';

            $text['home']         =  get_bloginfo( 'name' );
            $text['category']     =  esc_html__( 'Category:', 'felis') . ' "%s"';
            $text['search']       =  esc_html__( 'Search', 'felis');
            $text['tag']          =  esc_html__( 'Tag:', 'felis') . ' "%s"';
            $text['author']       =  esc_html__( 'Author:', 'felis') . ' %s';
            $text['404']          =  Cactus::getOption( 'page404_title', esc_html__( 'Page not found', 'felis' ) );

            $parent_id = $parent_id_2 = ( $post ) ? $post->post_parent : 0;

            if ( is_front_page() ) {

                $title = $text['home'];

            } elseif ( is_home() ) {

                $title = Cactus::getOption( 'blog_heading', esc_html__('Blog', 'felis' ) );
            } else {

                if ( is_category() ) {
                    $title = sprintf( $text['category'], single_cat_title( '', false ) );

                } elseif (is_search()) {
                    $title = sprintf($text['search'], get_search_query());

                } elseif (is_day()) {
                    $title = esc_html__("Archives for ", 'felis') . date_i18n(get_option('date_format'), strtotime(get_the_date()));

                } elseif (is_month()) {
                    $title = esc_html__("Archives for ", 'felis') . get_the_date('F, Y');

                } elseif (is_year()) {
                    $title = esc_html__("Archives for ", 'felis') . get_the_date('Y');

                } elseif (is_single() && ! is_attachment()) {
                    if (get_post_type() != 'post') {

                        $post_type    = get_post_type_object(get_post_type());
                        $slug         = $post_type->rewrite;
                        $title = $slug['slug'] ? $slug['slug'] : $post_type->labels->singular_name;

                    } else {
                        $title = get_the_title();
                    }

                } elseif (is_tag()) {
                    $title = sprintf($text['tag'], single_tag_title('', false));

                } elseif (is_tax()) {
                    $term         = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                    $title = $term->name;

                } elseif ( ! is_single() && ! is_page() && get_post_type() != 'post' && ! is_404() && ! is_tag()) {

                    $post_type    = get_post_type_object(get_post_type());
                    $slug         = $post_type->rewrite;
                    $title = ( $slug['slug'] ? $slug['slug'] : $post_type->labels->singular_name );

                } elseif (is_attachment()) {
                    if ($parent = get_post($parent_id)) {
                        $title = printf(get_permalink($parent), $parent->post_title);

                    } else {
                        $title = get_the_title();
                    }

                } elseif (is_page()) {
                    $title = get_the_title();

                } elseif (is_author()) {
                    global $author;
                    $userdata     = get_userdata($author);
                    $title = sprintf($text['author'], $userdata->display_name);

                } elseif (is_404()) {
                    $title = $text['404'];
                }
            }

            $title = apply_filters('cactus_page_title', $title );
            
            if( $echo ){
                echo esc_html($title);
            } else {
                return $title;
            }
        }
    }
