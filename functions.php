<?php
get_template_part( 'includes/gallery' );
get_template_part( 'includes/feedback' );
get_template_part( 'includes/shortcodes' );
get_template_part( 'includes/wc-functions' );
get_template_part( 'includes/helper' );
get_template_part( 'includes/filter' );

//  Стили
if(!is_admin()) {
    function styles() {
        wp_enqueue_style('normalize', 'https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css');
        wp_enqueue_style('slick-1', get_template_directory_uri() . '/slick/slick.css');
        wp_enqueue_style('slick-2', get_template_directory_uri() . '/slick/slick-theme.css');
        wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        wp_enqueue_style('main-style', get_template_directory_uri() . '/css/style.css');
    }

    add_action('wp_enqueue_scripts', 'styles');
}

//  Скрипты
if(!is_admin()) {
    function scripts() {
        wp_enqueue_script('normalize', get_template_directory_uri() . '/script/jquery-2.2.0.js');
        wp_enqueue_script('slick', get_template_directory_uri() . '/slick/slick.min.js');
        wp_enqueue_script('scripts', get_template_directory_uri() . '/script/scripts.js');
    }

    add_action('wp_enqueue_scripts', 'scripts');
}

//  Меню
register_nav_menus(array(
    'main-menu'    => 'Главное меню',
    'categories-menu' => 'Меню категорий'
));

//  Виджеты
if ( function_exists('register_sidebar') ) {
    register_sidebar(array(
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<span class="widgettitle">',
        'after_title' => '</span>',
    ));
}

// Миниатюры для всех типов постов
add_theme_support( 'post-thumbnails' );

//  Кастомные поля
add_action('carbon_register_fields', 'crb_register_custom_fields');
function crb_register_custom_fields() {
    include_once(dirname(__FILE__) . '/includes/custom-fields.php');
}

//  JS-переменные
add_action('wp_head','js_variables');

function js_variables(){
    $variables = array (
        'ajax_url' => admin_url('admin-ajax.php'),
        'is_mobile' => wp_is_mobile()
    );
    echo(
    '<script type="text/javascript">window.wp_data = '.
        json_encode($variables).';</script>'
    );
}

//  Удаление пустых <p></p>
remove_filter('the_content', 'wpautop');