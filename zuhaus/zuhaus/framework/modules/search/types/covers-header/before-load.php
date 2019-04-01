<?php

if ( ! function_exists( 'zuhaus_mikado_set_search_covers_header_global_option' ) ) {
    /**
     * This function set search type value for search options map
     */
    function zuhaus_mikado_set_search_covers_header_global_option( $search_type_options ) {
        $search_type_options['covers-header'] = esc_html__( 'Covers Header', 'zuhaus' );

        return $search_type_options;
    }

    add_filter( 'zuhaus_mikado_search_type_global_option', 'zuhaus_mikado_set_search_covers_header_global_option' );
}