<?php
/**
 * Bit Mages Theme Functions
 * 
 * @package BitMages
 * @author softwarePredador
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define theme constants
define('BITMAGES_THEME_VERSION', '1.0.0');
define('BITMAGES_THEME_DIR', get_template_directory());
define('BITMAGES_THEME_URI', get_template_directory_uri());

/**
 * Theme Setup
 */
function bitmages_theme_setup() {
    // Make theme available for translation
    load_theme_textdomain('bitmages', BITMAGES_THEME_DIR . '/languages');
    
    // Add default posts and comments RSS feed links
    add_theme_support('automatic-feed-links');
    
    // Let WordPress manage the document title
    add_theme_support('title-tag');
    
    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(1200, 630, true);
    
    // Add image sizes
    add_image_size('bitmages-hero', 1920, 1080, true);
    add_image_size('bitmages-portfolio', 800, 600, true);
    add_image_size('bitmages-service', 600, 400, true);
    add_image_size('bitmages-blog-grid', 400, 300, true);
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Menu Principal', 'bitmages'),
        'footer-services' => __('Footer - Serviços', 'bitmages'),
        'footer-company' => __('Footer - Empresa', 'bitmages'),
        'footer-bottom' => __('Footer - Bottom', 'bitmages'),
    ));
    
    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    
    // Set up the WordPress core custom background feature
    add_theme_support('custom-background', array(
        'default-color' => '0a0f0a',
    ));
    
    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');
    
    // Add support for core custom logo
    add_theme_support('custom-logo', array(
        'height' => 50,
        'width' => 200,
        'flex-width' => true,
        'flex-height' => true,
    ));
    
    // Add support for responsive embeds
    add_theme_support('responsive-embeds');
    
    // Add support for wide align images
    add_theme_support('align-wide');
    
    // Add support for block styles
    add_theme_support('wp-block-styles');
    
    // Add support for editor styles
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor-style.css');
}
add_action('after_setup_theme', 'bitmages_theme_setup');

/**
 * Enqueue scripts and styles
 */
function bitmages_enqueue_scripts() {
    // CSS Files
    wp_enqueue_style('bitmages-google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap', array(), null);
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
    wp_enqueue_style('bitmages-main-style', get_stylesheet_uri(), array(), BITMAGES_THEME_VERSION);
    wp_enqueue_style('bitmages-responsive', BITMAGES_THEME_URI . '/assets/css/responsive.css', array('bitmages-main-style'), BITMAGES_THEME_VERSION);
    wp_enqueue_style('bitmages-animations', BITMAGES_THEME_URI . '/assets/css/animations.css', array('bitmages-main-style'), BITMAGES_THEME_VERSION);
    
    // JavaScript Files
    wp_enqueue_script('jquery');
    wp_enqueue_script('bitmages-main', BITMAGES_THEME_URI . '/assets/js/main.js', array('jquery'), BITMAGES_THEME_VERSION, true);
    
    // Localize script for AJAX
    wp_localize_script('bitmages-main', 'bitmages_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('bitmages_nonce'),
        'home_url' => home_url(),
        'is_mobile' => wp_is_mobile(),
        'strings' => array(
            'loading' => __('Carregando...', 'bitmages'),
            'error' => __('Ocorreu um erro. Por favor, tente novamente.', 'bitmages'),
            'success' => __('Mensagem enviada com sucesso!', 'bitmages'),
        )
    ));
    
    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'bitmages_enqueue_scripts');

/**
 * Register widget areas
 */
