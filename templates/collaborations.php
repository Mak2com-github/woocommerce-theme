<?php
/*
 * Template Name: Collaborations
 */
get_header();
?>
<div class="collaborations-page pt-16 lg:pt-28 pb-16">
	<div class="hero-container w-full h-[300px] bg-cover bg-center bg-no-repeat flex flex-col justify-center relative rounded-tr-3xl rounded-br-3xl lg:px-[15%]" style="background-image: url(<?= get_the_post_thumbnail_url() ?>);">
		<div class="absolute inset-0 bg-linear-gradient z-[1]"></div>
		<?php
		if (have_rows('hero_group')) :
			while (have_rows('hero_group')) : the_row();
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
	<div id="collaborations-container" class="">
        <div id="collaborations-filters" class="flex flex-row justify-center py-8 mb-8 px-4 lg:px-[5%] 2xl:px-[10%]">
            <div id="collaborations-filters-sub" class="lg:flex lg:flex-row lg:justify-evenly lg:flex-wrap">
            <?php
            if (have_rows('collaborations_group')) :
                while (have_rows('collaborations_group')) : the_row();
                if (have_rows('collaboration_repeater')) :
                    $index = 0;
                    while (have_rows('collaboration_repeater')) : the_row();
                    $name = get_sub_field('collaboration_name');
                    $slug = sanitize_title($name);
                    ?>
                        <button class="collaboration-filter-button <?php if ($index === 0) { echo 'collab-active-filter'; } ?> w-fit h-[35px] px-8 mx-2 lg:mx-4 relative overflow-hidden rounded-full text-black border border-black transition-colors duration-300 ease-in-out hover:text-white bg-white before:content-[''] before:absolute before:z-[1] before:inset-0 before:bg-black before:rounded-full before:transition-transform before:duration-300 before:ease-in-out before:origin-top-left before:-translate-y-[100%] hover:before:translate-y-0 before:-translate-x-[100%] hover:before:translate-x-0" data-collaboration="<?= $slug ?>"><span class="relative z-[2] font-sans text-xs uppercase"><?= $name ?></span></button>
                    <?php
                    $index++;
                    endwhile;
                endif;
                endwhile;
            endif;
            ?>
            </div>
		</div>
		<div class="collaborations-listing">
		<?php
		if (have_rows('collaborations_group')) :
			while (have_rows('collaborations_group')) : the_row();
				if (have_rows('collaboration_repeater')) :
                    $index = 0;
					while (have_rows('collaboration_repeater')) : the_row();
					$name = get_sub_field('collaboration_name');
					$slug = sanitize_title($name);
					?>
					<div class="collaboration-row <?php if ($index === 0) { echo 'collab-revealed'; } else { echo 'collab-hidden'; } ?>" id="<?= $slug ?>">
						<?php
						if (have_rows('collaboration_group')) :
							?>
							<div class="flex flex-col-reverse lg:flex-row px-4 lg:px-[5%] 2xl:px-[10%]">
							<?php
							while (have_rows('collaboration_group')) : the_row();
								$logo = get_sub_field('collaboration_logo');
								$description = get_sub_field('collaboration_description');
								$link = get_sub_field('collaboration_link');
								$image1 = get_sub_field('collaboration_thumb_1');
								$image2 = get_sub_field('collaboration_thumb_2');
								?>
								<div class="lg:w-1/2 lg:pr-12">
									<div class="flex flex-row justify-evenly items-center">
										<img class="w-auto h-auto inline-block" src="<?= get_stylesheet_directory_uri() ?>/assets/images/logo-stephanegubert-black.png" alt="logo stephane gubert en noir">
                                        <img class="w-auto h-auto inline-block" src="<?= get_stylesheet_directory_uri() ?>/assets/images/icons/feat-cross-icon-black.svg" alt="featuring cross icon">
										<img class="w-auto h-auto inline-block max-w-[80px] xl:max-w-[125px]" src="<?= $logo['url'] ?>" alt="<?= $logo['alt'] ?>">
									</div>
                                    <div class="font-sans font-thin text-black text-xs my-8 text-center lg:text-left texts-margin">
                                        <h2 class="font-sans uppercase font-medium text-black hidden"><?= $name ?></h2>
                                        <?= $description ?>
                                    </div>
                                    <div>
                                        <a class="block w-fit font-sans text-white text-xs font-regular mx-auto lg:mr-auto lg:ml-0 bg-black py-2 px-6 rounded-full border border-black overflow-hidden relative transition-colors duration-300 ease-in-out group hover:text-black before:content-[''] before:absolute before:z-[1] before:-inset-1 before:bg-white before:transition-transform before:duration-300 before:ease-in-out before:translate-y-[-100%] hover:before:translate-y-0" href="<?= $link['url'] ?>" target="_blank" title="<?= $link['title'] ?>"><span class="relative z-[2]">Découvrir leur page</span></a>
                                    </div>
								</div>
								<div class="flex flex-row justify-center mt-4 mb-12 lg:w-1/2">
                                    <div class="overflow-hidden flex items-center rounded-xl w-[200px] lg:w-[320px] 2xl:w-[380px] h-[300px] lg:h-[480px] 2xl:h-[570px] bg-cover bg-center bg-no-repeat shadow-simple-25" style="background-image: url('<?= $image1['url'] ?>');"></div>
                                    <div class="overflow-hidden flex items-center rounded-xl w-[150px] lg:w-[200px] 2xl:w-[270px] h-[160px] lg:h-[210px] 2xl:h-[290px] bg-cover bg-center bg-no-repeat -ml-8 mt-8" style="background-image: url('<?= $image2['url'] ?>');"></div>
								</div>
								<?php
							endwhile;
							?>
							</div>
							<?php
						endif;

                        if (have_rows('collaboration_slider_group')) :
                            while (have_rows('collaboration_slider_group')) : the_row();
                            $description = get_sub_field('collaboration_slider_description');
                            ?>
                            <div class="my-8 lg:my-16">
                                <h2 class="font-title uppercase text-black text-xl2 lg:text-xl4 font-medium mb-2 text-center leading-6">Galerie</h2>
                                <div class="font-sans text-black text-xs text-center"><?= $description ?></div>
                                <?php if (have_rows('collaboration_slider_repeater')) : ?>
                                <div class="swiper swiperCollaborationGallery mt-4 lg:mt-16 pl-4 lg:pl-12 cursor-grab">
                                    <div class="swiper-wrapper">
                                        <?php
                                        while (have_rows('collaboration_slider_repeater')) : the_row();
                                            $image = get_sub_field('collaboration_slide');
                                            ?>
                                            <div class="swiper-slide w-[140px] lg:w-[330px] h-[250px] lg:h-[450px] bg-cover bg-center bg-no-repeat rounded-xl" style="background-image: url('<?= $image['url'] ?>');"></div>
                                        <?php endwhile; ?>
                                    </div>
                                    <div class="swiper-progress"></div>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php
                            endwhile;
                        endif;
                        ?>
					</div>
					<?php
						$index++;
					endwhile;
				endif;
			endwhile;
		endif;
		?>
		</div>
	</div>
</div>
<?php
get_footer();