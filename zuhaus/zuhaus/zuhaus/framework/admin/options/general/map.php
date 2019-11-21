<?php

if ( ! function_exists( 'zuhaus_mikado_general_options_map' ) ) {
	/**
	 * General options page
	 */
	function zuhaus_mikado_general_options_map() {
		
		zuhaus_mikado_add_admin_page(
			array(
				'slug'  => '',
				'title' => esc_html__( 'General', 'zuhaus' ),
				'icon'  => 'fa fa-institution'
			)
		);

		/***************** Logo Area Layout - start **********************/

		do_action( 'zuhaus_mikado_logo_options_map' );

		/***************** Logo Area Layout - end **********************/
		
		$panel_design_style = zuhaus_mikado_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_design_style',
				'title' => esc_html__( 'Appearance', 'zuhaus' )
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'          => 'google_fonts',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Google Font Family', 'zuhaus' ),
				'description'   => esc_html__( 'Choose a default Google font for your site', 'zuhaus' ),
				'parent'        => $panel_design_style
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'          => 'additional_google_fonts',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Additional Google Fonts', 'zuhaus' ),
				'parent'        => $panel_design_style,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkdf_additional_google_fonts_container"
				)
			)
		);
		
		$additional_google_fonts_container = zuhaus_mikado_add_admin_container(
			array(
				'parent'          => $panel_design_style,
				'name'            => 'additional_google_fonts_container',
				'hidden_property' => 'additional_google_fonts',
				'hidden_value'    => 'no'
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'          => 'additional_google_font1',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'zuhaus' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'zuhaus' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'          => 'additional_google_font2',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'zuhaus' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'zuhaus' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'          => 'additional_google_font3',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'zuhaus' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'zuhaus' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'          => 'additional_google_font4',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'zuhaus' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'zuhaus' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'          => 'additional_google_font5',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'zuhaus' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'zuhaus' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'          => 'google_font_weight',
				'type'          => 'checkboxgroup',
				'default_value' => '',
				'label'         => esc_html__( 'Google Fonts Style & Weight', 'zuhaus' ),
				'description'   => esc_html__( 'Choose a default Google font weights for your site. Impact on page load time', 'zuhaus' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'100'  => esc_html__( '100 Thin', 'zuhaus' ),
					'100i' => esc_html__( '100 Thin Italic', 'zuhaus' ),
					'200'  => esc_html__( '200 Extra-Light', 'zuhaus' ),
					'200i' => esc_html__( '200 Extra-Light Italic', 'zuhaus' ),
					'300'  => esc_html__( '300 Light', 'zuhaus' ),
					'300i' => esc_html__( '300 Light Italic', 'zuhaus' ),
					'400'  => esc_html__( '400 Regular', 'zuhaus' ),
					'400i' => esc_html__( '400 Regular Italic', 'zuhaus' ),
					'500'  => esc_html__( '500 Medium', 'zuhaus' ),
					'500i' => esc_html__( '500 Medium Italic', 'zuhaus' ),
					'600'  => esc_html__( '600 Semi-Bold', 'zuhaus' ),
					'600i' => esc_html__( '600 Semi-Bold Italic', 'zuhaus' ),
					'700'  => esc_html__( '700 Bold', 'zuhaus' ),
					'700i' => esc_html__( '700 Bold Italic', 'zuhaus' ),
					'800'  => esc_html__( '800 Extra-Bold', 'zuhaus' ),
					'800i' => esc_html__( '800 Extra-Bold Italic', 'zuhaus' ),
					'900'  => esc_html__( '900 Ultra-Bold', 'zuhaus' ),
					'900i' => esc_html__( '900 Ultra-Bold Italic', 'zuhaus' )
				)
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'          => 'google_font_subset',
				'type'          => 'checkboxgroup',
				'default_value' => '',
				'label'         => esc_html__( 'Google Fonts Subset', 'zuhaus' ),
				'description'   => esc_html__( 'Choose a default Google font subsets for your site', 'zuhaus' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'latin'        => esc_html__( 'Latin', 'zuhaus' ),
					'latin-ext'    => esc_html__( 'Latin Extended', 'zuhaus' ),
					'cyrillic'     => esc_html__( 'Cyrillic', 'zuhaus' ),
					'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'zuhaus' ),
					'greek'        => esc_html__( 'Greek', 'zuhaus' ),
					'greek-ext'    => esc_html__( 'Greek Extended', 'zuhaus' ),
					'vietnamese'   => esc_html__( 'Vietnamese', 'zuhaus' )
				)
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'        => 'first_color',
				'type'        => 'color',
				'label'       => esc_html__( 'First Main Color', 'zuhaus' ),
				'description' => esc_html__( 'Choose the most dominant theme color. Default color is #4dc7ed', 'zuhaus' ),
				'parent'      => $panel_design_style
			)
		);

		zuhaus_mikado_add_admin_field(
			array(
				'name'        => 'second_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Second Main Color', 'zuhaus' ),
				'description' => esc_html__( 'Choose the second most dominant theme color. Default color is #ffcc00', 'zuhaus' ),
				'parent'      => $panel_design_style
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'        => 'page_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Page Background Color', 'zuhaus' ),
				'description' => esc_html__( 'Choose the background color for page content. Default color is #ffffff', 'zuhaus' ),
				'parent'      => $panel_design_style
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'        => 'selection_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Text Selection Color', 'zuhaus' ),
				'description' => esc_html__( 'Choose the color users see when selecting text', 'zuhaus' ),
				'parent'      => $panel_design_style
			)
		);
		
		/***************** Passepartout Layout - begin **********************/
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'          => 'boxed',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Boxed Layout', 'zuhaus' ),
				'parent'        => $panel_design_style,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkdf_boxed_container"
				)
			)
		);
		
			$boxed_container = zuhaus_mikado_add_admin_container(
				array(
					'parent'          => $panel_design_style,
					'name'            => 'boxed_container',
					'hidden_property' => 'boxed',
					'hidden_value'    => 'no'
				)
			);
		
				zuhaus_mikado_add_admin_field(
					array(
						'name'        => 'page_background_color_in_box',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'zuhaus' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'zuhaus' ),
						'parent'      => $boxed_container
					)
				);
				
				zuhaus_mikado_add_admin_field(
					array(
						'name'        => 'boxed_background_image',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'zuhaus' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'zuhaus' ),
						'parent'      => $boxed_container
					)
				);
				
				zuhaus_mikado_add_admin_field(
					array(
						'name'        => 'boxed_pattern_background_image',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'zuhaus' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'zuhaus' ),
						'parent'      => $boxed_container
					)
				);
				
				zuhaus_mikado_add_admin_field(
					array(
						'name'          => 'boxed_background_image_attachment',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Attachment', 'zuhaus' ),
						'description'   => esc_html__( 'Choose background image attachment', 'zuhaus' ),
						'parent'        => $boxed_container,
						'options'       => array(
							''       => esc_html__( 'Default', 'zuhaus' ),
							'fixed'  => esc_html__( 'Fixed', 'zuhaus' ),
							'scroll' => esc_html__( 'Scroll', 'zuhaus' )
						)
					)
				);
		
		/***************** Boxed Layout - end **********************/
		
		/***************** Passepartout Layout - begin **********************/
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'          => 'paspartu',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Passepartout', 'zuhaus' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'zuhaus' ),
				'parent'        => $panel_design_style,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkdf_paspartu_container"
				)
			)
		);
		
			$paspartu_container = zuhaus_mikado_add_admin_container(
				array(
					'parent'          => $panel_design_style,
					'name'            => 'paspartu_container',
					'hidden_property' => 'paspartu',
					'hidden_value'    => 'no'
				)
			);
		
				zuhaus_mikado_add_admin_field(
					array(
						'name'        => 'paspartu_color',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'zuhaus' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'zuhaus' ),
						'parent'      => $paspartu_container
					)
				);
				
				zuhaus_mikado_add_admin_field(
					array(
						'name'        => 'paspartu_width',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'zuhaus' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'zuhaus' ),
						'parent'      => $paspartu_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
		
				zuhaus_mikado_add_admin_field(
					array(
						'name'        => 'paspartu_responsive_width',
						'type'        => 'text',
						'label'       => esc_html__( 'Responsive Passepartout Size', 'zuhaus' ),
						'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (tablets and mobiles view)', 'zuhaus' ),
						'parent'      => $paspartu_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
				
				zuhaus_mikado_add_admin_field(
					array(
						'parent'        => $paspartu_container,
						'type'          => 'yesno',
						'default_value' => 'no',
						'name'          => 'disable_top_paspartu',
						'label'         => esc_html__( 'Disable Top Passepartout', 'zuhaus' )
					)
				);
		
		/***************** Passepartout Layout - end **********************/
		
		/***************** Content Layout - begin **********************/
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'          => 'initial_content_width',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'zuhaus' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'zuhaus' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'mkdf-grid-1200' => esc_html__( '1200px - default', 'zuhaus' ),
					'mkdf-grid-1100' => esc_html__( '1100px', 'zuhaus' ),
					'mkdf-grid-1300' => esc_html__( '1300px', 'zuhaus' ),
					'mkdf-grid-1000' => esc_html__( '1000px', 'zuhaus' ),
					'mkdf-grid-800'  => esc_html__( '800px', 'zuhaus' )
				)
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'          => 'preload_pattern_image',
				'type'          => 'image',
				'label'         => esc_html__( 'Preload Pattern Image', 'zuhaus' ),
				'description'   => esc_html__( 'Choose preload pattern image to be displayed until images are loaded', 'zuhaus' ),
				'parent'        => $panel_design_style
			)
		);
		
		/***************** Content Layout - end **********************/
		
		$panel_settings = zuhaus_mikado_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_settings',
				'title' => esc_html__( 'Behavior', 'zuhaus' )
			)
		);
		
		/***************** Smooth Scroll Layout - begin **********************/
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'          => 'page_smooth_scroll',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Smooth Scroll', 'zuhaus' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth scrolling effect on every page (except on Mac and touch devices)', 'zuhaus' ),
				'parent'        => $panel_settings
			)
		);
		
		/***************** Smooth Scroll Layout - end **********************/
		
		/***************** Smooth Page Transitions Layout - begin **********************/
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'          => 'smooth_page_transitions',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Smooth Page Transitions', 'zuhaus' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'zuhaus' ),
				'parent'        => $panel_settings,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkdf_page_transitions_container"
				)
			)
		);
		
			$page_transitions_container = zuhaus_mikado_add_admin_container(
				array(
					'parent'          => $panel_settings,
					'name'            => 'page_transitions_container',
					'hidden_property' => 'smooth_page_transitions',
					'hidden_value'    => 'no'
				)
			);
		
				zuhaus_mikado_add_admin_field(
					array(
						'name'          => 'page_transition_preloader',
						'type'          => 'yesno',
						'default_value' => 'no',
						'label'         => esc_html__( 'Enable Preloading Animation', 'zuhaus' ),
						'description'   => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'zuhaus' ),
						'parent'        => $page_transitions_container,
						'args'          => array(
							"dependence"             => true,
							"dependence_hide_on_yes" => "",
							"dependence_show_on_yes" => "#mkdf_page_transition_preloader_container"
						)
					)
				);
				
				$page_transition_preloader_container = zuhaus_mikado_add_admin_container(
					array(
						'parent'          => $page_transitions_container,
						'name'            => 'page_transition_preloader_container',
						'hidden_property' => 'page_transition_preloader',
						'hidden_value'    => 'no'
					)
				);
		
		
					zuhaus_mikado_add_admin_field(
						array(
							'name'   => 'smooth_pt_bgnd_color',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'zuhaus' ),
							'parent' => $page_transition_preloader_container
						)
					);
					
					$group_pt_spinner_animation = zuhaus_mikado_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation',
							'title'       => esc_html__( 'Loader Style', 'zuhaus' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'zuhaus' ),
							'parent'      => $page_transition_preloader_container
						)
					);
					
					$row_pt_spinner_animation = zuhaus_mikado_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation',
							'parent' => $group_pt_spinner_animation
						)
					);
					
					zuhaus_mikado_add_admin_field(
						array(
							'type'          => 'selectsimple',
							'name'          => 'smooth_pt_spinner_type',
							'default_value' => '',
							'label'         => esc_html__( 'Spinner Type', 'zuhaus' ),
							'parent'        => $row_pt_spinner_animation,
							'options'       => array(
								'rotate_circles'        => esc_html__( 'Rotate Circles', 'zuhaus' ),
								'pulse'                 => esc_html__( 'Pulse', 'zuhaus' ),
								'double_pulse'          => esc_html__( 'Double Pulse', 'zuhaus' ),
								'cube'                  => esc_html__( 'Cube', 'zuhaus' ),
								'rotating_cubes'        => esc_html__( 'Rotating Cubes', 'zuhaus' ),
								'stripes'               => esc_html__( 'Stripes', 'zuhaus' ),
								'wave'                  => esc_html__( 'Wave', 'zuhaus' ),
								'two_rotating_circles'  => esc_html__( '2 Rotating Circles', 'zuhaus' ),
								'five_rotating_circles' => esc_html__( '5 Rotating Circles', 'zuhaus' ),
								'atom'                  => esc_html__( 'Atom', 'zuhaus' ),
								'clock'                 => esc_html__( 'Clock', 'zuhaus' ),
								'mitosis'               => esc_html__( 'Mitosis', 'zuhaus' ),
								'lines'                 => esc_html__( 'Lines', 'zuhaus' ),
								'fussion'               => esc_html__( 'Fussion', 'zuhaus' ),
								'wave_circles'          => esc_html__( 'Wave Circles', 'zuhaus' ),
								'pulse_circles'         => esc_html__( 'Pulse Circles', 'zuhaus' )
							)
						)
					);
					
					zuhaus_mikado_add_admin_field(
						array(
							'type'          => 'colorsimple',
							'name'          => 'smooth_pt_spinner_color',
							'default_value' => '',
							'label'         => esc_html__( 'Spinner Color', 'zuhaus' ),
							'parent'        => $row_pt_spinner_animation
						)
					);
					
					zuhaus_mikado_add_admin_field(
						array(
							'name'          => 'page_transition_fadeout',
							'type'          => 'yesno',
							'default_value' => 'no',
							'label'         => esc_html__( 'Enable Fade Out Animation', 'zuhaus' ),
							'description'   => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'zuhaus' ),
							'parent'        => $page_transitions_container
						)
					);
		
		/***************** Smooth Page Transitions Layout - end **********************/
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'          => 'show_back_button',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show "Back To Top Button"', 'zuhaus' ),
				'description'   => esc_html__( 'Enabling this option will display a Back to Top button on every page', 'zuhaus' ),
				'parent'        => $panel_settings
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'          => 'responsiveness',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Responsiveness', 'zuhaus' ),
				'description'   => esc_html__( 'Enabling this option will make all pages responsive', 'zuhaus' ),
				'parent'        => $panel_settings
			)
		);
		
		$panel_custom_code = zuhaus_mikado_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_custom_code',
				'title' => esc_html__( 'Custom Code', 'zuhaus' )
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'        => 'custom_js',
				'type'        => 'textarea',
				'label'       => esc_html__( 'Custom JS', 'zuhaus' ),
				'description' => esc_html__( 'Enter your custom Javascript here', 'zuhaus' ),
				'parent'      => $panel_custom_code
			)
		);
		
		$panel_google_api = zuhaus_mikado_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_google_api',
				'title' => esc_html__( 'Google API', 'zuhaus' )
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'name'        => 'google_maps_api_key',
				'type'        => 'text',
				'label'       => esc_html__( 'Google Maps Api Key', 'zuhaus' ),
				'description' => esc_html__( 'Insert your Google Maps API key here. For instructions on how to create a Google Maps API key, please refer to our to our documentation.', 'zuhaus' ),
				'parent'      => $panel_google_api
			)
		);
	}
	
	add_action( 'zuhaus_mikado_options_map', 'zuhaus_mikado_general_options_map', 1 );
}

