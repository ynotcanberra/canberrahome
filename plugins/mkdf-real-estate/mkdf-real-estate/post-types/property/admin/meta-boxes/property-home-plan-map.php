<?php
if(!function_exists('mkdf_re_map_property_home_plans_meta')) {
    function mkdf_re_map_property_home_plans_meta($meta_box) {

        $property_home_plans_container = zuhaus_mikado_add_admin_container(array(
            'type'            => 'container',
            'name'            => 'property_home_plans_container',
            'parent'          => $meta_box
        ));

        zuhaus_mikado_add_admin_section_title(array(
            'title'           => esc_html__('Home Plans', 'mkdf-real-estate'),
            'name'            => 'property_home_plans_container_title',
            'parent'          => $property_home_plans_container
        ));

        zuhaus_mikado_add_row_repeater_field(
            array(
                'name'        => 'mkdf_home_plans_meta',
                'parent'      => $property_home_plans_container,
                'button_text' => '',
                'fields'      => array_merge(
                    array(
                        array(
                            'type'        => 'text',
                            'name'        => 'mkdf_property_home_plan_title_meta',
                            'label'       => esc_html__('Title', 'mkdf-real-estate'),
                            'size'        => '6'
                        ),
                        array(
                            'type'        => 'text',
                            'name'        => 'mkdf_property_home_plan_price_meta',
                            'label'       => esc_html__('Price', 'mkdf-real-estate'),
                            'size'        => '6'
                        ),
                        array(
                            'type'        => 'text',
                            'name'        => 'mkdf_property_home_plan_bedrooms_meta',
                            'label'       => esc_html__('Bedrooms', 'mkdf-real-estate'),
                            'size'        => '6'
                        ),
                        array(
                            'type'        => 'text',
                            'name'        => 'mkdf_property_home_plan_bathrooms_meta',
                            'label'       => esc_html__('Bathrooms', 'mkdf-real-estate'),
                            'size'        => '6'
                        ),
                        array(
                            'type'        => 'text',
                            'name'        => 'mkdf_property_home_plan_size_meta',
                            'label'       => esc_html__('Size', 'mkdf-real-estate'),
                            'size'        => '6'
                        ),
                        array(
                            'type'        => 'image',
                            'name'        => 'mkdf_property_home_plan_image_meta',
                            'label'       => esc_html__('Image', 'mkdf-real-estate'),
                            'size'        => '6'
                        ),
                        array(
                            'type'        => 'textarea',
                            'name'        => 'mkdf_property_home_plan_description_meta',
                            'label'       => esc_html__('Description', 'mkdf-real-estate'),
                            'size'        => '12'
                        ),
                    )
                )
            )
        );
    }

    add_action('mkdf_re_action_property_meta_fields', 'mkdf_re_map_property_home_plans_meta', 16, 1);
}