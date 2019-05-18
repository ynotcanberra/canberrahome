<?php

if (! function_exists('mkdf_re_agent_meta_options')) {
	function mkdf_re_agent_meta_options(){

		$agent_fields = zuhaus_mikado_add_user_fields(
			array(
				'scope' => array('agent'),
				'name'  => 'agent_fields'
			)
		);

		$agencies_array = mkdf_re_get_user_agency_options();

		$agent_group = zuhaus_mikado_add_user_group(
			array(
				'name'        => 'agent_group',
				'title'       => esc_html__( 'Agent Info', 'mkdf-real-estate' ),
				'parent'      => $agent_fields
			)
		);
		
		zuhaus_mikado_add_user_field(
			array(
				'name'        => 'mkdf_belonging_agency',
				'type'        => 'select',
				'label'       => esc_html__( 'Agency', 'mkdf-real-estate' ),
				'options'     => $agencies_array,
				'parent'      => $agent_group
			)
		);

		zuhaus_mikado_add_user_field(
			array(
				'name'        => 'mkdf_agent_position',
				'type'        => 'text',
				'label'       => esc_html__( 'Agent Position', 'mkdf-real-estate' ),
				'parent'      => $agent_group
			)
		);
		
		zuhaus_mikado_add_user_field(
			array(
				'name'        => 'mkdf_agent_licence',
				'type'        => 'text',
				'label'       => esc_html__( 'Agent Licence', 'mkdf-real-estate' ),
				'parent'      => $agent_group
			)
		);

		zuhaus_mikado_add_user_field(
			array(
				'name'        => 'mkdf_agent_telephone',
				'type'        => 'text',
				'label'       => esc_html__( 'Agent Telephone', 'mkdf-real-estate' ),
				'parent'      => $agent_group
			)
		);

		zuhaus_mikado_add_user_field(
			array(
				'name'        => 'mkdf_agent_mobile_phone',
				'type'        => 'text',
				'label'       => esc_html__( 'Agent Mobile Phone', 'mkdf-real-estate' ),
				'parent'      => $agent_group
			)
		);

		zuhaus_mikado_add_user_field(
			array(
				'name'        => 'mkdf_agent_fax_number',
				'type'        => 'text',
				'label'       => esc_html__( 'Agent Fax Number', 'mkdf-real-estate' ),
				'parent'      => $agent_group
			)
		);

		zuhaus_mikado_add_user_field(
			array(
				'name'        => 'mkdf_agent_address',
				'type'        => 'text',
				'label'       => esc_html__( 'Agent Address', 'mkdf-real-estate' ),
				'parent'      => $agent_group
			)
		);
	}

	add_action( 'zuhaus_mikado_custom_user_fields', 'mkdf_re_agent_meta_options' );
}