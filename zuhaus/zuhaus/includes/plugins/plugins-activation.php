<?php

if(!function_exists('zuhaus_mikado_register_required_plugins')) {
    /**
     * Registers theme required and optional plugins. Hooks to tgmpa_register hook
     */
    function zuhaus_mikado_register_required_plugins() {
        $plugins = array(
            array(
                'name'               => esc_html__('WPBakery Visual Composer', 'zuhaus'),
                'slug'               => 'js_composer',
                'source'             => get_template_directory().'/includes/plugins/js_composer.zip',
                'version'            => '5.4.7',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false
            ),
            array(
                'name'               => esc_html__('Revolution Slider', 'zuhaus'),
                'slug'               => 'revslider',
                'source'             => get_template_directory().'/includes/plugins/revslider.zip',
                'version'            => '5.4.7.2',
                'required'           => false,
                'force_activation'   => false,
                'force_deactivation' => false
            ),
            array(
                'name'               => esc_html__('Mikado Core', 'zuhaus'),
                'slug'               => 'mkdf-core',
                'source'             => get_template_directory().'/includes/plugins/mkdf-core.zip',
                'version'            => '1.0.1',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false
            ),
            array(
                'name'               => esc_html__('Mikado Instagram Feed', 'zuhaus'),
                'slug'               => 'mkdf-instagram-feed',
                'source'             => get_template_directory().'/includes/plugins/mkdf-instagram-feed.zip',
                'version'            => '1.0',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false
            ),
            array(
                'name'               => esc_html__('Mikado Twitter Feed', 'zuhaus'),
                'slug'               => 'mkdf-twitter-feed',
                'source'             => get_template_directory().'/includes/plugins/mkdf-twitter-feed.zip',
                'version'            => '1.0',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false
            ),
            array(
                'name'               => esc_html__('Mikado Membership', 'zuhaus'),
                'slug'               => 'mkdf-membership',
                'source'             => get_template_directory().'/includes/plugins/mkdf-membership.zip',
                'version'            => '1.0',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false
            ),
            array(
                'name'               => esc_html__('Mikado Real Estate', 'zuhaus'),
                'slug'               => 'mkdf-real-estate',
                'source'             => get_template_directory().'/includes/plugins/mkdf-real-estate.zip',
                'version'            => '1.2',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false
            ),
            array(
                'name'               => esc_html__('Mikado Woocommerce Checkout Integration', 'zuhaus'),
                'slug'               => 'mkdf-checkout',
                'source'             => get_template_directory().'/includes/plugins/mkdf-checkout.zip',
                'required'           => true,
                'version'            => '1.0',
                'force_activation'   => false,
                'force_deactivation' => false
            ),
	        array(
		        'name'         => esc_html__( 'WooCommerce', 'zuhaus' ),
		        'slug'         => 'woocommerce',
		        'external_url' => 'https://wordpress.org/plugins/woocommerce/',
		        'required'     => false
	        ),
	        array(
		        'name'         => esc_html__( 'Contact Form 7', 'zuhaus' ),
		        'slug'         => 'contact-form-7',
		        'external_url' => 'https://wordpress.org/plugins/contact-form-7/',
		        'required'     => false
	        ),
            array(
	            'name'               => esc_html__('Envato Market', 'zuhaus'),
	            'slug'               => 'envato-market',
	            'source'             => get_template_directory().'/includes/plugins/envato-market.zip',
	            'version'            => '2.0.0',
	            'required'           => true,
	            'force_activation'   => false,
	            'force_deactivation' => false
            )
        );

        $config = array(
            'domain'           => 'zuhaus',
            'default_path'     => '',
            'parent_slug' 	   => 'themes.php',
            'capability' 	   => 'edit_theme_options',
            'menu'             => 'install-required-plugins',
            'has_notices'      => true,
            'is_automatic'     => false,
            'message'          => '',
            'strings'          => array(
                'page_title'                      => esc_html__('Install Required Plugins', 'zuhaus'),
                'menu_title'                      => esc_html__('Install Plugins', 'zuhaus'),
                'installing'                      => esc_html__('Installing Plugin: %s', 'zuhaus'),
                'oops'                            => esc_html__('Something went wrong with the plugin API.', 'zuhaus'),
                'notice_can_install_required'     => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'zuhaus'),
                'notice_can_install_recommended'  => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'zuhaus'),
                'notice_cannot_install'           => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'zuhaus'),
                'notice_can_activate_required'    => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'zuhaus'),
                'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'zuhaus'),
                'notice_cannot_activate'          => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'zuhaus'),
                'notice_ask_to_update'            => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'zuhaus'),
                'notice_cannot_update'            => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'zuhaus'),
                'install_link'                    => _n_noop('Begin installing plugin', 'Begin installing plugins', 'zuhaus'),
                'activate_link'                   => _n_noop('Activate installed plugin', 'Activate installed plugins', 'zuhaus'),
                'return'                          => esc_html__('Return to Required Plugins Installer', 'zuhaus'),
                'plugin_activated'                => esc_html__('Plugin activated successfully.', 'zuhaus'),
                'complete'                        => esc_html__('All plugins installed and activated successfully. %s', 'zuhaus'),
                'nag_type'                        => 'updated'
            )
        );

        tgmpa($plugins, $config);
    }

    add_action('tgmpa_register', 'zuhaus_mikado_register_required_plugins');
}