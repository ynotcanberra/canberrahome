<?php

if ( ! function_exists( 'zuhaus_mikado_like' ) ) {
	/**
	 * Returns ZuhausMikadoLike instance
	 *
	 * @return ZuhausMikadoLike
	 */
	function zuhaus_mikado_like() {
		return ZuhausMikadoLike::get_instance();
	}
}

function zuhaus_mikado_get_like() {
	
	echo wp_kses( zuhaus_mikado_like()->add_like(), array(
		'span' => array(
			'class'       => true,
			'aria-hidden' => true,
			'style'       => true,
			'id'          => true
		),
		'i'    => array(
			'class' => true,
			'style' => true,
			'id'    => true
		),
		'a'    => array(
			'href'  => true,
			'class' => true,
			'id'    => true,
			'title' => true,
			'style' => true
		)
	) );
}