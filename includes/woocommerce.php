<?php

/*************************************************
## Woocommerce 
*************************************************/

/*************************************************
## Grogin Product Box
*************************************************/
require_once get_template_directory() . '/includes/woocommerce/product-type/product-type1.php';
require_once get_template_directory() . '/includes/woocommerce/product-type/product-type2.php';
require_once get_template_directory() . '/includes/woocommerce/product-type/product-type3.php';
require_once get_template_directory() . '/includes/woocommerce/product-type/product-type-header.php';
require_once get_template_directory() . '/includes/woocommerce/product-type/product-type-list.php';
require_once get_template_directory() . '/includes/woocommerce/product-type/product-type-list2.php';
require_once get_template_directory() . '/includes/woocommerce/add-to-cart.php';

/*************************************************
## Grogin Image
*************************************************/
function grogin_product_image(){
	global $product;

	$size = get_theme_mod( 'grogin_product_image_size', array( 'width' => '', 'height' => '') );

	if($size['width'] && $size['height']){
		$image = $product->get_image(array( $size['width'], $size['height'] ), array('class' => 'wp-post-image'));
	} else {
		$image = $product->get_image('woocommerce_thumbnail',array('class' => 'wp-post-image'));
	}

	return $image;

}

/*************************************************
## Grogin Second Image
*************************************************/
function grogin_product_second_image(){
	global $product;
	
	$product_image_ids = $product->get_gallery_image_ids();
	$size = get_theme_mod( 'grogin_product_image_size', array( 'width' => '', 'height' => '') );
	
	if(get_theme_mod('grogin_product_box_gallery') == 'zoom' || grogin_ft() == 'productbox_zoom'){
		echo '<div class="product-box-image-zoom">';
		echo '<a class="product-zoom" href="'.get_permalink().'">';
		echo grogin_product_image();
		echo '</a>';
		echo '</div>';
	} elseif($product_image_ids && get_theme_mod('grogin_product_box_gallery') == 'flip' || grogin_ft() == 'productbox_flip'){
		echo '<a href="'.get_permalink().'" class="product-thumbnail">';
		echo '<div class="product-second-image">';
		
		$gallery_count = 1;	
		foreach( $product_image_ids as $product_image_id ){
			if($gallery_count == 1){	
				if($size['width'] && $size['height']){
					echo wp_get_attachment_image($product_image_id, array( $size['width'], $size['height'] ));
				} else {
					echo  wp_get_attachment_image($product_image_id, 'full');
				}
			}	
			$gallery_count++;
		}		
	
		echo '</div><!-- product-second-image -->';
		echo grogin_product_image();
		echo '</a>';
	} elseif($product_image_ids && get_theme_mod('grogin_product_box_gallery') == 'slider' || grogin_ft() == 'productbox_slider'){
		
		wp_enqueue_script( 'grogin-hoverslider');
		
		echo '<a href="'.get_permalink().'" class="product-thumbnail product-hover-gallery">';
		echo '<div class="product-gallery">';
		
		echo '<div class="product-gallery-item">';
		echo grogin_product_image();
		echo '</div>';
		
		foreach( $product_image_ids as $product_image_id ){
			echo '<div class="product-gallery-item">';
			if($size['width'] && $size['height']){
				echo wp_get_attachment_image($product_image_id, array( $size['width'], $size['height'] ));
			} else {
				echo  wp_get_attachment_image($product_image_id, 'full');
			}
			echo '</div><!-- product-gallery-item -->';
		}
		echo '</div><!-- product-gallery -->';
		echo '</a>';
		
	} else {
		if(get_theme_mod('grogin_product_box_variable') == '1' || grogin_ft() == 'box_variable' || isset( $_REQUEST['klb-product-box-variable'])){
			echo '<div class="images">';
			echo '<div class="woocommerce-product-gallery__image">';
			echo '<a href="'.get_permalink().'"></a>';
			echo '<a href="'.get_permalink().'" class="product-thumbnail product-hover-gallery">';
			echo grogin_product_image();
			echo '</a>';
			echo '</div>';
			echo '</div>';
		} else {
			echo '<a href="'.get_permalink().'" class="product-thumbnail product-hover-gallery">';
			echo grogin_product_image();
			echo '</a>';
		}
	}
}


