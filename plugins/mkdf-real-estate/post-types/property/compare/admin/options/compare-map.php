<?php

if ( ! function_exists( 'mkdf_real_estate_compare_options_map' ) ) {
    function mkdf_real_estate_compare_options_map($panel_general) {

        zuhaus_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'enable_property_comparing',
                'default_value' => 'no',
                'label'         => esc_html__( 'Enable property comparing', 'mkdf-real-estate' ),
                'description'   => esc_html__( 'Enabling this option will enable comparison between properties', 'mkdf-real-estate' ),
                'parent'        => $panel_general,
                'args'          => array(
                    'col_width' => 3
                )
            )
        );
	
	    $compare_single_container = zuhaus_mikado_add_admin_container(
		    array(
			    'name'            => 'mkdf_re_compare_single_container',
			    'parent'          => $panel_general,
			    'dependency' => array(
				    'show' => array(
					    'enable_property_comparing' => 'yes'
				    )
			    )
		    )
	    );
	
	    zuhaus_mikado_add_admin_field(
		    array(
			    'type'          => 'yesno',
			    'name'          => 'enable_property_comparing_single',
			    'default_value' => 'no',
			    'label'         => esc_html__( 'Compare on Single Property', 'mkdf-real-estate' ),
			    'description'   => esc_html__( 'Enabling this option will display compare button on single property page', 'mkdf-real-estate' ),
			    'parent'        => $compare_single_container,
			    'args'          => array(
				    'col_width' => 3
			    )
		    )
	    );
    }

    add_action( 'zuhaus_mikado_additional_real_estate_options_map', 'mkdf_real_estate_compare_options_map', 11, 1 );
}