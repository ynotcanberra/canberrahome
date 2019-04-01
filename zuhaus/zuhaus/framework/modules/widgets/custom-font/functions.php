<?php

if ( ! function_exists( 'zuhaus_mikado_register_custom_font_widget' ) ) {
	/**
	 * Function that register custom font widget
	 */
	function zuhaus_mikado_register_custom_font_widget( $widgets ) {
		$widgets[] = 'ZuhausMikadoCustomFontWidget';
		
		return $widgets;
	}
	
	add_filter( 'zuhaus_mikado_register_widgets', 'zuhaus_mikado_register_custom_font_widget' );
}