<?php
// Assurez-vous que l'objet $variation est défini.
if ( ! isset( $variation ) || ! $variation instanceof WC_Product_Variation ) {
	return;
}

// Obtenez les informations nécessaires de la variation
$variation_id = $variation->get_id();
$image_url = wp_get_attachment_url($variation->get_image_id());
$product_id = $variation->get_parent_id();
$product = wc_get_product($product_id);
$variation_attributes = $variation->get_variation_attributes();
$product_url = get_permalink($product_id);
$color_term_slug = $variation_attributes['attribute_pa_coloris'];
$color_term = get_term_by('slug', $color_term_slug, 'pa_coloris');
?>

<div class="variation-item w-[47%] lg:w-[31%] my-4">
	<?php if ( $image_url ): ?>
    <a href="<?php echo esc_url($product_url); ?>" class="product-link">
        <div class="bg-cover bg-no-repeat bg-center w-full h-[33vw] lg:h-[27vw] 2xl:h-[22vw] block rounded-xl" style="background-image: url('<?php echo esc_url($image_url); ?>');"></div>
    </a>
	<?php endif; ?>
    <div class="flex flex-row justify-between w-full">
        <div class="flex flex-col justify-between">
            <h2 class="variation-product-title font-title text-l lg:text-xl2 2xl:text-xl4 font-regular text-black uppercase"><?php if (!empty(get_field('main_title'))) { echo get_field('main_title'); } ?></h2>
	        <?php
	        if ($color_term) {
		        $primary_color = get_field('primary_color', $color_term);
		        $secondary_color = get_field('secondary_color', $color_term);
                ?>
                <p class="variations-colors font-sans text-xs font-light text-black">
                    <span class="variations-colors-text"><?= $variation_attributes['attribute_pa_coloris']; ?></span>
                    <?php
                    if (!empty($primary_color) && !empty($secondary_color)) {
	                    echo '<span class="variation-dual-color inline-block w-[10px] h-[10px] border-2 rounded-full" style="background-color: ' . $primary_color . '; border-color: '. $secondary_color .';"></span>';
                    }
                    if (!empty($primary_color) && empty($secondary_color)) {
	                    echo '<span class="variation-single-color inline-block w-[10px] h-[10px] border-2 rounded-full" style="background-color: '. $primary_color .';"></span>';
                    }
                    ?>
                </p>
	        <?php } ?>
        </div>
        <div class="flex flex-col justify-end py-1.5">
            <a href="<?php echo esc_url($product_url); ?>" class="product-link hidden lg:block font-sans text-xs font-thin text-white bg-black rounded-full border border-black text-center p-1 transition-colors duration-300 ease-in-out hover:bg-white hover:text-black">Découvrir</a>
	        <?php
	        if ($variation->is_in_stock()) {
                ?>
		        <button class="add-to-cart-button transition-colors duration-300 ease-in-out group lg:py-0.5 lg:px-3.5 lg:rounded-full lg:bg-white lg:border lg:border-black lg:mt-2 lg:hover:bg-black" data-variation_id="<?= esc_attr($variation_id) ?>" data-quantity="1">
                    <span class="hidden lg:inline-block lg:font-sans lg:text-xs lg:font-thin lg:text-black lg:align-[2px] lg:group-hover:text-white">Ajouter au panier</span>
                    <img class="w-[18px] lg:inline-block lg:w-[13px] h-auto lg:align-[1px] lg:ml-2 lg:group-hover:hidden" src="<?= get_stylesheet_directory_uri() ?>/assets/images/icons/cart-icon-black.svg" alt="icone du panier">
                    <img class="w-[18px] hidden lg:w-[13px] h-auto lg:align-[1px] lg:ml-2 lg:group-hover:inline-block" src="<?= get_stylesheet_directory_uri() ?>/assets/images/icons/cart-icon-white.svg" alt="icone du panier">
                </button>
                <?php
	        }
	        ?>
        </div>
    </div>
</div>
