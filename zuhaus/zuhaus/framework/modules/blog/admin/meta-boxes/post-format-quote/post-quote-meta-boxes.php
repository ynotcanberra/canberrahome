<?php

if ( ! function_exists( 'zuhaus_mikado_map_post_quote_meta' ) ) {
	function zuhaus_mikado_map_post_quote_meta() {
		$quote_post_format_meta_box = zuhaus_mikado_add_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Quote Post Format', 'zuhaus' ),
				'name'  => 'post_format_quote_meta'
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_post_quote_text_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Text', 'zuhaus' ),
				'description' => esc_html__( 'Enter Quote text', 'zuhaus' ),
				'parent'      => $quote_post_format_meta_box,
			
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_post_quote_author_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Author', 'zuhaus' ),
				'description' => esc_html__( 'Enter Quote author', 'zuhaus' ),
				'parent'      => $quote_post_format_meta_box,
			)
		);
	}
	
	add_action( 'zuhaus_mikado_meta_boxes_map', 'zuhaus_mikado_map_post_quote_meta', 25 );
}