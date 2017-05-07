<?php
//  Хлебные крошки
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
add_action( 'woocommerce_custom_before_main_content', 'custom_woocommerce_breadcrumb', 20 );
function custom_woocommerce_breadcrumb() {
    $args = wp_parse_args( $args, apply_filters( 'woocommerce_breadcrumb_defaults', array(
    'delimiter'   => '<span class="breadcrumbs__delimiter fa fa-angle-right"></span>',
    'wrap_before' => '<div class="breadcrumbs">
                            <div class="container">
                                <ul class="breadcrumbs__list">',
    'wrap_after'  => '          </ul>
                            </div>
                      </div>',
    'before'      => '<li class="breadcrumbs__item">',
    'after'       => '</li>',
    'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
    'class_link'  => 'class="breadcrumbs__link"'
    ) ) );

    $breadcrumbs = new WC_Breadcrumb();

    if ( ! empty( $args['home'] ) ) {
    $breadcrumbs->add_crumb( $args['home'], apply_filters( 'woocommerce_breadcrumb_home_url', home_url() ) );
    }

    $args['breadcrumb'] = $breadcrumbs->generate();

    do_action( 'custom_woocommerce_breadcrumb', $breadcrumbs, $args );

    wc_get_template( 'global/breadcrumb.php', $args );
}

//  Заголовок товара в категории
function woocommerce_template_loop_product_title() {
    $title_array = explode(' ', get_the_title());
    $title = '';

    foreach ($title_array as $id => $item) {
        if ($id == 0) {
            $title = $title . $item . '<br>';
        } else {
            $title = $title . ' ' . $item;
        }
    }

    echo '<div class="catalog__item-title">' . $title . '</div>';
}

function woocommerce_get_product_thumbnail( $size = 'shop_catalog', $deprecated1 = 0, $deprecated2 = 0 ) {
    global $post;
    $image_size = apply_filters( 'single_product_archive_thumbnail_size', $size );

    if ( has_post_thumbnail() ) {
        $thumb_id = get_post_thumbnail_id();
        $thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);
        echo '<img src="' . $thumb_url[0] . '" alt="' . $post->post_title . '">';
    } elseif ( wc_placeholder_img_src() ) {
        return wc_placeholder_img( $image_size );
    }
}

//
function cj_show_dimensions() {
    global $product;
    $dimensions = $product->get_dimensions();
    if ( ! empty( $dimensions ) ) {
        echo '<span class="dimensions">' . $dimensions . '</span>';
    }
}

add_action( 'woocommerce_after_shop_loop_item_title', 'cj_show_dimensions', 9 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

//function wc_add_to_cart_message( $products, $show_qty = false, $return = false ) {
//    $titles = array();
//    $count  = 0;
//
//    if ( ! is_array( $products ) ) {
//        $products = array( $products => 1 );
//        $show_qty = false;
//    }
//
//    if ( ! $show_qty ) {
//        $products = array_fill_keys( array_keys( $products ), 1 );
//    }
//
//    foreach ( $products as $product_id => $qty ) {
//        $titles[] = ( $qty > 1 ? absint( $qty ) . ' &times; ' : '' ) . sprintf( _x( '&ldquo;%s&rdquo;', 'Item name in quotes', 'woocommerce' ), strip_tags( get_the_title( $product_id ) ) );
//        $count += $qty;
//    }
//
//    $titles     = array_filter( $titles );
//    $added_text = sprintf( _n( '%s has been added to your cart.', '%s have been added to your cart.', $count, 'woocommerce' ), wc_format_list_of_items( $titles ) );
//
//    // Output success messages
//    if ( 'yes' === get_option( 'woocommerce_cart_redirect_after_add' ) ) {
//        $return_to = apply_filters( 'woocommerce_continue_shopping_redirect', wc_get_raw_referer() ? wp_validate_redirect( wc_get_raw_referer(), false ) : wc_get_page_permalink( 'shop' ) );
//        $message   = sprintf( '<a href="%s" class="button wc-forward">%s</a> %s', esc_url( $return_to ), esc_html__( 'Continue shopping', 'woocommerce' ), esc_html( $added_text ) );
//    } else {
//        $message   = sprintf( '<a href="%s" class="button wc-forward">Перейти в корзину</a> Ваш товар добавлен в корзину!', esc_url( wc_get_page_permalink( 'cart' ) ), esc_html__( 'View cart', 'woocommerce' ), esc_html( $added_text ) );
//    }
//
//    if ( has_filter( 'wc_add_to_cart_message' ) ) {
//        wc_deprecated_function( 'The wc_add_to_cart_message filter', '3.0', 'wc_add_to_cart_message_html' );
//        $message = apply_filters( 'wc_add_to_cart_message', $message, $product_id );
//    }
//
//    $message = apply_filters( 'wc_add_to_cart_message_html', $message, $products );
//
//    if ( $return ) {
//        return $message;
//    } else {
//        wc_add_notice( $message );
//    }
//}