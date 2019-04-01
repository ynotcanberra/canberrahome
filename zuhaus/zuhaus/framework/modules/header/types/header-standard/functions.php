<?php

if ( ! function_exists( 'zuhaus_mikado_register_header_standard_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function zuhaus_mikado_register_header_standard_type( $header_types ) {
		$header_type = array(
			'header-standard' => 'ZuhausMikado\Modules\Header\Types\HeaderStandard'
		);
		
		$header_types = array_merge( $header_types, $header_type );
		
		return $header_types;
	}
}

if ( ! function_exists( 'zuhaus_mikado_init_register_header_standard_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function zuhaus_mikado_init_register_header_standard_type() {
		add_filter( 'zuhaus_mikado_register_header_type_class', 'zuhaus_mikado_register_header_standard_type' );
	}
	
	add_action( 'zuhaus_mikado_before_header_function_init', 'zuhaus_mikado_init_register_header_standard_type' );
}