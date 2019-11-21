<?php

if ( ! function_exists( 'zuhaus_mikado_woocommerce_options_map' ) ) {
	
	/**
	 * Add Woocommerce options page
	 */
	function zuhaus_mikado_woocommerce_options_map() {
		
		zuhaus_mikado_add_admin_page(
			array(
				'slug'  => '_woocommerce_page',
				'title' => esc_html__( 'Woocommerce', 'zuhaus' ),
				'icon'  => 'fa fa-shopping-cart'
			)
		);
		
		/**
		 * Product List Settings
		 */
		$panel_product_list = zuhaus_mikado_add_admin_panel(
			array(
				'page'  => '_woocommerce_page',
				'name'  => 'panel_product_list',
				'title' => esc_html__( 'Product List', 'zuhaus' )
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'mkdf_woo_product_list_columns',
				'label'         => esc_html__( 'Product List Columns', 'zuhaus' ),
				'default_value' => 'mkdf-woocommerce-columns-3',
				'description'   => esc_html__( 'Choose number of columns for product listing and related products on single product', 'zuhaus' ),
				'options'       => array(
					'mkdf-woocommerce-columns-3' => esc_html__( '3 Columns', 'zuhaus' ),
					'mkdf-woocommerce-columns-4' => esc_html__( '4 Columns', 'zuhaus' )
				),
				'parent'        => $panel_product_list,
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'mkdf_woo_product_list_columns_space',
				'label'         => esc_html__( 'Space Between Items', 'zuhaus' ),
				'description'   => esc_html__( 'Select space between items for product listing and related products on single product', 'zuhaus' ),
				'default_value' => 'normal',
				'options'       => zuhaus_mikado_get_space_between_items_array(),
				'parent'        => $panel_product_list,
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'mkdf_woo_products_per_page',
				'label'         => esc_html__( 'Number of products per page', 'zuhaus' ),
				'description'   => esc_html__( 'Set number of products on shop page', 'zuhaus' ),
				'parent'        => $panel_product_list,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'mkdf_products_list_title_tag',
				'label'         => esc_html__( 'Products Title Tag', 'zuhaus' ),
				'default_value' => 'h5',
				'options'       => zuhaus_mikado_get_title_tag(),
				'parent'        => $panel_product_list,
			)
		);
		
		/**
		 * Single Product Settings
		 */
		$panel_single_product = zuhaus_mikado_add_admin_panel(
			array(
				'page'  => '_woocommerce_page',
				'name'  => 'panel_single_product',
				'title' => esc_html__( 'Single Product', 'zuhaus' )
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_woo',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'zuhaus' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single post pages', 'zuhaus' ),
				'parent'        => $panel_single_product,
				'options'       => zuhaus_mikado_get_yes_no_select_array(),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'mkdf_single_product_title_tag',
				'default_value' => 'h2',
				'label'         => esc_html__( 'Single Product Title Tag', 'zuhaus' ),
				'options'       => zuhaus_mikado_get_title_tag(),
				'parent'        => $panel_single_product,
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_number_of_thumb_images',
				'default_value' => '3',
				'label'         => esc_html__( 'Number of Thumbnail Images per Row', 'zuhaus' ),
				'options'       => array(
					'4' => esc_html__( 'Four', 'zuhaus' ),
					'3' => esc_html__( 'Three', 'zuhaus' ),
					'2' => esc_html__( 'Two', 'zuhaus' )
				),
				'parent'        => $panel_single_product
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_enable_single_product_zoom_image',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Zoom Maginfier', 'zuhaus' ),
				'description'   => esc_html__( 'Enabling this option will show magnifier image on featured image hover', 'zuhaus' ),
				'parent'        => $panel_single_product,
				'options'       => zuhaus_mikado_get_yes_no_select_array( false ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		zuhaus_mikado_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_set_single_images_behavior',
				'default_value' => 'pretty-photo',
				'label'         => esc_html__( 'Set Images Behavior', 'zuhaus' ),
				'options'       => array(
					'pretty-photo' => esc_html__( 'Pretty Photo Lightbox', 'zuhaus' ),
					'photo-swipe'  => esc_html__( 'Photo Swipe Lightbox', 'zuhaus' )
				),
				'parent'        => $panel_single_product
			)
		);
	}
	
	add_action( 'zuhaus_mikado_options_map', 'zuhaus_mikado_woocommerce_options_map', 21 );
}