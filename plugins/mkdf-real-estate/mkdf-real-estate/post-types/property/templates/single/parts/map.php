<?php
$full_address = get_post_meta(get_the_ID(), 'mkdf_property_full_address_meta', true);
$simple_address = get_post_meta(get_the_ID(), 'mkdf_property_simple_address_meta', true);
$zip_code = get_post_meta(get_the_ID(), 'mkdf_property_zip_code_meta', true);
$country = get_post_meta(get_the_ID(), 'mkdf_property_address_country_meta', true);

$google_map_params = array(
    'address1' => $full_address
);
?>
<div class="mkdf-property-map mkdf-property-label-items-holder">
    <div class="mkdf-property-map-label mkdf-property-label-style">
        <h5>
            <?php esc_html_e('Location', 'mkdf-real-estate'); ?>
        </h5>
    </div>
    <div class="mkdf-property-map-items mkdf-property-items-style clearfix">
        <div class="mkdf-property-map-object">
            <?php echo zuhaus_mikado_execute_shortcode('mkdf_google_map', $google_map_params); ?>
        </div>
        <div class="mkdf-property-map-address">
            <div class="mkdf-grid-row">
                <div class="mkdf-grid-col-6">
                    <span class="mkdf-full-address mkdf-label-items-item">
                        <span class="mkdf-label-items-label">
                            <span class="mkdf-address-icon lnr lnr-map-marker"></span>
                            <span class="mkdf-address-label-text">
                                <?php esc_html_e('Full Address:', 'mkdf-real-estate'); ?>
                            </span>
                        </span>
                        <span class="mkdf-label-items-value">
                            <?php echo esc_html($full_address); ?>
                        </span>
                    </span>
                </div>
                <div class="mkdf-grid-col-6">
                    <span class="mkdf-simple-address mkdf-label-items-item">
                        <span class="mkdf-label-items-label">
                            <span class="mkdf-address-icon lnr lnr-map-marker"></span>
                            <span class="mkdf-address-label-text">
                                <?php esc_html_e('Simple Address:', 'mkdf-real-estate'); ?>
                            </span>
                        </span>
                        <span class="mkdf-label-items-value">
                            <?php echo esc_html($simple_address); ?>
                        </span>
                    </span>
                </div>
                <div class="mkdf-grid-col-6">
                    <span class="mkdf-zip-code mkdf-label-items-item">
                        <span class="mkdf-label-items-label">
                            <span class="mkdf-address-icon lnr lnr-cloud"></span>
                            <span class="mkdf-address-label-text">
                                <?php esc_html_e('ZIP Code:', 'mkdf-real-estate'); ?>
                            </span>
                        </span>
                        <span class="mkdf-label-items-value">
                            <?php echo esc_html($zip_code); ?>
                        </span>
                    </span>
                </div>
                <div class="mkdf-grid-col-6">
                    <span class="mkdf-country mkdf-label-items-item">
                        <span class="mkdf-label-items-label">
                            <span class="mkdf-address-icon lnr lnr-earth"></span>
                            <span class="mkdf-address-label-text">
                                <?php esc_html_e('Country:', 'mkdf-real-estate'); ?>
                            </span>
                        </span>
                        <span class="mkdf-label-items-value">
                            <?php echo esc_html($country); ?>
                        </span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>