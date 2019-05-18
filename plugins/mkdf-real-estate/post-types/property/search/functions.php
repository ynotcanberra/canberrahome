<?php
if ( ! function_exists( 'mkdf_re_property_override_search_template_path' ) ) {
    function mkdf_re_property_override_search_template_path( $template_path ) {

        if ( isset( $_GET['mkdf-property-search'] ) ) {
            $template_path = MIKADO_RE_CPT_PATH . '/';
        }

        return $template_path;
    }

    add_filter( 'zuhaus_mikado_edit_module_template_path', 'mkdf_re_property_override_search_template_path', 10, 1 );
}

if ( ! function_exists( 'mkdf_re_property_override_search_module' ) ) {
    function mkdf_re_property_override_search_module( $module ) {

        if ( isset( $_GET['mkdf-property-search'] ) ) {
            $module = 'property';
        }

        return $module;
    }

    add_filter( 'zuhaus_mikado_search_page_module', 'mkdf_re_property_override_search_module', 10, 1 );
}

if ( ! function_exists( 'mkdf_re_property_override_search_path' ) ) {
    function mkdf_re_property_override_search_path( $path ) {

        if ( isset( $_GET['mkdf-property-search'] ) ) {
            $path = 'search';
        }

        return $path;
    }

    add_filter( 'zuhaus_mikado_search_page_path', 'mkdf_re_property_override_search_path', 10, 1 );
}

if ( ! function_exists( 'mkdf_re_property_override_search_plugin' ) ) {
    function mkdf_re_property_override_search_plugin( $plugin ) {

        if ( isset( $_GET['mkdf-property-search'] ) ) {
            $plugin = true;
        }

        return $plugin;
    }

    add_filter( 'zuhaus_mikado_search_page_plugin_override', 'mkdf_re_property_override_search_plugin', 10, 1 );
}

if ( ! function_exists( 'mkdf_re_property_override_search_params' ) ) {
    function mkdf_re_property_override_search_params( $params ) {

        if ( isset( $_GET['mkdf-property-search'] ) ) {
            $params   = array();

            if ( isset( $_GET['mkdf-search-type'] ) ) {
                $params['property_type'] = $_GET['mkdf-search-type'];
            }

            if ( isset( $_GET['mkdf-search-city'] ) ) {
                $params['property_city'] = $_GET['mkdf-search-city'];
            }

            if ( isset( $_GET['mkdf-search-status'] ) ) {
                $params['property_status'] = $_GET['mkdf-search-status'];
            }

            if ( isset( $_GET['mkdf-search-minPrice'] ) ) {
                $params['property_min_price'] = $_GET['mkdf-search-minPrice'];
            }

            if ( isset( $_GET['mkdf-search-maxPrice'] ) ) {
                $params['property_max_price'] = $_GET['mkdf-search-maxPrice'];
            }

            if ( isset( $_GET['mkdf-search-minSize'] ) ) {
                $params['property_min_size'] = $_GET['mkdf-search-minSize'];
            }

            if ( isset( $_GET['mkdf-search-maxSize'] ) ) {
                $params['property_max_size'] = $_GET['mkdf-search-maxSize'];
            }

            if ( isset( $_GET['mkdf-search-bedrooms'] ) ) {
                $params['property_bedrooms'] = $_GET['mkdf-search-bedrooms'];
            }

            if ( isset( $_GET['mkdf-search-bathrooms'] ) ) {
                $params['property_bathrooms'] = $_GET['mkdf-search-bathrooms'];
            }

            if ( isset( $_GET['mkdf-search-features'] ) ) {
                $params['property_features'] = $_GET['mkdf-search-features'];
            }
        }

        return $params;
    }

    add_filter( 'zuhaus_mikado_search_page_params', 'mkdf_re_property_override_search_params', 10, 1 );
}

if ( ! function_exists( 'mkdf_re_property_override_search_title' ) ) {
    function mkdf_re_property_override_search_title( $title ) {

        if ( isset( $_GET['mkdf-property-search'] ) ) {
            $title = esc_html__( 'List of filtered properties', 'mkdf-real-estate' );
        }

        return $title;
    }

    add_filter( 'zuhaus_mikado_title_text', 'mkdf_re_property_override_search_title', 10, 1 );
}

if ( ! function_exists( 'mkdf_re_property_override_search_title_display' ) ) {
    /**
     * Function that checks option for property archive title and overrides it with filter
     */
    function mkdf_re_property_override_search_title_display( $show_title_area ) {

        if ( isset( $_GET['mkdf-property-search'] ) ) {
            //Override displaying title based on property option
            $show_title_area_archive = zuhaus_mikado_options()->getOptionValue('show_title_area_property_archive');

            if ( ! empty( $show_title_area_archive ) ) {
                $show_title_area = $show_title_area_archive === 'yes' ? true : false;
            }
        }

        return $show_title_area;
    }

    add_filter( 'zuhaus_mikado_show_title_area', 'mkdf_re_property_override_search_title_display' );
}

if ( ! function_exists( 'mkdf_re_get_search_page_sc_params' ) ) {
    function mkdf_re_get_search_page_sc_params( $params ) {

        $posts_per_page     =  zuhaus_mikado_options()->getOptionValue( 'real_estate_archive_items_per_page' );
        $col_number         =  zuhaus_mikado_options()->getOptionValue( 'real_estate_archive_number_of_columns' );
        $col_space          =  zuhaus_mikado_options()->getOptionValue( 'real_estate_archive_space_between_items' );
        $image_size         =  zuhaus_mikado_options()->getOptionValue( 'real_estate_archive_image_size' );
        $enable_filter      =  zuhaus_mikado_options()->getOptionValue( 'real_estate_archive_filter' );
        $enable_map         =  zuhaus_mikado_options()->getOptionValue( 'real_estate_archive_map' );
        $enable_load_more   =  zuhaus_mikado_options()->getOptionValue( 'real_estate_archive_load_more' );

        $posts_per_page = $posts_per_page === '' ? '-1' : $posts_per_page;

        $shortcode_params = array(
            'number_of_items' => $posts_per_page,
            'number_of_columns' => $col_number,
            'space_between_items' => $col_space,
            'image_proportions' => $image_size,
            'enable_filter' => $enable_filter,
            'enable_map' => $enable_map,
            'pagination_type' => $enable_load_more,
            'hide_active_filter' => 'no',
        );

        $params = array_merge($params, $shortcode_params);

        return $params;
    }
}