<?php

if ( ! function_exists('mkdf_real_estate_slug_options_map') ) {

    function mkdf_real_estate_slug_options_map() {

        $panel_slug = zuhaus_mikado_add_admin_panel( array(
            'title' => esc_html__('Slug', 'mkdf-real-estate'),
            'name'  => 'panel_slug',
            'page'  => '_real_estate'
        ) );

        zuhaus_mikado_add_admin_field(
            array(
                'parent'		=> $panel_slug,
                'type'			=> 'text',
                'name'			=> 'property_single_slug',
                'default_value'	=> '',
                'label'			=> esc_html__('Single Property Slug', 'mkdf-real-estate'),
                'description'   => esc_html__('Enter the slug for single property pages.','mkdf-real-estate'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        zuhaus_mikado_add_admin_field(
            array(
                'parent'		=> $panel_slug,
                'type'			=> 'text',
                'name'			=> 'property_types_slug',
                'default_value'	=> '',
                'label'			=> esc_html__('Property Type Slug', 'mkdf-real-estate'),
                'description'   => esc_html__('Enter the slug for property type archive pages.','mkdf-real-estate'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        zuhaus_mikado_add_admin_field(
            array(
                'parent'		=> $panel_slug,
                'type'			=> 'text',
                'name'			=> 'property_features_slug',
                'default_value'	=> '',
                'label'			=> esc_html__('Property Feature Slug', 'mkdf-real-estate'),
                'description'   => esc_html__('Enter the slug for property features archive pages.','mkdf-real-estate'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        zuhaus_mikado_add_admin_field(
            array(
                'parent'		=> $panel_slug,
                'type'			=> 'text',
                'name'			=> 'property_status_slug',
                'default_value'	=> '',
                'label'			=> esc_html__('Property Status Slug', 'mkdf-real-estate'),
                'description'   => esc_html__('Enter the slug for property status archive pages.','mkdf-real-estate'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        zuhaus_mikado_add_admin_field(
            array(
                'parent'		=> $panel_slug,
                'type'			=> 'text',
                'name'			=> 'property_county_slug',
                'default_value'	=> '',
                'label'			=> esc_html__('Property County/State Slug', 'mkdf-real-estate'),
                'description'   => esc_html__('Enter the slug for property county/state archive pages.','mkdf-real-estate'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        zuhaus_mikado_add_admin_field(
            array(
                'parent'		=> $panel_slug,
                'type'			=> 'text',
                'name'			=> 'property_city_slug',
                'default_value'	=> '',
                'label'			=> esc_html__('Property City Slug', 'mkdf-real-estate'),
                'description'   => esc_html__('Enter the slug for property city archive pages.','mkdf-real-estate'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        zuhaus_mikado_add_admin_field(
            array(
                'parent'		=> $panel_slug,
                'type'			=> 'text',
                'name'			=> 'property_neighborhood_slug',
                'default_value'	=> '',
                'label'			=> esc_html__('Property Neighborhood Slug', 'mkdf-real-estate'),
                'description'   => esc_html__('Enter the slug for property neighborhood archive pages.','mkdf-real-estate'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );
    }

    add_action( 'zuhaus_mikado_additional_real_estate_options_map', 'mkdf_real_estate_slug_options_map', 10);
}