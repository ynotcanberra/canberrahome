<?php

if ( ! function_exists( 'zuhaus_mikado_set_title_centered_type_for_options' ) ) {
	/**
	 * This function set centered title type value for title options map and meta boxes
	 */
	function zuhaus_mikado_set_title_centered_type_for_options( $type ) {
		$type['centered'] = esc_html__( 'Centered', 'zuhaus' );
		
		return $type;
	}
	
	add_filter( 'zuhaus_mikado_title_type_global_option', 'zuhaus_mikado_set_title_centered_type_for_options' );
	add_filter( 'zuhaus_mikado_title_type_meta_boxes', 'zuhaus_mikado_set_title_centered_type_for_options' );
}