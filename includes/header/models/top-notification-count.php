<div class="global-notification position-relative">
    <div class="container">
        <div class="global-notification-inner d-flex flex-wrap justify-content-evenly text-12 py-10">
			<p class="fw-semibold text-center"><?php echo grogin_sanitize_data(get_theme_mod('grogin_top_notification_count_title')); ?></p>
			<?php if(get_theme_mod('grogin_top_notification_count_date')){ ?>
				<img src="<?php echo esc_url( wp_get_attachment_url(get_theme_mod( 'grogin_top_notification_count_date_image' )) ); ?>" class="position-absolute top-0">
				<div class="notification-countdown d-inline-flex flex-wrap align-items-center justify-content-center">
	            <span class="text-white fw-medium mr-0 lg-mr-14 opacity-70 lg-mb-0"><?php echo grogin_sanitize_data(get_theme_mod('grogin_top_notification_count_desc')); ?></span>
					<div class="site-countdown d-inline-flex flex-wrap gap-2" data-date="<?php echo esc_attr(get_theme_mod('grogin_top_notification_count_date')); ?>" data-text="<?php esc_attr_e('Expired', 'grogin'); ?>">
					  <div class="countdown-item d-inline-flex align-items-center lh-1">
						<div class="days text-18 fw-bold"><?php esc_html_e('00', 'grogin'); ?></div>
						<span class="text-11 ml-5 opacity-70"><?php esc_html_e('days', 'grogin'); ?></span>
					  </div><!-- countdown-item -->
					  <div class="countdown-item d-inline-flex align-items-center lh-1">
						<div class="hours text-18 fw-bold"><?php esc_html_e('00', 'grogin'); ?></div>
						<span class="text-11 ml-5 opacity-70"><?php esc_html_e('hours', 'grogin'); ?></span>
					  </div><!-- countdown-item -->
					  <div class="countdown-item d-inline-flex align-items-center lh-1">
						<div class="minutes text-18 fw-bold"><?php esc_html_e('00', 'grogin'); ?></div>
						<span class="text-11 ml-5 opacity-70"><?php esc_html_e('minutes', 'grogin'); ?></span>
					  </div><!-- countdown-item -->
					  <div class="countdown-item d-inline-flex align-items-center lh-1">
						<div class="second text-18 fw-bold"><?php esc_html_e('00', 'grogin'); ?></div>
						<span class="text-11 ml-5 opacity-70"><?php esc_html_e('sec.', 'grogin'); ?></span>
					  </div><!-- countdown-item -->
					</div><!-- site-countdown -->
				</div><!-- notification-countdown -->
			<?php } ?>
        </div><!-- global-notification-inner -->
    </div><!-- container -->
    <a href="#" class="overlay-link"></a>
</div><!-- global-notification --> 