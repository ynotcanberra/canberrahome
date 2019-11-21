<?php

if ( ! function_exists( 'zuhaus_mikado_get_hide_dep_for_header_standard_options' ) ) {
	function zuhaus_mikado_get_hide_dep_for_header_standard_options() {
		$hide_dep_options = apply_filters( 'zuhaus_mikado_header_standard_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'zuhaus_mikado_header_standard_map' ) ) {
	function zuhaus_mikado_header_standard_map( $parent ) {
		$hide_dep_options = zuhaus_mikado_get_hide_dep_for_header_standard_options();
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'set_menu_area_position',
				'default_value'   => 'right',
				'label'           => esc_html__( 'Choose Menu Area Position', 'zuhaus' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'zuhaus' ),
				'options'         => array(
					'right'  => esc_html__( 'Right', 'zuhaus' ),
					'left'   => esc_html__( 'Left', 'zuhaus' ),
					'center' => esc_html__( 'Center', 'zuhaus' )
				),
				'hidden_property' => 'header_type',
				'hidden_values'   => $hide_dep_options
			)
		);
	}
	
	add_action( 'zuhaus_mikado_additional_header_menu_area_options_map', 'zuhaus_mikado_header_standard_map' );
}