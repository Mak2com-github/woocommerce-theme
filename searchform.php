<form class="search-form flex flex-row p-0 relative group overflow-hidden" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" role="search">
	<label for="search-input" class="block relative z-[5] mr-0 w-0 translate-x-[150%] transition-transform origin-right duration-300 ease-in-out group-hover:translate-x-0 group-hover:w-auto group-hover:mr-2.5">
		<span class="screen-reader-text hidden"><?php _e('Search for:', 'text-domain'); ?></span>
		<input type="search" id="search-input" class="search-input border border-black px-2.5 font-sans font-regular text-xs block focus:outline-0" name="s" value="<?php echo get_search_query(); ?>" placeholder="<?php echo esc_attr_x('Que cherchez-vous ?', 'placeholder', 'text-domain'); ?>" autocomplete="off">
	</label>
	<button type="submit" class="search-submit relative z-[6] bg-white">
		<span class="screen-reader-text"><?php _e('Search Button', 'text-domain'); ?></span>
		<span class="search-icon">
			<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="SearchIconGroup">
                    <path id="SearchIconVector" d="M17.3091 17.6288L17.3621 17.6818L17.4152 17.6288L17.7723 17.2716L17.8254 17.2186L17.7723 17.1656L13.2695 12.6627C14.4138 11.4057 15.138 9.73484 15.138 7.88794L15.138 7.88751C15.1154 3.98462 11.9346 0.803784 8.00916 0.803784C4.08352 0.803784 0.925 3.98494 0.925 7.88794C0.925 11.7911 4.106 14.9721 8.00916 14.9721C9.83337 14.9721 11.5261 14.2702 12.7844 13.1041L17.3091 17.6288ZM8.00916 14.331C4.45688 14.331 1.58841 11.4406 1.58841 7.91026C1.58841 4.38014 4.47903 1.48952 8.00916 1.48952C11.5393 1.48952 14.4299 4.38014 14.4299 7.91026C14.4299 11.4406 11.5614 14.331 8.00916 14.331Z" fill="black" stroke="black" stroke-width="0.15"/>
                </g>
            </svg>
        </span>
	</button>
	<input type="hidden" name="id" value="147">
</form>
