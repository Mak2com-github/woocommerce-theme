<?php
/*
 * Template Name: Accueil
 */
get_header();
?>
<div class="homepage-container pt-16 lg:pt-28">
    <div class="hero-section">
	    <?php
	    if (have_rows('hero_group')) :
		    while (have_rows('hero_group')) : the_row();
            ?>
            <div class="swiper swiperHero rounded-tl-3xl rounded-br-3xl h-80vh">
                <div class="swiper-wrapper">
                <?php
                if (have_rows('hero_repeater')) :
                    $index = 1;
                    while (have_rows('hero_repeater')) : the_row();
                        $title = get_sub_field('hero_slide_title');
                        $text = get_sub_field('hero_slide_text');
                        $image = get_sub_field('hero_slide_image');
                        $link = get_sub_field('hero_slide_link');
                        ?>
                        <div class="swiper-slide bg-cover bg-center bg-no-repeat relative" style="background-image: url('<?= $image['url'] ?>')">
                            <div class="swiper-slide-inner relative z-[5] flex flex-col justify-start h-full p-4 lg:pl-[20%] bg-linear-gradient">
                                <div class="mt-16 lg:mt-28 lg:max-w-[40%] 2xl:max-w-[35%]">
                                    <?php if ($index === 1) { ?>
                                        <h1 class="font-title text-xl7 text-white"><?= $title ?></h1>
                                    <?php } else { ?>
                                        <h2 class="font-title text-xl7 text-white"><?= $title ?></h2>
                                    <?php } ?>
                                    <p class="font-sans text-sm text-white mb-8 font-light"><?= $text ?></p>
                                    <a class="font-title text-xs text-black py-2 px-7 bg-white rounded-full font-regular" href="<?= $link ?>">Je découvre !</a>
                                </div>
                            </div>
                        </div>
                    <?php
                    $index++;
                    endwhile;
                endif;
                ?>
                </div>
                <div class="relative bottom-20 left-4 lg:left-[20%] w-fit">
                    <div class="swiper-pagination-hero"></div>
                    <div class="swiper-navigation-hero">
                        <div class="swiper-navigation-hero-next bg-white p-2 rounded-full">
                            <img src="<?= get_stylesheet_directory_uri() ?>/assets/images/icons/arrow-right.svg" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <?php
		    endwhile;
	    endif;
	    ?>
    </div>
    <div class="py-12 px-8">
        <?php
        if (have_rows('collection_group')) :
            while (have_rows('collection_group')) : the_row();
            $title = get_sub_field('title_section');
            $subTitle = get_sub_field('sub_title_section');
            $text = get_sub_field('text_section');
            ?>
            <div class="flex flex-col">
                <div class="flex flex-col">
                    <h2 class="font-sans text-center text-base uppercase text-black"><?= $title ?></h2>
                    <h3 class="font-title text-center text-xl3 xl:text-xl4 uppercase text-black mb-8"><?= $subTitle ?></h3>
                    <div class="text-center font-sans text-xs text-black mb-4 text-200 lg:w-1/2 lg:mx-auto">
                        <?= $text ?>
                    </div>
                </div>
                <div class="flex flex-col lg:flex-row xl:justify-center">
	                <?php
	                if (have_rows('selection_repeater')) :
		                while (have_rows('selection_repeater')) : the_row();
			                $artwork = get_sub_field('artwork');
			                $terms = get_the_terms($artwork->ID, 'technique');
			                ?>
                            <div class="flex flex-col w-full xl:w-fit my-8 group xl:mx-8">
                                <div class="w-[300px] 2xl:max-w-[400px] 2xl:w-[400px] h-[350px] 2xl:h-[450px] overflow-hidden block mx-auto my-4 rounded-2xl bg-light-white shadow-simple-25">
                                    <div class="bg-cover bg-no-repeat bg-center h-full w-full transition-transform duration-300 ease-in-out lg:scale-75 lg:group-hover:scale-100" style="background-image: url('<?= get_the_post_thumbnail_url($artwork->ID) ?>')"></div>
                                </div>
                                <h2 class="font-title text-center text-xl2 text-black"><?= $artwork->post_title ?></h2>
                                <p class="flex flex-row flex-wrap justify-center text-center font-sans text-xs text-black max-w-[150px] mx-auto mb-4">
					                <?php
					                $index = 1;
					                foreach ($terms as $term) {
						                if ($index === 1) {
							                echo '<span>' . $term->name . '</span><span> + </span>';
						                } else {
							                echo '<span>' . $term->name . '</span>';
						                }
						                $index++;
					                }
					                ?>
                                </p>
                                <div>
                                    <a href="<?=$artwork->guid ?>" style="--bg-image: url('<?= get_the_post_thumbnail_url($artwork->ID) ?>')" class="artwork-btn-bg-image block relative w-fit font-sans text-center mx-auto text-white text-xs px-8 py-2 rounded-full overflow-hidden before:content-[''] before:absolute before:z-[3] before:inset-0 before:bg-black after:content-[''] after:absolute after:z-[4] after:inset-0 after:bg-cover after:bg-center after:bg-no-repeat after:transition-opacity after:duration-300 after:ease-in-out after:opacity-0 after:bg-blend-hard-light group-hover:after:opacity-50"><span class="relative z-[5]">Je découvre !</span></a>
                                </div>
                            </div>
		                <?php
		                endwhile;
	                endif;
	                ?>
                </div>
            </div>
            <?php
            endwhile;
        endif;
        ?>
    </div>
    <div class="p-4 lg:py-12 bg-light-rose rounded-3xl">
        <?php if (have_rows('presentation_group')) :
            while (have_rows('presentation_group')) : the_row();
            $subTitle = get_sub_field('sub_title_section');
            $title = get_sub_field('title_section');
            $text = get_sub_field('text_section');
            $link = get_sub_field('link_section');
            $image = get_sub_field('image_section');
            ?>
            <div class="relative mb-40 lg:mb-60">
                <div class="flex flex-col lg:w-1/2 lg:max-w-[550px] lg:ml-[10%] 2xl:ml-[15%] 2xl:mt-[3%]">
                    <h2 class="font-sans text-center lg:text-left text-base text-black"><?= $title ?></h2>
                    <h3 class="font-title text-center lg:text-left text-xl3 xl:text-xl4 text-black mb-[300px] lg:mb-8"><?= $subTitle ?></h3>
                    <div class="font-sans text-black text-center lg:text-left text-xs texts-margin">
		                <?= $text ?>
                    </div>
                    <a href="<?= $link ?>" class="relative font-sans text-sm font-bold text-black w-fit block rounded-full overflow-hidden mx-auto lg:mx-0 group after:content-[''] after:absolute after:z-[2] after:top-0 after:right-0 after:bottom-0 after:left-0 after:scale-x-0 after:transition-transform after:duration-300 after:ease-in-out after:origin-right after:bg-black hover:after:scale-x-100">
                        <span class="relative z-[6] px-[15px] py-[5px] transition-colors group-hover:text-white duration-300 delay-150">Découvrir !</span>
                        <span class="inline-block relative z-[3] w-[40px] h-[40px] bg-black rounded-full p-[15px] align-middle ml-[20px]">
                            <svg class="block mx-auto" width="7" height="9" viewBox="0 0 7 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 1L6 4.6129L1 8" stroke="white" stroke-width="0.7"/>
                            </svg>
                        </span>
                    </a>
                </div>
                <img class="absolute top-[100px] lg:top-20 2xl:top-0 xl:top-12 left-0 lg:left-[inherit] right-0 lg:right-[15%] w-[70%] max-w-[230px] xl:max-w-[300px] 2xl:max-w-[350px] mx-auto rounded-tl-full rounded-tr-full rounded-br-full rounded-bl-0 shadow-simple-25" src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>">
            </div>
            <?php
            endwhile;
        endif;
        ?>
    </div>

    <div class="px-4 xl:px-8 pb-8">
        <?php
        if (have_rows('collaboration_group')) :
            while (have_rows('collaboration_group')) : the_row();
            $image = get_sub_field('image_section');
            $title = get_sub_field('title_section' );
            $subTitle = get_sub_field('sub_title_section');
            $link = get_sub_field('link_section');
            ?>
            <div class="bg-cover bg-no-repeat bg-center -mt-32 w-full flex flex-col lg:flex-row lg:justify-between overflow-hidden rounded-tr-3xl rounded-b-3xl relative before:content-[''] before:absolute before:inset-0 before:z-[1] before:bg-black before:opacity-40" style="background-image: url('<?= $image['url'] ?>')">
                <div class="py-8 px-1 h-full w-full flex flex-col justify-center lg:justify-end lg:pb-20 lg:pl-20 relative z-[5] min-h-[400px] xl:min-h-[500px] lg:w-1/2">
                    <h2 class="font-sans text-center lg:text-left text-white text-base uppercase"><?= $title ?></h2>
                    <h3 class="font-title text-center lg:text-left text-white uppercase font-black lg:font-light text-xl lg:text-xl4 tracking-[4px] lg:tracking-[8px]"><?= $subTitle ?></h3>
                </div>
                <div class="mb-12 relative z-[5] lg:mb-0 lg:flex lg:flex-col lg:justify-end lg:pl-20 lg:pr-20">
                    <a href="<?= $link ?>" class="font-sans bg-white font-medium text-black text-xs lg:text-sm px-10 lg:px-16 py-1.5 lg:py-2.5 lg:mb-20 rounded-2xl block w-fit mx-auto">Je découvre !</a>
                </div>
            </div>
            <?php
            endwhile;
        endif;
        ?>
    </div>

    <div class="my-24">
        <?php
        if (have_rows('expositions_group')) :
            while (have_rows('expositions_group')) : the_row();
            ?>
            <div>
                <h2 class="font-sans text-black text-left uppercase text-xl font-bold pl-8 lg:pl-32 xl:pl-48">Expositions</h2>
                <div class="swiper swiperExpos rounded-tl-3xl h-fit pl-8 lg:pl-32 xl:pl-48">
                    <div class="swiper-wrapper">
                    <?php
                    if (have_rows('exposition_repeater')) :
                        while (have_rows('exposition_repeater')) : the_row();
                        $exposition = get_sub_field('exposition');
                        $expoDate = get_field('exposition_date', $exposition->ID);
                        $terms = get_the_terms($exposition->ID, 'region');
                        ?>
                        <div class="swiper-slide py-8 pr-8 h-auto pb-20 relative lg:w-[300px] xl:w-[400px] group before:content-[''] before:absolute before:bottom-8 before:left-0 before:right-0 before:z-[1] before:bg-black before:h-[2px]">
                            <div class="bg-cover bg-no-repeat bg-center h-[250px] xl:h-[300px] rounded-3xl lg:rounded-none transition-all duration-300 ease-in-out lg:group-hover:rounded-3xl mb-4" style="background-image: url('<?= get_the_post_thumbnail_url($exposition->ID) ?>')"></div>
                            <div class="flex flex-row justify-between">
                                <div class="flex flex-col max-w-[60%]">
                                    <h3 class="font-sans text-l text-black font-bold"><?= $exposition->post_title ?></h3>
                                    <div class="flex flex-row flex-wrap">
                                        <div class="inline-block mr-2">
                                            <p class="font-sans text-xs inline-block leading-4 align-bottom"><?php if (!empty($expoDate)) { echo $expoDate; } ?></p>
                                        </div>
                                        <div class="flex flex-row-reverse expo-terms">
                                            <?php
                                            if (!empty($terms)) {
                                                $index = 1;
                                                if ($terms >= 2) {
	                                                foreach ( $terms as $term ) {
		                                                ?>
                                                        <p class="inline-block uppercase text-xxs font-sans expo-terms align-bottom mt-auto"><span class="mx-1">|</span><span><?= $term->name ?></span></p>
		                                                <?php
		                                                $index++;
	                                                }
                                                } else {
                                                    foreach ( $terms as $term ) {
                                                        ?>
                                                        <p class="inline-block uppercase text-xs font-sans expo-terms align-bottom mt-auto">
                                                            <span><?= $term->name ?></span>
                                                        </p>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col justify-end">
                                    <a href="<?= $exposition->guid ?>" class="relative text-black w-fit flex flex-row rounded-full overflow-hidden mx-auto lg:mx-0 group after:content-[''] after:absolute after:z-[2] after:top-0 after:right-0 after:bottom-0 after:left-0 after:scale-x-0 after:transition-transform after:duration-300 after:ease-in-out after:origin-right after:bg-black group-hover:after:scale-x-100">
                                        <span class="relative z-[6] pl-[15px] pr-[5px] py-[5px] font-sans font-bold text-xxs transition-colors group-hover:text-white duration-300 delay-150">En savoir plus</span>
                                        <span class="inline-block relative z-[3] w-[25px] h-[25px] bg-black rounded-full p-[7px] align-middle">
                                            <svg class="block mx-auto" width="7" height="9" viewBox="0 0 7 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1 1L6 4.6129L1 8" stroke="white" stroke-width="0.7"/>
                                            </svg>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                        endwhile;
                    endif;
                    ?>
                    </div>
                    <div class="swiper-navigation-expos w-fit absolute bottom-4 right-4 z-[30]">
                        <div class="swiper-navigation-expos-next bg-white p-3.5 rounded-full border-black border">
                            <img src="<?= get_stylesheet_directory_uri() ?>/assets/images/icons/arrow-right.svg" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <?php
            endwhile;
        endif;
        ?>
    </div>
</div>
<?php
get_footer();
