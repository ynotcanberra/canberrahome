<?php

if ( ! function_exists( 'mkdf_re_register_mortgage_calculator_property_widget' ) ) {
    /**
     * Function that register recently viewed property widget
     */
    function mkdf_re_register_mortgage_calculator_property_widget( $widgets ) {
        $widgets[] = 'ZuhausMikadoMortgageCalculatorWidget';

        return $widgets;
    }

    add_filter( 'zuhaus_mikado_register_widgets', 'mkdf_re_register_mortgage_calculator_property_widget' );
}