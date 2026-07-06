<?php
/*----------------------------
  Product Type List2
 ----------------------------*/
function grogin_product_type_list2(){
	global $product;
	global $post;
	global $woocommerce;
	
	$output = '';
	
	$id = get_the_ID();
	$allproduct = wc_get_product( get_the_ID() );

	$price = $allproduct->get_price_html();
	
	$output .= '<div class="product">';
	$output .= '<div class="product-wrapper">';
	$output .= '<div class="product-inner">';
	$output .= '<div class="thumbnail-wrapper">';
	$output .= '<div class="product-thumbnail">';
	$output .= '<a href="'.get_permalink().'">';
	$output .= '<div class="product-gallery">';
	$output .= grogin_product_image();
	$output .= '</div><!-- product-gallery -->';
	$output .= '</a>';
	$output .= '</div><!-- product-thumbnail -->';
	$output .= '</div><!-- thumbnail-wrapper -->';
	$output .= '<div class="content-wrapper">';
	$output .= '<h2 class="product-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h2>';
	$output .= '<span class="price">';
	$output .= $price;	
	$output .= '</span><!-- price -->';
	$output .= '</div><!-- content-wrapper -->';
	$output .= '</div><!-- product-inner -->';
	$output .= '</div><!-- product-wrapper -->';
	$output .= '</div><!-- product -->';
	
		
	return $output;
}