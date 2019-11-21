<?php
use ZuhausMikado\Modules\Header\Lib;

if(!function_exists('zuhaus_mikado_get_header_type_options')) {
	/**
	 * This function collect all header types values and forward them to header factory file for further processing
	 */
	function zuhaus_mikado_get_header_type_options() {
		do_action('zuhaus_mikado_before_header_function_init');
		
		$header_types_option = apply_filters('zuhaus_mikado_register_header_type_class', $header_types_option = array());
		
		return $header_types_option;
	}
}

if(!function_exists('zuhaus_mikado_set_default_menu_height_for_header_types')) {
	/**
	 * This function set default menu area height for header types
	 */
	function zuhaus_mikado_set_default_menu_height_for_header_types() {
		$menu_height_meta = zuhaus_mikado_filter_px( zuhaus_mikado_options()->getOptionValue( 'menu_area_height' ) );
		$menu_height      = !empty($menu_height_meta) ? intval( $menu_height_meta ) : 60;
		
		return apply_filters('zuhaus_mikado_set_default_menu_height_value_for_header_types', $menu_height);
	}
}

if(!function_exists('zuhaus_mikado_set_default_mobile_menu_height_for_header_types')) {
	/**
	 * This function set default mobile menu area height for header types
	 */
	function zuhaus_mikado_set_default_mobile_menu_height_for_header_types() {
		$mobile_menu_height_meta = zuhaus_mikado_filter_px( zuhaus_mikado_options()->getOptionValue( 'mobile_header_height' ) );
		$mobile_menu_height      = !empty($mobile_menu_height_meta) ? intval( $mobile_menu_height_meta ) : 70;
		
		return apply_filters('zuhaus_mikado_set_default_mobile_menu_height_value_for_header_types', $mobile_menu_height);
	}
}

if(!function_exists('zuhaus_mikado_set_header_object')) {
	/**
	 * This function is used to instance header type object
	 */
    function zuhaus_mikado_set_header_object() {
    	$header_type = zuhaus_mikado_get_meta_field_intersect('header_type', zuhaus_mikado_get_page_id());
	    $header_types_option = zuhaus_mikado_get_header_type_options();
	    
        $object = Lib\HeaderFactory::getInstance()->build($header_type, $header_types_option);

        if(Lib\HeaderFactory::getInstance()->validHeaderObject()) {
            $header_connector = new Lib\ZuhausMikadoHeaderConnector($object);
            $header_connector->connect($object->getConnectConfig());
        }
    }

    add_action('wp', 'zuhaus_mikado_set_header_object', 1);
}