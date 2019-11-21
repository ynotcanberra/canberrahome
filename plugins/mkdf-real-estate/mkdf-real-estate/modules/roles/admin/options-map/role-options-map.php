<?php
if ( ! function_exists('mkdf_real_estate_roles_options_map') ) {

    function mkdf_real_estate_roles_options_map($panel) {

        zuhaus_mikado_add_admin_field(
            array(
                'name'          => 'real_estate_registration_role_enabled',
                'type'          => 'yesno',
                'label'         => esc_html__( 'Enable Registration Role', 'mkdf-real-estate' ),
                'description'   => esc_html__( 'Enable this if you want to allow users to choose role upon registration. Otherwise, default role from WP Settings -> General will be used.', 'mkdf-real-estate' ),
                'parent'        => $panel,
                'default_value' => 'yes',
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkdf_role_settings_container'
                )
            )
        );

        $role_settings_container = zuhaus_mikado_add_admin_container(
            array(
                'type'            => 'container',
                'name'            => 'role_settings_container',
                'parent'          => $panel,
                'hidden_property' => 'real_estate_registration_role_enabled',
                'hidden_value'    => 'no'
            )
        );

        zuhaus_mikado_add_admin_field(
            array(
                'name'          => 'real_estate_enable_owner_role',
                'type'          => 'yesno',
                'label'         => esc_html__( 'Enable Owner/Buyer Role', 'mkdf-real-estate' ),
                'parent'        => $role_settings_container,
                'default_value' => 'yes',
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkdf_owner_container'
                )
            )
        );

        $owner_container = zuhaus_mikado_add_admin_container(
            array(
                'type'            => 'container',
                'name'            => 'owner_container',
                'parent'          => $role_settings_container,
                'hidden_property' => 'real_estate_enable_owner_role',
                'hidden_value'    => 'no'
            )
        );

        zuhaus_mikado_add_admin_field(
            array(
                'name'          => 'real_estate_owner_adding_property',
                'type'          => 'yesno',
                'label'         => esc_html__( 'Enable Adding Property for Owner/Buyer', 'mkdf-real-estate' ),
                'parent'        => $owner_container,
                'default_value' => 'yes'
            )
        );

        zuhaus_mikado_add_admin_field(
            array(
                'name'          => 'real_estate_enable_agent_role',
                'type'          => 'yesno',
                'label'         => esc_html__( 'Enable Agent Role', 'mkdf-real-estate' ),
                'parent'        => $role_settings_container,
                'default_value' => 'yes'
            )
        );

        zuhaus_mikado_add_admin_field(
            array(
                'name'          => 'real_estate_enable_agency_role',
                'type'          => 'yesno',
                'label'         => esc_html__( 'Enable Agency Role', 'mkdf-real-estate' ),
                'parent'        => $role_settings_container,
                'default_value' => 'yes'
            )
        );

        zuhaus_mikado_add_admin_field(
            array(
                'name'          => 'real_estate_enable_publish_from_user',
                'type'          => 'yesno',
                'label'         => esc_html__( 'Enable Publishing Properties for Users', 'mkdf-real-estate' ),
                'parent'        => $role_settings_container,
                'default_value' => 'no'
            )
        );


    }

    add_action('zuhaus_mikado_additional_real_estate_options_map', 'mkdf_real_estate_roles_options_map');
}