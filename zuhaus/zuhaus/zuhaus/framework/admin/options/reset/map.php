<?php

if ( ! function_exists( 'zuhaus_mikado_reset_options_map' ) ) {
	/**
	 * Reset options panel
	 */
	function zuhaus_mikado_reset_options_map() {
		
		zuhaus_mikado_add_admin_page(
			array(
				'slug'  => '_reset_page',
				'title' => esc_html__( 'Reset', 'zuhaus' ),
				'icon'  => 'fa fa-retweet'
			)
		);
		
		$panel_reset = zuhaus_mikado_add_admin_panel(
			array(
				'page'  => '_reset_page',
				'name'  => 'panel_reset',
				'title' => esc_html__( 'Reset', 'zuhaus' )
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'reset_to_defaults',
				'default_value' => 'no',
				'label'         => esc_html__( 'Reset to Defaults', 'zuhaus' ),
				'description'   => esc_html__( 'This option will reset all Select Options values to defaults', 'zuhaus' ),
				'parent'        => $panel_reset
			)
		);
	}
	
	add_action( 'zuhaus_mikado_options_map', 'zuhaus_mikado_reset_options_map', 100 );
}