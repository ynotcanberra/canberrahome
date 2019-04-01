<?php

if(!function_exists('zuhaus_mikado_register_sticky_sidebar_widget')) {
	/**
	 * Function that register sticky sidebar widget
	 */
	function zuhaus_mikado_register_sticky_sidebar_widget($widgets) {
		$widgets[] = 'ZuhausMikadoStickySidebar';
		
		return $widgets;
	}
	
	add_filter('zuhaus_mikado_register_widgets', 'zuhaus_mikado_register_sticky_sidebar_widget');
}