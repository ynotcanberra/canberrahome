<?php

if ( ! function_exists( 'zuhaus_mikado_map_content_bottom_meta' ) ) {
	function zuhaus_mikado_map_content_bottom_meta() {
		
		$content_bottom_meta_box = zuhaus_mikado_add_meta_box(
			array(
				'scope' => apply_filters( 'zuhaus_mikado_set_scope_for_meta_boxes', array( 'page', 'post' ) ),
				'title' => esc_html__( 'Content Bottom', 'zuhaus' ),
				'name'  => 'content_bottom_meta'
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_enable_content_bottom_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Enable Content Bottom Area', 'zuhaus' ),
				'description'   => esc_html__( 'This option will enable Content Bottom area on pages', 'zuhaus' ),
				'parent'        => $content_bottom_meta_box,
				'options'       => zuhaus_mikado_get_yes_no_select_array(),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''   => '#mkdf_mkdf_show_content_bottom_meta_container',
						'no' => '#mkdf_mkdf_show_content_bottom_meta_container'
					),
					'show'       => array(
						'yes' => '#mkdf_mkdf_show_content_bottom_meta_container'
					)
				)
			)
		);
		
		$show_content_bottom_meta_container = zuhaus_mikado_add_admin_container(
			array(
				'parent'          => $content_bottom_meta_box,
				'name'            => 'mkdf_show_content_bottom_meta_container',
				'hidden_property' => 'mkdf_enable_content_bottom_area_meta',
				'hidden_values'   => array( '', 'no' )
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_content_bottom_sidebar_custom_display_meta',
				'type'          => 'selectblank',
				'default_value' => '',
				'label'         => esc_html__( 'Sidebar to Display', 'zuhaus' ),
				'description'   => esc_html__( 'Choose a content bottom sidebar to display', 'zuhaus' ),
				'options'       => zuhaus_mikado_get_custom_sidebars(),
				'parent'        => $show_content_bottom_meta_container,
				'args'          => array(
					'select2' => true
				)
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'type'          => 'select',
				'name'          => 'mkdf_content_bottom_in_grid_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Display in Grid', 'zuhaus' ),
				'description'   => esc_html__( 'Enabling this option will place content bottom in grid', 'zuhaus' ),
				'options'       => zuhaus_mikado_get_yes_no_select_array(),
				'parent'        => $show_content_bottom_meta_container
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'type'        => 'color',
				'name'        => 'mkdf_content_bottom_background_color_meta',
				'label'       => esc_html__( 'Background Color', 'zuhaus' ),
				'description' => esc_html__( 'Choose a background color for content bottom area', 'zuhaus' ),
				'parent'      => $show_content_bottom_meta_container
			)
		);
	}
	
	add_action( 'zuhaus_mikado_meta_boxes_map', 'zuhaus_mikado_map_content_bottom_meta', 71 );
}