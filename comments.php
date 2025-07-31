<?php
/**
 * Template para comentários
 * 
 * @package BitMages
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            if ('1' === $comments_number) {
                printf(esc_html__('1 Comentário', 'bitmages'));
            } else {
                printf(
                    esc_html(_nx('%s Comentário', '%s Comentários', $comments_number, 'comments title', 'bitmages')),
                    number_format_i18n($comments_number)
                );
            }
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style' => 'ol',
                'short_ping' => true,
                'avatar_size' => 60,
            ));
            ?>
        </ol>

        <?php the_comments_navigation(); ?>

    <?php endif; ?>

    <?php
    if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
        ?>
        <p class="no-comments"><?php esc_html_e('Comentários estão fechados.', 'bitmages'); ?></p>
    <?php endif; ?>

    <?php comment_form(); ?>
</div>