<?php

if ( ! function_exists( 'zuhaus_mikado_side_area_slide_from_right_type_style' ) ) {
	function zuhaus_mikado_side_area_slide_from_right_type_style() {
		$width = zuhaus_mikado_options()->getOptionValue( 'side_area_width' );
		
		if ( $width !== '' ) {
			echo zuhaus_mikado_dynamic_css( '.mkdf-side-menu-slide-from-right .mkdf-side-menu', array(
				'right' => '-' . zuhaus_mikado_filter_px( $width ) . 'px',
				'width' => zuhaus_mikado_filter_px( $width ) . 'px'
			) );
		}
	}
	
	add_action( 'zuhaus_mikado_style_dynamic', 'zuhaus_mikado_side_area_slide_from_right_type_style' );
}

if ( ! function_exists( 'zuhaus_mikado_side_area_icon_color_styles' ) ) {
	function zuhaus_mikado_side_area_icon_color_styles() {
		$icon_color             = zuhaus_mikado_options()->getOptionValue( 'side_area_icon_color' );
		$icon_hover_color       = zuhaus_mikado_options()->getOptionValue( 'side_area_icon_hover_color' );
		$close_icon_color       = zuhaus_mikado_options()->getOptionValue( 'side_area_close_icon_color' );
		$close_icon_hover_color = zuhaus_mikado_options()->getOptionValue( 'side_area_close_icon_hover_color' );
		
		$icon_hover_selector = array(
			'.mkdf-side-menu-button-opener:hover',
			'.mkdf-side-menu-button-opener.opened'
		);
		
		if ( ! empty( $icon_color ) ) {
			echo zuhaus_mikado_dynamic_css( '.mkdf-side-menu-button-opener', array(
				'color' => $icon_color
			) );
		}
		
		if ( ! empty( $icon_hover_color ) ) {
			echo zuhaus_mikado_dynamic_css( $icon_hover_selector, array(
				'color' => $icon_hover_color . '!important'
			) );
		}
		
		if ( ! empty( $close_icon_color ) ) {
			echo zuhaus_mikado_dynamic_css( '.mkdf-side-menu a.mkdf-close-side-menu', array(
				'color' => $close_icon_color
			) );
		}
		
		if ( ! empty( $close_icon_hover_color ) ) {
			echo zuhaus_mikado_dynamic_css( '.mkdf-side-menu a.mkdf-close-side-menu:hover', array(
				'color' => $close_icon_hover_color
			) );
		}
	}
	
	add_action( 'zuhaus_mikado_style_dynamic', 'zuhaus_mikado_side_area_icon_color_styles' );
}

if ( ! function_exists( 'zuhaus_mikado_side_area_styles' ) ) {
	function zuhaus_mikado_side_area_styles() {
		$side_area_styles = array();
		$background_color = zuhaus_mikado_options()->getOptionValue( 'side_area_background_color' );
		$padding          = zuhaus_mikado_options()->getOptionValue( 'side_area_padding' );
		$text_alignment   = zuhaus_mikado_options()->getOptionValue( 'side_area_aligment' );
		
		if ( ! empty( $background_color ) ) {
			$side_area_styles['background-color'] = $background_color;
		}
		
		if ( ! empty( $padding ) ) {
			$side_area_styles['padding'] = esc_attr( $padding );
		}
		
		if ( ! empty( $text_alignment ) ) {
			$side_area_styles['text-align'] = $text_alignment;
		}
		
		if ( ! empty( $side_area_styles ) ) {
			echo zuhaus_mikado_dynamic_css( '.mkdf-side-menu', $side_area_styles );
		}
		
		if ( $text_alignment === 'center' ) {
			echo zuhaus_mikado_dynamic_css( '.mkdf-side-menu .widget img', array(
				'margin' => '0 auto'
			) );
		}
	}
	
	add_action( 'zuhaus_mikado_style_dynamic', 'zuhaus_mikado_side_area_styles' );
}