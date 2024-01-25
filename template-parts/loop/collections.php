<?php
$term = get_query_var( 'term', '' );
$args = array(
	'post_type' => 'artworks',
	'posts_per_page' => 1,
	'orderby' => 'date',
	'order' => 'DESC'
);
if (!empty($term) ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'collection',
			'field' => 'slug',
			'terms' => $term->slug
		)
	);
}
$thumbnail = get_field('image_mise_en_avant', 'collection_' . $term->term_id);

$query = new WP_Query($args);
if ($query->have_posts()) {
	while ($query->have_posts()) {
		$query->the_post();
		echo '<div class="artwork-item group flex flex-col w-full lg:w-fit xl:w-fit my-8 lg:my-0 lg:mx-8 group">';
			echo '<div class="w-[300px] 2xl:max-w-[400px] 2xl:w-[400px] h-[300px] 2xl:h-[400px] transition-all duration-300 ease-in-out overflow-hidden block mx-auto my-4 group-hover:rounded-2xl bg-light-white group-hover:shadow-simple-25">';
			if (!empty($thumbnail['url'])) {
				echo '<div class="bg-cover bg-no-repeat bg-center h-full w-full" style="background-image: url('. $thumbnail['url'] .');"></div>';
			}
			echo '</div>';
			echo '<div class="lg:flex lg:flex-row lg:justify-between">';
				echo '<div>';
					echo '<h3 class="font-title text-center lg:text-left text-xl2 lg:text-l text-black uppercase leading-8">' . $term->name . '</h3>';
					echo '<p class="font-sans text-center lg:text-left text-base lg:text-xs text-black font-thin leading-6">' . $term->count . ' Œuvres</p>';
				echo '</div>';
				echo '<div class="mt-4">';
					echo '<a href="' . home_url() . '/artworks/" style="--bg-image: url('. $thumbnail['url'] .')" class="artwork-btn-bg-image block relative w-fit font-sans text-center mx-auto lg:mr-0 lg:ml-auto text-white text-xs lg:text-xxs px-3 py-2 rounded-full overflow-hidden before:content-[\'\'] before:absolute before:z-[3] before:inset-0 before:bg-black after:content-[\'\'] after:absolute after:z-[4] after:inset-0 after:bg-cover after:bg-center after:bg-no-repeat after:transition-opacity after:duration-300 after:ease-in-out after:opacity-0 after:bg-blend-hard-light group-hover:after:opacity-50"><span class="relative z-[5] transition-all duration-300 ease-in-out inline-block lg:scale-0 lg:hidden lg:group-hover:scale-100 lg:group-hover:inline-block">En savoir plus </span><img class="relative z-[5] inline-block transition-all duration-300 ease-in-out ml-4 lg:ml-0 lg:group-hover:ml-4" src="'. get_stylesheet_directory_uri() .'/assets/images/icons/arrow-right-white.svg" alt="icone fleche droite"></a>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	}
}
wp_reset_postdata();