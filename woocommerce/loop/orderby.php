<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<form class="catalog__filters" id="form_filter">
	<div class="catalog__filter">
		<div class="catalog__filter-title">По цене</div>
		<div class="catalog__filter-block">
			<label class="catalog__filter-label">От</label>
			<input class="catalog__filter-input" type="text" name="price-from">
		</div>
		<div class="catalog__filter-block">
			<label class="catalog__filter-label">До</label>
			<input class="catalog__filter-input" type="text" name="price-to">
		</div>
	</div>
	<div class="catalog__filter">
		<div class="catalog__filter-title">По цветам</div>
		<span class="fa fa-angle-double-down catalog__filter-arrow"></span>
		<div class="catalog__filter-list-wrapper catalog__filter-list-wrapper--colors">
			<ul class="catalog__filter-list">
				<?php
				$tags = get_terms( array(
					'orderby'     => 'name',
					'order'       => 'ASC',
					'taxonomy'    => 'product_tag',
					'pad_counts'  => 1
				) );
				foreach ($tags as $tag) { ?>
					<li>
					<input class="catalog__filter-check" type="checkbox" name="<?php echo $tag->slug; ?>" id="<?php echo $tag->slug; ?>" value="<?php echo $tag->name; ?>">
					<label class="catalog__filter-label catalog__filter-label--check catalog__filter-label--check-1" for="<?php echo $tag->slug; ?>"><?php echo $tag->name; ?></label>
				</li>
				<?php
				} ?>
				<span class="catalog__filter-list_triangle"></span>
			</ul>
		</div>
	</div>
	<div class="catalog__filter">
		<div class="catalog__filter-title">Сортировать:</div>
		<span class="catalog__filter-sort">По возрастанию цены</span>
		<span class="fa fa-angle-double-down catalog__filter-arrow"></span>
		<div class="catalog__filter-list-wrapper">
			<ul class="catalog__filter-list">
				<li>
					<input class="catalog__filter-check" type="radio" name="sort" id="asc" value="ASC" checked>
					<label class="catalog__filter-label catalog__filter-label--check catalog__filter-label--check-1" for="asc">По возрастанию цены</label>
				</li>
				<li>
					<input class="catalog__filter-check" type="radio" name="sort" id="desc" value="DESC">
					<label class="catalog__filter-label catalog__filter-label--check catalog__filter-label--check-1" for="desc">По убыванию цены</label>
				</li>
				<li>
					<input class="catalog__filter-check" type="radio" name="sort" id="popular" value="popular">
					<label class="catalog__filter-label catalog__filter-label--check catalog__filter-label--check-1" for="popular">По популярности</label>
				</li>
				<li>
					<input class="catalog__filter-check" type="radio" name="sort" id="new" value="new">
					<label class="catalog__filter-label catalog__filter-label--check catalog__filter-label--check-1" for="new">По новинкам</label>
				</li>
				<li>
					<input class="catalog__filter-check" type="radio" name="sort" id="sale" value="sale">
					<label class="catalog__filter-label catalog__filter-label--check catalog__filter-label--check-1" for="sale">По скидкам</label>
				</li>
				<span class="catalog__filter-list_triangle"></span>
			</ul>
		</div>
	</div>
	<div class="catalog__filter">
		<div class="catalog__filter-title">Количество показанных товаров:
			<input class="catalog__filter-check" type="radio" id="check-15" name="count" value="15" checked>
			<label class="catalog__filter-label catalog__filter-label--check" for="check-15">15</label>
			<input class="catalog__filter-check" type="radio" id="check-30" name="count">
			<label class="catalog__filter-label catalog__filter-label--check" for="check-30" value="30">30</label>
			<input class="catalog__filter-check" type="radio" id="check-50" name="count">
			<label class="catalog__filter-label catalog__filter-label--check" for="check-50" value="50">50</label>
		</div>
	</div>
	<input type="hidden" name="category-id" value="<?php echo get_queried_object()->term_id; ?>">
</form>
