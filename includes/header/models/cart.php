<?php
if ( ! function_exists( 'grogin_cart_icon' ) ) {
	function grogin_cart_icon(){
		$headercart = get_theme_mod('grogin_header_cart','0');
		if($headercart == '1'){
			global $woocommerce;
			$carturl = wc_get_cart_url(); 
			?>
			
				<div class="quick-button style-1 mini-cart-button">
					<a href="<?php echo esc_url($carturl); ?>" class="action-link">
					  <div class="action-icon">
						<i class="klb-icon-shopping-cart-3"></i>
						<span class="action-count cart-count count"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'grogin'), $woocommerce->cart->cart_contents_count);?></span>
					  </div><!-- action-icon -->
					</a>
					<div class="mini-cart-holder hide">
						
						<div class="mini-cart-body">
							<div class="fl-mini-cart-content">
								<?php woocommerce_mini_cart(); ?>
							</div>
						</div>
						
						<?php if(get_theme_mod('grogin_header_mini_cart_notice')){ ?>
							<div class="shipping-notice text-center bg-slate-50">
								<p class="text-12 fw-medium text-slate-800 mb-0"><?php echo grogin_sanitize_data(get_theme_mod('grogin_header_mini_cart_notice')); ?></p>
							</div><!-- cart-discount -->
						<?php } ?>	
						
					</div><!-- mini-cart-holder -->
				</div><!-- quick-button -->
				
		<?php }
	}
}