<?php

if ( ! function_exists( 'mkdf_re_add_package_profile_navigation_item' ) ) {
    function mkdf_re_add_package_profile_navigation_item( $navigation, $dashboard_url ) {

        $navigation['user-packages'] = array(
            'url'         => esc_url( add_query_arg( array( 'user-action' => 'user-packages' ), $dashboard_url ) ),
            'text'        => esc_html__( 'My Packages', 'mkdf-real-estate' ),
            'user_action' => 'user-packages',
            'icon'          => '<span class="lnr lnr-briefcase"></span>'
        );

        return $navigation;
    }

    add_filter( 'mkdf_membership_dashboard_navigation_pages', 'mkdf_re_add_package_profile_navigation_item', 10, 2 );
}

if ( ! function_exists( 'mkdf_re_add_package_profile_navigation_pages' ) ) {
    function mkdf_re_add_package_profile_navigation_pages( $pages ) {
        $pages['user-packages']    = mkdf_re_cpt_single_module_template_part( 'profile/templates/user-packages', 'package' );

        return $pages;
    }

    add_filter( 'mkdf_membership_dashboard_pages', 'mkdf_re_add_package_profile_navigation_pages' );
}