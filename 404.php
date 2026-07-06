<?php
/**
 * 404.php
 * @package WordPress
 * @subpackage Grogin
 * @since Grogin 1.0
 */
?>

<?php get_header(); ?>

<div class="page-wrapper page-error">
	<div class="page-header text-center my-30 sm-my-90">
		<div class="container">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/img/404.png" alt="<?php bloginfo("name"); ?>">
			<h1 class="entry-title sm-text-56"><?php esc_html_e('That Page Cant Be Found','grogin'); ?></h1>
			<div class="entry-teaser max-w-520 mx-auto text-14 sm-text-18 mb-30">
				<p class="mb-0 lh-base text-gray-500"><?php esc_html_e('It looks like nothing was found at this location. Maybe try to search for what you are looking for?','grogin'); ?></p>
			</div><!-- entry-teaser -->
			<a href="<?php echo esc_url( home_url('/') ); ?>" class="btn btn-primary"><?php esc_html_e('Go To Homepage','grogin'); ?></a>
		</div><!-- container -->
	</div><!-- page-header -->
</div>

<?php get_footer(); ?>