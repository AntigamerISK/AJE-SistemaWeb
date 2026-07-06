<div id="post-<?php the_ID(); ?>" <?php post_class('klb-article single-post'); ?>>
	<div class="post-header">

		<h1 class="entry-title text-18 sm-text-46 sm-pr-20 sm-mb-15"><?php the_title(); ?></h1>
		
		 <div class="entry-post-meta mb-30">
			 <div class="meta-item entry-published">
				<a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>
			</div><!-- entry-published -->
			
			<?php the_tags( '<div class="meta-item">', ', ', ' </div>'); ?>
		
			<?php if ( is_sticky()) {
				printf( '<span class="meta-item sticky-post"><i class="klb-icon-star-empty"></i> %s</span>', esc_html__('Featured', 'grogin' ) );
			} ?>
		</div>
		
	</div>
	
	<figure class="entry-media">
		<?php $images = rwmb_meta( 'klb_blogitemslides', 'type=image_advanced&size=medium' ); ?>
		<?php if($images) { ?>
			
			<div class="blog-gallery">
				<?php  foreach ( $images as $image ) { ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<img src="<?php echo esc_url($image['full_url']); ?>" alt="<?php the_title_attribute(); ?>">
					</a>
				<?php } ?>
			</div>
		<?php } ?>
	</figure>
	  
	<div class="post-body">
		<div class="entry-content">
			<div class="klb-post">
				<?php the_content(); ?>
				<?php wp_link_pages(array('before' => '<div class="klb-pagination">' . esc_html__( 'Pages:', 'grogin' ),'after'  => '</div>', 'next_or_number' => 'number')); ?>
			</div>
		</div><!-- entry-content -->
	</div><!-- entry-wrapper -->
	
</div><!-- post -->