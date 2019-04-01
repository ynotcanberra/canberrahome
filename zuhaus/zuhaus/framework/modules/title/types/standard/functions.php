<?php

if ( ! function_exists( 'zuhaus_mikado_set_title_standard_type_for_options' ) ) {
	/**
	 * This function set standard title type value for title options map and meta boxes
	 */
	function zuhaus_mikado_set_title_standard_type_for_options( $type ) {
		$type['standard'] = esc_html__( 'Standard', 'zuhaus' );
		
		return $type;
	}
	
	add_filter( 'zuhaus_mikado_title_type_global_option', 'zuhaus_mikado_set_title_standard_type_for_options' );
	add_filter( 'zuhaus_mikado_title_type_meta_boxes', 'zuhaus_mikado_set_title_standard_type_for_options' );
}

if ( ! function_exists( 'zuhaus_mikado_set_title_standard_type_as_default_options' ) ) {
	/**
	 * This function set default title type value for global title option map
	 */
	function zuhaus_mikado_set_title_standard_type_as_default_options( $type ) {
		$type = 'standard';
		
		return $type;
	}
	
	add_filter( 'zuhaus_mikado_default_title_type_global_option', 'zuhaus_mikado_set_title_standard_type_as_default_options' );
}