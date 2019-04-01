<?php

class ZuhausMikadoButtonWidget extends ZuhausMikadoWidget {
	public function __construct() {
		parent::__construct(
			'mkdf_button_widget',
			esc_html__( 'Mikado Button Widget', 'zuhaus' ),
			array( 'description' => esc_html__( 'Add button element to widget areas', 'zuhaus' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array_merge(
			zuhaus_mikado_icon_collections()->getIconWidgetParamsArray(),
			array(
				array(
					'type'    => 'dropdown',
					'name'    => 'type',
					'title'   => esc_html__( 'Type', 'zuhaus' ),
					'options' => array(
						'solid'   => esc_html__( 'Solid', 'zuhaus' ),
						'outline' => esc_html__( 'Outline', 'zuhaus' ),
						'simple'  => esc_html__( 'Simple', 'zuhaus' )
					)
				),
				array(
					'type'        => 'dropdown',
					'name'        => 'size',
					'title'       => esc_html__( 'Size', 'zuhaus' ),
					'options'     => array(
						'small'  => esc_html__( 'Small', 'zuhaus' ),
						'medium' => esc_html__( 'Medium', 'zuhaus' ),
						'large'  => esc_html__( 'Large', 'zuhaus' ),
						'huge'   => esc_html__( 'Huge', 'zuhaus' )
					),
					'description' => esc_html__( 'This option is only available for solid and outline button type', 'zuhaus' )
				),
				array(
					'type'    => 'textfield',
					'name'    => 'text',
					'title'   => esc_html__( 'Text', 'zuhaus' ),
					'default' => esc_html__( 'Button Text', 'zuhaus' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'link',
					'title' => esc_html__( 'Link', 'zuhaus' )
				),
				array(
					'type'    => 'dropdown',
					'name'    => 'target',
					'title'   => esc_html__( 'Link Target', 'zuhaus' ),
					'options' => zuhaus_mikado_get_link_target_array()
				),
                array(
                    'type'        => 'dropdown',
                    'name'  => 'text_transform',
                    'title'       => esc_html__( 'Text Transform', 'zuhaus' ),
                    'options'     => zuhaus_mikado_get_text_transform_array( true )
                ),
				array(
					'type'  => 'textfield',
					'name'  => 'color',
					'title' => esc_html__( 'Color', 'zuhaus' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'hover_color',
					'title' => esc_html__( 'Hover Color', 'zuhaus' )
				),
				array(
					'type'        => 'textfield',
					'name'        => 'background_color',
					'title'       => esc_html__( 'Background Color', 'zuhaus' ),
					'description' => esc_html__( 'This option is only available for solid button type', 'zuhaus' )
				),
				array(
					'type'        => 'textfield',
					'name'        => 'hover_background_color',
					'title'       => esc_html__( 'Hover Background Color', 'zuhaus' ),
					'description' => esc_html__( 'This option is only available for solid button type', 'zuhaus' )
				),
				array(
					'type'        => 'textfield',
					'name'        => 'border_color',
					'title'       => esc_html__( 'Border Color', 'zuhaus' ),
					'description' => esc_html__( 'This option is only available for solid and outline button type', 'zuhaus' )
				),
				array(
					'type'        => 'textfield',
					'name'        => 'hover_border_color',
					'title'       => esc_html__( 'Hover Border Color', 'zuhaus' ),
					'description' => esc_html__( 'This option is only available for solid and outline button type', 'zuhaus' )
				),
				array(
					'type'        => 'textfield',
					'name'        => 'margin',
					'title'       => esc_html__( 'Margin', 'zuhaus' ),
					'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'zuhaus' )
				)
			)
		);
	}
	
	public function widget( $args, $instance ) {
		$params = '';
		
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}
		
		// Filter out all empty params
		$instance = array_filter( $instance, function ( $array_value ) {
			return trim( $array_value ) != '';
		} );
		
		// Default values
		if ( ! isset( $instance['text'] ) ) {
			$instance['text'] = 'Button Text';
		}
		
		// Generate shortcode params
		foreach ( $instance as $key => $value ) {
			$params .= " $key='$value' ";
		}
		
		echo '<div class="widget mkdf-button-widget">';
			echo do_shortcode( "[mkdf_button $params]" ); // XSS OK
		echo '</div>';
	}
}