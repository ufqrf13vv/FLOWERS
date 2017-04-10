<?php get_header(); ?>

<!-- Главный слайдер -->
<!--<div class="main-slider">-->
<!--	--><?php //echo do_shortcode('[smartslider3 slider=2]');	?>
<!--</div>-->

<!-- Описание -->
<div class="description" id="product">
	<div class="container">
		<div class="description__wrapper">
			<div class="description__block">
				<div class="description__header">
					<div class="description__logo"><img src="<?php echo get_template_directory_uri(); ?>/img/bksblue-logo.png"></div>
					<div class="description__title"><?php echo get_cat_name(2); ?></div>
				</div>
				<div class="description__features">
					<?php
					if ( have_posts() ) :
						query_posts('cat=2&order=ASC');
						while (have_posts()) : the_post(); ?>
						<div class="description__feature">
							<div class="description__feature-icon">
								<?php echo get_the_post_thumbnail( null ); ?>
							</div>
							<div class="description__feature-text"><?php the_content(); ?></div>
						</div>
						<?php endwhile;
							endif;
							wp_reset_query(); ?>
				</div>
				<div class="description__subtitle"> <span>Подходит для:</span></div>
				<div class="description__examples">
					<?php
						$upload_dir = wp_upload_dir();

						$query = 'select id, name, preview_image from wp_bwg_gallery';
						$result = $wpdb->get_results($query);

						for ($i = 0; $i < 4; $i++) { ?>
							<div class="description__example">
								<div class="description__example-image">
									<img src="<?php echo $upload_dir['baseurl']; ?>/photo-gallery<?php echo $result[$i]->preview_image; ?>">
								</div>
								<div class="description__example-title"><?php echo $result[$i]->name; ?></div>
								<?php $nonce = wp_create_nonce("my_user_vote_nonce"); ?>
								<a class="description__example-link" href="" data-nonce="<?php echo $nonce; ?>" data-gallery_id="<?php echo $result[$i]->id; ?>">Посмотреть</a>
							</div>
					<?php
						}
					?>
				</div>
				<a class="description__cost" href="#">Рассчитать стоимость</a>
			</div>
			<div class="description__block">
				<div class="description__header">
					<div class="description__logo"><img src="<?php echo get_template_directory_uri(); ?>/img/jokko-logo.png"></div>
					<div class="description__title"><?php echo get_cat_name(3); ?></div>
				</div>
				<div class="description__features">
					<?php
					if ( have_posts() ) :
						query_posts('cat=3&order=ASC');
						while (have_posts()) : the_post(); ?>
							<div class="description__feature">
								<div class="description__feature-icon">
									<?php echo get_the_post_thumbnail( null ); ?>
								</div>
								<div class="description__feature-text"><?php the_content(); ?></div>
							</div>
						<?php endwhile;
					endif;
					wp_reset_query(); ?>
				</div>
				<div class="description__subtitle"> <span>Подходит для:</span></div>
				<div class="description__examples">
				<?php
						for ($i = 4; $i < 8; $i++) { ?>
							<div class="description__example">
								<div class="description__example-image">
									<img src="<?php echo $upload_dir['baseurl']; ?>/photo-gallery<?php echo $result[$i]->preview_image; ?>">
								</div>
								<div class="description__example-title"><?php echo $result[$i]->name; ?></div>
								<?php $nonce = wp_create_nonce("my_user_vote_nonce"); ?>
								<a class="description__example-link" href="" data-nonce="<?php echo $nonce; ?>" data-gallery_id="<?php echo $result[$i]->id; ?>">Посмотреть</a>
							</div>
					<?php
						}
					?>
				</div>
				<a class="description__cost" href="#">Рассчитать стоимость</a>
			</div>
		</div>
	</div>
</div>

<!-- Галерея -->
<?php echo do_shortcode('[gallery-slider]');	?>

<div class="about-company" id="company">
	<div class="container">
		<div class="about-company__wrapper">
			<?php $posts = get_posts(array(
					'category' => 1,
					'post_type' => 'post'
				));
				foreach ($posts as $post) { ?>
					<div class="about-company__image">
						<?php the_post_thumbnail(); ?>
					</div>
					<div class="about-company__block">
						<?php echo $post->post_content; ?>
					</div>
				<?php
				}
				?>
		</div>
	</div>
</div>

<!-- Отзывы -->
<?php //echo do_shortcode('[feedback-slider]'); ?>

<!-- Сертификаты -->
<?php //echo do_shortcode('[certificate-slider]'); ?>

<!-- Яндекс-карты -->
<?php //echo do_shortcode('[yandex-map]'); ?>

<?php get_footer(); ?>