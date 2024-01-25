<?php
/*
  * Single Template for Artworks
  */
get_header();
$collection = get_the_terms($post->ID, 'collection');
$techniques = get_field('technique');
$dimension = get_field('dimensions');
$description = get_field('description');
?>
	<div id="artwork-single-content" class="pt-16 lg:pt-28 pb-16">
		<div class="hero-container w-full h-[200px] bg-cover bg-center bg-no-repeat flex flex-col justify-center relative rounded-tr-3xl rounded-br-3xl lg:px-[15%]" style="background-image: url('<?= get_the_post_thumbnail_url() ?>');">
			<div class="absolute inset-0 bg-linear-gradient z-[1]"></div>
			<div class="hero-content w-4/5 lg:w-2/5 ml-4 mt-8 relative z-[2]">
				<h1 class="font-title text-xl5 text-white font-bold leading-8 mb-4"><?= the_title() ?></h1>
			</div>
		</div>
		<div class="">
			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
					<article <?php post_class('p-8 flex flex-col lg:flex-row lg:justify-center'); ?>>
						<div class="mb-8 lg:w-[500px]">
							<img class="w-full h-auto rounded-2xl" src="<?= get_the_post_thumbnail_url() ?>" alt="Image de l'artwork <?= the_title() ?>">
						</div>
						<div class="lg:w-[550px] lg:flex lg:flex-col lg:justify-center lg:ml-20">
							<ul class="flex flex-col mb-8">
								<li class="flex flex-row justify-start py-1">
									<div class="w-24">
										<p class="font-sans text-black font-medium text-sm">Série</p>
									</div>
									<div>
										<?php
										$index = 1;
										foreach ( $collection as $term ) {
											if ( $index === 1 ) {
												echo '<a class="font-sans text-black font-medium text-sm uppercase" href="'. home_url() .'/artworks/"><span class="inline-block">'. $term->name .'</span><span class="inline-block ml-2"><svg xmlns="http://www.w3.org/2000/svg" width="7" height="9" viewBox="0 0 7 9" fill="none"><path d="M1 1L6 4.6129L1 8" stroke="black" stroke-width="0.7"/></svg></span></a>';
											} else {
												echo '<a class="font-sans text-black font-medium text-sm uppercase" href="'. home_url() .'/artworks/">' . $term->name . '</a>';
											}
											$index ++;
										}
										?>
									</div>
								</li>
								<li class="flex flex-row justify-start py-1">
									<div class="w-24">
										<p class="font-sans text-black font-medium text-sm">Technique</p>
									</div>
									<div>
										<p class="font-sans text-black font-light text-sm">
											<?php
											$index = 1;
											foreach ( $techniques as $term ) {
												if ( $index === 1 ) {
													echo '<span>' . $term->name . '</span><span> + </span>';
												} else {
													echo '<span>' . $term->name . '</span>';
												}
												$index ++;
											}
											?>
										</p>
									</div>
								</li>
								<li class="flex flex-row justify-start py-1">
									<p class="w-24 font-sans text-black font-medium text-sm">Dimension</p>
									<p class="font-sans text-black font-light text-sm"><?= $dimension ?></p>
								</li>
							</ul>
							<div class="font-sans text-black font-light text-sm texts-margin">
								<?= $description ?>
							</div>
						</div>
					</article>
				<?php endwhile; ?>

			<?php else : ?>
				<p>No posts found.</p>
			<?php endif; ?>
		</div>
	</div>
<?php get_footer(); ?>