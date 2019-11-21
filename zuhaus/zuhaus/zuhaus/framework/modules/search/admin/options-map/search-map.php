<?php

if ( ! function_exists( 'zuhaus_mikado_search_options_map' ) ) {
	function zuhaus_mikado_search_options_map() {
		
		zuhaus_mikado_add_admin_page(
			array(
				'slug'  => '_search_page',
				'title' => esc_html__( 'Search', 'zuhaus' ),
				'icon'  => 'fa fa-search'
			)
		);
		
		$search_page_panel = zuhaus_mikado_add_admin_panel(
			array(
				'title' => esc_html__( 'Search Page', 'zuhaus' ),
				'name'  => 'search_template',
				'page'  => '_search_page'
			)
		);
		
		zuhaus_mikado_add_admin_field( array(
			'name'          => 'search_page_layout',
			'type'          => 'select',
			'label'         => esc_html__( 'Layout', 'zuhaus' ),
			'default_value' => 'full-width',
			'description'   => esc_html__( 'Set layout. Default is full width.', 'zuhaus' ),
			'parent'        => $search_page_panel,
			'options'       => array(
				'in-grid'    => esc_html__( 'In Grid', 'zuhaus' ),
				'full-width' => esc_html__( 'Full Width', 'zuhaus' )
			)
		) );
		
		zuhaus_mikado_add_admin_field( array(
			'name'          => 'search_page_sidebar_layout',
			'type'          => 'select',
			'label'         => esc_html__( 'Sidebar Layout', 'zuhaus' ),
			'description'   => esc_html__( "Choose a sidebar layout for search page", 'zuhaus' ),
			'default_value' => 'no-sidebar',
			'options'       => zuhaus_mikado_get_custom_sidebars_options(),
			'parent'        => $search_page_panel
		) );
		
		$zuhaus_custom_sidebars = zuhaus_mikado_get_custom_sidebars();
		if ( count( $zuhaus_custom_sidebars ) > 0 ) {
			zuhaus_mikado_add_admin_field( array(
				'name'        => 'search_custom_sidebar_area',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'zuhaus' ),
				'description' => esc_html__( 'Choose a sidebar to display on search page. Default sidebar is "Sidebar"', 'zuhaus' ),
				'parent'      => $search_page_panel,
				'options'     => $zuhaus_custom_sidebars,
				'args'        => array(
					'select2' => true
				)
			) );
		}
		
		$search_panel = zuhaus_mikado_add_admin_panel(
			array(
				'title' => esc_html__( 'Search', 'zuhaus' ),
				'name'  => 'search',
				'page'  => '_search_page'
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'select',
				'name'          => 'search_icon_pack',
				'default_value' => 'linear_icons',
				'label'         => esc_html__( 'Search Icon Pack', 'zuhaus' ),
				'description'   => esc_html__( 'Choose icon pack for search icon', 'zuhaus' ),
				'options'       => zuhaus_mikado_icon_collections()->getIconCollectionsExclude( array( 'linea_icons' ) )
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'yesno',
				'name'          => 'search_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Enable Grid Layout', 'zuhaus' ),
				'description'   => esc_html__( 'Set search area to be in grid. (Applied for Search covers header and Slide from Window Top types.', 'zuhaus' ),
			)
		);
		
		zuhaus_mikado_add_admin_section_title(
			array(
				'parent' => $search_panel,
				'name'   => 'initial_header_icon_title',
				'title'  => esc_html__( 'Initial Search Icon in Header', 'zuhaus' )
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'text',
				'name'          => 'header_search_icon_size',
				'default_value' => '',
				'label'         => esc_html__( 'Icon Size', 'zuhaus' ),
				'description'   => esc_html__( 'Set size for icon', 'zuhaus' ),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		$search_icon_color_group = zuhaus_mikado_add_admin_group(
			array(
				'parent'      => $search_panel,
				'title'       => esc_html__( 'Icon Colors', 'zuhaus' ),
				'description' => esc_html__( 'Define color style for icon', 'zuhaus' ),
				'name'        => 'search_icon_color_group'
			)
		);
		
		$search_icon_color_row = zuhaus_mikado_add_admin_row(
			array(
				'parent' => $search_icon_color_group,
				'name'   => 'search_icon_color_row'
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_search_icon_color',
				'label'  => esc_html__( 'Color', 'zuhaus' )
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_search_icon_hover_color',
				'label'  => esc_html__( 'Hover Color', 'zuhaus' )
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'yesno',
				'name'          => 'enable_search_icon_text',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Search Icon Text', 'zuhaus' ),
				'description'   => esc_html__( "Enable this option to show 'Search' text next to search icon in header", 'zuhaus' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_enable_search_icon_text_container'
				)
			)
		);
		
		$enable_search_icon_text_container = zuhaus_mikado_add_admin_container(
			array(
				'parent'          => $search_panel,
				'name'            => 'enable_search_icon_text_container',
				'hidden_property' => 'enable_search_icon_text',
				'hidden_value'    => 'no'
			)
		);
		
		$enable_search_icon_text_group = zuhaus_mikado_add_admin_group(
			array(
				'parent'      => $enable_search_icon_text_container,
				'title'       => esc_html__( 'Search Icon Text', 'zuhaus' ),
				'name'        => 'enable_search_icon_text_group',
				'description' => esc_html__( 'Define style for search icon text', 'zuhaus' )
			)
		);
		
		$enable_search_icon_text_row = zuhaus_mikado_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row'
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent' => $enable_search_icon_text_row,
				'type'   => 'colorsimple',
				'name'   => 'search_icon_text_color',
				'label'  => esc_html__( 'Text Color', 'zuhaus' )
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent' => $enable_search_icon_text_row,
				'type'   => 'colorsimple',
				'name'   => 'search_icon_text_color_hover',
				'label'  => esc_html__( 'Text Hover Color', 'zuhaus' )
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_font_size',
				'label'         => esc_html__( 'Font Size', 'zuhaus' ),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_line_height',
				'label'         => esc_html__( 'Line Height', 'zuhaus' ),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$enable_search_icon_text_row2 = zuhaus_mikado_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row2',
				'next'   => true
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_text_transform',
				'label'         => esc_html__( 'Text Transform', 'zuhaus' ),
				'default_value' => '',
				'options'       => zuhaus_mikado_get_text_transform_array()
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'fontsimple',
				'name'          => 'search_icon_text_google_fonts',
				'label'         => esc_html__( 'Font Family', 'zuhaus' ),
				'default_value' => '-1',
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_font_style',
				'label'         => esc_html__( 'Font Style', 'zuhaus' ),
				'default_value' => '',
				'options'       => zuhaus_mikado_get_font_style_array(),
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_font_weight',
				'label'         => esc_html__( 'Font Weight', 'zuhaus' ),
				'default_value' => '',
				'options'       => zuhaus_mikado_get_font_weight_array(),
			)
		);
		
		$enable_search_icon_text_row3 = zuhaus_mikado_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row3',
				'next'   => true
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row3,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_letter_spacing',
				'label'         => esc_html__( 'Letter Spacing', 'zuhaus' ),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
	}
	
	add_action( 'zuhaus_mikado_options_map', 'zuhaus_mikado_search_options_map', 7 );
}