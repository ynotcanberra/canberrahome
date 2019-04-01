<?php

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if ( function_exists( 'vc_set_as_theme' ) ) {
	vc_set_as_theme( true );
}

/**
 * Change path for overridden templates
 */
if ( function_exists( 'vc_set_shortcodes_templates_dir' ) ) {
	$dir = MIKADO_ROOT_DIR . '/vc-templates';
	vc_set_shortcodes_templates_dir( $dir );
}

if ( ! function_exists( 'zuhaus_mikado_configure_visual_composer_frontend_editor' ) ) {
	/**
	 * Configuration for Visual Composer FrontEnd Editor
	 * Hooks on vc_after_init action
	 */
	function zuhaus_mikado_configure_visual_composer_frontend_editor() {
		/**
		 * Remove frontend editor
		 */
		if ( function_exists( 'vc_disable_frontend' ) ) {
			vc_disable_frontend();
		}
	}
	
	add_action( 'vc_after_init', 'zuhaus_mikado_configure_visual_composer_frontend_editor' );
}

if ( ! function_exists( 'zuhaus_mikado_vc_row_map' ) ) {
	/**
	 * Map VC Row shortcode
	 * Hooks on vc_after_init action
	 */
	function zuhaus_mikado_vc_row_map() {
		
		/******* VC Row shortcode - begin *******/
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_content_width',
				'heading'    => esc_html__( 'Mikado Row Content Width', 'zuhaus' ),
				'value'      => array(
					esc_html__( 'Full Width', 'zuhaus' ) => 'full-width',
					esc_html__( 'In Grid', 'zuhaus' )    => 'grid'
				),
				'group'      => esc_html__( 'Mikado Settings', 'zuhaus' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'anchor',
				'heading'     => esc_html__( 'Mikado Anchor ID', 'zuhaus' ),
				'description' => esc_html__( 'For example "home"', 'zuhaus' ),
				'group'       => esc_html__( 'Mikado Settings', 'zuhaus' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'simple_background_color',
				'heading'    => esc_html__( 'Mikado Background Color', 'zuhaus' ),
				'group'      => esc_html__( 'Mikado Settings', 'zuhaus' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'attach_image',
				'param_name' => 'simple_background_image',
				'heading'    => esc_html__( 'Mikado Background Image', 'zuhaus' ),
				'group'      => esc_html__( 'Mikado Settings', 'zuhaus' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_background_image',
				'heading'     => esc_html__( 'Mikado Disable Background Image', 'zuhaus' ),
				'value'       => array(
					esc_html__( 'Never', 'zuhaus' )        => '',
					esc_html__( 'Below 1280px', 'zuhaus' ) => '1280',
					esc_html__( 'Below 1024px', 'zuhaus' ) => '1024',
					esc_html__( 'Below 768px', 'zuhaus' )  => '768',
					esc_html__( 'Below 680px', 'zuhaus' )  => '680',
					esc_html__( 'Below 480px', 'zuhaus' )  => '480'
				),
				'save_always' => true,
				'description' => esc_html__( 'Choose on which stage you hide row background image', 'zuhaus' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Mikado Settings', 'zuhaus' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'attach_image',
				'param_name' => 'parallax_background_image',
				'heading'    => esc_html__( 'Mikado Parallax Background Image', 'zuhaus' ),
				'group'      => esc_html__( 'Mikado Settings', 'zuhaus' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'parallax_bg_speed',
				'heading'     => esc_html__( 'Mikado Parallax Speed', 'zuhaus' ),
				'description' => esc_html__( 'Set your parallax speed. Default value is 1.', 'zuhaus' ),
				'dependency'  => array( 'element' => 'parallax_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Mikado Settings', 'zuhaus' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'parallax_bg_height',
				'heading'    => esc_html__( 'Mikado Parallax Section Height (px)', 'zuhaus' ),
				'dependency' => array( 'element' => 'parallax_background_image', 'not_empty' => true ),
				'group'      => esc_html__( 'Mikado Settings', 'zuhaus' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'content_text_aligment',
				'heading'    => esc_html__( 'Mikado Content Aligment', 'zuhaus' ),
				'value'      => array(
					esc_html__( 'Default', 'zuhaus' ) => '',
					esc_html__( 'Left', 'zuhaus' )    => 'left',
					esc_html__( 'Center', 'zuhaus' )  => 'center',
					esc_html__( 'Right', 'zuhaus' )   => 'right'
				),
				'group'      => esc_html__( 'Mikado Settings', 'zuhaus' )
			)
		);
		
		/******* VC Row shortcode - end *******/
		
		/******* VC Row Inner shortcode - begin *******/
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_content_width',
				'heading'    => esc_html__( 'Mikado Row Content Width', 'zuhaus' ),
				'value'      => array(
					esc_html__( 'Full Width', 'zuhaus' ) => 'full-width',
					esc_html__( 'In Grid', 'zuhaus' )    => 'grid'
				),
				'group'      => esc_html__( 'Mikado Settings', 'zuhaus' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'simple_background_color',
				'heading'    => esc_html__( 'Mikado Background Color', 'zuhaus' ),
				'group'      => esc_html__( 'Mikado Settings', 'zuhaus' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'attach_image',
				'param_name' => 'simple_background_image',
				'heading'    => esc_html__( 'Mikado Background Image', 'zuhaus' ),
				'group'      => esc_html__( 'Mikado Settings', 'zuhaus' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_background_image',
				'heading'     => esc_html__( 'Mikado Disable Background Image', 'zuhaus' ),
				'value'       => array(
					esc_html__( 'Never', 'zuhaus' )        => '',
					esc_html__( 'Below 1280px', 'zuhaus' ) => '1280',
					esc_html__( 'Below 1024px', 'zuhaus' ) => '1024',
					esc_html__( 'Below 768px', 'zuhaus' )  => '768',
					esc_html__( 'Below 680px', 'zuhaus' )  => '680',
					esc_html__( 'Below 480px', 'zuhaus' )  => '480'
				),
				'save_always' => true,
				'description' => esc_html__( 'Choose on which stage you hide row background image', 'zuhaus' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Mikado Settings', 'zuhaus' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'content_text_aligment',
				'heading'    => esc_html__( 'Mikado Content Aligment', 'zuhaus' ),
				'value'      => array(
					esc_html__( 'Default', 'zuhaus' ) => '',
					esc_html__( 'Left', 'zuhaus' )    => 'left',
					esc_html__( 'Center', 'zuhaus' )  => 'center',
					esc_html__( 'Right', 'zuhaus' )   => 'right'
				),
				'group'      => esc_html__( 'Mikado Settings', 'zuhaus' )
			)
		);
		
		/******* VC Row Inner shortcode - end *******/
		
		/******* VC Revolution Slider shortcode - begin *******/
		
		if ( zuhaus_mikado_revolution_slider_installed() ) {
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'enable_paspartu',
					'heading'     => esc_html__( 'Mikado Enable Passepartout', 'zuhaus' ),
					'value'       => array_flip( zuhaus_mikado_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'group'       => esc_html__( 'Mikado Settings', 'zuhaus' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'paspartu_size',
					'heading'     => esc_html__( 'Mikado Passepartout Size', 'zuhaus' ),
					'value'       => array(
						esc_html__( 'Tiny', 'zuhaus' )   => 'tiny',
						esc_html__( 'Small', 'zuhaus' )  => 'small',
						esc_html__( 'Normal', 'zuhaus' ) => 'normal',
						esc_html__( 'Large', 'zuhaus' )  => 'large'
					),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Mikado Settings', 'zuhaus' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'disable_side_paspartu',
					'heading'     => esc_html__( 'Mikado Disable Side Passepartout', 'zuhaus' ),
					'value'       => array_flip( zuhaus_mikado_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Mikado Settings', 'zuhaus' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'disable_top_paspartu',
					'heading'     => esc_html__( 'Mikado Disable Top Passepartout', 'zuhaus' ),
					'value'       => array_flip( zuhaus_mikado_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Mikado Settings', 'zuhaus' )
				)
			);
		}
		
		/******* VC Revolution Slider shortcode - end *******/
	}
	
	add_action( 'vc_after_init', 'zuhaus_mikado_vc_row_map' );
}