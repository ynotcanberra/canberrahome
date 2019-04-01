<?php

if ( ! function_exists( 'zuhaus_mikado_sidearea_options_map' ) ) {
	function zuhaus_mikado_sidearea_options_map() {
		
		zuhaus_mikado_add_admin_page(
			array(
				'slug'  => '_side_area_page',
				'title' => esc_html__( 'Side Area', 'zuhaus' ),
				'icon'  => 'fa fa-indent'
			)
		);
		
		$side_area_panel = zuhaus_mikado_add_admin_panel(
			array(
				'title' => esc_html__( 'Side Area', 'zuhaus' ),
				'name'  => 'side_area',
				'page'  => '_side_area_page'
			)
		);
		
		$side_area_icon_style_group = zuhaus_mikado_add_admin_group(
			array(
				'parent'      => $side_area_panel,
				'name'        => 'side_area_icon_style_group',
				'title'       => esc_html__( 'Side Area Icon Style', 'zuhaus' ),
				'description' => esc_html__( 'Define styles for Side Area icon', 'zuhaus' )
			)
		);
		
		$side_area_icon_style_row1 = zuhaus_mikado_add_admin_row(
			array(
				'parent' => $side_area_icon_style_group,
				'name'   => 'side_area_icon_style_row1'
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row1,
				'type'   => 'colorsimple',
				'name'   => 'side_area_icon_color',
				'label'  => esc_html__( 'Color', 'zuhaus' )
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row1,
				'type'   => 'colorsimple',
				'name'   => 'side_area_icon_hover_color',
				'label'  => esc_html__( 'Hover Color', 'zuhaus' )
			)
		);
		
		$side_area_icon_style_row2 = zuhaus_mikado_add_admin_row(
			array(
				'parent' => $side_area_icon_style_group,
				'name'   => 'side_area_icon_style_row2',
				'next'   => true
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row2,
				'type'   => 'colorsimple',
				'name'   => 'side_area_close_icon_color',
				'label'  => esc_html__( 'Close Icon Color', 'zuhaus' )
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row2,
				'type'   => 'colorsimple',
				'name'   => 'side_area_close_icon_hover_color',
				'label'  => esc_html__( 'Close Icon Hover Color', 'zuhaus' )
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $side_area_panel,
				'type'          => 'text',
				'name'          => 'side_area_width',
				'default_value' => '',
				'label'         => esc_html__( 'Side Area Width', 'zuhaus' ),
				'description'   => esc_html__( 'Enter a width for Side Area', 'zuhaus' ),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'      => $side_area_panel,
				'type'        => 'color',
				'name'        => 'side_area_background_color',
				'label'       => esc_html__( 'Background Color', 'zuhaus' ),
				'description' => esc_html__( 'Choose a background color for Side Area', 'zuhaus' )
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'      => $side_area_panel,
				'type'        => 'text',
				'name'        => 'side_area_padding',
				'label'       => esc_html__( 'Padding', 'zuhaus' ),
				'description' => esc_html__( 'Define padding for Side Area in format top right bottom left', 'zuhaus' ),
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $side_area_panel,
				'type'          => 'selectblank',
				'name'          => 'side_area_aligment',
				'default_value' => '',
				'label'         => esc_html__( 'Text Alignment', 'zuhaus' ),
				'description'   => esc_html__( 'Choose text alignment for side area', 'zuhaus' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'zuhaus' ),
					'left'   => esc_html__( 'Left', 'zuhaus' ),
					'center' => esc_html__( 'Center', 'zuhaus' ),
					'right'  => esc_html__( 'Right', 'zuhaus' )
				)
			)
		);
	}
	
	add_action( 'zuhaus_mikado_options_map', 'zuhaus_mikado_sidearea_options_map', 6 );
}