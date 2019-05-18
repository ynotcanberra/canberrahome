<?php
$features = mkdf_re_get_property_features();
if(is_array($features)) { ?>
    <div class="mkdf-property-features mkdf-property-label-items-holder">
        <div class="mkdf-property-features-label mkdf-property-label-style">
            <h5>
                <?php esc_html_e('Features', 'mkdf-real-estate'); ?>
            </h5>
        </div>
        <div class="mkdf-property-feature-items mkdf-property-items-style clearfix">
            <div class="mkdf-grid-row">
                <?php foreach($features as $feature) { ?>
                <div class="mkdf-grid-col-4">
                    <div class="mkdf-feature mkdf-feature-<?php echo esc_attr($feature['status']) ?>">
                        <i class="mkdf-feature-icon icon-check" aria-hidden="true"></i>
                        <span class="mkdf-feature-name">
                            <?php echo esc_html($feature['name']) ?>
                        </span>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php }