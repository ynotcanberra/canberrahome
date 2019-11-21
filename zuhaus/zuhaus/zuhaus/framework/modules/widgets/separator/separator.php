<?php

class ZuhausMikadoSeparatorWidget extends ZuhausMikadoWidget {
	public function __construct() {
		parent::__construct(
			'mkdf_separator_widget',
			esc_html__( 'Mikado Separator Widget', 'zuhaus' ),
			array( 'description' => esc_html__( 'Add a separator element to your widget areas', 'zuhaus' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'    => 'dropdown',
				'name'    => 'type',
				'title'   => esc_html__( 'Type', 'zuhaus' ),
				'options' => array(
					'normal'     => esc_html__( 'Normal', 'zuhaus' ),
					'full-width' => esc_html__( 'Full Width', 'zuhaus' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'position',
				'title'   => esc_html__( 'Position', 'zuhaus' ),
				'options' => array(
					'center' => esc_html__( 'Center', 'zuhaus' ),
					'left'   => esc_html__( 'Left', 'zuhaus' ),
					'right'  => esc_html__( 'Right', 'zuhaus' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'border_style',
				'title'   => esc_html__( 'Style', 'zuhaus' ),
				'options' => array(
					'solid'  => esc_html__( 'Solid', 'zuhaus' ),
					'dashed' => esc_html__( 'Dashed', 'zuhaus' ),
					'dotted' => esc_html__( 'Dotted', 'zuhaus' )
				)
			),
			array(
				'type'  => 'textfield',
				'name'  => 'color',
				'title' => esc_html__( 'Color', 'zuhaus' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'width',
				'title' => esc_html__( 'Width (px or %)', 'zuhaus' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'thickness',
				'title' => esc_html__( 'Thickness (px)', 'zuhaus' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'top_margin',
				'title' => esc_html__( 'Top Margin (px or %)', 'zuhaus' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'bottom_margin',
				'title' => esc_html__( 'Bottom Margin (px or %)', 'zuhaus' )
			)
		);
	}
	
	public function widget( $args, $instance ) {
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}
		
		//prepare variables
		$params = '';
		
		//is instance empty?
		if ( is_array( $instance ) && count( $instance ) ) {
			//generate shortcode params
			foreach ( $instance as $key => $value ) {
				$params .= " $key='$value' ";
			}
		}
		
		echo '<div class="widget mkdf-separator-widget">';
			echo do_shortcode( "[mkdf_separator $params]" ); // XSS OK
		echo '</div>';
	}
}