<?php

if ( ! function_exists( 'zuhaus_mikado_register_button_widget' ) ) {
	/**
	 * Function that register button widget
	 */
	function zuhaus_mikado_register_button_widget( $widgets ) {
		$widgets[] = 'ZuhausMikadoButtonWidget';
		
		return $widgets;
	}
	
	add_filter( 'zuhaus_mikado_register_widgets', 'zuhaus_mikado_register_button_widget' );
}