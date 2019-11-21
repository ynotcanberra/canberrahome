<?php

if ( ! function_exists( 'zuhaus_mikado_map_footer_meta' ) ) {
	function zuhaus_mikado_map_footer_meta() {
		
		$footer_meta_box = zuhaus_mikado_add_meta_box(
			array(
				'scope' => apply_filters( 'zuhaus_mikado_set_scope_for_meta_boxes', array( 'page', 'post' ) ),
				'title' => esc_html__( 'Footer', 'zuhaus' ),
				'name'  => 'footer_meta'
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_disable_footer_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Disable Footer for this Page', 'zuhaus' ),
				'description'   => esc_html__( 'Enabling this option will hide footer on this page', 'zuhaus' ),
				'parent'        => $footer_meta_box
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_show_footer_top_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Footer Top', 'zuhaus' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'zuhaus' ),
				'parent'        => $footer_meta_box,
				'options'       => zuhaus_mikado_get_yes_no_select_array()
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_show_footer_bottom_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Footer Bottom', 'zuhaus' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'zuhaus' ),
				'parent'        => $footer_meta_box,
				'options'       => zuhaus_mikado_get_yes_no_select_array()
			)
		);
	}
	
	add_action( 'zuhaus_mikado_meta_boxes_map', 'zuhaus_mikado_map_footer_meta', 70 );
}