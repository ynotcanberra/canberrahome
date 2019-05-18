<?php

class ZuhausMikadoRecentlyViewedPropertyWidget extends ZuhausMikadoWidget {
    public function __construct() {
        parent::__construct(
            'mkdf_recently_viewed_property_widget',
            esc_html__( 'Mikado Recently Viewed Property Widget', 'mkdf-real-estate' ),
            array( 'description' => esc_html__( 'Display list of user recently viewed properties', 'mkdf-real-estate' ) )
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
            array(
                'type'  => 'textfield',
                'name'  => 'widget_title',
                'title' => esc_html__( 'Widget Title', 'mkdf-real-estate' )
            ),
            array(
                'type'  => 'textfield',
                'name'  => 'number_of_items',
                'title' => esc_html__( 'Number of Posts', 'mkdf-real-estate' )
            )
        );
    }

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget( $args, $instance ) {
        if ( ! is_array( $instance ) ) {
            $instance = array();
        }

        $instance['item_layout']         = 'simple';
        $instance['title_tag']           = 'p';
        $instance['image_proportions']   = 'thumbnail';
        $instance['space_between_items'] = 'normal';
        $instance['number_of_columns']   = '1';

        // Filter out all empty params
        $instance = array_filter( $instance, function ( $array_value ) {
            return trim( $array_value ) != '';
        } );

        $params = '';
        //generate shortcode params
        foreach ( $instance as $key => $value ) {
            $params .= " $key='$value' ";
        }

        $params .= " item_layout='simple' ";

        if(is_user_logged_in()) {

            $recent_properties = mkdf_re_get_user_recent_views();
            if(!empty($recent_properties)) {
                if(($key = array_search(get_the_ID(), $recent_properties)) !== false) {
                    unset($recent_properties[$key]);
                }
                $recent_properties = implode(',', $recent_properties);
            }
            $params .= " selected_properties='" . $recent_properties . "' ";

            echo '<div class="widget mkdf-recently-viewed-property-widget">';
            if (!empty($instance['widget_title'])) {
                echo wp_kses_post($args['before_title']) . esc_html($instance['widget_title']) . wp_kses_post($args['after_title']);
            }

            echo do_shortcode("[mkdf_property_list $params]"); // XSS OK
            echo '</div>';
        }
    }
}