<div id="post-<?php the_ID(); ?>" <?php post_class('klb-article post'); ?>>
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
		<h3 class="entry-title text-18 sm-text-36"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		
		<div class="entry-post-meta mb-20">
			<div class="meta-item entry-published">
			  <a href="<?php the_permalink(); ?>"> <?php echo get_the_date(); ?></a>
			</div><!-- entry-published -->
			
			<?php the_tags( '<span class="meta-item entry-tags">', ', ', ' </span>'); ?>
			
			<?php if ( is_sticky()) {
				printf( '<span class="meta-item sticky-post"><i class="klb-icon-star-empty"></i> %s</span>', esc_html__('Featured', 'grogin' ) );
			} ?>
		</div><!-- entry-post-meta -->
		
		<div class="entry-excerpt">
			<?php the_excerpt(); ?>
			<?php wp_link_pages(array('before' => '<div class="klb-pagination">' . esc_html__( 'Pages:', 'grogin' ),'after'  => '</div>', 'next_or_number' => 'number')); ?>
		</div>
		
	</div><!-- post-body -->
</div><!-- post -->