<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<form role="search" method="get" class="woocommerce-product-search search" action="<?php echo esc_url( home_url( '/' ) ); ?>" autocomplete="off">
	<input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="search__input" value="<?php echo get_search_query(); ?>" name="s" />
	<input type="submit" value="" class="search__submit"/>
	<input type="hidden" name="post_type" value="product" class="search__submit" />
	<div class="search-list__wrapper">
		<ul class="search-list" id="search-list">
		</ul>
	</div>
</form>
