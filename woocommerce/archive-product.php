<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */
 
wp_enqueue_script( 'theia-sticky-sidebar');
wp_enqueue_script( 'grogin-stickysidebar');
wp_enqueue_script( 'grogin-sidebarfilter');

defined( 'ABSPATH' ) || exit;

// Elementor `archive` location
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'archive' ) ) {

	if ( ! grogin_is_pjax() ) {
	    get_header( 'shop' );
	}
	?>

	<?php grogin_do_action( 'grogin_before_main_shop'); ?>
		
	<div class="page-wrapper shop-page-default">
		<div class="container">
			
			<?php woocommerce_breadcrumb(); ?>
			
			<?php do_action( 'woocommerce_before_main_content' ); ?>

			<?php
						
			/**
			 * Hook: woocommerce_shop_loop_header.
			 *
			 * @since 8.6.0
			 *
			 * @hooked woocommerce_product_taxonomy_archive_header - 10
			 */
			do_action( 'woocommerce_shop_loop_header' );
			
			?>

			<?php if( get_theme_mod( 'grogin_shop_layout' ) == 'full-width' || grogin_get_option() == 'full-width') { ?>
				<div class="row content-wrapper row-reverse mt-10 sm-mt-20 md-mt-30">
					<div id="primary" class="col col-12 col-lg-12 primary-column">

						<?php get_template_part( 'includes/woocommerce/banner' ); ?>

						<?php do_action('klb_before_products'); ?>
						
						<?php
						if ( woocommerce_product_loop() ) {
							
							/**
							 * Hook: woocommerce_before_shop_loop.
							 *
							 * @hooked woocommerce_output_all_notices - 10
							 * @hooked woocommerce_result_count - 20
							 * @hooked woocommerce_catalog_ordering - 30
							 */
							do_action( 'woocommerce_before_shop_loop' );

			
							woocommerce_product_loop_start();

							if ( wc_get_loop_prop( 'total' ) ) {
								while ( have_posts() ) {
									the_post();

									/**
									 * Hook: woocommerce_shop_loop.
									 */
									do_action( 'woocommerce_shop_loop' );

									wc_get_template_part( 'content', 'product' );
								}
							}

							woocommerce_product_loop_end();

							do_action( 'woocommerce_after_shop_loop' );
						} else {
							do_action( 'woocommerce_no_products_found' );
						}
						?>
					</div>
					<?php if ( is_active_sidebar( 'shop-sidebar' ) ) { ?>
						<div id="sidebar" class="col col-12 col-lg-3 secondary-column filter-sidebar sticky hide-desktop d-lg-none">
							<div class="filter-sidebar-header">
								<h3 class="entry-title"><?php esc_html_e('Filter Products','grogin'); ?></h3>
								<div class="site-button close-button">
									<a href="#"><i class="klb-icon-x"></i></a>
								</div><!-- site-button -->        
							</div>
							<div class="site-scroll">
								<div class="filter-sidebar-body">
									<?php dynamic_sidebar( 'shop-sidebar' ); ?>
								</div>
							</div>
						</div>
					<?php } ?>
					
					<div class="mobile-overlay"></div>
				</div>
			<?php } elseif( get_theme_mod( 'grogin_shop_layout' ) == 'right-sidebar' || grogin_get_option() == 'right-sidebar') { ?>
				<div class="row content-wrapper row-reverse mt-10 sm-mt-20 md-mt-30 sidebar-right">
					<div id="primary" class="col col-12 col-lg-9 primary-column">
						<?php get_template_part( 'includes/woocommerce/banner' ); ?>

						<?php do_action('klb_before_products'); ?>
						
						<?php
						if ( woocommerce_product_loop() ) {
							/**
							 * Hook: woocommerce_before_shop_loop.
							 *
							 * @hooked woocommerce_output_all_notices - 10
							 * @hooked woocommerce_result_count - 20
							 * @hooked woocommerce_catalog_ordering - 30
							 */
							do_action( 'woocommerce_before_shop_loop' );
							woocommerce_product_loop_start();

							if ( wc_get_loop_prop( 'total' ) ) {
								while ( have_posts() ) {
									the_post();

									/**
									 * Hook: woocommerce_shop_loop.
									 */
									do_action( 'woocommerce_shop_loop' );

									wc_get_template_part( 'content', 'product' );
								}
							}

							woocommerce_product_loop_end();

							do_action( 'woocommerce_after_shop_loop' );
						} else {
							do_action( 'woocommerce_no_products_found' );
						}
						?>
					</div>
					<?php if ( is_active_sidebar( 'shop-sidebar' ) ) { ?>
						<div id="sidebar" class="col col-12 col-lg-3 secondary-column filter-sidebar sticky">
							<div class="filter-sidebar-header">
								<h3 class="entry-title"><?php esc_html_e('Filter Products','grogin'); ?></h3>
								<div class="site-button close-button">
									<a href="#"><i class="klb-icon-x"></i></a>
								</div><!-- site-button -->        
							</div>
							<div class="site-scroll">
								<div class="filter-sidebar-body">
									<?php dynamic_sidebar( 'shop-sidebar' ); ?>
								</div>
							</div>
						</div>
					<?php } ?>
					<div class="mobile-overlay"></div>
				</div>
			<?php } else { ?>
				<?php if ( is_active_sidebar( 'shop-sidebar' ) ) { ?>
					<div class="row content-wrapper row-reverse mt-10 sm-mt-20 md-mt-30 sidebar-left">
						
						<div id="primary" class="col col-12 col-lg-9 primary-column">
							<?php get_template_part( 'includes/woocommerce/banner' ); ?>
	
							<?php do_action('klb_before_products'); ?>
						
							<?php
							if ( woocommerce_product_loop() ) {
								/**
								 * Hook: woocommerce_before_shop_loop.
								 *
								 * @hooked woocommerce_output_all_notices - 10
								 * @hooked woocommerce_result_count - 20
								 * @hooked woocommerce_catalog_ordering - 30
								 */
								do_action( 'woocommerce_before_shop_loop' );
								woocommerce_product_loop_start();

								if ( wc_get_loop_prop( 'total' ) ) {
									while ( have_posts() ) {
										the_post();

										/**
										 * Hook: woocommerce_shop_loop.
										 */
										do_action( 'woocommerce_shop_loop' );

										wc_get_template_part( 'content', 'product' );
									}
								}

								woocommerce_product_loop_end();

								do_action( 'woocommerce_after_shop_loop' );
							} else {
								do_action( 'woocommerce_no_products_found' );
							}
							?>
						</div>
						<?php if ( is_active_sidebar( 'shop-sidebar' ) ) { ?>
							<div id="sidebar" class="col col-12 col-lg-3 secondary-column filter-sidebar sticky">
								<div class="filter-sidebar-header">
									<h3 class="entry-title"><?php esc_html_e('Filter Products','grogin'); ?></h3>
									<div class="site-button close-button">
										<a href="#"><i class="klb-icon-x"></i></a>
									</div><!-- site-button -->        
								</div>
								<div class="site-scroll">
									<div class="filter-sidebar-body">
										<?php dynamic_sidebar( 'shop-sidebar' ); ?>
									</div>
								</div>
							</div>
						<?php } ?>
						<div class="mobile-overlay"></div>
					</div>
				<?php } else { ?>
					<div class="row content-wrapper row-reverse mt-10 sm-mt-20 md-mt-30 sidebar-left">
						<div id="primary" class="col col-12 col-lg-12 primary-column">
							<?php get_template_part( 'includes/woocommerce/banner' ); ?>
	
							<?php do_action('klb_before_products'); ?>
							
							<?php
							if ( woocommerce_product_loop() ) {
								/**
								 * Hook: woocommerce_before_shop_loop.
								 *
								 * @hooked woocommerce_output_all_notices - 10
								 * @hooked woocommerce_result_count - 20
								 * @hooked woocommerce_catalog_ordering - 30
								 */
								do_action( 'woocommerce_before_shop_loop' );
								woocommerce_product_loop_start();

								if ( wc_get_loop_prop( 'total' ) ) {
									while ( have_posts() ) {
										the_post();

										/**
										 * Hook: woocommerce_shop_loop.
										 */
										do_action( 'woocommerce_shop_loop' );

										wc_get_template_part( 'content', 'product' );
									}
								}

								woocommerce_product_loop_end();

								do_action( 'woocommerce_after_shop_loop' );
							} else {
								do_action( 'woocommerce_no_products_found' );
							}
							?>
						
						</div>
						<?php if ( is_active_sidebar( 'shop-sidebar' ) ) { ?>
							<div id="sidebar" class="col col-12 col-lg-3 secondary-column filter-sidebar sticky">
								<div class="filter-sidebar-header">
									<h3 class="entry-title"><?php esc_html_e('Filter Products','grogin'); ?></h3>
									<div class="site-button close-button">
										<a href="#"><i class="klb-icon-x"></i></a>
									</div><!-- site-button -->        
								</div>
								<div class="site-scroll">
									<div class="filter-sidebar-body">
										<?php dynamic_sidebar( 'shop-sidebar' ); ?>
									</div>
								</div>
							</div>
						<?php } ?>
						<div class="mobile-overlay"></div>
						
					</div>
				<?php } ?>
			<?php } ?>
				
			<?php

				/**
				 * Hook: woocommerce_after_main_content.
				 *
				 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
				 */
				do_action( 'woocommerce_after_main_content' );
			?>

			<?php grogin_do_action( 'grogin_after_main_shop'); ?>
		</div>
	</div>

	<?php
		if ( ! grogin_is_pjax() ) {
			get_footer( 'shop' );
		}
}
