<?php

if (! function_exists('mkdf_re_agency_meta_options')) {
	function mkdf_re_agency_meta_options(){

		$agency_fields = zuhaus_mikado_add_user_fields(
			array(
				'scope' => array('agency'),
				'name'  => 'agency_fields'
			)
		);

		$agency_group = zuhaus_mikado_add_user_group(
			array(
				'name'        => 'agency_group',
				'title'       => esc_html__( 'Agency Info', 'mkdf-real-estate' ),
				'parent'      => $agency_fields
			)
		);
		
		zuhaus_mikado_add_user_field(
			array(
				'name'        => 'mkdf_agency_name',
				'type'        => 'text',
				'label'       => esc_html__( 'Agency Name', 'mkdf-real-estate' ),
				'parent'      => $agency_group
			)
		);
		
		zuhaus_mikado_add_user_field(
			array(
				'name'        => 'mkdf_agency_licence',
				'type'        => 'text',
				'label'       => esc_html__( 'Agency Licence', 'mkdf-real-estate' ),
				'parent'      => $agency_group
			)
		);

		zuhaus_mikado_add_user_field(
			array(
				'name'        => 'mkdf_agency_telephone',
				'type'        => 'text',
				'label'       => esc_html__( 'Agency Telephone', 'mkdf-real-estate' ),
				'parent'      => $agency_group
			)
		);

		zuhaus_mikado_add_user_field(
			array(
				'name'        => 'mkdf_agency_mobile_phone',
				'type'        => 'text',
				'label'       => esc_html__( 'Agency Mobile Phone', 'mkdf-real-estate' ),
				'parent'      => $agency_group
			)
		);

		zuhaus_mikado_add_user_field(
			array(
				'name'        => 'mkdf_agency_fax_number',
				'type'        => 'text',
				'label'       => esc_html__( 'Agency Fax Number', 'mkdf-real-estate' ),
				'parent'      => $agency_group
			)
		);

		zuhaus_mikado_add_user_field(
			array(
				'name'        => 'mkdf_agency_address',
				'type'        => 'text',
				'label'       => esc_html__( 'Agency Address', 'mkdf-real-estate' ),
				'parent'      => $agency_group
			)
		);
	}

	add_action( 'zuhaus_mikado_custom_user_fields', 'mkdf_re_agency_meta_options' );
}