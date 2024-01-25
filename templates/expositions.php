<?php
/*
 * Template Name: Expositions
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
    <div id="expositions-container">
        <div id="expositions-filters" class="flex flex-col justify-start px-4 my-8 overflow-hidden lg:px-20 xl:px-32 2xl:px-[15%]">
            <div class="bg-white overflow-hidden relative z-[3]">
                <button id="filters-toggle-menu" class="filters-btn-inactive relative font-sans text-sm font-bold text-black w-fit block rounded-full overflow-hidden mx-auto lg:mx-0 group after:content-[''] after:absolute after:z-[2] after:top-0 after:right-0 after:bottom-0 after:left-0 after:scale-x-0 after:transition-transform after:duration-300 after:ease-in-out after:origin-right after:bg-black lg:hover:after:scale-x-100">
                    <span class="relative z-[6] px-[15px] py-[5px] transition-colors lg:group-hover:text-white duration-300 delay-150 uppercase">Trier et filtrer</span>
                    <span class="block lg:inline-block relative z-[3] w-[40px] h-[40px] bg-black rounded-full p-[12px] align-middle mx-auto">
                        <svg class="block mx-auto w-[15px] h-[15px] absolute svg-cross transition-opacity duration-300 ease-in-out" width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 1L7 7" stroke="white" stroke-width="0.5"/>
                            <path d="M1 7L7 1" stroke="white" stroke-width="0.5"/>
                        </svg>
                        <svg class="block mx-auto w-[15px] h-[15px] absolute svg-arrow transition-opacity duration-300 ease-in-out" width="7" height="9" viewBox="0 0 7 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path id="Vector 3" d="M1 1L6 4.6129L1 8" stroke="white" stroke-width="0.7"/>
                        </svg>
                    </span>
                </button>
            </div>
            <div id="expositions-filters-container" class="filters-hidden relative z-[2]">
                <div id="expositions-filters-timing" class="flex flex-col lg:flex-row justify-start my-2 py-2 relative before:content-[''] before:absolute before:left-0 before:right-0 before:top-0 before:h-[1px] before:bg-black before:opacity-50 before:z-[1] after:content-[''] after:absolute after:left-0 after:right-0 after:bottom-0 after:h-[1px] after:bg-black after:opacity-50 after:z-[1]">
                    <div class="lg:w-[230px]">
                        <p class="font-sans text-sm text-black underline text-center lg:text-left mb-2">
                            <span>Choisissez la période</span>
                            <span class="hidden lg:inline-block relative z-[3] w-[40px] h-[40px] p-[15px] lg:p-[12px] lg:ml-4 align-middle">
                                <svg class="w-[15px] h-[15px] block mx-auto" width="7" height="9" viewBox="0 0 7 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 1L6 4.6129L1 8" stroke="black" stroke-width="0.7"/>
                                </svg>
                            </span>
                        </p>
                    </div>
                    <div class="flex flex-col lg:flex-row">
                        <button class="filter-button bg-white text-sans text-xs lg:text-[11px] text-black w-4/5 lg:w-fit uppercase border border-black rounded-lg my-2 lg:mr-4 block mx-auto px-12 lg:px-8 py-1" data-filter="past">Passées</button>
                        <button class="filter-button bg-white text-sans text-xs lg:text-[11px] text-black w-4/5 lg:w-fit uppercase border border-black rounded-lg my-2 lg:mr-4 block mx-auto px-12 lg:px-8 py-1" data-filter="ongoing">En ce moment</button>
                        <button class="filter-button bg-white text-sans text-xs lg:text-[11px] text-black w-4/5 lg:w-fit uppercase border border-black rounded-lg my-2 lg:mr-4 block mx-auto px-12 lg:px-8 py-1" data-filter="upcoming">À venir</button>
                    </div>
                </div>
                <div id="expositions-filters-location" class="flex flex-col lg:flex-row overflow-hidden">
                    <div class="lg:w-[230px]">
                        <p class="font-sans text-sm text-black underline text-center lg:text-left mb-4">
                            <span>Sélectionnez la région</span>
                            <span class="hidden lg:inline-block relative z-[3] w-[40px] h-[40px] p-[15px] lg:p-[12px] lg:ml-4 align-middle">
                                <svg class="w-[15px] h-[15px] block mx-auto" width="7" height="9" viewBox="0 0 7 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 1L6 4.6129L1 8" stroke="black" stroke-width="0.7"/>
                                </svg>
                            </span>
                        </p>
                    </div>
                    <div class="relative lg:flex lg:flex-row lg:pt-[5px] lg:ml-4">
			            <?php
			            $regions = get_terms(array(
				            'taxonomy' => 'region',
				            'hide_empty' => true,
				            'parent' => 0
			            ));
			            foreach ($regions as $region) {
				            echo '<div class="region-row group lg:relative flex flex-row lg:flex-col overflow-hidden lg:w-fit lg:inline-block lg:mr-12 before:content[\'\'] before:hidden lg:before:block before:absolute before:inset-0 before:bg-white before:z-[3] before:h-[30px]">';
				            $children = get_terms(array(
					            'taxonomy' => 'region',
					            'hide_empty' => true,
					            'parent' => $region->term_id
				            ));
				            if ($children) {
					            echo '<div class="col-left w-[45%] relative lg:w-auto z-[3] bg-white flex flex-row justify-start">';
					                echo '<button class="filter-parent relative z-[2] font-sans text-black leading-[30px] text-sm lg:text-xs uppercase h-fit">' . $region->name . '</button>';
                                    echo '<div class="h-fit block mx-auto lg:ml-[10px] py-[7px] lg:py-[8px] relative z-[2]"><svg class="w-[15px] lg:w-[10px] h-[15px] lg:h-[10px]" width="7" height="9" viewBox="0 0 7 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L6 4.6129L1 8" stroke="black" stroke-width="0.7"/></svg></div>';
                                echo '</div>';
                                echo '<div class="col-right w-[50%] lg:w-auto lg:max-h-[100px] absolute lg:relative top-0 right-0 lg:right-0 lg:left-0 bottom-0 z-[2] lg:pr-4 overflow-y-scroll transition-transform lg:transition-all duration-300 ease-in-out -translate-x-[120%] lg:-translate-y-0 lg:translate-x-0">';
                                    echo '<div class="relative flex flex-col h-fit before:content-[\'\'] before:absolute lg:before:hidden before:left-0 before:bottom-0 before:top-0 before:w-[1px] before:bg-black before:z-[1]">';
                                    foreach ($children as $child) {
                                        echo '<button class="filter-button filter-children lg:text-xs lg:text-left lg:my-1 font-sans text-black uppercase h-fit" data-region="' . $child->slug . '">' . $child->name . '</button>';
                                    }
                                    echo '</div>';
                                echo '</div>';
				            } else {
                                echo '<div class="col-left w-[45%] lg:w-auto relative z-[3] bg-white flex flex-row justify-start">';
                                    echo '<button class="filter-button filter-parent no-children font-sans text-black leading-[30px] text-sm lg:text-xs uppercase h-fit" data-region="' . $region->slug . '">' . $region->name . '</button>';
                                    echo '<div class="h-fit block mx-auto py-[7px]"><svg class="w-[15px] h-[15px]" width="7" height="9" viewBox="0 0 7 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L6 4.6129L1 8" stroke="black" stroke-width="0.7"/></svg></div>';
					            echo '</div>';
				            }
				            echo '</div>';
			            }
			            ?>
                    </div>
                </div>
                <button id="clear-filters" class="clear-filters-button uppercase font-sans text-black relative lg:absolute lg:right-0 lg:top-16 text-xs lg:text-xxs border border-black rounded-lg w-fit px-4 py-1.5 mx-auto my-4 lg:text-xs lg:border lg:border-black lg:px-4 lg:py-1.5">Effacer les filtres</button>
            </div>
        </div>

        <div id="expositions-list"></div>

        <div id="pagination"></div>

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
    </div>
</div>
<?php
get_footer();
