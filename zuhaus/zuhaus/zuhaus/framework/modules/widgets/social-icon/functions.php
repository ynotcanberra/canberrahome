<?php

if ( ! function_exists( 'zuhaus_mikado_register_social_icon_widget' ) ) {
	/**
	 * Function that register social icon widget
	 */
	function zuhaus_mikado_register_social_icon_widget( $widgets ) {
		$widgets[] = 'ZuhausMikadoSocialIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'zuhaus_mikado_register_widgets', 'zuhaus_mikado_register_social_icon_widget' );
}