if ( ! function_exists( 'zuhaus_mikado_page_general_style' ) ) {
	/**
	 * Function that prints page general inline styles
	 */
	function zuhaus_mikado_page_general_style( $style ) {
		$current_style = '';
		$page_id       = zuhaus_mikado_get_page_id();
		$class_prefix  = zuhaus_mikado_get_unique_page_class( $page_id );
		
		$boxed_background_style = array();
		
		$boxed_page_background_color = zuhaus_mikado_get_meta_field_intersect( 'page_background_color_in_box', $page_id );
		if ( ! empty( $boxed_page_background_color ) ) {
			$boxed_background_style['background-color'] = $boxed_page_background_color;
		}
		
		$boxed_page_background_image = zuhaus_mikado_get_meta_field_intersect( 'boxed_background_image', $page_id );
		if ( ! empty( $boxed_page_background_image ) ) {
			$boxed_background_style['background-image']    = 'url(' . esc_url( $boxed_page_background_image ) . ')';
			$boxed_background_style['background-position'] = 'center 0px';
			$boxed_background_style['background-repeat']   = 'no-repeat';
		}
		
		$boxed_page_background_pattern_image = zuhaus_mikado_get_meta_field_intersect( 'boxed_pattern_background_image', $page_id );
		if ( ! empty( $boxed_page_background_pattern_image ) ) {
			$boxed_background_style['background-image']    = 'url(' . esc_url( $boxed_page_background_pattern_image ) . ')';
			$boxed_background_style['background-position'] = '0px 0px';
			$boxed_background_style['background-repeat']   = 'repeat';
		}
		
		$boxed_page_background_attachment = zuhaus_mikado_get_meta_field_intersect( 'boxed_background_image_attachment', $page_id );
		if ( ! empty( $boxed_page_background_attachment ) ) {
			$boxed_background_style['background-attachment'] = $boxed_page_background_attachment;
		}
		
		$boxed_background_selector = $class_prefix . '.mkdf-boxed .mkdf-wrapper';
		
		if ( ! empty( $boxed_background_style ) ) {
			$current_style .= zuhaus_mikado_dynamic_css( $boxed_background_selector, $boxed_background_style );
		}
		
		$paspartu_style     = array();
		$paspartu_res_style = array();
		$paspartu_res_start = '@media only screen and (max-width: 1024px) {';
		$paspartu_res_end   = '}';
		
		$paspartu_color = zuhaus_mikado_get_meta_field_intersect( 'paspartu_color', $page_id );
		if ( ! empty( $paspartu_color ) ) {
			$paspartu_style['background-color'] = $paspartu_color;
		}
		
		$paspartu_width = zuhaus_mikado_get_meta_field_intersect( 'paspartu_width', $page_id );
		if ( $paspartu_width !== '' ) {
			if ( zuhaus_mikado_string_ends_with( $paspartu_width, '%' ) || zuhaus_mikado_string_ends_with( $paspartu_width, 'px' ) ) {
				$paspartu_style['padding'] = $paspartu_width;
			} else {
				$paspartu_style['padding'] = $paspartu_width . 'px';
			}
		}
		
		$paspartu_selector = $class_prefix . '.mkdf-paspartu-enabled .mkdf-wrapper';
		
		if ( ! empty( $paspartu_style ) ) {
			$current_style .= zuhaus_mikado_dynamic_css( $paspartu_selector, $paspartu_style );
		}
		
		$paspartu_responsive_width = zuhaus_mikado_get_meta_field_intersect( 'paspartu_responsive_width', $page_id );
		if ( $paspartu_responsive_width !== '' ) {
			if ( zuhaus_mikado_string_ends_with( $paspartu_responsive_width, '%' ) || zuhaus_mikado_string_ends_with( $paspartu_responsive_width, 'px' ) ) {
				$paspartu_res_style['padding'] = $paspartu_responsive_width;
			} else {
				$paspartu_res_style['padding'] = $paspartu_responsive_width . 'px';
			}
		}
		
		if ( ! empty( $paspartu_res_style ) ) {
			$current_style .= $paspartu_res_start . zuhaus_mikado_dynamic_css( $paspartu_selector, $paspartu_res_style ) . $paspartu_res_end;
		}
		
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'zuhaus_mikado_add_page_custom_style', 'zuhaus_mikado_page_general_style' );
}