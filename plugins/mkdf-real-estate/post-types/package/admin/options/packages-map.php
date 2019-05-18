<?php

if ( ! function_exists('mkdf_real_estate_packages_options_map') ) {

    function mkdf_real_estate_packages_options_map() {
        $pages       = get_all_page_ids();
        $pages_array = array();
        foreach ( $pages as $page ) {
            if ( get_post_status( $page ) == 'publish' ) {
                $pages_array[ $page ] = get_the_title( $page );
            }
        }

        $panel_packages = zuhaus_mikado_add_admin_panel( array(
            'title' => esc_html__('Pricing Packages', 'mkdf-real-estate'),
            'name'  => 'panel_packages',
            'page'  => '_real_estate'
        ) );


        zuhaus_mikado_add_admin_field(
            array(
                'name'          => 'enable_packages_necessity',
                'type'          => 'yesno',
                'label'         => esc_html__( 'Enable Pricing Package Necessity for Adding Property', 'mkdf-real-estate' ),
                'parent'        => $panel_packages,
                'default_value' => 'yes',
                'description'	=> esc_html__('Enable this option in order to make packages necessary for adding property','mkdf-real-estate'),
                'args'			=> array(
                	'dependence' => true,
                	'dependence_show_on_yes' => '#mkdf_enabled_package',
                	'dependence_hide_on_yes' => '',
            	)
            )
        );

		$enabled_package_container = zuhaus_mikado_add_admin_container(
			array(
				'parent'          => $panel_packages,
				'name'            => 'enabled_package',
				'hidden_property' => 'enable_packages_necessity',
				'hidden_value'    => 'no'
			)
		);

        zuhaus_mikado_add_admin_field(
            array(
                'name'        => 'packages_default_page',
                'type'        => 'select',
                'label'       => esc_html__( 'Pricing Packages Page', 'mkdf-real-estate' ),
                'description' => esc_html__( 'Choose a page to be default for displaying pricing packages. (You should add pricing package shortcode on that page)', 'mkdf-real-estate' ),
                'parent'      => $enabled_package_container,
                'options'     => $pages_array,
                'args'        => array(
                    'select2' => true
                )
            )
        );

        zuhaus_mikado_add_admin_field(
            array(
                'name'          => 'enable_payment_autocomplete',
                'type'          => 'yesno',
                'label'         => esc_html__( 'Payment Autocomplete', 'mkdf-real-estate' ),
                'parent'        => $enabled_package_container,
                'default_value' => 'no',
                'description'	=> esc_html__('Use this option if your are using non-card payment methods to enable autocomplete of user purchases.','mkdf-real-estate')
            )
        );
    }

    add_action( 'zuhaus_mikado_additional_real_estate_options_map', 'mkdf_real_estate_packages_options_map', 14);
}