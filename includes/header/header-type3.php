<header id="masthead" class="site-header position-relative border-bottom border-gray-200 z-3 header-type3">
	<?php if(get_theme_mod('grogin_top_left_menu','0') == 1 || get_theme_mod('grogin_top_right_menu','0') == 1){ ?>
	    <div class="header-row header-topbar position-relative d-none d-xl-block text-12 text-weight fw-medium border-bottom header-row-white text-gray-500 z-3">
	        <div class="container">
				<div class="header-inner d-flex flex-wrap align-items-center justify-content-between">
					<div class="col d-inline-flex align-items-center justify-content-start">
						<?php if(get_theme_mod('grogin_top_left_menu','0') == 1){ ?>
							<nav class="site-menu horizontal menu-shadow primary-text">
								<?php 
									wp_nav_menu(array(
									'theme_location' => 'top-left-menu',
									'container' => '',
									'fallback_cb' => 'show_top_menu',
									'menu_id' => '',
									'menu_class' => '',
									'echo' => true,
									"walker" => '',
									'depth' => 0 
									));
								?>
							</nav><!-- klb-menu-nav -->
						<?php } ?>
						
						<?php grogin_top_notification(); ?>
						
					</div><!-- col -->
					<div class="col d-inline-flex align-items-center justify-content-end">
						<?php if(get_theme_mod('grogin_top_right_menu','0') == 1){ ?>
						<nav class="site-menu menu-shadow horizontal primary-text">
							<?php 
								wp_nav_menu(array(
								'theme_location' => 'top-right-menu',
								'container' => '',
								'fallback_cb' => 'show_top_menu',
								'menu_id' => '',
								'menu_class' => 'menu',
								'echo' => true,
								"walker" => '',
								'depth' => 0 
								));
							?>
						</nav><!-- klb-menu-nav -->
						<?php } ?>		
					</div><!-- col -->
				</div><!-- header-inner -->
	        </div><!-- container -->
	    </div><!-- header-row -->
    <?php } ?>

    <div class="header-row header-main position-relative header-row-white border-bottom">
        <div class="container">
			<div class="header-inner d-flex flex-wrap align-items-center justify-content-between gap-3 gap-sm-4">
				<div class="col d-inline-flex d-xl-none align-items-center flex-auto">
					<div class="quick-button style-1">
						<a href="#" class="action-link menu-drawer-toggle" data-drawer="site-menu-drawer">
						  <div class="action-icon">
							<i class="klb-icon-menu"></i>
						  </div><!-- action-icon -->
						</a>
				  </div><!-- quick-button -->
				</div><!-- col -->
				<div class="col d-inline-flex align-items-center flex-auto">
					<div class="site-brand">
						<?php $elementor_page = get_post_meta( get_the_ID(), '_elementor_edit_mode', true ); ?> 
							
							<?php if($elementor_page){ ?>
								<a href="<?php echo esc_url( home_url( "/" ) ); ?>" title="<?php bloginfo("name"); ?>">
									<?php if(isset(grogin_page_settings('logo')['url']) && !empty(grogin_page_settings('logo')['url'])){ ?>
										<img src="<?php echo esc_url( grogin_page_settings('logo')['url'] ); ?>" alt="<?php bloginfo("name"); ?>">
									<?php } elseif (get_theme_mod( 'grogin_logo' )) { ?>
										<img src="<?php echo esc_url( wp_get_attachment_url(get_theme_mod( 'grogin_logo' )) ); ?>" alt="<?php bloginfo("name"); ?>">
									<?php } elseif (get_theme_mod( 'grogin_logo_text' )) { ?>
										<span class="brand-text"><?php echo esc_html(get_theme_mod( 'grogin_logo_text' )); ?></span>
									<?php } else { ?>
										<img src="<?php echo get_template_directory_uri(); ?>/assets/img/grogin-logo-dark.png" width="142" height="34" alt="<?php bloginfo("name"); ?>">
									<?php } ?>
								</a>
							<?php } else { ?>
								<a href="<?php echo esc_url( home_url( "/" ) ); ?>" title="<?php bloginfo("name"); ?>">
									<?php if (get_theme_mod( 'grogin_logo' )) { ?>
										<img src="<?php echo esc_url( wp_get_attachment_url(get_theme_mod( 'grogin_logo' )) ); ?>" alt="<?php bloginfo("name"); ?>">
									<?php } elseif (get_theme_mod( 'grogin_logo_text' )) { ?>
										<span class="brand-text"><?php echo esc_html(get_theme_mod( 'grogin_logo_text' )); ?></span>
									<?php } else { ?>
										<img src="<?php echo get_template_directory_uri(); ?>/assets/img/grogin-logo-dark.png" width="142" height="34" alt="<?php bloginfo("name"); ?>">
									<?php } ?>
								</a>
							<?php } ?>
					</div><!-- site-brand -->
				</div><!-- col -->
				<div class="col d-none d-xl-inline-flex align-items-center flex-fill">
					
					<?php if(get_theme_mod('grogin_categories_popup','0') == 1){ ?>
						<div class="quick-button style-1 filled categories-button">
							<a href="#" class="action-link">
							  <div class="action-icon">
								<i class="klb-icon-menu"></i>
							  </div><!-- action-icon -->
							  <div class="action-text">
								<p><?php esc_html_e('Categories','grogin'); ?></p>
							  </div><!-- action-text -->
							</a>
						</div><!-- quick-button -->
					<?php } ?>
					
					<?php grogin_header_search_input(); ?>
					
				</div><!-- col -->
				<div class="col d-none d-xl-inline-flex align-items-center flex-auto gap-2">
		
					<?php grogin_account_icon3(); ?>  
					
					<?php grogin_wishlist_icon3(); ?>
					
					<?php grogin_compare_icon(); ?>  
					
					<?php grogin_cart_icon3(); ?> 
				 
				</div><!-- col -->
				<div class="col d-inline-flex d-xl-none align-items-center flex-auto">
					<?php grogin_cart_icon(); ?> 
				</div><!-- col -->
			</div><!-- header-inner -->
        </div><!-- container -->
    </div><!-- header-row -->
    
    <div class="header-row header-nav position-relative d-none d-xl-block header-row-white z-1">
        <div class="container">
			<div class="header-inner position-relative d-flex flex-wrap align-items-center justify-content-between">
				<div class="col d-inline-flex align-items-center justify-content-start">
					<nav class="site-menu horizontal menu-shadow primary-menu">
					<?php 
					wp_nav_menu(array(
					'theme_location' => 'main-menu',
					'container' => '',
					'fallback_cb' => 'show_top_menu',
					'menu_id' => '',
					'menu_class' => '',
					'echo' => true,
					"walker" => '',
					'depth' => 0 
					));
					?>
					</nav><!-- site-menu -->		
				</div><!-- col -->
				<div class="col d-inline-flex align-items-center justify-content-end">
					<?php grogin_trending_products(); ?>
					
					<?php grogin_discount_products(); ?>
				</div><!-- col -->
			</div><!-- header-inner -->
        </div><!-- container -->
    </div><!-- header-row -->
	
	<?php grogin_header_categories_popup(); ?>
</header>