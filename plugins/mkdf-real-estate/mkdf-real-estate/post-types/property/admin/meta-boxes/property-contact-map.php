<?php
if(!function_exists('mkdf_re_map_property_contact_meta')) {
    function mkdf_re_map_property_contact_meta($meta_box) {

        $property_contact_container = zuhaus_mikado_add_admin_container(array(
            'type'            => 'container',
            'name'            => 'property_contact_container',
            'parent'          => $meta_box
        ));

        zuhaus_mikado_add_admin_section_title(array(
            'title'           => esc_html__('Contact Information', 'mkdf-real-estate'),
            'name'            => 'property_contact_container_title',
            'parent'          => $property_contact_container
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_contact_info_meta',
            'type'        => 'select',
            'label'       => esc_html__('Contact Info to Display', 'mkdf-real-estate'),
            'description' => esc_html__('Chose what info will be displayed', 'mkdf-real-estate'),
            'parent'      => $property_contact_container,
            'options'     => array(
                ''          => esc_html__( 'None', 'mkdf-real-estate' ),
                'agency'    => esc_html__( 'Agency Info', 'mkdf-real-estate' ),
                'agent'     => esc_html__( 'Agent Info', 'mkdf-real-estate' ),
                'owner'     => esc_html__( 'Owner Info', 'mkdf-real-estate' )
            ),
            'args'			=> array(
            	'dependence' => true,
            	'show' => array(
            		'' => '',
            		'agency' => '#mkdf_property_contact_agency_container',
            		'agent' => '#mkdf_property_contact_agent_container',
            		'owner' => '#mkdf_property_contact_owner_container',
        		),
        		'hide' => array(
            		'' => '#mkdf_property_contact_agency_container, #mkdf_property_contact_agent_container, #mkdf_property_contact_owner_container',
            		'agency' => '#mkdf_property_contact_agent_container, #mkdf_property_contact_owner_container',
            		'agent' => '#mkdf_property_contact_agency_container, #mkdf_property_contact_owner_container',
            		'owner' => '#mkdf_property_contact_agency_container, #mkdf_property_contact_agent_container',
    			)
        	)
        ));

        $property_contact_agency_container = zuhaus_mikado_add_admin_container(array(
            'type'            => 'container',
            'name'            => 'property_contact_agency_container',
            'parent'          => $property_contact_container,
			'hidden_property' => 'mkdf_property_contact_info_meta',
			'hidden_values'   => array(
				'',
				'agent',
				'owner'
			)
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_contact_agency_meta',
            'type'        => 'selectblank',
            'label'       => esc_html__('Agency', 'mkdf-real-estate'),
            'description' => esc_html__('Chose agency to be displayed', 'mkdf-real-estate'),
            'parent'      => $property_contact_agency_container,
        	'options'	  => mkdf_re_get_user_agency_options(),
    	));


        $property_contact_agent_container = zuhaus_mikado_add_admin_container(array(
            'type'            => 'container',
            'name'            => 'property_contact_agent_container',
            'parent'          => $property_contact_container,
			'hidden_property' => 'mkdf_property_contact_info_meta',
			'hidden_values'   => array(
				'',
				'agency',
				'owner'
			)
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_contact_agent_meta',
            'type'        => 'selectblank',
            'label'       => esc_html__('Agent', 'mkdf-real-estate'),
            'description' => esc_html__('Chose agent to be displayed', 'mkdf-real-estate'),
            'parent'      => $property_contact_agent_container,
        	'options'	  => mkdf_re_get_user_agent_options(),
    	));

        $property_contact_owner_container = zuhaus_mikado_add_admin_container(array(
            'type'            => 'container',
            'name'            => 'property_contact_owner_container',
            'parent'          => $property_contact_container,
			'hidden_property' => 'mkdf_property_contact_info_meta',
			'hidden_values'   => array(
				'',
				'agency',
				'agent'
			)
        ));

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_property_contact_owner_meta',
            'type'        => 'selectblank',
            'label'       => esc_html__('Owner', 'mkdf-real-estate'),
            'description' => esc_html__('Chose owner to be displayed', 'mkdf-real-estate'),
            'parent'      => $property_contact_owner_container,
        	'options'	  => mkdf_re_get_user_owner_options(),
    	));
    }

    add_action('mkdf_re_action_property_meta_fields', 'mkdf_re_map_property_contact_meta', 17, 1);
}