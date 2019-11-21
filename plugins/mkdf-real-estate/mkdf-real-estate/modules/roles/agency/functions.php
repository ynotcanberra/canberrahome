<?php

if (!function_exists('mkdf_re_agency_role_approved_filter')){
	function mkdf_re_agency_role_approved_filter($approved_roles){
		$approved_roles[] = 'agency';

		return $approved_roles;
	}
	add_filter('mkdf_real_estate_role_property_filter','mkdf_re_agency_role_approved_filter');
}

if ( ! function_exists( 'mkdf_re_dashboard_agency_pages' ) ) {
	function mkdf_re_dashboard_agency_pages( $navigation, $dashboard_url ) {

		$user = wp_get_current_user();

		if ( in_array( 'agency', $user->roles ) ) {

			//check if agent role exists
			if (wp_roles()->is_role('agent')) {
				$navigation['add-agent'] = array(
					'url'         => esc_url( add_query_arg( array( 'user-action' => 'add-agent' ), $dashboard_url ) ),
					'text'        => esc_html__( 'Add Agent', 'mkdf-real-estate' ),
					'user_action' => 'add-agent',
					'icon'        => '<span class="lnr lnr-user"></span>'
				);
				$navigation['all-agents'] = array(
					'url'         => esc_url( add_query_arg( array( 'user-action' => 'all-agents' ), $dashboard_url ) ),
					'text'        => esc_html__( 'All Agents', 'mkdf-real-estate' ),
					'user_action' => 'all-agents',
					'icon'        => '<span class="lnr lnr-users"></span>'
				);
			}
		}
		
		return $navigation;
	}
	
	add_filter( 'mkdf_membership_dashboard_navigation_pages', 'mkdf_re_dashboard_agency_pages', 12, 2 );
}

if ( ! function_exists( 'mkdf_re_add_agency_pages' ) ) {
	function mkdf_re_add_agency_pages( $pages ) {

		$user = wp_get_current_user();

		if ( in_array( 'agency', $user->roles ) ) {
			$all_agents_params = mkdf_re_get_all_agents();
			$agency_params = mkdf_re_get_agency_params();

			//check if agent role exists
			if (wp_roles()->is_role('agent')) {
				$pages['add-agent']    = mkdf_re_get_module_template_part( 'roles/agency/templates/add-agent', '', array());
				$pages['all-agents']    = mkdf_re_get_module_template_part( 'roles/agency/templates/all-agents', '', $all_agents_params);
			}

			$pages['profile']    = mkdf_re_get_module_template_part( 'roles/agency/templates/profile', '', $agency_params);
			$pages['edit-profile']    = mkdf_re_get_module_template_part( 'roles/agency/templates/edit-profile', '', $agency_params);
		}

		return $pages;
	}
	
	add_filter( 'mkdf_membership_dashboard_pages', 'mkdf_re_add_agency_pages' );
}