/*************************************************
## Sale Percentage
*************************************************/
function grogin_sale_percentage(){
	global $product;

	$output = '';
	
	if(get_theme_mod('grogin_product_badge_tab', 0) == 1){
		
		$product = wc_get_product(get_the_ID());
		$badgetext = $product->get_meta('_klb_product_badge_text');
		$badgetype = $product->get_meta('_klb_product_badge_type');
		$badgebg = $product->get_meta('_klb_product_badge_bg_color');
		$badgecolor = $product->get_meta('_klb_product_badge_text_color');
		$percentagecheck = $product->get_meta('_klb_product_percentage_check');
		$percentagetype = $product->get_meta('_klb_product_percentage_type');
		$percentagebg = $product->get_meta('_klb_product_percentage_bg_color');
		$percentagecolor = $product->get_meta('_klb_product_percentage_text_color');

		$badgecss = '';
		if($badgebg || $badgecolor){
			$badgecss .= 'style="';
			if($badgebg){
				$badgecss .= 'background: '.esc_attr($badgebg).';';
			}
			if($badgecolor){
				$badgecss .= 'color: '.esc_attr($badgecolor).';';
			}
			$badgecss .= '"';
		}
		
		$percentagecss = '';
		if($percentagebg || $percentagecolor){
			$percentagecss .= 'style="';
			if($percentagebg){
				$percentagecss .= 'background-color: '.esc_attr($percentagebg).';';
			}
			if($percentagecolor){
				$percentagecss .= 'color: '.esc_attr($percentagecolor).';';
			}
			$percentagecss .= '"';
		}
		
		if ( $product->is_on_sale() || $badgetext ){
			$output .= '<div class="thumbnail-badges product-badges">';
			
			if ( !$percentagecheck && $product->is_on_sale() && $product->is_type( 'variable' ) ) {
				$percentage = ceil(100 - ($product->get_variation_sale_price() / $product->get_variation_regular_price( 'min' )) * 100);
				$output .= '<span class="badge '.esc_attr($percentagetype).' sale" '.$percentagecss.'>'.$percentage.'%</span>';
			} elseif( !$percentagecheck && $product->is_on_sale() && $product->get_regular_price()  && !$product->is_type( 'grouped' )) {
				$percentage = ceil(100 - ($product->get_sale_price() / $product->get_regular_price()) * 100);
				$output .= '<span class="badge '.esc_attr($percentagetype).' sale" '.$percentagecss.'>'.$percentage.'%</span>';
			}

			if($badgetext){
				$output .= '<span class="badge '.esc_attr($badgetype).'" '.$badgecss.'>';
				if($badgetype == 'organic'){
					$output .= '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.29199 3.11798H0.666992C0.666992 6.25098 3.21499 8.79898 6.36099 8.79898V12.049C6.36099 12.517 6.72499 12.894 7.14099 12.894C7.55699 12.894 7.98599 12.517 7.98599 12.075V8.82498C7.98599 5.67898 5.43799 3.11798 2.29199 3.11798ZM12.042 1.50598C9.89699 1.50598 8.05099 2.68898 7.07599 4.44398C7.77799 5.19798 8.29799 6.13398 8.57099 7.17398C11.431 6.87498 13.667 4.45698 13.667 1.50598H12.042Z" fill="currentColor"/>
                                </svg>';
				}elseif($badgetype == 'cold-sale'){
					$output .= '<svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.8937 10.042L11.4657 9.22995L12.6977 8.50195C12.9217 8.36195 13.0057 8.06795 12.8657 7.84395C12.7397 7.61995 12.4457 7.53595 12.2077 7.67595L10.5137 8.66995L7.95169 7.19995L10.5137 5.71595L12.2077 6.72395C12.2917 6.76595 12.3757 6.79395 12.4597 6.79395C12.6137 6.79395 12.7817 6.70995 12.8657 6.55595C13.0057 6.33195 12.9217 6.03795 12.6977 5.89795L11.4657 5.16995L12.8937 4.35795C13.1177 4.21795 13.1877 3.92395 13.0617 3.69995C12.9357 3.47595 12.6417 3.39195 12.4037 3.51795L10.9897 4.34395L10.9757 2.91595C10.9757 2.64995 10.7517 2.43995 10.4997 2.43995C10.2337 2.43995 10.0237 2.66395 10.0237 2.92995L10.0377 4.88995L7.47569 6.37395V3.41995L9.19769 2.45395C9.42169 2.31395 9.50569 2.01995 9.37969 1.79595C9.23969 1.57195 8.95969 1.48795 8.72169 1.61395L7.47569 2.31395V0.675951C7.47569 0.409951 7.26569 0.199951 6.99969 0.199951C6.73369 0.199951 6.52369 0.409951 6.52369 0.675951V2.31395L5.27769 1.61395C5.05369 1.48795 4.75969 1.57195 4.61969 1.79595C4.49369 2.01995 4.57769 2.31395 4.80169 2.45395L6.52369 3.41995V6.37395L3.96169 4.88995L3.97569 2.92995C3.98969 2.66395 3.76569 2.43995 3.51369 2.43995C3.49969 2.43995 3.49969 2.43995 3.49969 2.43995C3.24769 2.43995 3.02369 2.64995 3.02369 2.91595L3.00969 4.34395L1.59569 3.51795C1.35769 3.39195 1.06369 3.47595 0.93769 3.69995C0.81169 3.92395 0.88169 4.21795 1.11969 4.35795L2.53369 5.16995L1.30169 5.89795C1.07769 6.03795 0.99369 6.33195 1.13369 6.55595C1.21769 6.70995 1.38569 6.79395 1.53969 6.79395C1.62369 6.79395 1.70769 6.76595 1.79169 6.72395L3.48569 5.71595L6.04769 7.19995L3.48569 8.68395L1.79169 7.67595C1.55369 7.53595 1.27369 7.61995 1.13369 7.84395C0.99369 8.06795 1.07769 8.36195 1.30169 8.50195L2.53369 9.22995L1.11969 10.042C0.88169 10.182 0.81169 10.476 0.93769 10.7C1.02169 10.854 1.18969 10.938 1.35769 10.938C1.42769 10.938 1.51169 10.924 1.59569 10.868L3.00969 10.056L3.02369 11.484C3.02369 11.75 3.24769 11.96 3.49969 11.96C3.49969 11.96 3.49969 11.96 3.51369 11.96C3.76569 11.96 3.98969 11.736 3.97569 11.47L3.96169 9.50995L6.52369 8.02595V10.98L4.80169 11.946C4.57769 12.086 4.49369 12.38 4.61969 12.604C4.71769 12.758 4.87169 12.842 5.03969 12.842C5.12369 12.842 5.20769 12.828 5.27769 12.786L6.52369 12.086V13.724C6.52369 13.99 6.73369 14.2 6.99969 14.2C7.26569 14.2 7.47569 13.99 7.47569 13.724V12.086L8.72169 12.786C8.79169 12.828 8.87569 12.842 8.95969 12.842C9.12769 12.842 9.28169 12.758 9.37969 12.604C9.50569 12.38 9.42169 12.086 9.19769 11.946L7.47569 10.98V8.02595L10.0377 9.50995L10.0237 11.47C10.0237 11.736 10.2337 11.96 10.4857 11.96C10.4997 11.96 10.4997 11.96 10.4997 11.96C10.7657 11.96 10.9757 11.75 10.9757 11.484L10.9897 10.056L12.4037 10.868C12.4877 10.924 12.5717 10.938 12.6417 10.938C12.8097 10.938 12.9777 10.854 13.0617 10.7C13.1877 10.476 13.1177 10.182 12.8937 10.042Z" fill="currentColor"/>
                                </svg>';
				}
				$output .= esc_html($badgetext);
				$output .= '</span>';
			}
			
			
			
			$output .= '</div>';
		}
	}

	return $output;

}

