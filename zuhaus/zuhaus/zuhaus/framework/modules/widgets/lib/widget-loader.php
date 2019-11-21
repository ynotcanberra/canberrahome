<?php

if ( ! function_exists( 'zuhaus_mikado_register_widgets' ) ) {
	function zuhaus_mikado_register_widgets() {
		$widgets = apply_filters( 'zuhaus_mikado_register_widgets', $widgets = array() );
		
		foreach ( $widgets as $widget ) {
			register_widget( $widget );
		}
	}
	
	add_action( 'widgets_init', 'zuhaus_mikado_register_widgets' );
}