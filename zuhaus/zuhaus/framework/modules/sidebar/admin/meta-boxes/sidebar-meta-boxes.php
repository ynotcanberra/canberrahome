<?php

if ( ! function_exists( 'zuhaus_mikado_map_sidebar_meta' ) ) {
	function zuhaus_mikado_map_sidebar_meta() {
		$mkdf_sidebar_meta_box = zuhaus_mikado_add_meta_box(
			array(
				'scope' => apply_filters( 'zuhaus_mikado_set_scope_for_meta_boxes', array( 'page' ) ),
				'title' => esc_html__( 'Sidebar', 'zuhaus' ),
				'name'  => 'sidebar_meta'
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_sidebar_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Layout', 'zuhaus' ),
				'description' => esc_html__( 'Choose the sidebar layout', 'zuhaus' ),
				'parent'      => $mkdf_sidebar_meta_box,
                'options'       => zuhaus_mikado_get_custom_sidebars_options(true)
			)
		);
		
		$mkdf_custom_sidebars = zuhaus_mikado_get_custom_sidebars();
		if ( count( $mkdf_custom_sidebars ) > 0 ) {
			zuhaus_mikado_add_meta_box_field(
				array(
					'name'        => 'mkdf_custom_sidebar_area_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Widget Area in Sidebar', 'zuhaus' ),
					'description' => esc_html__( 'Choose Custom Widget area to display in Sidebar"', 'zuhaus' ),
					'parent'      => $mkdf_sidebar_meta_box,
					'options'     => $mkdf_custom_sidebars,
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
	}
	
	add_action( 'zuhaus_mikado_meta_boxes_map', 'zuhaus_mikado_map_sidebar_meta', 31 );
}