/*************************************************
## Vendor Name
*************************************************/
function grogin_vendor_name(){
	if (function_exists('get_mvx_vendor_settings')) {
		global $post;
		$vendor = get_mvx_product_vendors($post->ID);
		if (isset($vendor->page_title)) {
			$store_name = $vendor->page_title;
			
			return '<div class="product-store"><span>'.esc_html__('Store:', 'grogin').'</span><a href="'.esc_url($vendor->permalink).'"> '.esc_html($store_name).'</a></div>';
		}
	}elseif(class_exists('WeDevs_Dokan')){
		// Get the author ID (the vendor ID)
		$vendor_id = get_post_field( 'post_author', get_the_id() );

		$store_info  = dokan_get_store_info( $vendor_id ); // Get the store data
		$store_name  = $store_info['store_name'];          // Get the store name
		$store_url   = dokan_get_store_url( $vendor_id );  // Get the store URL

		if (isset($store_name) && $store_name) {
			return '<div class="product-store"><span>'.esc_html__('Store:', 'grogin').'</span><a href="'.esc_url($store_url).'"> '.esc_html($store_name).'</a></div>';
		}
	}
}

if ( class_exists( 'woocommerce' ) ) {
add_theme_support( 'woocommerce' );
add_image_size('grogin-woo-product', 450, 450, true);

// Remove woocommerce defauly styles
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// hide default shop title
if(!function_exists('grogin_override_page_title')){
	function grogin_override_page_title() {
		return false;
	}
	add_filter('woocommerce_show_page_title', 'grogin_override_page_title');
}

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 ); /*remove result count above products*/
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 ); //remove rating
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 ); //remove rating
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title',10);

