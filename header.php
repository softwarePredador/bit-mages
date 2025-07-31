<?php
/**
 * Header do tema Bit Mages
 * 
 * @package BitMages
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-touch-icon.png">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e('Pular para o conteúdo', 'bitmages'); ?></a>

<!-- Header -->
<header class="header">
    <nav class="navbar">
        <div class="container">
            <div class="nav-wrapper">
                <!-- Logo -->
                <div class="site-branding">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo" rel="home">
                            <div class="logo-icon">BM</div>
                            <span class="logo-text"><?php bloginfo('name'); ?></span>
                        </a>
                    <?php endif; ?>
                </div>
                
                <!-- Mobile Toggle -->
                <button class="mobile-toggle" aria-label="<?php esc_attr_e('Menu', 'bitmages'); ?>" aria-expanded="false">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                
                <!-- Navigation Menu -->
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id' => 'primary-menu',
                    'menu_class' => 'nav-menu',
                    'container' => false,
                    'fallback_cb' => 'bitmages_primary_menu_fallback',
                    'depth' => 2,
                    'link_before' => '<span>',
                    'link_after' => '</span>',
                ));
                ?>
                
                <!-- Nav Actions -->
                <div class="nav-actions">
                    <!-- Theme Toggle -->
                    <button class="theme-toggle" aria-label="<?php esc_attr_e('Alternar tema', 'bitmages'); ?>">
                        <i class="fas fa-sun"></i>
                        <i class="fas fa-moon"></i>
                    </button>
                    
                    <!-- Search Toggle -->
                    <button class="search-toggle" aria-label="<?php esc_attr_e('Buscar', 'bitmages'); ?>">
                        <i class="fas fa-search"></i>
                    </button>
                    
                    <!-- CTA Button -->
                    <a href="<?php echo esc_url(home_url('/contato')); ?>" class="btn-primary nav-cta">
                        <?php esc_html_e('Iniciar Projeto', 'bitmages'); ?>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Search Modal -->
    <div class="search-modal" aria-hidden="true">
        <div class="search-modal-inner">
            <button class="search-close" aria-label="<?php esc_attr_e('Fechar busca', 'bitmages'); ?>">
                <i class="fas fa-times"></i>
            </button>
            <?php get_search_form(); ?>
        </div>
    </div>
</header>

<!-- Main Content Wrapper -->
<div id="page" class="site">
    <div id="content" class="site-content">