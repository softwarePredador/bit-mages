<?php
/**
 * Bit Mages Theme Customizer
 *
 * @package BitMages
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bitmages_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    
    // Remove unnecessary sections
    $wp_customize->remove_section('colors');
    $wp_customize->remove_section('background_image');
    
    /**
     * Theme Options Panel
     */
    $wp_customize->add_panel('bitmages_theme_options', array(
        'title' => __('Opções do Tema Bit Mages', 'bitmages'),
        'priority' => 20,
    ));
    
    /**
     * Contact Information Section
     */
    $wp_customize->add_section('bitmages_contact_info', array(
        'title' => __('Informações de Contato', 'bitmages'),
        'panel' => 'bitmages_theme_options',
        'priority' => 10,
    ));
    
    // Email
    $wp_customize->add_setting('bitmages_email', array(
        'default' => 'contato@bitmages.com.br',
        'sanitize_callback' => 'sanitize_email',
        'transport' => 'postMessage',
    ));
    
    $wp_customize->add_control('bitmages_email', array(
        'label' => __('Email', 'bitmages'),
        'section' => 'bitmages_contact_info',
        'type' => 'email',
    ));
    
    // Phone
    $wp_customize->add_setting('bitmages_phone', array(
        'default' => '+55 11 9999-9999',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    
    $wp_customize->add_control('bitmages_phone', array(
        'label' => __('Telefone', 'bitmages'),
        'section' => 'bitmages_contact_info',
        'type' => 'text',
    ));
    
    // WhatsApp
    $wp_customize->add_setting('bitmages_whatsapp', array(
        'default' => '5511999999999',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('bitmages_whatsapp', array(
        'label' => __('WhatsApp (apenas números)', 'bitmages'),
        'description' => __('Ex: 5511999999999', 'bitmages'),
        'section' => 'bitmages_contact_info',
        'type' => 'text',
    ));
    
    // WhatsApp Message
    $wp_customize->add_setting('bitmages_whatsapp_message', array(
        'default' => 'Olá! Gostaria de saber mais sobre os serviços da Bit Mages.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('bitmages_whatsapp_message', array(
        'label' => __('Mensagem padrão do WhatsApp', 'bitmages'),
        'section' => 'bitmages_contact_info',
        'type' => 'textarea',
    ));
    
    // Address
    $wp_customize->add_setting('bitmages_address', array(
        'default' => 'São Paulo, SP',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    
    $wp_customize->add_control('bitmages_address', array(
        'label' => __('Endereço', 'bitmages'),
        'section' => 'bitmages_contact_info',
        'type' => 'text',
    ));
    
    // Working Hours
    $wp_customize->add_setting('bitmages_working_hours', array(
        'default' => 'Seg-Sex: 9h-18h',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    
    $wp_customize->add_control('bitmages_working_hours', array(
        'label' => __('Horário de Funcionamento', 'bitmages'),
        'section' => 'bitmages_contact_info',
        'type' => 'text',
    ));
    
    /**
     * Social Media Section
     */
    $wp_customize->add_section('bitmages_social_media', array(
        'title' => __('Redes Sociais', 'bitmages'),
        'panel' => 'bitmages_theme_options',
        'priority' => 20,
    ));
    
    // Social networks
    $social_networks = array(
        'linkedin' => 'LinkedIn',
        'github' => 'GitHub',
        'instagram' => 'Instagram',
        'youtube' => 'YouTube',
        'twitter' => 'Twitter',
        'facebook' => 'Facebook',
    );
    
    foreach ($social_networks as $network => $label) {
        $wp_customize->add_setting('bitmages_' . $network, array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport' => 'postMessage',
        ));
        
        $wp_customize->add_control('bitmages_' . $network, array(
            'label' => $label,
            'section' => 'bitmages_social_media',
            'type' => 'url',
        ));
    }
    
    /**
     * Footer Section
     */
    $wp_customize->add_section('bitmages_footer', array(
        'title' => __('Rodapé', 'bitmages'),
        'panel' => 'bitmages_theme_options',
        'priority' => 30,
    ));
    
    // Footer Description
    $wp_customize->add_setting('bitmages_footer_description', array(
        'default' => 'Transformando ideias em soluções digitais inovadoras desde 2015.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'postMessage',
    ));
    
    $wp_customize->add_control('bitmages_footer_description', array(
        'label' => __('Descrição do Rodapé', 'bitmages'),
        'section' => 'bitmages_footer',
        'type' => 'textarea',
    ));
    
    /**
     * Theme Colors Section
     */
    $wp_customize->add_section('bitmages_colors', array(
        'title' => __('Cores do Tema', 'bitmages'),
        'panel' => 'bitmages_theme_options',
        'priority' => 40,
    ));
    
    // Primary Color
    $wp_customize->add_setting('bitmages_primary_color', array(
        'default' => '#00ff88',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'bitmages_primary_color', array(
        'label' => __('Cor Primária', 'bitmages'),
        'section' => 'bitmages_colors',
    )));
    
    // Dark Background
    $wp_customize->add_setting('bitmages_dark_bg', array(
        'default' => '#0a0f0a',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'bitmages_dark_bg', array(
        'label' => __('Fundo Escuro', 'bitmages'),
        'section' => 'bitmages_colors',
    )));
    
    /**
     * Homepage Settings
     */
    $wp_customize->add_section('bitmages_homepage', array(
        'title' => __('Configurações da Homepage', 'bitmages'),
        'panel' => 'bitmages_theme_options',
        'priority' => 50,
    ));
    
    // Hero Title
    $wp_customize->add_setting('bitmages_hero_title', array(
        'default' => 'Transformamos ideias em soluções digitais inovadoras',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    
    $wp_customize->add_control('bitmages_hero_title', array(
        'label' => __('Título Principal', 'bitmages'),
        'section' => 'bitmages_homepage',
        'type' => 'text',
    ));
    
    // Hero Description
    $wp_customize->add_setting('bitmages_hero_description', array(
        'default' => 'Desenvolvimento completo de hardware, firmware, software e aplicações móveis.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'postMessage',
    ));
    
    $wp_customize->add_control('bitmages_hero_description', array(
        'label' => __('Descrição Principal', 'bitmages'),
        'section' => 'bitmages_homepage',
        'type' => 'textarea',
    ));
    
    // Stats
    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting('bitmages_stat_number_' . $i, array(
            'default' => '150+',
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'postMessage',
        ));
        
        $wp_customize->add_control('bitmages_stat_number_' . $i, array(
            'label' => sprintf(__('Estatística %d - Número', 'bitmages'), $i),
            'section' => 'bitmages_homepage',
            'type' => 'text',
        ));
        
        $wp_customize->add_setting('bitmages_stat_label_' . $i, array(
            'default' => 'Projetos entregues',
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'postMessage',
        ));
        
        $wp_customize->add_control('bitmages_stat_label_' . $i, array(
            'label' => sprintf(__('Estatística %d - Label', 'bitmages'), $i),
            'section' => 'bitmages_homepage',
            'type' => 'text',
        ));
    }
}
add_action('customize_register', 'bitmages_customize_register');

/**
 * Render the site title for the selective refresh partial.
 */
function bitmages_customize_partial_blogname() {
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 */
function bitmages_customize_partial_blogdescription() {
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function bitmages_customize_preview_js() {
    wp_enqueue_script('bitmages-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('customize-preview'), BITMAGES_THEME_VERSION, true);
}
add_action('customize_preview_init', 'bitmages_customize_preview_js');

/**
 * Customizer CSS
 */
function bitmages_customizer_css() {
    ?>
    <style type="text/css">
        :root {
            --primary-color: <?php echo esc_attr(get_theme_mod('bitmages_primary_color', '#00ff88')); ?>;
            --dark-bg: <?php echo esc_attr(get_theme_mod('bitmages_dark_bg', '#0a0f0a')); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'bitmages_customizer_css');