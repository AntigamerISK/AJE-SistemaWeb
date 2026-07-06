<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.0.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_mini_cart' ); ?>

<?php if ( WC()->cart && ! WC()->cart->is_empty() ) : ?>

	<div class="products list-style xs-list woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr( $args['list_class'] ); ?>">
		<?php
		do_action( 'woocommerce_before_mini_cart_contents' );

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				/**
				 * This filter is documented in woocommerce/templates/cart/cart.php.
				 *
				 * @since 2.1.0
				 */
				$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
				$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
				$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
				<div class="product woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
					<div class="product-wrapper">
						<div class="product-inner">
							<div class="thumbnail-wrapper">
								<div class="product-thumbnail">
									<?php if ( empty( $product_permalink ) ) : ?>
										<?php echo grogin_sanitize_data($thumbnail); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									<?php else : ?>
										<a href="<?php echo esc_url( $product_permalink ); ?>">
											<div class="product-gallery">
												<?php echo grogin_sanitize_data($thumbnail); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											</div>
										</a>
									<?php endif; ?>
								</div><!-- product-thumbnail -->
							</div><!-- thumbnail-wrapper -->
							<div class="content-wrapper">
								<h2 class="product-title"><a href="<?php echo esc_url($product_permalink); ?>"><?php echo esc_html($product_name); ?></a></h2>
								<span class="price">
									<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantitysa">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>	
								</span><!-- price -->
							</div><!-- content-wrapper -->
							
							<?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							
							<?php
							echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								'woocommerce_cart_item_remove_link',
								sprintf(
									'<a role="button" href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s" data-success_message="%s"><i class="klb-icon-x"></i></a>',
									esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
									/* translators: %s is the product name */
									esc_attr( sprintf( __( 'Remove %s from cart', 'grogin' ), wp_strip_all_tags( $product_name ) ) ),
									esc_attr( $product_id ),
									esc_attr( $cart_item_key ),
									esc_attr( $_product->get_sku() ),
									/* translators: %s is the product name */
									esc_attr( sprintf( __( '&ldquo;%s&rdquo; has been removed from your cart', 'grogin' ), wp_strip_all_tags( $product_name ) ) )
								),
								$cart_item_key
							);
							?>
							
						</div><!-- product-inner -->
					</div><!-- product-wrapper -->
				</div><!-- product -->
				<?php
			}
		}

		do_action( 'woocommerce_mini_cart_contents' );
		?>
	</div>

	<p class="woocommerce-mini-cart__total total">
		<?php
		/**
		 * Hook: woocommerce_widget_shopping_cart_total.
		 *
		 * @hooked woocommerce_widget_shopping_cart_subtotal - 10
		 */
		do_action( 'woocommerce_widget_shopping_cart_total' );
		?>
	</p>

	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

	<p class="woocommerce-mini-cart__buttons buttons"><?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?></p>

	<?php do_action( 'woocommerce_widget_shopping_cart_after_buttons' ); ?>

