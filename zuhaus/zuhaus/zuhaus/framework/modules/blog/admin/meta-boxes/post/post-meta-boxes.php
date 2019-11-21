<?php

/*** Post Settings ***/

if ( ! function_exists( 'zuhaus_mikado_map_post_meta' ) ) {
	function zuhaus_mikado_map_post_meta() {
		
		$post_meta_box = zuhaus_mikado_add_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Post', 'zuhaus' ),
				'name'  => 'post-meta'
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_blog_single_sidebar_layout_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'zuhaus' ),
				'description'   => esc_html__( 'Choose a sidebar layout for Blog single page', 'zuhaus' ),
				'default_value' => '',
				'parent'        => $post_meta_box,
                'options'       => zuhaus_mikado_get_custom_sidebars_options(true)
			)
		);
		
		$zuhaus_custom_sidebars = zuhaus_mikado_get_custom_sidebars();
		if ( count( $zuhaus_custom_sidebars ) > 0 ) {
			zuhaus_mikado_add_meta_box_field( array(
				'name'        => 'mkdf_blog_single_custom_sidebar_area_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'zuhaus' ),
				'description' => esc_html__( 'Choose a sidebar to display on Blog single page. Default sidebar is "Sidebar"', 'zuhaus' ),
				'parent'      => $post_meta_box,
				'options'     => zuhaus_mikado_get_custom_sidebars(),
				'args' => array(
					'select2' => true
				)
			) );
		}
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_blog_list_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Blog List Image', 'zuhaus' ),
				'description' => esc_html__( 'Choose an Image for displaying in blog list. If not uploaded, featured image will be shown.', 'zuhaus' ),
				'parent'      => $post_meta_box
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_blog_masonry_gallery_fixed_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Fixed Proportion', 'zuhaus' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry lists in fixed proportion', 'zuhaus' ),
				'default_value' => 'default',
				'parent'        => $post_meta_box,
				'options'       => array(
					'default'            => esc_html__( 'Default', 'zuhaus' ),
					'large-width'        => esc_html__( 'Large Width', 'zuhaus' ),
					'large-height'       => esc_html__( 'Large Height', 'zuhaus' ),
					'large-width-height' => esc_html__( 'Large Width/Height', 'zuhaus' )
				)
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_blog_masonry_gallery_original_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Original Proportion', 'zuhaus' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry lists in original proportion', 'zuhaus' ),
				'default_value' => 'default',
				'parent'        => $post_meta_box,
				'options'       => array(
					'default'     => esc_html__( 'Default', 'zuhaus' ),
					'large-width' => esc_html__( 'Large Width', 'zuhaus' )
				)
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_show_title_area_blog_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'zuhaus' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single post page', 'zuhaus' ),
				'parent'        => $post_meta_box,
				'options'       => zuhaus_mikado_get_yes_no_select_array()
			)
		);

		do_action('zuhaus_mikado_blog_post_meta', $post_meta_box);
	}
	
	add_action( 'zuhaus_mikado_meta_boxes_map', 'zuhaus_mikado_map_post_meta', 20 );
}
