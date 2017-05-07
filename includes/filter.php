<?php
add_action( 'wp_ajax_filter', 'filter_callback' );
add_action( 'wp_ajax_nopriv_filter', 'filter_callback' );

function filter_callback()
{

    $category_id = (int)$_REQUEST['cat_id'];

    if (isset($_REQUEST['price_from'])) {
        $price_from = $_REQUEST['price_from'];
    }

    if (isset($_REQUEST['price_to']) && $_REQUEST['price_to'] != '') {
        $price_to = $_REQUEST['price_to'];
    } else {
        $price_to = 10000;
    }

    if (isset($_REQUEST['count'])) {
        $count = $_REQUEST['count'];
    } else {
        $count = 15;
    }

    if (isset($_REQUEST['sort'])) {
        $sort = $_REQUEST['sort'];
        switch ($sort) {
//            По возрастанию цены
            case 'ASC':
                $sort = 'ASC';
                $orderby = '_price';
                $tax_query = '';
                break;
//            По убыванию цены
            case 'DESC':
                $sort = 'DESC';
                $orderby = '_price';
                $tax_query = '';
                break;
//            По популярности
            case 'popular':
                $sort = 'ASC';
                $orderby = '';
                $tax_query = array(
                    'taxonomy' => 'product_visibility',
                    'field' => 'name',
                    'terms' => 'featured',
                    'operator' => 'IN',
                );
                break;
//            По новинкам
            case 'new':
                $sort = 'DESC';
                $orderby = 'date';
                $tax_query = '';
                break;
//            По скидкам
            case 'sale':
                $sort = 'ASC';
                $orderby = '';
                $tax_query = '';
        }
    } else {
        $sort = 'ASC';
        $orderby = 'title';
        $tax_query = '';
    }

    $args = array(
        'posts_per_page' => $count,
        'meta_query' => array(
            array(
                'key' => '_price',
                'value' => array($price_from, $price_to),
                'type' => 'numeric',
                'compare' => 'BETWEEN'
            )
        ),
        'product_tag' => '',
        'post_type' => 'product',
        'order' => $sort,
        'orderby' => $orderby,
        'tax_query' => $tax_query
    );

    $products = new WP_Query($args);
    $i = 0;

    while ($products->have_posts()) {
        $products->the_post();
        $id = $products->posts[$i]->ID;
        $price = get_metadata('post', $id, '_price', true);
        ?>
        <div class="catalog__item">
            <a href="<?php the_permalink(); ?>">
                <div class="catalog__item-image">
                    <?php
                    $thumb_id = get_post_thumbnail_id();
                    $thumb_url = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
                    ?>
                    <img src="<?php echo $thumb_url[0]; ?>" alt="<?php the_title(); ?>">
                </div>
                <div class="catalog__item-title">
                    <?php the_title(); ?>
                </div>
                <div class="catalog__item-price">
                    <?php echo $price; ?>
                </div>
            </a>
            <div class="catalog__item-buttons">
                <a rel="nofollow" href="<?php echo get_category_link($category_id) . '?add-to-cart=' . $id; ?>"
                   data-quantity="1"
                   data-product_id="<?php echo $id ?>"
                   data-product_sku=""
                   class="button product_type_simple add_to_cart_button ajax_add_to_cart catalog__item-incart">В
                    корзину</a>
                <a href="javascript:void(0);" class="catalog__item-oneclick">Купить в 1 клик</a>
            </div>
        </div>
        <?php
        $i++;
    }

    global $wp_query;

    if ($wp_query->max_num_pages <= 1) {
        return;
    } else {
        echo paginate_links_custom(apply_filters('woocommerce_pagination_args', array(
            'base' => esc_url_raw(str_replace(999999999, '%#%', remove_query_arg('add-to-cart', get_pagenum_link(999999999, false)))),
            'format' => '',
            'add_args' => false,
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages,
            'prev_text' => '&larr;',
            'next_text' => '&rarr;',
            'type' => 'list',
            'end_size' => 3,
            'mid_size' => 3,
        )));
    }

    wp_die();
}