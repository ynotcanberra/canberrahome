<?php

namespace MikadofRE\CPT\Shortcodes\Property;

use MikadofRE\Lib;

class PropertyList implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'mkdf_property_list';

        add_action( 'vc_before_init', array( $this, 'vcMap' ) );
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if ( function_exists( 'vc_map' ) ) {
            vc_map( array(
                    'name'                      => esc_html__( 'Mikado Property List', 'mkdf-real-estate' ),
                    'base'                      => $this->getBase(),
                    'category'                  => esc_html__( 'by MIKADO REAL ESTATE', 'mkdf-real-estate' ),
                    'icon'                      => 'icon-wpb-property-list extended-custom-re-icon',
                    'allowed_container_element' => 'vc_row',
                    'params'                    => array(
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'type',
                            'heading'     => esc_html__( 'Property List Template', 'mkdf-real-estate' ),
                            'value'       => array(
                                esc_html__( 'Gallery', 'mkdf-real-estate' ) => 'gallery',
                                esc_html__( 'Masonry', 'mkdf-real-estate' ) => 'masonry'
                            ),
                            'save_always' => true,
                            'admin_label' => true
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'item_layout',
                            'heading'     => esc_html__( 'Item Layout', 'mkdf-real-estate' ),
                            'value'       => array(
                                esc_html__( 'Standard', 'mkdf-real-estate' ) => 'standard',
                                esc_html__( 'Info Over', 'mkdf-real-estate' ) => 'info-over'
                            ),
                            'save_always' => true,
                            'admin_label' => true
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'number_of_columns',
                            'heading'     => esc_html__( 'Number of Columns', 'mkdf-real-estate' ),
                            'value'       => array(
                                esc_html__( 'Default', 'mkdf-real-estate' ) => '',
                                esc_html__( 'One', 'mkdf-real-estate' )     => '1',
                                esc_html__( 'Two', 'mkdf-real-estate' )     => '2',
                                esc_html__( 'Three', 'mkdf-real-estate' )   => '3',
                                esc_html__( 'Four', 'mkdf-real-estate' )    => '4',
                                esc_html__( 'Five', 'mkdf-real-estate' )    => '5'
                            ),
                            'description' => esc_html__( 'Default value is Three', 'mkdf-real-estate' ),
                            'save_always' => true
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'space_between_items',
                            'heading'     => esc_html__( 'Space Between properties', 'mkdf-real-estate' ),
                            'value'       => array_flip( zuhaus_mikado_get_space_between_items_array() ),
                            'save_always' => true
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'number_of_items',
                            'heading'     => esc_html__( 'Number of Properties Per Page', 'mkdf-real-estate' ),
                            'description' => esc_html__( 'Set number of items for your property list. Enter -1 to show all.', 'mkdf-real-estate' ),
                            'value'       => '-1'
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'image_proportions',
                            'heading'     => esc_html__( 'Image Proportions', 'mkdf-real-estate' ),
                            'value'       => array(
                                esc_html__( 'Original', 'mkdf-real-estate' )  => 'full',
                                esc_html__( 'Square', 'mkdf-real-estate' )    => 'square',
                                esc_html__( 'Landscape', 'mkdf-real-estate' ) => 'landscape',
                                esc_html__( 'Portrait', 'mkdf-real-estate' )  => 'portrait',
                                esc_html__( 'Thumbnail', 'mkdf-real-estate' ) => 'thumbnail',
                                esc_html__( 'Medium', 'mkdf-real-estate' )    => 'medium',
                                esc_html__( 'Large', 'mkdf-real-estate' )     => 'large'
                            ),
                            'description' => esc_html__( 'Set image proportions for your property list.', 'mkdf-real-estate' ),
                            'dependency'  => array( 'element' => 'type', 'value' => array( 'gallery' ) )
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'enable_fixed_proportions',
                            'heading'     => esc_html__( 'Enable Fixed Image Proportions', 'mkdf-real-estate' ),
                            'value'       => array_flip( zuhaus_mikado_get_yes_no_select_array( false ) ),
                            'description' => esc_html__( 'Set predefined image proportions for your masonry property list. This option will apply image proportions you set in Property Single page - dimensions for masonry option.', 'mkdf-real-estate' ),
                            'dependency'  => array( 'element' => 'type', 'value' => array( 'masonry' ) )
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'property_type',
                            'heading'     => esc_html__( 'Property Type', 'mkdf-real-estate' ),
                            'value'       => array_flip(mkdf_re_get_taxonomy_list('property-type', true)),
                            'save_always' => true
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'property_status',
                            'heading'     => esc_html__( 'Property Status', 'mkdf-real-estate' ),
                            'value'       => array_flip(mkdf_re_get_taxonomy_list('property-status', true)),
                            'save_always' => true
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'property_city',
                            'heading'     => esc_html__( 'Property City', 'mkdf-real-estate' ),
                            'value'       => array_flip(mkdf_re_get_taxonomy_list('property-city', true)),
                            'save_always' => true
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'order_by',
                            'heading'     => esc_html__( 'Order By', 'mkdf-real-estate' ),
                            'value'       => array_flip( zuhaus_mikado_get_query_order_by_array() ),
                            'save_always' => true
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'order',
                            'heading'     => esc_html__( 'Order', 'mkdf-real-estate' ),
                            'value'       => array_flip( zuhaus_mikado_get_query_order_array() ),
                            'save_always' => true
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'title_tag',
                            'heading'    => esc_html__( 'Title Tag', 'mkdf-real-estate' ),
                            'value'      => array_flip( zuhaus_mikado_get_title_tag( true, array('p' => 'p')  ) ),
                            'dependency' => array( 'element' => 'enable_title', 'value' => array( 'yes' ) ),
                            'group'      => esc_html__( 'Content Layout', 'mkdf-real-estate' ),
                        ),
                        array(
	                        'type'       => 'dropdown',
	                        'param_name' => 'enable_compare',
	                        'heading'    => esc_html__('Show Compare', 'mkdf-real-estate'),
	                        'value'      => array_flip(zuhaus_mikado_get_yes_no_select_array()),
	                        'group'      => esc_html__('Additional Features', 'mkdf-real-estate'),
	                        'description' => esc_html__('Compare is displayed if option inside Mikado Options -> Real Estate is enabled.', 'mkdf-real-estate'),
	                        'dependency'  => array('element' => 'item_layout', 'value' => array('standard'))
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'enable_map',
                            'heading'    => esc_html__( 'Enable Map', 'mkdf-real-estate' ),
                            'value'      => array_flip(zuhaus_mikado_get_yes_no_select_array()),
                            'group'      => esc_html__( 'Additional Features', 'mkdf-real-estate' )
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'enable_filter',
                            'heading'    => esc_html__( 'Enable Filter', 'mkdf-real-estate' ),
                            'value'      => array_flip(zuhaus_mikado_get_yes_no_select_array()),
                            'group'      => esc_html__( 'Additional Features', 'mkdf-real-estate' )
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'pagination_type',
                            'heading'    => esc_html__( 'Pagination Type', 'mkdf-real-estate' ),
                            'value'      => array(
                                esc_html__( 'None', 'mkdf-real-estate' )            => 'no-pagination',
                                esc_html__( 'Standard', 'mkdf-real-estate' )        => 'standard',
                                esc_html__( 'Load More', 'mkdf-real-estate' )       => 'load-more',
                                esc_html__( 'Infinite Scroll', 'mkdf-real-estate' ) => 'infinite-scroll'
                            ),
                            'group'      => esc_html__( 'Additional Features', 'mkdf-real-estate' )
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'load_more_top_margin',
                            'heading'    => esc_html__( 'Load More Top Margin (px or %)', 'mkdf-real-estate' ),
                            'dependency' => array( 'element' => 'pagination_type', 'value' => array( 'load-more' ) ),
                            'group'      => esc_html__( 'Additional Features', 'mkdf-real-estate' )
                        )
                    )
                )
            );
        }
    }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     *
     * @return string
     */
    public function render($atts, $content = null) {
        $args = array(
            'type'                      => 'gallery',
            'item_layout'               => 'standard',
            'number_of_columns'         => '3',
            'space_between_items'       => 'normal',
            'number_of_items'           => '-1',
            'enable_fixed_proportions'  => 'no',
            'image_proportions'         => 'full',
            'selected_properties'       => '',
            'property_type'             => '',
            'property_status'           => '',
            'property_city'             => '',
            'property_county'           => '',
            'property_neighborhood'     => '',
            'property_tag'              => '',
            'property_min_size'         => '',
            'property_max_size'         => '',
            'property_min_price'        => '',
            'property_max_price'        => '',
            'property_bedrooms'         => '',
            'property_bathrooms'        => '',
            'property_features'         => '',
            'hide_active_filter'        => 'yes',
            'order_by'                  => 'date',
            'order'                     => 'DESC',
            'title_tag'                 => 'h5',
            'pagination_type'           => 'no-pagination',
            'load_more_top_margin'      => '',
            'property_slider_on'        => 'no',
            'enable_loop'               => 'yes',
            'enable_autoplay'		    => 'yes',
            'slider_speed'              => '5000',
            'slider_speed_animation'    => '600',
            'enable_navigation'         => 'no',
            'navigation_skin'           => '',
            'enable_compare'            => 'no',
            'enable_map'                => 'no',
            'enable_filter'             => 'no',
            'enable_pagination'         => 'no',
            'pagination_skin'           => '',
            'pagination_position'       => '',
            'property_contact'          => '',
        );
        $params = shortcode_atts($args, $atts);

        /***
         * @params query_results
         * @params holder_data
         * @params holder_classes
         * @params holder_inner_classes
         */
        $additional_params = array();

        $query_array                        = $this->getQueryArray( $params );
        $query_results                      = new \WP_Query( $query_array );
        $additional_params['query_results'] = $query_results;

        $additional_params['holder_data']           = $this->getHolderData( $params, $additional_params );
        $additional_params['holder_classes']        = $this->getHolderClasses( $params, $additional_params );
        $additional_params['holder_inner_classes']  = $this->getHolderInnerClasses( $params );
	    $params['enable_compare'] = zuhaus_mikado_options()->getOptionValue('enable_property_comparing') == 'yes' && $params['enable_compare'] == 'yes' ? 'yes' : 'no';

        $params['this_object'] = $this;

        $html = mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-list', 'holder', $params['type'], $params, $additional_params );

        return $html;
    }

    /**
     * Generates property list query attribute array
     *
     * @param $params
     *
     * @return array
     */
    public function getQueryArray($params){
        $query_array = array(
            'post_status'    => 'publish',
            'post_type'      => 'property',
            'posts_per_page' => $params['number_of_items'],
            'orderby'        => $params['order_by'],
            'order'          => $params['order']
        );

        $property_ids = null;
        if ( ! empty( $params['selected_properties'] ) ) {
            $property_ids            = explode( ',', $params['selected_properties'] );
            $query_array['post__in'] = $property_ids;
        }

        // TAXONOMY QUERY VALUES
        if ( ! empty( $params['property_type'] ) || ! empty( $params['property_status'] ) || ! empty( $params['property_city'] ) || ! empty( $params['property_features'] ) || ! empty( $params['property_county'] ) || ! empty( $params['property_neighborhood'] ) || ! empty( $params['property_tag'] ) ) {
            $tax_query = array();

            if ( ! empty( $params['property_type'] ) ) {
                $tax_query[] = array(
                    'taxonomy'  => 'property-type',
                    'terms'     => $params['property_type']
                );
            }

            if ( ! empty( $params['property_status'] ) ) {
                $tax_query[] = array(
                    'taxonomy'  => 'property-status',
                    'terms'     => $params['property_status']
                );
            }

            if ( ! empty( $params['property_city'] ) ) {
                $tax_query[] = array(
                    'taxonomy'  => 'property-city',
                    'terms'     => $params['property_city']
                );
            }

            if ( ! empty( $params['property_features'] ) ) {
                $tax_query[] = array(
                    'taxonomy'  => 'property-feature',
                    'terms'     => $params['property_features']
                );
            }

            if ( ! empty( $params['property_county'] ) ) {
                $tax_query[] = array(
                    'taxonomy'  => 'property-county',
                    'terms'     => $params['property_county']
                );
            }

            if ( ! empty( $params['property_neighborhood'] ) ) {
                $tax_query[] = array(
                    'taxonomy'  => 'property-neighborhood',
                    'terms'     => $params['property_neighborhood']
                );
            }

            if ( ! empty( $params['property_tag'] ) ) {
                $tax_query[] = array(
                    'taxonomy'  => 'property-tag',
                    'terms'     => $params['property_tag']
                );
            }


            $query_array['tax_query'] = $tax_query;
        }

        // META QUERY VALUES
        if ( ! empty( $params['property_min_size'] ) || ! empty( $params['property_max_size'] ) || ! empty( $params['property_min_price'] ) || ! empty( $params['property_max_price'] ) || ! empty( $params['property_contact'] ) || ! empty( $params['property_bedrooms'] ) || ! empty( $params['property_bathrooms'] ) ) {
            $meta_query = array();

            if ( ! empty( $params['property_min_size'] ) || ! empty( $params['property_max_size'] ) ) {
                $min_size = 0;
                $max_size = 999999999;
                if ( ! empty( $params['property_min_size'] ) ) {
                    $min_size = $params['property_min_size'];

                }
                if ( ! empty( $params['property_max_size'] ) ) {
                    $max_size = $params['property_max_size'];
                }
                $meta_query[] = array(
                    'key' => 'mkdf_property_size_meta',
                    'value' => array( $min_size, $max_size ),
                    'type' => 'numeric',
                    'compare' => 'BETWEEN'
                );
            }

            if ( ! empty( $params['property_min_price'] ) || ! empty( $params['property_max_price'] ) ) {
                $min_price = 0;
                $max_price = mkdf_re_get_property_max_price_value();
                if ( ! empty( $params['property_min_price'] ) ) {
                    $min_price = $params['property_min_price'];

                }
                if ( ! empty( $params['property_max_price'] ) ) {
                    $max_price = $params['property_max_price'];
                }
                $meta_query[] = array(
                    'key' => 'mkdf_property_price_meta',
                    'value' => array( $min_price, $max_price ),
                    'type' => 'numeric',
                    'compare' => 'BETWEEN'
                );
            }
	
	        if ( ! empty( $params['property_bedrooms'] ) ) {
		        $meta_query[] = array(
			        'key' => 'mkdf_property_bedrooms_meta',
			        'value' => $params['property_bedrooms'],
			        'type' => 'numeric',
			        'compare' => '='
		        );
	        }
	
	        if ( ! empty( $params['property_bathrooms'] ) ) {
		        $meta_query[] = array(
			        'key' => 'mkdf_property_bathrooms_meta',
			        'value' => $params['property_bathrooms'],
			        'type' => 'numeric',
			        'compare' => '='
		        );
	        }

            if ( ! empty( $params['property_contact'] ) ) {
                $user_meta = get_userdata( $params['property_contact'] );
                $user_roles = $user_meta->roles;
                $user_role = $user_roles[0];

                $meta_query[] = array(
                    'key' => 'mkdf_property_contact_' . $user_role . '_meta',
                    'value' => $params['property_contact'],
                    'type' => 'numeric',
                    'compare' => '='
                );
            }

            $query_array['meta_query'] = $meta_query;
        }

        if(!empty($params['next_page'])){
            $query_array['paged'] = $params['next_page'];
        } else {
            $query_array['paged'] = 1;
        }

        return $query_array;
    }

    /**
     * Generates data attributes array
     *
     * @param $params
     * @param $additional_params
     *
     * @return string
     */
    public function getHolderData($params, $additional_params){
        $dataString = '';

        if(get_query_var('paged')) {
            $paged = get_query_var('paged');
        } elseif(get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }

        $query_results = $additional_params['query_results'];
        $params['max_num_pages'] = $query_results->max_num_pages;

        if(!empty($paged)) {
            $params['next_page'] = $paged+1;
        }

        foreach ($params as $key => $value) {
            if($value !== '') {
                $new_key = str_replace( '_', '-', $key );

                $dataString .= ' data-'.$new_key.'="'.esc_attr($value) . '"';
            }
        }

        return $dataString;
    }

    /**
     * Generates property holder classes
     *
     * @param $params
     * @param $additional_params
     *
     * @return string
     */
    public function getHolderClasses( $params, $additional_params ) {
        $classes = array();

        $classes[] = ! empty( $params['type'] ) ? 'mkdf-pl-' . $params['type'] : 'mkdf-pl-gallery';
        $classes[] = ! empty( $params['item_layout'] ) ? 'mkdf-pl-layout-' . $params['item_layout'] : 'mkdf-pl-layout-standard';
        $classes[] = ! empty( $params['enable_fixed_proportions'] ) && $params['enable_fixed_proportions'] === 'yes' ? 'mkdf-pl-images-fixed' : '';
        $classes[] = ! empty( $params['space_between_items'] ) ? 'mkdf-' . $params['space_between_items'] . '-space' : 'mkdf-normal-space';
        $classes[] = ! empty( $params['enable_map'] ) && $params['enable_map'] == 'yes' ? 'mkdf-pl-with-map' : 'mkdf-pl-no-map';
        $classes[] = ! empty( $params['enable_filter'] ) && $params['enable_filter'] == 'yes' ? 'mkdf-pl-with-filter' : '';
        $classes[] = ! empty( $params['property_type'] )  ? 'mkdf-pl-type-set' : '';
        $classes[] = ! empty( $params['property_status'] )  ? 'mkdf-pl-status-set' : '';
        $classes[] = ! empty( $params['property_city'] )  ? 'mkdf-pl-city-set' : '';
        $classes[] = ! empty( $params['property_features'] )  ? 'mkdf-pl-feature-set' : '';
        $classes[] = ! empty( $params['hide_active_filter'] ) && $params['hide_active_filter'] == 'yes'  ? 'mkdf-pl-active-filter-hidden' : '';
        $classes[] = ! empty( $additional_params['query_results'] ) && $additional_params['query_results']->have_posts()  ? 'mkdf-pl-properties-found' : 'mkdf-pl-properties-not-found';

        $number_of_columns = $params['number_of_columns'];
        switch ( $number_of_columns ):
            case '1':
                $classes[] = 'mkdf-pl-one-column';
                break;
            case '2':
                $classes[] = 'mkdf-pl-two-columns';
                break;
            case '3':
                $classes[] = 'mkdf-pl-three-columns';
                break;
            case '4':
                $classes[] = 'mkdf-pl-four-columns';
                break;
            case '5':
                $classes[] = 'mkdf-pl-five-columns';
                break;
            default:
                $classes[] = 'mkdf-pl-three-columns';
                break;
        endswitch;

        $classes[] = ! empty( $params['pagination_type'] ) ? 'mkdf-pl-pag-' . $params['pagination_type'] : '';
        $classes[] = ! empty( $params['navigation_skin'] ) ? 'mkdf-nav-' . $params['navigation_skin'] . '-skin' : '';
        $classes[] = ! empty( $params['pagination_skin'] ) ? 'mkdf-pag-' . $params['pagination_skin'] . '-skin' : '';
        $classes[] = ! empty( $params['pagination_position'] ) ? 'mkdf-pag-' . $params['pagination_position'] : '';

        return implode( ' ', $classes );
    }

    /**
     * Generates property holder inner classes
     *
     * @param $params
     *
     * @return string
     */
    public function getHolderInnerClasses($params){
        $classes = array();

        $classes[] = 'mkdf-outer-space';

        $classes[] = $params['property_slider_on'] === 'yes' ? 'mkdf-owl-slider mkdf-pl-is-slider' : '';

        return implode(' ', $classes);
    }

    /**
     * Generates property article classes
     *
     *
     * @return string
     */
    public function getArticleClasses($params){
        $classes = array();
        $type    = $params['type'];

        $classes[] = 'mkdf-item-space';

        $image_proportion = $params['enable_fixed_proportions'] === 'yes' ? 'fixed' : 'original';
        $masonry_size     = get_post_meta( get_the_ID(), 'mkdf_property_masonry_' . $image_proportion . '_dimensions_meta', true );
        $classes[] = ! empty( $masonry_size ) && $type === 'masonry' ? 'mkdf-pl-masonry-' . esc_attr( $masonry_size ) : '';

        $item_featured = get_post_meta( get_the_ID(), 'mkdf_property_is_featured_meta', true);
        $classes[] = ! empty( $item_featured ) && $item_featured === 'yes' ? 'mkdf-item-featured' : '';

        $article_classes = get_post_class($classes);

        return implode(' ', $article_classes);
    }

    /**
     * Generates property image size
     *
     * @param $params
     *
     * @return string
     */
    public function getImageSize($params){
        $thumb_size = 'full';

        if ( ! empty( $params['image_proportions'] ) && $params['type'] == 'gallery' ) {
            $image_size = $params['image_proportions'];

            switch ( $image_size ) {
                case 'landscape':
                    $thumb_size = 'zuhaus_mikado_landscape';
                    break;
                case 'portrait':
                    $thumb_size = 'zuhaus_mikado_portrait';
                    break;
                case 'square':
                    $thumb_size = 'zuhaus_mikado_square';
                    break;
                case 'thumbnail':
                    $thumb_size = 'thumbnail';
                    break;
                case 'medium':
                    $thumb_size = 'medium';
                    break;
                case 'large':
                    $thumb_size = 'large';
                    break;
                case 'full':
                    $thumb_size = 'full';
                    break;
            }
        }

        if ( $params['type'] == 'masonry' && $params['enable_fixed_proportions'] === 'yes' ) {
            $fixed_image_size = get_post_meta( get_the_ID(), 'mkdf_property_masonry_fixed_dimensions_meta', true );

            switch ( $fixed_image_size ) {
                case 'default' :
                    $thumb_size = 'zuhaus_mikado_square';
                    break;
                case 'large-width':
                    $thumb_size = 'zuhaus_mikado_landscape';
                    break;
                case 'large-height':
                    $thumb_size = 'zuhaus_mikado_portrait';
                    break;
                case 'large-width-height':
                    $thumb_size = 'zuhaus_mikado_huge';
                    break;
                default :
                    $thumb_size = 'full';
                    break;
            }
        }

        return $thumb_size;
    }

    /**
     * Returns array of load more element styles
     *
     * @param $params
     *
     * @return array
     */
    public function getLoadMoreStyles($params) {
        $styles = array();

        if (!empty($params['load_more_top_margin'])) {
            $margin = $params['load_more_top_margin'];

            if(zuhaus_mikado_string_ends_with($margin, '%') || zuhaus_mikado_string_ends_with($margin, 'px')) {
                $styles[] = 'margin-top: '.$margin;
            } else {
                $styles[] = 'margin-top: '.zuhaus_mikado_filter_px($margin).'px';
            }
        }

        return implode(';', $styles);
    }
}