add_action( 'woocommerce_before_shop_loop_item', 'grogin_shop_box', 10);
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 ); /*remove breadcrumb*/



remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products',20);
remove_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products',10);
add_action( 'woocommerce_after_single_product_summary', 'grogin_related_products', 20 );
function grogin_related_products(){
	$related_column = get_theme_mod('grogin_shop_related_post_column');
	$related_column = $related_column ? (int) $related_column : 4;

	woocommerce_related_products( array(
		'posts_per_page' => $related_column,
		'columns'        => $related_column
	));
}

/*----------------------------
  Cross Sells Columns
 ----------------------------*/
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
add_action( 'woocommerce_after_cart', 'grogin_change_cross_sells_columns', 20);
function grogin_change_cross_sells_columns() {
	$crosssells = get_theme_mod('grogin_cross_sells_column') ? get_theme_mod('grogin_cross_sells_column') : '4';
	woocommerce_cross_sell_display($crosssells, $crosssells);
}

/*----------------------------
  Upsell Columns
 ----------------------------*/
add_filter( 'woocommerce_upsell_display_args', 'grogin_change_number_related_products', 20 );
function grogin_change_number_related_products( $args ) {
	$args['posts_per_page'] = get_theme_mod('grogin_upsell_column');
	$args['columns'] = get_theme_mod('grogin_upsell_column');
	return $args;
}

/*-------------------------------------------
  Product Checklist
 --------------------------------------------*/
function grogin_single_product_checklist(){
	$singlechecklist = get_theme_mod( 'grogin_single_checklist', '0' );
 
	
	if($singlechecklist == '1'){
		echo '<div class="product-notices">';
		echo '<ul>';
		
		$singlechecklist = get_theme_mod('grogin_single_products_checklist'); 
		foreach($singlechecklist as $f){ 
			
				echo '<li>';
					echo '<div class="notice-icon">';
					echo '<i class="'.esc_attr($f['checklist_icon']).'"></i>';
					echo '</div><!-- notice-icon -->';
					echo '<div class="notice-detail">';
					echo '<p>'.grogin_sanitize_data($f['checklist_title']).'</p>';
					echo '</div><!-- notice-detail -->';
				echo '</li>';
			
		}
		
		echo '</ul>';
		echo '</div>';
	}
}

/*************************************************
## Re-order WooCommerce Single Product Summary
*************************************************/
$reorder_single = get_theme_mod( 'grogin_shop_single_reorder', 
	array( 
		'woocommerce_template_single_title', 
		'woocommerce_template_single_rating',
		'woocommerce_template_single_excerpt',		
		'woocommerce_template_single_price', 
		'woocommerce_template_single_add_to_cart', 
		'grogin_single_product_checklist', 
		'woocommerce_template_single_meta', 
		
	) 
);

if(grogin_ft() == 'progressbar'){
	array_splice($reorder_single, 6, 0, 'grogin_product_stock_progress_bar');
}

if(grogin_ft() == 'countdown'){
	array_splice($reorder_single, 5, 0, 'grogin_product_time_countdown');
}

