<?php

if ( ! function_exists('mkdf_real_estate_single_options_map') ) {

    function mkdf_real_estate_single_options_map() {

        $panel_single = zuhaus_mikado_add_admin_panel( array(
            'title' => esc_html__('Single', 'mkdf-real-estate'),
            'name'  => 'panel_single',
            'page'  => '_real_estate'
        ) );

        zuhaus_mikado_add_admin_field(
            array(
                'type'          => 'select',
                'name'          => 'property_single_layout',
                'default_value' => 'advanced',
                'label'         => esc_html__( 'Single Property Layout', 'mkdf-real-estate' ),
                'description'   => esc_html__( 'Choose default layout for your single property page', 'mkdf-real-estate' ),
                'parent'        => $panel_single,
                'options'       => array(
                    'advanced' => esc_html__( 'Advanced Gallery', 'mkdf-real-estate' ),
                    'thumbnails'  => esc_html__( 'Gallery with Thumbnails', 'mkdf-real-estate' )
                ),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        zuhaus_mikado_add_admin_field(
            array(
                'type'          => 'select',
                'name'          => 'show_title_area_property_single',
                'default_value' => '',
                'label'         => esc_html__( 'Show Title Area', 'mkdf-real-estate' ),
                'description'   => esc_html__( 'Enabling this option will show title area on single properties', 'mkdf-real-estate' ),
                'parent'        => $panel_single,
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

        zuhaus_mikado_add_admin_field(
            array(
                'name'          => 'property_single_sidebar_layout',
                'type'          => 'select',
                'label'         => esc_html__( 'Sidebar Layout', 'mkdf-real-estate' ),
                'description'   => esc_html__( 'Choose a sidebar layout for single property page', 'mkdf-real-estate' ),
                'default_value' => '',
                'parent'        => $panel_single,
                'options'       => zuhaus_mikado_get_custom_sidebars_options()
            )
        );

        $zuhaus_custom_sidebars = zuhaus_mikado_get_custom_sidebars();
        if ( count( $zuhaus_custom_sidebars ) > 0 ) {
            zuhaus_mikado_add_admin_field( array(
                'name'        => 'property_custom_sidebar_area',
                'type'        => 'selectblank',
                'label'       => esc_html__( 'Sidebar to Display', 'mkdf-real-estate' ),
                'description' => esc_html__( 'Choose a sidebar to display on single properties. Default sidebar is "Sidebar"', 'mkdf-real-estate' ),
                'parent'      => $panel_single,
                'options'     => $zuhaus_custom_sidebars,
                'args'        => array(
                    'select2' => true
                )
            ) );
        }

        zuhaus_mikado_add_admin_field(
            array(
                'name'          => 'property_single_comments',
                'type'          => 'yesno',
                'label'         => esc_html__( 'Show Comments', 'mkdf-real-estate' ),
                'description'   => esc_html__( 'Enabling this option will show comments on your property', 'mkdf-real-estate' ),
                'parent'        => $panel_single,
                'default_value' => 'yes'
            )
        );

        zuhaus_mikado_add_admin_field(
            array(
                'name'          => 'property_single_show_related',
                'type'          => 'yesno',
                'label'         => esc_html__( 'Show Related', 'mkdf-real-estate' ),
                'description'   => esc_html__( 'Enabling this option will show related properties on your property', 'mkdf-real-estate' ),
                'parent'        => $panel_single,
                'default_value' => 'yes',
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkdf_property_related_posts_settings_container'
                )
            )
        );

        $related_posts_settings_container = zuhaus_mikado_add_admin_container(
            array(
                'type'            => 'container',
                'name'            => 'property_related_posts_settings_container',
                'parent'          => $panel_single,
                'hidden_property' => 'property_single_show_related',
                'hidden_value'    => 'no'
            )
        );

        zuhaus_mikado_add_admin_field(
            array(
                'name'          => 'real_estate_related_posts_number_of_columns',
                'type'          => 'select',
                'label'         => esc_html__( 'Number of Columns', 'mkdf-real-estate' ),
                'default_value' => '4',
                'description'   => esc_html__( 'Set number of columns for your related properties on single property page. Default value is 4 columns', 'mkdf-real-estate' ),
                'parent'        => $related_posts_settings_container,
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
                'name'          => 'real_estate_related_posts_space_between_items',
                'type'          => 'select',
                'label'         => esc_html__( 'Space Between Items', 'mkdf-real-estate' ),
                'default_value' => 'tiny',
                'description'   => esc_html__( 'Set space size between property items for your related properties on single property page. Default value is normal', 'mkdf-real-estate' ),
                'parent'        => $related_posts_settings_container,
                'options'       => zuhaus_mikado_get_space_between_items_array()
            )
        );

        zuhaus_mikado_add_admin_field(
            array(
                'name'          => 'real_estate_related_posts_image_size',
                'type'          => 'select',
                'label'         => esc_html__( 'Image Proportions', 'mkdf-real-estate' ),
                'default_value' => 'full',
                'description'   => esc_html__( 'Set image proportions for your property items on single property page. Default value is full', 'mkdf-real-estate' ),
                'parent'        => $related_posts_settings_container,
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
                'parent'		=> $panel_single,
                'type'			=> 'yesno',
                'name'			=> 'real_estate_content_bottom',
                'default_value'	=> 'yes',
                'label'			=> esc_html__('Enable content bottom area', 'mkdf-real-estate'),
                'description'	=> '',
            )
        );

        zuhaus_mikado_add_admin_field(array(
            'name'        => 'property_price_label',
            'type'        => 'text',
            'label'       => esc_html__('Price Label', 'mkdf-real-estate'),
            'description' => esc_html__('Text that will be shown next to price value', 'mkdf-real-estate'),
            'parent'      => $panel_single,
            'args'        => array(
                'col_width' => 3
            )
        ));

        zuhaus_mikado_add_admin_field(array(
            'name'        => 'property_price_label_position',
            'type'        => 'select',
            'label'       => esc_html__('Price Label Position', 'mkdf-real-estate'),
            'description' => esc_html__('Chose whether price label will be shown before or after price value', 'mkdf-real-estate'),
            'parent'      => $panel_single,
            'options'     => array(
                ''          => esc_html__( 'Default', 'mkdf-real-estate' ),
                'before'    => esc_html__( 'Before Price', 'mkdf-real-estate' ),
                'after'     => esc_html__( 'After Price', 'mkdf-real-estate' )
            )
        ));

        zuhaus_mikado_add_admin_field(array(
            'name'        => 'property_size_label',
            'type'        => 'text',
            'label'       => esc_html__('Size Label', 'mkdf-real-estate'),
            'description' => esc_html__('Text that will be shown next to size value', 'mkdf-real-estate'),
            'parent'      => $panel_single,
            'args'        => array(
                'col_width' => 3
            )
        ));

        zuhaus_mikado_add_admin_field(array(
            'name'        => 'property_size_label_position',
            'type'        => 'select',
            'label'       => esc_html__('Size Label Position', 'mkdf-real-estate'),
            'description' => esc_html__('Chose whether size label will be shown before or after size value', 'mkdf-real-estate'),
            'parent'      => $panel_single,
            'options'     => array(
                ''          => esc_html__( 'Default', 'mkdf-real-estate' ),
                'before'    => esc_html__( 'Before Value', 'mkdf-real-estate' ),
                'after'     => esc_html__( 'After Value', 'mkdf-real-estate' )
            )
        ));

        zuhaus_mikado_add_admin_field(array(
            'name'        => 'property_enquiry_button_text',
            'type'        => 'text',
            'label'       => esc_html__('Enquiry Button Text', 'mkdf-real-estate'),
            'description' => esc_html__('Text that will be shown on button for sending enquiry message. Default is Schedule Watching', 'mkdf-real-estate'),
            'parent'      => $panel_single,
            'args'        => array(
                'col_width' => 3
            )
        ));

        zuhaus_mikado_add_admin_field(array(
            'name'        => 'property_success_message_text',
            'type'        => 'text',
            'label'       => esc_html__('Success Message Text', 'mkdf-real-estate'),
            'description' => esc_html__('Text that will be shown after sending enquiry message from single property.', 'mkdf-real-estate'),
            'parent'      => $panel_single,
            'args'        => array(
                'col_width' => 3
            )
        ));

        zuhaus_mikado_add_admin_field(array(
            'name'        => 'property_fail_message_text',
            'type'        => 'text',
            'label'       => esc_html__('Fail Message Text', 'mkdf-real-estate'),
            'description' => esc_html__('Text that will be shown if sending enquiry message fails.', 'mkdf-real-estate'),
            'parent'      => $panel_single,
            'args'        => array(
                'col_width' => 3
            )
        ));
    }

    add_action( 'zuhaus_mikado_additional_real_estate_options_map', 'mkdf_real_estate_single_options_map', 11);
}