<?php

if ( ! function_exists( 'mkdf_re_set_global_map_variables' ) ) {
    /**
     * Function for setting global map variables
     */
    function mkdf_re_set_global_map_variables() {
        $global_map_variables = array();

        $global_map_variables['mapStyle'] = json_decode( zuhaus_mikado_options()->getOptionValue('real_estate_map_style') );
        $global_map_variables['scrollable'] = zuhaus_mikado_options()->getOptionValue('real_estate_maps_scrollable') == 'yes' ? true : false;
        $global_map_variables['draggable'] = zuhaus_mikado_options()->getOptionValue('real_estate_maps_draggable') == 'yes' ? true : false;
        $global_map_variables['streetViewControl'] = zuhaus_mikado_options()->getOptionValue('real_estate_maps_street_view_control') == 'yes' ? true : false;
        $global_map_variables['zoomControl'] = zuhaus_mikado_options()->getOptionValue('real_estate_maps_zoom_control') == 'yes' ? true : false;
        $global_map_variables['mapTypeControl'] = zuhaus_mikado_options()->getOptionValue('real_estate_maps_type_control') == 'yes' ? true : false;

        $global_map_variables = apply_filters('mkdf_re_filter_js_global_map_variables', $global_map_variables);

        wp_localize_script('zuhaus_mikado_modules', 'mkdfMapsVars', array(
            'global' => $global_map_variables
        ));
    }

    add_action('wp_enqueue_scripts', 'mkdf_re_set_global_map_variables', 20);

}

/* SINGLE PROPERTY MAP FUNCTIONS - START */
if( ! function_exists( 'mkdf_re_set_single_property_map_variables' ) ) {
	/**
	 * Function for setting single map variables
     * @param $id - id of property
	 */
	function mkdf_re_set_single_property_map_variables($id = '') {
        $single_map_variables = array();

        $id = isset($id) && !empty($id) ? $id : get_the_ID();
        if($id !== ''){
            $single_map_variables['currentRealEstate'] = mkdf_re_generate_real_estate_map_params($id);
        }

        wp_localize_script('zuhaus_mikado_modules', 'mkdfSingleMapVars', array(
            'single' => $single_map_variables
        ));

	}
}


if ( ! function_exists( 'mkdf_re_get_real_estate_item_map' ) ) {
	/**
	 * Function that renders map holder for single real_estate item
	 *
     * @param $id - id of property loaded
     *
	 * @return string
	 */
	function mkdf_re_get_real_estate_property_map($id) {
        $id = isset($id) && !empty($id) ? $id : get_the_ID();

        mkdf_re_set_single_property_map_variables($id);

	    $address_params = mkdf_re_get_address_params($id);
	    $latitude = $address_params['address_lat'];
	    $longitude = $address_params['address_long'];


		$html = '<div id="mkdf-re-single-map-holder"></div>
				<meta itemprop="latitude" content="'. $latitude .'">
				<meta itemprop="longitude" content="'. $longitude .'">';

		do_action('mkdf_re_after_real_estate_map');

		return $html;
	}

}
/* SINGLE PROPERTY MAP FUNCTIONS - END */

/* MULTIPLE PROPERTY MAP FUNCTIONS - START */
if( ! function_exists( 'mkdf_re_set_multiple_property_map_variables' ) ) {
    /**
     * Function for setting single map variables
     * @param $query - $query is used just for multiple type. $query is Wp_Query object containing real_estate items which should be presented on map
     * @param $return - whether map object should be returned (for ajax call) or passed to localize script
     *
     * @return array - array with addresses parameters
     */
    function mkdf_re_set_multiple_property_map_variables($query = '', $return = false) {
        $multiple_map_variables = array();

        if($query !== ''){
            if($query->have_posts()){
                while($query->have_posts()){
                    $query->the_post();
                    $multiple_map_variables['addresses'][] = mkdf_re_generate_real_estate_map_params(get_the_ID());
                }
                wp_reset_postdata();
            }
        }

        if($return) {
            return $multiple_map_variables;
        }

        wp_localize_script('zuhaus_mikado_modules', 'mkdfMultipleMapVars', array(
            'multiple' => $multiple_map_variables
        ));
    }
}

if ( ! function_exists( 'mkdf_re_get_real_estate_multiple_map' ) ) {
	/**
	 * Function that renders map holder for multiple real_estate item
     *
     * @param $query - $query is used just for multiple type. $query is Wp_Query object containing real_estate items which should be presented on map
	 *
	 * @return string
	 */
	function mkdf_re_get_real_estate_multiple_map($query = '') {

        mkdf_re_set_multiple_property_map_variables($query);

		$html = '<div id="mkdf-re-multiple-map-holder"></div>';

		do_action('mkdf_re_after_real_estate_map');

		return $html;

	}

}

/* MULTIPLE PROPERTY MAP FUNCTIONS - START */

/* MAP ITEMS FUNCTIONS START - */
if ( ! function_exists( 'mkdf_re_marker_info_template' ) ) {
	/**
	 * Template with placeholders for marker info window
	 *
	 * uses underscore templates
	 *
	 */
	function mkdf_re_marker_info_template() {

		$html = '<script type="text/template" class="mkdf-info-window-template">
				<div class="mkdf-info-window">
					<div class="mkdf-info-window-inner">
						<a href="<%= itemUrl %>"></a>
						<% if ( featuredImage ) { %>
							<div class="mkdf-info-window-image">
								<img src="<%= featuredImage[0] %>" alt="<%= title %>" width="<%= featuredImage[1] %>" height="<%= featuredImage[2] %>">
							</div>
						<% } %>
						<div class="mkdf-info-window-details">
							<h5>
								<%= title %>
							</h5>
							<p><%= address %></p>
						</div>
					</div>
				</div>
			</script>';

		print $html;

	}

	add_action('mkdf_re_after_real_estate_map', 'mkdf_re_marker_info_template');

}

