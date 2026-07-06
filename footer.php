<?php
/**
 * footer.php
 * @package WordPress
 * @subpackage Grogin
 * @since Grogin 1.0
 * 
 */
 ?>
 
 
		</div><!-- main-content -->
		
		<?php grogin_do_action( 'grogin_before_main_footer'); ?>

		<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) { ?>
		
			<?php
			/**
			* Hook: grogin_main_footer
			*
			* @hooked grogin_main_footer_function - 10
			*/
			do_action( 'grogin_main_footer' );
		
			?>
			
		<?php } ?>
		
		<?php grogin_do_action( 'grogin_after_main_footer'); ?>
		
		<div class="mobile-overlay"></div>
		
	</div><!-- page-content -->
	
	<?php wp_footer(); ?>
	</body>
</html>