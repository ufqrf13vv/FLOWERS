<?php
//  Выбор картинок из галереи
add_action( 'wp_ajax_my_action', 'my_action_callback' );
add_action( 'wp_ajax_nopriv_my_action', 'my_action_callback' );

function my_action_callback(){
    global $wpdb;
    $id = $_REQUEST['ID'];
    $path = wp_upload_dir();

    $query = "SELECT image_url, 
                description, 
                alt, 
                filetype, 
                slug
                FROM wp_bwg_image
                WHERE published = 1 AND gallery_id = $id";

    $result = $wpdb->get_results($query);

    foreach ($result as $item) { ?>
        <div class="gallery__popup-slide">
            <?php
            switch ($item->filetype) {
                case 'EMBED_OEMBED_YOUTUBE_VIDEO': ?>
                    <div class="gallery__popup-image">
                        <?php
                        $baseLink = explode('/', $item->image_url);
                        $position = strrpos($baseLink[3], '=');
                        $subLink = substr($baseLink[3], $position + 1);
                        $link = $baseLink[0] . '//' . $baseLink[2] . '/embed/' . $subLink;
//                        var_dump($link);
                            ?>
                        <iframe width="100%" height="300" src="<?php echo $link; ?>" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <?php
//                  Заголовок
                    if($item->slug) { ?>
                        <div class="gallery__popup-title">
                            <?php echo $item->slug; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
//                  Описание
                    if($item->description) { ?>
                        <div class="gallery__popup-desc">
                            <?php echo $item->description; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    break;
                default:
                    $link = $path['baseurl'] . '/photo-gallery' . $item->image_url;
                    ?>
                    <div class="gallery__popup-image" style="background: url('<?php echo $link; ?>') no-repeat 50% 50%; background-size: cover;">
                    </div>
                    <?php
//                  Заголовок
                    if($item->slug) { ?>
                        <div class="gallery__popup-title">
                            <?php echo $item->slug; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
//                  Описание
                    if($item->description) { ?>
                        <div class="gallery__popup-desc">
                            <?php echo $item->description; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
            }
            ?>
        </div>
        <?php
    }

    wp_die();
}
?>