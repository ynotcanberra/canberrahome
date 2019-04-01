<?php

if ( ! function_exists( 'zuhaus_mikado_register_woocommerce_dropdown_cart_widget' ) ) {
	/**
	 * Function that register image gallery widget
	 */
	function zuhaus_mikado_register_woocommerce_dropdown_cart_widget( $widgets ) {
		$widgets[] = 'ZuhausMikadoWoocommerceDropdownCart';
		
		return $widgets;
	}
	
	add_filter( 'zuhaus_mikado_register_widgets', 'zuhaus_mikado_register_woocommerce_dropdown_cart_widget' );
}