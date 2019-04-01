<?php

if ( ! function_exists( 'zuhaus_mikado_map_post_gallery_meta' ) ) {
	
	function zuhaus_mikado_map_post_gallery_meta() {
		$gallery_post_format_meta_box = zuhaus_mikado_add_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Gallery Post Format', 'zuhaus' ),
				'name'  => 'post_format_gallery_meta'
			)
		);
		
		zuhaus_mikado_add_multiple_images_field(
			array(
				'name'        => 'mkdf_post_gallery_images_meta',
				'label'       => esc_html__( 'Gallery Images', 'zuhaus' ),
				'description' => esc_html__( 'Choose your gallery images', 'zuhaus' ),
				'parent'      => $gallery_post_format_meta_box,
			)
		);
	}
	
	add_action( 'zuhaus_mikado_meta_boxes_map', 'zuhaus_mikado_map_post_gallery_meta', 21 );
}
