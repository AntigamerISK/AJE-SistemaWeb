<?php

/*************************************************
## Grogin Theme options
*************************************************/
require_once get_template_directory() . '/includes/header/models/search.php';
require_once get_template_directory() . '/includes/header/models/search-holder.php';
require_once get_template_directory() . '/includes/header/models/cart.php';
require_once get_template_directory() . '/includes/header/models/cart-2.php';
require_once get_template_directory() . '/includes/header/models/cart-3.php';
require_once get_template_directory() . '/includes/header/models/wishlist-icon.php';
require_once get_template_directory() . '/includes/header/models/wishlist-icon-2.php';
require_once get_template_directory() . '/includes/header/models/wishlist-icon-3.php';
require_once get_template_directory() . '/includes/header/models/compare-icon.php';
require_once get_template_directory() . '/includes/header/models/account-icon.php';
require_once get_template_directory() . '/includes/header/models/account-icon-2.php';
require_once get_template_directory() . '/includes/header/models/account-icon-3.php';
require_once get_template_directory() . '/includes/header/models/discount-products.php';
require_once get_template_directory() . '/includes/header/models/trending-products.php';
require_once get_template_directory() . '/includes/header/models/sidebar-menu.php';
require_once get_template_directory() . '/includes/header/models/top-notification.php';
require_once get_template_directory() . '/includes/header/models/categories-popup.php';
require_once get_template_directory() . '/includes/header/models/mobile-categories-menu.php';
/*************************************************
## Main Header Function
*************************************************/

add_action('grogin_main_header','grogin_main_header_function',20);

if ( ! function_exists( 'grogin_main_header_function' ) ) {
	function grogin_main_header_function(){
		
		if(grogin_page_settings('page_header_type') == 'type5') {
			
			get_template_part( 'includes/header/header-type5' );
			
		} elseif(grogin_page_settings('page_header_type') == 'type4') {
			
			get_template_part( 'includes/header/header-type4' );
			
		} elseif(grogin_page_settings('page_header_type') == 'type3') {
			
			get_template_part( 'includes/header/header-type3' );
			
		} elseif(grogin_page_settings('page_header_type') == 'type2') {
			
			get_template_part( 'includes/header/header-type2' );
			
		} elseif(grogin_page_settings('page_header_type') == 'type1') {
			
			get_template_part( 'includes/header/header-type1' );
			
		} elseif(get_theme_mod('grogin_header_type') == 'type5'){
			
			get_template_part( 'includes/header/header-type5' );
			
		} elseif(get_theme_mod('grogin_header_type') == 'type4'){
			
			get_template_part( 'includes/header/header-type4' );
			
		} elseif(get_theme_mod('grogin_header_type') == 'type3'){
			
			get_template_part( 'includes/header/header-type3' );
			
		} elseif(get_theme_mod('grogin_header_type') == 'type1'){
			
			get_template_part( 'includes/header/header-type1' );
			
		} else {
			
			get_template_part( 'includes/header/header-type2' );
			
		}
		
	}
}
