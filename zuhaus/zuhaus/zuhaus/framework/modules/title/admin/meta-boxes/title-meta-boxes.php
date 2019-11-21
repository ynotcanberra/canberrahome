<?php

if ( ! function_exists( 'zuhaus_mikado_get_title_types_meta_boxes' ) ) {
	function zuhaus_mikado_get_title_types_meta_boxes() {
		$title_type_options = apply_filters( 'zuhaus_mikado_title_type_meta_boxes', $title_type_options = array( '' => esc_html__( 'Default', 'zuhaus' ) ) );
		
		return $title_type_options;
	}
}

foreach ( glob( MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/admin/meta-boxes/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'zuhaus_mikado_map_title_meta' ) ) {
	function zuhaus_mikado_map_title_meta() {
		$title_type_meta_boxes = zuhaus_mikado_get_title_types_meta_boxes();
		
		$title_meta_box = zuhaus_mikado_add_meta_box(
			array(
				'scope' => apply_filters( 'zuhaus_mikado_set_scope_for_meta_boxes', array( 'page', 'post' ) ),
				'title' => esc_html__( 'Title', 'zuhaus' ),
				'name'  => 'title_meta'
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_show_title_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'zuhaus' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'zuhaus' ),
				'parent'        => $title_meta_box,
				'options'       => zuhaus_mikado_get_yes_no_select_array(),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''    => '',
						'no'  => '#mkdf_mkdf_show_title_area_meta_container',
						'yes' => ''
					),
					'show'       => array(
						''    => '#mkdf_mkdf_show_title_area_meta_container',
						'no'  => '',
						'yes' => '#mkdf_mkdf_show_title_area_meta_container'
					)
				)
			)
		);
		
			$show_title_area_meta_container = zuhaus_mikado_add_admin_container(
				array(
					'parent'          => $title_meta_box,
					'name'            => 'mkdf_show_title_area_meta_container',
					'hidden_property' => 'mkdf_show_title_area_meta',
					'hidden_value'    => 'no'
				)
			);
		
				zuhaus_mikado_add_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_type_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area Type', 'zuhaus' ),
						'description'   => esc_html__( 'Choose title type', 'zuhaus' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => $title_type_meta_boxes
					)
				);
		
				zuhaus_mikado_add_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_in_grid_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area In Grid', 'zuhaus' ),
						'description'   => esc_html__( 'Set title area content to be in grid', 'zuhaus' ),
						'options'       => zuhaus_mikado_get_yes_no_select_array(),
						'parent'        => $show_title_area_meta_container
					)
				);
		
				zuhaus_mikado_add_meta_box_field(
					array(
						'name'        => 'mkdf_title_area_height_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Height', 'zuhaus' ),
						'description' => esc_html__( 'Set a height for Title Area', 'zuhaus' ),
						'parent'      => $show_title_area_meta_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px'
						)
					)
				);
				
				zuhaus_mikado_add_meta_box_field(
					array(
						'name'        => 'mkdf_title_area_background_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Background Color', 'zuhaus' ),
						'description' => esc_html__( 'Choose a background color for title area', 'zuhaus' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				zuhaus_mikado_add_meta_box_field(
					array(
						'name'        => 'mkdf_title_area_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'zuhaus' ),
						'description' => esc_html__( 'Choose an Image for title area', 'zuhaus' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				zuhaus_mikado_add_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_background_image_behavior_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Behavior', 'zuhaus' ),
						'description'   => esc_html__( 'Choose title area background image behavior', 'zuhaus' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''                    => esc_html__( 'Default', 'zuhaus' ),
							'hide'                => esc_html__( 'Hide Image', 'zuhaus' ),
							'responsive'          => esc_html__( 'Enable Responsive Image', 'zuhaus' ),
							'responsive-disabled' => esc_html__( 'Disable Responsive Image', 'zuhaus' ),
							'parallax'            => esc_html__( 'Enable Parallax Image', 'zuhaus' ),
							'parallax-zoom-out'   => esc_html__( 'Enable Parallax With Zoom Out Image', 'zuhaus' ),
							'parallax-disabled'   => esc_html__( 'Disable Parallax Image', 'zuhaus' )
						)
					)
				);
				
				zuhaus_mikado_add_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_vertical_alignment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Vertical Alignment', 'zuhaus' ),
						'description'   => esc_html__( 'Specify title area content vertical alignment', 'zuhaus' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''              => esc_html__( 'Default', 'zuhaus' ),
							'header_bottom' => esc_html__( 'From Bottom of Header', 'zuhaus' ),
							'window_top'    => esc_html__( 'From Window Top', 'zuhaus' )
						)
					)
				);
				
				zuhaus_mikado_add_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_title_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Tag', 'zuhaus' ),
						'options'       => zuhaus_mikado_get_title_tag( true ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				zuhaus_mikado_add_meta_box_field(
					array(
						'name'        => 'mkdf_title_text_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Title Color', 'zuhaus' ),
						'description' => esc_html__( 'Choose a color for title text', 'zuhaus' ),
						'parent'      => $show_title_area_meta_container
					)
				);
				
				zuhaus_mikado_add_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_subtitle_meta',
						'type'          => 'text',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Text', 'zuhaus' ),
						'description'   => esc_html__( 'Enter your subtitle text', 'zuhaus' ),
						'parent'        => $show_title_area_meta_container,
						'args'          => array(
							'col_width' => 6
						)
					)
				);
		
				zuhaus_mikado_add_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_subtitle_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Tag', 'zuhaus' ),
						'options'       => zuhaus_mikado_get_title_tag( true, array( 'p' => 'p' ) ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				zuhaus_mikado_add_meta_box_field(
					array(
						'name'        => 'mkdf_subtitle_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Subtitle Color', 'zuhaus' ),
						'description' => esc_html__( 'Choose a color for subtitle text', 'zuhaus' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
		/***************** Additional Title Area Layout - start *****************/
		
		do_action( 'zuhaus_mikado_additional_title_area_meta_boxes', $show_title_area_meta_container );
		
		/***************** Additional Title Area Layout - end *****************/
		
	}
	
	add_action( 'zuhaus_mikado_meta_boxes_map', 'zuhaus_mikado_map_title_meta', 60 );
}