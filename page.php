<?php
/**
 * Template para páginas
 * 
 * @package BitMages
 */

get_header(); ?>

<main id="main" class="site-main page-content">
    <div class="page-header">
        <div class="container">
            <h1 class="page-title"><?php the_title(); ?></h1>
        </div>
    </div>
    
    <div class="container">
        <div class="content-area">
            <?php
            while (have_posts()) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="entry-content">
                        <?php
                        the_content();
                        
                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . esc_html__('Páginas:', 'bitmages'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>
                </article>
                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) {
                    comments_template();
                }
            endwhile;
            ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>