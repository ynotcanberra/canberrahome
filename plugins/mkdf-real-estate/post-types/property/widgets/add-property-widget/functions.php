<?php

if ( ! function_exists( 'mkdf_re_register_add_property_widget' ) ) {
    /**
     * Function that register add property widget
     */
    function mkdf_re_register_add_property_widget( $widgets ) {
        $widgets[] = 'ZuhausMikadoAddPropertyWidget';

        return $widgets;
    }

    add_filter( 'zuhaus_mikado_register_widgets', 'mkdf_re_register_add_property_widget' );
}