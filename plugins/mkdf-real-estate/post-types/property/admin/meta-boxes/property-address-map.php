<?php
if(!function_exists('mkdf_re_map_property_address_meta')) {
    function mkdf_re_map_property_address_meta($meta_box) {

        $property_address_container = zuhaus_mikado_add_admin_container(array(
            'type'            => 'container',
            'name'            => 'property_address_container',
            'parent'          => $meta_box
        ));

        zuhaus_mikado_add_admin_section_title(array(
            'title'           => esc_html__('Address', 'mkdf-real-estate'),
            'name'            => 'property_address_container_title',
            'parent'          => $property_address_container
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_full_address_meta',
            'type'        => 'address',
            'label'       => esc_html__('Full Address', 'mkdf-real-estate'),
            'parent'      => $property_address_container,
            'args'        => array(
                'latitude_field' => 'mkdf_property_full_address_latitude',
                'longitude_field' => 'mkdf_property_full_address_longitude'
            )
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_full_address_latitude',
            'type'        => 'text',
            'label'       => esc_html__('Latitude', 'mkdf-real-estate'),
            'parent'      => $property_address_container,
            'args'        => array(
                'col_width' => 3,
                'custom_class' => 'mkdf-address-elements',
                'input-data' => array(
                    'data-geo' => 'lat'
                )
            )
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_full_address_longitude',
            'type'        => 'text',
            'label'       => esc_html__('Longitude', 'mkdf-real-estate'),
            'parent'      => $property_address_container,
            'args'        => array(
                'col_width' => 3,
                'custom_class' => 'mkdf-address-elements',
                'input-data' => array(
                    'data-geo' => 'lng'
                )
            )
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_simple_address_meta',
            'type'        => 'text',
            'label'       => esc_html__('Simple Address', 'mkdf-real-estate'),
            'parent'      => $property_address_container,
            'args'        => array(
                'col_width' => 3
            )
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_zip_code_meta',
            'type'        => 'text',
            'label'       => esc_html__('ZIP Code', 'mkdf-real-estate'),
            'parent'      => $property_address_container,
            'args'        => array(
                'col_width' => 3
            )
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_address_country_meta',
            'type'        => 'select',
            'label'       => esc_html__('Country', 'mkdf-real-estate'),
            'parent'      => $property_address_container,
            'options'     => mkdf_re_get_countries_list()
        ));
    }

    add_action('mkdf_re_action_property_meta_fields', 'mkdf_re_map_property_address_meta', 13, 1);
}