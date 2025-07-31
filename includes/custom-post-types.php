<?php
/**
 * Custom Post Types
 * 
 * @package BitMages
 */

// Registrar CPT de Serviços
function bitmages_register_services_cpt() {
    $labels = array(
        'name' => __('Serviços', 'bitmages'),
        'singular_name' => __('Serviço', 'bitmages'),
        'add_new' => __('Adicionar Novo', 'bitmages'),
        'add_new_item' => __('Adicionar Novo Serviço', 'bitmages'),
        'edit_item' => __('Editar Serviço', 'bitmages'),
        'new_item' => __('Novo Serviço', 'bitmages'),
        'view_item' => __('Ver Serviço', 'bitmages'),
        'search_items' => __('Buscar Serviços', 'bitmages'),
        'not_found' => __('Nenhum serviço encontrado', 'bitmages'),
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-admin-tools',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite' => array('slug' => 'servicos'),
    );
    
    register_post_type('services', $args);
}
add_action('init', 'bitmages_register_services_cpt');

// Registrar CPT de Depoimentos
function bitmages_register_testimonials_cpt() {
    $labels = array(
        'name' => __('Depoimentos', 'bitmages'),
        'singular_name' => __('Depoimento', 'bitmages'),
        'add_new' => __('Adicionar Novo', 'bitmages'),
        'add_new_item' => __('Adicionar Novo Depoimento', 'bitmages'),
        'edit_item' => __('Editar Depoimento', 'bitmages'),
        'new_item' => __('Novo Depoimento', 'bitmages'),
        'view_item' => __('Ver Depoimento', 'bitmages'),
        'search_items' => __('Buscar Depoimentos', 'bitmages'),
        'not_found' => __('Nenhum depoimento encontrado', 'bitmages'),
    );
    
    $args = array(
        'labels' => $labels,
        'public' => false,
        'show_ui' => true,
        'menu_icon' => 'dashicons-format-quote',
        'supports' => array('title', 'editor', 'thumbnail'),
    );
    
    register_post_type('testimonials', $args);
}
add_action('init', 'bitmages_register_testimonials_cpt');