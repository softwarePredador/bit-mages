<?php
/**
 * Custom template tags for this theme
 *
 * @package BitMages
 */

if (!function_exists('bitmages_posted_on')) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function bitmages_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf($time_string,
            esc_attr(get_the_date(DATE_W3C)),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date(DATE_W3C)),
            esc_html(get_the_modified_date())
        );

        $posted_on = sprintf(
            /* translators: %s: post date. */
            esc_html_x('Publicado em %s', 'post date', 'bitmages'),
            '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
        );

        echo '<span class="posted-on">' . $posted_on . '</span>';
    }
endif;

if (!function_exists('bitmages_posted_by')) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function bitmages_posted_by() {
        $byline = sprintf(
            /* translators: %s: post author. */
            esc_html_x('por %s', 'post author', 'bitmages'),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );

        echo '<span class="byline"> ' . $byline . '</span>';
    }
endif;

if (!function_exists('bitmages_entry_footer')) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function bitmages_entry_footer() {
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(esc_html__(', ', 'bitmages'));
            if ($categories_list) {
                /* translators: 1: list of categories. */
                printf('<span class="cat-links">' . esc_html__('Categorias: %1$s', 'bitmages') . '</span>', $categories_list);
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'bitmages'));
            if ($tags_list) {
                /* translators: 1: list of tags. */
                printf('<span class="tags-links">' . esc_html__('Tags: %1$s', 'bitmages') . '</span>', $tags_list);
            }
        }

        if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
            echo '<span class="comments-link">';
            comments_popup_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: post title */
                        __('Deixe um comentário<span class="screen-reader-text"> em %s</span>', 'bitmages'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post(get_the_title())
                )
            );
            echo '</span>';
        }
    }
endif;

if (!function_exists('bitmages_post_thumbnail')) :
    /**
     * Displays an optional post thumbnail.
     */
    function bitmages_post_thumbnail() {
        if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
            return;
        }

        if (is_singular()) :
            ?>
            <div class="post-thumbnail">
                <?php the_post_thumbnail(); ?>
            </div><!-- .post-thumbnail -->
        <?php else : ?>
            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                <?php
                the_post_thumbnail('post-thumbnail', array(
                    'alt' => the_title_attribute(array(
                        'echo' => false,
                    )),
                ));
                ?>
            </a>
        <?php
        endif; // End is_singular().
    }
endif;

if (!function_exists('bitmages_get_reading_time')) :
    /**
     * Calculate reading time
     */
    function bitmages_get_reading_time() {
        $content = get_post_field('post_content', get_the_ID());
        $word_count = str_word_count(strip_tags($content));
        $reading_time = ceil($word_count / 200); // Assuming 200 words per minute

        if ($reading_time == 1) {
            $timer = __('1 minuto', 'bitmages');
        } else {
            $timer = sprintf(__('%s minutos', 'bitmages'), $reading_time);
        }

        return $timer;
    }
endif;

if (!function_exists('bitmages_categorized_blog')) :
    /**
     * Returns true if a blog has more than 1 category.
     */
    function bitmages_categorized_blog() {
        $all_the_cool_cats = get_transient('bitmages_categories');
        if (false === $all_the_cool_cats) {
            // Create an array of all the categories that are attached to posts.
            $all_the_cool_cats = get_categories(array(
                'fields' => 'ids',
                'hide_empty' => 1,
                'number' => 2,
            ));

            // Count the number of categories that are attached to the posts.
            $all_the_cool_cats = count($all_the_cool_cats);

            set_transient('bitmages_categories', $all_the_cool_cats);
        }

        if ($all_the_cool_cats > 1) {
            // This blog has more than 1 category so bitmages_categorized_blog should return true.
            return true;
        } else {
            // This blog has only 1 category so bitmages_categorized_blog should return false.
            return false;
        }
    }
endif;

/**
 * Flush out the transients used in bitmages_categorized_blog.
 */
function bitmages_category_transient_flusher() {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    delete_transient('bitmages_categories');
}
add_action('edit_category', 'bitmages_category_transient_flusher');
add_action('save_post', 'bitmages_category_transient_flusher');

/**
 * Display navigation to next/previous post when applicable.
 */
function bitmages_post_navigation() {
    // Don't print empty markup if there's nowhere to navigate.
    $previous = (is_attachment()) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
    $next = get_adjacent_post(false, '', false);

    if (!$next && !$previous) {
        return;
    }
    ?>
    <nav class="navigation post-navigation" role="navigation">
        <h2 class="screen-reader-text"><?php esc_html_e('Navegação de Post', 'bitmages'); ?></h2>
        <div class="nav-links">
            <?php
            if ($previous) {
                previous_post_link('<div class="nav-previous">%link</div>', '%title');
            }

            if ($next) {
                next_post_link('<div class="nav-next">%link</div>', '%title');
            }
            ?>
        </div><!-- .nav-links -->
    </nav><!-- .navigation -->
    <?php
}