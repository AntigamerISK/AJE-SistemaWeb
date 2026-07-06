<?php

/*************************************************
## Main Footer Function
*************************************************/

add_action('grogin_main_footer','grogin_main_footer_function',20);

if ( ! function_exists( 'grogin_main_footer_function' ) ) {
	function grogin_main_footer_function(){
		
		get_template_part( 'includes/footer/footer-type1' );
		
	}
}