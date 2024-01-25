<?php
/*
 * Template Name: SGubert
 */
get_header();
?>
<div class="sgubert-page pt-16 lg:pt-28 pb-16">
    <div class="hero-container w-full h-[300px] bg-cover bg-center bg-no-repeat flex flex-col justify-center relative rounded-tr-3xl rounded-br-3xl lg:px-[15%]" style="background-image: url(<?= get_the_post_thumbnail_url() ?>);">
        <div class="absolute inset-0 bg-linear-gradient z-[1]"></div>
		<?php
		if (have_rows('hero_banner')) :
			while (have_rows('hero_banner')) : the_row();
				$title = get_sub_field('hero_title');
				$text = get_sub_field('hero_text');
				?>
                <div class="hero-content w-4/5 lg:w-2/5 ml-4 mt-8 relative z-[2]">
                    <h1 class="font-title text-xl5 text-white font-bold leading-8 mb-4"><?= $title ?></h1>
                    <div class="font-sans text-sm text-white font-light">
						<?= $text ?>
                    </div>
                </div>
			<?php
			endwhile;
		endif;
		?>
    </div>
    <div class="my-8 lg:my-16 px-8 lg:flex lg:flex-row lg:justify-between lg:pl-12 2xl:pl-[15%] lg:pr-0">
        <?php
        if (have_rows('introduction_group')) :
            while (have_rows('introduction_group')) : the_row();
                $title = get_sub_field('title_section');
                $text = get_sub_field('text_section');
	            $image_intro = get_sub_field('image_section');
            ?>
            <div class="lg:w-2/3 lg:pr-16">
                <h2 class="font-title font-bold text-l lg:text-xl3 text-black text-center lg:text-left my-5 lg:max-w-[200px] lg:leading-9"><?= get_sub_field('title_section') ?></h2>
                <div class="lg:hidden w-[300] h-[350px] mb-8 bg-center bg-cover bg-no-repeat rounded-tl-xl" style="background-image: url('<?= $image_intro['url'] ?>')"></div>
                <div class="font-sans text-xs font-thin text-center lg:text-left texts-margin">
                    <?= $text ?>
                </div>
            </div>
            <div class="hidden lg:block w-[480px] h-[500px] bg-cover bg-center bg-no-repeat rounded-tl-xl" style="background-image: url('<?= $image_intro['url'] ?>')"></div>
            <?php endwhile;
        endif;?>
    </div>
    <div class="my-8">
		<?php
		if (have_rows('description_group')) :
			while (have_rows('description_group')) : the_row();
				$image_description = get_sub_field('desc_image_section');
                $firstText = get_sub_field('desc_text_section_1');
                $secondText = get_sub_field('desc_text_section_2');
				?>
                <div class="w-full h-50vh lg:h-70vh bg-cover bg-no-repeat bg-center lg:bg-right-top rounded-t-xl" style="background-image: url('<?= $image_description['url'] ?>');"></div>
                <div class="px-8 lg:px-[10%] 2xl:px-[15%] lg:mt-8 2xl:my-16">
                    <div class="lg:flex lg:flex-row lg:justify-between">
                        <div class="texts-margin font-sans text-black font-thin text-xs text-center lg:w-1/2 lg:text-left"><?= $firstText ?></div>
                        <div class="my-8 lg:mt-0">
		                    <?php
		                    if (have_rows('last_collab_group')) :
			                    while (have_rows('last_collab_group')) : the_row();
                                $collabText = get_sub_field('group_text_section');
                                $collabTitle = get_sub_field('group_title_section');
                                $collabLink = get_sub_field('group_link_section');
                                ?>
                                    <p class="font-sans text-black text-center font-thin text-xs lg:text-right"><?= $collabText ?></p>
                                    <h2 class="font-title text-black text-center uppercase text-xl mb-2.5 lg:text-right"><?= $collabTitle ?></h2>
                                    <a class="block w-fit font-sans text-white text-xxs lg:text-xs font-regular mx-auto lg:mr-0 lg:ml-auto bg-black py-1 lg:py-2 px-6 rounded-full border border-black overflow-hidden relative transition-colors duration-300 ease-in-out group hover:text-black before:content-[''] before:absolute before:z-[1] before:-inset-1 before:bg-white before:transition-transform before:duration-300 before:ease-in-out before:translate-y-[-100%] hover:before:translate-y-0" href="<?= $collabLink['url'] ?>">
                                        <span class="relative z-[2]">Je découvre !</span>
                                    </a>
			                    <?php endwhile;
		                    endif; ?>
                        </div>
                    </div>
                    <div class="lg:w-1/2">
                        <div class="texts-margin font-sans text-black font-thin text-xs text-center lg:text-left"><?= $secondText ?></div>
                    </div>
                </div>
			<?php endwhile;
		endif; ?>
    </div>
    <div>
	    <?php
	    if (have_rows('collection_group')) :
		    while (have_rows('collection_group')) : the_row();
                $title =  get_sub_field('title_section');
			    $collections = get_sub_field('type_de_collection');
			    ?>
                <h2 class="font-sans font-bold text-l lg:text-xl2 uppercase text-center py-5"><?= $title ?></h2>
                <div class="lg:flex lg:flex-row lg:justify-center lg:relative lg:pb-8 lg:before:content-[''] lg:before:absolute lg:before:bottom-0 lg:before:w-2/3 lg:before:h-[2px] lg:before:bg-black">
			    <?php
			    foreach ($collections as $collection) {
				    $term = get_term($collection);
				    set_query_var( 'term', $term );
				    get_template_part( 'template-parts/loop/collections' );
			    }
                ?>
                </div>
            <?php
		    endwhile;
	    endif;
	    ?>
    </div>
</div>
<?php
get_footer();
