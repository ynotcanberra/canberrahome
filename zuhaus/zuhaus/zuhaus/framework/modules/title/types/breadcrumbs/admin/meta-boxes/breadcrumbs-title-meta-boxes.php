<?php

if ( ! function_exists( 'zuhaus_mikado_breadcrumbs_title_type_options_meta_boxes' ) ) {
	function zuhaus_mikado_breadcrumbs_title_type_options_meta_boxes( $show_title_area_meta_container ) {
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_breadcrumbs_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Breadcrumbs Color', 'zuhaus' ),
				'description' => esc_html__( 'Choose a color for breadcrumbs text', 'zuhaus' ),
				'parent'      => $show_title_area_meta_container
			)
		);
	}
	
	add_action( 'zuhaus_mikado_additional_title_area_meta_boxes', 'zuhaus_mikado_breadcrumbs_title_type_options_meta_boxes' );
}