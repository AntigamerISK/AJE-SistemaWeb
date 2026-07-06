<?php

if ( ! function_exists( 'grogin_account_icon' ) ) {
	function grogin_account_icon(){
		$headersearch = get_theme_mod('grogin_header_account','0');
		if($headersearch == 1){
						
		?>
			<div class="quick-button style-1 login-form-button">
				<a href="<?php echo wc_get_page_permalink( 'myaccount' ); ?>" class="action-link">
					<div class="action-icon">
						<i class="klb-icon-user-cut"></i>
					</div><!-- action-icon -->
					<div class="action-text">
						<?php if(is_user_logged_in()){ ?>
							<?php $current_user = wp_get_current_user(); ?>
							<span><?php esc_html_e('Welcome','grogin'); ?></span>
							<p><?php echo esc_html($current_user->user_login); ?></p>
						<?php } else { ?>
							<span><?php esc_html_e('Sign In','grogin'); ?></span>
							<p><?php esc_html_e('Account','grogin'); ?></p>
						<?php } ?>
					</div><!-- action-text -->
				</a>
			</div>
	<?php  }
	}
}