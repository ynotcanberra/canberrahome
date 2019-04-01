<?php

if ( ! function_exists( 'zuhaus_mikado_register_image_gallery_widget' ) ) {
	/**
	 * Function that register image gallery widget
	 */
	function zuhaus_mikado_register_image_gallery_widget( $widgets ) {
		$widgets[] = 'ZuhausMikadoImageGalleryWidget';
		
		return $widgets;
	}
	
	add_filter( 'zuhaus_mikado_register_widgets', 'zuhaus_mikado_register_image_gallery_widget' );
}