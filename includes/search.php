<?php
add_action( 'wp_ajax_search', 'search_callback' );
add_action( 'wp_ajax_nopriv_search', 'search_callback' );

function search_callback()
{
    global $wpdb;

    $search_text = strip_tags($_REQUEST['text']);

    $query = "SELECT post_title
              FROM wp_posts
              WHERE post_type = 'product' AND post_title LIKE '%$search_text%'";

    $result = $wpdb->get_results($query);
    foreach ($result as $item) { ?>
        <li class="search-list__item">
            <a class="search-list__link" href="javascript:void(0);"><?php echo $item->post_title; ?></a>
        </li>
    <?php
    } ?>
    <span class="search-list__triangle"></span>
<?php
    wp_die();
}