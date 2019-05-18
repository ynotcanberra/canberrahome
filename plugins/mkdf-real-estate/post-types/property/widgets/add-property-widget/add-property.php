<?php

class ZuhausMikadoAddPropertyWidget extends ZuhausMikadoWidget
{
    public function __construct()
    {
        parent::__construct(
            'mkdf_add_property_widget',
            esc_html__('Mikado Add Property Widget', 'mkdf-real-estate'),
            array('description' => esc_html__('Button for leading user to add property page', 'mkdf-real-estate'))
        );

        $this->setParams();
    }


    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
            array(
                'type'        => 'textfield',
                'name'        => 'widget_margin',
                'title'       => esc_html__( 'Widget Margin', 'mkdf-real-estate' ),
                'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'mkdf-real-estate' )
            ),
            array(
                'type'  => 'textfield',
                'name'  => 'widget_text',
                'title' => esc_html__( 'Widget text', 'mkdf-real-estate' )
            )
        );
    }

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance) {

        $holder_styles = array();
        if ( ! empty( $instance['widget_margin'] ) ) {
            $holder_styles[] = 'margin: ' . $instance['widget_margin'];
        }

        $widget_text = ! empty( $instance['widget_text']) ? $instance['widget_text'] : esc_html__( 'Add property', 'mkdf-real-estate' );

        $custom_class = 'mkdf-add-property-widget-button';
        if ( is_user_logged_in() ) {
            $package = mkdf_re_property_addition_enabled();
            //stongly false because of the 0 key for packages
            if ($package !== false) {
                if(mkdf_re_mkdf_membership_installed()) {
                    $link = mkdf_membership_get_dashboard_page_url();
                    $link = esc_url(add_query_arg(array('user-action' => 'add-property'), $link));
                } else {
                    $link = '#';
                }
            } else {
                $link = mkdf_re_get_pricing_packages_page();
            }
            $custom_class .= ' mkdf-user-logged-in';
        } else {
            $link = '#';
            $custom_class .= ' mkdf-login-opener';
        }
        ?>
        <div class="widget mkdf-add-property-widget" <?php zuhaus_mikado_inline_style( $holder_styles ); ?>>
            <?php
            if(zuhaus_mikado_core_plugin_installed()) {
                echo zuhaus_mikado_get_button_html(
                    array(
                        'custom_class' => $custom_class,
                        'size' => 'small',
                        'type' => 'outline',
                        'text' => $widget_text,
                        'link' => $link,
                        'icon_pack' => 'font_elegant',
                        'fe_icon' => 'icon_plus'
                    )
                );
            }
            ?>
        </div>
    <?php
    }
}