<?php

if ( ! function_exists( 'zuhaus_mikado_header_minimal_full_screen_menu_body_class' ) ) {
	/**
	 * Function that adds body classes for different full screen menu types
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function zuhaus_mikado_header_minimal_full_screen_menu_body_class( $classes ) {
		$classes[] = 'mkdf-' . zuhaus_mikado_options()->getOptionValue( 'fullscreen_menu_animation_style' );
		
		return $classes;
	}
	
	if ( zuhaus_mikado_check_is_header_type_enabled( 'header-minimal', zuhaus_mikado_get_page_id() ) ) {
		add_filter( 'body_class', 'zuhaus_mikado_header_minimal_full_screen_menu_body_class' );
	}
}

if ( ! function_exists( 'zuhaus_mikado_get_header_minimal_full_screen_menu' ) ) {
	/**
	 * Loads fullscreen menu HTML template
	 */
	function zuhaus_mikado_get_header_minimal_full_screen_menu() {
		$parameters = array(
			'fullscreen_menu_in_grid' => zuhaus_mikado_options()->getOptionValue( 'fullscreen_in_grid' ) === 'yes' ? true : false
		);
		
		zuhaus_mikado_get_module_template_part( 'templates/full-screen-menu', 'header/types/header-minimal', '', $parameters );
	}
	
	if ( zuhaus_mikado_check_is_header_type_enabled( 'header-minimal', zuhaus_mikado_get_page_id() ) ) {
		add_action( 'zuhaus_mikado_after_wrapper_inner', 'zuhaus_mikado_get_header_minimal_full_screen_menu', 40 );
	}
}

if ( ! function_exists( 'zuhaus_mikado_header_minimal_mobile_menu_module' ) ) {
    /**
     * Function that edits module for mobile menu
     *
     * @param $module - default module value
     *
     * @return string name of module
     */
    function zuhaus_mikado_header_minimal_mobile_menu_module( $module ) {
        return 'header/types/header-minimal';
    }

    if ( zuhaus_mikado_check_is_header_type_enabled( 'header-minimal', zuhaus_mikado_get_page_id() ) ) {
        add_filter('zuhaus_mikado_mobile_menu_module', 'zuhaus_mikado_header_minimal_mobile_menu_module');
    }
}

if ( ! function_exists( 'zuhaus_mikado_header_minimal_mobile_menu_slug' ) ) {
    /**
     * Function that edits slug for mobile menu
     *
     * @param $slug - default slug value
     *
     * @return string name of slug
     */
    function zuhaus_mikado_header_minimal_mobile_menu_slug( $slug ) {
        return 'minimal';
    }

    if ( zuhaus_mikado_check_is_header_type_enabled( 'header-minimal', zuhaus_mikado_get_page_id() ) ) {
        add_filter('zuhaus_mikado_mobile_menu_slug', 'zuhaus_mikado_header_minimal_mobile_menu_slug');
    }
}