if($reorder_single){
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	remove_action( 'woocommerce_single_product_summary', 'grogin_single_product_checklist', 35 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	
	$count = 7;
	
	foreach ( $reorder_single as $single_part ) {
		
		add_action( 'woocommerce_single_product_summary', $single_part, $count );
		
		$count+=7;
	}
}

/*************************************************
## Grogin Quickview
*************************************************/
function grogin_quickview(){
	global $product;
	
	$output = '';
	
	$quickview = get_theme_mod( 'grogin_quick_view_button', '0' );
	
	if($quickview == '1'){
		$output .= '<div class="quick-view-button">';
		$output .= '<a class="quickview-button" data-product_id="'.$product->get_id().'" ><i class="klb-icon-eye"></i></a>';
		$output .= '</div>';
	}

	return $output;
}

/*************************************************
## Shipping Class Name
*************************************************/
function grogin_shipping_class_name($stockprogressbar = '', $stockstatus = '', $shippingclass = '') {
	if($shippingclass != 'true'){
		return;
	}
	
	global $product;
	if($product){
		$class_id = $product->get_shipping_class_id();
		if ( $class_id ) {
			$term = get_term_by( 'id', $class_id, 'product_shipping_class' );
			
			if ( $term && ! is_wp_error( $term ) ) {
				if(get_theme_mod('grogin_product_box_shipping_class_type') == 'bordered'){
					echo '<div class="product-delivery-time fast-shipping"><i class="klb-icon-box"></i> '.esc_html($term->name).'</div>';
				} else {
					echo '<div class="product-delivery-time">'.esc_html($term->name).'</div>';
				}
			}
			

		}
	}
}
add_action('grogin_product_box_footer', 'grogin_shipping_class_name', 10, 3);


/*************************************************
## Stock Status with Poor
*************************************************/
function grogin_poor_stock_status($stockprogressbar = '', $stockstatus = ''){
	if($stockstatus != 'true'){
		return;
	}
	
	global $product;
	
	$output = '';
	
	$stock_status = $product->get_stock_status();
	$stock_text = $product->get_availability();
	
	$managestock = $product->managing_stock();
	$stock_quantity = $product->get_stock_quantity();
	$stock_format = esc_html__('Only %s left in stock','grogin');
	$low_stock_amount = wc_get_low_stock_amount($product);

	if(get_theme_mod('grogin_product_box_poor_stock') == '1' && $managestock && $stock_quantity < $low_stock_amount) {
		$output .= '<div class="product-stock text-red-600"><span class="text-11 fw-bold text-uppercase">'.sprintf($stock_format, $stock_quantity).'</span></div>';
	} else {
		if($stock_status == 'instock' && $stock_text['availability']){
			$output .= '<div class="product-stock text-green-600 in-stock"><span class="text-11 fw-bold text-uppercase"> '.$stock_text['availability'].'</span></div>';
		} elseif($stock_text['availability']) {
			$output .= '<div class="product-stock outof-stock"><span class="text-11 fw-bold text-uppercase">'.$stock_text['availability'].'</span></div>';
		}
	}
	
	echo grogin_sanitize_data($output);
}
add_action('grogin_product_box_footer', 'grogin_poor_stock_status', 15, 2);

/*************************************************
## Product SKU 
*************************************************/
function grogin_product_sku($stockprogressbar = '', $stockstatus = '', $shippingclass = '', $countdown = '', $product_sku = ''){

	if($product_sku != 'true'){
		return;
	}
	
	global $product;

	if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ){
		echo '<span class="sku_wrapper">'.esc_html__( 'SKU:', 'grogin' ).'<span class="sku">'.esc_html($product->get_sku()).'</span></span>';
	}
}
add_action('grogin_product_box_footer', 'grogin_product_sku', 15, 5);


/*************************************************
## Product Attributes
*************************************************/
function grogin_product_attributes($stockprogressbar = '', $stockstatus = '', $shippingclass = '', $countdown = '', $product_sku = '', $productattributes = ''){
	if($productattributes != 'true'){
		return;
	}
	
	global $product;
	
	echo '<div class="klb-product-attributes">';
	wc_display_product_attributes( $product );
	echo '</div>';
}
add_action('grogin_product_box_footer', 'grogin_product_attributes', 15, 6);

/*----------------------------
  Add my owns Product Box
 ----------------------------*/
function grogin_shop_box () {
	
	$postview  = isset( $_POST['shop_view'] ) ? $_POST['shop_view'] : '';
	$stockprogressbar = get_theme_mod('grogin_product_box_stock_progress_bar') == 1 || grogin_ft() == 'progressbar' ? 'true' : '';
	$stockstatus = get_theme_mod('grogin_product_box_stock_status') == 1 || grogin_ft() == 'stock_status' ? 'true' : '';
	$shippingclass = get_theme_mod('grogin_product_box_shipping_class') == 1 || grogin_ft() == 'box_shipping' ? 'true' : '';
	$countdown = get_theme_mod('grogin_product_box_countdown') == 1 || grogin_ft() == 'box_countdown' ? 'true' : '';
	$product_sku = get_theme_mod('grogin_product_box_sku') == 1 || grogin_ft() == 'box_sku' ? 'true' : '';
	$productattributes = get_theme_mod('grogin_product_box_attributes') == 1 || grogin_ft() == 'product_attributes' ? 'true' : '';
	$product_type = isset( $_GET['box_type'] ) ? sanitize_text_field($_GET['box_type']) : get_theme_mod('grogin_product_box_type', 'type1');
	
	$output = '';
	
	if(grogin_shop_view() == 'list_view' || $postview == 'list_view') {
		echo grogin_product_type_list();
	} else {
		ob_start();
		do_action( 'klb_product_box', $stockprogressbar, $stockstatus, $shippingclass, $countdown, $product_type, $product_sku, $productattributes);
		$output .= ob_get_clean();	
	}
	
	echo $output;
}

