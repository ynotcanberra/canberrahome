<?php

if ( ! function_exists( 'zuhaus_mikado_register_search_opener_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function zuhaus_mikado_register_search_opener_widget( $widgets ) {
		$widgets[] = 'ZuhausMikadoSearchOpener';
		
		return $widgets;
	}
	
	add_filter( 'zuhaus_mikado_register_widgets', 'zuhaus_mikado_register_search_opener_widget' );
}