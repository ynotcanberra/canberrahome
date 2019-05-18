<?php

namespace MikadofRE\CPT\Shortcodes\Property;

use MikadofRE\Lib;

class PropertySlider implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'mkdf_property_slider';

        add_action( 'vc_before_init', array( $this, 'vcMap' ) );
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if ( function_exists( 'vc_map' ) ) {
            vc_map( array(
                    'name'                      => esc_html__( 'Mikado Property Slider', 'mkdf-real-estate' ),
                    'base'                      => $this->getBase(),
                    'category'                  => esc_html__( 'by MIKADO REAL ESTATE', 'mkdf-real-estate' ),
                    'icon'                      => 'icon-wpb-property-slider extended-custom-re-icon',
                    'allowed_container_element' => 'vc_row',
                    'params'                    => array(
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
                            'value'      => array_flip( zuhaus_mikado_get_title_tag( true ) ),
                            'dependency' => array( 'element' => 'enable_title', 'value' => array( 'yes' ) ),
                            'group'      => esc_html__( 'Content Layout', 'mkdf-real-estate' ),
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'enable_loop',
                            'heading'     => esc_html__( 'Enable Slider Loop', 'mkdf-real-estate' ),
                            'value'       => array_flip( zuhaus_mikado_get_yes_no_select_array( false, true ) ),
                            'save_always' => true,
                            'group'       => esc_html__( 'Slider Settings', 'mkdf-real-estate' ),
                            'dependency'  => array( 'element' => 'item_type', 'value' => array( '' ) )
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'enable_autoplay',
                            'heading'     => esc_html__( 'Enable Slider Autoplay', 'mkdf-real-estate' ),
                            'value'       => array_flip( zuhaus_mikado_get_yes_no_select_array( false, true ) ),
                            'save_always' => true,
                            'group'       => esc_html__( 'Slider Settings', 'mkdf-real-estate' )
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'slider_speed',
                            'heading'     => esc_html__( 'Slide Duration', 'mkdf-real-estate' ),
                            'description' => esc_html__( 'Default value is 5000 (ms)', 'mkdf-real-estate' ),
                            'group'       => esc_html__( 'Slider Settings', 'mkdf-real-estate' )
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'slider_speed_animation',
                            'heading'     => esc_html__( 'Slide Animation Duration', 'mkdf-real-estate' ),
                            'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'mkdf-real-estate' ),
                            'group'       => esc_html__( 'Slider Settings', 'mkdf-real-estate' )
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'enable_navigation',
                            'heading'     => esc_html__( 'Enable Slider Navigation Arrows', 'mkdf-real-estate' ),
                            'value'       => array_flip( zuhaus_mikado_get_yes_no_select_array( false, false ) ),
                            'save_always' => true,
                            'group'       => esc_html__( 'Slider Settings', 'mkdf-real-estate' )
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'navigation_skin',
                            'heading'    => esc_html__( 'Navigation Skin', 'mkdf-real-estate' ),
                            'value'      => array(
                                esc_html__( 'Default', 'mkdf-real-estate' ) => '',
                                esc_html__( 'Light', 'mkdf-real-estate' )   => 'light',
                                esc_html__( 'Dark', 'mkdf-real-estate' )    => 'dark'
                            ),
                            'dependency' => array( 'element' => 'enable_navigation', 'value' => array( 'yes' ) ),
                            'group'      => esc_html__( 'Slider Settings', 'mkdf-real-estate' )
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'enable_pagination',
                            'heading'     => esc_html__( 'Enable Slider Pagination', 'mkdf-real-estate' ),
                            'value'       => array_flip( zuhaus_mikado_get_yes_no_select_array( false, false ) ),
                            'save_always' => true,
                            'group'       => esc_html__( 'Slider Settings', 'mkdf-real-estate' )
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'pagination_skin',
                            'heading'    => esc_html__( 'Pagination Skin', 'mkdf-real-estate' ),
                            'value'      => array(
                                esc_html__( 'Default', 'mkdf-real-estate' ) => '',
                                esc_html__( 'Light', 'mkdf-real-estate' )   => 'light',
                                esc_html__( 'Dark', 'mkdf-real-estate' )    => 'dark'
                            ),
                            'dependency' => array( 'element' => 'enable_pagination', 'value' => array( 'yes' ) ),
                            'group'      => esc_html__( 'Slider Settings', 'mkdf-real-estate' )
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'pagination_position',
                            'heading'     => esc_html__( 'Pagination Position', 'mkdf-real-estate' ),
                            'value'       => array(
                                esc_html__( 'Below Slider', 'mkdf-real-estate' ) => 'below-slider',
                                esc_html__( 'On Slider', 'mkdf-real-estate' )    => 'on-slider'
                            ),
                            'save_always' => true,
                            'dependency'  => array( 'element' => 'enable_pagination', 'value' => array( 'yes' ) ),
                            'group'       => esc_html__( 'Slider Settings', 'mkdf-real-estate' )
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
            'type'                      => 'slider',
            'item_layout'               => 'standard',
            'number_of_columns'         => '3',
            'space_between_items'       => 'normal',
            'number_of_items'           => '-1',
            'order_by'                  => 'date',
            'order'                     => 'DESC',
            'title_tag'                 => 'h5',
            'property_slider_on'        => 'yes',
            'enable_loop'               => 'yes',
            'enable_autoplay'		    => 'yes',
            'slider_speed'              => '5000',
            'slider_speed_animation'    => '600',
            'enable_navigation'         => 'no',
            'navigation_skin'           => '',
            'enable_pagination'         => 'no',
            'pagination_skin'           => '',
            'pagination_position'       => '',
        );
        $params = shortcode_atts($args, $atts);


        $html = '<div class="mkdf-property-slider-holder">';
        $html .= zuhaus_mikado_execute_shortcode( 'mkdf_property_list', $params );
        $html .= '</div>';

        return $html;
    }
}