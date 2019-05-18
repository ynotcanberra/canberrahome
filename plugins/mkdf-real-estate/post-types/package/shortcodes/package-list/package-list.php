<?php

namespace MikadofRE\CPT\Shortcodes\Package;

use MikadofRE\Lib;

class PackageList implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'mkdf_package_list';

        add_action( 'vc_before_init', array( $this, 'vcMap' ) );
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if ( function_exists( 'vc_map' ) ) {
            vc_map( array(
                'name'                      => esc_html__( 'Mikado Package List', 'mkdf-real-estate' ),
                'base'                      => $this->getBase(),
                'category'                  => esc_html__( 'by MIKADO REAL ESTATE', 'mkdf-real-estate' ),
                'icon'                      => 'icon-wpb-package-list extended-custom-re-icon',
                'allowed_container_element' => 'vc_row',
                'params'                    => array(
                    array(
                        'type'        => 'dropdown',
                        'param_name'  => 'package_category',
                        'heading'     => esc_html__( 'Package Category', 'mkdf-real-estate' ),
                        'value'       => array_flip(mkdf_re_get_taxonomy_list('package-category', true)),
                        'save_always' => true
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
                        'heading'     => esc_html__( 'Space Between Packages', 'mkdf-real-estate' ),
                        'value'       => array_flip( zuhaus_mikado_get_space_between_items_array() ),
                        'save_always' => true
                    ),
                ))
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
            'package_category'      => '',
            'number_of_columns'     => '3',
            'space_between_items'   => 'normal',
            'item_layout'           => 'standard',
        );

        $params = shortcode_atts($args, $atts);

        $additional_params = array();

        $query_array                        = $this->getQueryArray( $params );
        $query_results                      = new \WP_Query( $query_array );
        $additional_params['query_results'] = $query_results;

        $additional_params['holder_classes']        = $this->getHolderClasses( $params );
        $additional_params['holder_inner_classes']  = $this->getHolderInnerClasses( $params );

        $params['this_object'] = $this;

        $html = mkdf_re_get_cpt_shortcode_module_template_part( 'package', 'package-list', 'holder', '', $params, $additional_params );

        return $html;
    }

    public function getQueryArray($params) {
        $query_array = array(
            'post_status' => 'publish',
            'post_type' => 'package',
            'posts_per_page' => -1,
            'meta_key'  => 'mkdf_package_price_meta',
            'orderby' => 'meta_value_num',
            'order' => 'ASC'
        );

        // TAXONOMY QUERY VALUES
        if ( ! empty( $params['package_category'] ) ) {
            $tax_query = array();

            if ( ! empty( $params['package_category'] ) ) {
                $tax_query[] = array(
                    'taxonomy'  => 'package-category',
                    'terms'     => $params['package_category']
                );
            }

            $query_array['tax_query'] = $tax_query;
        }

        return $query_array;
    }

    public function getHolderClasses($params) {
        $classes = array();

        $classes[] = ! empty( $params['space_between_items'] ) ? 'mkdf-' . $params['space_between_items'] . '-space' : 'mkdf-normal-space';

        $number_of_columns = $params['number_of_columns'];
        switch ( $number_of_columns ):
            case '1':
                $classes[] = 'mkdf-pckgl-one-column';
                break;
            case '2':
                $classes[] = 'mkdf-pckgl-two-columns';
                break;
            case '3':
                $classes[] = 'mkdf-pckgl-three-columns';
                break;
            case '4':
                $classes[] = 'mkdf-pckgl-four-columns';
                break;
            case '5':
                $classes[] = 'mkdf-pckgl-five-columns';
                break;
            default:
                $classes[] = 'mkdf-pckgl-three-columns';
                break;
        endswitch;

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

        return implode(' ', $classes);
    }

    public function getArticleClasses($params) {
        $classes = array();
        $classes[] = 'mkdf-item-space';
        if(isset($params['featured']) && $params['featured'] == 'yes') {
            $classes[] = 'mkdf-featured-package';
        }

        return implode(' ', $classes);
    }
}