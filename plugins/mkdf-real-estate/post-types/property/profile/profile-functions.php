<?php

if ( ! function_exists( 'mkdf_re_add_profile_navigation_item' ) ) {
	function mkdf_re_add_profile_navigation_item( $navigation, $dashboard_url ) {
		
		$user = wp_get_current_user();
		
		$navigation['property-favorites'] = array(
			'url'         => esc_url( add_query_arg( array( 'user-action' => 'property-favorites' ), $dashboard_url ) ),
			'text'        => esc_html__( 'Property Wishlist', 'mkdf-real-estate' ),
			'user_action' => 'property-favorites',
			'icon'        => '<span class="lnr lnr-heart"></span>'
		);

        $navigation['property-searches'] = array(
            'url'         => esc_url( add_query_arg( array( 'user-action' => 'property-searches' ), $dashboard_url ) ),
            'text'        => esc_html__( 'Saved Searches', 'mkdf-real-estate' ),
            'user_action' => 'property-searches',
			'icon'        => '<span class="lnr lnr-magnifier"></span>'
        );

		//Check if role in approved roles
		if ( mkdf_re_approved_user_roles($user->roles ) ) {

			if (post_type_exists('property')) {
				$navigation['list-properties'] = array(
					'url'         => esc_url( add_query_arg( array( 'user-action' => 'list-properties' ), $dashboard_url ) ),
					'text'        => esc_html__( 'My Properties', 'mkdf-real-estate' ),
					'user_action' => 'list-properties',
					'icon'        => '<span class="lnr lnr-text-align-left"></span>'
				);

				$package = mkdf_re_property_addition_enabled();

				//stongly false because of the 0 key for packages
				if ($package !== false) {
					$add_property_url = esc_url( add_query_arg( array( 'user-action' => 'add-property' ), $dashboard_url ) );
				} else {
					$add_property_url = mkdf_re_get_pricing_packages_page();
				}

				$navigation['add-property'] = array(
					'url'         => $add_property_url,
					'text'        => esc_html__( 'Add Property', 'mkdf-real-estate' ),
					'user_action' => 'add-property',
					'icon'        => '<span class="lnr lnr-file-add"></span>'
				);

			}
		}
		
		return $navigation;
	}
	
	add_filter( 'mkdf_membership_dashboard_navigation_pages', 'mkdf_re_add_profile_navigation_item', 10, 2 );
}

if ( ! function_exists( 'mkdf_re_add_profile_navigation_pages' ) ) {
	function mkdf_re_add_profile_navigation_pages( $pages ) {
		$user = wp_get_current_user();

		$dashboard_url = mkdf_re_mkdf_membership_installed() ? mkdf_membership_get_dashboard_page_url() : '';
		$list_params['query_args'] = mkdf_re_all_user_properties_query();
		$list_params['dashboard_url'] = $dashboard_url;
		$add_property_params = mkdf_re_get_add_property_params();

		$pages['property-favorites']    = mkdf_re_cpt_single_module_template_part( 'profile/templates/favorites-list', 'property' );
		$pages['property-searches']     = mkdf_re_cpt_single_module_template_part( 'profile/templates/searches-list', 'property' );

		//Check if role in approved roles
		if ( mkdf_re_approved_user_roles($user->roles ) ) {
			$pages['list-properties']    = mkdf_re_cpt_single_module_template_part( 'profile/templates/user-properties-list', 'property', '', $list_params );
			$pages['add-property']    = mkdf_re_cpt_single_module_template_part( 'profile/templates/add-property', 'property', '', $add_property_params);
			$pages['edit-property']    = mkdf_re_cpt_single_module_template_part( 'profile/templates/edit-property', 'property' );
		}

		return $pages;
	}
	
	add_filter( 'mkdf_membership_dashboard_pages', 'mkdf_re_add_profile_navigation_pages' );
}

if ( ! function_exists( 'mkdf_re_add_property_to_wishlist' ) ) {
    function mkdf_re_add_property_to_wishlist() {
        $user_id = get_current_user_id();
        $number_of_favs = mkdf_re_get_number_of_item_wishlist();

        if ( empty( $_POST ) || ! isset( $_POST ) ) {
            mkdf_re_ajax_status( 'error', esc_html__( 'All fields are empty', 'mkdf-real-estate' ) );
        } else {
            $property_id            = $_POST['property_id'];
            $current_property_array = get_user_meta( $user_id, 'mkdf_property_wishlist', true );
            $current_users_array    = get_post_meta( $property_id, 'mkdf_users_wishlist', true );
            $current_property_array = !empty( $current_property_array ) ? $current_property_array : array();
            $current_users_array 	= !empty( $current_users_array ) ? $current_users_array : array();
            if ( ! empty( $current_property_array ) && in_array( $property_id, $current_property_array ) ) {
                $temp_array[]           = $property_id;
                $current_property_array = array_diff( $current_property_array, $temp_array );
                $number_of_favs = $number_of_favs > 0 ? $number_of_favs-- : 0;
                $data['message']        = $number_of_favs;
                $data['icon']           = 'fa-heart-o';
            } else {
                $current_property_array[]   = $property_id;
                $current_property_array     = array_unique( $current_property_array );
                $number_of_favs++;
                $data['message']            = $number_of_favs;
                $data['icon']               = 'fa-heart';
            }

            update_user_meta( $user_id, 'mkdf_property_wishlist', $current_property_array );

            if ( ! empty( $current_users_array ) && in_array( $user_id, $current_users_array ) ) {
                $temp_array[]        = $user_id;
                $current_users_array = array_diff( $current_users_array, $temp_array );
            } else {
                $current_users_array[] = $user_id;
                $current_users_array   = array_unique( $current_users_array );
            }
            update_post_meta( $property_id, 'mkdf_users_wishlist', $current_users_array );

            mkdf_re_ajax_status( 'success', '', $data );
        }

        wp_die();
    }

    add_action( 'wp_ajax_nopriv_mkdf_re_add_property_to_wishlist', 'mkdf_re_add_property_to_wishlist' );
    add_action( 'wp_ajax_mkdf_re_add_property_to_wishlist', 'mkdf_re_add_property_to_wishlist' );
}

