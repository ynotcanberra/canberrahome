<?php
if(!function_exists('mkdf_re_package_list_shortcode_helper')) {
    function mkdf_re_package_list_shortcode_helper($shortcodes_class_name) {
        $shortcodes = array(
            'MikadofRE\CPT\Shortcodes\Package\PackageList'
        );

        $shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

        return $shortcodes_class_name;
    }

    add_filter('mkdf_re_filter_add_vc_shortcode', 'mkdf_re_package_list_shortcode_helper');
}

if( !function_exists('mkdf_re_set_package_list_icon_class_name_for_vc_shortcodes') ) {
    /**
     * Function that set custom icon class name for package list shortcode to set our icon for Visual Composer shortcodes panel
     */
    function mkdf_re_set_package_list_icon_class_name_for_vc_shortcodes($shortcodes_icon_class_array) {
        $shortcodes_icon_class_array[] = '.icon-wpb-package-list';

        return $shortcodes_icon_class_array;
    }

    add_filter('mkdf_re_filter_add_vc_shortcodes_custom_icon_class', 'mkdf_re_set_package_list_icon_class_name_for_vc_shortcodes');
}

if(!function_exists('mkdf_re_package_list_shortcode_item_values')) {
    function mkdf_re_package_list_shortcode_item_values($package_id) {
        $values = array();

        //Generate Listings included
        $unlimited_packages = get_post_meta($package_id, 'mkdf_package_unlimited_listings_meta', true);
        if($unlimited_packages === 'yes') {
            $listings_included = esc_html__('Unlimited listings', 'mkdf-real-estate');
        } else {
            $listings_included = get_post_meta($package_id, 'mkdf_package_listings_included_meta', true);
        }
        $values['listings_inluded'] = $listings_included;

        //Generate Featured listings included
        $number_of_featured_listings = get_post_meta($package_id, 'mkdf_package_featured_listings_included_meta', true);
        $values['featured_inluded'] = $number_of_featured_listings;

        //Generate duration of package
        $package_duration = get_post_meta($package_id, 'mkdf_package_duration_meta', true);
        $package_duration = !isset($package_duration) && !empty($package_duration) ? $package_duration : 12;
        $values['duration'] = $package_duration;

        //Generate price of package
        $package_price = get_post_meta($package_id, 'mkdf_package_price_meta', true);
        $values['price'] = $package_price;

        //Generate currency of package
        $package_currency = mkdf_re_is_woocommerce_installed() ? get_woocommerce_currency_symbol() : '';
        $values['currency'] = $package_currency;

        return $values;
    }
}