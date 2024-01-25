<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php wp_title(); ?></title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <header id="header" class="fixed top-0 left-0 right-0 z-[100] flex flex-col bg-white">
            <div class="w-full flex-row justify-end relative z-[15] hidden lg:flex bg-black px-[10%] py-1">
                <ul class="w-fit flex flex-row ">
                    <li class="w-fit mx-auto px-3 flex flex-col justify-center">
                        <a class="text-white block font-sans font-light hover:font-bold text-xxs uppercase" href="">Presse</a>
                    </li>
                    <li class="w-fit mx-auto px-3 flex flex-col justify-center">
                        <a class="text-white block font-sans font-light hover:font-bold text-xxs uppercase" href="">Contact</a>
                    </li>
                </ul>
                <ul class="w-fit flex flex-row px-8">
                    <li class="mx-1.5">
                        <a href="#" class="block">
                            <img class="w-[16px] h-auto" src="<?= get_stylesheet_directory_uri() ?>/assets/images/icons/instagram.png" alt="icone instagram">
                        </a>
                    </li>
                    <li class="mx-1.5">
                        <a href="#" class="block">
                            <img class="w-[16px] h-auto" src="<?= get_stylesheet_directory_uri() ?>/assets/images/icons/facebook.png" alt="icone facebook">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="flex flex-row justify-between lg:justify-start relative z-[20] px-4 py-2">
                <div class="flex flex-col lg:mr-8">
                    <a href="<?= home_url() ?>" class="custom-logo-link relative z-[20] block w-[150px] h-[30px] my-auto" rel="home">
                        <img class="logo-black transition-opacity duration-300 ease-in-out absolute top-0 left-0" src="<?= get_stylesheet_directory_uri() ?>/assets/images/logo-stephanegubert-black.png" alt="logo stephane gubert en noir">
                        <img class="logo-white transition-opacity duration-300 ease-in-out absolute top-0 left-0" src="<?= get_stylesheet_directory_uri() ?>/assets/images/logo-stephanegubert-white.png" alt="logo stephane gubert en blanc">
                    </a>
                </div>
                <div class="menu-nav-container fixed lg:static z-[19] top-0 left-0 right-0 h-100vh lg:h-auto flex flex-col-reverse bg-black lg:bg-transparent justify-between pt-24 lg:pt-0 pb-8 lg:pb-0 transition-transform duration-300 ease-in-out before:content-[''] before:absolute before:top-0 before:left-0 before:right-0 before:bottom-0 before:z-[10]">
                    <div class="w-full flex flex-col justify-end relative z-[15] lg:hidden">
                        <ul class="w-full flex flex-col">
                            <li class="w-[90%] mx-auto py-2 px-3.5 border-t-opacity">
                                <a class="text-white block font-sans font-medium text-base uppercase" href="<?= home_url() ?>/espace-presse">Presse</a>
                            </li>
                            <li class="w-[90%] mx-auto py-2 px-3.5 border-t-opacity">
                                <a class="text-white block font-sans font-medium text-base uppercase" href="#contact">Contact</a>
                            </li>
                        </ul>
                        <ul class="w-full flex flex-row px-8 mt-4">
                            <li class="mx-2.5">
                                <a href="#" class="block">
                                    <img class="w-[16px] h-auto" src="<?= get_stylesheet_directory_uri() ?>/assets/images/icons/instagram.png" alt="icone instagram">
                                </a>
                            </li>
                            <li class="mx-2.5">
                                <a href="#" class="block">
                                    <img class="w-[16px] h-auto" src="<?= get_stylesheet_directory_uri() ?>/assets/images/icons/facebook.png" alt="icone facebook">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="w-full flex flex-row justify-between relative z-[15]">
                        <nav id="main-menu" class="w-full">
				            <?php
				            wp_nav_menu(array(
					            'theme_location' => 'primary',
					            'menu_id' => 'primary-menu',
				            ));
				            ?>
                        </nav>
                    </div>
                </div>
                <div class="mobile-button relative z-[20] lg:hidden menu-open cursor-pointer w-[60px] text-center">
                    <button class="block h-[20px] w-[20px] mx-auto">
                        <span></span>
                        <span></span>
                    </button>
                    <p class="font-sans text-white font-medium leading-3 text-xxs hidden menu-button-text">Fermer</p>
                    <p class="font-sans text-black font-medium leading-3 text-xxs block menu-button-text">Menu</p>
                </div>
                <div class="absolute right-[23%] lg:right-[10%] z-[20] h-[80%] flex flex-col justify-center cursor-pointer text-center">
                    <div class="flex flex-row">
                        <div class="menu-search-container mx-2">
		                    <?php get_search_form(); ?>
                        </div>
                        <div class="flex flex-col justify-center">
                            <a href="<?= wc_get_cart_url() ?>">
                                <img class="w-[18px] h-auto" src="<?= get_stylesheet_directory_uri() ?>/assets/images/icons/cart-icon-black.svg" alt="icone du panier">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div id="content">