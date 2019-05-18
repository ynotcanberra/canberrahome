<?php

if (! function_exists('mkdf_re_owner_meta_options')) {
	function mkdf_re_owner_meta_options(){

		$owner_fields = zuhaus_mikado_add_user_fields(
			array(
				'scope' => array('owner'),
				'name'  => 'owner_fields'
			)
		);

		$agencies_array = mkdf_re_get_user_agency_options();

		$owner_group = zuhaus_mikado_add_user_group(
			array(
				'name'        => 'owner_group',
				'title'       => esc_html__( 'Owner Info', 'mkdf-real-estate' ),
				'parent'      => $owner_fields
			)
		);

		zuhaus_mikado_add_user_field(
			array(
				'name'        => 'mkdf_owner_telephone',
				'type'        => 'text',
				'label'       => esc_html__( 'Owner Telephone', 'mkdf-real-estate' ),
				'parent'      => $owner_group
			)
		);

		zuhaus_mikado_add_user_field(
			array(
				'name'        => 'mkdf_owner_mobile_phone',
				'type'        => 'text',
				'label'       => esc_html__( 'Owner Mobile Phone', 'mkdf-real-estate' ),
				'parent'      => $owner_group
			)
		);

		zuhaus_mikado_add_user_field(
			array(
				'name'        => 'mkdf_owner_fax_number',
				'type'        => 'text',
				'label'       => esc_html__( 'Owner Fax Number', 'mkdf-real-estate' ),
				'parent'      => $owner_group
			)
		);

		zuhaus_mikado_add_user_field(
			array(
				'name'        => 'mkdf_owner_address',
				'type'        => 'text',
				'label'       => esc_html__( 'Owner Address', 'mkdf-real-estate' ),
				'parent'      => $owner_group
			)
		);
	}

	add_action( 'zuhaus_mikado_custom_user_fields', 'mkdf_re_owner_meta_options' );
}