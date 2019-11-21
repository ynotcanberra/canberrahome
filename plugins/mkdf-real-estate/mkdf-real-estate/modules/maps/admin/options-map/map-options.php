<?php

if ( ! function_exists('mkdf_real_estate_map_options_map') ) {

    function mkdf_real_estate_map_options_map() {

        $panel_maps = zuhaus_mikado_add_admin_panel( array(
            'title' => 'Maps',
            'name'  => 'panel_maps',
            'page'  => '_real_estate'
        ) );

        zuhaus_mikado_add_admin_field(
            array(
                'parent'		=> $panel_maps,
                'type'			=> 'textarea',
                'name'			=> 'real_estate_map_style',
                'default_value'	=> '',
                'label'			=> esc_html__('Maps Style', 'mkdf-real-estate'),
                'description'	=> esc_html__('Insert map style json', 'mkdf-real-estate'),
            )
        );

        zuhaus_mikado_add_admin_field(
            array(
                'parent'		=> $panel_maps,
                'type'			=> 'yesno',
                'name'			=> 'real_estate_maps_scrollable',
                'default_value'	=> 'yes',
                'label'			=> esc_html__('Scrollable Maps', 'mkdf-real-estate'),
                'description'	=> '',
            )
        );

        zuhaus_mikado_add_admin_field(
            array(
                'parent'		=> $panel_maps,
                'type'			=> 'yesno',
                'name'			=> 'real_estate_maps_draggable',
                'default_value'	=> 'yes',
                'label'			=> esc_html__('Draggable Maps', 'mkdf-real-estate'),
                'description'	=> '',
            )
        );

        zuhaus_mikado_add_admin_field(
            array(
                'parent'		=> $panel_maps,
                'type'			=> 'yesno',
                'name'			=> 'real_estate_maps_street_view_control',
                'default_value'	=> 'yes',
                'label'			=> esc_html__('Maps Street View Controls', 'mkdf-real-estate'),
                'description'	=> '',
            )
        );

        zuhaus_mikado_add_admin_field(
            array(
                'parent'		=> $panel_maps,
                'type'			=> 'yesno',
                'name'			=> 'real_estate_maps_zoom_control',
                'default_value'	=> 'yes',
                'label'			=> esc_html__('Maps Zoom Control', 'mkdf-real-estate'),
                'description'	=> '',
            )
        );

        zuhaus_mikado_add_admin_field(
            array(
                'parent'		=> $panel_maps,
                'type'			=> 'yesno',
                'name'			=> 'real_estate_maps_type_control',
                'default_value'	=> 'yes',
                'label'			=> esc_html__('Maps Type Control', 'mkdf-real-estate'),
                'description'	=> '',
            )
        );
    }

    add_action('zuhaus_mikado_additional_real_estate_options_map', 'mkdf_real_estate_map_options_map', 13);
}