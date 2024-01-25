<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 6.1.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

$variation_images = [];
foreach ( $product->get_children() as $child_id ) {
	$variation = wc_get_product( $child_id );
	$image_id = $variation->get_image_id();
	$image_url = wp_get_attachment_image_url( $image_id, 'thumbnail' );
	$variation_images[$child_id] = $image_url;
}

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
		<?php do_action( 'woocommerce_before_variations_form' ); ?>

		<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
			<p class="stock out-of-stock"><?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'woocommerce' ) ) ); ?></p>
		<?php else : ?>
			<table class="variations w-full" cellspacing="0" role="presentation">
				<tbody>
				<?php foreach ( $attributes as $attribute_name => $options ) : ?>
					<tr class="flex flex-col w-full">
						<th class="label text-left mb-2">
                            <h2 class="font-sans text-black text-sm block"><span class="font-black text-sm mr-2"><?php echo wc_attribute_label( $attribute_name ); ?> :</span><span class="selected-color font-light text-sm"></span></h2>
                        </th>
						<td class="value">
							<?php if ( $attribute_name === 'pa_coloris' ) : ?>
                            <div class="colors flex flex-row flex-wrap justify-start">
								<?php foreach ( $options as $option ) : ?><?php
									$term = get_term_by('slug', $option, $attribute_name);
									$radio_id = 'variation-' . $attribute_name . '-' . $option;
									$image_id = get_term_meta($term->term_id, 'image', true);
									$primary_color = get_field('primary_color', 'term_' . $term->term_id);
									$secondary_color = get_field('secondary_color', 'term_' . $term->term_id);
									foreach ( $available_variations as $variation ) {
										if ( in_array( $option, $variation['attributes'] ) ) {
											$variation_id = $variation['variation_id'];
											$image_url = $variation_images[$variation_id];
										}
									}
									?>
									<label for="<?php echo esc_attr( $radio_id ); ?>" class="radio-label inline-block transition-shadow duration-300 ease-in-out w-[70px] h-[70px] mr-[4%] mb-2 relative rounded-[0.8rem] overflow-hidden bg-cover bg-center bg-no-repeat" style="background-image: url('<?php echo esc_url( $image_url ); ?>');">
										<input class="variation-color" type="radio" id="<?php echo esc_attr( $radio_id ); ?>" name="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>" value="<?php echo esc_attr( $option ); ?>" data-attribute_name="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>">
										<span class="color-indicator block absolute bottom-0 left-0 right-0 h-[12px]" style="height: 10px; background-color: <?php echo esc_attr( $primary_color ); ?>; border-top: 3px solid <?php echo esc_attr( $secondary_color ); ?>;"></span>
									</label>
								<?php endforeach; ?>
								<?php if ( get_field('matieres') ): ?>
                                    <div class="product-materials my-4 lg:w-full">
                                        <h2 class="font-sans text-black font-black text-sm block">Matières :</h2>
                                        <div class="font-sans text-black text-xs font-light block">
											<?php the_field('matieres'); ?>
                                        </div>
                                    </div>
								<?php endif; ?>
                            </div>
							<?php endif; ?>
							<?php if ( $attribute_name === 'pa_dimensions' ) : ?>
								<div class="sizes flex flex-row-reverse justify-end">
									<?php foreach ( $options as $option ) : ?>
										<?php
										$term = get_term_by( 'slug', $option, $attribute_name );
										$radio_id = 'variation-' . $attribute_name . '-' . $option;
										?>
										<label for="<?php echo esc_attr( $radio_id ); ?>" class="radio-label size-label bg-light-grey px-3.5 py-1 shadow-narrow-25 relative mr-4 rounded-lg font-sans text-xs font-light text-black opacity-50">
											<input class="variation-dimension" type="radio" id="<?php echo esc_attr( $radio_id ); ?>" name="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>" value="<?php echo esc_attr( $option ); ?>" data-attribute_name="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>">
											<span class="size-indicator">Taille </span><span class="font-bold"><?php echo esc_html($term->name); ?></span>
										</label>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>

            <label for="attribute_pa_coloris" class="hidden">Coloris</label>
            <input type="hidden" name="attribute_pa_coloris" value="">
            <label for="attribute_pa_dimensions" class="hidden">Dimensions</label>
            <input type="hidden" name="attribute_pa_dimensions" value="">

            <div class="mt-8 mb-4">
                <p class="shipping-info">
                    <img class="inline-block mr-2" src="<?= get_stylesheet_directory_uri() ?>/assets/images/icons/delivery-icon.png" alt="">
                    <span class="inline-block font-sans text-xs font-medium text-black underline">Frais d'expédition gratuits en France</span>
                </p>
                <p class="shipping-note font-sans text-black text-xxs uppercase font-light leading-4">NOTE*** FOR INTERNATIONAL SHIPMENTS ONLY – COST WILL BE CALCULATED AND BILLED AFTER PURCHASE.</p>
            </div>

			<?php do_action( 'woocommerce_after_variations_table' ); ?>

			<div class="single_variation_wrap">
				<?php
				/**
				 * Hook: woocommerce_before_single_variation.
				 */
				do_action( 'woocommerce_before_single_variation' );

				/**
				 * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
				 *
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
				do_action( 'woocommerce_single_variation' );

				/**
				 * Hook: woocommerce_after_single_variation.
				 */
				do_action( 'woocommerce_after_single_variation' );
				?>
			</div>
		<?php endif; ?>

		<?php do_action( 'woocommerce_after_variations_form' ); ?>
	</form>
<?php
do_action( 'woocommerce_after_add_to_cart_form' );

