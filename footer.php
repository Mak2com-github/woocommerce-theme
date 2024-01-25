            </div><!-- #content -->
        <div id="footerBefore" class="footer-before">
            <div class="w-[99%] bg-black py-8 rounded-tr-xl rounded-br-xl relative">
                <div class="absolute h-full w-[150px] top-0 left-0 bottom-0 z-[5] overflow-hidden hidden lg:block">
                    <div class="absolute w-[60px] h-[200px] bg-center bg-no-repeat bg-cover top-[-20%] left-0" style="background-image: url('<?= home_url() ?>/wp-content/uploads/2024/01/a7b4dab327cf254239fdec21598a8823-scaled.webp')"></div>
                    <div class="absolute w-[60px] h-[200px] bg-center bg-no-repeat bg-cover top-[5%] right-0" style="background-image: url('<?= home_url() ?>/wp-content/uploads/2024/01/6d05b42c6e0ce8c352780fc54214b276.webp')"></div>
                    <div class="absolute w-[60px] h-[200px] bg-center bg-no-repeat bg-cover top-[25%] left-0" style="background-image: url('<?= home_url() ?>/wp-content/uploads/2024/01/ac355ce603bb17873563f6a15ef2685f-scaled.webp')"></div>
                    <div class="absolute w-[60px] h-[200px] bg-center bg-no-repeat bg-cover top-[50%] right-0" style="background-image: url('<?= home_url() ?>/wp-content/uploads/2024/01/4e47cd2e65a791b1377c209c923a5e93.webp')"></div>
                    <div class="absolute w-[60px] h-[200px] bg-center bg-no-repeat bg-cover top-[70%] left-0" style="background-image: url('<?= home_url() ?>/wp-content/uploads/2024/01/efbc27a0225e50cc2a0726ec45261523.webp')"></div>
                </div>
                <div class="w-full lg:w-1/2 mx-auto relative z-[6]">
                    <h2 class="font-title text-white text-xl font-regular uppercase text-center lg:mb-8">Contactez-moi</h2>
	                <?= do_shortcode('[ninja_form id=1]') ?>
                </div>
            </div>
        </div>
        <footer id="footer" class="flex flex-col lg:px-20">
            <div class="flex flex-col-reverse lg:flex-row lg:justify-between lg:py-12 mt-8 relative before:content-[''] lg:before:hidden before:absolute before:top-0 before:left-4 before:right-4 before:h-[1px] before:bg-black before:opacity-50 after:content-[''] after:absolute after:bottom-0 after:left-4 after:right-4 after:h-[1px] after:bg-black after:opacity-50">
                <div class="w-full lg:w-2/5 flex flex-row lg:flex-col lg:justify-start justify-between p-4">
                    <div class="lg:mb-4 lg:mt-4">
                        <a href="<?= home_url() ?>" class="block w-fit mx-auto">
                            <img class="" src="<?= get_stylesheet_directory_uri() ?>/assets/images/logo-stephanegubert-black.svg" alt="logo stephane gubert noir">
                        </a>
                    </div>
                    <ul class="flex flex-row justify-center">
                        <li class="flex mx-2">
                            <a href="#" class="block my-auto">
                                <img src="<?= get_stylesheet_directory_uri() ?>/assets/images/icons/instagram-black.svg" alt="icone instagram">
                            </a>
                        </li>
                        <li class="flex mx-2">
                            <a href="#" class="block my-auto">
                                <img src="<?= get_stylesheet_directory_uri() ?>/assets/images/icons/facebook-black.svg" alt="icone facebook">
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="w-full lg:w-1/2 2xl:w-2/5 flex flex-col">
                    <ul class="grid grid-cols-2 grid-rows-4 gap-2 lg:grid-cols-custom-fr lg:grid-rows-3fr lg:gap-y-4 lg:gap-x-12 p-4">
                        <li class="">
                            <a class="font-sans font-bold text-black uppercase text-sm" href="<?= home_url() ?>/">S.Gubert</a>
                        </li>
                        <li class="col-start-1 row-start-2">
                            <a class="font-sans font-bold text-black uppercase text-sm" href="<?= home_url() ?>/">collab</a>
                        </li>
                        <li class="col-start-1 row-start-3">
                            <a class="font-sans font-bold text-black uppercase text-sm" href="<?= home_url() ?>/">Exposition</a>
                        </li>
                        <li class="col-start-2 row-start-1">
                            <a class="font-sans font-bold text-black uppercase text-sm" href="<?= home_url() ?>/">Artwork</a>
                        </li>
                        <li class="col-start-1 row-start-4 lg:col-start-2 lg:row-start-2">
                            <a class="font-sans font-bold text-black uppercase text-sm" href="<?= home_url() ?>/">Shop</a>
                        </li>
                        <li class="col-start-2 row-start-2 lg:row-start-3">
                            <a class="font-sans font-bold text-black uppercase text-sm" href="<?= home_url() ?>/">Presse & Actus</a>
                        </li>
                        <li class="col-start-2 row-start-3 lg:col-start-3 lg:row-start-1">
                            <a class="font-sans font-light text-black uppercase text-sm" href="<?= home_url() ?>/">Panier</a>
                        </li>
                        <li class="col-start-2 row-start-4 lg:col-start-3 lg:row-start-2">
                            <a class="font-sans font-light text-black uppercase text-sm" href="<?= home_url() ?>/">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="sub-menu flex flex-row justify-between p-4">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer-legals',
                    'menu_id' => 'footerLegals',
                ));
                ?>
                <div class="footer-copyright">
                    <p><span>&copy;</span> <span><?php bloginfo('name'); ?></span> - <span>Artiste Peintre</span> <span><?php echo date('Y'); ?></span></p>
                </div>
            </div>
        </footer>
        <?php wp_footer(); ?>
    </body>
</html>