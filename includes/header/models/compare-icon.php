<?php
if ( ! function_exists( 'grogin_compare_icon' ) ) {
	function grogin_compare_icon(){
	?>

	<?php $compareheader = get_theme_mod('grogin_header_compare',0); ?>
	<?php if($compareheader == 1){ ?>

		<?php if ( class_exists( 'KlbCompare' ) ) { ?>	
			<div class="quick-button style-2 compare-button">
				<a href="<?php echo KlbCompare::get_page_url(); ?>" class="action-link">
					<div class="action-icon">
						<i class="klb-icon-repeat"></i>
						<span class="action-count klbcp-count"><?php echo KlbCompare::get_count(); ?></span>
						
					</div><!-- action-icon -->
				</a>
			</div>
		<?php } ?>
		
	<?php } ?>
	
	<?php 
	
	}
}