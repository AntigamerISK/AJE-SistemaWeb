<?php
/*----------------------------
  Product Type Header
 ----------------------------*/
function grogin_product_type_header($stockprogressbar = '', $stockstatus = '', $shippingclass = '', $countdown = ''){
	global $product;
	global $post;
	global $woocommerce;
	
	
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
	
		$output .= '<div class="product">';
		$output .= '<div class="product-wrapper p-10 sm-p-15 style-2 product-type-2">';
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
        
		$output .= grogin_loop_add_to_cart($id, 'product_type2');
       
		$output .= '</div><!-- thumbnail-wrapper -->';
	
		$output .= '<div class="content-wrapper">';
		$output .= '<div class="product-heading">';
		
		if($ratingcount){
			$output .= '<div class="product-rating">';
			$output .= $rating;
			$output .= '<div class="rating-count">';
			$output .= '<span class="count-text">'.esc_html($ratingcount).'</span>';
			$output .= '</div><!-- rating-count -->';
			$output .= '</div><!-- product-rating -->';  
		}
		
		$output .= '<h2 class="product-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h2>';	
		$output .= '</div><!-- product-heading -->';
       
		$output .= '<div class="product-price-wrapper d-flex flex-column align-items-start gap-1">';
		
		$output .= '<span class="price">';
		$output .= $price;	
		$output .= '</span><!-- price -->';         
		$output .= '</div><!-- product-price-wrapper -->';
		$output .= '</div><!-- content-wrapper -->';
		$output .= '</div><!-- product-inner -->';
		
		if($managestock && $stock_quantity > 0) {
		
			$output .= '<div class="product-footer bordered">';
			$output .= '<div class="product-progress">';
			$output .= '<span class="d-block text-11 text-gray-400 mb-8">'.esc_html__('This product is about to run out','grogin').'</span>';
			$output .= '<div class="site-progress-bar"><span style="width: '.$progress_percentage.'%;"></span></div>';
			$output .= '<div class="product-progress-detail">';
			$output .= '<p>'.esc_html__('available only:','grogin').'</p> <span>'.esc_html($stock_quantity).'</span>';
			$output .= '</div><!-- product-progress-detail -->';
			$output .= '</div><!-- product-progress -->';
			$output .= '</div><!-- product-footer -->';
		}
		
		$output .= '</div><!-- product-wrapper -->';
		$output .= '</div><!-- product -->';
		
	return $output;
}