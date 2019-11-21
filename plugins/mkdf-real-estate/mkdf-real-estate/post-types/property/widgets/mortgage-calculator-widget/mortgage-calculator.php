<?php

class ZuhausMikadoMortgageCalculatorWidget extends ZuhausMikadoWidget {
    public function __construct() {
        parent::__construct(
            'mkdf_mortgage_calculator_widget',
            esc_html__( 'Mikado Mortgage Calculator Widget', 'mkdf-real-estate' ),
            array( 'description' => esc_html__( 'Display mortgage loan calculator', 'mkdf-real-estate' ) )
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

       $widget_title = !empty($instance['widget_title']) ? esc_html($instance['widget_title']) : esc_html__('Mortgage Calculator', 'mkdf-real-estate');

        ?>
        <div class="widget mkdf-mortgage-calculator-widget">
            <?php echo wp_kses_post($args['before_title']) . $widget_title . wp_kses_post($args['after_title']); ?>
            <div class="mkdf-mortgage-calculator-holder">
                <form method="POST" action="#">
                    <div class="mkdf-mc-field-holder">
                        <label><?php esc_html_e('Sale price', 'mkdf-real-estate'); ?></label>
                        <input type="text" name="price" id="price" placeholder="<?php echo esc_attr('$') ?>" value="" />
                    </div>
                    <div class="mkdf-mc-field-holder">
                        <label><?php esc_html_e('Interest rate', 'mkdf-real-estate'); ?></label>
                        <input type="text" name="interest-rate" id="interest-rate" placeholder="<?php echo esc_attr('%') ?>" value="" />
                    </div>
                    <div class="mkdf-mc-field-holder">
                        <label><?php esc_html_e('Term', 'mkdf-real-estate'); ?></label>
                        <input type="text" name="term-years" id="term-years" placeholder="<?php esc_attr_e('Year', 'mkdf-real-estate') ?>" value="" />
                    </div>
                    <div class="mkdf-mc-field-holder">
                        <label><?php esc_html_e('Down payment', 'mkdf-real-estate'); ?></label>
                        <input type="text" name="down-payment" id="down-payment" placeholder="<?php echo esc_attr('$') ?>" value="" />
                    </div>
                    <div class="mkdf-mc-button-holder">
                        <input type="submit" class="mkdf-btn mkdf-btn-solid" value="<?php esc_attr_e('Calculate', 'mkdf-real-estate'); ?>"/>
                    </div>
                </form>
                <div class="mkdf-mc-result-holder">
                    <div class="mkdf-mc-payment">
                        <span class="mkdf-mc-payment-label">
                            <?php esc_html_e('Monthly payment:', 'mkdf-real-estate') ?>
                        </span>
                        <span class="mkdf-mc-payment-value">

                        </span>
                    </div>
                    <div class="mkdf-mc-amount-financed">
                        <span class="mkdf-mc-amount-financed-label">
                            <?php esc_html_e('Amount financed:', 'mkdf-real-estate') ?>
                        </span>
                        <span class="mkdf-mc-amount-financed-value">

                        </span>
                    </div>
                    <div class="mkdf-mc-mortgage-payments">
                        <span class="mkdf-mc-mortgage-payments-label">
                            <?php esc_html_e('Mortgage payments:', 'mkdf-real-estate') ?>
                        </span>
                        <span class="mkdf-mc-mortgage-payments-value">

                        </span>
                    </div>
                    <div class="mkdf-mc-annual-costs">
                        <span class="mkdf-mc-annual-costs-label">
                            <?php esc_html_e('Annual costs of loan:', 'mkdf-real-estate') ?>
                        </span>
                        <span class="mkdf-mc-annual-costs-value">

                        </span>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
}