<?php get_header(); ?>

<div class="mx-auto pt-16 lg:pt-28 pb-16">
    <div class="hero-container w-full h-[300px] bg-cover bg-center bg-no-repeat flex flex-col justify-center relative rounded-tr-3xl rounded-br-3xl lg:px-[15%]" style="background-image: url(<?= get_the_post_thumbnail_url() ?>);">
        <div class="absolute inset-0 bg-linear-gradient z-[1]"></div>
        <?php
        if (have_rows('hero_group', '15')) :
            while (have_rows('hero_group', '15')) : the_row();
                $text = get_sub_field('text_section');
                ?>
                <div class="hero-content w-4/5 lg:w-2/5 ml-4 mt-8 relative z-[2]">
                    <h1 class="font-title text-xl5 text-white font-bold leading-8 mb-4">Shop</h1>
                    <div class="font-sans text-sm text-white font-light">
                        <?= $text ?>
                    </div>
                </div>
            <?php
            endwhile;
        endif;
        ?>
    </div>
    <div class="products-grid px-4 my-8 2xl:px-[10%]">
        <?php
        if ( woocommerce_product_loop() ) {

            woocommerce_product_loop_start();

            while ( have_posts() ) : the_post();
                global $product;

                if ( $product->is_type( 'variable' ) ) {
                    $variations_ids = get_field('selected_variations', $product->get_id());

                    foreach ($variations_ids as $variation_id) {
                        $variation = wc_get_product($variation_id);

                        if ($variation) {
                            include(locate_template('woocommerce/content-variation.php'));
                        }
                    }
                }

            endwhile;

            woocommerce_product_loop_end();
        } else {
            echo '<p>Aucun articles trouvés</p>';
        }
        ?>
    </div>
</div>

<?php get_footer(); ?>