<?php
if(!function_exists('mkdf_re_map_property_meta')) {
    function mkdf_re_map_property_meta() {

        $meta_box = zuhaus_mikado_add_meta_box( array(
            'scope' => 'property',
            'title' => esc_html__( 'Property Settings', 'mkdf-real-estate' ),
            'name'  => 'property_settings_meta_box'
        ) );

        $property_general_container = zuhaus_mikado_add_admin_container(array(
            'type'            => 'container',
            'name'            => 'property_general_container',
            'parent'          => $meta_box
        ));

        zuhaus_mikado_add_admin_section_title(array(
            'title'           => esc_html__('General', 'mkdf-real-estate'),
            'name'            => 'property_general_container_title',
            'parent'          => $property_general_container
        ));

        zuhaus_mikado_add_meta_box_field(
            array(
                'type'          => 'select',
                'name'          => 'mkdf_property_single_layout_meta',
                'default_value' => '',
                'label'         => esc_html__( 'Single Property Layout', 'mkdf-real-estate' ),
                'description'   => esc_html__( 'Choose default layout for your single property page', 'mkdf-real-estate' ),
                'parent'        => $property_general_container,
                'options'       => array(
                    ''              => esc_html__( 'Default', 'mkdf-real-estate' ),
                    'advanced'      => esc_html__( 'Advanced Gallery', 'mkdf-real-estate' ),
                    'thumbnails'    => esc_html__( 'Gallery with Thumbnails', 'mkdf-real-estate' )
                )
            )
        );

        zuhaus_mikado_add_meta_box_field(
            array(
                'name'          => 'mkdf_show_title_area_property_single_meta',
                'type'          => 'select',
                'default_value' => '',
                'label'         => esc_html__( 'Show Title Area', 'mkdf-real-estate' ),
                'description'   => esc_html__( 'Enabling this option will show title area on your single property page', 'mkdf-real-estate' ),
                'parent'        => $property_general_container,
                'options'       => zuhaus_mikado_get_yes_no_select_array()
            )
        );

        do_action('mkdf_re_action_property_meta_fields', $meta_box);
    }

    add_action('zuhaus_mikado_meta_boxes_map', 'mkdf_re_map_property_meta');
}