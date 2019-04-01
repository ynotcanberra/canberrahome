<?php

if ( ! function_exists( 'zuhaus_mikado_register_blog_list_widget' ) ) {
	/**
	 * Function that register blog list widget
	 */
	function zuhaus_mikado_register_blog_list_widget( $widgets ) {
		$widgets[] = 'ZuhausMikadoBlogListWidget';
		
		return $widgets;
	}
	
	add_filter( 'zuhaus_mikado_register_widgets', 'zuhaus_mikado_register_blog_list_widget' );
}