/*************************************************
## Woo Cart Ajax
*************************************************/ 
add_filter('woocommerce_add_to_cart_fragments', 'grogin_header_add_to_cart_fragment');
function grogin_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	?>
	
	<span class="action-count cart-count count"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'grogin'), $woocommerce->cart->cart_contents_count);?></span>
	

	<?php
	$fragments['span.cart-count'] = ob_get_clean();

	return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', function($fragments) {

    ob_start();
    ?>

    <div class="fl-mini-cart-content">
        <?php woocommerce_mini_cart(); ?>
    </div>

    <?php $fragments['div.fl-mini-cart-content'] = ob_get_clean();

    return $fragments;

} );

add_filter('woocommerce_add_to_cart_fragments', 'grogin_header_add_to_cart_fragment_subtotal');
function grogin_header_add_to_cart_fragment_subtotal( $fragments ) {
	global $woocommerce;
	ob_start();
	?>
	
    <p class="cart-price price"><?php echo WC()->cart->get_cart_subtotal(); ?></p>

    <?php $fragments['.cart-price'] = ob_get_clean();

	return $fragments;
}

add_filter('woocommerce_add_to_cart_fragments', 'grogin_header_add_to_cart_fragment_cart_count_text');
function grogin_header_add_to_cart_fragment_cart_count_text( $fragments ) {
	global $woocommerce;
	ob_start();
	?>
	
    <div class="cart-count-text count-text"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'grogin'), $woocommerce->cart->cart_contents_count);?></div>

    <?php $fragments['.cart-count-text'] = ob_get_clean();

	return $fragments;
}

/*************************************************
## Grogin Woo Search Form
*************************************************/ 
add_filter( 'get_product_search_form' , 'grogin_custom_product_searchform' );

function grogin_custom_product_searchform( $form ) {

	$form = '<form class="product-search-form" action="' . esc_url( home_url( '/'  ) ) . '" role="search" method="get" id="searchform">
				<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="'.esc_attr__('Search','grogin').'">
				<button type="submit"><i class="klb-right"></i></button>
                <input type="hidden" name="post_type" value="product" />
			</form>';

	return $form;
}

function grogin_header_product_search() {
	$terms = get_terms( array(
		'taxonomy' => 'product_cat',
		'hide_empty' => true,
		'parent'    => 0,
	) );

	$form = '';
	
	if(get_theme_mod('grogin_header_search_type') == 'type2'){
		$form .= '<form action="' . esc_url( home_url( '/'  ) ) . '" class="search-form search-type-2" role="search" method="get" id="searchform">';
		$form .= '<input class="form-control search-input primary" type="search" name="s" value="' . get_search_query() . '" placeholder="'.esc_attr__('Search for products, categories or brands...','grogin').'" autocomplete="off">';
		$form .= '<button type="submit" class="unset">';
		$form .= '<i class="klb-icon-search"></i>';
		$form .= '</button>';
		$form .= '<input type="hidden" name="post_type" value="product" />';
		$form .= '</form>';
	} else { 
		$form .= '<form action="' . esc_url( home_url( '/'  ) ) . '" class="search-form search-type-1" role="search" method="get" id="searchform">';
		$form .= '<input class="form-control search-input filled" type="search" name="s" value="' . get_search_query() . '" placeholder="'.esc_attr__('Search for products, categories or brands...','grogin').'" autocomplete="off">';
		$form .= '<button type="submit" class="unset">';
		$form .= '<i class="klb-icon-search"></i>';
		$form .= '</button>';
		$form .= '<input type="hidden" name="post_type" value="product" />';
		$form .= '</form>';
	}
	
	if(function_exists('grogin_get_most_popular_keywords') && grogin_get_most_popular_keywords()){
		$form .= '<div class="header-search-result">';
		$form .= '<span class="text-12 text-gray-500 lh-1 mr-10">'.esc_html__('Trending:', 'grogin').'</span>';
		$form .= grogin_get_most_popular_keywords();
		$form .= '</div>';
	}
		
	return $form;
	
}

/*************************************************
## Grogin Gallery Thumbnail Size
*************************************************/ 
add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
    return array(
        'width' => 90,
        'height' => 54,
        'crop' => 0,
    );
} );


