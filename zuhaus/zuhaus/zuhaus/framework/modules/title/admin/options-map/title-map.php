<?php

if ( ! function_exists( 'zuhaus_mikado_get_title_types_options' ) ) {
	function zuhaus_mikado_get_title_types_options() {
		$title_type_options = apply_filters( 'zuhaus_mikado_title_type_global_option', $title_type_options = array() );
		
		return $title_type_options;
	}
}

if ( ! function_exists( 'zuhaus_mikado_get_title_type_default_options' ) ) {
	function zuhaus_mikado_get_title_type_default_options() {
		$title_type_option = apply_filters( 'zuhaus_mikado_default_title_type_global_option', $title_type_option = '' );
		
		return $title_type_option;
	}
}

foreach ( glob( MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/admin/options-map/*.php' ) as $options_load ) {
	include_once $options_load;
}

if ( ! function_exists('zuhaus_mikado_title_options_map') ) {
	function zuhaus_mikado_title_options_map() {
		$title_type_options        = zuhaus_mikado_get_title_types_options();
		$title_type_default_option = zuhaus_mikado_get_title_type_default_options();

		zuhaus_mikado_add_admin_page(
			array(
				'slug' => '_title_page',
				'title' => esc_html__('Title', 'zuhaus'),
				'icon' => 'fa fa-list-alt'
			)
		);

		$panel_title = zuhaus_mikado_add_admin_panel(
			array(
				'page' => '_title_page',
				'name' => 'panel_title',
				'title' => esc_html__('Title Settings', 'zuhaus')
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'          => 'show_title_area',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Title Area', 'zuhaus' ),
				'description'   => esc_html__( 'This option will enable/disable Title Area', 'zuhaus' ),
				'parent'        => $panel_title,
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_show_title_area_container'
				)
			)
		);
		
			$show_title_area_container = zuhaus_mikado_add_admin_container(
				array(
					'parent'          => $panel_title,
					'name'            => 'show_title_area_container',
					'hidden_property' => 'show_title_area',
					'hidden_value'    => 'no'
				)
			);
		
				zuhaus_mikado_add_admin_field(
					array(
						'name'          => 'title_area_type',
						'type'          => 'select',
						'default_value' => $title_type_default_option,
						'label'         => esc_html__( 'Title Area Type', 'zuhaus' ),
						'description'   => esc_html__( 'Choose title type', 'zuhaus' ),
						'parent'        => $show_title_area_container,
						'options'       => $title_type_options
					)
				);
		
					zuhaus_mikado_add_admin_field(
						array(
							'name'          => 'title_area_in_grid',
							'type'          => 'yesno',
							'default_value' => 'yes',
							'label'         => esc_html__( 'Title Area In Grid', 'zuhaus' ),
							'description'   => esc_html__( 'Set title area content to be in grid', 'zuhaus' ),
							'parent'        => $show_title_area_container
						)
					);
		
					zuhaus_mikado_add_admin_field(
						array(
							'name'        => 'title_area_height',
							'type'        => 'text',
							'label'       => esc_html__( 'Height', 'zuhaus' ),
							'description' => esc_html__( 'Set a height for Title Area', 'zuhaus' ),
							'parent'      => $show_title_area_container,
							'args'        => array(
								'col_width' => 2,
								'suffix'    => 'px'
							)
						)
					);
					
					zuhaus_mikado_add_admin_field(
						array(
							'name'        => 'title_area_background_color',
							'type'        => 'color',
							'label'       => esc_html__( 'Background Color', 'zuhaus' ),
							'description' => esc_html__( 'Choose a background color for Title Area', 'zuhaus' ),
							'parent'      => $show_title_area_container
						)
					);
					
					zuhaus_mikado_add_admin_field(
						array(
							'name'        => 'title_area_background_image',
							'type'        => 'image',
							'label'       => esc_html__( 'Background Image', 'zuhaus' ),
							'description' => esc_html__( 'Choose an Image for Title Area', 'zuhaus' ),
							'parent'      => $show_title_area_container
						)
					);
		
					zuhaus_mikado_add_admin_field(
						array(
							'name'          => 'title_area_background_image_behavior',
							'type'          => 'select',
							'default_value' => '',
							'label'         => esc_html__( 'Background Image Behavior', 'zuhaus' ),
							'description'   => esc_html__( 'Choose title area background image behavior', 'zuhaus' ),
							'parent'        => $show_title_area_container,
							'options'       => array(
								''                  => esc_html__( 'Default', 'zuhaus' ),
								'responsive'        => esc_html__( 'Enable Responsive Image', 'zuhaus' ),
								'parallax'          => esc_html__( 'Enable Parallax Image', 'zuhaus' ),
								'parallax-zoom-out' => esc_html__( 'Enable Parallax With Zoom Out Image', 'zuhaus' )
							)
						)
					);
					
					zuhaus_mikado_add_admin_field(
						array(
							'name'          => 'title_area_vertical_alignment',
							'type'          => 'select',
							'default_value' => 'header_bottom',
							'label'         => esc_html__( 'Vertical Alignment', 'zuhaus' ),
							'description'   => esc_html__( 'Specify title vertical alignment', 'zuhaus' ),
							'parent'        => $show_title_area_container,
							'options'       => array(
								'header_bottom' => esc_html__( 'From Bottom of Header', 'zuhaus' ),
								'window_top'    => esc_html__( 'From Window Top', 'zuhaus' )
							)
						)
					);
		
		/***************** Additional Title Area Layout - start *****************/
		
		do_action( 'zuhaus_mikado_additional_title_area_options_map', $show_title_area_container );
		
		/***************** Additional Title Area Layout - end *****************/
		
		
		$panel_typography = zuhaus_mikado_add_admin_panel(
			array(
				'page'  => '_title_page',
				'name'  => 'panel_title_typography',
				'title' => esc_html__( 'Typography', 'zuhaus' )
			)
		);
		
			zuhaus_mikado_add_admin_section_title(
				array(
					'name'   => 'type_section_title',
					'title'  => esc_html__( 'Title', 'zuhaus' ),
					'parent' => $panel_typography
				)
			);
		
			$group_page_title_styles = zuhaus_mikado_add_admin_group(
				array(
					'name'        => 'group_page_title_styles',
					'title'       => esc_html__( 'Title', 'zuhaus' ),
					'description' => esc_html__( 'Define styles for page title', 'zuhaus' ),
					'parent'      => $panel_typography
				)
			);
		
				$row_page_title_styles_1 = zuhaus_mikado_add_admin_row(
					array(
						'name'   => 'row_page_title_styles_1',
						'parent' => $group_page_title_styles
					)
				);
		
					zuhaus_mikado_add_admin_field(
						array(
							'name'          => 'title_area_title_tag',
							'type'          => 'selectsimple',
							'default_value' => 'h1',
							'label'         => esc_html__( 'Title Tag', 'zuhaus' ),
							'options'       => zuhaus_mikado_get_title_tag(),
							'parent'        => $row_page_title_styles_1
						)
					);
		
				$row_page_title_styles_2 = zuhaus_mikado_add_admin_row(
					array(
						'name'   => 'row_page_title_styles_2',
						'parent' => $group_page_title_styles
					)
				);
		
					zuhaus_mikado_add_admin_field(
						array(
							'type'          => 'colorsimple',
							'name'          => 'page_title_color',
							'default_value' => '',
							'label'         => esc_html__( 'Text Color', 'zuhaus' ),
							'parent'        => $row_page_title_styles_2
						)
					);
					
					zuhaus_mikado_add_admin_field(
						array(
							'type'          => 'textsimple',
							'name'          => 'page_title_font_size',
							'default_value' => '',
							'label'         => esc_html__( 'Font Size', 'zuhaus' ),
							'args'          => array(
								'suffix' => 'px'
							),
							'parent'        => $row_page_title_styles_2
						)
					);
					
					zuhaus_mikado_add_admin_field(
						array(
							'type'          => 'textsimple',
							'name'          => 'page_title_line_height',
							'default_value' => '',
							'label'         => esc_html__( 'Line Height', 'zuhaus' ),
							'args'          => array(
								'suffix' => 'px'
							),
							'parent'        => $row_page_title_styles_2
						)
					);
					
					zuhaus_mikado_add_admin_field(
						array(
							'type'          => 'selectblanksimple',
							'name'          => 'page_title_text_transform',
							'default_value' => '',
							'label'         => esc_html__( 'Text Transform', 'zuhaus' ),
							'options'       => zuhaus_mikado_get_text_transform_array(),
							'parent'        => $row_page_title_styles_2
						)
					);
		
				$row_page_title_styles_3 = zuhaus_mikado_add_admin_row(
					array(
						'name'   => 'row_page_title_styles_3',
						'parent' => $group_page_title_styles,
						'next'   => true
					)
				);
		
					zuhaus_mikado_add_admin_field(
						array(
							'type'          => 'fontsimple',
							'name'          => 'page_title_google_fonts',
							'default_value' => '-1',
							'label'         => esc_html__( 'Font Family', 'zuhaus' ),
							'parent'        => $row_page_title_styles_3
						)
					);
					
					zuhaus_mikado_add_admin_field(
						array(
							'type'          => 'selectblanksimple',
							'name'          => 'page_title_font_style',
							'default_value' => '',
							'label'         => esc_html__( 'Font Style', 'zuhaus' ),
							'options'       => zuhaus_mikado_get_font_style_array(),
							'parent'        => $row_page_title_styles_3
						)
					);
					
					zuhaus_mikado_add_admin_field(
						array(
							'type'          => 'selectblanksimple',
							'name'          => 'page_title_font_weight',
							'default_value' => '',
							'label'         => esc_html__( 'Font Weight', 'zuhaus' ),
							'options'       => zuhaus_mikado_get_font_weight_array(),
							'parent'        => $row_page_title_styles_3
						)
					);
					
					zuhaus_mikado_add_admin_field(
						array(
							'type'          => 'textsimple',
							'name'          => 'page_title_letter_spacing',
							'default_value' => '',
							'label'         => esc_html__( 'Letter Spacing', 'zuhaus' ),
							'args'          => array(
								'suffix' => 'px'
							),
							'parent'        => $row_page_title_styles_3
						)
					);
		
			zuhaus_mikado_add_admin_section_title(
				array(
					'name'   => 'type_section_subtitle',
					'title'  => esc_html__( 'Subtitle', 'zuhaus' ),
					'parent' => $panel_typography
				)
			);
		
			$group_page_subtitle_styles = zuhaus_mikado_add_admin_group(
				array(
					'name'        => 'group_page_subtitle_styles',
					'title'       => esc_html__( 'Subtitle', 'zuhaus' ),
					'description' => esc_html__( 'Define styles for page subtitle', 'zuhaus' ),
					'parent'      => $panel_typography
				)
			);
		
				$row_page_subtitle_styles_1 = zuhaus_mikado_add_admin_row(
					array(
						'name'   => 'row_page_subtitle_styles_1',
						'parent' => $group_page_subtitle_styles
					)
				);
				
					zuhaus_mikado_add_admin_field(
						array(
							'name' => 'title_area_subtitle_tag',
							'type' => 'selectsimple',
							'default_value' => 'h6',
							'label' => esc_html__('Subtitle Tag', 'zuhaus'),
							'options' => zuhaus_mikado_get_title_tag(),
							'parent' => $row_page_subtitle_styles_1
						)
					);
		
				$row_page_subtitle_styles_2 = zuhaus_mikado_add_admin_row(
					array(
						'name'   => 'row_page_subtitle_styles_2',
						'parent' => $group_page_subtitle_styles
					)
				);
		
					zuhaus_mikado_add_admin_field(
						array(
							'type'          => 'colorsimple',
							'name'          => 'page_subtitle_color',
							'default_value' => '',
							'label'         => esc_html__( 'Text Color', 'zuhaus' ),
							'parent'        => $row_page_subtitle_styles_2
						)
					);
					
					zuhaus_mikado_add_admin_field(
						array(
							'type'          => 'textsimple',
							'name'          => 'page_subtitle_font_size',
							'default_value' => '',
							'label'         => esc_html__( 'Font Size', 'zuhaus' ),
							'args'          => array(
								'suffix' => 'px'
							),
							'parent'        => $row_page_subtitle_styles_2
						)
					);
					
					zuhaus_mikado_add_admin_field(
						array(
							'type'          => 'textsimple',
							'name'          => 'page_subtitle_line_height',
							'default_value' => '',
							'label'         => esc_html__( 'Line Height', 'zuhaus' ),
							'args'          => array(
								'suffix' => 'px'
							),
							'parent'        => $row_page_subtitle_styles_2
						)
					);
					
					zuhaus_mikado_add_admin_field(
						array(
							'type'          => 'selectblanksimple',
							'name'          => 'page_subtitle_text_transform',
							'default_value' => '',
							'label'         => esc_html__( 'Text Transform', 'zuhaus' ),
							'options'       => zuhaus_mikado_get_text_transform_array(),
							'parent'        => $row_page_subtitle_styles_2
						)
					);
		
				$row_page_subtitle_styles_3 = zuhaus_mikado_add_admin_row(
					array(
						'name'   => 'row_page_subtitle_styles_3',
						'parent' => $group_page_subtitle_styles,
						'next'   => true
					)
				);
		
					zuhaus_mikado_add_admin_field(
						array(
							'type'          => 'fontsimple',
							'name'          => 'page_subtitle_google_fonts',
							'default_value' => '-1',
							'label'         => esc_html__( 'Font Family', 'zuhaus' ),
							'parent'        => $row_page_subtitle_styles_3
						)
					);
					
					zuhaus_mikado_add_admin_field(
						array(
							'type'          => 'selectblanksimple',
							'name'          => 'page_subtitle_font_style',
							'default_value' => '',
							'label'         => esc_html__( 'Font Style', 'zuhaus' ),
							'options'       => zuhaus_mikado_get_font_style_array(),
							'parent'        => $row_page_subtitle_styles_3
						)
					);
					
					zuhaus_mikado_add_admin_field(
						array(
							'type'          => 'selectblanksimple',
							'name'          => 'page_subtitle_font_weight',
							'default_value' => '',
							'label'         => esc_html__( 'Font Weight', 'zuhaus' ),
							'options'       => zuhaus_mikado_get_font_weight_array(),
							'parent'        => $row_page_subtitle_styles_3
						)
					);
					
					zuhaus_mikado_add_admin_field(
						array(
							'type'          => 'textsimple',
							'name'          => 'page_subtitle_letter_spacing',
							'default_value' => '',
							'label'         => esc_html__( 'Letter Spacing', 'zuhaus' ),
							'args'          => array(
								'suffix' => 'px'
							),
							'parent'        => $row_page_subtitle_styles_3
						)
					);
		
		/***************** Additional Title Typography Layout - start *****************/
		
		do_action( 'zuhaus_mikado_additional_title_typography_options_map', $panel_typography );
		
		/***************** Additional Title Typography Layout - end *****************/
    }

	add_action( 'zuhaus_mikado_options_map', 'zuhaus_mikado_title_options_map', 8);
}