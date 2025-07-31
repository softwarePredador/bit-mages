<?php
/**
 * Footer do tema Bit Mages
 * 
 * @package BitMages
 */
?>

    </div><!-- #content -->
</div><!-- #page -->

<!-- Footer -->
<footer class="footer">
    <div class="footer-main">
        <div class="container">
            <div class="footer-content">
                <!-- Company Info -->
                <div class="footer-brand">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <div class="footer-logo">
                            <div class="logo-icon">BM</div>
                            <span class="logo-text"><?php bloginfo('name'); ?></span>
                        </div>
                    <?php endif; ?>
                    
                    <p class="footer-description">
                        <?php echo esc_html(get_theme_mod('bitmages_footer_description', 'Transformando ideias em soluções digitais inovadoras desde 2015.')); ?>
                    </p>
                    
                    <!-- Social Links -->
                    <div class="social-links">
                        <?php if (get_theme_mod('bitmages_linkedin')) : ?>
                            <a href="<?php echo esc_url(get_theme_mod('bitmages_linkedin')); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        <?php endif; ?>
                        
                        <?php if (get_theme_mod('bitmages_github')) : ?>
                            <a href="<?php echo esc_url(get_theme_mod('bitmages_github')); ?>" target="_blank" rel="noopener noreferrer" aria-label="GitHub">
                                <i class="fab fa-github"></i>
                            </a>
                        <?php endif; ?>
                        
                        <?php if (get_theme_mod('bitmages_instagram')) : ?>
                            <a href="<?php echo esc_url(get_theme_mod('bitmages_instagram')); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                        <?php endif; ?>
                        
                        <?php if (get_theme_mod('bitmages_youtube')) : ?>
                            <a href="<?php echo esc_url(get_theme_mod('bitmages_youtube')); ?>" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
                                <i class="fab fa-youtube"></i>
                            </a>
                        <?php endif; ?>
                        
                        <?php if (get_theme_mod('bitmages_twitter')) : ?>
                            <a href="<?php echo esc_url(get_theme_mod('bitmages_twitter')); ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Services Links -->
                <div class="footer-links">
                    <h3><?php esc_html_e('Serviços', 'bitmages'); ?></h3>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer-services',
                        'menu_class' => 'footer-menu',
                        'container' => false,
                        'depth' => 1,
                        'fallback_cb' => function() {
                            echo '<ul class="footer-menu">';
                            echo '<li><a href="#">' . esc_html__('Desenvolvimento de Hardware', 'bitmages') . '</a></li>';
                            echo '<li><a href="#">' . esc_html__('Firmware Embarcado', 'bitmages') . '</a></li>';
                            echo '<li><a href="#">' . esc_html__('Aplicações Mobile', 'bitmages') . '</a></li>';
                            echo '<li><a href="#">' . esc_html__('Consultoria Técnica', 'bitmages') . '</a></li>';
                            echo '</ul>';
                        }
                    ));
                    ?>
                </div>
                
                <!-- Company Links -->
                <div class="footer-links">
                    <h3><?php esc_html_e('Empresa', 'bitmages'); ?></h3>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer-company',
                        'menu_class' => 'footer-menu',
                        'container' => false,
                        'depth' => 1,
                        'fallback_cb' => function() {
                            echo '<ul class="footer-menu">';
                            echo '<li><a href="' . esc_url(home_url('/sobre')) . '">' . esc_html__('Sobre nós', 'bitmages') . '</a></li>';
                            echo '<li><a href="' . esc_url(home_url('/portfolio')) . '">' . esc_html__('Portfolio', 'bitmages') . '</a></li>';
                            echo '<li><a href="' . esc_url(home_url('/blog')) . '">' . esc_html__('Blog', 'bitmages') . '</a></li>';
                            echo '<li><a href="' . esc_url(home_url('/carreiras')) . '">' . esc_html__('Carreiras', 'bitmages') . '</a></li>';
                            echo '</ul>';
                        }
                    ));
                    ?>
                </div>
                
                <!-- Contact Info -->
                <div class="footer-contact">
                    <h3><?php esc_html_e('Contato', 'bitmages'); ?></h3>
                    
                    <?php if (get_theme_mod('bitmages_email')) : ?>
                        <p>
                            <i class="fas fa-envelope"></i>
                            <a href="mailto:<?php echo esc_attr(get_theme_mod('bitmages_email')); ?>">
                                <?php echo esc_html(get_theme_mod('bitmages_email')); ?>
                            </a>
                        </p>
                    <?php endif; ?>
                    
                    <?php if (get_theme_mod('bitmages_phone')) : ?>
                        <p>
                            <i class="fas fa-phone"></i>
                            <a href="tel:<?php echo esc_attr(str_replace(array(' ', '-', '(', ')'), '', get_theme_mod('bitmages_phone'))); ?>">
                                <?php echo esc_html(get_theme_mod('bitmages_phone')); ?>
                            </a>
                        </p>
                    <?php endif; ?>
                    
                    <?php if (get_theme_mod('bitmages_address')) : ?>
                        <p>
                            <i class="fas fa-map-marker-alt"></i>
                            <?php echo esc_html(get_theme_mod('bitmages_address', 'São Paulo, SP')); ?>
                        </p>
                    <?php endif; ?>
                    
                    <!-- Working Hours -->
                    <?php if (get_theme_mod('bitmages_working_hours')) : ?>
                        <p class="working-hours">
                            <i class="fas fa-clock"></i>
                            <?php echo esc_html(get_theme_mod('bitmages_working_hours', 'Seg-Sex: 9h-18h')); ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-content">
                <p class="copyright">
                    &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. 
                    <?php esc_html_e('Todos os direitos reservados.', 'bitmages'); ?>
                </p>
                
                <!-- Footer Bottom Menu -->
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer-bottom',
                    'menu_class' => 'footer-bottom-menu',
                    'container' => false,
                    'depth' => 1,
                    'fallback_cb' => function() {
                        echo '<ul class="footer-bottom-menu">';
                        echo '<li><a href="' . esc_url(home_url('/privacidade')) . '">' . esc_html__('Política de Privacidade', 'bitmages') . '</a></li>';
                        echo '<li><a href="' . esc_url(home_url('/termos')) . '">' . esc_html__('Termos de Uso', 'bitmages') . '</a></li>';
                        echo '</ul>';
                    }
                ));
                ?>
            </div>
        </div>
    </div>
</footer>

<!-- WhatsApp Float Button -->
<?php if (get_theme_mod('bitmages_whatsapp')) : 
    $whatsapp_number = preg_replace('/[^0-9]/', '', get_theme_mod('bitmages_whatsapp'));
    $whatsapp_message = get_theme_mod('bitmages_whatsapp_message', 'Olá! Gostaria de saber mais sobre os serviços da Bit Mages.');
?>
    <a href="https://wa.me/<?php echo esc_attr($whatsapp_number); ?>?text=<?php echo esc_attr(urlencode($whatsapp_message)); ?>" 
       class="whatsapp-float" 
       target="_blank" 
       rel="noopener noreferrer"
       aria-label="<?php esc_attr_e('Conversar no WhatsApp', 'bitmages'); ?>">
        <i class="fab fa-whatsapp"></i>
    </a>
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>