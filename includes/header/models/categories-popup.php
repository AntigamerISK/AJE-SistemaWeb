<?php

if ( ! function_exists( 'grogin_header_categories_popup' ) ) {
	function grogin_header_categories_popup(){
		$categoriespopup = get_theme_mod('grogin_categories_popup','0');
		if($categoriespopup == 1){
						
		?>
	<div class="header-categories-holder get-header-height">
        <div class="categories-holder-body">
          <div class="site-button close-button">
            <a href="#"><i class="klb-icon-x"></i></a>
          </div><!-- site-button -->      
		  <div class="categories-holder-inner">
            <div class="column">
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
            </div><!-- column -->
			<?php

				$args = array(
					'post_type' => 'product',
					'posts_per_page' => 5,
					'order'          => 'DESC',
					'post_status'    => 'publish',
				);

				$args['klb_special_query'] = true;

				$loop = new \WP_Query( $args );
			?>
			
            <div class="column products-separate-top">
              <div class="products list-style xs-list">
			  
				<?php 					
					if ( $loop->have_posts() ) {
						while ( $loop->have_posts() ) : $loop->the_post();
						global $product;
						global $post;
						global $woocommerce;
				?>
							
					<?php echo grogin_product_type_list2(); ?>
        
				<?php endwhile; }
					wp_reset_postdata();
				?>
        
              </div><!-- products -->
            </div><!-- column -->
			
			
          </div><!-- categories-holder-inner -->
        </div><!-- categories-holder-body -->
        <div class="categories-holder-overlay"></div>
      </div>
	<?php  }
	}
}