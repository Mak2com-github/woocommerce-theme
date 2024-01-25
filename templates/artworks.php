<?php
/*
 * Template Name: Artworks
 */
get_header();
?>
<div class="artworks-page pt-16 lg:pt-28 pb-16">
    <div class="hero-container w-full h-[300px] bg-cover bg-center bg-no-repeat flex flex-col justify-center relative rounded-tr-3xl rounded-br-3xl lg:px-[15%]" style="background-image: url(<?= get_the_post_thumbnail_url() ?>);">
        <div class="absolute inset-0 bg-linear-gradient z-[1]"></div>
        <?php
        if (have_rows('hero_group')) :
            while (have_rows('hero_group')) : the_row();
            $title = get_sub_field('title_section');
            $text = get_sub_field('text_section');
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
    <div id="artworks-container">
        <div id="artworks-filters" class="flex flex-row justify-center pl-4 py-8">
            <div id="artworks-filters-sub" class="">
	            <?php
	            $collections = get_terms(array('taxonomy' => 'collection', 'hide_empty' => true));
	            foreach ($collections as $collection) {
		            $thumbnail = get_field('image_mise_en_avant', 'collection_' . $collection->term_id);
		            $backgroundImage = $thumbnail ? 'style="background-image: url(' . esc_url($thumbnail['url']) . ')"' : '';
		            echo '<button class="filter-button w-[130px] lg:w-[170px] h-[35px] lg:h-[50px] mx-2 lg:mx-4 relative overflow-hidden rounded-xl lg:rounded-2xl bg-cover bg-center bg-no-repeat group" '.$backgroundImage.' data-collection="' . $collection->slug . '"><span class="absolute z-[1] inset-0 bg-black opacity-50 transition-opacity duration-300 ease-in-out group-hover:opacity-0"></span><span class="relative z-[2] font-sans text-xs text-white uppercase">' . $collection->name . '</span></button>';
	            }
	            ?>
            </div>
            <button id="clear-filters" class="clear-filters-button uppercase font-sans text-black absolute left-8 bottom-0 lg:relative text-xxs lg:text-xs lg:border lg:border-black rounded-full lg:px-4 lg:py-1.5">Effacer les filtres</button>
        </div>

        <div id="artworks-list" class="flex flex-row justify-center flex-wrap px-4 lg:px-20 mb-8"></div>

        <div id="loader" style="display: none;">
            <div class="wrapper">
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="shadow"></div>
                <div class="shadow"></div>
                <div class="shadow"></div>
            </div>
        </div>

        <button id="load-more-artworks" class="block mx-auto bg-transparent font-sans text-sm text-black py-2 px-16 rounded-xl border border-black font-regular transition-all duration-300 ease-in-out hover:bg-black hover:text-white hover:rounded-full" data-page="1">Afficher plus</button>
    </div>
</div>
<?php
get_footer();
