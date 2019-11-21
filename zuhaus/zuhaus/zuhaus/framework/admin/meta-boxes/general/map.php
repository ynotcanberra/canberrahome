<?php

if ( ! function_exists( 'zuhaus_mikado_map_general_meta' ) ) {
	function zuhaus_mikado_map_general_meta() {
		
		$general_meta_box = zuhaus_mikado_add_meta_box(
			array(
				'scope' => apply_filters( 'zuhaus_mikado_set_scope_for_meta_boxes', array( 'page', 'post' ) ),
				'title' => esc_html__( 'General', 'zuhaus' ),
				'name'  => 'general_meta'
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_page_slider_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Slider Shortcode', 'zuhaus' ),
				'description' => esc_html__( 'Paste your slider shortcode here', 'zuhaus' ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		/***************** Content Layout - begin **********************/
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_page_content_behind_header_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Always put content behind header', 'zuhaus' ),
				'description'   => esc_html__( 'Enabling this option will put page content behind page header', 'zuhaus' ),
				'parent'        => $general_meta_box
			)
		);
		
		$mkdf_content_padding_group = zuhaus_mikado_add_admin_group(
			array(
				'name'        => 'content_padding_group',
				'title'       => esc_html__( 'Content Style', 'zuhaus' ),
				'description' => esc_html__( 'Define styles for Content area', 'zuhaus' ),
				'parent'      => $general_meta_box
			)
		);
		
			$mkdf_content_padding_row = zuhaus_mikado_add_admin_row(
				array(
					'name'   => 'mkdf_content_padding_row',
					'next'   => true,
					'parent' => $mkdf_content_padding_group
				)
			);
		
				zuhaus_mikado_add_meta_box_field(
					array(
						'name'   => 'mkdf_page_content_top_padding',
						'type'   => 'textsimple',
						'label'  => esc_html__( 'Content Top Padding', 'zuhaus' ),
						'parent' => $mkdf_content_padding_row,
						'args'   => array(
							'suffix' => 'px'
						)
					)
				);
				
				zuhaus_mikado_add_meta_box_field(
					array(
						'name'    => 'mkdf_page_content_top_padding_mobile',
						'type'    => 'selectsimple',
						'label'   => esc_html__( 'Set this top padding for mobile header', 'zuhaus' ),
						'parent'  => $mkdf_content_padding_row,
						'options' => zuhaus_mikado_get_yes_no_select_array( false )
					)
				);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_page_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Page Background Color', 'zuhaus' ),
				'description' => esc_html__( 'Choose background color for page content', 'zuhaus' ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Content Layout - end **********************/
		
		/***************** Boxed Layout - begin **********************/
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'    => 'mkdf_boxed_meta',
				'type'    => 'select',
				'label'   => esc_html__( 'Boxed Layout', 'zuhaus' ),
				'parent'  => $general_meta_box,
				'options' => zuhaus_mikado_get_yes_no_select_array(),
				'args'    => array(
					'dependence' => true,
					'hide'       => array(
						''    => '#mkdf_boxed_container_meta',
						'no'  => '#mkdf_boxed_container_meta',
						'yes' => ''
					),
					'show'       => array(
						''    => '',
						'no'  => '',
						'yes' => '#mkdf_boxed_container_meta'
					)
				)
			)
		);
		
			$boxed_container_meta = zuhaus_mikado_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'boxed_container_meta',
					'hidden_property' => 'mkdf_boxed_meta',
					'hidden_values'   => array(
						'',
						'no'
					)
				)
			);
		
				zuhaus_mikado_add_meta_box_field(
					array(
						'name'        => 'mkdf_page_background_color_in_box_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'zuhaus' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'zuhaus' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				zuhaus_mikado_add_meta_box_field(
					array(
						'name'        => 'mkdf_boxed_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'zuhaus' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'zuhaus' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				zuhaus_mikado_add_meta_box_field(
					array(
						'name'        => 'mkdf_boxed_pattern_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'zuhaus' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'zuhaus' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				zuhaus_mikado_add_meta_box_field(
					array(
						'name'          => 'mkdf_boxed_background_image_attachment_meta',
						'type'          => 'select',
						'default_value' => 'fixed',
						'label'         => esc_html__( 'Background Image Attachment', 'zuhaus' ),
						'description'   => esc_html__( 'Choose background image attachment', 'zuhaus' ),
						'parent'        => $boxed_container_meta,
						'options'       => array(
							''       => esc_html__( 'Default', 'zuhaus' ),
							'fixed'  => esc_html__( 'Fixed', 'zuhaus' ),
							'scroll' => esc_html__( 'Scroll', 'zuhaus' )
						)
					)
				);
		
		/***************** Boxed Layout - end **********************/
		
		/***************** Passepartout Layout - begin **********************/
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_paspartu_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Passepartout', 'zuhaus' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'zuhaus' ),
				'parent'        => $general_meta_box,
				'options'       => zuhaus_mikado_get_yes_no_select_array(),
				'args'    => array(
					'dependence'    => true,
					'hide'          => array(
						''    => '#mkdf_mkdf_paspartu_container_meta',
						'no'  => '#mkdf_mkdf_paspartu_container_meta',
						'yes' => ''
					),
					'show'          => array(
						''    => '',
						'no'  => '',
						'yes' => '#mkdf_mkdf_paspartu_container_meta'
					)
				)
			)
		);
		
			$paspartu_container_meta = zuhaus_mikado_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'mkdf_paspartu_container_meta',
					'hidden_property' => 'mkdf_paspartu_meta',
					'hidden_values'   => array(
						'',
						'no'
					)
				)
			);
		
				zuhaus_mikado_add_meta_box_field(
					array(
						'name'        => 'mkdf_paspartu_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'zuhaus' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'zuhaus' ),
						'parent'      => $paspartu_container_meta
					)
				);
				
				zuhaus_mikado_add_meta_box_field(
					array(
						'name'        => 'mkdf_paspartu_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'zuhaus' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'zuhaus' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
		
				zuhaus_mikado_add_meta_box_field(
					array(
						'name'        => 'mkdf_paspartu_responsive_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Responsive Passepartout Size', 'zuhaus' ),
						'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (tablets and mobiles view)', 'zuhaus' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
				
				zuhaus_mikado_add_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'mkdf_disable_top_paspartu_meta',
						'label'         => esc_html__( 'Disable Top Passepartout', 'zuhaus' ),
						'options'       => zuhaus_mikado_get_yes_no_select_array(),
					)
				);
		
		/***************** Passepartout Layout - end **********************/
		
		/***************** Content Width Layout - begin **********************/
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_initial_content_width_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'zuhaus' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'zuhaus' ),
				'parent'        => $general_meta_box,
				'options'       => array(
					''                => esc_html__( 'Default', 'zuhaus' ),
					'mkdf-grid-1100' => esc_html__( '1100px', 'zuhaus' ),
					'mkdf-grid-1300' => esc_html__( '1300px', 'zuhaus' ),
					'mkdf-grid-1200' => esc_html__( '1200px', 'zuhaus' ),
					'mkdf-grid-1000' => esc_html__( '1000px', 'zuhaus' ),
					'mkdf-grid-800'  => esc_html__( '800px', 'zuhaus' )
				)
			)
		);
		
		/***************** Content Width Layout - end **********************/
		
		/***************** Smooth Page Transitions Layout - begin **********************/
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_smooth_page_transitions_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Smooth Page Transitions', 'zuhaus' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'zuhaus' ),
				'parent'        => $general_meta_box,
				'options'       => zuhaus_mikado_get_yes_no_select_array(),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''    => '#mkdf_page_transitions_container_meta',
						'no'  => '#mkdf_page_transitions_container_meta',
						'yes' => ''
					),
					'show'       => array(
						''    => '',
						'no'  => '',
						'yes' => '#mkdf_page_transitions_container_meta'
					)
				)
			)
		);
		
			$page_transitions_container_meta = zuhaus_mikado_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'page_transitions_container_meta',
					'hidden_property' => 'mkdf_smooth_page_transitions_meta',
					'hidden_values'   => array(
						'',
						'no'
					)
				)
			);
		
				zuhaus_mikado_add_meta_box_field(
					array(
						'name'        => 'mkdf_page_transition_preloader_meta',
						'type'        => 'select',
						'label'       => esc_html__( 'Enable Preloading Animation', 'zuhaus' ),
						'description' => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'zuhaus' ),
						'parent'      => $page_transitions_container_meta,
						'options'     => zuhaus_mikado_get_yes_no_select_array(),
						'args'        => array(
							'dependence' => true,
							'hide'       => array(
								''    => '#mkdf_page_transition_preloader_container_meta',
								'no'  => '#mkdf_page_transition_preloader_container_meta',
								'yes' => ''
							),
							'show'       => array(
								''    => '',
								'no'  => '',
								'yes' => '#mkdf_page_transition_preloader_container_meta'
							)
						)
					)
				);
				
				$page_transition_preloader_container_meta = zuhaus_mikado_add_admin_container(
					array(
						'parent'          => $page_transitions_container_meta,
						'name'            => 'page_transition_preloader_container_meta',
						'hidden_property' => 'mkdf_page_transition_preloader_meta',
						'hidden_values'   => array(
							'',
							'no'
						)
					)
				);
				
					zuhaus_mikado_add_meta_box_field(
						array(
							'name'   => 'mkdf_smooth_pt_bgnd_color_meta',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'zuhaus' ),
							'parent' => $page_transition_preloader_container_meta
						)
					);
					
					$group_pt_spinner_animation_meta = zuhaus_mikado_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation_meta',
							'title'       => esc_html__( 'Loader Style', 'zuhaus' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'zuhaus' ),
							'parent'      => $page_transition_preloader_container_meta
						)
					);
					
					$row_pt_spinner_animation_meta = zuhaus_mikado_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation_meta',
							'parent' => $group_pt_spinner_animation_meta
						)
					);
					
					zuhaus_mikado_add_meta_box_field(
						array(
							'type'    => 'selectsimple',
							'name'    => 'mkdf_smooth_pt_spinner_type_meta',
							'label'   => esc_html__( 'Spinner Type', 'zuhaus' ),
							'parent'  => $row_pt_spinner_animation_meta,
							'options' => array(
								''                      => esc_html__( 'Default', 'zuhaus' ),
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
					
					zuhaus_mikado_add_meta_box_field(
						array(
							'type'   => 'colorsimple',
							'name'   => 'mkdf_smooth_pt_spinner_color_meta',
							'label'  => esc_html__( 'Spinner Color', 'zuhaus' ),
							'parent' => $row_pt_spinner_animation_meta
						)
					);
					
					zuhaus_mikado_add_meta_box_field(
						array(
							'name'        => 'mkdf_page_transition_fadeout_meta',
							'type'        => 'select',
							'label'       => esc_html__( 'Enable Fade Out Animation', 'zuhaus' ),
							'description' => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'zuhaus' ),
							'options'     => zuhaus_mikado_get_yes_no_select_array(),
							'parent'      => $page_transitions_container_meta
						
						)
					);
		
		/***************** Smooth Page Transitions Layout - end **********************/
		
		/***************** Comments Layout - begin **********************/
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_page_comments_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Show Comments', 'zuhaus' ),
				'description' => esc_html__( 'Enabling this option will show comments on your page', 'zuhaus' ),
				'parent'      => $general_meta_box,
				'options'     => zuhaus_mikado_get_yes_no_select_array()
			)
		);
		
		/***************** Comments Layout - end **********************/
	}
	
	add_action( 'zuhaus_mikado_meta_boxes_map', 'zuhaus_mikado_map_general_meta', 10 );
}