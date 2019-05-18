<?php
/*
Plugin Name: Mikado Real Estate
Description: Plugin that adds post types for Real Estate extension
Author: Mikado Themes
Version: 1.2.1
*/

require_once 'load.php';

add_action('after_setup_theme', array(MikadofRE\CPT\PostTypesRegister::getInstance(), 'register'));

if(!function_exists('mkdf_re_activation')) {
    /**
     * Triggers when plugin is activated. It calls flush_rewrite_rules
     * and defines zuhaus_mikado_re_on_activate action
     */
    function mkdf_re_activation() {
        do_action('zuhaus_mikado_re_on_activate');

        MikadofRE\CPT\PostTypesRegister::getInstance()->register();
        flush_rewrite_rules();
    }

    register_activation_hook(__FILE__, 'mkdf_re_activation');
}

if(!function_exists('mkd_re_text_domain')) {
    /**
     * Loads plugin text domain so it can be used in translation
     */
    function mkd_re_text_domain() {
        load_plugin_textdomain('mkdf-real-estate', false, MIKADO_RE_REL_PATH.'/languages');
    }

    add_action('plugins_loaded', 'mkd_re_text_domain');
}

if ( ! function_exists( 'mkdf_re_scripts' ) ) {
    /**
     * Loads plugin scripts
     */
    function mkdf_re_scripts() {
        $array_deps_css            = array();
        $array_deps_css_responsive = array();
        $array_deps_js             = array();

        if ( mkdf_re_theme_installed() ) {
            $array_deps_css[]            = 'zuhaus_mikado_modules';
            $array_deps_css_responsive[] = 'zuhaus_mikado_modules_responsive';
            $array_deps_js[]             = 'zuhaus_mikado_modules';
            $array_deps_js[]             = 'zuhaus_mikado_google_map_api';
        }

        wp_enqueue_style( 'mkdf_re_style', plugins_url( MIKADO_RE_REL_PATH . '/assets/css/real-estate.min.css' ), $array_deps_css );
        if ( zuhaus_mikado_is_responsive_on() ) {
            wp_enqueue_style( 'mkdf_re_responsive_style', plugins_url( MIKADO_RE_REL_PATH . '/assets/css/real-estate-responsive.min.css' ), $array_deps_css_responsive );
        }

        wp_enqueue_script( 'jquery-ui-slider' );
        if(wp_is_mobile()) {
            wp_enqueue_script( 'jquery-touch-punch' );
        }
        wp_enqueue_script( 'mkdf_re_script', plugins_url( MIKADO_RE_REL_PATH . '/assets/js/real-estate.min.js' ), $array_deps_js, false, true );
    }

    add_action( 'wp_enqueue_scripts', 'mkdf_re_scripts' );
}

if ( ! function_exists( 'mkdf_re_style_dynamics_deps' ) ) {
    function mkdf_re_style_dynamics_deps( $deps ) {
        $style_dynamic_deps_array   = array();
        $style_dynamic_deps_array[] = 'mkdf_re_style';

        if ( zuhaus_mikado_is_responsive_on() ) {
            $style_dynamic_deps_array[] = 'mkdf_re_responsive_style';
        }

        return array_merge( $deps, $style_dynamic_deps_array );
    }

    add_filter( 'zuhaus_mikado_style_dynamic_deps', 'mkdf_re_style_dynamics_deps' );
}

if ( ! function_exists( 'mkdf_re_modules_css_deps' ) ) {
    function mkdf_re_modules_css_deps( $deps ) {
        $modules_css_deps_array = array();
        if( wp_style_is('select2', 'registered') ) {
            $modules_css_deps_array[] = 'select2';
        }

        return array_merge($deps, $modules_css_deps_array);
    }

    add_filter('zuhaus_mikado_modules_css_deps','mkdf_re_modules_css_deps');
}

if(!function_exists('mkdf_re_version_class')) {
	/**
	 * Adds plugins version class to body
	 * @param $classes
	 * @return array
	 */
	function mkdf_re_version_class($classes) {
		$classes[] = 'mkd-re-'.MIKADO_RE_VERSION;
		
		return $classes;
	}
	
	add_filter('body_class', 'mkdf_re_version_class');
}

if(!function_exists('mkdf_re_add_maps_extensions')) {
    function mkdf_re_add_maps_extensions($extensions) {
        $items = array(
            'geometry',
            'places'
        );
        $extensions = array_unique( array_merge( $extensions, $items ) );

        return $extensions;
    }
    add_filter('zuhaus_mikado_google_maps_extensions_array', 'mkdf_re_add_maps_extensions', 10, 1);
}

if(!function_exists('mkd_re_enable_maps_in_admin')) {
    /**
     * Loads plugin text domain so it can be used in translation
     */
    function mkd_re_enable_maps_in_admin() {
        return true;
    }

    add_action('zuhaus_mikado_google_maps_in_backend', 'mkd_re_enable_maps_in_admin');
}

if(!function_exists('mkdf_re_theme_installed')) {
	/**
	 * Checks whether theme is installed or not
	 * @return bool
	 */
	function mkdf_re_theme_installed() {
		return defined('MIKADO_ROOT');
	}
}

if (!function_exists('mkdf_re_is_woocommerce_installed')) {
	/**
	 * Function that checks if woocommerce is installed
	 * @return bool
	 */
	function mkdf_re_is_woocommerce_installed() {
		return function_exists('is_woocommerce');
	}
}

if(!function_exists('mkdf_re_is_revolution_slider_installed')) {
	function mkdf_re_is_revolution_slider_installed() {
		return class_exists('RevSliderFront');
	}
}

if ( ! function_exists( 'mkdf_re_mkdf_woocommerce_integration_installed' ) ) {
    //is Mikado Woocommerce Integration?
    function mkdf_re_mkdf_woocommerce_integration_installed() {
        return defined( 'MIKADO_WOOCOMMERCE_CHECKOUT_INTEGRATION' );
    }
}

if ( ! function_exists( 'mkdf_re_mkdf_membership_installed' ) ) {
    /**
     * Function that checks if Mikado Membership plugin installed
     * @return bool
     */
    function mkdf_re_mkdf_membership_installed() {
        return defined( 'MIKADO_MEMBERSHIP_VERSION' );
    }
}