<?php
if ( ! function_exists( 'grogin_trending_products' ) ) {
	function grogin_trending_products(){
	?>	
	
	<?php $trending_products = get_theme_mod('grogin_header_products_tab2','0'); ?>
		<?php if($trending_products == '1'){ ?>
			<div class="custom-button has-children">
                <a href="#"><?php echo grogin_sanitize_data(get_theme_mod('grogin_header_products2_button_title')); ?></a>
                <div class="custom-button-holder">
					<div class="custom-holder-header d-flex flex-wrap align-items-center">
						<h3 class="text-15 mb-0"><?php echo esc_html(get_theme_mod('grogin_header_products_tab2_title')); ?></h3>
						<p class="text-12 text-gray-500 mb-0 ml-10"><?php echo esc_html(get_theme_mod('grogin_header_products_tab2_subtitle')); ?></p>
					</div><!-- custom-holder-header -->
					
					<?php

						$args = array(
							'post_type' => 'product',
							'posts_per_page' => get_theme_mod('grogin_header_products_tab2_post_count','6'),
							'order'          => 'DESC',
							'post_status'    => 'publish',
						);

						$args['klb_special_query'] = true;

						if(get_theme_mod('grogin_header_products_tab2_hide_out_of_stock_items') == '1'){
							$args['tax_query'] = array(
								array(
									'taxonomy' => 'product_visibility',
									'field'    => 'name',
									'terms'    => 'outofstock',
									'operator' => 'NOT IN',
								),
							); // WPCS: slow query ok.
						}

						if(get_theme_mod('grogin_header_products_tab2_best_selling') == '1'){
							$args['meta_key'] = 'total_sales';
							$args['orderby'] = 'meta_value_num';
						}

						if(get_theme_mod('grogin_header_products_tab2_featured') == '1'){
							$args['tax_query'] = array( array(
								'taxonomy' => 'product_visibility',
								'field'    => 'name',
								'terms'    => array( 'featured' ),
									'operator' => 'IN',
							) );
						}
						
						if(get_theme_mod('grogin_header_products_tab2_on_sale') == '1'){
							$args['meta_key'] = '_sale_price';
							$args['meta_value'] = array('');
							$args['meta_compare'] = 'NOT IN';
						}

						$loop = new \WP_Query( $args );
					?>
					
					<div class="products column-6">
						<?php 					
							if ( $loop->have_posts() ) {
								while ( $loop->have_posts() ) : $loop->the_post();
									global $product;
									global $post;
									global $woocommerce;
						?>
							
							
							<?php echo grogin_product_type_header(); ?>
							
						
						<?php 
								endwhile;
							}
							wp_reset_postdata();
						?>
					</div><!-- products -->
                </div><!-- custom-button-holder -->
            </div><!-- custom-button -->
			
	<?php } 

	}
}