<?php
/**
 * Template para página 404
 * 
 * @package BitMages
 */

get_header(); ?>

<main id="main" class="site-main error-404">
    <div class="container">
        <div class="error-content">
            <div class="error-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h1 class="error-title">404</h1>
            <h2 class="error-subtitle">Página não encontrada</h2>
            <p class="error-message">
                Desculpe, a página que você está procurando não existe ou foi movida.
            </p>
            <div class="error-actions">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-primary">
                    <i class="fas fa-home"></i>
                    Voltar ao início
                </a>
                <a href="<?php echo esc_url(home_url('/contato')); ?>" class="btn-secondary">
                    <i class="fas fa-envelope"></i>
                    Entre em contato
                </a>
            </div>
        </div>
    </div>
</main>

<style>
.error-404 {
    padding: 120px 0;
    text-align: center;
}

.error-content {
    max-width: 600px;
    margin: 0 auto;
}

.error-icon {
    font-size: 5rem;
    color: var(--primary-color);
    margin-bottom: 2rem;
}

.error-title {
    font-size: 8rem;
    font-weight: 800;
    color: var(--primary-color);
    line-height: 1;
    margin-bottom: 1rem;
    text-shadow: var(--glow);
}

.error-subtitle {
    font-size: 2rem;
    color: var(--text-light);
    margin-bottom: 1rem;
}

.error-message {
    font-size: 1.125rem;
    color: var(--text-medium);
    margin-bottom: 2rem;
}

.error-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
}
</style>

<?php get_footer(); ?>