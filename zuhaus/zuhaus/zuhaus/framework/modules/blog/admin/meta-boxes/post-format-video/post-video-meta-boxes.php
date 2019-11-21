<?php

if ( ! function_exists( 'zuhaus_mikado_map_post_video_meta' ) ) {
	function zuhaus_mikado_map_post_video_meta() {
		$video_post_format_meta_box = zuhaus_mikado_add_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Video Post Format', 'zuhaus' ),
				'name'  => 'post_format_video_meta'
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_video_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Video Type', 'zuhaus' ),
				'description'   => esc_html__( 'Choose video type', 'zuhaus' ),
				'parent'        => $video_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Video Service', 'zuhaus' ),
					'self'            => esc_html__( 'Self Hosted', 'zuhaus' )
				),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						'social_networks' => '#mkdf_mkdf_video_self_hosted_container',
						'self'            => '#mkdf_mkdf_video_embedded_container'
					),
					'show'       => array(
						'social_networks' => '#mkdf_mkdf_video_embedded_container',
						'self'            => '#mkdf_mkdf_video_self_hosted_container'
					)
				)
			)
		);
		
		$mkdf_video_embedded_container = zuhaus_mikado_add_admin_container(
			array(
				'parent'          => $video_post_format_meta_box,
				'name'            => 'mkdf_video_embedded_container',
				'hidden_property' => 'mkdf_video_type_meta',
				'hidden_value'    => 'self'
			)
		);
		
		$mkdf_video_self_hosted_container = zuhaus_mikado_add_admin_container(
			array(
				'parent'          => $video_post_format_meta_box,
				'name'            => 'mkdf_video_self_hosted_container',
				'hidden_property' => 'mkdf_video_type_meta',
				'hidden_value'    => 'social_networks'
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_post_video_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video URL', 'zuhaus' ),
				'description' => esc_html__( 'Enter Video URL', 'zuhaus' ),
				'parent'      => $mkdf_video_embedded_container,
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_post_video_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video MP4', 'zuhaus' ),
				'description' => esc_html__( 'Enter video URL for MP4 format', 'zuhaus' ),
				'parent'      => $mkdf_video_self_hosted_container,
			)
		);
		
		zuhaus_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_post_video_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Video Image', 'zuhaus' ),
				'description' => esc_html__( 'Enter video image', 'zuhaus' ),
				'parent'      => $mkdf_video_self_hosted_container,
			)
		);
	}
	
	add_action( 'zuhaus_mikado_meta_boxes_map', 'zuhaus_mikado_map_post_video_meta', 22 );
}