function bitmages_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar Principal', 'bitmages'),
        'id' => 'sidebar-1',
        'description' => __('Adicione widgets aqui.', 'bitmages'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    register_sidebar(array(
        'name' => __('Sidebar Blog', 'bitmages'),
        'id' => 'sidebar-blog',
        'description' => __('Widgets para páginas do blog.', 'bitmages'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'bitmages_widgets_init');

/**
 * Include required files
 */
require_once BITMAGES_THEME_DIR . '/includes/custom-post-types.php';
require_once BITMAGES_THEME_DIR . '/includes/shortcodes.php';

/**
 * Customizer additions
 */
require get_template_directory() . '/includes/customizer.php';

/**
 * Custom template tags
 */
require get_template_directory() . '/includes/template-tags.php';

/**
 * Functions which enhance the theme
 */
require get_template_directory() . '/includes/template-functions.php';

/**
 * AJAX Contact Form Handler
 */
function bitmages_handle_contact_form() {
    // Verify nonce
    if (!wp_verify_nonce($_POST['nonce'], 'bitmages_nonce')) {
        wp_send_json_error(__('Erro de segurança.', 'bitmages'));
    }
    
    // Sanitize form data
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $service = sanitize_text_field($_POST['service']);
    $message = sanitize_textarea_field($_POST['message']);
    
    // Validate required fields
    if (empty($name) || empty($email) || empty($message)) {
        wp_send_json_error(__('Por favor, preencha todos os campos obrigatórios.', 'bitmages'));
    }
    
    // Validate email
    if (!is_email($email)) {
        wp_send_json_error(__('Por favor, insira um email válido.', 'bitmages'));
    }
    
    // Prepare email
    $to = get_option('admin_email');
    $subject = sprintf(__('Nova mensagem de %s - Bit Mages', 'bitmages'), $name);
    
    $body = sprintf(__("Nome: %s\n", 'bitmages'), $name);
    $body .= sprintf(__("Email: %s\n", 'bitmages'), $email);
    $body .= sprintf(__("Telefone: %s\n", 'bitmages'), $phone);
    $body .= sprintf(__("Serviço: %s\n\n", 'bitmages'), $service);
    $body .= sprintf(__("Mensagem:\n%s", 'bitmages'), $message);
    
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . $name . ' <' . $email . '>',
        'Reply-To: ' . $email
    );
    
    // Send email
    $sent = wp_mail($to, $subject, $body, $headers);
    
    if ($sent) {
        // Save to database (optional)
        bitmages_save_contact_submission($name, $email, $phone, $service, $message);
        
        wp_send_json_success(__('Mensagem enviada com sucesso! Entraremos em contato em breve.', 'bitmages'));
    } else {
        wp_send_json_error(__('Erro ao enviar mensagem. Por favor, tente novamente.', 'bitmages'));
    }
}
add_action('wp_ajax_bitmages_contact', 'bitmages_handle_contact_form');
add_action('wp_ajax_nopriv_bitmages_contact', 'bitmages_handle_contact_form');

/**
 * Save contact form submission to database
 */
function bitmages_save_contact_submission($name, $email, $phone, $service, $message) {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'bitmages_contacts';
    
    $wpdb->insert(
        $table_name,
        array(
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'service' => $service,
            'message' => $message,
            'date_submitted' => current_time('mysql'),
            'ip_address' => $_SERVER['REMOTE_ADDR']
        )
    );
}

/**
 * Create contacts table on theme activation
 */
function bitmages_create_contacts_table() {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'bitmages_contacts';
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name varchar(100) NOT NULL,
        email varchar(100) NOT NULL,
        phone varchar(20) DEFAULT '',
        service varchar(50) DEFAULT '',
        message text NOT NULL,
        date_submitted datetime DEFAULT CURRENT_TIMESTAMP,
        ip_address varchar(45) DEFAULT '',
        status varchar(20) DEFAULT 'unread',
        PRIMARY KEY (id)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
add_action('after_switch_theme', 'bitmages_create_contacts_table');

/**
 * Add theme support for Gutenberg
 */
function bitmages_gutenberg_support() {
    // Add support for editor color palette
    add_theme_support('editor-color-palette', array(
        array(
            'name' => __('Verde Primário', 'bitmages'),
            'slug' => 'primary',
            'color' => '#00ff88',
        ),
        array(
            'name' => __('Verde Escuro', 'bitmages'),
            'slug' => 'primary-dark',
            'color' => '#00cc6a',
        ),
        array(
            'name' => __('Fundo Escuro', 'bitmages'),
            'slug' => 'dark-bg',
            'color' => '#0a0f0a',
        ),
        array(
            'name' => __('Texto Claro', 'bitmages'),
            'slug' => 'text-light',
            'color' => '#e0ffe0',
        ),
    ));
    
    // Add support for editor font sizes
    add_theme_support('editor-font-sizes', array(
        array(
            'name' => __('Pequeno', 'bitmages'),
            'size' => 14,
            'slug' => 'small'
        ),
        array(
            'name' => __('Normal', 'bitmages'),
            'size' => 16,
            'slug' => 'normal'
        ),
        array(
            'name' => __('Médio', 'bitmages'),
            'size' => 20,
            'slug' => 'medium'
        ),
        array(
            'name' => __('Grande', 'bitmages'),
            'size' => 24,
            'slug' => 'large'
        ),
        array(
            'name' => __('Extra Grande', 'bitmages'),
            'size' => 32,
            'slug' => 'extra-large'
        ),
    ));
}
add_action('after_setup_theme', 'bitmages_gutenberg_support');

/**
 * Custom excerpt length
 */
function bitmages_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'bitmages_excerpt_length', 999);

/**
 * Custom excerpt more
 */
function bitmages_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'bitmages_excerpt_more');

/**
 * Add custom classes to body
 */
function bitmages_body_classes($classes) {
    // Add page slug if it doesn't exist
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }
    
    // Add class if sidebar is active
    if (is_active_sidebar('sidebar-1')) {
        $classes[] = 'has-sidebar';
    }
    
    return $classes;
}
add_filter('body_class', 'bitmages_body_classes');

/**
 * Fallback menu
 */
function bitmages_primary_menu_fallback() {
    echo '<ul class="nav-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Início', 'bitmages') . '</a></li>';
    
    // Show sample pages
    $pages = get_pages(array('number' => 5));
    foreach ($pages as $page) {
        echo '<li><a href="' . esc_url(get_page_link($page->ID)) . '">' . esc_html($page->post_title) . '</a></li>';
    }
    
    echo '</ul>';
}

/**
 * Security headers
 */
function bitmages_security_headers() {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('X-XSS-Protection: 1; mode=block');
    header('Referrer-Policy: no-referrer-when-downgrade');
}
add_action('send_headers', 'bitmages_security_headers');