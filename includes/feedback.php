<?php
//  Полный текст отзыва
add_action( 'wp_ajax_feedback', 'feedback_callback' );
add_action( 'wp_ajax_nopriv_feedback', 'feedback_callback' );

function feedback_callback() {
    $post_id = $_REQUEST['post_id'];
    $post = get_post($post_id);
    ?>

    <div class="feedback__wrapper">
        <?php $meta = get_post_meta($post->ID); ?>
        <div class="feedback__title"><?php echo $meta['client_name'][0]; ?></div>
        <div class="feedback__text"><?php echo $post->post_content; ?></div>
    </div>

<?php
    wp_die();
}
?>