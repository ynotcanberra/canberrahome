<?php

if ( ! function_exists( 'zuhaus_mikado_map_post_link_meta' ) ) {
	function zuhaus_mikado_map_post_link_meta() {
		$link_post_format_meta_box = zuhaus_mikado_add_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Link Post Format', 'zuhaus' ),
				'name'  => 'post_format_link_meta'
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_post_link_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Link', 'zuhaus' ),
				'description' => esc_html__( 'Enter link', 'zuhaus' ),
				'parent'      => $link_post_format_meta_box,
			
			)
		);
	}
	
	add_action( 'zuhaus_mikado_meta_boxes_map', 'zuhaus_mikado_map_post_link_meta', 24 );
}