if ( ! function_exists( 'mkdf_re_is_property_in_wishlist' ) ) {
    function mkdf_re_is_property_in_wishlist( $id = '' ) {
        $property_id = ( $id != '' ? $id : get_the_ID() );
        $properties   = get_user_meta( get_current_user_id(), 'mkdf_property_wishlist', true );

        if ( ! empty( $properties ) && in_array( $property_id, $properties ) ) {
            return true;
        }

        return false;
    }
}

if ( ! function_exists( 'mkdf_re_get_number_of_item_wishlist' ) ) {
    function mkdf_re_get_number_of_item_wishlist( $id = '' ) {
        $id = $id == '' ? get_the_ID() : $id;

        $number_of_fav = get_post_meta( $id, 'mkdf_users_wishlist', true );

        if ( $number_of_fav != '' && is_array( $number_of_fav ) ) {
            return count( $number_of_fav );
        }

        return 0;
    }
}

if ( ! function_exists( 'mkdf_re_get_wishlist_button' ) ) {
    function mkdf_re_get_wishlist_button() {
        if ( ! mkdf_re_is_property_in_wishlist() ) {
            $icon = 'fa-heart-o';
        } else {
            $icon = 'fa-heart';
        }
        $text = mkdf_re_get_number_of_item_wishlist();
        $wishlist_params = array(
            'wishlist_text' => $text,
            'wishlist_icon' => $icon
        );
        mkdf_re_get_cpt_single_module_template_part( 'profile/templates/parts/wishlist', 'property', '', $wishlist_params );
    }
}


/*
* Function for adding new property
*/

