<?php

if(!function_exists('zuhaus_mikado_map_woocommerce_meta')) {
    function zuhaus_mikado_map_woocommerce_meta() {
        $woocommerce_meta_box = zuhaus_mikado_add_meta_box(
            array(
                'scope' => array('product'),
                'title' => esc_html__('Product Meta', 'zuhaus'),
                'name' => 'woo_product_meta'
            )
        );

        zuhaus_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_product_featured_image_size',
            'type'        => 'select',
            'label'       => esc_html__('Dimensions for Product List Shortcode', 'zuhaus'),
            'description' => esc_html__('Choose image layout when it appears in Mikado Product List - Masonry layout shortcode', 'zuhaus'),
            'parent'      => $woocommerce_meta_box,
            'options'     => array(
                'mkdf-woo-image-normal-width' => esc_html__('Default', 'zuhaus'),
                'mkdf-woo-image-large-width'  => esc_html__('Large Width', 'zuhaus')
            )
        ));

        zuhaus_mikado_add_meta_box_field(
            array(
                'name'          => 'mkdf_show_title_area_woo_meta',
                'type'          => 'select',
                'default_value' => '',
                'label'         => esc_html__('Show Title Area', 'zuhaus'),
                'description'   => esc_html__('Disabling this option will turn off page title area', 'zuhaus'),
                'parent'        => $woocommerce_meta_box,
                'options'       => zuhaus_mikado_get_yes_no_select_array()
            )
        );
    }
	
    add_action('zuhaus_mikado_meta_boxes_map', 'zuhaus_mikado_map_woocommerce_meta', 99);
}