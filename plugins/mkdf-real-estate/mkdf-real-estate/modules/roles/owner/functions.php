<?php

if (!function_exists('mkdf_re_owner_role_approved_filter')){
	function mkdf_re_owner_role_approved_filter($approved_roles){

		$owner_approved = zuhaus_mikado_options()->getOptionValue('real_estate_owner_adding_property');

		if ($owner_approved == 'yes') {
			$approved_roles[] = 'owner';
		}		

		return $approved_roles;
	}
	add_filter('mkdf_real_estate_role_property_filter','mkdf_re_owner_role_approved_filter');
}

if ( ! function_exists( 'mkdf_re_add_owner_pages' ) ) {
	function mkdf_re_add_owner_pages( $pages ) {

		$user = wp_get_current_user();

		if ( in_array( 'owner', $user->roles ) ) {
			$owner_params = mkdf_re_get_owner_params();

			$pages['profile']    = mkdf_re_get_module_template_part( 'roles/owner/templates/profile', '', $owner_params);
			$pages['edit-profile']    = mkdf_re_get_module_template_part( 'roles/owner/templates/edit-profile', '', $owner_params);
		}

		return $pages;
	}
	
	add_filter( 'mkdf_membership_dashboard_pages', 'mkdf_re_add_owner_pages' );
}

if ( ! function_exists( 'mkdf_re_update_owner_profile' ) ) {
	function mkdf_re_update_owner_profile() {

		if ( empty( $_POST ) || ! isset( $_POST ) ) {
			mkdf_re_ajax_status( 'error', esc_html__( 'All fields are empty', 'mkdf-real-estate' ) );
		} else {
            $dashboard_url = mkdf_re_mkdf_membership_installed() ? mkdf_membership_get_dashboard_page_url() : '';
			parse_str( $_POST['data'], $update_data );

			//Check nonce
			if ( wp_verify_nonce( $update_data['mkdf_nonce_edit_owner_profile'], 'mkdf_validate_edit_owner_profile' ) ) {

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
					update_user_meta( $user_id, 'first_name', $update_data['first_name'] );
					update_user_meta( $user_id, 'last_name', $update_data['last_name'] );
					update_user_meta( $user_id, 'mkdf_owner_telephone', $update_data['mkdf_owner_telephone'] );
					update_user_meta( $user_id, 'mkdf_owner_mobile_phone', $update_data['mkdf_owner_mobile_phone'] );
					update_user_meta( $user_id, 'mkdf_owner_fax_number', $update_data['mkdf_owner_fax_number'] );
					update_user_meta( $user_id, 'mkdf_owner_address', $update_data['mkdf_owner_address'] );
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

	add_action( 'wp_ajax_mkdf_re_update_owner_profile', 'mkdf_re_update_owner_profile' );
}

if ( ! function_exists( 'mkdf_re_get_owner_params' ) ) {
	/**
	 * Returns owner params
	 *
	 */
	function mkdf_re_get_owner_params() {
		$params = array();

		$user_id = get_current_user_id();

		$params['first_name']  = get_the_author_meta( 'first_name', $user_id );
		$params['last_name']   = get_the_author_meta( 'last_name', $user_id );
		$params['email']       = get_the_author_meta('email', $user_id);
		$params['website']     = get_the_author_meta('url', $user_id);
		$params['description']  = get_user_meta($user_id, 'description', true);
		$params['mkdf_owner_telephone']  = get_user_meta($user_id, 'mkdf_owner_telephone', true);
		$params['mkdf_owner_mobile_phone']  = get_user_meta($user_id, 'mkdf_owner_mobile_phone', true);
		$params['mkdf_owner_fax_number']  = get_user_meta($user_id, 'mkdf_owner_fax_number', true);
		$params['mkdf_owner_address']  = get_user_meta($user_id, 'mkdf_owner_address', true);
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

if (! function_exists('mkdf_re_get_user_owner_options')){
	function mkdf_re_get_user_owner_options(){
		$owners_array = array();

		$owners = get_users(array('role' => 'owner'));

		foreach ($owners as $owner) {
			$owners_array[$owner->ID] = $owner->user_nicename;
		}

		return $owners_array;
	}
}