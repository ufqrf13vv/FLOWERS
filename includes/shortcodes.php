<?php

//  Слайдер галереи
function gallery_slider()
{ ?>

    <div class="container">
        <div class="gallery__title">Описание систем</div>
        <div class="gallery__wrap">
            <div class="gallery" id="bks">
                <?php
                $args = array(
                    'numberposts' => -1,
                    'category' => 9,
                    'post_type' => 'post',
                    'order' => 'ASC'
                );
                $posts = get_posts($args);

                foreach ($posts as $post) {
                    $meta = get_post_meta($post->ID); ?>

                    <?php switch ($meta['_crb_type'][0]) {
                        case 'video': ?>
                            <div class="gallery__item">
                                <iframe width="100%" height="190" src="<?php echo $meta['_crb_video'][0]; ?>"
                                        frameborder="0" allowfullscreen></iframe>
                            </div>
                            <?php break;
                        case 'image': ?>
                            <div class="gallery__item">
                                <?php echo $post->post_content; ?>
                            </div>
                            <?php break;
                    } ?>
                <?php } ?>
            </div>
            <div class="gallery" id="jokke">
                <?php
                $args = array(
                    'numberposts' => -1,
                    'category' => 11,
                    'post_type' => 'post',
                    'order' => 'ASC'
                );
                $posts = get_posts($args);

                foreach ($posts as $post) {
                    $meta = get_post_meta($post->ID); ?>

                    <?php switch ($meta['_crb_type'][0]) {
                        case 'video': ?>
                            <div class="gallery__item">
                                <iframe width="100%" height="190" src="<?php echo $meta['_crb_video'][0]; ?>"
                                        frameborder="0" allowfullscreen></iframe>
                            </div>
                            <?php break;
                        case 'image': ?>
                            <div class="gallery__item">
                                <?php echo $post->post_content; ?>
                            </div>
                            <?php break;
                    } ?>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php
}

add_shortcode('gallery-slider', 'gallery_slider');

//  Слайдер отзывов
function feedback_slider()
{ ?>
    <div class="feedbacks">
        <div class="feedbacks__title"><?php echo get_cat_name(8); ?></div>
        <div class="container">
            <div class="feedback__wrapper">
                <?php
                $args = array(
                    'numberposts' => -1,
                    'category' => 8,
                    'post_type' => 'post',
                    'order' => 'ASC'
                );
                $posts = get_posts($args);

                foreach ($posts as $post) {
                    $meta = get_post_meta($post->ID);

                    switch ($meta['_crb_type'][0]) {
                        case 'video': ?>
                            <div class="feedback">
                                <div class="feedback__block">
                                    <iframe width="100%" height="190" src="<?php echo $meta['_crb_video'][0]; ?>"
                                            frameborder="0" allowfullscreen></iframe>
                                    <div class="feedback__sign"><?php echo $meta['_crb_order'][0]; ?></div>
                                </div>
                            </div>
                            <?php break;
                        case 'image': ?>
                            <div class="feedback">
                                <div class="feedback__block">
                                    <div class="feedback__image">
                                        <?php echo $post->post_content; ?>
                                    </div>
                                    <div class="feedback__sign"><?php echo $meta['_crb_order'][0]; ?></div>
                                </div>
                            </div>
                            <?php break;
                        case 'feedback': ?>
                            <div class="feedback">
                                <div class="feedback__block">
                                    <div class="feedback__desc">
                                        <div class="feedback__title"><?php echo $meta['_crb_author'][0]; ?></div>
                                        <div
                                            class="feedback__subtitle"><?php echo $meta['_crb_author-post'][0]; ?></div>
                                        <div class="feedback__text">
                                            <?php echo $post->post_content; ?>
                                        </div>
                                        <?php $nonce = wp_create_nonce("my_user_vote_nonce"); ?>
                                        <a class="feedback__readmore" href="" data-id="<?php echo $post->ID; ?>"
                                           data-nonce="<?php echo $nonce; ?>">Читать далее...</a>
                                    </div>
                                    <div class="feedback__sign"><?php echo $meta['_crb_order'][0]; ?></div>
                                </div>
                            </div>
                            <?php break;
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <?php
}

add_shortcode('feedback-slider', 'feedback_slider');

//  Слайдер сертификатов
function certificate_slider()
{ ?>
    <?php
    $args = array(
        'numberposts' => -1,
        'category' => 10,
        'post_type' => 'post',
        'order' => 'ASC'
    );
    $posts = get_posts($args); ?>

    <div class="certificates" id="certificate">
        <div class="container">
            <div class="certificates__title"><?php echo get_cat_name(10); ?></div>
            <div class="certificates__wrapper">
                <?php
                foreach ($posts as $post) { ?>
                    <div class="certificates__item">
                        <?php echo $post->post_content; ?>
                    </div>
                <?php }
                ?>
            </div>
        </div>
    </div>
    <?php
}

add_shortcode('certificate-slider', 'certificate_slider');

//  Yandex-карта
function map()
{ ?>
    <div class="map" id="contacts">
        <script type="text/javascript" charset="utf-8" async
                src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=ddSydUPuw8NcdWCsNQw4SOJUQYBaRbyS&amp;width=100%25&amp;height=570&amp;lang=ru_RU&amp;sourceType=constructor&amp;scroll=true"></script>
        <div class="container">
            <div class="map__contacts">
                <div class="map__contacts-title">Офис</div>
                <div class="map__contacts-adress"><?php echo get_option('crb_adress'); ?></div>
                <div class="map__contacts-phone"><?php echo get_option('crb_phone'); ?></div>
                <div class="map__contacts-email"><?php echo get_option('crb_email'); ?></div>
                <div class="map__triangle"></div>
            </div>
            <div class="map__wrapper">
                <div class="ask-cost">
                    <div class="ask-cost__title"><?php echo get_the_title(75) ?></div>
                    <?php echo do_shortcode('[contact-form-7 id="75"]'); ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}

add_shortcode('yandex-map', 'map');

//  Описание проектов
function description()
{
    global $wpdb;
    ?>
    <div class="description" id="product">
        <div class="container">
            <div class="description__wrapper">
<!--                <div class="description__block">-->
<!--                    <div class="description__header">-->
<!--                        <div class="description__logo"><img-->
<!--                                src="--><?php //echo get_template_directory_uri(); ?><!--/img/bksblue-logo.png"></div>-->
<!--                        <div class="description__title">--><?php //echo get_cat_name(2); ?><!--</div>-->
<!--                    </div>-->
<!--                    <div class="description__features">-->
<!--                        --><?php
//                        if (have_posts()) :
//                            query_posts('cat=2&order=ASC');
//                            while (have_posts()) : the_post(); ?>
<!--                                <div class="description__feature">-->
<!--                                    <div class="description__feature-icon">-->
<!--                                        --><?php //echo get_the_post_thumbnail(null); ?>
<!--                                    </div>-->
<!--                                    <div class="description__feature-text">--><?php //the_content(); ?><!--</div>-->
<!--                                </div>-->
<!--                            --><?php //endwhile;
//                        endif;
//                        wp_reset_query(); ?>
<!--                    </div>-->
<!--                    <div class="description__subtitle"><span>Подходит для:</span></div>-->
<!--                    <div class="description__examples">-->
<!--                        --><?php
//                        $upload_dir = wp_upload_dir();
//
//                        $query = 'select id, name, preview_image from wp_bwg_gallery';
//                        $result = $wpdb->get_results($query);
//
//                        for ($i = 0; $i < 4; $i++) { ?>
<!--                            <div class="description__example">-->
<!--                                <div class="description__example-image">-->
<!--                                    <img-->
<!--                                        src="--><?php //echo $upload_dir['baseurl']; ?><!--/photo-gallery--><?php //echo $result[$i]->preview_image; ?><!--">-->
<!--                                </div>-->
<!--                                <div class="description__example-title">--><?php //echo $result[$i]->name; ?><!--</div>-->
<!--                                --><?php //$nonce = wp_create_nonce("my_user_vote_nonce"); ?>
<!--                                <a class="description__example-link" href="" data-nonce="--><?php //echo $nonce; ?><!--"-->
<!--                                   data-gallery_id="--><?php //echo $result[$i]->id; ?><!--">Посмотреть</a>-->
<!--                            </div>-->
<!--                            --><?php
//                        }
//                        ?>
<!--                    </div>-->
<!--                    <a class="description__cost" href="#">Рассчитать стоимость</a>-->
<!--                </div>-->
<!--                <div class="description__block">-->
<!--                    <div class="description__header">-->
<!--                        <div class="description__logo"><img-->
<!--                                src="--><?php //echo get_template_directory_uri(); ?><!--/img/jokko-logo.png"></div>-->
<!--                        <div class="description__title">--><?php //echo get_cat_name(3); ?><!--</div>-->
<!--                    </div>-->
<!--                    <div class="description__features">-->
<!--                        --><?php
//                        if (have_posts()) :
//                            query_posts('cat=3&order=ASC');
//                            while (have_posts()) : the_post(); ?>
<!--                                <div class="description__feature">-->
<!--                                    <div class="description__feature-icon">-->
<!--                                        --><?php //echo get_the_post_thumbnail(null); ?>
<!--                                    </div>-->
<!--                                    <div class="description__feature-text">--><?php //the_content(); ?><!--</div>-->
<!--                                </div>-->
<!--                            --><?php //endwhile;
//                        endif;
//                        wp_reset_query(); ?>
<!--                    </div>-->
<!--                    <div class="description__subtitle"><span>Подходит для:</span></div>-->
<!--                    <div class="description__examples">-->
<!--                        --><?php
//                        for ($i = 4; $i < 8; $i++) { ?>
<!--                            <div class="description__example">-->
<!--                                <div class="description__example-image">-->
<!--                                    <img-->
<!--                                        src="--><?php //echo $upload_dir['baseurl']; ?><!--/photo-gallery--><?php //echo $result[$i]->preview_image; ?><!--">-->
<!--                                </div>-->
<!--                                <div class="description__example-title">--><?php //echo $result[$i]->name; ?><!--</div>-->
<!--                                --><?php //$nonce = wp_create_nonce("my_user_vote_nonce"); ?>
<!--                                <a class="description__example-link" href="" data-nonce="--><?php //echo $nonce; ?><!--"-->
<!--                                   data-gallery_id="--><?php //echo $result[$i]->id; ?><!--">Посмотреть</a>-->
<!--                            </div>-->
<!--                            --><?php
//                        }
//                        ?>
<!--                    </div>-->
<!--                    <a class="description__cost" href="#">Рассчитать стоимость</a>-->
<!--                </div>-->
            </div>
        </div>
    </div>
    <?php
}

add_shortcode('description', 'description');