if ( ! function_exists( 'mkdf_re_add_property' ) ) {
	function mkdf_re_add_property() {

		if ( empty( $_POST ) || ! isset( $_POST ) ) {
			mkdf_re_ajax_status( 'error', esc_html__( 'All fields are empty', 'mkdf-real-estate' ) );
		} else {
            $dashboard_url = mkdf_re_mkdf_membership_installed() ? mkdf_membership_get_dashboard_page_url() : '';
			$published = zuhaus_mikado_options()->getOptionValue('real_estate_enable_publish_from_user');
			parse_str( $_POST['data'], $new_property_data );

			$user = wp_get_current_user();

			//Check nonce
			if ( wp_verify_nonce( $new_property_data['mkdf_nonce_add_property'], 'mkdf_validate_add_property' ) && mkdf_re_approved_user_roles($user->roles ) ) {
				$property_params = array();
				$property_params['meta_input'] = array();
				$property_params['tax_input'] = array();
				$property_ids = array();

				$query_args = array(
					'post_status'    => 'publish',
					'post_type'      => 'property',
				);

				$query_results = new \WP_Query( $query_args );

				if($query_results->have_posts()):
					while ( $query_results->have_posts() ) : $query_results->the_post();
						$id = get_the_ID();
						if (get_post_meta($id,'mkdf_property_id_meta',true) !== ''){
							$property_ids[] = get_post_meta($id,'mkdf_property_id_meta',true);
						}
					endwhile;
				endif;

				//Check if property id already exists
				if ( in_array($new_property_data['property_id'], $property_ids) ){					
					mkdf_re_ajax_status( 'error', esc_html__( 'This property ID is taken, please try another.', 'mkdf-real-estate' ) );
				} else {
					$property_params['meta_input']['mkdf_property_id_meta'] = $new_property_data['property_id'];
				}

				if ($new_property_data['property_title'] == ''){					
					mkdf_re_ajax_status( 'error', esc_html__( 'Please enter property title', 'mkdf-real-estate' ) );
				}
				
				$property_params['post_title'] = $new_property_data['property_title'];
				$property_params['post_type'] = 'property';
				$property_params['post_content'] = $new_property_data['property_description'];

				if ( is_array($new_property_data['property_type']) && count($new_property_data['property_type']) ) {
					$property_params['tax_input']['property-type'] = $new_property_data['property_type'];
				}

				if ( is_array($new_property_data['property_feature']) && count($new_property_data['property_feature']) ) {
					$property_params['tax_input']['property-feature'] = $new_property_data['property_feature'];
				}

				if ( is_array($new_property_data['property_status']) && count($new_property_data['property_status']) ) {
					$property_params['tax_input']['property-status'] = $new_property_data['property_status'];
				}

				if ( is_array($new_property_data['property_county']) && count($new_property_data['property_county']) ) {
					$property_params['tax_input']['property-county'] = $new_property_data['property_county'];
				}

				if ( is_array($new_property_data['property_city']) && count($new_property_data['property_city']) ) {
					$property_params['tax_input']['property-city'] = $new_property_data['property_city'];
				}

				if ( is_array($new_property_data['property_neighborhood']) && count($new_property_data['property_neighborhood']) ) {
					$property_params['tax_input']['property-neighborhood'] = $new_property_data['property_neighborhood'];
				}
				
				//property_tag is non-hierahical, so it must be assigned as string of slugs so it doesn't create new tag
				if ( is_array($new_property_data['property_tag']) && count($new_property_data['property_tag']) ) {
					$property_params['tax_input']['property-tag'] = implode(', ', $new_property_data['property_tag']);
				}

				$property_params['meta_input']['mkdf_property_price_meta'] = $new_property_data['price'];
				$property_params['meta_input']['mkdf_property_discount_price_meta'] = $new_property_data['discount_price'];
				$property_params['meta_input']['mkdf_property_price_label_meta'] = $new_property_data['price_label'];
				$property_params['meta_input']['mkdf_property_price_label_position_meta'] = $new_property_data['price_label_position'];
				$property_params['meta_input']['mkdf_property_size_meta'] = $new_property_data['size'];
				$property_params['meta_input']['mkdf_property_size_label_meta'] = $new_property_data['size_label'];
				$property_params['meta_input']['mkdf_property_size_label_position_meta'] = $new_property_data['size_label_position'];
				$property_params['meta_input']['mkdf_property_bedrooms_meta'] = $new_property_data['bedrooms'];
				$property_params['meta_input']['mkdf_property_bathrooms_meta'] = $new_property_data['bathrooms'];
				$property_params['meta_input']['mkdf_property_floor_meta'] = $new_property_data['floor'];
				$property_params['meta_input']['mkdf_property_total_floors_meta'] = $new_property_data['total_floors'];
				$property_params['meta_input']['mkdf_property_year_built_meta'] = $new_property_data['year_built'];
				$property_params['meta_input']['mkdf_property_heating_meta'] = $new_property_data['heating'];
				$property_params['meta_input']['mkdf_property_accommodation_meta'] = $new_property_data['accommodation'];

				$property_params['meta_input']['mkdf_property_ceiling_height_meta'] = $new_property_data['ceiling_height'];
				$property_params['meta_input']['mkdf_property_parking_meta'] = $new_property_data['parking'];
				$property_params['meta_input']['mkdf_property_from_center_meta'] = $new_property_data['property_from_center'];
				$property_params['meta_input']['mkdf_property_area_size_meta'] = $new_property_data['area_size'];
				$property_params['meta_input']['mkdf_property_garages_meta'] = $new_property_data['garages'];
				$property_params['meta_input']['mkdf_property_garages_size_meta'] = $new_property_data['garages_size'];
				$property_params['meta_input']['mkdf_property_additional_space_meta'] = $new_property_data['additional_space'];
				$property_params['meta_input']['mkdf_property_publication_date_meta'] = $new_property_data['publication_date'];
				$property_params['meta_input']['mkdf_property_is_featured_meta'] = $new_property_data['featured_property'];

				if ( is_array($new_property_data['property_leasing_terms_label']) && count($new_property_data['property_leasing_terms_label']) ) {
					$property_params['meta_input']['mkdf_property_leasing_terms_label_meta'] = $new_property_data['property_leasing_terms_label'];
				}

				if ( is_array($new_property_data['property_leasing_terms_value']) && count($new_property_data['property_leasing_terms_value']) ) {
					$property_params['meta_input']['mkdf_property_leasing_terms_value_meta'] = $new_property_data['property_leasing_terms_value'];
				}

				if ( is_array($new_property_data['property_costs_label']) && count($new_property_data['property_costs_label']) ) {
					$property_params['meta_input']['mkdf_property_costs_label_meta'] = $new_property_data['property_costs_label'];
				}

				if ( is_array($new_property_data['property_costs_value']) && count($new_property_data['property_costs_value']) ) {
					$property_params['meta_input']['mkdf_property_costs_value_meta'] = $new_property_data['property_costs_value'];
				}

				$property_params['meta_input']['mkdf_property_full_address_meta'] = $new_property_data['property_full_address'];
				$property_params['meta_input']['mkdf_property_full_address_latitude'] = $new_property_data['property_latitude'];
				$property_params['meta_input']['mkdf_property_full_address_longitude'] = $new_property_data['property_longitude'];
				$property_params['meta_input']['mkdf_property_simple_address_meta'] = $new_property_data['property_simple_address'];
				$property_params['meta_input']['mkdf_property_zip_code_meta'] = $new_property_data['property_zip_code'];
				$property_params['meta_input']['mkdf_property_address_country_meta'] = $new_property_data['property_country'];

				// These files need to be included as dependencies when on the front end.
				require_once( ABSPATH . 'wp-admin/includes/image.php' );
				require_once( ABSPATH . 'wp-admin/includes/file.php' );
				require_once( ABSPATH . 'wp-admin/includes/media.php' );
				
				// WordPress handles the upload (keys form $_FILES used).
				$property_image_gallery_array = array();
				$property_home_plan_image = array();
				$property_leasing_terms_icon = array();
				$property_costs_icon = array();

				foreach ($_FILES as $key => $value) {
					if (stripos($key,'_mkdf_reg_')) {
						$lastLetterPos = stripos($key,'_mkdf_reg_');
						$name = substr($key, 0, $lastLetterPos);
					} elseif (stripos($key,'_mkdf_regarray_')) {
						$lastLetterPos = stripos($key,'_mkdf_regarray_');
						$name = substr($key, 0, $lastLetterPos);
					}

					if ($value['name'] == 'mkdf-dummy-file.txt'){
						$attachment_id = '';
						$attachment_url = '';
					} else {
						$attachment_id = media_handle_upload( $key, 0 );
						$attachment_url = wp_get_attachment_url($attachment_id);
					}

					if ( is_wp_error( $attachment_id ) ) {
						mkdf_re_ajax_status( 'error', esc_html__( 'Image not uploaded, please try again.', 'mkdf-real-estate' ) );
					} else {
						switch ($name) {
							case 'property_featured_image':
								$featured_image_id = $attachment_id;
								break;
							case 'property_image_gallery':
								$property_image_gallery_array[] = $attachment_id;
								break;
							case 'property_home_plan_image':
								$property_home_plan_image[] = $attachment_url;
								break;
							case 'property_leasing_terms_icon':
								$property_leasing_terms_icon[] = $attachment_url;
								break;
							case 'property_costs_icon':
								$property_costs_icon[] = $attachment_url;
								break;
							case 'property_video_image':
								$property_params['meta_input']['mkdf_property_video_image_meta'] = $attachment_url;
								break;
							case 'property_attachment':
								$property_params['meta_input']['mkdf_property_attachment_meta'] = $attachment_url;
								break;
						}
					}
				}

				//add multiple images to single mkdf_property_image_gallery field
				$property_params['meta_input']['mkdf_property_image_gallery'] = implode(',', $property_image_gallery_array);

				//add images array to mkdf_property_home_plan_image_meta field
				$property_params['meta_input']['mkdf_property_home_plan_image_meta'] = $property_home_plan_image;

				//add images array to mkdf_property_leasing_terms_icon_meta field
				$property_params['meta_input']['mkdf_property_leasing_terms_icon_meta'] = $property_leasing_terms_icon;

				//add images array to mkdf_property_costs_icon_meta field
				$property_params['meta_input']['mkdf_property_costs_icon_meta'] = $property_costs_icon;

				$video_service = $new_property_data['property_video_type'];
				$property_params['meta_input']['mkdf_property_video_type_meta'] = $video_service;

				if ($video_service == 'social_networks') {
					$property_params['meta_input']['mkdf_property_video_link_meta'] = $new_property_data['property_video_link'];
				} else {
					$property_params['meta_input']['mkdf_property_video_custom_meta'] = $new_property_data['property_video_link'];
				}

				$property_params['meta_input']['mkdf_property_virtual_tour_meta'] = $new_property_data['property_virtual_tour'];

				if ( is_array($new_property_data['property_multi_unit_title']) && count($new_property_data['property_multi_unit_title']) ) {
					$property_params['meta_input']['mkdf_property_multi_unit_title_meta'] = $new_property_data['property_multi_unit_title'];
				}

				if ( is_array($new_property_data['property_multi_unit_type']) && count($new_property_data['property_multi_unit_type']) ) {
					$property_params['meta_input']['mkdf_property_multi_unit_type_meta'] = $new_property_data['property_multi_unit_type'];
				}

				if ( is_array($new_property_data['property_multi_unit_price']) && count($new_property_data['property_multi_unit_price']) ) {
					$property_params['meta_input']['mkdf_property_multi_unit_price_meta'] = $new_property_data['property_multi_unit_price'];
				}

				if ( is_array($new_property_data['property_multi_unit_bedrooms']) && count($new_property_data['property_multi_unit_bedrooms']) ) {
					$property_params['meta_input']['mkdf_property_multi_unit_bedrooms_meta'] = $new_property_data['property_multi_unit_bedrooms'];
				}

				if ( is_array($new_property_data['property_multi_unit_bathrooms']) && count($new_property_data['property_multi_unit_bathrooms']) ) {
					$property_params['meta_input']['mkdf_property_multi_unit_bathrooms_meta'] = $new_property_data['property_multi_unit_bathrooms'];
				}

				if ( is_array($new_property_data['property_multi_unit_size']) && count($new_property_data['property_multi_unit_size']) ) {
					$property_params['meta_input']['mkdf_property_multi_unit_size_meta'] = $new_property_data['property_multi_unit_size'];
				}

				if ( is_array($new_property_data['property_multi_unit_available']) && count($new_property_data['property_multi_unit_available']) ) {
					$property_params['meta_input']['mkdf_property_multi_unit_available_meta'] = $new_property_data['property_multi_unit_available'];
				}


				if ( is_array($new_property_data['property_home_plan_title']) && count($new_property_data['property_home_plan_title']) ) {
					$property_params['meta_input']['mkdf_property_home_plan_title_meta'] = $new_property_data['property_home_plan_title'];
				}

				if ( is_array($new_property_data['property_home_plan_price']) && count($new_property_data['property_home_plan_price']) ) {
					$property_params['meta_input']['mkdf_property_home_plan_price_meta'] = $new_property_data['property_home_plan_price'];
				}

				if ( is_array($new_property_data['property_home_plan_bedrooms']) && count($new_property_data['property_home_plan_bedrooms']) ) {
					$property_params['meta_input']['mkdf_property_home_plan_bedrooms_meta'] = $new_property_data['property_home_plan_bedrooms'];
				}

				if ( is_array($new_property_data['property_home_plan_bathrooms']) && count($new_property_data['property_home_plan_bathrooms']) ) {
					$property_params['meta_input']['mkdf_property_home_plan_bathrooms_meta'] = $new_property_data['property_home_plan_bathrooms'];
				}

				if ( is_array($new_property_data['property_home_plan_size']) && count($new_property_data['property_home_plan_size']) ) {
					$property_params['meta_input']['mkdf_property_home_plan_size_meta'] = $new_property_data['property_home_plan_size'];
				}

				if ( is_array($new_property_data['property_home_plan_description']) && count($new_property_data['property_home_plan_description']) ) {
					$property_params['meta_input']['mkdf_property_home_plan_description_meta'] = $new_property_data['property_home_plan_description'];
				}
				
				$user_role = 'agent';
				if ( in_array( 'agency', $user->roles ) ) {
					$user_role = 'agency';
				} elseif ( in_array( 'owner', $user->roles ) ) {
					$user_role = 'owner';
				}

				$property_params['meta_input']['mkdf_property_contact_info_meta'] = $user_role;
				$property_params['meta_input']['mkdf_property_contact_'.$user_role.'_meta'] = $user->ID;

				$property_params['meta_input']['mkdf_property_package_meta'] = $new_property_data['property_package_meta'];

				if ($published == 'yes'){
					$property_params['post_status'] = 'publish';
				}

				$property_id = wp_insert_post($property_params);
				if ( ! is_wp_error( $property_id ) ) {
					set_post_thumbnail($property_id, $featured_image_id);
					mkdf_re_ajax_status( 'success', esc_html__( 'Property successfully added.', 'mkdf-real-estate' ), NULL, $dashboard_url);
				} else {
					mkdf_re_ajax_status( 'error', esc_html__( 'Error.', 'mkdf-real-estate' ) );
				}				

			} else {
				mkdf_re_ajax_status( 'error', esc_html__( 'Error.', 'mkdf-real-estate' ) );
			}
		}
	}

	add_action( 'wp_ajax_mkdf_re_add_property', 'mkdf_re_add_property' );
}

