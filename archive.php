<?php
/**
 * Template para arquivos (categorias, tags, etc)
 * 
 * @package BitMages
 */

get_header(); ?>

<main id="main" class="site-main archive-page">
    <div class="page-header">
        <div class="container">
            <?php
            the_archive_title('<h1 class="page-title">', '</h1>');
            the_archive_description('<div class="archive-description">', '</div>');
            ?>
        </div>
    </div>
    
    <div class="container">
        <div class="posts-grid">
            <?php
            if (have_posts()) :
                while (have_posts()) :
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium_large'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="post-content">
                            <header class="entry-header">
                                <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
                                <div class="entry-meta">
                                    <span class="posted-on">
                                        <i class="far fa-calendar"></i>
                                        <?php echo get_the_date(); ?>
                                    </span>
                                </div>
                            </header>
                            
                            <div class="entry-summary">
                                <?php the_excerpt(); ?>
                            </div>
                            
                            <a href="<?php the_permalink(); ?>" class="read-more">
                                Ler mais <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                    <?php
                endwhile;
                
                // Pagination
                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => __('← Anterior', 'bitmages'),
                    'next_text' => __('Próximo →', 'bitmages'),
                ));
                
            else :
                ?>
                <p class="no-posts"><?php esc_html_e('Nenhum post encontrado.', 'bitmages'); ?></p>
                <?php
            endif;
            ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>