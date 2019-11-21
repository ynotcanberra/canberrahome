<?php

if ( ! function_exists( 'zuhaus_mikado_get_hide_dep_for_fixed_header_options' ) ) {
	function zuhaus_mikado_get_hide_dep_for_fixed_header_options() {
		$hide_dep_options = apply_filters( 'zuhaus_mikado_fixed_header_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'zuhaus_mikado_get_additional_hide_dep_for_fixed_header_options' ) ) {
	function zuhaus_mikado_get_additional_hide_dep_for_fixed_header_options() {
		$additional_hide_dep_options = apply_filters( 'zuhaus_mikado_fixed_header_additional_hide_global_option', $additional_hide_dep_options = array() );
		
		return $additional_hide_dep_options;
	}
}

if ( ! function_exists( 'zuhaus_mikado_header_fixed_options_map' ) ) {
	function zuhaus_mikado_header_fixed_options_map() {
		$hide_dep_options            = zuhaus_mikado_get_hide_dep_for_fixed_header_options();
		$additional_hide_dep_options = zuhaus_mikado_get_additional_hide_dep_for_fixed_header_options();
		
		$panel_fixed_header = zuhaus_mikado_add_admin_panel(
			array(
				'title'           => esc_html__( 'Fixed Header', 'zuhaus' ),
				'name'            => 'panel_fixed_header',
				'page'            => '_header_page',
				'hidden_property' => 'header_type',
				'hidden_values'   => $hide_dep_options,
				'args'            => array(
					'use_both_dep'               => true,
					'additional_hidden_property' => 'header_behaviour',
					'additional_hidden_values'   => $additional_hide_dep_options
				)
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'          => 'fixed_header_background_color',
				'type'          => 'color',
				'default_value' => '',
				'label'         => esc_html__( 'Background Color', 'zuhaus' ),
				'description'   => esc_html__( 'Choose a background color for header area', 'zuhaus' ),
				'parent'        => $panel_fixed_header
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'        => 'fixed_header_transparency',
				'type'        => 'text',
				'label'       => esc_html__( 'Background Transparency', 'zuhaus' ),
				'description' => esc_html__( 'Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)', 'zuhaus' ),
				'parent'      => $panel_fixed_header,
				'args'        => array(
					'col_width' => 1
				)
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $panel_fixed_header,
				'type'          => 'color',
				'name'          => 'fixed_header_border_bottom_color',
				'default_value' => '',
				'label'         => esc_html__( 'Border Color', 'zuhaus' ),
				'description'   => esc_html__( 'Set border bottom color for header area', 'zuhaus' ),
			)
		);
		
		$group_fixed_header_menu = zuhaus_mikado_add_admin_group(
			array(
				'title'       => esc_html__( 'Fixed Header Menu', 'zuhaus' ),
				'name'        => 'group_fixed_header_menu',
				'parent'      => $panel_fixed_header,
				'description' => esc_html__( 'Define styles for fixed menu items', 'zuhaus' )
			)
		);
		
		$row1_fixed_header_menu = zuhaus_mikado_add_admin_row(
			array(
				'name'   => 'row1',
				'parent' => $group_fixed_header_menu
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'        => 'fixed_color',
				'type'        => 'colorsimple',
				'label'       => esc_html__( 'Text Color', 'zuhaus' ),
				'description' => '',
				'parent'      => $row1_fixed_header_menu
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'        => 'fixed_hovercolor',
				'type'        => 'colorsimple',
				'label'       => esc_html__( esc_html__( 'Hover/Active Color', 'zuhaus' ), 'zuhaus' ),
				'description' => '',
				'parent'      => $row1_fixed_header_menu
			)
		);
		
		$row2_fixed_header_menu = zuhaus_mikado_add_admin_row(
			array(
				'name'   => 'row2',
				'parent' => $group_fixed_header_menu
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'          => 'fixed_google_fonts',
				'type'          => 'fontsimple',
				'label'         => esc_html__( 'Font Family', 'zuhaus' ),
				'default_value' => '-1',
				'parent'        => $row2_fixed_header_menu,
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'fixed_font_size',
				'label'         => esc_html__( 'Font Size', 'zuhaus' ),
				'default_value' => '',
				'parent'        => $row2_fixed_header_menu,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'fixed_line_height',
				'label'         => esc_html__( 'Line Height', 'zuhaus' ),
				'default_value' => '',
				'parent'        => $row2_fixed_header_menu,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'fixed_text_transform',
				'label'         => esc_html__( 'Text Transform', 'zuhaus' ),
				'default_value' => '',
				'options'       => zuhaus_mikado_get_text_transform_array(),
				'parent'        => $row2_fixed_header_menu
			)
		);
		
		$row3_fixed_header_menu = zuhaus_mikado_add_admin_row(
			array(
				'name'   => 'row3',
				'parent' => $group_fixed_header_menu
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'fixed_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'zuhaus' ),
				'options'       => zuhaus_mikado_get_font_style_array(),
				'parent'        => $row3_fixed_header_menu
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'fixed_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'zuhaus' ),
				'options'       => zuhaus_mikado_get_font_weight_array(),
				'parent'        => $row3_fixed_header_menu
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'fixed_letter_spacing',
				'label'         => esc_html__( 'Letter Spacing', 'zuhaus' ),
				'default_value' => '',
				'parent'        => $row3_fixed_header_menu,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
	}
	
	add_action( 'zuhaus_mikado_header_fixed_options_map', 'zuhaus_mikado_header_fixed_options_map', 10, 1 );
}