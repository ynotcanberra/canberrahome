<?php
if(!function_exists('mkdf_re_map_property_specifictation_meta')) {
    function mkdf_re_map_property_specifictation_meta($meta_box) {

        $property_specification_container = zuhaus_mikado_add_admin_container(array(
            'type'            => 'container',
            'name'            => 'property_specification_container',
            'parent'          => $meta_box
        ));

        zuhaus_mikado_add_admin_section_title(array(
            'title'           => esc_html__('Specification', 'mkdf-real-estate'),
            'name'            => 'property_specification_container_title',
            'parent'          => $property_specification_container
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_id_meta',
            'type'        => 'text',
            'label'       => esc_html__('Property ID', 'mkdf-real-estate'),
            'parent'      => $property_specification_container,
            'args'        => array(
                'col_width' => 3
            )
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_price_meta',
            'type'        => 'text',
            'label'       => esc_html__('Price', 'mkdf-real-estate'),
            'description' => esc_html__('Sale or Rent price', 'mkdf-real-estate'),
            'parent'      => $property_specification_container,
            'args'        => array(
                'col_width' => 3
            )
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_discount_price_meta',
            'type'        => 'text',
            'label'       => esc_html__('Discount Price', 'mkdf-real-estate'),
            'description' => esc_html__('Sale or rent discount price', 'mkdf-real-estate'),
            'parent'      => $property_specification_container,
            'args'        => array(
                'col_width' => 3
            )
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_price_label_meta',
            'type'        => 'text',
            'label'       => esc_html__('Price Label', 'mkdf-real-estate'),
            'description' => esc_html__('Text that will be shown next to price value', 'mkdf-real-estate'),
            'parent'      => $property_specification_container,
            'args'        => array(
                'col_width' => 3
            )
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_price_label_position_meta',
            'type'        => 'select',
            'label'       => esc_html__('Price Label Position', 'mkdf-real-estate'),
            'description' => esc_html__('Chose whether price label will be shown before or after price value', 'mkdf-real-estate'),
            'parent'      => $property_specification_container,
            'options'     => array(
                ''          => esc_html__( 'Default', 'mkdf-real-estate' ),
                'before'    => esc_html__( 'Before Price', 'mkdf-real-estate' ),
                'after'     => esc_html__( 'After Price', 'mkdf-real-estate' )
            )
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_size_meta',
            'type'        => 'text',
            'label'       => esc_html__('Size', 'mkdf-real-estate'),
            'description' => esc_html__('Enter property size', 'mkdf-real-estate'),
            'parent'      => $property_specification_container,
            'args'        => array(
                'col_width' => 3
            )
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_size_label_meta',
            'type'        => 'text',
            'label'       => esc_html__('Size Label', 'mkdf-real-estate'),
            'description' => esc_html__('Text that will be shown next to size value', 'mkdf-real-estate'),
            'parent'      => $property_specification_container,
            'args'        => array(
                'col_width' => 3
            )
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_size_label_position_meta',
            'type'        => 'select',
            'label'       => esc_html__('Size Label Position', 'mkdf-real-estate'),
            'description' => esc_html__('Chose whether size label will be shown before or after size value', 'mkdf-real-estate'),
            'parent'      => $property_specification_container,
            'options'     => array(
                ''          => esc_html__( 'Default', 'mkdf-real-estate' ),
                'before'    => esc_html__( 'Before Value', 'mkdf-real-estate' ),
                'after'     => esc_html__( 'After Value', 'mkdf-real-estate' )
            )
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_bedrooms_meta',
            'type'        => 'text',
            'label'       => esc_html__('Bedrooms', 'mkdf-real-estate'),
            'parent'      => $property_specification_container,
            'args'        => array(
                'col_width' => 3
            )
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_bathrooms_meta',
            'type'        => 'text',
            'label'       => esc_html__('Bathrooms', 'mkdf-real-estate'),
            'parent'      => $property_specification_container,
            'args'        => array(
                'col_width' => 3
            )
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_floor_meta',
            'type'        => 'text',
            'label'       => esc_html__('Floor', 'mkdf-real-estate'),
            'parent'      => $property_specification_container,
            'args'        => array(
                'col_width' => 3
            )
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_total_floors_meta',
            'type'        => 'text',
            'label'       => esc_html__('Total Floors', 'mkdf-real-estate'),
            'parent'      => $property_specification_container,
            'args'        => array(
                'col_width' => 3
            )
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_year_built_meta',
            'type'        => 'text',
            'label'       => esc_html__('Year Built', 'mkdf-real-estate'),
            'parent'      => $property_specification_container,
            'args'        => array(
                'col_width' => 3
            )
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_heating_meta',
            'type'        => 'text',
            'label'       => esc_html__('Heating', 'mkdf-real-estate'),
            'parent'      => $property_specification_container,
            'args'        => array(
                'col_width' => 3
            )
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_accommodation_meta',
            'type'        => 'text',
            'label'       => esc_html__('Accommodation', 'mkdf-real-estate'),
            'parent'      => $property_specification_container,
            'args'        => array(
                'col_width' => 3
            )
        ));

        zuhaus_mikado_add_admin_section_title(array(
            'title'           => esc_html__('Additional Specification', 'mkdf-real-estate'),
            'name'            => 'property_additional_specification_container_title',
            'parent'          => $property_specification_container
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_ceiling_height_meta',
            'type'        => 'text',
            'label'       => esc_html__('Ceiling Height', 'mkdf-real-estate'),
            'parent'      => $property_specification_container,
            'args'        => array(
                'col_width' => 3
            )
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_parking_meta',
            'type'        => 'text',
            'label'       => esc_html__('Parking', 'mkdf-real-estate'),
            'parent'      => $property_specification_container,
            'args'        => array(
                'col_width' => 3
            )
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_from_center_meta',
            'type'        => 'text',
            'label'       => esc_html__('Distance From the Center', 'mkdf-real-estate'),
            'parent'      => $property_specification_container,
            'args'        => array(
                'col_width' => 3
            )
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_area_size_meta',
            'type'        => 'text',
            'label'       => esc_html__('Area Size', 'mkdf-real-estate'),
            'parent'      => $property_specification_container,
            'args'        => array(
                'col_width' => 3
            )
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_garages_meta',
            'type'        => 'text',
            'label'       => esc_html__('Garages', 'mkdf-real-estate'),
            'parent'      => $property_specification_container,
            'args'        => array(
                'col_width' => 3
            )
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_garages_size_meta',
            'type'        => 'text',
            'label'       => esc_html__('Garages Size', 'mkdf-real-estate'),
            'parent'      => $property_specification_container,
            'args'        => array(
                'col_width' => 3
            )
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_additional_space_meta',
            'type'        => 'text',
            'label'       => esc_html__('Additional Space', 'mkdf-real-estate'),
            'parent'      => $property_specification_container,
            'args'        => array(
                'col_width' => 3
            )
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_publication_date_meta',
            'type'        => 'date',
            'label'       => esc_html__('Inspection', 'mkdf-real-estate'),
            'parent'      => $property_specification_container,
            'args'        => array(
                'col_width' => 3
            )
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_is_featured_meta',
            'type'        => 'select',
            'label'       => esc_html__('Featured Property', 'mkdf-real-estate'),
            'parent'      => $property_specification_container,
            'options'     => zuhaus_mikado_get_yes_no_select_array()
        ));
    }

    add_action('mkdf_re_action_property_meta_fields', 'mkdf_re_map_property_specifictation_meta', 10, 1);
}