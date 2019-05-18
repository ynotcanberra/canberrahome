<?php
if(!function_exists('mkdf_re_map_property_media_meta')) {
    function mkdf_re_map_property_media_meta($meta_box) {

        $property_media_container = zuhaus_mikado_add_admin_container(array(
            'type'            => 'container',
            'name'            => 'property_media_container',
            'parent'          => $meta_box
        ));

        zuhaus_mikado_add_admin_section_title(array(
            'title'           => esc_html__('Media', 'mkdf-real-estate'),
            'name'            => 'property_media_container_title',
            'parent'          => $property_media_container
        ));

        // Gallery Images meta field
        $property_image_gallery = new ZuhausMikadoMultipleImages("mkdf_property_image_gallery", esc_html__('Gallery Images', 'mkdf-real-estate'), esc_html__('Choose your gallery images', 'mkdf-real-estate'));
        $property_media_container->addChild("mkdf_property_image_gallery", $property_image_gallery);
        
        // Video meta field

        zuhaus_mikado_add_meta_box_field(
            array(
                'name'          => 'mkdf_property_video_type_meta',
                'type'          => 'select',
                'label'         => esc_html__( 'Video Type', 'mkdf-real-estate' ),
                'description'   => esc_html__( 'Choose video type', 'mkdf-real-estate' ),
                'parent'        => $property_media_container,
                'default_value' => 'social_networks',
                'options'       => array(
                    'social_networks' => esc_html__( 'Video Service', 'mkdf-real-estate' ),
                    'self'            => esc_html__( 'Self Hosted', 'mkdf-real-estate' )
                ),
                'args'          => array(
                    'dependence' => true,
                    'hide'       => array(
                        'social_networks' => '#mkdf_mkdf_video_self_hosted_container',
                        'self'            => '#mkdf_mkdf_video_embedded_container'
                    ),
                    'show'       => array(
                        'social_networks' => '#mkdf_mkdf_video_embedded_container',
                        'self'            => '#mkdf_mkdf_video_self_hosted_container'
                    )
                )
            )
        );

        $mkdf_video_embedded_container = zuhaus_mikado_add_admin_container(
            array(
                'parent'          => $property_media_container,
                'name'            => 'mkdf_video_embedded_container',
                'hidden_property' => 'mkdf_property_video_type_meta',
                'hidden_value'    => 'self'
            )
        );

        $mkdf_video_self_hosted_container = zuhaus_mikado_add_admin_container(
            array(
                'parent'          => $property_media_container,
                'name'            => 'mkdf_video_self_hosted_container',
                'hidden_property' => 'mkdf_video_type_meta',
                'hidden_value'    => 'social_networks'
            )
        );

        zuhaus_mikado_add_meta_box_field(
            array(
                'name'        => 'mkdf_property_video_link_meta',
                'type'        => 'text',
                'label'       => esc_html__( 'Video URL', 'mkdf-real-estate' ),
                'description' => esc_html__( 'Enter Video URL', 'mkdf-real-estate' ),
                'parent'      => $mkdf_video_embedded_container,
            )
        );

        zuhaus_mikado_add_meta_box_field(
            array(
                'name'        => 'mkdf_property_video_custom_meta',
                'type'        => 'text',
                'label'       => esc_html__( 'Video MP4', 'mkdf-real-estate' ),
                'description' => esc_html__( 'Enter video URL for MP4 format', 'mkdf-real-estate' ),
                'parent'      => $mkdf_video_self_hosted_container,
            )
        );

        zuhaus_mikado_add_meta_box_field(
            array(
                'name'        => 'mkdf_property_video_image_meta',
                'type'        => 'image',
                'label'       => esc_html__( 'Video Image', 'mkdf-real-estate' ),
                'description' => esc_html__( 'Enter video image', 'mkdf-real-estate' ),
                'parent'      => $property_media_container,
            )
        );

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_virtual_tour_meta',
            'type'        => 'textarea',
            'label'       => esc_html__('Virtual Tour Core', 'mkdf-real-estate'),
            'parent'      => $property_media_container
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_attachment_meta',
            'type'        => 'file',
            'label'       => esc_html__('Attachment', 'mkdf-real-estate'),
            'parent'      => $property_media_container
        ));
    }

    add_action('mkdf_re_action_property_meta_fields', 'mkdf_re_map_property_media_meta', 14, 1);
}