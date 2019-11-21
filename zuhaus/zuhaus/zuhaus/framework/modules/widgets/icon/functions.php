<?php

if ( ! function_exists( 'zuhaus_mikado_register_icon_widget' ) ) {
	/**
	 * Function that register icon widget
	 */
	function zuhaus_mikado_register_icon_widget( $widgets ) {
		$widgets[] = 'ZuhausMikadoIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'zuhaus_mikado_register_widgets', 'zuhaus_mikado_register_icon_widget' );
}