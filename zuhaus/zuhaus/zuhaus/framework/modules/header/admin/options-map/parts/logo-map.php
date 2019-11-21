<?php

if ( ! function_exists( 'zuhaus_mikado_logo_options_map' ) ) {
	function zuhaus_mikado_logo_options_map() {
		
		$panel_logo = zuhaus_mikado_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_logo',
				'title' => esc_html__( 'Branding', 'zuhaus' )
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $panel_logo,
				'type'          => 'yesno',
				'name'          => 'hide_logo',
				'default_value' => 'no',
				'label'         => esc_html__( 'Hide Logo', 'zuhaus' ),
				'description'   => esc_html__( 'Enabling this option will hide logo image', 'zuhaus' ),
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "#mkdf_hide_logo_container",
					"dependence_show_on_yes" => ""
				)
			)
		);
		
		$hide_logo_container = zuhaus_mikado_add_admin_container(
			array(
				'parent'          => $panel_logo,
				'name'            => 'hide_logo_container',
				'hidden_property' => 'hide_logo',
				'hidden_value'    => 'yes'
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'          => 'logo_image',
				'type'          => 'image',
				'default_value' => MIKADO_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Default', 'zuhaus' ),
				'parent'        => $hide_logo_container
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'          => 'logo_image_dark',
				'type'          => 'image',
				'default_value' => MIKADO_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Dark', 'zuhaus' ),
				'parent'        => $hide_logo_container
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'          => 'logo_image_light',
				'type'          => 'image',
				'default_value' => MIKADO_ASSETS_ROOT . "/img/logo_white.png",
				'label'         => esc_html__( 'Logo Image - Light', 'zuhaus' ),
				'parent'        => $hide_logo_container
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'          => 'logo_image_sticky',
				'type'          => 'image',
				'default_value' => MIKADO_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Sticky', 'zuhaus' ),
				'parent'        => $hide_logo_container
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'          => 'logo_image_mobile',
				'type'          => 'image',
				'default_value' => MIKADO_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Mobile', 'zuhaus' ),
				'parent'        => $hide_logo_container
			)
		);
	}
	
	add_action( 'zuhaus_mikado_logo_options_map', 'zuhaus_mikado_logo_options_map', 2 );
}