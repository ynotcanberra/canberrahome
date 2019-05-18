<?php
if ( ! function_exists( 'mkdf_re_start_session' ) ) {
    function mkdf_re_start_session() {
        if (!session_id()) {
            session_start();
        }
    }

    add_action('init', 'mkdf_re_start_session', 1);
}

//SIDE AREA WITH ITEMS PART
if ( ! function_exists( 'mkdf_re_compare_holder_body_class' ) ) {
    function mkdf_re_compare_holder_body_class( $classes ) {

        $enable_compare = zuhaus_mikado_options()->getOptionValue('enable_property_comparing');
        if ( isset($enable_compare) && $enable_compare == 'yes' ) {

            $classes[] = 'mkdf-re-ch-slide-from-right';
        }

        return $classes;
    }

    add_filter( 'body_class', 'mkdf_re_compare_holder_body_class' );
}

if ( ! function_exists( 'mkdf_re_get_compare_area' ) ) {
    /**
     * Loads side area HTML
     */
    function mkdf_re_get_compare_area() {

        $enable_compare = zuhaus_mikado_options()->getOptionValue('enable_property_comparing');
        if ( isset($enable_compare) && $enable_compare == 'yes' ) {

            $params = array(
                'items_layout'      => 'mkdf-items-standard',
                'holder_classes'    => 'mkdf-compare-has-items'
            );

            if(isset($_SESSION) && isset($_SESSION['compare_properties'])) {
                $added_properties = $_SESSION['compare_properties'];

                if ( ! empty( $added_properties ) ) {
                    $params['added_properties'] = $added_properties;
                } else {
                    $params['holder_classes'] = 'mkdf-compare-empty';
                }
            } else {
                $params['holder_classes'] = 'mkdf-compare-empty';
            }

            echo mkdf_re_cpt_single_module_template_part( 'compare/templates/compare-holder', 'property', '', $params );
        }
    }

    add_action( 'zuhaus_mikado_after_body_tag', 'mkdf_re_get_compare_area', 10 );
}

if ( !function_exists( 'mkdf_re_get_add_to_compare_list_button' ) ) {
    function mkdf_re_get_add_to_compare_list_button( $id = '' ) {
        $id = ! empty( $id ) ? $id : get_the_ID();
        $params = array();

        $params['item_id'] = $id;
	    $params['item_text'] = esc_html__('Compare', 'mkdf-real-estate');
	    if(isset($_SESSION) && isset($_SESSION['compare_properties'])) {
		    $added_properties = $_SESSION['compare_properties'];
		    if ( ! empty( $added_properties ) ) {
			    foreach($added_properties as $property) {
			    	if($property == $id ) {
			    	    $params['item_text'] = esc_html__('Remove', 'mkdf-real-estate');
                   }
			    }
		    }
	    }

        echo mkdf_re_cpt_single_module_template_part( 'compare/templates/add-to-compare', 'property', '', $params );
    }
}

if ( !function_exists( 'mkdf_re_get_compare_list_item' ) ) {
    function mkdf_re_get_compare_list_item( $id ) {
        $params = array();
        $params['id'] = $id;

        return mkdf_re_cpt_single_module_template_part( 'compare/templates/layout-collections/default', 'property', '', $params );
    }
}

//POPUP PART
if ( ! function_exists( 'mkdf_re_get_compare_popup_holder' ) ) {
    function mkdf_re_get_compare_popup_holder() {

        $enable_compare = zuhaus_mikado_options()->getOptionValue('enable_property_comparing');
        if ( isset($enable_compare) && $enable_compare == 'yes' ) {

            $params = array(
                'items_layout' => 'detailed'
            );

            if(isset($_SESSION) && isset($_SESSION['compare_properties'])) {
                $added_properties = $_SESSION['compare_properties'];

                if ( ! empty( $added_properties ) ) {
                    $params['added_properties'] = $added_properties;
                }
            }

            echo mkdf_re_cpt_single_module_template_part( 'compare/templates/popup-holder', 'property', '', $params );
        }
    }

    add_action( 'zuhaus_mikado_before_page_header', 'mkdf_re_get_compare_popup_holder', 10 );
}

if ( !function_exists( 'mkdf_re_get_compare_list_items_structured' ) ) {
    function mkdf_re_get_compare_list_items_structured($added_properties) {
        $params = array();
        $params['added_properties'] = $added_properties;

        return mkdf_re_cpt_single_module_template_part( 'compare/templates/popup-items', 'property', '', $params );
    }
}

//AJAX HANDLERS

