<div id="menu-drawer" class="site-drawer site-menu-drawer get-mobile-nav-height">
    <div class="site-drawer-inner position-relative d-flex flex-column site-scroll z-1">
  
		<div class="site-drawer-row site-drawer-header d-flex align-items-center justify-content-between pt-18">
			<div class="site-brand">
				<a href="<?php echo esc_url( home_url( "/" ) ); ?>" title="<?php bloginfo("name"); ?>">
					<?php if (get_theme_mod( 'grogin_logo' )) { ?>
						<img src="<?php echo esc_url( wp_get_attachment_url(get_theme_mod( 'grogin_logo' )) ); ?>" alt="<?php bloginfo("name"); ?>">
					<?php } elseif (get_theme_mod( 'grogin_logo_text' )) { ?>
						<span class="brand-text"><?php echo esc_html(get_theme_mod( 'grogin_logo_text' )); ?></span>
					<?php } else { ?>
						<img src="<?php echo get_template_directory_uri(); ?>/assets/img/grogin-logo-dark.png" width="125" height="30" alt="<?php bloginfo("name"); ?>">
					<?php } ?>
					
				</a>
			</div><!-- site-brand -->
			<div class="site-button close-button">
			  <a href="#"><i class="klb-icon-x"></i></a>
			</div><!-- site-button -->    
		</div><!-- site-drawer-header -->
  
		<div class="site-drawer-row site-drawer-body flex-fill pt-20">
			<div class="site-drawer-location d-flex align-items-center justify-content-between lh-1 mt-7 mb-18">
				<?php if(get_theme_mod('grogin_location_filter',0) == 1){ ?>	
					<div class="col d-inline-flex align-items-center flex-fill">
						<span class="text-12 text-gray-400 mr-6"><?php esc_html_e('Your Location','grogin'); ?></span>
						<i class="klb-icon-map-pin mr-6"></i>
						<p class="text-13 fw-bold mb-0"><?php echo esc_html(grogin_location()); ?></p>
					</div><!-- col -->
					<div class="col flex-auto">
						<a href="#" class="modal-button text-13 text-decoration-none fw-semibold" data-modal="location-selector"><?php esc_html_e('Change','grogin'); ?></a>
					</div><!-- col -->
				<?php } ?>	
			</div><!-- site-drawer-location -->
  
			<nav class="site-menu vertical drawer-primary border-bottom border-top border-gray-200">
				<?php 
				wp_nav_menu(array(
				'theme_location' => 'main-menu',
				'container' => '',
				'fallback_cb' => 'show_top_menu',
				'menu_id' => '',
				'menu_class' => 'menu-item',
				'echo' => true,
				"walker" => '',
				'depth' => 0 
				));
				?>    
			</nav><!-- site-menu -->
			
			<?php $canvasbottommenu = get_theme_mod('grogin_canvas_bottom_menu','0'); ?>
				<?php if($canvasbottommenu == '1'){ ?>
				<h4 class="entry-subtitle text-11 fw-bold text-uppercase text-gray-400 lt-spacing-1 mt-30 mb-12 opacity-50"><?php echo esc_html(get_theme_mod( 'grogin_canvas_bottom_menu_title' )); ?></h4>
				<nav class="site-menu vertical drawer-secondary pb-28 border-bottom border-gray-200">
				  <?php 
						 wp_nav_menu(array(
						 'theme_location' => 'canvas-bottom',
						 'container' => '',
						 'fallback_cb' => 'show_top_menu',
						 'menu_id' => '',
						 'menu_class' => 'menu-item',
						 'echo' => true,
						 'depth' => 0 
						)); 
					?>
				</nav><!-- klb-menu-wrapper -->
			<?php } ?>
			
			<?php $menucontactbox = get_theme_mod('grogin_canvas_menu_contact_box'); ?>
			<?php if($menucontactbox){ ?>
				<h4 class="entry-subtitle text-11 fw-bold text-uppercase text-gray-400 lt-spacing-1 mt-30 mb-12 opacity-50"><?php echo esc_html(get_theme_mod( 'grogin_canvas_menu_contact_title' )); ?></h4>
				<div class="site-drawer-contact pb-10">
					<ul>
						<?php foreach($menucontactbox as $contactbox){ ?>
							
								<li>
								  <div class="contact-icon">
									<i class="<?php echo esc_attr($contactbox['menu_contact_box_icon']); ?>"></i>
								  </div><!-- contact-icon -->
								  <div class="contact-detail">
									<div><?php echo grogin_sanitize_data($contactbox['menu_contact_box_title']); ?></div>
									<span><?php echo esc_html($contactbox['menu_contact_box_subtitle']); ?></span>
								  </div><!-- contact-detail -->
								</li>
							
						<?php } ?> 
					</ul>
				</div><!-- drawer-contact -->
			<?php } ?>
			
		</div><!-- site-drawer-body -->
    </div><!-- site-drawer-inner -->
  
    <div class="site-drawer-overlay position-absolute strech"></div>
</div><!-- site-menu-drawer -->  