<?php
// Enqueue styles and scripts
function mak2com_theme_enqueue_styles() {
	wp_enqueue_style('swipercss', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
    wp_enqueue_style('mak2com-style', get_stylesheet_uri());
	wp_enqueue_style('google-font-geologica', 'https://fonts.googleapis.com/css2?family=Geologica:wght@100;200;300;400;500;600;700;800;900&display=swap');
	wp_enqueue_script('swiperjs', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('mak2com-scripts', get_stylesheet_directory_uri() . '/assets/js/script.js', array('jquery'), '1.0', true);
    wp_enqueue_script('mak2com-swipers', get_stylesheet_directory_uri() . '/assets/js/swipers.js', array('jquery'), '1.0', true);
	wp_enqueue_script('mak2com-ajax', get_stylesheet_directory_uri() . '/assets/js/ajax.js', array('jquery'), '1.0', true);
	wp_localize_script('mak2com-ajax', 'ajax_object', array( 'ajaxurl' => admin_url('admin-ajax.php') ));
}
add_action('wp_enqueue_scripts', 'mak2com_theme_enqueue_styles');

function mak2com_register_menus() {
	register_nav_menus(
		array(
			'footer-legals' => __( 'Footer Legals' )
		)
	);
}
add_action( 'init', 'mak2com_register_menus' );

// Add theme support
function mak2com_theme_setup() {
    // Add post thumbnail support
    add_theme_support('post-thumbnails');

    // Add custom logo support
    add_theme_support('custom-logo');

    // Add custom menu support
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'mak2com'),
        'footer' => __('Footer Menu', 'mak2com'),
    ));
}
add_action('after_setup_theme', 'mak2com_theme_setup');

// Register widget areas
function mak2com_theme_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar', 'mak2com'),
        'id' => 'sidebar-1',
        'description' => __('Add widgets here to appear in the sidebar.', 'mak2com'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'mak2com_theme_widgets_init');

add_theme_support( 'woocommerce' );

function mak2com_remove_woocommerce_gallery() {
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
	remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
}
add_action( 'after_setup_theme', 'mak2com_remove_woocommerce_gallery' );

add_action( 'init', 'remove_wc_breadcrumbs' );
function remove_wc_breadcrumbs() {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}


function recursive_acf_search($value, $search_keywords, &$found, &$content): void {
	if (is_array($value)) {
		foreach ($value as $sub_value) {
			recursive_acf_search($sub_value, $search_keywords, $found, $content);
		}
	} elseif (is_string($value)) {
		// Convertir la valeur en minuscules pour la comparaison
		$lower_value = strtolower($value);
		// Vérifier si tous les mots-clés sont présents dans la valeur
		$all_keywords_found = true;
		foreach ($search_keywords as $keyword) {
			if (!str_contains($lower_value, strtolower($keyword)) && !str_contains($lower_value, ucfirst($keyword))) {
				$all_keywords_found = false;
				break; // Un mot-clé est manquant, pas besoin de vérifier les autres
			}
		}
		if ($all_keywords_found && !preg_match('/\.(jpg|jpeg|png|gif|bmp|svg|webp|mp4|mp3|wav|avi|mov|wmv|flv)$/i', $value)) {
			$content[] = $value;
			$found = true;
		}
	}
}

