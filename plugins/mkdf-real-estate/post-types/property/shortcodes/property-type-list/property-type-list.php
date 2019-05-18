<?php

namespace MikadofRE\CPT\Shortcodes\Property;

use MikadofRE\Lib;

class PropertyTypeList implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'mkdf_property_type_list';

        add_action( 'vc_before_init', array( $this, 'vcMap' ) );

        //Property city list filter
        add_filter( 'vc_autocomplete_mkdf_property_type_list_type_callback', array( &$this, 'portfolioTypeAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

        //Property city list render
        add_filter( 'vc_autocomplete_mkdf_property_type_list_type_render', array( &$this, 'portfolioTypeAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if ( function_exists( 'vc_map' ) ) {
            vc_map( array(
                    'name'                      => esc_html__( 'Mikado Property Type List', 'mkdf-real-estate' ),
                    'base'                      => $this->getBase(),
                    'category'                  => esc_html__( 'by MIKADO REAL ESTATE', 'mkdf-real-estate' ),
                    'icon'                      => 'icon-wpb-property-type-list extended-custom-re-icon',
                    'allowed_container_element' => 'vc_row',
                    'params'                    => array(
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
                                esc_html__( 'Five', 'mkdf-real-estate' )    => '5',
                                esc_html__( 'Six', 'mkdf-real-estate' )     => '6'
                            ),
                            'description' => esc_html__( 'Default value is Four', 'mkdf-real-estate' ),
                            'save_always' => true
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'space_between_items',
                            'heading'     => esc_html__( 'Space Between Types', 'mkdf-real-estate' ),
                            'value'       => array_flip( zuhaus_mikado_get_space_between_items_array() ),
                            'save_always' => true
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'skin',
                            'heading'    => esc_html__( 'Skin', 'mkdf-real-estate' ),
                            'value'      => array(
                                esc_html__( 'Default', 'mkdf-real-estate' ) => '',
                                esc_html__( 'Light', 'mkdf-real-estate' )   => 'mkdf-light-skin',
                            ),
                            'save_always' => true
                        ),
                        array(
                            'type'        => 'autocomplete',
                            'param_name'  => 'type',
                            'heading'     => esc_html__( 'Show Only Property Types with Listed Slugs', 'mkdf-real-estate' ),
                            'settings'    => array(
                                'multiple'      => true,
                                'sortable'      => true,
                                'unique_values' => true
                            ),
                            'description' => esc_html__( 'Delimit slugs by comma (leave empty for all)', 'mkdf-real-estate' )
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
            'number_of_columns'         => '4',
            'space_between_items'       => 'normal',
            'type'                      => '',
            'skin'                      => '',
            'active_element'            => ''
        );
        $params = shortcode_atts($args, $atts);

        /***
         * @params query_results
         * @params holder_data
         * @params holder_classes
         * @params holder_inner_classes
         */
        $additional_params = array();

        $property_types           = $this->getTaxonomyList($params);
        $params['property_types'] = $property_types;

        $params['holder_classes']        = $this->getHolderClasses( $params );
        $params['holder_inner_classes']  = $this->getHolderInnerClasses();

        $params['item_layout'] = 'standard';
        $params['this_object'] = $this;

        $html = mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-type-list', 'holder', '', $params, $additional_params );

        return $html;
    }

    /**
     * Generates property types list
     *
     *
     * @return array
     */
    public function getTaxonomyList($params){

        if(!empty ($params['type'])) {
            $property_type = array();

            $list_of_types = explode(',',$params['type'] );

            foreach($list_of_types as $type){
                $property_type[] = get_term_by( 'slug', $type, 'property-type');
            }
        } else {
            $property_type = mkdf_re_get_taxonomy_list('property-type', false, 'obj');
        }

        return $property_type;
    }

    /**
     * Generates property holder classes
     *
     * @param $params
     *
     * @return string
     */
    public function getHolderClasses( $params ) {
        $classes = array();

        $classes[] = ! empty( $params['space_between_items'] ) ? 'mkdf-' . $params['space_between_items'] . '-space' : 'mkdf-normal-space';
        $classes[] = ! empty( $params['skin'] ) ? $params['skin'] : '';


        $number_of_columns = $params['number_of_columns'];
        switch ( $number_of_columns ):
            case '1':
                $classes[] = 'mkdf-ptl-one-column';
                break;
            case '2':
                $classes[] = 'mkdf-ptl-two-columns';
                break;
            case '3':
                $classes[] = 'mkdf-ptl-three-columns';
                break;
            case '4':
                $classes[] = 'mkdf-ptl-four-columns';
                break;
            case '5':
                $classes[] = 'mkdf-ptl-five-columns';
                break;
            case '6':
                $classes[] = 'mkdf-ptl-six-columns';
                break;
            default:
                $classes[] = 'mkdf-ptl-three-columns';
                break;
        endswitch;

        return implode( ' ', $classes );
    }

    /**
     * Generates property holder inner classes
     *
     *
     * @return string
     */
    public function getHolderInnerClasses(){
        $classes = array();

        $classes[] = 'mkdf-outer-space';

        return implode(' ', $classes);
    }

    /**
     * Filter property type
     *
     * @param $query
     *
     * @return array
     */
    public function portfolioTypeAutocompleteSuggester( $query ) {
        global $wpdb;
        $post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS property_type_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'property-type' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );

        $results = array();
        if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
            foreach ( $post_meta_infos as $value ) {
                $data          = array();
                $data['value'] = $value['slug'];
                $data['label'] = ( ( strlen( $value['property_type_title'] ) > 0 ) ? esc_html__( 'Property Type', 'mkdf-real-estate' ) . ': ' . $value['property_type_title'] : '' );
                $results[]     = $data;
            }
        }

        return $results;
    }

    /**
     * Find property type by slug
     * @since 4.4
     *
     * @param $query
     *
     * @return bool|array
     */
    public function portfolioTypeAutocompleteRender( $query ) {
        $query = trim( $query['value'] ); // get value from requested
        if ( ! empty( $query ) ) {
            // get portfolio category
            $property_type = get_term_by( 'slug', $query, 'property-type' );
            if ( is_object( $property_type ) ) {

                $portfolio_type_slug  = $property_type->slug;
                $portfolio_type_title = $property_type->name;

                $portfolio_type_title_display = '';
                if ( ! empty( $portfolio_type_title ) ) {
                    $portfolio_type_title_display = esc_html__( 'Property Type', 'mkdf-real-estate' ) . ': ' . $portfolio_type_title;
                }

                $data          = array();
                $data['value'] = $portfolio_type_slug;
                $data['label'] = $portfolio_type_title_display;

                return ! empty( $data ) ? $data : false;
            }

            return false;
        }

        return false;
    }
}