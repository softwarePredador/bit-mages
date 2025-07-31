<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package BitMages
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function bitmages_body_classes($classes) {
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }

    // Add class for page slug
    if (is_page()) {
        $classes[] = 'page-' . $post->post_name;
    }

    // Add class for dark theme
    $classes[] = 'dark-theme';

    return $classes;
}
add_filter('body_class', 'bitmages_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function bitmages_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'bitmages_pingback_header');

/**
 * Changes the default comment form fields
 */
function bitmages_comment_form_fields($fields) {
    $commenter = wp_get_current_commenter();
    $req = get_option('require_name_email');
    $aria_req = ($req ? " aria-required='true'" : '');

    $fields['author'] = '<div class="form-group"><input id="author" name="author" type="text" placeholder="' . esc_attr__('Seu Nome *', 'bitmages') . '" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></div>';

    $fields['email'] = '<div class="form-group"><input id="email" name="email" type="email" placeholder="' . esc_attr__('Seu Email *', 'bitmages') . '" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></div>';

    $fields['url'] = '<div class="form-group"><input id="url" name="url" type="url" placeholder="' . esc_attr__('Seu Website', 'bitmages') . '" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /></div>';

    return $fields;
}
add_filter('comment_form_default_fields', 'bitmages_comment_form_fields');

/**
 * Changes the default comment form
 */
function bitmages_comment_form($args) {
    $args['comment_field'] = '<div class="form-group"><textarea id="comment" name="comment" cols="45" rows="8" placeholder="' . esc_attr__('Seu Comentário *', 'bitmages') . '" aria-required="true"></textarea></div>';
    $args['class_submit'] = 'btn-primary';
    $args['label_submit'] = __('Enviar Comentário', 'bitmages');

    return $args;
}
add_filter('comment_form_defaults', 'bitmages_comment_form');

/**
 * Custom Login Logo
 */
function bitmages_login_logo() {
    $custom_logo_id = get_theme_mod('custom_logo');
    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
    
    if (has_custom_logo()) {
        ?>
        <style type="text/css">
            #login h1 a, .login h1 a {
                background-image: url(<?php echo esc_url($logo[0]); ?>);
                height: 80px;
                width: 320px;
                background-size: contain;
                background-repeat: no-repeat;
                padding-bottom: 10px;
            }
            body.login {
                background-color: var(--dark-bg);
            }
            .login #backtoblog a, .login #nav a {
                color: var(--primary-color) !important;
            }
            .login form {
                background: var(--dark-bg-secondary);
                border: 1px solid var(--border-color);
            }
            .login label {
                color: var(--text-light);
            }
        </style>
        <?php
    }
}
add_action('login_enqueue_scripts', 'bitmages_login_logo');

/**
 * Custom Login Logo URL
 */
function bitmages_login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'bitmages_login_logo_url');

/**
 * Custom Login Logo URL Title
 */
function bitmages_login_logo_url_title() {
    return get_bloginfo('name');
}
add_filter('login_headertext', 'bitmages_login_logo_url_title');

/**
 * Disable WordPress Admin Bar for all users
 */
function bitmages_disable_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}
add_action('after_setup_theme', 'bitmages_disable_admin_bar');

/**
 * Custom excerpt length for different contexts
 */
function bitmages_custom_excerpt_length($length) {
    if (is_home() || is_archive()) {
        return 20;
    } else {
        return 40;
    }
}
add_filter('excerpt_length', 'bitmages_custom_excerpt_length');

/**
 * Filter the "read more" excerpt string link to the post.
 */
function bitmages_excerpt_more($more) {
    if (!is_single()) {
        $more = sprintf('... <a class="read-more" href="%1$s">%2$s <i class="fas fa-arrow-right"></i></a>',
            get_permalink(get_the_ID()),
            __('Ler mais', 'bitmages')
        );
    }
    return $more;
}
add_filter('excerpt_more', 'bitmages_excerpt_more');

/**
 * Add custom image sizes to media library
 */
function bitmages_custom_image_sizes($sizes) {
    return array_merge($sizes, array(
        'bitmages-hero' => __('Hero Image', 'bitmages'),
        'bitmages-portfolio' => __('Portfolio Image', 'bitmages'),
        'bitmages-service' => __('Service Image', 'bitmages'),
        'bitmages-blog-grid' => __('Blog Grid Image', 'bitmages'),
    ));
}
add_filter('image_size_names_choose', 'bitmages_custom_image_sizes');

/**
 * Modify the main query
 */
function bitmages_modify_main_query($query) {
    if (!is_admin() && $query->is_main_query()) {
        // Portfolio archive
        if (is_post_type_archive('portfolio')) {
            $query->set('posts_per_page', 12);
        }
        
        // Services archive
        if (is_post_type_archive('services')) {
            $query->set('posts_per_page', 9);
        }
    }
}
add_action('pre_get_posts', 'bitmages_modify_main_query');

/**
 * Add async/defer attributes to scripts
 */
function bitmages_add_async_defer_attributes($tag, $handle) {
    // Add async to specific scripts
    $async_scripts = array('bitmages-main');
    
    if (in_array($handle, $async_scripts)) {
        return str_replace(' src', ' async src', $tag);
    }
    
    return $tag;
}
add_filter('script_loader_tag', 'bitmages_add_async_defer_attributes', 10, 2);

/**
 * Preload key resources
 */
function bitmages_preload_resources() {
    ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" as="style">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style">
    <?php
}
add_action('wp_head', 'bitmages_preload_resources', 2);