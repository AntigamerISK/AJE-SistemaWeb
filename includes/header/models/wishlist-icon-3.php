<?php
if ( ! function_exists( 'grogin_wishlist_icon3' ) ) {
	function grogin_wishlist_icon3(){
	?>

	<?php $wishlistheader = get_theme_mod('grogin_header_wishlist',0); ?>
	<?php if($wishlistheader == 1){ ?>
	
		
		<?php if ( class_exists( 'KlbWishlist' ) ) { ?>	
			<div class="quick-button style-3 wishlist-button">
				<a href="<?php echo KlbWishlist::get_url(); ?>" class="action-link">
					<div class="action-icon">
						<i class="klb-icon-heart-4"></i>
						<span class="action-count klbwl-wishlist-count"><?php echo KlbWishlist::get_count(); ?></span>
					</div><!-- action-icon -->
					<div class="action-text">
						<p><?php esc_html_e('Wishlist','grogin'); ?></p>
					</div><!-- action-text -->
				</a>
			</div>
		<?php } ?>
		
	<?php } ?>
	
	<?php 
	
	}
}