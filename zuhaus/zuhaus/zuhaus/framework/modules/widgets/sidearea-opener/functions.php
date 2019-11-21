<?php

if ( ! function_exists( 'zuhaus_mikado_register_sidearea_opener_widget' ) ) {
	/**
	 * Function that register sidearea opener widget
	 */
	function zuhaus_mikado_register_sidearea_opener_widget( $widgets ) {
		$widgets[] = 'ZuhausMikadoSideAreaOpener';
		
		return $widgets;
	}
	
	add_filter( 'zuhaus_mikado_register_widgets', 'zuhaus_mikado_register_sidearea_opener_widget' );
}