<?php else : ?>
	<div class="empty-cart">
		<svg class="mb-20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4000 4000" width="4000" height="4000">
		<style type="text/css">
		  .st0{fill:#FFFFFF;}
		  .st1{fill-rule:evenodd;clip-rule:evenodd;fill:#CADCF0;}
		  .st2{fill-rule:evenodd;clip-rule:evenodd;fill:#A4BBDB;}
		  .st3{fill-rule:evenodd;clip-rule:evenodd;fill:#E9F3FC;}
		  .st4{fill-rule:evenodd;clip-rule:evenodd;fill:#347BFA;}
		</style>
		  <rect class="st0" width="4000" height="4000"/>
		  <g id="Exp-2.-F" serif:id="Exp 2. F">
			<path class="st1" d="M3250,2226.1H750v1157c0,55.2,36.2,103.9,89.1,119.8c251.2,75.3,957.6,287.2,1125,337.5c23.4,7,48.4,7,71.9,0
			  c167.4-50.2,873.8-262.2,1125-337.5c52.9-15.9,89.1-64.6,89.1-119.8C3250,3093.3,3250,2226.1,3250,2226.1z"/>
			<path class="st2" d="M3250,2226.1H2000c0,0-12.1,1619.5,0,1619.5s24.2-1.8,35.9-5.2c167.4-50.2,873.8-262.2,1125-337.5
			  c52.9-15.9,89.1-64.6,89.1-119.8C3250,3093.3,3250,2226.1,3250,2226.1z"/>
			<path class="st3" d="M2000,2631.6L750,2226.1c0,0-219.2,325-317.2,470.2c-11,16.3-13.7,36.8-7.3,55.3c6.4,18.6,21.1,33,39.8,39.1
			  c237.4,77.1,940.3,305.5,1124.7,365.4c26.4,8.6,55.4-1.3,71.1-24.4C1744.9,3008.1,2000,2631.6,2000,2631.6z"/>
			<path class="st3" d="M3250,2226.1l-1250,405.6c0,0,255.1,376.4,338.9,500.1c15.6,23.1,44.6,33,71.1,24.4
			  c184.4-59.9,887.2-288.2,1124.7-365.4c18.7-6.1,33.4-20.6,39.8-39.1c6.4-18.6,3.7-39-7.3-55.3
			  C3469.2,2551.1,3250,2226.1,3250,2226.1z"/>
			<path class="st1" d="M1697.4,1374.1c-15.6-22.9-44.6-32.9-71-24.2c-184.2,59.8-887.3,288.2-1124.8,365.4
			  c-18.7,6.1-33.4,20.5-39.8,39.1c-6.4,18.6-3.7,39.1,7.3,55.3c90.2,133.9,280.8,416.4,280.8,416.4l1250-406.9
			  C2000,1819.1,1775.5,1488.9,1697.4,1374.1z"/>
			<path class="st3" d="M3530.8,1809.7c11-16.2,13.7-36.7,7.3-55.3c-6.4-18.6-21.1-33-39.8-39.1c-237.4-77.2-940.5-305.6-1124.8-365.4
			  c-26.4-8.6-55.4,1.3-71,24.2c-78.1,114.8-302.6,445-302.6,445l1250,406.9C3250,2226.1,3440.6,1943.6,3530.8,1809.7z"/>
			<path class="st1" d="M3250,2226.1l-1250-406.9L750,2226.1l1250,405.6L3250,2226.1z"/>
			<path class="st2" d="M2000,2631.6v-812.5L750,2226.1L2000,2631.6z"/>
			<path class="st4" d="M1748.9,1998.6c-26-17-49.4-35.2-70.2-54.2c-25.4-23.3-64.9-21.6-88.3,3.8c-23.3,25.4-21.6,64.9,3.8,88.2
			  c25.6,23.5,54.4,45.9,86.4,66.8c28.9,18.9,67.6,10.8,86.5-18.1S1777.8,2017.5,1748.9,1998.6z"/>
			<path class="st4" d="M1554.1,1806.6c-18.6-25.2-34.2-50.5-47.1-75.8c-15.6-30.8-53.3-43-84.1-27.4c-30.8,15.6-43,53.3-27.4,84.1
			  c15.9,31.1,35.1,62.3,57.9,93.2c20.4,27.8,59.6,33.7,87.4,13.3C1568.6,1873.5,1574.6,1834.4,1554.1,1806.6z"/>
			<path class="st4" d="M1462.7,1551.6c0.6-25.2,4.3-49.6,11.1-73.1c9.5-33.1-9.7-67.8-42.9-77.3c-33.1-9.5-67.8,9.7-77.3,42.9
			  c-9.6,33.5-14.9,68.4-15.9,104.4c-0.8,34.5,26.4,63.2,60.9,64C1433.2,1613.3,1461.9,1586.1,1462.7,1551.6z"/>
			<path class="st4" d="M1558.9,1342.8c16.1-14.9,34.1-28.6,53.8-41.1c29.2-18.4,37.9-57.1,19.6-86.2c-18.4-29.2-57.1-37.9-86.2-19.6
			  c-26.4,16.7-50.4,35.1-72,55.1c-25.3,23.4-26.8,63-3.4,88.3C1494,1364.8,1533.6,1366.3,1558.9,1342.8z"/>
			<path class="st4" d="M1791.3,1235c31.4-5.8,64.8-9.6,99.9-11c34.5-1.5,61.2-30.7,59.8-65.1c-1.4-34.4-30.6-61.2-65.1-59.8
			  c-41.2,1.8-80.4,6.2-117.3,13c-33.9,6.3-56.4,38.9-50.1,72.8C1724.8,1218.8,1757.4,1241.3,1791.3,1235z"/>
			<path class="st4" d="M2117.1,1231.3c53.3,0.6,102.9-1.2,149-5.3c34.4-3.1,59.8-33.4,56.8-67.8c-3.1-34.3-33.4-59.7-67.8-56.7
			  c-42.2,3.7-87.6,5.4-136.5,4.8c-34.5-0.4-62.8,27.3-63.2,61.7C2054.9,1202.6,2082.6,1230.9,2117.1,1231.3z"/>
			<path class="st4" d="M2471.5,1187.7c61.9-18.9,114.1-43.2,157.9-71c29.1-18.6,37.7-57.2,19.1-86.3c-18.5-29.1-57.2-37.7-86.3-19.1
			  c-35.2,22.4-77.4,41.6-127.2,56.9c-32.9,10.1-51.6,45.1-41.4,78.1C2403.6,1179.2,2438.6,1197.8,2471.5,1187.7z"/>
			<path class="st4" d="M2789.6,941.8c29.5-61,40.8-125.5,37.9-187.7c-1.6-34.5-30.9-61.1-65.4-59.5s-61.1,30.9-59.5,65.3
			  c2,42.2-5.6,86.1-25.6,127.5c-15,31.1-2,68.5,29.1,83.5S2774.6,972.8,2789.6,941.8z"/>
			<path class="st4" d="M2749.8,533.1c-45.6-61.6-107.4-104.4-174.8-118.2c-33.8-6.9-66.9,14.9-73.8,48.7
			  c-6.9,33.8,14.9,66.9,48.7,73.8c38.9,7.9,73.1,34.6,99.4,70.2c20.6,27.7,59.8,33.5,87.4,13C2764.6,599.9,2770.4,560.8,2749.8,533.1
			  z"/>
			<path class="st1" d="M1933.3,426.9c67.6-382.9,653.7-358.2,312.5,0H1933.3z"/>
			<path class="st1" d="M1933.3,523.9c67.6,382.9,653.7,358.2,312.5,0H1933.3z"/>
			<path class="st4" d="M1927.7,538.6h418.5c34.5,0,62.5-28,62.5-62.5s-28-62.5-62.5-62.5h-418.5c-34.4,0-62.5,28-62.5,62.5
			  S1893.2,538.6,1927.7,538.6z"/>
		  </g>
		</svg>
		<p class="text-13 fw-medium text-gray-600 mb-0"><?php esc_html_e( 'No products in the cart.', 'grogin' ); ?></p>
	</div><!-- empty-cart -->

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
