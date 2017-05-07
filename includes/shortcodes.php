<?php

//  Слайдер новостей
    function news_slider()
    {
        $args = array(
            'numberposts' => -1,
            'category' => 26,
            'post_type' => 'post',
            'order' => 'ASC'
        );
        $posts = get_posts($args); ?>

        <div class="news">
            <div class="container">
                <h3 class="news__header"><?php echo get_cat_name(26); ?></h3>
                <div class="news__wrapper">
                    <?php
                    foreach ($posts as $post) { ?>
                        <div class="news__item">
                            <div class="news__item-wrapper">
                                <div class="news__item-image"><?php the_post_thumbnail('full'); ?></div>
                                <div class="news__item-description">
                                    <div class="news__item-title">
                                        <span><?php echo $post->post_title; ?></span>
                                    </div>
                                    <div class="news__item-text"><?php echo $post->post_content; ?></div>
                                    <a class="news__item-more" href="#">Подробнее</a>
                                </div>
                            </div>
                        </div>
                    <?php }
                    ?>
                </div>
            </div>
        </div>
        <?php
    }

add_shortcode('news-slider', 'news_slider');

//  Контактные данные магазинов
    function shops_contacts()
    {
        $args = array(
            'numberposts' => -1,
            'category' => 27,
            'post_type' => 'post',
            'order' => 'ASC'
        );
        $posts = get_posts($args); ?>

        <div class="contacts__wrapper">
        <?php
        foreach ($posts as $post) {
            $meta = get_post_meta($post->ID); ?>

            <div class="contacts__item">
                <div class="contacts__title">
                    <?php echo $post->post_title; ?>
                    <span class="fa fa-angle-double-down contacts__arrow"></span>
                </div>
                <div class="contacts__item-wrap">
                    <div class="contacts__map"><?php echo $post->post_content; ?></div>
                    <div class="contacts__description">
                        <ul class="contacts__list">
                            <li class="contacts__li contacts__li--adress"><?php echo $meta['_crb_contact-adress'][0]; ?></li>
                            <li class="contacts__li contacts__li--tel"><?php echo $meta['_crb_contact-phone'][0]; ?></li>
                            <li class="contacts__li contacts__li--email"><?php echo $meta['_crb_contact-email'][0]; ?></li>
                        </ul>
                        <button class="contacts__hide">Скрыть<span class="fa fa-angle-double-up contacts__arrow"></span></button>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        </div>
    <?php
    }

add_shortcode('shops', 'shops_contacts');

//  Слайдер отзывов
    function feedbacks_slider()
    {
        $args = array(
            'numberposts' => -1,
            'post_status' => 'publish',
            'post_type' => 'wpm-testimonial',
            'order' => 'ASC'
        );

        $posts = get_posts($args); ?>

        <div class="feedbacks">
            <div class="container">
                <div class="feedbacks__slider">
                <?php
                foreach ($posts as $post) {
                    $meta = get_post_meta($post->ID); ?>

                    <div class="feedbacks__item">
                        <div class="feedbacks__header">
                            <div class="feedbacks__header-wrap">
                                <div class="feedbacks__title"><?php echo $meta['client_name'][0]; ?></div>
                            </div>
                        </div>
                        <div class="feedbacks__text"><?php echo $post->post_content; ?>
                            <span class="feedbacks__date"><?php echo date_cut_time($post->post_date); ?></span>
                            <a class="feedbacks__readmore" href="" data-postID="<?php echo $post->ID; ?>">Читать далее</a>
                        </div>
                    </div>
                <?php
                }
                ?>
                </div>
            </div>
        </div>
<?php
    }

add_shortcode('feedbacks-slider', 'feedbacks_slider');