/*************************************************
## Quick View Scripts
*************************************************/ 
function grogin_quick_view_scripts() {
  	wp_enqueue_script( 'grogin-quick-ajax', get_template_directory_uri() . '/assets/js/custom/quick_ajax.js', array('jquery'), '1.0.0', true );
	wp_localize_script( 'grogin-quick-ajax', 'MyAjax', array(
		'ajaxurl' => esc_url(admin_url( 'admin-ajax.php' )),
	));
	if(get_theme_mod('grogin_quantity_box',0) == 1){
  		wp_enqueue_script( 'grogin-quantity_button', get_template_directory_uri() . '/assets/js/custom/cartquantity_ajax.js', array('jquery'), '1.0.0', true );

		if(function_exists('grogin_ft')){
			wp_localize_script( 'grogin-quantity_button', 'quantity', array(
				'notice' => (grogin_ft() == 'notice_ajax') ? 1 : get_theme_mod('grogin_shop_notice_ajax_addtocart'),
			));
		}
	}
  	wp_enqueue_script( 'grogin-variationform', get_template_directory_uri() . '/assets/js/custom/variationform.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'wc-add-to-cart-variation' );
}
add_action( 'wp_enqueue_scripts', 'grogin_quick_view_scripts' );

/*************************************************
## Quick View CallBack
*************************************************/
add_action( 'wp_ajax_nopriv_quick_view', 'grogin_quick_view_callback' );
add_action( 'wp_ajax_quick_view', 'grogin_quick_view_callback' );
function grogin_quick_view_callback() {

	$id = intval( $_POST['id'] );
	$loop = new WP_Query( array(
		'post_type' => 'product',
		'p' => $id,
	  )
	);
	
	while ( $loop->have_posts() ) : $loop->the_post(); 
	$product = new WC_Product(get_the_ID());
	
	$rating = wc_get_rating_html($product->get_average_rating());
	$price = $product->get_price_html();
	$rating_count = $product->get_rating_count();
	$review_count = $product->get_review_count();
	$average      = $product->get_average_rating();
	$product_image_ids = $product->get_gallery_attachment_ids();

	$output = '';
	
		$output .= '<div class="site-quickview product mb-20 mt-20">';
		$output .= '<div class="quick-view-product-wrapper single-product-wrapper">';
		
		if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
			$att=get_post_thumbnail_id();
			$image_src = wp_get_attachment_image_src( $att, 'full' );
			$image_src = $image_src[0];
			
			$output .= '<div class="column woocommerce-product-gallery">';
			$output .= '<div class="product-gallery-items">';
			$output .= '<div id="product-images" class="site-slider slider-style slider-loading-height loader-default arrows-default arrows-offset" data-speed="500" data-items="1" data-itemScroll="1" data-arrows="true" data-dots="false" data-infinite="true" data-draggable="true" data-assfor_nav="#product-thumbnails">';
			
			$output .= '<div class="slider-item"><div class="slider-image"><img src="'.esc_url($image_src).'" /></div></div>';

			foreach( $product_image_ids as $product_image_id ){
			$image_url = wp_get_attachment_url( $product_image_id );
				$output .= '<div class="slider-item"><div class="slider-image"><img src="'.esc_url($image_url).'" /></div></div>';
			} 
			$output .= '</div><!-- site-slider -->';
			$output .= '</div><!-- product-gallery-items -->';
			if($product_image_ids){
				$output .= '<div class="product-thumbnail-items">';
				$output .= '<div id="product-thumbnails" class="site-slider carousel-style slider-loading-height loader-default arrows-default arrows-offset" data-speed="500" data-items="10" data-itemsTablet="8" data-itemsMobile="6" data-itemScroll="1" data-arrows="true" data-dots="false" data-infinite="true" data-draggable="true" data-assfor_nav="#product-images" data-focuson_select="true">';
				
				$output .= '<div class="slider-item"><div class="slider-image"><img src="'.esc_url($image_src).'" /></div></div>';
				
				foreach( $product_image_ids as $product_image_id ){	
				$image_url = wp_get_attachment_url( $product_image_id );	
					$output .= '<div class="slider-item"><div class="slider-image"><img src="'.esc_url($image_url).'" /></div></div>';
				}
				$output .= '</div><!-- site-slider -->';
				$output .= '</div><!-- product-thumbnail-items -->';
			}
			$output .= '</div><!-- column -->';	
		}	
		$output .= '<div class="column product-detail">';
				ob_start();
				do_action( 'woocommerce_single_product_summary' );
				$output .= ob_get_clean();
		$output .= '</div><!-- column -->';
		$output .= '</div><!-- quick-view-product-wrapper -->';
		$output .= '</div>';

		endwhile; 
		wp_reset_postdata();

	 	$output_escaped = $output;
	 	echo $output_escaped;
		
		wp_die();
}