if (!function_exists('mkdf_re_all_user_properties_query')) {
	function mkdf_re_all_user_properties_query(){
		$query_array = array(
			'post_status'    => array('publish','draft'),
			'post_type'      => 'property',
			'author' => get_current_user_id()
		);

		return $query_array;
	}
}

if (!function_exists('mkdf_re_get_property_meta')) {
	function mkdf_re_get_property_meta($id){
		$meta_values_array = array();
		$meta = get_post_meta($id);

		$meta_values_array['title'] = get_the_title($id);
		$meta_values_array['featured_image'] = get_post_thumbnail_id($id);
		$meta_values_array['featured_image_url'] = get_the_post_thumbnail_url($id);
		$meta_values_array['description'] = get_post_field('post_content', $id);

		foreach ($meta as $param_key => $array_value) {
			switch ($param_key) {
				case 'mkdf_property_leasing_terms_icon_meta':
				case 'mkdf_property_leasing_terms_label_meta':
				case 'mkdf_property_leasing_terms_value_meta':
				case 'mkdf_property_costs_icon_meta':
				case 'mkdf_property_costs_label_meta':
				case 'mkdf_property_costs_value_meta':
				case 'mkdf_property_home_plan_image_meta':
				case 'mkdf_property_home_plan_title_meta':
				case 'mkdf_property_home_plan_price_meta':
				case 'mkdf_property_home_plan_bedrooms_meta':
				case 'mkdf_property_home_plan_bathrooms_meta':
				case 'mkdf_property_home_plan_size_meta':
				case 'mkdf_property_home_plan_description_meta':
				case 'mkdf_property_multi_unit_title_meta':
				case 'mkdf_property_multi_unit_type_meta':
				case 'mkdf_property_multi_unit_price_meta':
				case 'mkdf_property_multi_unit_bedrooms_meta':
				case 'mkdf_property_multi_unit_bathrooms_meta':
				case 'mkdf_property_multi_unit_size_meta':
				case 'mkdf_property_multi_unit_available_meta':
					$meta_values_array[$param_key] = get_post_meta($id,$param_key,true);
					break;				
				default:
					$meta_values_array[$param_key] = $array_value[0];
					break;
			}
		}

		$property_type_terms = array();
		$terms = get_the_terms($id,'property-type');
		if (is_array($terms) && count($terms)) {
			foreach ($terms as $term) {
				$property_type_terms[] = $term->term_id;
			}
		}

		$property_feature_terms = array();
		$terms = get_the_terms($id,'property-feature');
		if (is_array($terms) && count($terms)) {
			foreach ($terms as $term) {
				$property_feature_terms[] = $term->term_id;
			}
		}

		$property_status_terms = array();
		$terms = get_the_terms($id,'property-status');
		if (is_array($terms) && count($terms)) {
			foreach ($terms as $term) {
				$property_status_terms[] = $term->term_id;
			}
		}

		$property_county_terms = array();
		$terms = get_the_terms($id,'property-county');
		if (is_array($terms) && count($terms)) {
			foreach ($terms as $term) {
				$property_county_terms[] = $term->term_id;
			}
		}

		$property_city_terms = array();
		$terms = get_the_terms($id,'property-city');
		if (is_array($terms) && count($terms)) {
			foreach ($terms as $term) {
				$property_city_terms[] = $term->term_id;
			}
		}

		$property_neighborhood_terms = array();
		$terms = get_the_terms($id,'property-neighborhood');
		if (is_array($terms) && count($terms)) {
			foreach ($terms as $term) {
				$property_neighborhood_terms[] = $term->term_id;
			}
		}

		$property_tag_terms = array();
		$terms = get_the_terms($id,'property-tag');
		if (is_array($terms) && count($terms)) {
			foreach ($terms as $term) {
				$property_tag_terms[] = $term->slug;
			}
		}

		$meta_values_array['property_type_terms'] = $property_type_terms;
		$meta_values_array['property_feature_terms'] = $property_feature_terms;
		$meta_values_array['property_status_terms'] = $property_status_terms;
		$meta_values_array['property_county_terms'] = $property_county_terms;
		$meta_values_array['property_city_terms'] = $property_city_terms;
		$meta_values_array['property_neighborhood_terms'] = $property_neighborhood_terms;
		$meta_values_array['property_tag_terms'] = $property_tag_terms;

		if (isset($meta_values_array['mkdf_property_leasing_terms_icon_meta']) && count($meta_values_array['mkdf_property_leasing_terms_icon_meta'])) {
			$meta_values_array['leasing_number'] = count($meta_values_array['mkdf_property_leasing_terms_icon_meta']);
		} else {
			$meta_values_array['leasing_number'] = 1;
		}

		if (isset($meta_values_array['mkdf_property_costs_icon_meta']) && count($meta_values_array['mkdf_property_costs_icon_meta'])) {
			$meta_values_array['cost_number'] = count($meta_values_array['mkdf_property_costs_icon_meta']);
		} else {
			$meta_values_array['cost_number'] = 1;
		}
		
		if (isset($meta_values_array['mkdf_property_home_plan_title_meta']) && count($meta_values_array['mkdf_property_home_plan_title_meta'])) {
			$meta_values_array['home_plan_number'] = count($meta_values_array['mkdf_property_home_plan_title_meta']);
		} else {
			$meta_values_array['home_plan_number'] = 1;
		}
		
		if (isset($meta_values_array['mkdf_property_multi_unit_title_meta']) && count($meta_values_array['mkdf_property_multi_unit_title_meta'])) {
			$meta_values_array['multi_unit_number'] = count($meta_values_array['mkdf_property_multi_unit_title_meta']);
		} else {
			$meta_values_array['multi_unit_number'] = 1;
		}
		
		//get just file name for attachment
		if ( isset($meta_values_array['mkdf_property_attachment_meta']) && $meta_values_array['mkdf_property_attachment_meta'] !== ''){
			preg_match('/[^\/]+$/', $meta_values_array['mkdf_property_attachment_meta'], $matches, PREG_OFFSET_CAPTURE);
			if (is_array($matches) && count($matches)) {
				$meta_values_array['mkdf_property_attachment_meta'] = $matches[0][0];
			}
		}

		return $meta_values_array;
	}
}

