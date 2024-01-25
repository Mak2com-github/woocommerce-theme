<?php
get_header();
?>

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
	<div class="flex flex-row flex-wrap justify-center lg:p-8 2xl:p-20">
		<?php
		$categories = get_terms('product_cat', array(
			'hide_empty' => true,
		));

		foreach ($categories as $category) {
            $category_id = $category->term_id;
            $thumbnail_id = get_term_meta($category_id, 'thumbnail_id', true);
            $image_url = wp_get_attachment_url($thumbnail_id);
            echo '<div class="category-block group w-[350px] lg:w-[300px] xl:w-[380px] 2xl:w-[430px] h-[350px] lg:h-[300px] xl:h-[380px] 2xl:h-[430px] m-4 rounded-xl overflow-hidden shadow-simple-25 bg-cover bg-no-repeat bg-center relative before:content-[\'\'] before:absolute before:inset-0 before:bg-dark-opacity" style="background-image: url('. $image_url .')">';
                echo '<div class="h-full w-full flex flex-col justify-center relative z-[3]">';
                    echo '<h2 class="font-sans text-white text-center text-xl5 2xl:text-xl6 font-bold uppercase leading-10">' . $category->name . '</h2>';
                    echo '<a href="' . get_term_link($category) . '" class="block overflow-hidden relative font-sans text-white group-hover:text-black transition-colors duration-300 ease-in-out text-center font-thin leading-5 text-xs px-8 py-1 bg-black w-fit mt-12 mx-auto rounded-full before:content-[\'\'] before:absolute before:inset-0 before:bg-white before:z-[2] before:transition-transform before:duration-300 before:ease-in-out before:rounded-full before:translate-x-[-101%] group-hover:before:translate-x-0"><span class="relative z-[3]">Découvrir</span></a>';
                echo '</div>';
            echo '</div>';
		}
		?>
	</div>
</div>

<?php
get_footer();