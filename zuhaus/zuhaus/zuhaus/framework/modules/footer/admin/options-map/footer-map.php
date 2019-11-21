<?php

if ( ! function_exists( 'zuhaus_mikado_footer_options_map' ) ) {
	function zuhaus_mikado_footer_options_map() {
		
		zuhaus_mikado_add_admin_page(
			array(
				'slug'  => '_footer_page',
				'title' => esc_html__( 'Footer', 'zuhaus' ),
				'icon'  => 'fa fa-sort-amount-asc'
			)
		);
		
		$footer_panel = zuhaus_mikado_add_admin_panel(
			array(
				'title' => esc_html__( 'Footer', 'zuhaus' ),
				'name'  => 'footer',
				'page'  => '_footer_page'
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'footer_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Footer in Grid', 'zuhaus' ),
				'description'   => esc_html__( 'Enabling this option will place Footer content in grid', 'zuhaus' ),
				'parent'        => $footer_panel,
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_top',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Top', 'zuhaus' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'zuhaus' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_show_footer_top_container'
				),
				'parent'        => $footer_panel,
			)
		);
		
		$show_footer_top_container = zuhaus_mikado_add_admin_container(
			array(
				'name'            => 'show_footer_top_container',
				'hidden_property' => 'show_footer_top',
				'hidden_value'    => 'no',
				'parent'          => $footer_panel
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns',
				'parent'        => $show_footer_top_container,
				'default_value' => '3',
				'label'         => esc_html__( 'Footer Top Columns', 'zuhaus' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Top area', 'zuhaus' ),
				'options'       => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4'
				)
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns_alignment',
				'default_value' => 'left',
				'label'         => esc_html__( 'Footer Top Columns Alignment', 'zuhaus' ),
				'description'   => esc_html__( 'Text Alignment in Footer Columns', 'zuhaus' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'zuhaus' ),
					'left'   => esc_html__( 'Left', 'zuhaus' ),
					'center' => esc_html__( 'Center', 'zuhaus' ),
					'right'  => esc_html__( 'Right', 'zuhaus' )
				),
				'parent'        => $show_footer_top_container,
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'        => 'footer_top_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'zuhaus' ),
				'description' => esc_html__( 'Set background color for top footer area', 'zuhaus' ),
				'parent'      => $show_footer_top_container
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_bottom',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Bottom', 'zuhaus' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'zuhaus' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_show_footer_bottom_container'
				),
				'parent'        => $footer_panel,
			)
		);
		
		$show_footer_bottom_container = zuhaus_mikado_add_admin_container(
			array(
				'name'            => 'show_footer_bottom_container',
				'hidden_property' => 'show_footer_bottom',
				'hidden_value'    => 'no',
				'parent'          => $footer_panel
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_bottom_columns',
				'default_value' => '1',
				'label'         => esc_html__( 'Footer Bottom Columns', 'zuhaus' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Bottom area', 'zuhaus' ),
				'options'       => array(
					'1' => '1',
					'2' => '2',
					'3' => '3'
				),
				'parent'        => $show_footer_bottom_container,
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'        => 'footer_bottom_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'zuhaus' ),
				'description' => esc_html__( 'Set background color for bottom footer area', 'zuhaus' ),
				'parent'      => $show_footer_bottom_container
			)
		);
	}
	
	add_action( 'zuhaus_mikado_options_map', 'zuhaus_mikado_footer_options_map', 11 );
}