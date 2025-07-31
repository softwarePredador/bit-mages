<?php
/**
 * Shortcodes do tema
 * 
 * @package BitMages
 */

// Shortcode para a homepage
function bitmages_homepage_shortcode() {
    ob_start();
    ?>
    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1 class="hero-title">
                        <span class="gradient-text">Transformamos ideias</span>
                        <br>em soluções digitais inovadoras
                    </h1>
                    <p class="hero-description">
                        Desenvolvimento completo de hardware, firmware, software e aplicações móveis. 
                        Da concepção à implementação, criamos produtos tecnológicos que fazem a diferença.
                    </p>
                    <div class="hero-actions">
                        <a href="#services" class="btn-primary btn-large">
                            Conheça nossos serviços
                            <i class="fas fa-arrow-right"></i>
                        </a>
                        <a href="<?php echo esc_url(home_url('/portfolio')); ?>" class="btn-secondary btn-large">
                            Ver portfolio
                        </a>
                    </div>
                    <div class="hero-stats">
                        <div class="stat">
                            <span class="stat-number">150+</span>
                            <span class="stat-label">Projetos entregues</span>
                        </div>
                        <div class="stat">
                            <span class="stat-number">50+</span>
                            <span class="stat-label">Clientes satisfeitos</span>
                        </div>
                        <div class="stat">
                            <span class="stat-number">10+</span>
                            <span class="stat-label">Anos de experiência</span>
                        </div>
                    </div>
                </div>
                <div class="hero-visual">
                    <div class="hero-image-wrapper">
                        <div class="hero-3d">
                            <i class="fas fa-code"></i>
                        </div>
                        <div class="floating-card card-1">
                            <i class="fas fa-microchip"></i>
                            <span>Hardware</span>
                        </div>
                        <div class="floating-card card-2">
                            <i class="fas fa-code"></i>
                            <span>Firmware</span>
                        </div>
                        <div class="floating-card card-3">
                            <i class="fas fa-mobile-alt"></i>
                            <span>Apps</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Inclui seções de serviços e portfolio -->
    <?php echo do_shortcode('[bitmages_services]'); ?>
    <?php echo do_shortcode('[bitmages_portfolio_grid]'); ?>
    
    <?php
    return ob_get_clean();
}
add_shortcode('bitmages_homepage', 'bitmages_homepage_shortcode');

// Shortcode para grid de serviços
function bitmages_services_grid_shortcode($atts) {
    $atts = shortcode_atts(array(
        'limit' => 3,
    ), $atts);
    
    ob_start();
    ?>
    <section id="services" class="services">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Nossos Serviços</span>
                <h2 class="section-title">Soluções completas para seu projeto</h2>
            </div>
            <div class="services-grid">
                <!-- Serviços estáticos por enquanto -->
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-microchip"></i>
                    </div>
                    <h3>Desenvolvimento de Hardware</h3>
                    <p>Projeto completo de PCBs, seleção de componentes, prototipagem e preparação para produção.</p>
                    <a href="#" class="service-link">Saiba mais <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="service-card featured">
                    <div class="service-icon">
                        <i class="fas fa-code"></i>
                    </div>
                    <h3>Firmware Embarcado</h3>
                    <p>Desenvolvimento de firmware otimizado para microcontroladores e sistemas embarcados.</p>
                    <a href="#" class="service-link">Saiba mais <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <h3>Software & Aplicações</h3>
                    <p>Desenvolvimento de aplicações desktop, web e mobile para controle de dispositivos.</p>
                    <a href="#" class="service-link">Saiba mais <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode('bitmages_services', 'bitmages_services_grid_shortcode');

// Shortcode para grid de portfolio
function bitmages_portfolio_grid_shortcode($atts) {
    $atts = shortcode_atts(array(
        'limit' => 6,
    ), $atts);
    
    ob_start();
    ?>
    <section id="portfolio" class="portfolio">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Portfolio</span>
                <h2 class="section-title">Projetos que fazem a diferença</h2>
            </div>
            <div class="portfolio-grid">
                <?php
                $portfolio_query = new WP_Query(array(
                    'post_type' => 'portfolio',
                    'posts_per_page' => $atts['limit'],
                ));
                
                if ($portfolio_query->have_posts()) :
                    while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
                        ?>
                        <div class="portfolio-item">
                            <div class="portfolio-image">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('large'); ?>
                                <?php else : ?>
                                    <i class="fas fa-project-diagram"></i>
                                <?php endif; ?>
                                <div class="portfolio-overlay">
                                    <h3><?php the_title(); ?></h3>
                                    <a href="<?php the_permalink(); ?>" class="btn-view">Ver detalhes</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Portfolio demo se não houver posts
                    ?>
                    <div class="portfolio-item">
                        <div class="portfolio-image">
                            <i class="fas fa-industry"></i>
                            <div class="portfolio-overlay">
                                <span class="category">IoT Industrial</span>
                                <h3>Sistema de Monitoramento</h3>
                            </div>
                        </div>
                    </div>
                    <div class="portfolio-item">
                        <div class="portfolio-image">
                            <i class="fas fa-heartbeat"></i>
                            <div class="portfolio-overlay">
                                <span class="category">Healthcare</span>
                                <h3>Monitor de Sinais Vitais</h3>
                            </div>
                        </div>
                    </div>
                    <div class="portfolio-item">
                        <div class="portfolio-image">
                            <i class="fas fa-home"></i>
                            <div class="portfolio-overlay">
                                <span class="category">Smart Home</span>
                                <h3>Central de Automação</h3>
                            </div>
                        </div>
                    </div>
                    <?php
                endif;
                ?>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode('bitmages_portfolio_grid', 'bitmages_portfolio_grid_shortcode');