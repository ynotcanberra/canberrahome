<?php

if ( ! function_exists( 'zuhaus_mikado_search_body_class' ) ) {
	/**
	 * Function that adds body classes for different search types
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function zuhaus_mikado_search_body_class( $classes ) {
		$classes[] = 'mkdf-search-covers-header';
		
		return $classes;
	}
	
	add_filter( 'body_class', 'zuhaus_mikado_search_body_class' );
}

if ( ! function_exists( 'zuhaus_mikado_get_search' ) ) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function zuhaus_mikado_get_search() {
		zuhaus_mikado_load_search_template();
	}
	
	add_action( 'zuhaus_mikado_before_page_header_html_close', 'zuhaus_mikado_get_search' );
	add_action( 'zuhaus_mikado_before_mobile_header_html_close', 'zuhaus_mikado_get_search' );
}

if ( ! function_exists( 'zuhaus_mikado_load_search_template' ) ) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function zuhaus_mikado_load_search_template() {
		$search_icon       = '';
		$search_icon_close = '';
		
		$search_in_grid   = zuhaus_mikado_options()->getOptionValue( 'search_in_grid' );
		$search_icon_pack = zuhaus_mikado_options()->getOptionValue( 'search_icon_pack' );
		
		if ( ! empty( $search_icon_pack ) ) {
			$search_icon       = zuhaus_mikado_icon_collections()->getSearchIcon( $search_icon_pack, true );
			$search_icon_close = zuhaus_mikado_icon_collections()->getSearchClose( $search_icon_pack, true );
		}
		
		$parameters = array(
			'search_in_grid'    => $search_in_grid,
			'search_icon'       => $search_icon,
			'search_icon_close' => $search_icon_close
		);
		
		zuhaus_mikado_get_module_template_part( 'types/covers-header/templates/covers-header', 'search', '', $parameters );
	}
}