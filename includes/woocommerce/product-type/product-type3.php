<?php
/*----------------------------
  Product Type 3
 ----------------------------*/
function grogin_product_type3($stockprogressbar = '', $stockstatus = '', $shippingclass = '', $countdown = '', $product_type = '', $product_sku = '', $productattributes = ''){
	global $product;
	global $post;
	global $woocommerce;
	
	if($product_type != 'type3') {
		return;
	}
	
	$output = '';
	
	$id = get_the_ID();
	$allproduct = wc_get_product( get_the_ID() );

	$cart_url = wc_get_cart_url();
	$price = $allproduct->get_price_html();
	$weight = $product->get_weight();
	$stock_status = $product->get_stock_status();
	$stock_text = $product->get_availability();
	$short_desc = $product->get_short_description();
	$rating = wc_get_rating_html($product->get_average_rating());
	$ratingcount = $product->get_review_count();
	$ratingaverage  = $product->get_average_rating();


	$wishlist = get_theme_mod( 'grogin_wishlist_button', '0' );
	$compare = get_theme_mod( 'grogin_compare_button', '0' );
	$quickview = get_theme_mod( 'grogin_quick_view_button', '0' );

	$managestock = $product->managing_stock();
	$stock_quantity = $product->get_stock_quantity();
	$stock_format = esc_html__('Only %s unit left','grogin');
	$stock_poor = '';
	if($managestock && $stock_quantity < 10) {
		$stock_poor .= '<div class="product-inventory color-red">'.sprintf($stock_format, $stock_quantity).'</div>';
	}
	
	$total_sales = $product->get_total_sales();
	$total_stock = $total_sales + $stock_quantity;
	
	if($managestock && $stock_quantity > 0) {
	$progress_percentage = floor($total_sales / (($total_sales + $stock_quantity) / 100)); // yuvarlama
	}
	
	$gallery = get_theme_mod('grogin_product_box_gallery') == 1 ? 'product-thumbnail' : '';
		
		$output .= '<div class="product-wrapper p-10 sm-p-15 style-3 product-type-3">';
		$output .= '<div class="product-inner">';
		$output .= '<div class="thumbnail-wrapper">';
		
		$output .= grogin_sale_percentage();
         
		$output .= '<div class="thumbnail-buttons">';
			ob_start();
			do_action('grogin_wishlist_action');
			$output .= ob_get_clean();
			
			$output .= grogin_quickview();	

			ob_start();
			do_action('grogin_compare_action');
			$output .= ob_get_clean();
			
		$output .= '</div><!-- thumbnail-buttons -->';
        
		$output .= '<div class="product-thumbnail entry-media">';
			ob_start();
			$output .= grogin_product_second_image();
			$output .= ob_get_clean();
		$output .= '</div><!-- product-thumbnail -->';
		$output .= '</div><!-- thumbnail-wrapper -->';
		
		ob_start();
		do_action('grogin_after_shop_loop_item_image');
		$output .= ob_get_clean();
		
		$output .= '<div class="content-wrapper">';
		$output .= '<div class="product-heading">';
		$output .= '<h2 class="product-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h2>';	
		
		if($ratingcount){
			$output .= '<div class="product-rating">';
			$output .= $rating;
			$output .= '<div class="rating-count">';
			$output .= '<span class="count-text">'.esc_html($ratingcount).'</span>';
			$output .= '</div><!-- rating-count -->';
			$output .= '</div><!-- product-rating -->';  
		} 
		
		$output .= '</div><!-- product-heading -->';
        
		$output .= '<div class="product-price-wrapper d-flex flex-column align-items-start gap-1">';

		$output .= '<span class="price">';
		$output .= $price;
		$output .= '</span><!-- price -->';         
		$output .= '</div><!-- product-price-wrapper -->';

		$output .= '<div class="product-car-flex d-flex align-items-center gap-3 mt-14">';
		$output .= grogin_loop_add_to_cart($id, 'product_type3');
		
		if(get_theme_mod('grogin_product_box_stock_status', 0) == '1'){
			ob_start();
			$output .= grogin_poor_stock_status($stockprogressbar, $stockstatus);
			$output .= ob_get_clean();
		}
		
		
		$output .= '</div><!-- product-car-flex -->';
		$output .= '</div><!-- content-wrapper -->';
		$output .= '</div><!-- product-inner -->';
		
		ob_start();
		$output .= grogin_product_box_stock_progress_bar($stockprogressbar);
		$output .= ob_get_clean();
		
		ob_start();
		$output .= grogin_shipping_class_name($stockprogressbar, $stockstatus, $shippingclass);
		$output .= ob_get_clean();
		
		ob_start();
		$output .= grogin_product_box_time_countdown($stockprogressbar, $stockstatus, $shippingclass, $countdown);
		$output .= ob_get_clean();
		
		ob_start();
		$output .= grogin_product_sku($stockprogressbar, $stockstatus, $shippingclass, $countdown, $product_sku);
		$output .= ob_get_clean();
		
		ob_start();
		$output .= grogin_product_attributes($stockprogressbar, $stockstatus, $shippingclass, $countdown, $product_sku, $productattributes);
		$output .= ob_get_clean();
		
		$output .= '</div><!-- product-wrapper -->';
		
		ob_start();
		do_action('grogin_after_product_box');
		$output .= ob_get_clean();
		
	echo $output;
}
add_action('klb_product_box','grogin_product_type3', 10, 7); 