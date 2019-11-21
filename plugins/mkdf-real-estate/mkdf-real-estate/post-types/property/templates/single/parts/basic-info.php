<?php
$price = mkdf_re_get_real_estate_item_price();

$property_size = get_post_meta(get_the_ID(), 'mkdf_property_size_meta', true);

$property_structure = get_post_meta(get_the_ID(), 'mkdf_property_bedrooms_meta', true);
$property_structure_label = $property_structure == 1 ? esc_html__('Bedroom', 'mkdf-real-estate') : esc_html__('Bedrooms', 'mkdf-real-estate');

$property_accommodation = get_post_meta(get_the_ID(), 'mkdf_property_accommodation_meta', true);

$property_heating = get_post_meta(get_the_ID(), 'mkdf_property_heating_meta', true);

$assocciated_user_type = get_post_meta(get_the_ID(), 'mkdf_property_contact_info_meta', true);
?>
<div class="mkdf-property-basic-info-holder">
    <div class="mkdf-container">
        <div class="mkdf-container-inner clearfix">
            <div class="mkdf-property-basic-info-outer">
                <div class="mkdf-property-basic-info-inner">
                    <div class="mkdf-property-price">
                        <span>
                            <?php echo mkdf_re_get_real_estate_price_html($price); ?>
                        </span>
                    </div>
                    <div class="mkdf-property-param">
                        <span class="mkdf-property-icon">
                            <img src="<?php echo mkdf_re_get_assets_icon_src('icon-size-large', 'png') ?>" alt="<?php esc_attr_e('Property size icon','mkdf-real-estate'); ?>"/>
                        </span>
                        <span class="mkdf-property-content">
                            <span class="mkdf-property-label">
                                <?php esc_html_e('Building size:', 'mkdf-real-estate'); ?>
                            </span>
                            <span class="mkdf-property-value">
                               <?php echo mkdf_re_get_real_estate_size_html($property_size); ?>
                            </span>
                        </span>
                    </div>
                    <div class="mkdf-property-param">
                        <span class="mkdf-property-icon">
                            <img src="<?php echo mkdf_re_get_assets_icon_src('icon-structure-large', 'png') ?>" alt="<?php esc_attr_e('Property structure icon','mkdf-real-estate'); ?>"/>
                        </span>
                        <span class="mkdf-property-content">
                            <span class="mkdf-property-label">
                                <?php esc_html_e('Bedrooms:', 'mkdf-real-estate'); ?>
                            </span>
                            <span class="mkdf-property-value">
                               <?php echo esc_html($property_structure) . ' ' . $property_structure_label; ?>
                            </span>
                        </span>
                    </div>
                    <div class="mkdf-property-param">
                        <span class="mkdf-property-icon">
                            <img src="<?php echo mkdf_re_get_assets_icon_src('icon-accommodation-large', 'png') ?>" alt="<?php esc_attr_e('Property accommodation icon','mkdf-real-estate'); ?>"/>
                        </span>
                        <span class="mkdf-property-content">
                            <span class="mkdf-property-label">
                                <?php esc_html_e('Accommodation:', 'mkdf-real-estate'); ?>
                            </span>
                            <span class="mkdf-property-value">
                               <?php echo esc_html($property_accommodation); ?>
                            </span>
                        </span>
                    </div>
                    <div class="mkdf-property-param">
                        <span class="mkdf-property-icon">
                            <img src="<?php echo mkdf_re_get_assets_icon_src('icon-heating-large', 'png') ?>" alt="<?php esc_attr_e('Property heating icon','mkdf-real-estate'); ?>"/>
                        </span>
                        <span class="mkdf-property-content">
                            <span class="mkdf-property-label">
                                <?php esc_html_e('EER:', 'mkdf-real-estate'); ?>
                            </span>
                            <span class="mkdf-property-value">
                               <?php echo esc_html($property_heating); ?>
                            </span>
                        </span>
                    </div>
                    <?php if($assocciated_user_type !== '') { ?>
                    <div class="mkdf-property-cta">
                        <?php
                        $button_text = zuhaus_mikado_options()->getOptionValue('property_enquiry_button_text');
                        $button_text = $button_text !== '' ? $button_text : esc_html__( 'Schedule Watching', 'mkdf-real-estate' );
                        echo zuhaus_mikado_get_button_html(
                            array(
                                'custom_class' => 'mkdf-property-single-action',
                                'html_type'    => 'anchor',
                                'size'         => 'small',
                                'type'         => 'solid',
                                'text'         => $button_text
                            )
                        );
                        ?>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
