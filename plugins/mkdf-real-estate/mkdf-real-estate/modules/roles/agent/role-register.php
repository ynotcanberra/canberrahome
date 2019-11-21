<?php

if(!function_exists('mkdf_re_add_user_agent_role')) {
    function mkdf_re_add_user_agent_role() {
        $capabilities = array(
            'read' => true,
            'edit_posts' => true,
            'edit_pages' => false,
            'edit_others_posts' => false,
            'create_posts' => true,
            'manage_categories' => false,
            'publish_posts' => true,
            'edit_themes' => false,
            'install_plugins' => false,
            'update_plugin' => false,
            'update_core' => false,
            'upload_files' => false,
            'edit_files' => false,
            'assign_terms' => true
        );
        add_role( 'agent', esc_html__('Agent', 'mkdf-real-estate'), $capabilities);

    }

    add_action('mkdf_re_user_role_add', 'mkdf_re_add_user_agent_role');
}
if(!function_exists( 'mkdf_re_remove_user_agent_role' )) {
    function mkdf_re_remove_user_agent_role() {
        remove_role( 'agent' );
    }
    add_action('mkdf_re_user_role_remove', 'mkdf_re_remove_user_agent_role' );
}