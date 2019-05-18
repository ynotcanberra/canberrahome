<?php
if(!function_exists('mkdf_re_map_property_masonry_meta')) {
    function mkdf_re_map_property_masonry_meta($meta_box) {

        $property_masonry_container = zuhaus_mikado_add_admin_container(array(
            'type'            => 'container',
            'name'            => 'property_masonry_container',
            'parent'          => $meta_box
        ));

        zuhaus_mikado_add_admin_section_title(array(
            'title'           => esc_html__('List Shortcode', 'mkdf-real-estate'),
            'name'            => 'property_masonry_container_title',
            'parent'          => $property_masonry_container
        ));

        zuhaus_mikado_add_meta_box_field(
            array(
                'name'        => 'mkdf_property_featured_image_meta',
                'type'        => 'image',
                'label'       => esc_html__( 'Featured Image', 'mkdf-real-estate' ),
                'description' => esc_html__( 'Choose an image for Property Lists shortcodes', 'mkdf-real-estate' ),
                'parent'      => $property_masonry_container
            )
        );

        zuhaus_mikado_add_meta_box_field(
            array(
                'name'          => 'mkdf_property_masonry_fixed_dimensions_meta',
                'type'          => 'select',
                'label'         => esc_html__( 'Dimensions for Masonry - Image Fixed Proportion', 'mkdf-real-estate' ),
                'description'   => esc_html__( 'Choose image layout when it appears in Masonry type property lists where image proportion is fixed', 'mkdf-real-estate' ),
                'default_value' => 'default',
                'parent'        => $property_masonry_container,
                'options'       => array(
                    'default'            => esc_html__( 'Default', 'mkdf-real-estate' ),
                    'large-width'        => esc_html__( 'Large Width', 'mkdf-real-estate' ),
                    'large-height'       => esc_html__( 'Large Height', 'mkdf-real-estate' ),
                    'large-width-height' => esc_html__( 'Large Width/Height', 'mkdf-real-estate' )
                )
            )
        );

        zuhaus_mikado_add_meta_box_field(
            array(
                'name'          => 'mkdf_property_masonry_original_dimensions_meta',
                'type'          => 'select',
                'label'         => esc_html__( 'Dimensions for Masonry - Image Original Proportion', 'mkdf-real-estate' ),
                'description'   => esc_html__( 'Choose image layout when it appears in Masonry type property lists where image proportion is original', 'mkdf-real-estate' ),
                'default_value' => 'default',
                'parent'        => $property_masonry_container,
                'options'       => array(
                    'default'     => esc_html__( 'Default', 'mkdf-real-estate' ),
                    'large-width' => esc_html__( 'Large Width', 'mkdf-real-estate' )
                )
            )
        );        
    }

    add_action('mkdf_re_action_property_meta_fields', 'mkdf_re_map_property_masonry_meta', 17, 1);
}