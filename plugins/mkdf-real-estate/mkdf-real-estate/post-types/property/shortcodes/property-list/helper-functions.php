<?php
if(!function_exists('mkdf_re_property_list_shortcode_helper')) {
    function mkdf_re_property_list_shortcode_helper($shortcodes_class_name) {
        $shortcodes = array(
            'MikadofRE\CPT\Shortcodes\Property\PropertyList'
        );

        $shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

        return $shortcodes_class_name;
    }

    add_filter('mkdf_re_filter_add_vc_shortcode', 'mkdf_re_property_list_shortcode_helper');
}

if( !function_exists('mkdf_re_set_property_list_icon_class_name_for_vc_shortcodes') ) {
    /**
     * Function that set custom icon class name for property list shortcode to set our icon for Visual Composer shortcodes panel
     */
    function mkdf_re_set_property_list_icon_class_name_for_vc_shortcodes($shortcodes_icon_class_array) {
        $shortcodes_icon_class_array[] = '.icon-wpb-property-list';

        return $shortcodes_icon_class_array;
    }

    add_filter('mkdf_re_filter_add_vc_shortcodes_custom_icon_class', 'mkdf_re_set_property_list_icon_class_name_for_vc_shortcodes');
}

if( !function_exists('mkdf_re_get_property_max_price_value') ) {
    function mkdf_re_get_property_max_price_value() {
        global $wpdb;
        $post_meta_table = $wpdb->prefix . 'postmeta';
        $query = "SELECT max(cast(meta_value as unsigned)) FROM $post_meta_table WHERE meta_key='mkdf_property_price_meta'";
        $the_max = $wpdb->get_var($query);
        return intval ($the_max);
    }
}

if( !function_exists('mkdf_re_property_ajax_load_more') ) {
    function mkdf_re_property_ajax_load_more() {
        $shortcode_params = array();
        $additional_params = array();

        if ( ! empty( $_POST ) ) {
            foreach ( $_POST as $key => $value ) {
                if ( $key !== '' ) {
                    $addUnderscoreBeforeCapitalLetter = preg_replace( '/([A-Z])/', '_$1', $key );
                    $setAllLettersToLowercase         = strtolower( $addUnderscoreBeforeCapitalLetter );

                    $shortcode_params[ $setAllLettersToLowercase ] = $value;
                }
            }
        }

        $property_list = new \MikadofRe\CPT\Shortcodes\Property\PropertyList();

        $query_array                        = $property_list->getQueryArray( $shortcode_params );
        $query_results                      = new \WP_Query( $query_array );
        $additional_params['query_results'] = $query_results;
        $shortcode_params['this_object']    = $property_list;

        $html = '';
        if ( $query_results->have_posts() ):
            while ( $query_results->have_posts() ) : $query_results->the_post();
                $html .= mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-list', 'item', '', $shortcode_params, $additional_params );
            endwhile;
        else:
            $html .= mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-list', 'parts/posts-not-found', '', $shortcode_params, $additional_params );
        endif;

        wp_reset_postdata();

        $multiple_map_vars = array();
        if($shortcode_params['enable_map'] === 'yes') {
            $multiple_map_vars = mkdf_re_set_multiple_property_map_variables($query_results, true);
        }

        $return_obj = array(
            'html' => $html,
            'mapAddresses' => $multiple_map_vars,
        );

        echo json_encode( $return_obj );
        exit;
    }

    add_action( 'wp_ajax_nopriv_mkdf_re_property_ajax_load_more', 'mkdf_re_property_ajax_load_more' );
    add_action( 'wp_ajax_mkdf_re_property_ajax_load_more', 'mkdf_re_property_ajax_load_more' );
}

if( !function_exists('mkdf_re_property_ajax_save_query') ) {
    function mkdf_re_property_ajax_save_query() {
        if ( empty( $_POST ) || ! isset( $_POST ) ) {
            mkdf_re_ajax_status(
                'error',
                esc_html__( 'All fields are empty, search parameters are not saved.', 'mkdf-real-estate' ),
                ''
            );
        } else {
            $data = $_POST;

            $search_params = array(
                'status' => $data['status'],
                'type' => $data['type'],
                'city' => $data['city'],
                'minPrice' => $data['minPrice'],
                'maxPrice' => $data['maxPrice'],
                'minSize' => $data['minSize'],
                'maxSize' => $data['maxSize'],
                'bedrooms' => $data['bedrooms'],
                'bathrooms' => $data['bathrooms'],
                'features' => $data['features']
            );

            $user_id = get_current_user_id();
            $user_queries = get_user_meta($user_id, 'mkdf_user_saved_queries', true);
            if(!isset($user_queries) || empty($user_queries)) {
                $user_queries = array();
            }

            $user_queries[] = $search_params;

            update_user_meta($user_id, 'mkdf_user_saved_queries', $user_queries);

            end($user_queries);         // move the internal pointer to the end of the array
            $index = key($user_queries);
            reset($user_queries);       // reset pointer of array

            $html = '';
            $html .= '<span class="mkdf-undo-query-save" data-query-id="' . $index . '">';
                $html .= '<span class="mkdf-undo-query-message">';
                    $html .= esc_html__('Undo', 'mkdf-real-estate');
                $html .= '</span>';
                $html .= '<i class="fa fa-undo" aria-hidden="true"></i>';
            $html .= '</span>';

            mkdf_re_ajax_status(
                'success',
                esc_html__( 'Query successfully saved.', 'mkdf-real-estate' ),
                $html
            );
        }
    }

    add_action( 'wp_ajax_nopriv_mkdf_re_property_ajax_save_query', 'mkdf_re_property_ajax_save_query' );
    add_action( 'wp_ajax_mkdf_re_property_ajax_save_query', 'mkdf_re_property_ajax_save_query' );
}

if( !function_exists('mkdf_re_property_ajax_remove_query') ) {
    function mkdf_re_property_ajax_remove_query() {
        if ( empty( $_POST ) || ! isset( $_POST ) ) {
            mkdf_re_ajax_status(
                'error',
                esc_html__( 'No query saved to be undone.', 'mkdf-real-estate' ),
                ''
            );
        } else {
            $data = $_POST;

            $query_id = $data['query_id'];

            $user_id = get_current_user_id();
            $user_queries = get_user_meta($user_id, 'mkdf_user_saved_queries', true);
            if(!isset($user_queries) || empty($user_queries)) {
                $user_queries = array();
            } else {
                unset($user_queries[$query_id]);
            }

            update_user_meta($user_id, 'mkdf_user_saved_queries', $user_queries);

            $html = '';

            mkdf_re_ajax_status(
                'success',
                esc_html__( 'Query successfully removed.', 'mkdf-real-estate' ),
                $html
            );
        }
    }

    add_action( 'wp_ajax_nopriv_mkdf_re_property_ajax_remove_query', 'mkdf_re_property_ajax_remove_query' );
    add_action( 'wp_ajax_mkdf_re_property_ajax_remove_query', 'mkdf_re_property_ajax_remove_query' );
}