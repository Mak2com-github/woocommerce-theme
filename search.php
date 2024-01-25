<?php
get_header();
$search_query = get_search_query();
$resultsCount = 0;
?>
	<div class="pt-32 pb-20 px-4">
		<h1 class="font-title uppercase text-center text-xl3 text-classic-green w-full mb-8">Résultats de la recherche</h1>
		<form class="relative p-0 w-full flex flex-row justify-evenly lg:w-2/4 lg:mx-auto" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" role="search">
			<label for="search-input" class="w-[80%] py-2 px-4 rounded-xl border border-classic-gold">
				<span class="hidden"><?php _e('Search for:', 'text-domain'); ?></span>
				<input type="search" id="search-input" class="font-sans text-classic-green text-sm font-regular w-full pl-[5px] border-l border-classic-gold outline-none" name="s" value="<?php echo get_search_query(); ?>" placeholder="<?php echo esc_attr_x('Que cherchez-vous ?', 'placeholder', 'text-domain'); ?>" autocomplete="off">
			</label>
			<button type="submit" class="w-[42px] h-[42px] flex flex-col justify-center bg-classic-green rounded-xl transition duration-300 hover:shadow-shadow-light">
				<span class="hidden"><?php _e('Search Button', 'text-domain'); ?></span>
				<span class="w-fit inline-block mx-auto">
                <svg focusable="false" aria-label="Search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24px">
                    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" style="fill: #fff"></path>
                </svg>
            </span>
			</button>
			<input type="hidden" name="id" value="147">
		</form>
		<div class="flex flex-col justify-start relative pt-24 lg:px-[15%] xl:px-[25%]">
			<?php
			if (have_posts()) :
				while (have_posts()) : the_post();
					search_and_display_acf_content( get_the_ID(), $search_query, $resultsCount );
				endwhile;
				echo '<p class="absolute top-0 w-full lg:w-2/4 text-center font-sans text-xl text-classic-green my-8">Nombre de résultats : ' . $resultsCount . '</p>';
				custom_search_pagination();
			else :
				?>
				<p class="font-sans text-xl text-classic-green my-8">Aucun résultat n’a pu être trouvé</p>
			<?php
			endif;
			?>
		</div>
	</div>
<?php
get_footer();
