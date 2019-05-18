<?php

if ( ! function_exists( 'mkdf_re_register_contact_property_widget' ) ) {
    /**
     * Function that register contact property widget
     */
    function mkdf_re_register_contact_property_widget( $widgets ) {
        $widgets[] = 'ZuhausMikadoContactPropertyWidget';

        return $widgets;
    }

    add_filter( 'zuhaus_mikado_register_widgets', 'mkdf_re_register_contact_property_widget' );
}