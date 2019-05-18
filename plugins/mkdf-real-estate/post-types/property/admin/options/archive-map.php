<?php

if ( ! function_exists('mkdf_real_estate_archive_options_map') ) {

    function mkdf_real_estate_archive_options_map() {

        $panel_archive = zuhaus_mikado_add_admin_panel( array(
            'title' => esc_html__('Archive', 'mkdf-real-estate'),
            'name'  => 'panel_archive',
            'page'  => '_real_estate'
        ) );

        zuhaus_mikado_add_admin_field(
            array(
                'type'          => 'select',
                'name'          => 'show_title_area_property_archive',
                'default_value' => '',
                'label'         => esc_html__( 'Show Title Area', 'mkdf-real-estate' ),
                'description'   => esc_html__( 'Enabling this option will show title area on archive pages', 'mkdf-real-estate' ),
                'parent'        => $panel_archive,
                'options'       => array(
                    ''    => esc_html__( 'Default', 'mkdf-real-estate' ),
                    'yes' => esc_html__( 'Yes', 'mkdf-real-estate' ),
                    'no'  => esc_html__( 'No', 'mkdf-real-estate' )
                ),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );


        zuhaus_mikado_add_admin_field( array(
            'name'          => 'real_estate_archive_page_layout',
            'type'          => 'select',
            'label'         => esc_html__( 'Layout', 'mkdf-real-estate' ),
            'default_value' => 'full-width',
            'description'   => esc_html__( 'Set layout. Default is full width.', 'mkdf-real-estate' ),
            'parent'        => $panel_archive,
            'options'       => array(
                'full-width' => esc_html__( 'Full Width', 'mkdf-real-estate' ),
                'in-grid'    => esc_html__( 'In Grid', 'mkdf-real-estate' )
            )
        ) );

        zuhaus_mikado_add_admin_field(
            array(
                'parent'		=> $panel_archive,
                'type'			=> 'text',
                'name'			=> 'real_estate_archive_items_per_page',
                'default_value'	=> '',
                'label'			=> esc_html__('Number of properties per page', 'mkdf-real-estate'),
                'args'        => array(
                    'col_width' => 3
                )
            )
        );

        zuhaus_mikado_add_admin_field(
            array(
                'name'          => 'real_estate_archive_number_of_columns',
                'type'          => 'select',
                'label'         => esc_html__( 'Number of Columns', 'mkdf-real-estate' ),
                'default_value' => '4',
                'description'   => esc_html__( 'Set number of columns for your property list on archive pages. Default value is 4 columns', 'mkdf-real-estate' ),
                'parent'        => $panel_archive,
                'options'       => array(
                    '2' => esc_html__( '2 Columns', 'mkdf-real-estate' ),
                    '3' => esc_html__( '3 Columns', 'mkdf-real-estate' ),
                    '4' => esc_html__( '4 Columns', 'mkdf-real-estate' ),
                    '5' => esc_html__( '5 Columns', 'mkdf-real-estate' )
                )
            )
        );

        zuhaus_mikado_add_admin_field(
            array(
                'name'          => 'real_estate_archive_space_between_items',
                'type'          => 'select',
                'label'         => esc_html__( 'Space Between Items', 'mkdf-real-estate' ),
                'default_value' => 'normal',
                'description'   => esc_html__( 'Set space size between course items for your property list on archive pages. Default value is normal', 'mkdf-real-estate' ),
                'parent'        => $panel_archive,
                'options'       => zuhaus_mikado_get_space_between_items_array()
            )
        );

        zuhaus_mikado_add_admin_field(
            array(
                'name'          => 'real_estate_archive_image_size',
                'type'          => 'select',
                'label'         => esc_html__( 'Image Proportions', 'mkdf-real-estate' ),
                'default_value' => 'full',
                'description'   => esc_html__( 'Set image proportions for your property list on archive pages. Default value is full', 'mkdf-real-estate' ),
                'parent'        => $panel_archive,
                'options'       => array(
                    'full'      => esc_html__( 'Original', 'mkdf-real-estate' ),
                    'landscape' => esc_html__( 'Landscape', 'mkdf-real-estate' ),
                    'portrait'  => esc_html__( 'Portrait', 'mkdf-real-estate' ),
                    'square'    => esc_html__( 'Square', 'mkdf-real-estate' )
                )
            )
        );

        zuhaus_mikado_add_admin_field(
            array(
                'parent'		=> $panel_archive,
                'type'			=> 'yesno',
                'name'			=> 'real_estate_archive_filter',
                'default_value'	=> 'yes',
                'label'			=> esc_html__('Filter on Archive Pages', 'mkdf-real-estate'),
                'description'	=> '',
            )
        );

        zuhaus_mikado_add_admin_field(
            array(
                'parent'		=> $panel_archive,
                'type'			=> 'yesno',
                'name'			=> 'real_estate_archive_map',
                'default_value'	=> 'yes',
                'label'			=> esc_html__('Map on Archive Pages', 'mkdf-real-estate'),
                'description'	=> '',
            )
        );

        zuhaus_mikado_add_admin_field(
            array(
                'parent'		=> $panel_archive,
                'type'			=> 'select',
                'name'			=> 'real_estate_archive_load_more',
                'default_value'	=> 'no-pagination',
                'label'			=> esc_html__('Pagination', 'mkdf-real-estate'),
                'description'	=> '',
                'options'       => array(
                    'no-pagination'     => esc_html__( 'None', 'mkdf-real-estate' ),
                    'standard'          => esc_html__( 'Standard', 'mkdf-real-estate' ),
                    'load-more'         => esc_html__( 'Load More', 'mkdf-real-estate' ),
                    'infinite-scroll'   => esc_html__( 'Infinite Scroll', 'mkdf-real-estate' )
                )
            )
        );
    }

    add_action( 'zuhaus_mikado_additional_real_estate_options_map', 'mkdf_real_estate_archive_options_map', 12);
}