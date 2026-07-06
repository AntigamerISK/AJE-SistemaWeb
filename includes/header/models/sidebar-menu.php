<?php
if ( ! function_exists( 'grogin_sidebar_menu' ) ) {
	function grogin_sidebar_menu(){
	?>
		<?php $sidebarmenu = get_theme_mod('grogin_header_sidebar','0'); ?>
		<?php if($sidebarmenu == '1'){ ?>
		
		
		<div class="categories-menu">
			<a href="#" class="categories-toggle"><i class="klb-icon-layout-grid"></i><?php esc_html_e('All Categories','grogin'); ?></a>
			
			<?php if(grogin_page_settings('enable_sidebar_collapse') == 'yes'){ ?>
				<?php $menu_collapse = 'collapse show'; ?>
			<?php } else { ?>
				<?php $menu_collapse = is_front_page() && !get_theme_mod('grogin_header_sidebar_collapse') ? 'collapse show' : 'collapse'; ?>
			<?php } ?>
			
			<nav class="site-categories <?php echo esc_attr($menu_collapse); ?>">
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
			</nav><!-- site-categories -->
		</div>			
		
		<?php  }
	}
}