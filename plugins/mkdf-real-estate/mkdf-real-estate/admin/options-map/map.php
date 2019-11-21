<?php

if ( ! function_exists('mkdf_real_estate_options_map') ) {

	function mkdf_real_estate_options_map() {

		zuhaus_mikado_add_admin_page( array(
			'slug'  => '_real_estate',
			'title' =>  esc_html__('Real Estate', 'mkdf-real-estate'),
			'icon'  => 'fa fa-camera-retro'
		) );

        $panel_general = zuhaus_mikado_add_admin_panel( array(
            'title' => 'General',
            'name'  => 'panel_terms',
            'page'  => '_real_estate'
        ) );

        zuhaus_mikado_add_admin_field(
            array(
                'parent'		=> $panel_general,
                'type'			=> 'text',
                'name'			=> 'real_estate_item_terms_link',
                'default_value'	=> '',
                'label'			=> esc_html__('Terms And Conditions Page URL', 'mkdf-real-estate'),
                'description'   => esc_html__('Enter the page URL with terms and conditions.','mkdf-real-estate')
            )
        );

        /***************** Additional Page Layout - start *****************/

        do_action( 'zuhaus_mikado_additional_real_estate_options_map', $panel_general );

        /***************** Additional Page Layout - end *****************/

	}

	add_action( 'zuhaus_mikado_options_map', 'mkdf_real_estate_options_map', 15);
}