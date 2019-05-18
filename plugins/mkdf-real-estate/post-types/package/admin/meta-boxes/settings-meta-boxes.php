<?php
if(!function_exists('mkdf_re_map_package_meta')) {
    function mkdf_re_map_package_meta() {

        $meta_box = zuhaus_mikado_add_meta_box( array(
            'scope' => 'package',
            'title' => esc_html__( 'Package Settings', 'mkdf-real-estate' ),
            'name'  => 'package_settings_meta_box'
        ) );

        $package_general_container = zuhaus_mikado_add_admin_container(array(
            'type'            => 'container',
            'name'            => 'package_general_container',
            'parent'          => $meta_box
        ));

        zuhaus_mikado_add_admin_section_title(array(
            'title'           => esc_html__('General', 'mkdf-real-estate'),
            'name'            => 'property_general_container_title',
            'parent'          => $package_general_container
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'          => 'mkdf_package_unlimited_listings_meta',
            'type'          => 'yesno',
            'label'         => esc_html__('Unlimited Listings', 'mkdf-real-estate'),
            'default_value' => 'no',
            'parent'        => $package_general_container,
            'args'          => array(
                'dependence'             => true,
                'dependence_hide_on_yes' => '#mkdf_mkdf_package_listings_included_meta',
                'dependence_show_on_yes' => ''
            )
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_package_listings_included_meta',
            'type'        => 'text',
            'label'       => esc_html__('Number of Listings Included', 'mkdf-real-estate'),
            'parent'      => $package_general_container,
            'args'        => array(
                'col_width' => 3
            ),
            'hidden_property' => 'mkdf_package_unlimited_listings_meta',
            'hidden_value'   => 'yes'
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_package_featured_listings_included_meta',
            'type'        => 'text',
            'label'       => esc_html__('Number of Featured Listings Included', 'mkdf-real-estate'),
            'parent'      => $package_general_container,
            'args'        => array(
                'col_width' => 3
            )
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_package_price_meta',
            'type'        => 'text',
            'label'       => esc_html__('Package Price', 'mkdf-real-estate'),
            'parent'      => $package_general_container,
            'args'        => array(
                'col_width' => 3
            )
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'          => 'mkdf_package_featured_meta',
            'type'          => 'yesno',
            'label'         => esc_html__('Featured Package', 'mkdf-real-estate'),
            'default_value' => 'no',
            'parent'        => $package_general_container
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_package_duration_meta',
            'type'        => 'text',
            'default'     => '12',
            'label'       => esc_html__('Package Duration (months)', 'mkdf-real-estate'),
            'description' => esc_html__('Enter how many months the package lasts. Default is 12.', 'mkdf-real-estate'),
            'parent'      => $package_general_container,
            'args'        => array(
                'col_width' => 3
            )
        ));

    }

    add_action('zuhaus_mikado_meta_boxes_map', 'mkdf_re_map_package_meta');
}