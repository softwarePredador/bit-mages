<?php
/**
 * Template principal
 * 
 * @package BitMages
 */

get_header(); ?>

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
                    <a href="#portfolio" class="btn-secondary btn-large">
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
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-3d-model.png" alt="Desenvolvimento tecnológico" class="hero-image">
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
    <div class="hero-bg-pattern"></div>
</section>

<!-- Serviços -->
<section id="services" class="services">
    <div class="container">
        <div class="section-header">
            <span class="section-label">Nossos Serviços</span>
            <h2 class="section-title">Soluções completas para seu projeto</h2>
            <p class="section-description">
                Oferecemos desenvolvimento end-to-end, desde a concepção até a entrega final
            </p>
        </div>
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-microchip"></i>
                </div>
                <h3>Desenvolvimento de Hardware</h3>
                <p>Projeto completo de PCBs, seleção de componentes, prototipagem e preparação para produção em escala.</p>
                <ul class="service-features">
                    <li><i class="fas fa-check"></i> Design de PCB multicamadas</li>
                    <li><i class="fas fa-check"></i> Análise térmica e EMI</li>
                    <li><i class="fas fa-check"></i> Certificações e compliance</li>
                </ul>
                <a href="#" class="service-link">Saiba mais <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="service-card featured">
                <div class="service-icon">
                    <i class="fas fa-code"></i>
                </div>
                <h3>Firmware Embarcado</h3>
                <p>Desenvolvimento de firmware otimizado para microcontroladores e sistemas embarcados com alta performance.</p>
                <ul class="service-features">
                    <li><i class="fas fa-check"></i> RTOS e Bare-metal</li>
                    <li><i class="fas fa-check"></i> Protocolos IoT (BLE, WiFi, LoRa)</li>
                    <li><i class="fas fa-check"></i> Atualização OTA</li>
                </ul>
                <a href="#" class="service-link">Saiba mais <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-laptop-code"></i>
                </div>
                <h3>Software & Aplicações</h3>
                <p>Desenvolvimento de aplicações desktop, web e mobile para controle e monitoramento de dispositivos.</p>
                <ul class="service-features">
                    <li><i class="fas fa-check"></i> Apps iOS e Android</li>
                    <li><i class="fas fa-check"></i> Dashboards web</li>
                    <li><i class="fas fa-check"></i> APIs e integrações</li>
                </ul>
                <a href="#" class="service-link">Saiba mais <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio -->
<section id="portfolio" class="portfolio">
    <div class="container">
        <div class="section-header">
            <span class="section-label">Portfolio</span>
            <h2 class="section-title">Projetos que fazem a diferença</h2>
        </div>
        <div class="portfolio-grid">
            <?php
            $portfolio_args = array(
                'post_type' => 'portfolio',
                'posts_per_page' => 6,
                'orderby' => 'date',
                'order' => 'DESC'
            );
            
            $portfolio_query = new WP_Query($portfolio_args);
            
            if ($portfolio_query->have_posts()) :
                while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
                    $categories = get_the_terms(get_the_ID(), 'portfolio_category');
                    ?>
                    <div class="portfolio-item">
                        <div class="portfolio-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large'); ?>
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.jpg" alt="<?php the_title(); ?>">
                            <?php endif; ?>
                            <div class="portfolio-overlay">
                                <?php if ($categories && !is_wp_error($categories)) : ?>
                                    <span class="category"><?php echo esc_html($categories[0]->name); ?></span>
                                <?php endif; ?>
                                <h3><?php the_title(); ?></h3>
                                <a href="<?php the_permalink(); ?>" class="btn-view">Ver detalhes</a>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta">
    <div class="container">
        <div class="cta-content">
            <h2>Pronto para transformar sua ideia em realidade?</h2>
            <p>Nossa equipe está pronta para ajudar você a desenvolver a solução perfeita</p>
            <a href="#contact" class="btn-primary btn-large">
                Solicitar orçamento gratuito
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>