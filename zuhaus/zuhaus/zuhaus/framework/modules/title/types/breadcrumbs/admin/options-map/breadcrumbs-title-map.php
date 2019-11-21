<?php

if ( ! function_exists('zuhaus_mikado_breadcrumbs_title_type_options_map') ) {
	function zuhaus_mikado_breadcrumbs_title_type_options_map($panel_typography) {
		
		zuhaus_mikado_add_admin_section_title(
			array(
				'name'   => 'type_section_breadcrumbs',
				'title'  => esc_html__( 'Breadcrumbs', 'zuhaus' ),
				'parent' => $panel_typography
			)
		);
	
		$group_page_breadcrumbs_styles = zuhaus_mikado_add_admin_group(
			array(
				'name'        => 'group_page_breadcrumbs_styles',
				'title'       => esc_html__( 'Breadcrumbs', 'zuhaus' ),
				'description' => esc_html__( 'Define styles for page breadcrumbs', 'zuhaus' ),
				'parent'      => $panel_typography
			)
		);
	
			$row_page_breadcrumbs_styles_1 = zuhaus_mikado_add_admin_row(
				array(
					'name'   => 'row_page_breadcrumbs_styles_1',
					'parent' => $group_page_breadcrumbs_styles
				)
			);
	
				zuhaus_mikado_add_admin_field(
					array(
						'type'          => 'colorsimple',
						'name'          => 'page_breadcrumb_color',
						'default_value' => '',
						'label'         => esc_html__( 'Text Color', 'zuhaus' ),
						'parent'        => $row_page_breadcrumbs_styles_1
					)
				);
				
				zuhaus_mikado_add_admin_field(
					array(
						'type'          => 'textsimple',
						'name'          => 'page_breadcrumb_font_size',
						'default_value' => '',
						'label'         => esc_html__( 'Font Size', 'zuhaus' ),
						'args'          => array(
							'suffix' => 'px'
						),
						'parent'        => $row_page_breadcrumbs_styles_1
					)
				);
				
				zuhaus_mikado_add_admin_field(
					array(
						'type'          => 'textsimple',
						'name'          => 'page_breadcrumb_line_height',
						'default_value' => '',
						'label'         => esc_html__( 'Line Height', 'zuhaus' ),
						'args'          => array(
							'suffix' => 'px'
						),
						'parent'        => $row_page_breadcrumbs_styles_1
					)
				);
				
				zuhaus_mikado_add_admin_field(
					array(
						'type'          => 'selectblanksimple',
						'name'          => 'page_breadcrumb_text_transform',
						'default_value' => '',
						'label'         => esc_html__( 'Text Transform', 'zuhaus' ),
						'options'       => zuhaus_mikado_get_text_transform_array(),
						'parent'        => $row_page_breadcrumbs_styles_1
					)
				);
	
			$row_page_breadcrumbs_styles_2 = zuhaus_mikado_add_admin_row(
				array(
					'name'   => 'row_page_breadcrumbs_styles_2',
					'parent' => $group_page_breadcrumbs_styles,
					'next'   => true
				)
			);
	
				zuhaus_mikado_add_admin_field(
					array(
						'type'          => 'fontsimple',
						'name'          => 'page_breadcrumb_google_fonts',
						'default_value' => '-1',
						'label'         => esc_html__( 'Font Family', 'zuhaus' ),
						'parent'        => $row_page_breadcrumbs_styles_2
					)
				);
				
				zuhaus_mikado_add_admin_field(
					array(
						'type'          => 'selectblanksimple',
						'name'          => 'page_breadcrumb_font_style',
						'default_value' => '',
						'label'         => esc_html__( 'Font Style', 'zuhaus' ),
						'options'       => zuhaus_mikado_get_font_style_array(),
						'parent'        => $row_page_breadcrumbs_styles_2
					)
				);
				
				zuhaus_mikado_add_admin_field(
					array(
						'type'          => 'selectblanksimple',
						'name'          => 'page_breadcrumb_font_weight',
						'default_value' => '',
						'label'         => esc_html__( 'Font Weight', 'zuhaus' ),
						'options'       => zuhaus_mikado_get_font_weight_array(),
						'parent'        => $row_page_breadcrumbs_styles_2
					)
				);
				
				zuhaus_mikado_add_admin_field(
					array(
						'type'          => 'textsimple',
						'name'          => 'page_breadcrumb_letter_spacing',
						'default_value' => '',
						'label'         => esc_html__( 'Letter Spacing', 'zuhaus' ),
						'args'          => array(
							'suffix' => 'px'
						),
						'parent'        => $row_page_breadcrumbs_styles_2
					)
				);
	
			$row_page_breadcrumbs_styles_3 = zuhaus_mikado_add_admin_row(
				array(
					'name'   => 'row_page_breadcrumbs_styles_3',
					'parent' => $group_page_breadcrumbs_styles,
					'next'   => true
				)
			);
	
				zuhaus_mikado_add_admin_field(
					array(
						'type'          => 'colorsimple',
						'name'          => 'page_breadcrumb_hovercolor',
						'default_value' => '',
						'label'         => esc_html__( 'Hover/Active Text Color', 'zuhaus' ),
						'parent'        => $row_page_breadcrumbs_styles_3
					)
				);
    }

	add_action( 'zuhaus_mikado_additional_title_typography_options_map', 'zuhaus_mikado_breadcrumbs_title_type_options_map');
}