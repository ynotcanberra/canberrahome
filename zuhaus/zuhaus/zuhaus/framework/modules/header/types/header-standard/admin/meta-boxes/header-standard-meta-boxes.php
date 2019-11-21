<?php

if ( ! function_exists( 'zuhaus_mikado_get_hide_dep_for_header_standard_meta_boxes' ) ) {
	function zuhaus_mikado_get_hide_dep_for_header_standard_meta_boxes() {
		$hide_dep_options = apply_filters( 'zuhaus_mikado_header_standard_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'zuhaus_mikado_header_standard_meta_map' ) ) {
	function zuhaus_mikado_header_standard_meta_map( $parent ) {
		$hide_dep_options = zuhaus_mikado_get_hide_dep_for_header_standard_meta_boxes();
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'mkdf_set_menu_area_position_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Choose Menu Area Position', 'zuhaus' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'zuhaus' ),
				'options'         => array(
					''       => esc_html__( 'Default', 'zuhaus' ),
					'left'   => esc_html__( 'Left', 'zuhaus' ),
					'right'  => esc_html__( 'Right', 'zuhaus' ),
					'center' => esc_html__( 'Center', 'zuhaus' )
				),
				'hidden_property' => 'mkdf_header_type_meta',
				'hidden_values'   => $hide_dep_options
			)
		);
	}
	
	add_action( 'zuhaus_mikado_additional_header_area_meta_boxes_map', 'zuhaus_mikado_header_standard_meta_map' );
}