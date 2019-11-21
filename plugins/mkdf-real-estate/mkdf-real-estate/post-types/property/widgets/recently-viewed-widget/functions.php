<?php

if ( ! function_exists( 'mkdf_re_register_recently_viewed_property_widget' ) ) {
    /**
     * Function that register recently viewed property widget
     */
    function mkdf_re_register_recently_viewed_property_widget( $widgets ) {
        $widgets[] = 'ZuhausMikadoRecentlyViewedPropertyWidget';

        return $widgets;
    }

    add_filter( 'zuhaus_mikado_register_widgets', 'mkdf_re_register_recently_viewed_property_widget' );
}