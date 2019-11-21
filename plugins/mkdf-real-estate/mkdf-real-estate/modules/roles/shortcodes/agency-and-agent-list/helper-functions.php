<?php
if(!function_exists('mkdf_re_agency_and_agent_list_shortcode_helper')) {
    function mkdf_re_agency_and_agent_list_shortcode_helper($shortcodes_class_name) {
        $shortcodes = array(
            'MikadofRE\CPT\Shortcodes\AgencyAndAgentList\AgencyAndAgentList'
        );

        $shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

        return $shortcodes_class_name;
    }

    add_filter('mkdf_re_filter_add_vc_shortcode', 'mkdf_re_agency_and_agent_list_shortcode_helper');
}

if( !function_exists('mkdf_re_set_agency_and_agent_list_icon_class_name_for_vc_shortcodes') ) {
    /**
     * Function that set custom icon class name for agency and agent list shortcode to set our icon for Visual Composer shortcodes panel
     */
    function mkdf_re_set_agency_and_agent_list_icon_class_name_for_vc_shortcodes($shortcodes_icon_class_array) {
        $shortcodes_icon_class_array[] = '.icon-wpb-agency-and-agent-list';

        return $shortcodes_icon_class_array;
    }

    add_filter('mkdf_re_filter_add_vc_shortcodes_custom_icon_class', 'mkdf_re_set_agency_and_agent_list_icon_class_name_for_vc_shortcodes');
}