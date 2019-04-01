<?php

foreach ( glob( MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/blog/admin/meta-boxes/*/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'zuhaus_mikado_map_blog_meta' ) ) {
	function zuhaus_mikado_map_blog_meta() {
		$mkd_blog_categories = array();
		$categories           = get_categories();
		foreach ( $categories as $category ) {
			$mkd_blog_categories[ $category->slug ] = $category->name;
		}
		
		$blog_meta_box = zuhaus_mikado_add_meta_box(
			array(
				'scope' => array( 'page' ),
				'title' => esc_html__( 'Blog', 'zuhaus' ),
				'name'  => 'blog_meta'
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_blog_category_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Blog Category', 'zuhaus' ),
				'description' => esc_html__( 'Choose category of posts to display (leave empty to display all categories)', 'zuhaus' ),
				'parent'      => $blog_meta_box,
				'options'     => $mkd_blog_categories
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_show_posts_per_page_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Posts', 'zuhaus' ),
				'description' => esc_html__( 'Enter the number of posts to display', 'zuhaus' ),
				'parent'      => $blog_meta_box,
				'options'     => $mkd_blog_categories,
				'args'        => array( "col_width" => 3 )
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_blog_masonry_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Layout', 'zuhaus' ),
				'description' => esc_html__( 'Set masonry layout. Default is in grid.', 'zuhaus' ),
				'parent'      => $blog_meta_box,
				'options'     => array(
					''           => esc_html__( 'Default', 'zuhaus' ),
					'in-grid'    => esc_html__( 'In Grid', 'zuhaus' ),
					'full-width' => esc_html__( 'Full Width', 'zuhaus' )
				)
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_blog_masonry_number_of_columns_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Number of Columns', 'zuhaus' ),
				'description' => esc_html__( 'Set number of columns for your masonry blog lists', 'zuhaus' ),
				'parent'      => $blog_meta_box,
				'options'     => array(
					''      => esc_html__( 'Default', 'zuhaus' ),
					'two'   => esc_html__( '2 Columns', 'zuhaus' ),
					'three' => esc_html__( '3 Columns', 'zuhaus' ),
					'four'  => esc_html__( '4 Columns', 'zuhaus' ),
					'five'  => esc_html__( '5 Columns', 'zuhaus' )
				)
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_blog_masonry_space_between_items_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Space Between Items', 'zuhaus' ),
				'description' => esc_html__( 'Set space size between posts for your masonry blog lists', 'zuhaus' ),
				'options'     => zuhaus_mikado_get_space_between_items_array( true ),
				'parent'      => $blog_meta_box
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_blog_list_featured_image_proportion_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Featured Image Proportion', 'zuhaus' ),
				'description'   => esc_html__( 'Choose type of proportions you want to use for featured images on masonry blog lists', 'zuhaus' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''         => esc_html__( 'Default', 'zuhaus' ),
					'fixed'    => esc_html__( 'Fixed', 'zuhaus' ),
					'original' => esc_html__( 'Original', 'zuhaus' )
				)
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_blog_pagination_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Pagination Type', 'zuhaus' ),
				'description'   => esc_html__( 'Choose a pagination layout for Blog Lists', 'zuhaus' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''                => esc_html__( 'Default', 'zuhaus' ),
					'standard'        => esc_html__( 'Standard', 'zuhaus' ),
					'load-more'       => esc_html__( 'Load More', 'zuhaus' ),
					'infinite-scroll' => esc_html__( 'Infinite Scroll', 'zuhaus' ),
					'no-pagination'   => esc_html__( 'No Pagination', 'zuhaus' )
				)
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'type'          => 'text',
				'name'          => 'mkdf_number_of_chars_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Number of Words in Excerpt', 'zuhaus' ),
				'description'   => esc_html__( 'Enter a number of words in excerpt (article summary). Default value is 40', 'zuhaus' ),
				'parent'        => $blog_meta_box,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'zuhaus_mikado_meta_boxes_map', 'zuhaus_mikado_map_blog_meta', 30 );
}