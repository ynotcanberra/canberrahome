<?php

if ( ! function_exists( 'zuhaus_mikado_sidebar_options_map' ) ) {
	function zuhaus_mikado_sidebar_options_map() {
		
		$sidebar_panel = zuhaus_mikado_add_admin_panel(
			array(
				'title' => esc_html__( 'Sidebar Area', 'zuhaus' ),
				'name'  => 'sidebar',
				'page'  => '_page_page'
			)
		);
		
		zuhaus_mikado_add_admin_field( array(
			'name'          => 'sidebar_layout',
			'type'          => 'select',
			'label'         => esc_html__( 'Sidebar Layout', 'zuhaus' ),
			'description'   => esc_html__( 'Choose a sidebar layout for pages', 'zuhaus' ),
			'parent'        => $sidebar_panel,
			'default_value' => 'no-sidebar',
            'options'       => zuhaus_mikado_get_custom_sidebars_options()
		) );
		
		$zuhaus_custom_sidebars = zuhaus_mikado_get_custom_sidebars();
		if ( count( $zuhaus_custom_sidebars ) > 0 ) {
			zuhaus_mikado_add_admin_field( array(
				'name'        => 'custom_sidebar_area',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'zuhaus' ),
				'description' => esc_html__( 'Choose a sidebar to display on pages. Default sidebar is "Sidebar"', 'zuhaus' ),
				'parent'      => $sidebar_panel,
				'options'     => $zuhaus_custom_sidebars,
				'args'        => array(
					'select2' => true
				)
			) );
		}
	}
	
	add_action( 'zuhaus_mikado_sidebar_options_map', 'zuhaus_mikado_sidebar_options_map', 10 );
}