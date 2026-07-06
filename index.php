<?php
/**
 * index.php
 * @package WordPress
 * @subpackage Grogin
 * @since Grogin 1.0
 * 
 */
 ?>
 
<?php get_header(); ?>

<?php 
wp_enqueue_script( 'theia-sticky-sidebar');
wp_enqueue_script( 'grogin-stickysidebar');
?>

<div class="page-wrapper shop-page-default">
        <div class="container">
			
			<?php if(function_exists('grogin_breadcrubms')){ ?>
				<?php echo grogin_breadcrubms(); ?>
			<?php } ?>
			
			<?php if( get_theme_mod( 'grogin_blog_layout' ) == 'left-sidebar') { ?>
				<div class="row content-wrapper mt-10 sm-mt-20 md-mt-30 sidebar-left">
					<div id="sidebar" class="col col-12 col-lg-3 secondary-column blog-sidebar sticky">
						<?php if ( is_active_sidebar( 'blog-sidebar' ) ) { ?>
							<?php dynamic_sidebar( 'blog-sidebar' ); ?>
						<?php } ?>
					</div>
					<div class="col col-12 col-lg-9 primary-column">
						<div class="blog-posts">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

								<?php  get_template_part( 'post-format/content', get_post_format() ); ?>

							<?php endwhile; ?>
						
								<?php get_template_part( 'post-format/pagination' ); ?>
								
							<?php else : ?>

								<h2><?php esc_html_e('No Posts Found', 'grogin') ?></h2>

							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php } elseif( get_theme_mod( 'grogin_blog_layout' ) == 'full-width') { ?>
				<div class="row content-wrapper mt-10 sm-mt-20 md-mt-30">
					<div class="col col-12 col-lg-12 primary-column">
						<div class="blog-posts">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

								<?php  get_template_part( 'post-format/content', get_post_format() ); ?>

							<?php endwhile; ?>
						
								<?php get_template_part( 'post-format/pagination' ); ?>
								
							<?php else : ?>

								<h2><?php esc_html_e('No Posts Found', 'grogin') ?></h2>

							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php } else { ?>
				<?php if ( is_active_sidebar( 'blog-sidebar' ) ) { ?>
					<div class="row content-wrapper mt-10 sm-mt-20 md-mt-30 sidebar-right">
						<div class="col col-12 col-lg-9 primary-column">
							<div class="blog-posts">
								<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

									<?php  get_template_part( 'post-format/content', get_post_format() ); ?>

								<?php endwhile; ?>
							
									<?php get_template_part( 'post-format/pagination' ); ?>
									
								<?php else : ?>

									<h2><?php esc_html_e('No Posts Found', 'grogin') ?></h2>

								<?php endif; ?>
							</div>
						</div>
						<div id="sidebar" class="col col-12 col-lg-3 secondary-column blog-sidebar sticky">
							<?php if ( is_active_sidebar( 'blog-sidebar' ) ) { ?>
								<?php dynamic_sidebar( 'blog-sidebar' ); ?>
							<?php } ?>
						</div>
					</div>
				<?php } else { ?>
					<div class="row content-wrapper mt-10 sm-mt-20 md-mt-30">
						<div class="col col-12 col-lg-12 primary-column">
							<div class="blog-posts">
								<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

									<?php  get_template_part( 'post-format/content', get_post_format() ); ?>

								<?php endwhile; ?>
							
									<?php get_template_part( 'post-format/pagination' ); ?>
									
								<?php else : ?>

									<h2><?php esc_html_e('No Posts Found', 'grogin') ?></h2>

								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
	</div>
</div>

<?php get_footer(); ?>