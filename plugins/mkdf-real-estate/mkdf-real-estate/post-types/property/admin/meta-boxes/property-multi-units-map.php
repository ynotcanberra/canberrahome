<?php
if(!function_exists('mkdf_re_map_property_multi_units_meta')) {
    function mkdf_re_map_property_multi_units_meta($meta_box) {

        $property_multi_units_container = zuhaus_mikado_add_admin_container(array(
            'type'            => 'container',
            'name'            => 'property_multi_units_container',
            'parent'          => $meta_box
        ));

        zuhaus_mikado_add_admin_section_title(array(
            'title'           => esc_html__('Multi Units / Sub Properties', 'mkdf-real-estate'),
            'name'            => 'property_multi_units_container_title',
            'parent'          => $property_multi_units_container
        ));

        zuhaus_mikado_add_row_repeater_field(
            array(
                'name'        => 'mkdf_multi_units_meta',
                'parent'      => $property_multi_units_container,
                'button_text' => '',
                'fields'      => array_merge(
                    array(
                        array(
                            'type'        => 'text',
                            'name'        => 'mkdf_property_multi_unit_title_meta',
                            'label'       => esc_html__('Title', 'mkdf-real-estate'),
                            'size'        => '6'
                        ),
                        array(
                            'type'        => 'text',
                            'name'        => 'mkdf_property_multi_unit_type_meta',
                            'label'       => esc_html__('Type', 'mkdf-real-estate'),
                            'size'        => '6'
                        ),
                        array(
                            'type'        => 'text',
                            'name'        => 'mkdf_property_multi_unit_price_meta',
                            'label'       => esc_html__('Price', 'mkdf-real-estate'),
                            'size'        => '6'
                        ),
                        array(
                            'type'        => 'text',
                            'name'        => 'mkdf_property_multi_unit_bedrooms_meta',
                            'label'       => esc_html__('Bedrooms', 'mkdf-real-estate'),
                            'size'        => '6'
                        ),
                        array(
                            'type'        => 'text',
                            'name'        => 'mkdf_property_multi_unit_bathrooms_meta',
                            'label'       => esc_html__('Bathrooms', 'mkdf-real-estate'),
                            'size'        => '6'
                        ),
                        array(
                            'type'        => 'text',
                            'name'        => 'mkdf_property_multi_unit_size_meta',
                            'label'       => esc_html__('Size', 'mkdf-real-estate'),
                            'size'        => '6'
                        ),
                        array(
                            'type'        => 'text',
                            'name'        => 'mkdf_property_multi_unit_available_meta',
                            'label'       => esc_html__('Availability Date', 'mkdf-real-estate'),
                            'size'        => '6'
                        ),
                    )
                )
            )
        );
    }

    add_action('mkdf_re_action_property_meta_fields', 'mkdf_re_map_property_multi_units_meta', 15, 1);
}