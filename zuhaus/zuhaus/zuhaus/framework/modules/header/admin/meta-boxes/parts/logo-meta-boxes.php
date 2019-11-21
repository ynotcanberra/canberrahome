<?php

if ( ! function_exists( 'zuhaus_mikado_logo_meta_box_map' ) ) {
	function zuhaus_mikado_logo_meta_box_map() {
		
		$logo_meta_box = zuhaus_mikado_add_meta_box(
			array(
				'scope' => apply_filters( 'zuhaus_mikado_set_scope_for_meta_boxes', array( 'page', 'post' ) ),
				'title' => esc_html__( 'Logo', 'zuhaus' ),
				'name'  => 'logo_meta'
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Default', 'zuhaus' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'zuhaus' ),
				'parent'      => $logo_meta_box
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_dark_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Dark', 'zuhaus' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'zuhaus' ),
				'parent'      => $logo_meta_box
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_light_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Light', 'zuhaus' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'zuhaus' ),
				'parent'      => $logo_meta_box
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_sticky_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Sticky', 'zuhaus' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'zuhaus' ),
				'parent'      => $logo_meta_box
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_mobile_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Mobile', 'zuhaus' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'zuhaus' ),
				'parent'      => $logo_meta_box
			)
		);
	}
	
	add_action( 'zuhaus_mikado_meta_boxes_map', 'zuhaus_mikado_logo_meta_box_map', 47 );
}