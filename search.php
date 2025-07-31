<?php
/**
 * Template para resultados de busca
 * 
 * @package BitMages
 */

get_header(); ?>

<main id="main" class="site-main search-results">
    <div class="page-header">
        <div class="container">
            <h1 class="page-title">
                <?php
                printf(esc_html__('Resultados para: %s', 'bitmages'), '<span>' . get_search_query() . '</span>');
                ?>
            </h1>
        </div>
    </div>
    
    <div class="container">
        <div class="posts-grid">
            <?php
            if (have_posts()) :
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/content', 'search');
                endwhile;
                
                the_posts_pagination();
            else :
                ?>
                <div class="no-results">
                    <p><?php esc_html_e('Nenhum resultado encontrado. Tente uma nova busca.', 'bitmages'); ?></p>
                    <?php get_search_form(); ?>
                </div>
                <?php
            endif;
            ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>