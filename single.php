<?php
/**
 * Template para posts individuais
 * 
 * @package BitMages
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <div class="content-area">
            <?php
            while (have_posts()) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
                    <header class="entry-header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                        <div class="entry-meta">
                            <span class="posted-on">
                                <i class="far fa-calendar"></i>
                                <?php echo get_the_date(); ?>
                            </span>
                            <span class="byline">
                                <i class="far fa-user"></i>
                                <?php the_author(); ?>
                            </span>
                            <?php if (has_category()) : ?>
                                <span class="cat-links">
                                    <i class="far fa-folder"></i>
                                    <?php the_category(', '); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </header>

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="entry-content">
                        <?php
                        the_content();
                        
                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . esc_html__('Páginas:', 'bitmages'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>

                    <footer class="entry-footer">
                        <?php
                        $tags_list = get_the_tag_list('', ', ');
                        if ($tags_list) {
                            printf('<span class="tags-links"><i class="fas fa-tags"></i> %1$s</span>', $tags_list);
                        }
                        ?>
                    </footer>

                    <?php
                    // Navigation
                    the_post_navigation(array(
                        'prev_text' => '<span class="nav-subtitle">' . esc_html__('Anterior:', 'bitmages') . '</span> <span class="nav-title">%title</span>',
                        'next_text' => '<span class="nav-subtitle">' . esc_html__('Próximo:', 'bitmages') . '</span> <span class="nav-title">%title</span>',
                    ));

                    // Comments
                    if (comments_open() || get_comments_number()) {
                        comments_template();
                    }
                    ?>
                </article>
                <?php
            endwhile;
            ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>