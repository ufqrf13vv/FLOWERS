<?php get_header(); ?>

	<!-- Главный слайдер -->
<?php
$products = new WP_Query( array(
	'tax_query' => array(
		'relation' => 'AND',
		array(
			'taxonomy' => 'pa_main-slider',
			'field'    => 'slug',
			'terms'    => 'in',
		),
		array(
			'taxonomy' => 'pa_slide',
			'field'    => 'slug',
			'terms'    => array( 'blue', 'pink', 'yellow' ),
			'operator' => 'IN',
		)
	),
	'post_type' => 'product',
	'posts_per_page' => -1
) );
?>

<div class="main-slider">

<?php
foreach ($products->posts as $post) { ?>
	<div class="main-slider__slide <?php echo bg_color($post->ID); ?>">
		<div class="container">
			<div class="main-slider__wrapper">
				<div class="main-slider__img">
				<?php
				$thumb_id = get_post_thumbnail_id();
				$thumb_url = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
				$price = get_metadata('post', $post->ID, '_price', true);
				$category = get_the_terms( $post->ID, 'product_cat' );
				?>
					<img src="<?php echo $thumb_url[0]; ?>" alt="<?php echo $post->post_title; ?>">
				</div>
				<div class="main-slider__description">
					<div class="main-slider__header"><?php echo $post->post_title; ?></div>
					<div class="main-slider__price"><?php echo $price; ?> РУБ.</div>
					<div class="main-slider__links">
						<a rel="nofollow" href="<?php echo get_category_link($category[0]->term_id) . '?add-to-cart=' . $post->ID; ?>"
						   data-quantity="1"
						   data-product_id="<?php echo $post->ID; ?>"
						   data-product_sku=""
						   class="button product_type_simple add_to_cart_button ajax_add_to_cart main-slider__link">В
							корзину</a>
						<a class="main-slider__link" href="javascript:void(0);">Купить в 1 клик</a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
}
?>

</div>

	<!-- Список категорий -->
	<div class="main-categories">
		<div class="container">
			<h3 class="main-categories__header">Ассортимент</h3>
			<div class="main-categories__wrapper">
				<?php
				$args = array(
					'taxonomy'     => 'product_cat',
					'orderby'      => 'name'
				);
				$categories = get_categories( $args);
				$i = 0;

				foreach ($categories as $category) :
					if($i == 0 || $i == 4) {
						echo '<div class="main-categories__row">';
					}
					?>
						<a class="main-categories__item" href="<?php echo get_term_link( (int)$category->term_id, 'product_cat' ); ?>">
							<div class="main-categories__img">
								<?php $category_thumbnail  = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );
								$image = wp_get_attachment_url($category_thumbnail);?>
								<img src="<?php echo $image; ?>" alt="<?php echo $category->name; ?>">
							</div>
							<div class="main-categories__title <?php echo title_class($category->description); ?>"><?php echo $category->name; ?></div>
						</a>
					<?php
					if($i == 3 || $i == 7) {
						echo '</div>';
					}
				$i++;
				endforeach;
				?>
			</div>
		</div>
	</div>


	<!-- Отзывы -->
	<?php echo do_shortcode('[feedbacks-slider]');	?>

<!-- Контент -->
	<main class="content content--main">
		<div class="container">
			<div class="content__block content__block--main">
				<div class="content__text">
					<?php $post = get_post(63); ?>
					<h2><?php echo $post->post_title; ?></h2>
					<p><?php echo $post->post_content; ?></p>
				</div>
				<?php the_post_thumbnail('full', array('class' => "content__img--right")); ?>
			</div>
		</div>
	</main>

<!-- Новости -->
<?php echo do_shortcode('[news-slider]');	?>

<?php get_footer(); ?>