if ( ! function_exists( 'mkdf_re_marker_template' ) ) {
	/**
	 * Template with placeholders for marker
	 */
	function mkdf_re_marker_template() {

        $html = '<script type="text/template" class="mkdf-marker-template">
				<div class="mkdf-map-marker">
					<div class="mkdf-map-marker-inner">
					<%= pin %>
						<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             width="594.657px" height="832.35px" viewBox="0 0 594.657 832.35" enable-background="new 0 0 594.657 832.35"
                             xml:space="preserve">
                            <path fill="#FFCD0A" d="M507.572,87.086C451.414,30.928,376.748,0,297.329,0S143.244,30.928,87.086,87.086S0,217.91,0,297.33
                                c0,37.328,8.104,75.127,24.773,115.561c13.006,31.545,31.131,64.504,57.041,103.725l82.887,125.467l113.352,180.572
                                c4.189,6.676,11.396,10.66,19.276,10.66c7.881,0,15.087-3.984,19.276-10.66l113.319-180.521l82.919-125.518
                                c25.911-39.221,44.035-72.18,57.041-103.725c16.67-40.434,24.772-78.232,24.772-115.561
                                C594.657,217.91,563.729,143.244,507.572,87.086z" class="pin-color"/>
                            <path fill="#010101" d="M457.477,262.824L303.686,139.79c-4.277-2.983-8.552-2.983-12.817,0l-55.108,44.215v-25.632
                                c0-5.547-2.033-10.352-6.086-14.418c-4.066-4.056-8.872-6.088-14.419-6.088c-5.557,0-10.362,2.032-14.418,6.088
                                c-4.065,4.066-6.088,8.871-6.088,14.418v58.313l-57.672,46.139c-5.126,4.274-5.657,9.08-1.602,14.418
                                c4.056,5.345,8.86,6.086,14.418,2.241l24.349-19.863v144.818c0,5.547,2.024,10.354,6.089,14.418
                                c4.055,4.056,8.86,6.089,14.418,6.089h61.517c5.547,0,10.353-2.033,14.418-6.089c4.056-4.063,6.087-8.871,6.087-14.418v-82.021
                                h41.013v82.021c0,5.547,2.022,10.354,6.086,14.418c4.056,4.056,8.86,6.089,14.418,6.089h61.517c5.547,0,10.353-2.033,14.418-6.089
                                c4.056-4.063,6.089-8.871,6.089-14.418V259.62l24.349,19.863c1.702,1.281,3.845,1.924,6.408,1.924c3.415,0,6.188-1.283,8.33-3.845
                                C463.242,272.016,462.603,267.099,457.477,262.824z" class="house-color"/>
                        </svg>
					</div>
				</div>
			</script>';

        print $html;

	}

	add_action('mkdf_re_after_real_estate_map', 'mkdf_re_marker_template');

}
/* MAP ITEMS FUNCTIONS - END */

/* HELPER FUNCTIONS - START */
if(!function_exists('mkdf_re_generate_real_estate_map_params')) {
    function mkdf_re_generate_real_estate_map_params($re_item_id) {

        $re_map_params = array();

        //get listing image
        $image_id = get_post_thumbnail_id($re_item_id);
        $image = wp_get_attachment_image_src($image_id);

        //take marker pin
        $marker_pin = zuhaus_mikado_icon_collections()->renderIcon('icon_pin', 'font_elegant');

        //get address params
        $address_array = mkdf_re_get_address_params($re_item_id);

        //Get item location
        if ($address_array['address'] === '' && $address_array['address_lat'] === '' && $address_array['address_long'] === '') {
            $re_map_params['location'] = null;
        } else {
            $re_map_params['location'] = array(
                'address' => $address_array['address'],
                'latitude' => $address_array['address_lat'],
                'longitude' => $address_array['address_long']
            );
        }

        $re_map_params['title'] = get_the_title($re_item_id);
        $re_map_params['itemId'] = $re_item_id;
        $re_map_params['markerPin'] = $marker_pin;
        $re_map_params['featuredImage'] = $image;
        $re_map_params['itemUrl'] = get_the_permalink($re_item_id);

        return $re_map_params;

    }
}

if(!function_exists('mkdf_re_get_address_params')){

    /**
     * Function that set up address params
     * @param $id - id of current post
     *
     * @return array
     */

    function mkdf_re_get_address_params($id){

        $address_array = array();
        $address_string = get_post_meta( $id, 'mkdf_property_full_address_meta', true );
        $address_lat = get_post_meta( $id, 'mkdf_property_full_address_latitude', true );
        $address_long = get_post_meta( $id, 'mkdf_property_full_address_longitude', true );

        $address_array['address'] = $address_string !== '' ? $address_string : '';
        $address_array['address_lat'] = $address_lat !== '' ? $address_lat : '';
        $address_array['address_long'] = $address_long !== '' ? $address_long : '';

        return $address_array;

    }

}
/* HELPER FUNCTIONS - END */