<?php
if(!function_exists('mkdf_re_property_search_shortcode_helper')) {
    function mkdf_re_property_search_shortcode_helper($shortcodes_class_name) {
        $shortcodes = array(
            'MikadofRE\CPT\Shortcodes\Property\PropertySearch'
        );

        $shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

        return $shortcodes_class_name;
    }

    add_filter('mkdf_re_filter_add_vc_shortcode', 'mkdf_re_property_search_shortcode_helper');
}

if( !function_exists('mkdf_re_set_property_search_icon_class_name_for_vc_shortcodes') ) {
    /**
     * Function that set custom icon class name for property slider shortcode to set our icon for Visual Composer shortcodes panel
     */
    function mkdf_re_set_property_search_icon_class_name_for_vc_shortcodes($shortcodes_icon_class_array) {
        $shortcodes_icon_class_array[] = '.icon-wpb-property-search';

        return $shortcodes_icon_class_array;
    }

    add_filter('mkdf_re_filter_add_vc_shortcodes_custom_icon_class', 'mkdf_re_set_property_search_icon_class_name_for_vc_shortcodes');
}