/*
* Function for editing property
*/

if ( ! function_exists( 'mkdf_re_edit_property' ) ) {
	function mkdf_re_edit_property() {
		if ( empty( $_POST ) || ! isset( $_POST ) ) {
			mkdf_re_ajax_status( 'error', esc_html__( 'All fields are empty', 'mkdf-real-estate' ) );
		} else {
			parse_str( $_POST['data'], $new_property_data );
			$property_db_id = $new_property_data['property_db_id'];
            $dashboard_url = mkdf_re_mkdf_membership_installed() ? mkdf_membership_get_dashboard_page_url() : '';

			$user = wp_get_current_user();

			//Check nonce
			if ( wp_verify_nonce( $new_property_data['mkdf_nonce_edit_property'], 'mkdf_validate_edit_property' ) && mkdf_re_approved_user_roles($user->roles ) ) {
				$property_params = array();
				$property_params['meta_input'] = array();
				$property_params['tax_input'] = array();
				$property_ids = array();

				$query_args = array(
					'post_status'    => 'publish',
					'post_type'      => 'property',
				);

				$query_results = new \WP_Query( $query_args );

				if($query_results->have_posts()):
					while ( $query_results->have_posts() ) : $query_results->the_post();
						$id = get_the_ID();
						if (get_post_meta($id,'mkdf_property_id_meta',true) !== ''){
							$property_ids[] = get_post_meta($id,'mkdf_property_id_meta',true);
						}
					endwhile;
				endif;

				$current_property_id = get_post_meta($property_db_id,'mkdf_property_id_meta', true);

				if ($current_property_id !== $new_property_data['property_id']){
					//Check if property id already exists 
					if ( in_array($new_property_data['property_id'], $property_ids) ){					
						mkdf_re_ajax_status( 'error', esc_html__( 'This property ID is taken, please try another.', 'mkdf-real-estate' ) );
					} else {
						$property_params['meta_input']['mkdf_property_id_meta'] = $new_property_data['property_id'];
					}
				}

				if ( is_array($new_property_data['property_type']) && count($new_property_data['property_type']) ) {
					$property_params['tax_input']['property-type'] = array_map('intval', $new_property_data['property_type']);
				}

				if ( is_array($new_property_data['property_feature']) && count($new_property_data['property_feature']) ) {
					$property_params['tax_input']['property-feature'] = array_map('intval', $new_property_data['property_feature']);
				}

				if ( is_array($new_property_data['property_status']) && count($new_property_data['property_status']) ) {
					$property_params['tax_input']['property-status'] = array_map('intval', $new_property_data['property_status']);
				}

				if ( is_array($new_property_data['property_county']) && count($new_property_data['property_county']) ) {
					$property_params['tax_input']['property-county'] = array_map('intval', $new_property_data['property_county']);
				}

				if ( is_array($new_property_data['property_city']) && count($new_property_data['property_city']) ) {
					$property_params['tax_input']['property-city'] = array_map('intval', $new_property_data['property_city']);
				}

				if ( is_array($new_property_data['property_neighborhood']) && count($new_property_data['property_neighborhood']) ) {
					$property_params['tax_input']['property-neighborhood'] = array_map('intval', $new_property_data['property_neighborhood']);
				}
				
				//property_tag is non-hierahical, so it must be assigned as string of slugs so it doesn't create new tag
				if ( is_array($new_property_data['property_tag']) && count($new_property_data['property_tag']) ) {
					$property_params['tax_input']['property-tag'] = $new_property_data['property_tag'];
				}

				$property_params['meta_input']['mkdf_property_price_meta'] = $new_property_data['price'];
				$property_params['meta_input']['mkdf_property_discount_price_meta'] = $new_property_data['discount_price'];
				$property_params['meta_input']['mkdf_property_price_label_meta'] = $new_property_data['price_label'];
				$property_params['meta_input']['mkdf_property_price_label_position_meta'] = $new_property_data['price_label_position'];
				$property_params['meta_input']['mkdf_property_size_meta'] = $new_property_data['size'];
				$property_params['meta_input']['mkdf_property_size_label_meta'] = $new_property_data['size_label'];
				$property_params['meta_input']['mkdf_property_size_label_position_meta'] = $new_property_data['size_label_position'];
				$property_params['meta_input']['mkdf_property_bedrooms_meta'] = $new_property_data['bedrooms'];
				$property_params['meta_input']['mkdf_property_bathrooms_meta'] = $new_property_data['bathrooms'];
				$property_params['meta_input']['mkdf_property_floor_meta'] = $new_property_data['floor'];
				$property_params['meta_input']['mkdf_property_total_floors_meta'] = $new_property_data['total_floors'];
				$property_params['meta_input']['mkdf_property_year_built_meta'] = $new_property_data['year_built'];
				$property_params['meta_input']['mkdf_property_heating_meta'] = $new_property_data['heating'];
				$property_params['meta_input']['mkdf_property_accommodation_meta'] = $new_property_data['accommodation'];

				$property_params['meta_input']['mkdf_property_ceiling_height_meta'] = $new_property_data['ceiling_height'];
				$property_params['meta_input']['mkdf_property_parking_meta'] = $new_property_data['parking'];
				$property_params['meta_input']['mkdf_property_from_center_meta'] = $new_property_data['property_from_center'];
				$property_params['meta_input']['mkdf_property_area_size_meta'] = $new_property_data['area_size'];
				$property_params['meta_input']['mkdf_property_garages_meta'] = $new_property_data['garages'];
				$property_params['meta_input']['mkdf_property_garages_size_meta'] = $new_property_data['garages_size'];
				$property_params['meta_input']['mkdf_property_additional_space_meta'] = $new_property_data['additional_space'];
				$property_params['meta_input']['mkdf_property_publication_date_meta'] = $new_property_data['publication_date'];
				$property_params['meta_input']['mkdf_property_is_featured_meta'] = $new_property_data['featured_property'];


				if ( is_array($new_property_data['property_leasing_terms_label']) && count($new_property_data['property_leasing_terms_label']) ) {
					$property_params['meta_input']['mkdf_property_leasing_terms_label_meta'] = $new_property_data['property_leasing_terms_label'];
				}

				if ( is_array($new_property_data['property_leasing_terms_value']) && count($new_property_data['property_leasing_terms_value']) ) {
					$property_params['meta_input']['mkdf_property_leasing_terms_value_meta'] = $new_property_data['property_leasing_terms_value'];
				}


				if ( is_array($new_property_data['property_costs_label']) && count($new_property_data['property_costs_label']) ) {
					$property_params['meta_input']['mkdf_property_costs_label_meta'] = $new_property_data['property_costs_label'];
				}

				if ( is_array($new_property_data['property_costs_value']) && count($new_property_data['property_costs_value']) ) {
					$property_params['meta_input']['mkdf_property_costs_value_meta'] = $new_property_data['property_costs_value'];
				}

				$property_params['meta_input']['mkdf_property_full_address_meta'] = $new_property_data['property_full_address'];
				$property_params['meta_input']['mkdf_property_full_address_latitude'] = $new_property_data['property_latitude'];
				$property_params['meta_input']['mkdf_property_full_address_longitude'] = $new_property_data['property_longitude'];
				$property_params['meta_input']['mkdf_property_simple_address_meta'] = $new_property_data['property_simple_address'];
				$property_params['meta_input']['mkdf_property_zip_code_meta'] = $new_property_data['property_zip_code'];
				$property_params['meta_input']['mkdf_property_address_country_meta'] = $new_property_data['property_country'];

				//get media values (needed to be in input hidden because of the repeater values) - if empty then media is removed
				$property_featured_image_db = $new_property_data['property_featured_image_hidden'];
				$property_image_gallery_db = $new_property_data['property_image_gallery_hidden'];
				$property_video_image_db = $new_property_data['property_video_image_hidden'];
				$property_attachment_db = $new_property_data['property_attachment_hidden'];
				$property_home_plan_db_images = $new_property_data['property_home_plan_image_hidden'];
				$property_leasing_terms_icon_db_images = $new_property_data['property_leasing_terms_icon_hidden'];
				$property_costs_icon_db_images = $new_property_data['property_costs_icon_hidden'];

				//remove media, it needs to be before adding media, in case user removed and then uploaded some media
				$featured_image_id = '';

				if ($property_featured_image_db == ''){
					$featured_image_id = 'removed';
				}

				if ($property_image_gallery_db == ''){
					$property_params['meta_input']['mkdf_property_image_gallery'] = '';
				}

				if ($property_video_image_db == ''){
					$property_params['meta_input']['mkdf_property_video_image_meta'] = '';
				}

				if ($property_attachment_db == ''){
					$property_params['meta_input']['mkdf_property_attachment_meta'] = '';
				}

				// These files need to be included as dependencies when on the front end.
				require_once( ABSPATH . 'wp-admin/includes/image.php' );
				require_once( ABSPATH . 'wp-admin/includes/file.php' );
				require_once( ABSPATH . 'wp-admin/includes/media.php' );
				
				// WordPress handles the upload (keys form $_FILES used).
				$property_image_gallery_array = array();
				$property_home_plan_image = array();
				$property_leasing_terms_icon = array();
				$property_costs_icon = array();

				$repeater_names = array('property_home_plan_image','property_leasing_terms_icon','property_costs_icon');

				foreach ($_FILES as $key => $value) {
					if (stripos($key,'_mkdf_reg_')) {

						$lastLetterPos = stripos($key,'_mkdf_reg_');
						$name = substr($key, 0, $lastLetterPos);

					} elseif (stripos($key,'_mkdf_regarray_')) {

						$lastLetterPos = stripos($key,'_mkdf_regarray_');
						$name = substr($key, 0, $lastLetterPos);
					}

					if ($value['name'] == 'mkdf-dummy-file.txt'){
						$attachment_id = '';
						$attachment_url = '';

						//only repeater values needs to be sent even if empty
						if ( !in_array($name, $repeater_names) ){
							continue;
						}
					} else {
						$attachment_id = media_handle_upload( $key, 0 );
						$attachment_url = wp_get_attachment_url($attachment_id);
					}

					if ( is_wp_error( $attachment_id ) ) {
						mkdf_re_ajax_status( 'error', esc_html__( 'Media not uploaded, please try again.', 'mkdf-real-estate' ) );
					} else {
						switch ($name) {
							case 'property_featured_image':
								$featured_image_id = $attachment_id;
								break;
							case 'property_image_gallery':
								$property_image_gallery_array[] = $attachment_id;
								break;
							case 'property_home_plan_image':
								$property_home_plan_image[] = $attachment_url;
								break;
							case 'property_leasing_terms_icon':
								$property_leasing_terms_icon[] = $attachment_url;
								break;
							case 'property_costs_icon':
								$property_costs_icon[] = $attachment_url;
								break;
							case 'property_video_image':
								$property_params['meta_input']['mkdf_property_video_image_meta'] = $attachment_url;
								break;
							case 'property_attachment':
								$property_params['meta_input']['mkdf_property_attachment_meta'] = $attachment_url;
								break;
						}
					}
				}

				//mix new with old values for repeater
				foreach ($property_home_plan_image as $key => $value) {
					if ($property_home_plan_image[$key] !== ''){
						$property_home_plan_db_images[$key] = $property_home_plan_image[$key];
					}
					if (!isset($property_home_plan_db_images[$key])){
						$property_home_plan_db_images[$key] = $property_home_plan_image[$key];
					}
				}

				//add images array to mkdf_property_home_plan_image_meta field
				if (is_array($property_home_plan_db_images) && count($property_home_plan_db_images)) {
					$property_params['meta_input']['mkdf_property_home_plan_image_meta'] = $property_home_plan_db_images;
				}

				//mix new with old values for repeater
				foreach ($property_leasing_terms_icon as $key => $value) {
					if ($property_leasing_terms_icon[$key] !== ''){
						$property_leasing_terms_icon_db_images[$key] = $property_leasing_terms_icon[$key];
					}
					if (!isset($property_leasing_terms_icon_db_images[$key])){
						$property_leasing_terms_icon_db_images[$key] = $property_leasing_terms_icon[$key];
					}
				}

				//add images array to mkdf_property_leasing_terms_icon_meta field
				if (is_array($property_leasing_terms_icon_db_images) && count($property_leasing_terms_icon_db_images)) {
					$property_params['meta_input']['mkdf_property_leasing_terms_icon_meta'] = $property_leasing_terms_icon_db_images;
				}

				//mix new with old values for repeater
				foreach ($property_costs_icon as $key => $value) {
					if ($property_costs_icon[$key] !== ''){
						$property_costs_icon_db_images[$key] = $property_costs_icon[$key];
					}
					if (!isset($property_costs_icon_db_images[$key])){
						$property_costs_icon_db_images[$key] = $property_costs_icon[$key];
					}
				}

				//add images array to mkdf_property_costs_icon_meta field
				if (is_array($property_costs_icon_db_images) && count($property_costs_icon_db_images)) {
					$property_params['meta_input']['mkdf_property_costs_icon_meta'] = $property_costs_icon_db_images;
				}

				//add multiple images to single mkdf_property_image_gallery field
				if (is_array($property_image_gallery_array) && count($property_image_gallery_array)) {
					$property_params['meta_input']['mkdf_property_image_gallery'] = implode(',', $property_image_gallery_array);
				}

				$video_service = $new_property_data['property_video_type'];
				$property_params['meta_input']['mkdf_property_video_type_meta'] = $video_service;

				if ($video_service == 'social_networks') {
					$property_params['meta_input']['mkdf_property_video_link_meta'] = $new_property_data['property_video_link'];
				} else {
					$property_params['meta_input']['mkdf_property_video_custom_meta'] = $new_property_data['property_video_link'];
				}

				$property_params['meta_input']['mkdf_property_virtual_tour_meta'] = $new_property_data['property_virtual_tour'];

				if ( is_array($new_property_data['property_multi_unit_title']) && count($new_property_data['property_multi_unit_title']) ) {
					$property_params['meta_input']['mkdf_property_multi_unit_title_meta'] = $new_property_data['property_multi_unit_title'];
				}

				if ( is_array($new_property_data['property_multi_unit_type']) && count($new_property_data['property_multi_unit_type']) ) {
					$property_params['meta_input']['mkdf_property_multi_unit_type_meta'] = $new_property_data['property_multi_unit_type'];
				}

				if ( is_array($new_property_data['property_multi_unit_price']) && count($new_property_data['property_multi_unit_price']) ) {
					$property_params['meta_input']['mkdf_property_multi_unit_price_meta'] = $new_property_data['property_multi_unit_price'];
				}

				if ( is_array($new_property_data['property_multi_unit_bedrooms']) && count($new_property_data['property_multi_unit_bedrooms']) ) {
					$property_params['meta_input']['mkdf_property_multi_unit_bedrooms_meta'] = $new_property_data['property_multi_unit_bedrooms'];
				}

				if ( is_array($new_property_data['property_multi_unit_bathrooms']) && count($new_property_data['property_multi_unit_bathrooms']) ) {
					$property_params['meta_input']['mkdf_property_multi_unit_bathrooms_meta'] = $new_property_data['property_multi_unit_bathrooms'];
				}

				if ( is_array($new_property_data['property_multi_unit_size']) && count($new_property_data['property_multi_unit_size']) ) {
					$property_params['meta_input']['mkdf_property_multi_unit_size_meta'] = $new_property_data['property_multi_unit_size'];
				}

				if ( is_array($new_property_data['property_multi_unit_available']) && count($new_property_data['property_multi_unit_available']) ) {
					$property_params['meta_input']['mkdf_property_multi_unit_available_meta'] = $new_property_data['property_multi_unit_available'];
				}


				if ( is_array($new_property_data['property_home_plan_title']) && count($new_property_data['property_home_plan_title']) ) {
					$property_params['meta_input']['mkdf_property_home_plan_title_meta'] = $new_property_data['property_home_plan_title'];
				}

				if ( is_array($new_property_data['property_home_plan_price']) && count($new_property_data['property_home_plan_price']) ) {
					$property_params['meta_input']['mkdf_property_home_plan_price_meta'] = $new_property_data['property_home_plan_price'];
				}

				if ( is_array($new_property_data['property_home_plan_bedrooms']) && count($new_property_data['property_home_plan_bedrooms']) ) {
					$property_params['meta_input']['mkdf_property_home_plan_bedrooms_meta'] = $new_property_data['property_home_plan_bedrooms'];
				}

				if ( is_array($new_property_data['property_home_plan_bathrooms']) && count($new_property_data['property_home_plan_bathrooms']) ) {
					$property_params['meta_input']['mkdf_property_home_plan_bathrooms_meta'] = $new_property_data['property_home_plan_bathrooms'];
				}

				if ( is_array($new_property_data['property_home_plan_size']) && count($new_property_data['property_home_plan_size']) ) {
					$property_params['meta_input']['mkdf_property_home_plan_size_meta'] = $new_property_data['property_home_plan_size'];
				}

				if ( is_array($new_property_data['property_home_plan_description']) && count($new_property_data['property_home_plan_description']) ) {
					$property_params['meta_input']['mkdf_property_home_plan_description_meta'] = $new_property_data['property_home_plan_description'];
				}

				//update meta fields
				foreach ($property_params['meta_input'] as $key => $value) {
					update_post_meta($property_db_id, $key, $value);
				}

				//update terms
				foreach ($property_params['tax_input'] as $key => $value) {
					wp_set_object_terms($property_db_id, $value, $key);
				}

				//update featured image
				if ($featured_image_id !== '') {

					if ($featured_image_id == 'removed') {
						delete_post_thumbnail($property_db_id);
					} else {
						set_post_thumbnail($property_db_id, $featured_image_id);
					}
				}

				$this_property_args = array(
					'ID'           => $property_db_id,
					'post_title'   => $new_property_data['property_title'],
					'post_content' => $new_property_data['property_description'],
				);



				// Update the property into the database
				$property_id_success = wp_update_post($this_property_args);
				if ( ! is_wp_error( $property_id_success ) ) {
					mkdf_re_ajax_status( 'success', esc_html__( 'Property successfully edited.', 'mkdf-real-estate' ), NULL, $dashboard_url );
				} else {
					mkdf_re_ajax_status( 'error', esc_html__( 'Error.', 'mkdf-real-estate' ) );
				}				

			} else {
				mkdf_re_ajax_status( 'error', esc_html__( 'Error.', 'mkdf-real-estate' ) );
			}
		}
	}

	add_action( 'wp_ajax_mkdf_re_edit_property', 'mkdf_re_edit_property' );
}

