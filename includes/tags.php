<?php
add_action( 'wp_ajax_tags', 'tags_callback' );
add_action( 'wp_ajax_nopriv_tags', 'tags_callback' );

function tags_callback()
{
    $tags = get_terms( array(
        'orderby'     => 'name',
        'order'       => 'ASC',
        'taxonomy'    => 'product_tag',
        'pad_counts'  => 1
    ) );

    echo json_encode($tags);

    wp_die();
}