<?php
if ( ! function_exists( 'grogin_top_notification' ) ) {
	function grogin_top_notification(){
		$topnotification = get_theme_mod('grogin_top_notification_toggle','0'); 
		if($topnotification == '1'){ ?>
			
			<div class="header-text fw-normal pl-14 ml-14 border-start border-gray-200 z-2">
				<p class="primary-text mb-0"><?php echo grogin_sanitize_data(get_theme_mod('grogin_top_notification_content')); ?></p>
			</div><!-- header-text -->
			
		<?php  }
	}
}