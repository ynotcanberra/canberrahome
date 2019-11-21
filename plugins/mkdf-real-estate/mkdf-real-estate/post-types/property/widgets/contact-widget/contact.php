<?php

class ZuhausMikadoContactPropertyWidget extends ZuhausMikadoWidget
{
    public function __construct()
    {
        parent::__construct(
            'mkdf_contact_property_widget',
            esc_html__('Mikado Contact Property Widget', 'mkdf-real-estate'),
            array('description' => esc_html__('Display info of property related contact', 'mkdf-real-estate'))
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams()
    {
        $this->params = array(
            array(
                'type' => 'textfield',
                'name' => 'widget_title',
                'title' => esc_html__('Widget Title', 'mkdf-real-estate')
            ),
            array(
                'type' => 'textfield',
                'name' => 'property_id',
                'title' => esc_html__('Property ID. If empty, current page ID will be used', 'mkdf-real-estate')
            ),
            array(
                'type' => 'dropdown',
                'name' => 'display_address',
                'title' => esc_html__('Display Address', 'mkdf-real-estate'),
                'options' => zuhaus_mikado_get_yes_no_select_array(false, true)
            ),
            array(
                'type' => 'dropdown',
                'name' => 'display_name',
                'title' => esc_html__('Display Name', 'mkdf-real-estate'),
                'options' => zuhaus_mikado_get_yes_no_select_array(false, true)
            ),
            array(
                'type' => 'dropdown',
                'name' => 'display_phone',
                'title' => esc_html__('Display Phone', 'mkdf-real-estate'),
                'options' => zuhaus_mikado_get_yes_no_select_array(false, true)
            ),
            array(
                'type' => 'dropdown',
                'name' => 'display_email',
                'title' => esc_html__('Display Email', 'mkdf-real-estate'),
                'options' => zuhaus_mikado_get_yes_no_select_array(false, true)
            ),
            array(
                'type' => 'dropdown',
                'name' => 'display_website',
                'title' => esc_html__('Display Website', 'mkdf-real-estate'),
                'options' => zuhaus_mikado_get_yes_no_select_array(false, true)
            ),
            array(
                'type' => 'dropdown',
                'name' => 'display_social',
                'title' => esc_html__('Display Social Icons', 'mkdf-real-estate'),
                'options' => zuhaus_mikado_get_yes_no_select_array(false, true)
            )
        );
    }

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance)
    {
        if (!is_array($instance)) {
            $instance = array();
        }

        $property_id = isset($instance['property_id']) && !empty($instance['property_id']) ? $instance['property_id'] : get_the_ID();
        $assocciated_user_type = get_post_meta($property_id, 'mkdf_property_contact_info_meta', true);
        if (!empty($assocciated_user_type)) {
            $assocciated_user_id = get_post_meta($property_id, 'mkdf_property_contact_' . $assocciated_user_type . '_meta', true);
        }
        $assocciated_user_id = !isset($assocciated_user_id) && empty($assocciated_user_id) ? get_the_author_meta('ID') : $assocciated_user_id;

        $user_name = get_user_meta($assocciated_user_id, 'last_name', true) . ' ' . get_user_meta($assocciated_user_id, 'first_name', true);
        $user_address = get_user_meta($assocciated_user_id, 'mkdf_' . $assocciated_user_type . '_address', true);
        $user_phone = get_user_meta($assocciated_user_id, 'mkdf_' . $assocciated_user_type . '_mobile_phone', true);
        $user_email = get_the_author_meta('email', $assocciated_user_id);
        $user_website = get_the_author_meta('url', $assocciated_user_id);

        $social_networks = zuhaus_mikado_core_plugin_installed() ? zuhaus_mikado_get_user_custom_fields($assocciated_user_id) : false;

        $display_address = isset($instance['display_address']) && $instance['display_address'] == 'yes' ? true : false;
        $display_name = isset($instance['display_name']) && $instance['display_name'] == 'yes' ? true : false;
        $display_phone = isset($instance['display_phone']) && $instance['display_phone'] == 'yes' ? true : false;
        $display_email = isset($instance['display_email']) && $instance['display_email'] == 'yes' ? true : false;
        $display_website = isset($instance['display_website']) && $instance['display_website'] == 'yes' ? true : false;
        $display_social = isset($instance['display_social']) && $instance['display_social'] == 'yes' ? true : false;

        $title = !empty($instance['widget_title']) ? $instance['widget_title'] : esc_html__('Contact Info', 'mkdf-real-estate');
        ?>
        <div class="widget mkdf-contact-property-widget">
            <div class="mkdf-contact-holder">
                <?php
                    echo wp_kses_post($args['before_title']) . $title . wp_kses_post($args['after_title']);
                ?>
                <?php if ($display_address && !empty($user_address)) { ?>
                    <div class="mkdf-contact-address">
                        <span class="mkdf-contact-label">
                            <?php echo esc_html($user_address) ?>
                        </span>
                    </div>
                <?php } ?>
                <?php if ($display_name && !empty($user_name)) { ?>
                    <div class="mkdf-contact-name">
                        <span class="mkdf-contact-icon icon-user"></span>
                        <span class="mkdf-contact-label">
                            <?php echo esc_html($user_name) ?>
                        </span>
                    </div>
                <?php } ?>
                <?php if ($display_phone && !empty($user_phone)) { ?>
                    <div class="mkdf-contact-phone">
                        <span class="mkdf-contact-icon icon-call-end"></span>
                        <span class="mkdf-contact-label">
                            <a href="tel:<?php echo esc_attr($user_phone) ?>" target="_self">
                                <?php echo esc_html($user_phone) ?>
                            </a>
                        </span>
                    </div>
                <?php } ?>
                <?php if ($display_email && !empty($user_email)) { ?>
                    <div class="mkdf-contact-link">
                        <span class="mkdf-contact-icon icon-envelope"></span>
                        <span class="mkdf-contact-label">
                            <a href="mailto:<?php echo esc_attr($user_email) ?>" target="_self">
                                <?php echo esc_html($user_email) ?>
                            </a>
                        </span>
                    </div>
                <?php } ?>
                <?php if ($display_website && !empty($user_website)) { ?>
                    <div class="mkdf-contact-website">
                        <span class="mkdf-contact-icon icon-link"></span>
                        <span class="mkdf-contact-label">
                            <a href="<?php echo esc_attr($user_website) ?>" target="_blank">
                                <?php echo esc_html($user_website) ?>
                            </a>
                        </span>
                    </div>
                <?php } ?>
                <?php if ($display_social && $social_networks) { ?>
                    <div class="mkdf-contact-social">
                        <h5 class="mkdf-contact-title">
                            <?php esc_html_e('Connect with us', 'mkdf-real-estate') ?>
                        </h5>
                        <?php if (is_array($social_networks) && count($social_networks)) { ?>
                            <div class="mkdf-contact-social-icons clearfix">
                                <?php foreach ($social_networks as $network) { ?>
                                    <a itemprop="url" href="<?php echo esc_attr($network['link']) ?>" target="_blank">
                                        <?php echo zuhaus_mikado_icon_collections()->renderIcon($network['class'], 'font_elegant'); ?>
                                    </a>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
    }
}