<?php
if ( ! function_exists( 'grogin_cart_icon3' ) ) {
	function grogin_cart_icon3(){
		$headercart = get_theme_mod('grogin_header_cart','0');
		if($headercart == '1'){
			global $woocommerce;
			$carturl = wc_get_cart_url(); 
			?>
				<div class="quick-button style-3 mini-cart-button">
					<a href="<?php echo esc_url($carturl); ?>" class="action-link">
						<div class="action-icon">
							<i class="klb-icon-shopping-cart-3"></i>
							<span class="action-count cart-count count"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'grogin'), $woocommerce->cart->cart_contents_count);?></span>
						</div><!-- action-icon -->
						<div class="action-text">
							<p><?php esc_html_e('Your Cart','grogin'); ?></p>
						</div><!-- action-text -->
					</a>
					<div class="mini-cart-holder hide">
						<div class="mini-cart-body">
							<div class="fl-mini-cart-content">
								<?php woocommerce_mini_cart(); ?>
							</div>
						</div><!-- mini-cart-body -->
						
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