function search_and_display_acf_content($post_id, $search_query, &$resultsCount): void {
	$fields = get_fields($post_id);
	$found = false;
	$content = [];
	$postsIds = array($post_id);
	$maxWords = 20;
	$search_keywords = explode(' ', $search_query);

	if ($fields) {
		foreach ($fields as $field_name => $value) {
			$field_object = get_field_object($field_name, $post_id);
			if ($field_object['type'] == 'group') {
				foreach ($field_object['value'] as $sub_value) {
					if (!is_array($sub_value)) {
						recursive_acf_search($sub_value, $search_keywords, $found, $content);
					}
				}
			}
		}
	} else {
		$found = true;
		foreach ($postsIds as $post) {
			$content[] = get_post($post);
		}
	}

	if ($found) {
		foreach ($content as $content_value) {
			$resultsCount++;
			echo '<div class="block w-full p-8 relative last:after:hidden after:content-[\'\'] after:absolute after:bottom-0 after:left-0 after:right-0 after:h-[1px] after:bg-classic-green">';
			echo '<h2 class="font-sans text-xl2 font-medium text-classic-green spanHandwritingCapitalizeInlineBlock spanFontSize40">' . get_the_title($post_id) . '</h2>';
			if (gettype($content_value) === "string") {
				$wordArray = explode(' ', $content_value);
			} else {
				$wordArray = explode(' ', $content_value->post_content);
			}
			if ( count($wordArray) > $maxWords) {
				$wordArray = array_slice($wordArray, 0, $maxWords);
				$truncatedContent = implode(' ', $wordArray) . '...';
			} else {
				$truncatedContent = $content_value;
			}

			echo '<div class="font-sans text-sm leading-5 text-classic-green font-regular my-4"><p>' . $truncatedContent . '</p></div>';
			echo '<a class="font-title uppercase text-sm text-light-gold bg-classic-green font-regular rounded-xl py-2 px-8 mt-4 block w-fit ml-auto border border-classic-green transition duration-300 hover:bg-transparent hover:text-classic-green" href="' . esc_url(get_permalink($post_id)) . '">Découvrir</a>';
			echo '</div>';
		}
	}
}

function custom_search_pagination(): void {
	global $wp_query;

	// Construire les liens de pagination
	$pages = paginate_links( array(
		'total'        => $wp_query->max_num_pages,
		'current'      => max(1, get_query_var('paged')),
		'format'       => '?paged=%#%',
		'show_all'     => false,
		'end_size'     => 2,
		'mid_size'     => 1,
		'prev_next'    => true,
		'prev_text'    => __('<span>Préc</span>'),
		'next_text'    => __('<span>Suiv</span>'),
		'type'         => 'array',
		'add_args'     => false,
	));

	if (is_array($pages)) {
		$paged = (get_query_var('paged') == 0) ? 1 : get_query_var('paged');

		echo '<div class="search-pagination-wrap"><ul class="pagination">';
		foreach ($pages as $page) {
			echo "<li class='pagination-link'>$page</li>";
		}
		echo '</ul></div>';
	}
}

function ajax_get_artworks() {
	$page = isset($_POST['page']) ? $_POST['page'] : 1;
	$posts_per_page = $page == 1 ? 6 : 3;

	$args = array(
		'post_type' => 'artworks',
		'posts_per_page' => $posts_per_page,
		'paged' => $page,
		'orderby' => 'date',
		'order' => 'DESC'
	);

	if (isset($_POST['collection']) && !empty($_POST['collection'])) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'collection',
				'field' => 'slug',
				'terms' => $_POST['collection']
			)
		);
	}

	$query = new WP_Query($args);

	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();

			echo '<div class="artwork-item group flex flex-col w-full xl:w-fit my-8 group xl:mx-8">';
			    echo '<div class="w-[300px] 2xl:max-w-[400px] 2xl:w-[400px] h-[350px] 2xl:h-[450px] overflow-hidden block mx-auto my-4 rounded-2xl bg-light-white shadow-simple-25">';
				if (has_post_thumbnail()) {
					echo '<div class="bg-cover bg-no-repeat bg-center h-full w-full transition-transform duration-300 ease-in-out lg:scale-75 lg:group-hover:scale-100" style="background-image: url('. get_the_post_thumbnail_url() .');"></div>';
				}
				echo '</div>';
				echo '<h3 class="font-title text-center text-xl2 text-black">' . get_the_title() . '</h3>';
				$techniques = get_the_terms($post->ID,'technique');
				if ($techniques) {
					echo '<p class="flex flex-row flex-wrap justify-center text-center font-sans text-xs text-black max-w-[150px] mx-auto mb-4">';
					$index = 1;
					foreach ($techniques as $term) {
						if ($index === 1) {
							echo '<span>' . $term->name . '</span><span> + </span>';
						} else {
							echo '<span>' . $term->name . '</span>';
						}
						$index++;
					}
					echo '</p>';
				}
				echo '<div>';
					echo '<a href="' . get_the_permalink() . '" style="--bg-image: url('. get_the_post_thumbnail_url() .')" class="artwork-btn-bg-image block relative w-fit font-sans text-center mx-auto text-white text-xs px-8 py-2 rounded-full overflow-hidden before:content-[\'\'] before:absolute before:z-[3] before:inset-0 before:bg-black after:content-[\'\'] after:absolute after:z-[4] after:inset-0 after:bg-cover after:bg-center after:bg-no-repeat after:transition-opacity after:duration-300 after:ease-in-out after:opacity-0 after:bg-blend-hard-light group-hover:after:opacity-50"><span class="relative z-[5]">Je découvre !</span></a>';
				echo '</div>';
			echo '</div>';
		}
	}
	wp_die();
}
add_action('wp_ajax_get_artworks', 'ajax_get_artworks');
add_action('wp_ajax_nopriv_get_artworks', 'ajax_get_artworks');

