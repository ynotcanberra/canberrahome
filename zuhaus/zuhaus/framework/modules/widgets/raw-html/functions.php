<?php

if ( ! function_exists( 'zuhaus_mikado_register_raw_html_widget' ) ) {
	/**
	 * Function that register raw html widget
	 */
	function zuhaus_mikado_register_raw_html_widget( $widgets ) {
		$widgets[] = 'ZuhausMikadoRawHTMLWidget';
		
		return $widgets;
	}
	
	add_filter( 'zuhaus_mikado_register_widgets', 'zuhaus_mikado_register_raw_html_widget' );
}