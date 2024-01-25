<?php
/*
 * Template Name: Presse
 */
get_header();
?>

<div class="press-page pt-8 lg:pt-28 pb-16">
	<div class="hero-container w-full h-[300px] bg-cover bg-center bg-no-repeat flex flex-col justify-center relative rounded-tr-3xl rounded-br-3xl lg:px-[15%]" style="background-image: url(<?= get_the_post_thumbnail_url() ?>);">
		<div class="absolute inset-0 bg-linear-gradient z-[1]"></div>
		<?php
		if (have_rows('hero_group')) :
			while (have_rows('hero_group')) : the_row();
				$title = get_sub_field('hero_title');
				$text = get_sub_field('hero_text');
				?>
				<div class="hero-content w-4/5 lg:w-2/5 ml-4 mt-8 relative z-[2]">
					<h1 class="font-title text-xl5 text-white font-medium leading-10 mb-4"><?= $title ?></h1>
					<div class="font-sans text-sm text-white font-light">
						<?= $text ?>
					</div>
				</div>
			<?php
			endwhile;
		endif;
		?>
	</div>
	<div id="press-container" class="px-4 lg:px-[10%]">
        <div class="py-12">
            <?php
            if (have_rows('press_presentation')) :
                while (have_rows('press_presentation')) : the_row();
                $title = get_sub_field('press_titre');
                $description = get_sub_field('press_description');
                $image = get_sub_field('press_thumbnail');
                $link = get_sub_field('press_link');
                ?>
                <h2 class="font-title text-xl4 text-black text-center lg:text-left font-medium mb-8 block uppercase"><?= $title ?></h2>
                <div class="flex flex-col lg:flex-row justify-between">
                    <div class="w-full lg:w-1/2 mb-4 lg:mb-0">
                        <img class="w-fit lg:w-full mx-auto max-w-[280px] lg:max-w-[400px]" src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>">
                    </div>
                    <div class="w-full lg:w-1/2 lg:pl-8">
                        <div class="font-sans text-black text-xs text-center lg:text-left leading-5 font-thin mb-4 lg:mt-12 px-2">
                            <?= $description ?>
                        </div>
                        <div>
                            <a class="block relative mx-auto lg:mr-auto lg:ml-0 w-fit px-8 py-2 pr-[40px] text-black hover:text-white font-sans text-xxs font-bold rounded-full group overflow-hidden border border-black before:content-[''] before:absolute before:inset-0 before:bg-black before:rounded-full before:translate-x-[-101%] before:transition before:duration-300 before:hover:translate-x-0" href="<?= $link['url'] ?>" title="<?= $link['title'] ?>" target="_blank">
                                <span class="relative z-[2]">Télécharger</span>
                                <img class="absolute right-[15px] top-[2px] w-[21px] z-[2] opacity-100 group-hover:opacity-0" src="<?= get_template_directory_uri() . '/assets/images/icons/download-icon-black.svg' ?>" alt="icone de téléchargement noire">
                                <img class="absolute right-[15px] top-[2px] w-[21px] z-[2] opacity-0 group-hover:opacity-100" src="<?= get_template_directory_uri() . '/assets/images/icons/download-icon-white.svg' ?>" alt="icone de téléchargement blanche">
                            </a>
                        </div>
                    </div>
                </div>
                <?php
                endwhile;
            endif;
            ?>
        </div>
        <div class="mt-8">
            <h2 class="font-title text-xl3 text-black font-medium mb-8 text-center uppercase">À lire dans la presse</h2>

            <div id="press-list" class="flex flex-row flex-wrap justify-start"></div>

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
</div>
<?php
get_footer();