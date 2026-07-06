<?php
/*----------------------------
  Product Type List
 ----------------------------*/
function grogin_product_type_list(){
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
	$wishlist = get_theme_mod( 'grogin_wishlist_button', '0' );
	$compare = get_theme_mod( 'grogin_compare_button', '0' );
	$quickview = get_theme_mod( 'grogin_quick_view_button', '0' );

	if( $product->is_type('variable') ) {
		$variation_ids = $product->get_visible_children();

		if($variation_ids[0]){
			$variation = wc_get_product( $variation_ids[0] );

			$sale_price_dates_to = ( $date = get_post_meta( $variation_ids[0], '_sale_price_dates_to', true ) ) ? date_i18n( 'Y/m/d', $date ) : '';
		} else {
			$sale_price_dates_to = '';
		}
	} else {
		$sale_price_dates_to = ( $date = get_post_meta( $id, '_sale_price_dates_to', true ) ) ? date_i18n( 'Y/m/d', $date ) : '';
	}
	
	$managestock = $product->managing_stock();
	$stock_quantity = $product->get_stock_quantity();
	$stock_format = esc_html__('Only %s left in stock','grogin');
	$stock_poor = '';
	if($managestock && $stock_quantity < 10) {
		$stock_poor .= '<div class="product-inventory color-red">'.sprintf($stock_format, $stock_quantity).'</div>';
	}

	$postview  = isset( $_POST['shop_view'] ) ? $_POST['shop_view'] : '';
		
		$output .= '<div class="product-wrapper p-10 sm-p-15 product-type-1">';
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
		$output .= '</span>';          
		$output .= '</div><!-- product-price-wrapper -->';

		$output .= grogin_loop_add_to_cart($id, 'product_type1');
		
		$output .= '</div><!-- content-wrapper -->';
		$output .= '</div><!-- product-inner -->';
		
		if($short_desc){
			$output .= '<div class="product-excerpt entry-excerpt">';
			$output .= $short_desc;
			$output .= '</div>';
		}
		
		$output .= '</div><!-- product-wrapper -->';
		
		ob_start();
		do_action('grogin_after_product_box');
		$output .= ob_get_clean();
		
	return $output;
}