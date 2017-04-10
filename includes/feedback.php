<?php
//  Полный текст отзыва
add_action( 'wp_ajax_feedback', 'feedback_callback' );
add_action( 'wp_ajax_nopriv_feedback', 'feedback_callback' );

function feedback_callback() {
    global $wpdb;
    $id = $_REQUEST['ID'];
    $array = array();

    $query = "SELECT post_content, 
                meta.meta_value as `value`, 
                meta.meta_key as `key`
                FROM wp_posts AS post
                LEFT JOIN wp_postmeta AS meta
                ON post.ID = meta.post_id
                WHERE post.ID = $id AND (meta.meta_key = '_crb_author' OR meta.meta_key = '_crb_author-post')";

    $result = $wpdb->get_results($query);

    foreach ($result as $item) { 
        $array[$item->key] = $item->value;
    } ?>

    <div class="feedback__title">
        <?php echo $array['_crb_author']; ?>
    </div>
    <div class="feedback__subtitle">
        <?php echo $array['_crb_author-post']; ?>
    </div>
    <div class="feedback__text">
        <?php echo $result[0]->post_content; ?>
    </div>
    
<?php
    wp_die();
}
?>