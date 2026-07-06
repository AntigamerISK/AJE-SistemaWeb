<?php
/**
 * header.php
 * @package WordPress
 * @subpackage Grogin
 * @since Grogin 1.0
 * 
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( "charset" ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php wp_head(); ?>
</head>
<body <?php body_class('link-underline'); ?>  data-color="default" data-theme="<?php echo get_theme_mod('grogin_skin_type','light'); ?>">
<?php wp_body_open(); ?>

	<?php get_template_part( 'includes/header/models/canvas-menu' ); ?>
	
	<?php if (get_theme_mod( 'grogin_preloader' )) { ?>
	<div class="site-loading">
		<div class="preloading">
			<svg class="circular" viewBox="25 25 50 50">
				<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
			</svg>
		</div>
	</div>
	<?php } ?>
	
	<div id="page" class="page-content d-flex flex-column min-vh-100 h-100">
	
		<?php if (get_theme_mod( 'grogin_top_notification_count_toggle' )) { ?>
			<?php get_template_part( 'includes/header/models/top-notification-count' ); ?>
		<?php } ?>
	
		<?php grogin_do_action( 'grogin_before_main_header'); ?>

		<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) { ?>
			<?php
			/**
			* Hook: grogin_main_header
			*
			* @hooked grogin_main_header_function - 10
			*/
			do_action( 'grogin_main_header' );
		
			?>
		<?php } ?>
		
		<?php grogin_do_action( 'grogin_after_main_header'); ?>
		
		<div id="main" class="main-content flex-fill position-relative z-1">
