<?php

if ( ! function_exists( 'zuhaus_mikado_sticky_header_meta_boxes_options_map' ) ) {
	function zuhaus_mikado_sticky_header_meta_boxes_options_map( $header_meta_box ) {
		
		$sticky_amount_container = zuhaus_mikado_add_admin_container(
			array(
				'parent'          => $header_meta_box,
				'name'            => 'sticky_amount_container_meta_container',
				'hidden_property' => 'mkdf_header_behaviour_meta',
				'hidden_values'   => array(
					'',
					'no-behavior',
					'fixed-on-scroll',
					'sticky-header-on-scroll-up'
				)
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_scroll_amount_for_sticky_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Scroll amount for sticky header appearance', 'zuhaus' ),
				'description' => esc_html__( 'Define scroll amount for sticky header appearance', 'zuhaus' ),
				'parent'      => $sticky_amount_container,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px'
				)
			)
		);
	}
	
	add_action( 'zuhaus_mikado_additional_header_area_meta_boxes_map', 'zuhaus_mikado_sticky_header_meta_boxes_options_map', 10, 1 );
}