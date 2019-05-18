<?php

if ( ! function_exists( 'mkdf_re_include_property_widgets_loaders' ) ) {
    /**
     * Loads all custom post types by going through all folders that are placed directly in post types folder
     */
    function mkdf_re_include_property_widgets_loaders() {
        if ( mkdf_re_theme_installed() ) {
            foreach ( glob( MIKADO_RE_CPT_PATH . '/property/widgets/*/load.php' ) as $widget_load ) {
                include_once $widget_load;
            }
        }
    }

    add_action( 'zuhaus_mikado_before_options_map', 'mkdf_re_include_property_widgets_loaders', 20 ); //Priority needs to be bigger than 10 so abstract widget class is loaded first
}