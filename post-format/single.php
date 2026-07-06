<div id="post-<?php the_ID(); ?>" <?php post_class('klb-article single-post'); ?>>
	<div class="post-header">

		<h1 class="entry-title text-18 sm-text-46 sm-pr-20 sm-mb-15"><?php the_title(); ?></h1>
		
		 <div class="entry-post-meta mb-30">
			 <div class="meta-item entry-published">
				<a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>
			</div><!-- entry-published -->
			
			<?php if (!has_post_thumbnail()) { ?>
				<?php if(has_category()){ ?>
					<div class="meta-item entry-category">
					  <?php the_category(', '); ?>
					</div><!-- entry-published -->
				<?php } ?>
			<?php } ?>
			
			<?php the_tags( '<div class="meta-item">', ', ', ' </div>'); ?>
		
			<?php if ( is_sticky()) {
				printf( '<span class="meta-item sticky-post"><i class="klb-icon-star-empty"></i> %s</span>', esc_html__('Featured', 'grogin' ) );
			} ?>
		</div>
		
	</div>
	
	<div class="post-thumbnail">
		<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
			<?php if(has_category()){ ?>
				<div class="post-category">
					<?php the_category(', '); ?>
				</div><!-- entry-category -->
			<?php } ?>
			<?php  
			$att=get_post_thumbnail_id();
			$image_src = wp_get_attachment_image_src( $att, 'full' );
			$image_src = $image_src[0]; 
			?>
			<div class="post-gallery position-relative overflow-hidden entry-media rounded-base sm-mb-30">
				<img src="<?php echo esc_url($image_src); ?>" alt="<?php the_title_attribute(); ?>">
			</div><!-- post-gallery -->
		<?php } ?>
	</div><!-- post-thumbnail -->
	  
	<div class="post-body">
		<div class="entry-content">
			<div class="klb-post">
				<?php the_content(); ?>
				<?php wp_link_pages(array('before' => '<div class="klb-pagination">' . esc_html__( 'Pages:', 'grogin' ),'after'  => '</div>', 'next_or_number' => 'number')); ?>
			</div>
		</div><!-- entry-content -->
	</div><!-- entry-wrapper -->
	
</div><!-- post -->

