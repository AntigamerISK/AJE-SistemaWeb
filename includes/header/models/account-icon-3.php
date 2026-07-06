<?php

if ( ! function_exists( 'grogin_account_icon3' ) ) {
	function grogin_account_icon3(){
		$headersearch = get_theme_mod('grogin_header_account','0');
		if($headersearch == 1){
						
		?>
			<div class="quick-button style-3 login-form-button">
				<a href="<?php echo wc_get_page_permalink( 'myaccount' ); ?>" class="action-link">
					<div class="action-icon">
						<i class="klb-icon-user-cut"></i>
					</div><!-- action-icon -->
					<div class="action-text">
						<p><?php esc_html_e('Account','grogin'); ?></p>
					</div><!-- action-text -->
				</a>
			</div>
	<?php  }
	}
}