if ( ! function_exists( 'mkdf_re_add_agent_profile' ) ) {
	function mkdf_re_add_agent_profile() {

		if ( empty( $_POST ) || ! isset( $_POST ) ) {
			mkdf_re_ajax_status( 'error', esc_html__( 'All fields are empty', 'mkdf-real-estate' ) );
		} else {
			parse_str( $_POST['data'], $new_user_data );

			//Check nonce
			if ( wp_verify_nonce( $new_user_data['mkdf_nonce_add_agent_profile'], 'mkdf_validate_add_agent_profile' ) ) {

				$user_params = array();

				//Check if username already exists
				if ( username_exists($new_user_data['username']) ){
					mkdf_re_ajax_status( 'error', esc_html__( 'This username is taken, please try another.', 'mkdf-real-estate' ) );
				} else {
					$user_params['user_login'] = $new_user_data['username'];
				}

				//Check password
				if ( ! empty( $new_user_data['password'] ) ) {

					if ( $new_user_data['password'] === $new_user_data['password2'] ) {
						$user_params['user_pass'] = esc_attr( $new_user_data['password'] );
					} else {
						mkdf_re_ajax_status( 'error', esc_html__( 'Passwords don\'t match', 'mkdf-real-estate' ) );
					}

				}

				//Check email
				if ( ! empty( $new_user_data['email'] ) && filter_var( $new_user_data['email'], FILTER_VALIDATE_EMAIL ) ) {
					$user_params['user_email'] = esc_attr( $new_user_data['email'] );
				} else {
					mkdf_re_ajax_status( 'error', esc_html__( 'Error. Please insert valid email', 'mkdf-real-estate' ) );
				}

				$user_params['user_url'] = esc_url( $new_user_data['url'] );
				$user_params['first_name'] = esc_attr( $new_user_data['first_name'] );
				$user_params['last_name'] = esc_attr( $new_user_data['last_name'] );
				$user_params['description'] = esc_attr( $new_user_data['description'] );
				$user_params['role'] = 'agent';

				$user_id = wp_insert_user($user_params);
				if ( ! is_wp_error( $user_id ) ) {
					update_user_meta( $user_id, 'mkdf_belonging_agency', esc_attr( $new_user_data['agency'] ) );
					mkdf_re_ajax_status( 'success', esc_html__( 'Agent successfully added.', 'mkdf-real-estate' ) );
				} else {
					mkdf_re_ajax_status( 'error', esc_html__( 'Error.', 'mkdf-real-estate' ) );
				}				

			} else {
				mkdf_re_ajax_status( 'error', esc_html__( 'Error.', 'mkdf-real-estate' ) );
			}
		}
	}

	add_action( 'wp_ajax_mkdf_re_add_agent_profile', 'mkdf_re_add_agent_profile' );
}

if ( ! function_exists( 'mkdf_re_update_agency_profile' ) ) {
	function mkdf_re_update_agency_profile() {

		if ( empty( $_POST ) || ! isset( $_POST ) ) {
			mkdf_re_ajax_status( 'error', esc_html__( 'All fields are empty', 'mkdf-real-estate' ) );
		} else {
            $dashboard_url = mkdf_re_mkdf_membership_installed() ? mkdf_membership_get_dashboard_page_url() : '';
			parse_str( $_POST['data'], $update_data );

			//Check nonce
			if ( wp_verify_nonce( $update_data['mkdf_nonce_edit_agency_profile'], 'mkdf_validate_edit_agency_profile' ) ) {

				$user_id = get_current_user_id();
				if ( $user_id ) {

					//Update password
					if ( ! empty( $update_data['password'] ) ) {
						if ( $update_data['password'] === $update_data['password2'] ) {
							wp_update_user( array(
								'ID'        => $user_id,
								'user_pass' => esc_attr( $update_data['password'] )
							) );
						} else {
							mkdf_re_ajax_status( 'error', esc_html__( 'Passwords don\'t match', 'mkdf-real-estate' ) );
						}
					}

					//Update email
					if ( ! empty( $update_data['email'] ) && filter_var( $update_data['email'], FILTER_VALIDATE_EMAIL ) ) {
						wp_update_user( array( 'ID' => $user_id, 'user_email' => esc_attr( $update_data['email'] ) ) );
					} else {
						mkdf_re_ajax_status( 'error', esc_html__( 'Error. Please insert valid email', 'mkdf-real-estate' ) );
					}

					//Update Website
					wp_update_user( array( 'ID' => $user_id, 'user_url' => esc_url( $update_data['url'] ) ) );

					//Update user meta
					update_user_meta( $user_id, 'mkdf_agency_name', $update_data['mkdf_agency_name'] );
					update_user_meta( $user_id, 'mkdf_agency_licence', $update_data['mkdf_agency_licence'] );
					update_user_meta( $user_id, 'mkdf_agency_telephone', $update_data['mkdf_agency_telephone'] );
					update_user_meta( $user_id, 'mkdf_agency_mobile_phone', $update_data['mkdf_agency_mobile_phone'] );
					update_user_meta( $user_id, 'mkdf_agency_fax_number', $update_data['mkdf_agency_fax_number'] );
					update_user_meta( $user_id, 'mkdf_agency_address', $update_data['mkdf_agency_address'] );
					update_user_meta( $user_id, 'description', $update_data['description'] );

					mkdf_re_ajax_status( 'success', esc_html__( 'Your profile is updated', 'mkdf-real-estate' ), $dashboard_url );

				} else {
					mkdf_re_ajax_status( 'error', esc_html__( 'You are unauthorized to perform this action.', 'mkdf-real-estate' ) );
				}			

			} else {
				mkdf_re_ajax_status( 'error', esc_html__( 'Error.', 'mkdf-real-estate' ) );
			}
		}
	}

	add_action( 'wp_ajax_mkdf_re_update_agency_profile', 'mkdf_re_update_agency_profile' );
}