if ( !function_exists( 'mkdf_re_handle_add_to_compare' ) ) {
    function mkdf_re_handle_add_to_compare() {
        if ( empty( $_POST ) || ! isset( $_POST ) ) {
            mkdf_re_ajax_status(
                'error',
                esc_html__( 'No properties selected for comparing.', 'mkdf-real-estate' ),
                ''
            );
        } else {
            $data = $_POST;
            $item_id = $data['item_id'];
            $response = array();

            if(isset($_SESSION) && isset($_SESSION['compare_properties'])) {
                $added_properties = $_SESSION['compare_properties'];

                if ( ! empty( $added_properties ) && in_array( $item_id, $added_properties ) ) {
                    $temp_array[]               = $item_id;
                    $added_properties           = array_diff( $added_properties, $temp_array );
                    $response['action']         = 'removed';
                    $response['message']        = esc_html__('Property removed from compare list', 'mkdf-real-estate');
                    $response['items_no']       = sizeof($added_properties);
	                $response['button_text']    = esc_html__('Compare', 'mkdf-real-estate');
                } else {
                    if(sizeof($added_properties) >= 4) {
                        $response['action']     = 'error';
                        $response['message']    = esc_html__('You can add maximum 4 properties to compare list', 'mkdf-real-estate');
                    } else {
                        $added_properties[]         = $item_id;
                        $added_properties           = array_unique($added_properties);
                        $response['action']         = 'added';
                        $response['item']           = mkdf_re_get_compare_list_item( $item_id );
                        $response['items_no']       = sizeof($added_properties);
	                    $response['button_text']    = esc_html__('Remove', 'mkdf-real-estate');
                    }
                }

                $_SESSION['compare_properties'] = $added_properties;

            } else {
                $added_properties   = array();
                $added_properties[] = $item_id;

                $response['action']             = 'added';
                $response['html']               = mkdf_re_get_compare_list_item( $item_id );
                $response['items_no']           = sizeof($added_properties);
                $_SESSION['compare_properties'] = $added_properties;
            }

            mkdf_re_ajax_status( 'success', '', $response );
        }

        wp_die();
    }

    add_action( 'wp_ajax_nopriv_mkdf_re_handle_add_to_compare', 'mkdf_re_handle_add_to_compare' );
    add_action( 'wp_ajax_mkdf_re_handle_add_to_compare', 'mkdf_re_handle_add_to_compare' );
}

if ( !function_exists( 'mkdf_re_handle_clear_compare_list' ) ) {
    function mkdf_re_handle_clear_compare_list() {
        if ( empty( $_POST ) || ! isset( $_POST ) ) {
            mkdf_re_ajax_status(
                'error',
                esc_html__( 'No properties selected for comparing.', 'mkdf-real-estate' ),
                ''
            );
        } else {
            if(isset($_SESSION) && isset($_SESSION['compare_properties'])) {
                $_SESSION['compare_properties'] = array();
                mkdf_re_ajax_status(
                    'success',
                    esc_html__( 'All items from compare list removed.', 'mkdf-real-estate' ),
                    array(
                    	'button_text' => esc_html__('Compare', 'mkdf-real-estate')
                    )
                );
            }
        }
    }

    add_action( 'wp_ajax_nopriv_mkdf_re_handle_clear_compare_list', 'mkdf_re_handle_clear_compare_list' );
    add_action( 'wp_ajax_mkdf_re_handle_clear_compare_list', 'mkdf_re_handle_clear_compare_list' );
}

if ( !function_exists( 'mkdf_re_refresh_compare_popup' ) ) {
    function mkdf_re_refresh_compare_popup() {
        if ( empty( $_POST ) || ! isset( $_POST ) ) {
            mkdf_re_ajax_status(
                'error',
                esc_html__( 'No properties selected for comparing.', 'mkdf-real-estate' ),
                ''
            );
        } else {
            if(isset($_SESSION) && isset($_SESSION['compare_properties'])) {
                $added_properties = $_SESSION['compare_properties'];
                if(empty($added_properties)) {
                    $return_html = mkdf_re_cpt_single_module_template_part( 'compare/templates/parts/posts-not-found', 'property' );
                } else {
                    $return_html = mkdf_re_get_compare_list_items_structured($added_properties);
                }
                mkdf_re_ajax_status(
                    'success',
                    esc_html__( 'All items from compare list removed.', 'mkdf-real-estate' ),
                    $return_html
                );
            }
        }
    }

    add_action( 'wp_ajax_nopriv_mkdf_re_refresh_compare_popup', 'mkdf_re_refresh_compare_popup' );
    add_action( 'wp_ajax_mkdf_re_refresh_compare_popup', 'mkdf_re_refresh_compare_popup' );
}