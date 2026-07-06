<?php $categorybanner = get_theme_mod('grogin_shop_banner_each_category'); ?>
<?php if($categorybanner && is_product_category() && array_search(get_queried_object()->term_id, array_column($categorybanner, 'category_id')) !== false){ ?>
	<?php foreach($categorybanner as $c){ ?>
		<?php if($c['category_id'] == get_queried_object()->term_id){ ?>
			<div class="woocommerce-page-header">
				<div class="site-banner overflow-hidden rounded-base shop-page-banner" style="--banner-tablet-height: 280px; --banner-mobile-height: 280px;" data-color="dark">
					<div class="entry-wrapper d-flex align-items-center strech p-20 sm-p-30">
						<div class="entry-inner max-w-70 sm-max-w-50 md-max-w-50">
						  <div class="entry-header mb-7">
							<h5 class="entry-subtitle badge text-12 fw-semibold text-orange-900 bg-orange-100"><?php echo esc_html($c['category_subtitle']); ?></h5>
						  </div><!-- entry-header -->
						  <div class="entry-body mb-10">
							<h2 class="entry-title text-22 sm-text-26 md-text-30 fw-bold lh-sm lt-tighter text-gray-900"><?php echo esc_html($c['category_title']); ?></h2>
							<div class="entry-content pr-0 md-pr-30">
							  <p class="text-13 lh-base text-gray-500"><?php echo grogin_sanitize_data($c['category_desc']); ?></p>
							</div><!-- entry-content -->
						  </div><!-- entry-body -->
						  <?php if($c['category_button_url']){ ?>
						  <div class="entry-footer d-flex flex-wrap align-items-center gap-3">
							<a href="<?php echo esc_url($c['category_button_url']); ?>" class="btn btn-white xs rounded icon-right"><?php echo esc_html($c['category_button_title']); ?><i class="klb-icon-move-right"></i></a>
						  </div><!-- entry-footer -->
						  <?php } ?>
						</div><!-- entry-inner -->
					</div><!-- entry-wrapper -->
					<div class="entry-media">
						<img src="<?php echo esc_url(grogin_get_image($c['category_image'])); ?>" alt="<?php echo esc_attr($c['category_title']); ?>"/>
					</div><!-- entry-media -->
					<a href="<?php echo esc_url($c['category_button_url']); ?>" class="overlay-link"></a>
				</div>
			</div>
			
		<?php } ?>
	<?php } ?>
<?php } else { ?>
	<?php $banner = get_theme_mod('grogin_shop_banner_image'); ?>
	<?php $bannertitle = get_theme_mod('grogin_shop_banner_title'); ?>
	<?php $bannersubtitle = get_theme_mod('grogin_shop_banner_subtitle'); ?>
	<?php $bannerdesc = get_theme_mod('grogin_shop_banner_desc'); ?>
	<?php $bannerbuttontext = get_theme_mod('grogin_shop_banner_button_text'); ?>
	<?php $bannerurl = get_theme_mod('grogin_shop_banner_url'); ?>
	<?php if($banner){ ?>
		
		<div class="woocommerce-page-header">
			<div class="site-banner overflow-hidden rounded-base shop-page-banner" style="--banner-tablet-height: 280px; --banner-mobile-height: 280px;" data-color="dark">
				<div class="entry-wrapper d-flex align-items-center strech p-20 sm-p-30">
					<div class="entry-inner max-w-70 sm-max-w-50 md-max-w-50">
					  <div class="entry-header mb-7">
						<h5 class="entry-subtitle badge text-12 fw-semibold text-orange-900 bg-orange-100"><?php echo esc_html($bannersubtitle); ?></h5>
					  </div><!-- entry-header -->
					  <div class="entry-body mb-10">
						<h2 class="entry-title text-22 sm-text-26 md-text-30 fw-bold lh-sm lt-tighter text-gray-900"><?php echo esc_html($bannertitle); ?></h2>
						<div class="entry-content pr-0 md-pr-30">
						  <p class="text-13 lh-base text-gray-500"><?php echo esc_html($bannerdesc); ?></p>
						</div><!-- entry-content -->
					  </div><!-- entry-body -->
					  <div class="entry-footer d-flex flex-wrap align-items-center gap-3">
						<a href="<?php echo esc_url($bannerurl); ?>" class="btn btn-white xs rounded icon-right"><?php echo esc_html($bannerbuttontext); ?> <i class="klb-icon-move-right"></i></a>
					  </div><!-- entry-footer -->
					</div><!-- entry-inner -->
				</div><!-- entry-wrapper -->
				<div class="entry-media">
					<img src="<?php echo esc_url(wp_get_attachment_url($banner)); ?>" alt="<?php echo esc_attr($bannertitle); ?>"/>
				</div><!-- entry-media -->
				<a href="<?php echo esc_url($bannerurl); ?>" class="overlay-link"></a>
			</div>
		</div>
		
	<?php } ?>
<?php } ?>