if (! function_exists('mkdf_re_get_all_agents')) {
	function mkdf_re_get_all_agents() {
		$params = array();
		$agency_id = get_current_user_id();

		//check if agent role exists
		if (wp_roles()->is_role('agent')) {

			$query_args = array(
				'role' => 'agent',
				'meta_key' => 'mkdf_belonging_agency',
				'meta_value' => $agency_id
			);

			$agents_query = get_users($query_args);

			foreach ($agents_query as $agent) {
				$agent_params = array();
				$agent_data = $agent->data;

				$agent_params['id'] = $agent_data->ID;
				$agent_params['name'] = $agent_data->display_name;
				$agent_params['email'] = $agent_data->user_email;
				$agent_params['telephone'] = get_user_meta($agent_data->ID, 'mkdf_agent_telephone', true);
				$agent_params['mobile'] = get_user_meta($agent_data->ID, 'mkdf_agent_mobile_phone', true);
				$agent_params['address'] = get_user_meta($agent_data->ID, 'mkdf_agent_address', true);
				$agent_params['position'] = get_user_meta($agent_data->ID, 'mkdf_agent_position', true);

				$params['agents'][] = $agent_params;
			}
		}

		return $params;
	}
}

if ( ! function_exists( 'mkdf_re_get_agency_params' ) ) {
	/**
	 * Returns agency params
	 *
	 */
	function mkdf_re_get_agency_params() {
		$params = array();

		$user_id = get_current_user_id();

		$params['mkdf_agency_name']  = get_user_meta($user_id, 'mkdf_agency_name', true);
		$params['mkdf_agency_licence']  = get_user_meta($user_id, 'mkdf_agency_licence', true);
		$params['email']       = get_the_author_meta('email', $user_id);
		$params['website']     = get_the_author_meta('url', $user_id);
		$params['description']  = get_user_meta($user_id, 'description', true);
		$params['mkdf_agency_telephone']  = get_user_meta($user_id, 'mkdf_agency_telephone', true);
		$params['mkdf_agency_mobile_phone']  = get_user_meta($user_id, 'mkdf_agency_mobile_phone', true);
		$params['mkdf_agency_fax_number']  = get_user_meta($user_id, 'mkdf_agency_fax_number', true);
		$params['mkdf_agency_address']  = get_user_meta($user_id, 'mkdf_agency_address', true);
		$profile_image         = get_user_meta($user_id, 'social_profile_image', true);

		if ( $profile_image == '' ) {
			$profile_image = get_avatar( $user_id, 96 );
		} else {
			$profile_image = '<img src="' . esc_url( $profile_image ) . '">';
		}
		$params['profile_image'] = $profile_image;

		return $params;
	}
}

if (! function_exists('mkdf_re_get_user_agency_options')){
	function mkdf_re_get_user_agency_options(){
		$agencies_array = array();

		$agencies = get_users(array('role' => 'agency'));

		foreach ($agencies as $agency) {
			$agencies_array[$agency->ID] = $agency->user_nicename;
		}

		return $agencies_array;
	}
}