/*************************************************
## Grogin Filter by Attribute
*************************************************/ 
function grogin_woocommerce_layered_nav_term_html( $term_html, $term, $link, $count ) { 

	$attribute_label_name = wc_attribute_label($term->taxonomy);;
	$attribute_id = wc_attribute_taxonomy_id_by_name($attribute_label_name);
	$attr  = wc_get_attribute($attribute_id);
	$array = json_decode(json_encode($attr), true);

	if($array['type'] == 'color'){
		$color = get_term_meta( $term->term_id, 'product_attribute_color', true );
		$term_html = '<div class="type-color"><span class="color-box" style="background-color:'.esc_attr($color).';"></span>'.$term_html.'</div>';
	}
	
	if($array['type'] == 'button'){
		$term_html = '<div class="type-button"><span class="button-box"></span>'.$term_html.'</div>';
	}

    return $term_html; 
}; 
         
add_filter( 'woocommerce_layered_nav_term_html', 'grogin_woocommerce_layered_nav_term_html', 10, 4 ); 


/*************************************************
## Shop Width Body Classes
*************************************************/
function grogin_body_classes( $classes ) {

	if( is_shop() && get_theme_mod('grogin_shop_width') == 'wide' || grogin_get_option() == 'wide') { 
		$classes[] = 'shop-wide';
	}elseif( is_product() && get_theme_mod('grogin_single_full_width') == 1 || grogin_get_option() == 'wide') { 
		$classes[] = 'shop-wide';
	} else {
		$classes[] = '';
	}
	
	return $classes;
}
add_filter( 'body_class', 'grogin_body_classes' );

/*************************************************
## Stock Availability Translation
*************************************************/ 
if(get_theme_mod('grogin_stock_quantity',0) != 1){
add_filter( 'woocommerce_get_availability', 'grogin_custom_get_availability', 1, 2);
function grogin_custom_get_availability( $availability, $_product ) {
    
	if(! $_product->is_in_stock()){
		$availability['availability'] = esc_html__('Out of stock', 'grogin');
	} elseif ( $_product->is_on_backorder( 1 ) ) {
		$availability['availability'] = esc_html__('Available on backorder', 'grogin');
	} elseif ($_product->is_in_stock()){
		$availability['availability'] = esc_html__('In Stock', 'grogin');
	}

    return $availability;
}
}

/*************************************************
## Archive Description After Content
*************************************************/
if(get_theme_mod('grogin_category_description_after_content',0) == 1){
	remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);
	remove_action('woocommerce_archive_description', 'woocommerce_product_archive_description', 10);
	add_action('grogin_after_main_shop', 'woocommerce_taxonomy_archive_description', 5);
	add_action('grogin_after_main_shop', 'woocommerce_product_archive_description', 5);
}

/*************************************************
## Catalog Mode - Disable Add to cart Button
*************************************************/
if(get_theme_mod('grogin_catalog_mode', 0) == 1 || grogin_get_option() == 'catalogmode'){ 
	add_filter( 'woocommerce_loop_add_to_cart_link', 'grogin_remove_add_to_cart_buttons', 1 );
	function grogin_remove_add_to_cart_buttons() {
		return false;
	}
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 40);
}

/*************************************************
## Related Products with Tags
*************************************************/
if(get_theme_mod('grogin_related_by_tags',0) == 1){
	add_filter( 'woocommerce_product_related_posts_relate_by_category', '__return_false' );
}

/*************************************************
## Product Specification Tab
*************************************************/ 
add_filter( 'woocommerce_product_tabs', 'grogin_product_specification_tab' );
function grogin_product_specification_tab( $tabs ) {
	$specification = get_post_meta( get_the_ID(), 'klb_product_specification', true );
	
	// Adds the new tab
	if($specification){
		$tabs['specification'] = array(
			'title' 	=> esc_html__( 'Specification', 'grogin' ),
			'priority' 	=> 15,
			'callback' 	=> 'grogin_product_specification_tab_content'
		);
	}
	
	return $tabs;
}
function grogin_product_specification_tab_content() {
	$specification = get_post_meta( get_the_ID(), 'klb_product_specification', true );
	echo '<div class="specification-content">'.grogin_sanitize_data($specification).'</div>';
}
} // is woocommerce activated

?>