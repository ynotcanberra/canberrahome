<?php

if ( ! function_exists( 'zuhaus_mikado_get_hide_dep_for_full_screen_menu_options' ) ) {
	function zuhaus_mikado_get_hide_dep_for_full_screen_menu_options() {
		$hide_dep_options = apply_filters( 'zuhaus_mikado_full_screen_menu_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'zuhaus_mikado_fullscreen_menu_options_map' ) ) {
	function zuhaus_mikado_fullscreen_menu_options_map() {
		$hide_dep_options = zuhaus_mikado_get_hide_dep_for_full_screen_menu_options();
		
		$fullscreen_panel = zuhaus_mikado_add_admin_panel(
			array(
				'title'           => esc_html__( 'Full Screen Menu', 'zuhaus' ),
				'name'            => 'panel_fullscreen_menu',
				'page'            => '_header_page',
				'hidden_property' => 'header_type',
				'hidden_values'   => $hide_dep_options
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $fullscreen_panel,
				'type'          => 'select',
				'name'          => 'fullscreen_menu_animation_style',
				'default_value' => 'fade-push-text-right',
				'label'         => esc_html__( 'Full Screen Menu Overlay Animation', 'zuhaus' ),
				'description'   => esc_html__( 'Choose animation type for full screen menu overlay', 'zuhaus' ),
				'options'       => array(
					'fade-push-text-right' => esc_html__( 'Fade Push Text Right', 'zuhaus' ),
					'fade-push-text-top'   => esc_html__( 'Fade Push Text Top', 'zuhaus' ),
					'fade-text-scaledown'  => esc_html__( 'Fade Text Scaledown', 'zuhaus' )
				)
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $fullscreen_panel,
				'type'          => 'yesno',
				'name'          => 'fullscreen_in_grid',
				'default_value' => 'no',
				'label'         => esc_html__( 'Full Screen Menu in Grid', 'zuhaus' ),
				'description'   => esc_html__( 'Enabling this option will put full screen menu content in grid', 'zuhaus' ),
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $fullscreen_panel,
				'type'          => 'selectblank',
				'name'          => 'fullscreen_alignment',
				'default_value' => '',
				'label'         => esc_html__( 'Full Screen Menu Alignment', 'zuhaus' ),
				'description'   => esc_html__( 'Choose alignment for full screen menu content', 'zuhaus' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'zuhaus' ),
					'left'   => esc_html__( 'Left', 'zuhaus' ),
					'center' => esc_html__( 'Center', 'zuhaus' ),
					'right'  => esc_html__( 'Right', 'zuhaus' )
				)
			)
		);
		
		$background_group = zuhaus_mikado_add_admin_group(
			array(
				'parent'      => $fullscreen_panel,
				'name'        => 'background_group',
				'title'       => esc_html__( 'Background', 'zuhaus' ),
				'description' => esc_html__( 'Select a background color and transparency for full screen menu (0 = fully transparent, 1 = opaque)', 'zuhaus' )
			)
		);
		
		$background_group_row = zuhaus_mikado_add_admin_row(
			array(
				'parent' => $background_group,
				'name'   => 'background_group_row'
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent' => $background_group_row,
				'type'   => 'colorsimple',
				'name'   => 'fullscreen_menu_background_color',
				'label'  => esc_html__( 'Background Color', 'zuhaus' )
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent' => $background_group_row,
				'type'   => 'textsimple',
				'name'   => 'fullscreen_menu_background_transparency',
				'label'  => esc_html__( 'Background Transparency', 'zuhaus' )
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'      => $fullscreen_panel,
				'type'        => 'image',
				'name'        => 'fullscreen_menu_background_image',
				'label'       => esc_html__( 'Background Image', 'zuhaus' ),
				'description' => esc_html__( 'Choose a background image for full screen menu background', 'zuhaus' )
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'      => $fullscreen_panel,
				'type'        => 'image',
				'name'        => 'fullscreen_menu_pattern_image',
				'label'       => esc_html__( 'Pattern Background Image', 'zuhaus' ),
				'description' => esc_html__( 'Choose a pattern image for full screen menu background', 'zuhaus' )
			)
		);
		
		//1st level style group
		$first_level_style_group = zuhaus_mikado_add_admin_group(
			array(
				'parent'      => $fullscreen_panel,
				'name'        => 'first_level_style_group',
				'title'       => esc_html__( '1st Level Style', 'zuhaus' ),
				'description' => esc_html__( 'Define styles for 1st level in full screen menu', 'zuhaus' )
			)
		);
		
		$first_level_style_row1 = zuhaus_mikado_add_admin_row(
			array(
				'parent' => $first_level_style_group,
				'name'   => 'first_level_style_row1'
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $first_level_style_row1,
				'type'          => 'colorsimple',
				'name'          => 'fullscreen_menu_color',
				'default_value' => '',
				'label'         => esc_html__( 'Text Color', 'zuhaus' ),
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $first_level_style_row1,
				'type'          => 'colorsimple',
				'name'          => 'fullscreen_menu_hover_color',
				'default_value' => '',
				'label'         => esc_html__( 'Hover Text Color', 'zuhaus' ),
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $first_level_style_row1,
				'type'          => 'colorsimple',
				'name'          => 'fullscreen_menu_active_color',
				'default_value' => '',
				'label'         => esc_html__( 'Active Text Color', 'zuhaus' ),
			)
		);
		
		$first_level_style_row3 = zuhaus_mikado_add_admin_row(
			array(
				'parent' => $first_level_style_group,
				'name'   => 'first_level_style_row3'
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $first_level_style_row3,
				'type'          => 'fontsimple',
				'name'          => 'fullscreen_menu_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'zuhaus' ),
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $first_level_style_row3,
				'type'          => 'textsimple',
				'name'          => 'fullscreen_menu_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'zuhaus' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $first_level_style_row3,
				'type'          => 'textsimple',
				'name'          => 'fullscreen_menu_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'zuhaus' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$first_level_style_row4 = zuhaus_mikado_add_admin_row(
			array(
				'parent' => $first_level_style_group,
				'name'   => 'first_level_style_row4'
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $first_level_style_row4,
				'type'          => 'selectblanksimple',
				'name'          => 'fullscreen_menu_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'zuhaus' ),
				'options'       => zuhaus_mikado_get_font_style_array()
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $first_level_style_row4,
				'type'          => 'selectblanksimple',
				'name'          => 'fullscreen_menu_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'zuhaus' ),
				'options'       => zuhaus_mikado_get_font_weight_array()
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $first_level_style_row4,
				'type'          => 'textsimple',
				'name'          => 'fullscreen_menu_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Lettert Spacing', 'zuhaus' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $first_level_style_row4,
				'type'          => 'selectblanksimple',
				'name'          => 'fullscreen_menu_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'zuhaus' ),
				'options'       => zuhaus_mikado_get_text_transform_array()
			)
		);
		
		//2nd level style group
		$second_level_style_group = zuhaus_mikado_add_admin_group(
			array(
				'parent'      => $fullscreen_panel,
				'name'        => 'second_level_style_group',
				'title'       => esc_html__( '2nd Level Style', 'zuhaus' ),
				'description' => esc_html__( 'Define styles for 2nd level in full screen menu', 'zuhaus' )
			)
		);
		
		$second_level_style_row1 = zuhaus_mikado_add_admin_row(
			array(
				'parent' => $second_level_style_group,
				'name'   => 'second_level_style_row1'
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $second_level_style_row1,
				'type'          => 'colorsimple',
				'name'          => 'fullscreen_menu_color_2nd',
				'default_value' => '',
				'label'         => esc_html__( 'Text Color', 'zuhaus' ),
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $second_level_style_row1,
				'type'          => 'colorsimple',
				'name'          => 'fullscreen_menu_hover_color_2nd',
				'default_value' => '',
				'label'         => esc_html__( 'Hover/Active Text Color', 'zuhaus' ),
			)
		);
		
		$second_level_style_row2 = zuhaus_mikado_add_admin_row(
			array(
				'parent' => $second_level_style_group,
				'name'   => 'second_level_style_row2'
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $second_level_style_row2,
				'type'          => 'fontsimple',
				'name'          => 'fullscreen_menu_google_fonts_2nd',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'zuhaus' ),
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $second_level_style_row2,
				'type'          => 'textsimple',
				'name'          => 'fullscreen_menu_font_size_2nd',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'zuhaus' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $second_level_style_row2,
				'type'          => 'textsimple',
				'name'          => 'fullscreen_menu_line_height_2nd',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'zuhaus' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$second_level_style_row3 = zuhaus_mikado_add_admin_row(
			array(
				'parent' => $second_level_style_group,
				'name'   => 'second_level_style_row3'
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $second_level_style_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'fullscreen_menu_font_style_2nd',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'zuhaus' ),
				'options'       => zuhaus_mikado_get_font_style_array()
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $second_level_style_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'fullscreen_menu_font_weight_2nd',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'zuhaus' ),
				'options'       => zuhaus_mikado_get_font_weight_array()
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $second_level_style_row3,
				'type'          => 'textsimple',
				'name'          => 'fullscreen_menu_letter_spacing_2nd',
				'default_value' => '',
				'label'         => esc_html__( 'Lettert Spacing', 'zuhaus' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $second_level_style_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'fullscreen_menu_text_transform_2nd',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'zuhaus' ),
				'options'       => zuhaus_mikado_get_text_transform_array()
			)
		);
		
		$third_level_style_group = zuhaus_mikado_add_admin_group(
			array(
				'parent'      => $fullscreen_panel,
				'name'        => 'third_level_style_group',
				'title'       => esc_html__( '3rd Level Style', 'zuhaus' ),
				'description' => esc_html__( 'Define styles for 3rd level in full screen menu', 'zuhaus' )
			)
		);
		
		$third_level_style_row1 = zuhaus_mikado_add_admin_row(
			array(
				'parent' => $third_level_style_group,
				'name'   => 'third_level_style_row1'
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $third_level_style_row1,
				'type'          => 'colorsimple',
				'name'          => 'fullscreen_menu_color_3rd',
				'default_value' => '',
				'label'         => esc_html__( 'Text Color', 'zuhaus' ),
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $third_level_style_row1,
				'type'          => 'colorsimple',
				'name'          => 'fullscreen_menu_hover_color_3rd',
				'default_value' => '',
				'label'         => esc_html__( 'Hover/Active Text Color', 'zuhaus' ),
			)
		);
		
		$third_level_style_row2 = zuhaus_mikado_add_admin_row(
			array(
				'parent' => $third_level_style_group,
				'name'   => 'second_level_style_row2'
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $third_level_style_row2,
				'type'          => 'fontsimple',
				'name'          => 'fullscreen_menu_google_fonts_3rd',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'zuhaus' ),
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $third_level_style_row2,
				'type'          => 'textsimple',
				'name'          => 'fullscreen_menu_font_size_3rd',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'zuhaus' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $third_level_style_row2,
				'type'          => 'textsimple',
				'name'          => 'fullscreen_menu_line_height_3rd',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'zuhaus' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$third_level_style_row3 = zuhaus_mikado_add_admin_row(
			array(
				'parent' => $third_level_style_group,
				'name'   => 'second_level_style_row3'
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $third_level_style_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'fullscreen_menu_font_style_3rd',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'zuhaus' ),
				'options'       => zuhaus_mikado_get_font_style_array()
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $third_level_style_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'fullscreen_menu_font_weight_3rd',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'zuhaus' ),
				'options'       => zuhaus_mikado_get_font_weight_array()
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $third_level_style_row3,
				'type'          => 'textsimple',
				'name'          => 'fullscreen_menu_letter_spacing_3rd',
				'default_value' => '',
				'label'         => esc_html__( 'Lettert Spacing', 'zuhaus' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent'        => $third_level_style_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'fullscreen_menu_text_transform_3rd',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'zuhaus' ),
				'options'       => zuhaus_mikado_get_text_transform_array()
			)
		);
		
		$icon_colors_group = zuhaus_mikado_add_admin_group(
			array(
				'parent'      => $fullscreen_panel,
				'name'        => 'fullscreen_menu_icon_colors_group',
				'title'       => esc_html__( 'Full Screen Menu Icon Style', 'zuhaus' ),
				'description' => esc_html__( 'Define styles for full screen menu icon', 'zuhaus' )
			)
		);
		
		$icon_colors_row1 = zuhaus_mikado_add_admin_row(
			array(
				'parent' => $icon_colors_group,
				'name'   => 'icon_colors_row1'
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent' => $icon_colors_row1,
				'type'   => 'colorsimple',
				'name'   => 'fullscreen_menu_icon_color',
				'label'  => esc_html__( 'Color', 'zuhaus' ),
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent' => $icon_colors_row1,
				'type'   => 'colorsimple',
				'name'   => 'fullscreen_menu_icon_hover_color',
				'label'  => esc_html__( 'Hover Color', 'zuhaus' ),
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent' => $icon_colors_row1,
				'type'   => 'colorsimple',
				'name'   => 'fullscreen_menu_icon_mobile_color',
				'label'  => esc_html__( 'Mobile Color', 'zuhaus' ),
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'parent' => $icon_colors_row1,
				'type'   => 'colorsimple',
				'name'   => 'fullscreen_menu_icon_mobile_hover_color',
				'label'  => esc_html__( 'Mobile Hover Color', 'zuhaus' ),
			)
		);
	}
	
	add_action( 'zuhaus_mikado_additional_header_menu_area_options_map', 'zuhaus_mikado_fullscreen_menu_options_map' );
}