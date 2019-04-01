<?php

if ( ! function_exists( 'zuhaus_mikado_register_header_minimal_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function zuhaus_mikado_register_header_minimal_type( $header_types ) {
		$header_type = array(
			'header-minimal' => 'ZuhausMikado\Modules\Header\Types\HeaderMinimal'
		);
		
		$header_types = array_merge( $header_types, $header_type );
		
		return $header_types;
	}
}

if ( ! function_exists( 'zuhaus_mikado_init_register_header_minimal_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function zuhaus_mikado_init_register_header_minimal_type() {
		add_filter( 'zuhaus_mikado_register_header_type_class', 'zuhaus_mikado_register_header_minimal_type' );
	}
	
	add_action( 'zuhaus_mikado_before_header_function_init', 'zuhaus_mikado_init_register_header_minimal_type' );
}

if ( ! function_exists( 'zuhaus_mikado_include_header_minimal_full_screen_menu' ) ) {
	/**
	 * Registers additional menu navigation for theme
	 */
	function zuhaus_mikado_include_header_minimal_full_screen_menu( $menus ) {
		$menus['popup-navigation'] = esc_html__( 'Full Screen Navigation', 'zuhaus' );
		
		return $menus;
	}
	
	if ( zuhaus_mikado_check_is_header_type_enabled( 'header-minimal' ) ) {
		add_filter( 'zuhaus_mikado_register_headers_menu', 'zuhaus_mikado_include_header_minimal_full_screen_menu' );
	}
}

if ( ! function_exists( 'zuhaus_mikado_register_header_minimal_full_screen_menu_widgets' ) ) {
	/**
	 * Registers additional widget areas for this header type
	 */
	function zuhaus_mikado_register_header_minimal_full_screen_menu_widgets() {
		register_sidebar(
			array(
				'id'            => 'fullscreen_menu_above',
				'name'          => esc_html__( 'Fullscreen Menu Top', 'zuhaus' ),
				'description'   => esc_html__( 'This widget area is rendered above full screen menu', 'zuhaus' ),
				'before_widget' => '<div class="%2$s mkdf-fullscreen-menu-above-widget">',
				'after_widget'  => '</div>',
				'before_title'  => '<h5 class="mkdf-widget-title">',
				'after_title'   => '</h5>'
			)
		);
		
		register_sidebar(
			array(
				'id'            => 'fullscreen_menu_below',
				'name'          => esc_html__( 'Fullscreen Menu Bottom', 'zuhaus' ),
				'description'   => esc_html__( 'This widget area is rendered below full screen menu', 'zuhaus' ),
				'before_widget' => '<div class="%2$s mkdf-fullscreen-menu-below-widget">',
				'after_widget'  => '</div>',
				'before_title'  => '<h5 class="mkdf-widget-title">',
				'after_title'   => '</h5>'
			)
		);
	}
	
	if ( zuhaus_mikado_check_is_header_type_enabled( 'header-minimal' ) ) {
		add_action( 'widgets_init', 'zuhaus_mikado_register_header_minimal_full_screen_menu_widgets' );
	}
}