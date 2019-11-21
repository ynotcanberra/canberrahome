<?php

if ( ! function_exists( 'zuhaus_mikado_register_sidebars' ) ) {
	/**
	 * Function that registers theme's sidebars
	 */
	function zuhaus_mikado_register_sidebars() {
		
		register_sidebar(
			array(
				'id'            => 'sidebar',
				'name'          => esc_html__( 'Sidebar', 'zuhaus' ),
				'description'   => esc_html__( 'Default Sidebar', 'zuhaus' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="mkdf-widget-title-holder"><h5 class="mkdf-widget-title">',
				'after_title'   => '</h5></div>'
			)
		);
	}
	
	add_action( 'widgets_init', 'zuhaus_mikado_register_sidebars', 1 );
}

if ( ! function_exists( 'zuhaus_mikado_add_support_custom_sidebar' ) ) {
	/**
	 * Function that adds theme support for custom sidebars. It also creates ZuhausMikadoSidebar object
	 */
	function zuhaus_mikado_add_support_custom_sidebar() {
		add_theme_support( 'ZuhausMikadoSidebar' );
		
		if ( get_theme_support( 'ZuhausMikadoSidebar' ) ) {
			new ZuhausMikadoSidebar();
		}
	}
	
	add_action( 'after_setup_theme', 'zuhaus_mikado_add_support_custom_sidebar' );
}