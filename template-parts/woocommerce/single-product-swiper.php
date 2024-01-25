<?php
global $product;

$color_attributes = $product->get_attribute( 'coloris' ); // Assurez-vous que 'coloris' correspond à l'identifiant de l'attribut.
$color_terms = wc_get_product_terms( $product->get_id(), 'pa_coloris', array( 'fields' => 'all' ) );

?>
<div class="w-full lg:w-1/2 xl:w-3/5 h-[80vw] lg:h-80vh">
	<div thumbsSlider="" class="swiper mx-auto w-full h-[60%] py-2.5 px-2.5 swiperProductThumbs">
		<div class="swiper-wrapper">
            <div class="swiper-slide text-center flex justify-center items-center">
                <img src="<?php echo wp_get_attachment_url( $product->get_image_id() ); ?>" alt="<?php echo esc_attr( $product->get_title() ); ?>" class="block w-auto !h-full object-cover rounded-lg">
            </div>
			<?php
			foreach ( $color_terms as $color_term ) {
				$color_images = get_field( 'images_repeater', 'term_' . $color_term->term_id );

				if ( $color_images ) {
					foreach ( $color_images as $color_image ) {
						$image_id = $color_image['image'];
						$image_url = $color_image['image']['url'];
						echo '<div class="swiper-slide text-center flex justify-center items-center" data-color="' . esc_attr( $color_term->slug ) . '"><img class="block w-auto !h-full object-cover rounded-lg" src="' . esc_url( $image_url ) . '" alt="' . esc_attr( $color_term->name ) . '"></div>';
					}
				}
			}
			?>
		</div>
	</div>
	<div class="swiper mx-auto h-[40%] swiperProduct py-2.5 px-2.5 relative">
		<div class="swiper-wrapper">
            <div class="swiper-slide text-center flex justify-center items-center w-[25%] h-full opacity-40 bg-cover bg-no-repeat bg-center rounded-lg" style="background-image: url('<?php echo wp_get_attachment_url( $product->get_image_id() ); ?>');"></div>
			<?php
			foreach ( $color_terms as $color_term ) {
				$color_images = get_field( 'images_repeater', 'term_' . $color_term->term_id );

				if ( $color_images ) {
					foreach ( $color_images as $color_image ) {
						$image_id = $color_image['image'];
						$image_url = $color_image['image']['url'];
						echo '<div class="swiper-slide text-center flex justify-center items-center w-[25%] h-full opacity-40 bg-cover bg-no-repeat bg-center rounded-lg" style="background-image: url('. esc_url( $image_url ) .');"></div>';
					}
				}
			}
			?>
		</div>
        <div class="relative bottom-[60%] left-0 right-0 z-[20] w-full">
            <div class="swiper-navigation-hero w-full flex flex-row justify-between px-2">
                <div class="swiper-navigation-hero-prev bg-white p-2 rounded-full shadow-simple-25">
                    <img class="rotate-180" src="<?= get_stylesheet_directory_uri() ?>/assets/images/icons/arrow-right.svg" alt="">
                </div>
                <div class="swiper-navigation-hero-next bg-white p-2 rounded-full shadow-simple-25">
                    <img src="<?= get_stylesheet_directory_uri() ?>/assets/images/icons/arrow-right.svg" alt="">
                </div>
            </div>
        </div>
	</div>
</div>