if (!function_exists('mkdf_re_delete_property')) {
	function mkdf_re_delete_property(){
		if ( empty( $_POST ) || ! isset( $_POST ) ) {
			mkdf_re_ajax_status( 'error', esc_html__( 'All fields are empty', 'mkdf-real-estate' ) );
		} else {
			$user = wp_get_current_user();

			//Check if role in approved roles
			if ( mkdf_re_approved_user_roles($user->roles ) ) {
				$deleted = wp_delete_post($_POST['property_id']);
				if ($deleted){
					mkdf_re_ajax_status( 'success', esc_html__( 'Property deleted.', 'mkdf-real-estate' ) );
				}
			}
		}
	}

	add_action( 'wp_ajax_mkdf_re_delete_property', 'mkdf_re_delete_property' );
}

if (!function_exists('mkdf_re_get_add_property_params')) {
	function mkdf_re_get_add_property_params(){

		$add_property_params = array();

		$package_necessary = zuhaus_mikado_options()->getOptionValue('enable_packages_necessity');

		if ($package_necessary == 'no') {
			//if package is not necessary, featured items cannot be set by user, therefore is 0
			$add_property_params['number_of_featured'] = 0;

		} else {
			$package_key = mkdf_re_get_user_current_package();

			$number_of_featured = 0;
			if($package_key) {
                $package_info = mkdf_re_get_package_info($package_key);
                $number_of_featured = $package_info['featured_items_remaining'];
            }

			$add_property_params['number_of_featured'] = $number_of_featured;
		}

		return $add_property_params;
	}
}

if (!function_exists('mkdf_re_approved_user_roles')) {
	function mkdf_re_approved_user_roles($user_roles){
		$roles = array();
		$approved_roles = apply_filters( 'mkdf_real_estate_role_property_filter', $roles);
		$approved = false;

		foreach ($approved_roles as $approved_role) {
			if (in_array($approved_role, $user_roles)){
				$approved = true;
				continue;
			}
		}

		return $approved;
	}
}

if (!function_exists('mkdf_re_property_addition_enabled')) {

	function mkdf_re_property_addition_enabled(){
		$enabled = false;
		$package_necessary = zuhaus_mikado_options()->getOptionValue('enable_packages_necessity');

		if ($package_necessary == 'no'){
			$enabled = true;
		} else {
			$enabled = mkdf_re_get_user_current_package();
		}

		return $enabled;
	}
}