function ajax_get_expositions() {
	$page = isset($_POST['page']) ? $_POST['page'] : 1;
	$region = isset($_POST['region']) ? $_POST['region'] : '';

	$args = array(
		'post_type' => 'exposition',
		'posts_per_page' => 6,
		'paged' => $page,
		'orderby' => 'meta_value',
		'order' => 'ASC',
		'meta_key' => 'start_date',
	);

	$date_filter = isset($_POST['date_filter']) ? explode(',', $_POST['date_filter']) : ['ongoing', 'upcoming']; // Valeurs par défaut pour la première visite
	$current_date = current_time('Ymd');
	$date_queries = [];

	foreach ($date_filter as $filter) {
		switch ($filter) {
			case 'past':
				$date_queries[] = array(
					'key'     => 'end_date',
					'value'   => $current_date,
					'compare' => '<',
					'type'    => 'DATE'
				);
				break;
			case 'ongoing':
				$date_queries[] = array(
					'relation' => 'AND',
					array(
						'key'     => 'start_date',
						'value'   => $current_date,
						'compare' => '<=',
						'type'    => 'DATE'
					),
					array(
						'key'     => 'end_date',
						'value'   => $current_date,
						'compare' => '>=',
						'type'    => 'DATE'
					)
				);
				break;
			case 'upcoming':
				$date_queries[] = array(
					'key'     => 'start_date',
					'value'   => $current_date,
					'compare' => '>',
					'type'    => 'DATE'
				);
				break;
		}
	}

	if (count($date_queries) > 1) {
		$args['meta_query'] = array_merge(['relation' => 'OR'], $date_queries);
	} else {
		$args['meta_query'] = $date_queries;
	}

	if (!empty($region)) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'region',
				'field'    => 'slug',
				'terms'    => $region
			)
		);
	}

	$query = new WP_Query($args);

	if ($query->have_posts()) {
		echo '<div id="exposition-items" class="flex flex-row justify-center flex-wrap px-4 lg:px-20 xl:px-32 2xl:px-[15%] mb-8">';
		while ($query->have_posts()) {
			$query->the_post();
			$terms = get_the_terms($post->ID, 'region');
			echo '<div class="artwork-item py-8 lg:px-4 h-auto relative w-full lg:w-1/2 group">';
				if (has_post_thumbnail()) {
					echo '<div class="bg-cover relative bg-no-repeat bg-center h-[300px] xl:h-[350px] 2xl:h-[450px] rounded-3xl overflow-hidden lg:rounded-none transition-all duration-300 ease-in-out lg:group-hover:rounded-3xl mb-4" style="background-image: url('. get_the_post_thumbnail_url() .');">';
						echo '<div class="absolute inset-0 bg-dark-opacity p-4 lg:p-12 transition-transform duration-300 ease-in-out translate-x-[-100%] group-hover:translate-x-0 group-focus:translate-x-0">';
							echo '<div class="flex flex-row-reverse justify-end">';
							if (!empty($terms)) {
								$index = 1;
								if ($terms >= 2) {
									foreach ( $terms as $term ) {
										if ($index == 2) {
											echo '<p class="inline-block uppercase text-l lg:text-xl3 font-sans text-white leading-5 expo-terms align-bottom font-black mt-auto mb-2"><span>'. $term->name .'</span><span class="mx-1">-</span></p>';
										} else {
											echo '<p class="inline-block uppercase text-l lg:text-xl3 font-sans text-white leading-5 expo-terms align-bottom font-black mt-auto mb-2"><span>'. $term->name .'</span></p>';
										}
										$index++;
									}
								} else {
									foreach ( $terms as $term ) {
										echo '<p class="inline-block uppercase text-l lg:text-xl3 font-sans text-white leading-5 expo-terms align-bottom font-black mt-auto mb-2"><span>'. $term->name .'</span></p>';
									}
								}
							}
							echo '</div>';
							echo '<div>';
							if (get_field('gallery_name')) {
								echo '<p class="font-sans text-l lg:text-xl3 text-white italic font-thin uppercase">' . get_field( 'gallery_name' ) . '</p>';
							}
							echo '</div>';
							echo '<div class="font-sans text-sm lg:text-l text-white leading-5 font-thin mt-2">';
							if (get_field('exposition_description')) {
								echo get_field( 'exposition_description' );
							}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
				echo '<div class="flex flex-col lg:flex-row justify-between">';
					echo '<div class="flex flex-col w-full lg:w-3/5">';
						echo '<h2 class="font-sans text-xl2 text-black font-bold text-center lg:text-left">' . get_the_title() . '</h2>';
						echo '<div class="flex flex-row justify-evenly lg:justify-between lg:w-11/12 lg:max-w-[280px]">';
							echo '<div class="inline-block mr-2">';
							if (get_field('start_date')) {
								$date = DateTime::createFromFormat('Ymd', get_field('start_date'));
								if ($date) {
									echo '<p class="font-sans text-xs inline-block leading-4 align-bottom">' . $date->format('d/m/Y') . '</p>';
								}
							}
							echo '</div>';
							echo '<div class="flex flex-row-reverse expo-terms">';
                            if (!empty($terms)) {
                                $index = 1;
                                if (count($terms) >= 2) {
                                    foreach ( $terms as $term ) {
										if ($index !== 1) {
											echo '<p class="inline-block uppercase text-xs font-sans font-medium expo-terms align-bottom mt-auto"><span>'. $term->name .'</span></p>';
										}
										$index++;
                                    }
                                } else {
                                    foreach ( $terms as $term ) {
                                        echo '<p class="inline-block uppercase text-xs font-sans font-medium expo-terms align-bottom mt-auto"><span>'. $term->name .'</span></p>';
                                    }
                                }
                            }
							echo '</div>';
						echo '</div>';
					echo '</div>';
					echo '<div class="flex flex-col justify-end mt-4 lg:mt-0">';
					if (get_field('exposition_link')) {
						echo '<a href="' . get_field( 'exposition_link' ) . '" class="relative text-black w-fit flex flex-row rounded-full overflow-hidden mx-auto lg:mx-0 group after:content-[\'\'] after:absolute after:z-[2] after:top-0 after:right-0 after:bottom-0 after:left-0 after:scale-x-0 after:transition-transform after:duration-300 after:ease-in-out after:origin-right after:bg-black group-hover:after:scale-x-100">';
							echo '<span class="relative z-[6] pl-[15px] pr-[15px] py-[5px] font-sans font-bold text-xs transition-colors group-hover:text-white duration-300 delay-150">En savoir plus</span>';
							echo '<span class="inline-block relative z-[3] w-[30px] h-[30px] bg-black rounded-full p-[9px] align-middle">';
								echo '<svg class="block mx-auto" width="7" height="9" viewBox="0 0 7 9" fill="none" xmlns="http://www.w3.org/2000/svg">';
									echo '<path d="M1 1L6 4.6129L1 8" stroke="white" stroke-width="0.7"/>';
								echo '</svg>';
							echo '</span>';
						echo '</a>';
					}
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}
		echo '</div>';

		$total_pages = $query->max_num_pages;
		$prev_page = $page - 1;
		$next_page = $page + 1;

		echo '<div id="exposition-pagination">';
			echo '<div class="inner-exposition-pagination flex flex-row justify-center">';
			for ($i = 1; $i <= $total_pages; $i++) {
				$class = $i == $page ? 'font-bold text-base' : 'font-medium text-sm';
				echo '<a href="#" class="pagination-link font-sans uppercase mx-2 flex flex-col justify-end ' . $class . '" data-page="' . $i . '"><span>' . $i . '</span></a> ';
			}
			echo '</div>';
			echo '<div class="inner-exposition-pagination-labels flex flex-row justify-center my-2">';
			if ($prev_page > 0) {
				echo '<a href="#" class="pagination-link font-sans text-sm font-medium text-black uppercase underline" data-page="' . $prev_page . '">Page précédente</a> ';
			}
			if ($next_page <= $total_pages) {
				echo '<a href="#" class="pagination-link font-sans text-sm font-medium text-black uppercase underline" data-page="' . $next_page . '">Page suivante</a>';
			}
			echo '</div>';
		echo '</div>';
	} else {
		echo '<div>';
			echo '<p class="font-sans text-base text-black text-center"> Aucune exposition à été trouvée</p>';
		echo '</div>';
	}
	wp_die();
}
add_action('wp_ajax_get_expositions', 'ajax_get_expositions');
add_action('wp_ajax_nopriv_get_expositions', 'ajax_get_expositions');

