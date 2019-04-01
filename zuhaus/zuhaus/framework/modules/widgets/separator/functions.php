<?php

if ( ! function_exists( 'zuhaus_mikado_register_separator_widget' ) ) {
	/**
	 * Function that register separator widget
	 */
	function zuhaus_mikado_register_separator_widget( $widgets ) {
		$widgets[] = 'ZuhausMikadoSeparatorWidget';
		
		return $widgets;
	}
	
	add_filter( 'zuhaus_mikado_register_widgets', 'zuhaus_mikado_register_separator_widget' );
}