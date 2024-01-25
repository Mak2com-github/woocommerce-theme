<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form();
	return;
}
?>
<div id="product-<?php the_ID(); ?>" class="flex flex-col lg:flex-row justify-between xl:px-[10%]">
	<?php get_template_part('template-parts/woocommerce/single-product-swiper', $product); ?>

	<div class="w-full lg:w-1/2 xl:w-2/5 px-4">
		<h1 class="product-title font-title text-xl2 lg:text-xl6 text-black uppercase font-regular block"><?php if (!empty(get_field('main_title'))) { echo get_field('main_title'); } ?></h1>
		<div class="product-price font-title text-l lg:text-xl2 text-black font-regular leading-4 mb-4"><?php woocommerce_template_single_price(); ?></div>
		<?php woocommerce_variable_add_to_cart(); ?>
	</div>

</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
