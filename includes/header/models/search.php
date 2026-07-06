<?php

if ( ! function_exists( 'grogin_header_search_input' ) ) {
	function grogin_header_search_input(){
		$headersearch = get_theme_mod('grogin_header_search','0');
		if($headersearch == 1){
		?>
		
			<div class="header-search search-overlay flex-fill">
				<?php echo grogin_header_product_search(); ?>
			</div><!-- header-search-form -->
	<?php  }
	}
}