function ajax_get_press() {
	$page = isset($_POST['page']) ? $_POST['page'] : 1;
	$posts_per_page = $page == 1 ? 6 : 3;

	$args = array(
		'post_type' => 'articles-presse',
		'posts_per_page' => $posts_per_page,
		'paged' => $page,
		'orderby' => 'meta_value',
		'order' => 'ASC',
		'meta_key' => 'date',
	);

	$query = new WP_Query($args);

	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			$link = get_field('link');
			echo '<div class="presse-post-item group flex flex-col w-1/2 lg:w-fit my-8 group lg:mx-auto">';
				echo '<div class="w-[150px] lg:w-[250px] h-[180px] lg:h-[300px] block mx-auto my-2">';
				if (has_post_thumbnail()) {
					echo '<div class="bg-cover bg-no-repeat bg-center h-full w-full" style="background-image: url('. get_the_post_thumbnail_url() .');"></div>';
				}
				echo '</div>';
				echo '<h3 class="font-title text-center lg:text-left text-base text-black">' . get_the_title() . '</h3>';
				echo '<div>';
					echo '<p class="font-sans text-xxs text-black text-center lg:text-left">'. get_field('date')  .'</p>';
					echo '<a href="' . $link["url"] . '" class="press-btn block my-2 relative w-fit font-sans text-center mx-auto lg:ml-0 text-white text-xxs px-6 shadow-simple-25 py-1.5 rounded-full overflow-hidden before:content-[\'\'] before:absolute before:z-[3] before:inset-0 before:bg-black after:content-[\'\'] after:absolute after:z-[4] after:inset-0 after:bg-cover after:bg-center after:bg-no-repeat after:transition-opacity after:duration-300 after:ease-in-out after:opacity-0 after:bg-blend-hard-light group-hover:after:opacity-50"><span class="relative z-[5]">Je découvre !</span></a>';
				echo '</div>';
			echo '</div>';
		}
		$total_pages = $query->max_num_pages;
		$prev_page = $page - 1;
		$next_page = $page + 1;
		if ($total_pages > 1) {
			echo '<div id="press-pagination">';
				echo '<div class="inner-press-pagination flex flex-row justify-center">';
				for ($i = 1; $i <= $total_pages; $i++) {
					$class = $i == $page ? 'font-bold text-base' : 'font-medium text-sm';
					echo '<a href="#" class="pagination-link font-sans uppercase mx-2 flex flex-col justify-end ' . $class . '" data-page="' . $i . '"><span>' . $i . '</span></a> ';
				}
				echo '</div>';
				echo '<div class="inner-press-pagination flex flex-row justify-center my-2">';
				if ($prev_page > 0) {
					echo '<a href="#" class="pagination-link font-sans text-sm font-medium text-black uppercase underline" data-page="' . $prev_page . '">Page précédente</a> ';
				}
				if ($next_page <= $total_pages) {
					echo '<a href="#" class="pagination-link font-sans text-sm font-medium text-black uppercase underline" data-page="' . $next_page . '">Page suivante</a>';
				}
				echo '</div>';
			echo '</div>';
		}
	}
	wp_die();
}
add_action('wp_ajax_get_articles-presse', 'ajax_get_press');
add_action('wp_ajax_nopriv_get_articles-presse', 'ajax_get_press');