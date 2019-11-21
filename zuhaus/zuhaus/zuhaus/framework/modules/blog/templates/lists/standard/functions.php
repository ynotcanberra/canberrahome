<?php

if ( ! function_exists( 'zuhaus_mikado_register_blog_standard_template_file' ) ) {
	/**
	 * Function that register blog standard template
	 */
	function zuhaus_mikado_register_blog_standard_template_file( $templates ) {
		$templates['blog-standard'] = esc_html__( 'Blog: Standard', 'zuhaus' );
		
		return $templates;
	}
	
	add_filter( 'zuhaus_mikado_register_blog_templates', 'zuhaus_mikado_register_blog_standard_template_file' );
}

if ( ! function_exists( 'zuhaus_mikado_set_blog_standard_type_global_option' ) ) {
	/**
	 * Function that set blog list type value for global blog option map
	 */
	function zuhaus_mikado_set_blog_standard_type_global_option( $options ) {
		$options['standard'] = esc_html__( 'Blog: Standard', 'zuhaus' );
		
		return $options;
	}
	
	add_filter( 'zuhaus_mikado_blog_list_type_global_option', 'zuhaus_mikado_set_blog_standard_type_global_option' );
}