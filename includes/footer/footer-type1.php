<?php if(grogin_page_settings('page_footer_type') == 'type2') { ?>
	 <?php $footertype = 'dark'; ?>
<?php } elseif( grogin_page_settings( 'page_footer_type' ) == 'type1') { ?>	
	<?php $footertype = 'gray'; ?>
<?php } elseif( get_theme_mod( 'grogin_footer_type' ) == 'type2') { ?>	
	<?php $footertype = 'dark'; ?>
<?php } else { ?>
	<?php $footertype = 'gray'; ?>
<?php } ?>
	
<footer class="site-footer position-relative z-2 <?php echo esc_attr($footertype); ?>">

	<?php $subscribe = get_theme_mod('grogin_footer_subscribe_area',0); ?>
	<?php if($subscribe == 1){ ?>
		<div class="footer-row footer-newsletter">
			<div class="container">
				<div class="footer-inner">
					<div class="column text-column d-inline-flex flex-column align-items-center align-items-md-start">
						<h3 class="entry-title text-18 md-text-20 fw-bold"><?php echo grogin_sanitize_data(get_theme_mod('grogin_footer_subscribe_title')); ?></h3>
						<div class="text-13 lh-base max-w-345 text-center text-sm-start">
							<p><?php echo grogin_sanitize_data(get_theme_mod('grogin_footer_subscribe_subtitle')); ?></p>
						</div><!-- entry-excerpt -->
					</div><!-- column -->
					<div class="column form-column d-inline-flex align-items-center justify-content-center justify-content-md-end">
						<div class="site-newsletter-form text-center text-sm-start">

							<?php grogin_subscribe_form(get_theme_mod('grogin_footer_subscribe_formid')); ?>

						</div><!-- site-newsletter-form -->
					</div><!-- column -->
				</div><!-- footer-inner -->
			</div><!-- container -->
		</div><!-- footer-row -->
    <?php } ?>
	
	<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) || is_active_sidebar( 'footer-4' )) { ?>
    <div class="footer-row footer-widgets">
        <div class="container">
			<div class="footer-inner">				 
				<?php if(get_theme_mod('grogin_footer_column') == '3columns'){ ?>
					<div class="column footer-widgets-block column-3">	
						<div class="widget-col">
							<?php dynamic_sidebar( 'footer-1' ); ?>
						</div><!-- col -->
						<div class="widget-col">
							<?php dynamic_sidebar( 'footer-2' ); ?>
						</div><!-- col -->
						<div class="widget-col">
							<?php dynamic_sidebar( 'footer-3' ); ?>
						</div><!-- col -->
					</div><!-- col -->
				<?php } elseif(get_theme_mod('grogin_footer_column') == '4columns'){ ?>
					<div class="column footer-widgets-block column-4">	
						<div class="widget-col">
							<?php dynamic_sidebar( 'footer-1' ); ?>
						</div><!-- col -->
						<div class="widget-col">
							<?php dynamic_sidebar( 'footer-2' ); ?>
						</div><!-- col -->
						<div class="widget-col">
							<?php dynamic_sidebar( 'footer-3' ); ?>
						</div><!-- col -->

						<?php $footersocial = get_theme_mod('grogin_footer_social_list'); ?>
						<?php $appimage = get_theme_mod('grogin_footer_app_image'); ?>
						<?php if($footersocial || $appimage){ ?>
							<div class="widget-col">
								<div class="widget">
								  <h4 class="widget-title"><?php echo esc_html(get_theme_mod('grogin_footer_app_title')); ?></h4>
								  <div class="widget-body">
								  
									<?php if($appimage){ ?>
										<div class="app-buttons">
										<?php foreach($appimage as $app){ ?>
											<div class="app-button">
												<a href="<?php echo esc_url($app['app_url']); ?>">
													<img src="<?php echo esc_url( grogin_get_image($app['app_image'])); ?>" alt="<?php esc_attr_e('app','grogin'); ?>"/>
												</a>
												<p><?php echo esc_html($app['app_image_title']); ?></p>
											</div><!-- app-button -->
										<?php } ?>
										</div><!-- app-buttons -->
									<?php } ?>
									
									<?php if(!empty($footersocial)){ ?>
										<span class="d-block text-12 mt-30 sm-mt-50 mb-10"><?php echo esc_html(get_theme_mod('grogin_footer_social_list_title')); ?></span>
										<div class="site-social">
										
										  <ul>
											<?php foreach($footersocial as $f){ ?>
												<li><a href="<?php echo esc_url($f['social_url']); ?>" class="filled white md <?php echo esc_attr($f['social_icon']); ?>" target="_blank"><i class="klb-social-icon-<?php echo esc_attr($f['social_icon']); ?>"></i></a></li>
											<?php } ?>
										  </ul>
										  
										</div><!-- site-social -->
									<?php } ?>
									
								  </div><!-- widget-body -->
								</div><!-- widget -->
							</div><!-- widget-col -->
						<?php } else { ?>	
							<div class="widget-col">
								<?php dynamic_sidebar( 'footer-4' ); ?>
							</div><!-- col -->
						<?php } ?>
					</div><!-- col -->
				<?php } else { ?>
					<div class="column footer-contact-block">
						<?php dynamic_sidebar( 'footer-1' ); ?>	
					</div><!-- column -->
					<div class="column footer-widgets-block column-4">
						<div class="widget-col">
							<?php dynamic_sidebar( 'footer-2' ); ?>
						</div><!-- widget-column -->
						<div class="widget-col">
							<?php dynamic_sidebar( 'footer-3' ); ?>
						</div><!-- widget-column -->
						<div class="widget-col">
							<?php dynamic_sidebar( 'footer-4' ); ?>
						</div><!-- widget-column -->
						
						<?php $footersocial = get_theme_mod('grogin_footer_social_list'); ?>
						<?php $appimage = get_theme_mod('grogin_footer_app_image'); ?>
						<?php if($footersocial || $appimage){ ?>
							<div class="widget-col">
								<div class="widget">
								  <h4 class="widget-title"><?php echo esc_html(get_theme_mod('grogin_footer_app_title')); ?></h4>
								  <div class="widget-body">
								  
									<?php if($appimage){ ?>
										<div class="app-buttons">
										<?php foreach($appimage as $app){ ?>
											<div class="app-button">
												<a href="<?php echo esc_url($app['app_url']); ?>">
													<img src="<?php echo esc_url( grogin_get_image($app['app_image'])); ?>" alt="<?php esc_attr_e('app','grogin'); ?>"/>
												</a>
												<p><?php echo esc_html($app['app_image_title']); ?></p>
											</div><!-- app-button -->
										<?php } ?>
										</div><!-- app-buttons -->
									<?php } ?>
									
									<?php if(!empty($footersocial)){ ?>
										<span class="d-block text-12 mt-30 sm-mt-50 mb-10"><?php echo esc_html(get_theme_mod('grogin_footer_social_list_title')); ?></span>
										<div class="site-social">
										
										  <ul>
											<?php foreach($footersocial as $f){ ?>
												<li><a href="<?php echo esc_url($f['social_url']); ?>" class="filled white md <?php echo esc_attr($f['social_icon']); ?>" target="_blank"><i class="klb-social-icon-<?php echo esc_attr($f['social_icon']); ?>"></i></a></li>
											<?php } ?>
										  </ul>
										  
										</div><!-- site-social -->
									<?php } ?>
									
								  </div><!-- widget-body -->
								</div><!-- widget -->
							</div><!-- widget-col -->
						<?php } ?>	
					</div><!-- column -->
				<?php } ?>
					
			</div><!-- footer-inner -->
        </div><!-- container -->
      </div><!-- footer-row -->
    <?php } ?>
	
    <div class="footer-row footer-copyright get-mobile-nav-height">
        <div class="container">
			<div class="footer-inner">
				<div class="column">
					<div class="site-copyright">
						<?php if(get_theme_mod( 'grogin_copyright' )){ ?>
							<p class="text-12 fw-medium lh-base mb-0"><?php echo grogin_sanitize_data(str_replace( '[year]', date('Y'), get_theme_mod( 'grogin_copyright' ) )); ?></p>
						<?php } else { ?>
							<p class="text-12 fw-medium lh-base mb-0"><?php esc_html_e('Copyright 2024.KlbTheme . All rights reserved','grogin'); ?></p>
						<?php } ?>
					</div>          
			  

					<?php $footerpayment = get_theme_mod('grogin_footer_payment_repeater',0); ?>
					<?php if($footerpayment){ ?>
				
						<div class="site-payment-cards mt-8 sm-mt-16">
							<ul>
								<?php foreach($footerpayment as $f){ ?>
									<li>
										<img src="<?php echo esc_url( grogin_get_image($f['payment_image'])); ?>" alt="<?php esc_attr_e('payment','grogin'); ?>"/>           
									</li>
								<?php } ?>
							</ul>
						</div><!-- site-payment-cards -->
					<?php } ?>
				</div><!-- column -->
           
			   <div class="column footer-copyright-menu">
					<nav class="site-menu footer-menu">
					<?php 
					wp_nav_menu(array(
					'theme_location' => 'footer-menu',
					'container' => '',
					'fallback_cb' => 'show_top_menu',
					'menu_id' => '',
					'menu_class' => 'menu',
					'echo' => true,
					"walker" => '',
					'depth' => 0 
					));
					?>
					</nav>
				</div><!-- column -->
			</div><!-- footer-inner -->
        </div><!-- container -->
    </div><!-- footer-row -->
</footer>