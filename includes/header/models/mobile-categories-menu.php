<?php
if ( ! function_exists( 'grogin_mobile_categories_menu' ) ) {
	function grogin_mobile_categories_menu(){
	?>
		<?php $sidebarmenus = get_theme_mod('grogin_header_sidebar','0'); ?>
		<?php if($sidebarmenus == '1'){ ?>
	
			<div id="categories-drawer" class="site-drawer site-categories-drawer get-header-height get-mobile-nav-height">
				<div class="site-drawer-inner site-scroll">
					<nav class="site-categories">
						<?php
						wp_nav_menu(array(
						'theme_location' => 'sidebar-menu',
						'container' => '',
						'fallback_cb' => 'show_top_menu',
						'menu_id' => 'category-menu',
						'menu_class' => '',
						'echo' => true,
						"walker" => '',
						'depth' => 0 
						));
						?>
					</nav>
				</div><!-- site-drawer-inner -->
				<div class="site-drawer-overlay position-absolute strech"></div>
			</div><!-- site-drawer -->
			
		<?php  }
	}
}			

add_action('grogin_before_main_header', 'grogin_mobile_categories_menu');