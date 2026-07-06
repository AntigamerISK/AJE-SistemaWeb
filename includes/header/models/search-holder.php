<?php
if ( ! function_exists( 'grogin_search_holder' ) ) {
	function grogin_search_holder(){
		$headersearch = get_theme_mod('grogin_header_search','0');
		if($headersearch == 1){
		
		?>
			<div id="search-drawer" class="site-drawer site-search-drawer get-header-height get-mobile-nav-height">
				<div class="site-drawer-inner site-scroll">
					<div class="site-drawer-row">
						<div class="header-search search-overlay flex-fill">
							<form action="<?php echo esc_url( home_url( '/'  ) ); ?>" class="search-form" role="search" method="get">
								<input class="form-control search-input filled" type="search" name="s" value="<?php echo get_search_query(); ?>" placeholder="<?php esc_attr_e('Search for products, categories or brands...', 'grogin'); ?>" autocomplete="off">
								<button type="submit"><i class="klb-icon-search"></i></button>
								<input type="hidden" name="post_type" value="product" />
							</form>
							<div class="header-search-result">
								
								
								<?php if(function_exists('grogin_get_most_popular_keywords') && grogin_get_most_popular_keywords()){ ?>
									<?php $total_products = wp_count_posts( 'product' ); ?>
									<?php $total_count = $total_products->publish; ?>
									<?php $total_format = esc_html__('Out of a total of %s products:','grogin'); ?>
									
									<div class="search-popular-tags d-flex flex-column align-items-start">
										<span class="text-12 text-gray-500 lh-1 mr-10"><?php echo sprintf($total_format, $total_count); ?></span>
										<?php echo grogin_get_most_popular_keywords(); ?>
									</div><!-- search-popular-tags -->
									
								<?php } ?>
							</div><!-- header-search-result -->
						</div><!-- header-search -->      
						<span class="d-block text-12 text-center text-gray-400 mt-6"><?php esc_attr_e('Type the product you want to search for and press enter.', 'grogin'); ?></span>
					</div><!-- site-drawer-row -->
				</div><!-- site-drawer-inner -->
				<div class="site-drawer-overlay position-absolute strech"></div>
			</div><!-- site-drawer -->
	
		<?php  }
	}
}
add_action('wp_footer', 'grogin_search_holder');