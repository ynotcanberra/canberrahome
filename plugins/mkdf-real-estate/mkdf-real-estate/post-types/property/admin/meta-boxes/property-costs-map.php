<?php
if(!function_exists('mkdf_re_map_property_costs_meta')) {
    function mkdf_re_map_property_costs_meta($meta_box) {

        $property_costs_container = zuhaus_mikado_add_admin_container(array(
            'type'            => 'container',
            'name'            => 'property_costs_container',
            'parent'          => $meta_box
        ));

        zuhaus_mikado_add_admin_section_title(array(
            'title'           => esc_html__('Costs', 'mkdf-real-estate'),
            'name'            => 'property_costs_container_title',
            'parent'          => $property_costs_container
        ));

        zuhaus_mikado_add_table_repeater_field(
            array(
                'name'        => 'mkdf_costs_meta',
                'parent'      => $property_costs_container,
                'button_text' => '',
                'fields'      => array_merge(
                    array(
                        array(
                            'type'        => 'image',
                            'name'        => 'mkdf_property_costs_icon_meta',
                            'label'       => '',
                            'th'          => esc_html__( 'Icon', 'mkdf-real-estate' )
                        ),
                        array(
                            'type'        => 'text',
                            'name'        => 'mkdf_property_costs_label_meta',
                            'label'       => '',
                            'th'          => esc_html__( 'Label', 'mkdf-real-estate' )
                        ),
                        array(
                            'type'        => 'text',
                            'name'        => 'mkdf_property_costs_value_meta',
                            'label'       => '',
                            'th'          => esc_html__( 'Value', 'mkdf-real-estate' )
                        )
                    )
                )
            )
        );
    }

    add_action('mkdf_re_action_property_meta_fields', 'mkdf_re_map_property_costs_meta', 12, 1);
}